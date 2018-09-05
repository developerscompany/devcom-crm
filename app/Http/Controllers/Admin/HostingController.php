<?php

namespace App\Http\Controllers\Admin;

use App\Exports\HostingsExport;
use App\Http\Requests\Admin\{HostingSale, HostingsCreate, HostingsMessage, ServerCreate};
use App\Model\Admin\Hosting\Hosting;
use App\Model\Admin\Hosting\HostingsComment;
use App\Model\Admin\Hosting\HostingsCondition;
use App\Model\Admin\Hosting\HostingsFinance;
use App\Model\Admin\Hosting\Server;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\{Auth, DB, Session};
use Maatwebsite\Excel\Facades\Excel;

class HostingController extends Controller
{
    public function index(){

        /*$lists = Hosting::orderBy("updated_at","desc")->with('conditions')->with(['finances' => function($query) {
            return $query->where('condition', 'hosting' )->orderBy("really_to", "desc")->first();
        }])->get();*/
//        $lists = Hosting::with('conditions')->join('hostings_finances', 'hostings.id', '=', 'hostings_finances.hosting_id')->get();
        /*$lists = Hosting::rightJoin('hostings_finances', 'hostings_finances.hosting_id','=','hostings.id')
            ->orderBy('really_to','desc')
            ->get()->groupBy('hosting_id');*/

        $lists = Hosting::with('conditions','finances')->get();

        foreach ($lists as $list){

            $really_to = $list->finances()->where('condition', '=' ,'hosting')->orderBy('really_to', 'desc')->first();

            if(!empty($really_to->really_to)){
                $list->really_to = $really_to->really_to;
            }
        }

        $lists = $lists->sortBy("really_to")->values()->all();

        return view('admin.hosting.list')->with(['lists' => $lists]);

    }

    public function add(){

        return view('admin.hosting.add');
    }

    public function create(HostingsCreate $request){

        $hosting = $request->only('name','last_name','second_name', 'phone', 'site');
        $conditions = $request->get('conditions');

        DB::transaction(function () use ($hosting, $conditions) {
            $acc = Hosting::create($hosting);
            foreach ($conditions as $condition){

                if(!empty($condition['condition'])){
                    $acc->conditions()->create($condition);
                }
            }
        });

        return response()->json([ 'data' => $conditions], 201);
    }

    public function show(Hosting $hosting){

        return view('admin.hosting.card')->with(['hosting' => $hosting
            ->load(['conditions.finance' => function($query) use($hosting) {
                $query->where('hosting_id', $hosting->id );
            }])
            ->load('comments.user')]);
    }

    public function getComment(HostingsMessage $comment, $hosting){
        $data = [
            'message' => $comment->get('comment'),
            'user_id' => Auth::id(),
            'hosting_id' => $hosting

        ];
        HostingsComment::create($data);

        return response()->json(['data' => $data/*$comment->get('comment')*/], 201);

    }

    public function edit(Hosting $hosting){

//        dd($hosting->conditions()->select('id')->get()->toArray());
        return view('admin.hosting.edit')->with(['hosting' => $hosting->load('conditions')]);

    }

    public function update(HostingsCreate $request, Hosting $hosting){

        $data = $request->only('name','last_name','second_name', 'phone', 'site');
        $conditions = $request->get('conditions');
        $conditions_id = $hosting->conditions()->select('id')->get()->toArray();
        DB::transaction(function () use ($hosting, $conditions, $data, $conditions_id) {
            $hosting->update($data);


            foreach ($conditions as $condition){
                if(!empty($condition['condition'])){
                    if(!empty($condition['id']) && isset($condition['id'])){
                        $hosting->conditions()->where('id', $condition['id'])->update($condition);

                        foreach ($conditions_id as $key=>$item){
                            if($condition['id'] == $item['id']){
                                unset($conditions_id[$key]);
                            }
                        }

                    }
                    else{
                        $hosting->conditions()->create($condition);
                    }

                }
            }

            $delete_id = array_map(
                function ($item){
                    return $item['id'];
                }
            , $conditions_id);

            $hosting->conditions()->whereIn('id',$delete_id)->update(['hosting_id' => 0]);

        });

        return response()->json([ 'data' => $conditions], 201);

    }

    public function getSale(Hosting $hosting){

        return view('admin.hosting.sale')->with(['hosting' => $hosting
            ->load(['conditions.finance' => function($query) use($hosting) {
            $query->where('hosting_id', $hosting->id );
            }])
        ]);
    }

    public function sale(Hosting $hosting, HostingSale $sale){

        $hosting->finances()->insert($sale->all());

        return response()->json([], 201);

    }

    public function archive(Hosting $hosting){
        $finances = $hosting->finances()->with('hosting')->orderBy('created_at', 'desc')->get();
//        dd($finances);

        return view('admin.hosting.archive')->with(['finances' => $finances]);
    }




    // Calendar

    public function getCalendar(){

        $finances = HostingsFinance::all()->load('hosting');

        return view('admin.hosting.calendar')->with(['finances' => $finances]);
    }

    // Servers





    public function getServers(Server $server, HostingsFinance $finance){

        $month = Carbon::now();
        $now = Carbon::parse($month);

        $last = $now->subMonth(5);
        // TODO: server chart - years
        $pays = $finance->whereYear('really_to', '=', [2018,2019])->get()->groupBy(function($date) {
            return Carbon::parse($date->really_to)->format('Y-m');
        })->map(function ($item, $key){
            return $item->count();
        })->toArray();
        $paids = $finance->whereYear('created_at', '=', [2018,2019])->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        })->map(function ($item, $key){
            return $item->count() ;
        })->toArray();

        $amounts = $finance->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        })->map(function ($item, $key){
            return $item->sum('amount');
        });
        $result = [];
        foreach ($paids as $key1=>$paid){
            foreach ($pays as $key2=>$pay){
                if(empty($result[$key2])){
                    $result[$key2]['pay'] = $pay;
                    $result[$key2]['paid'] = 0;
                }
            }
            $result[$key1]['paid'] = $paid;
            if(empty($result[$key1]['pay'])){
                $result[$key1]['pay'] = 0;
            }
        }
        ksort($result);
        return view("admin.hosting.servers",['servers' => $server->get(), 'pay' => $result,  'amounts' => $amounts]);
    }




    public function addServer(ServerCreate $create, Server $server){

        $server->create($create->all());

        return response()->json();
    }

    public function editServer(ServerCreate $update, Server $server){

        $server->where('id', $update->get('id'))->update($update->all());

        return response()->json();
    }

    public function deleteServer(Server $server){

        $server->delete();

        return response()->json();


    }




    // Export
    public function getExport(){
        return view('admin.hosting.export');
    }

    public function export(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {

                foreach ($reader->toArray() as $key=>$item) {
                    $mas = [];
                    $condition = [];
                    $date = [];
                    if(!empty($item['imya'])){
                        $mas['name'] = "import";
                        $mas['last_name'] = "i";
                        $mas['second_name'] = "i";
                        $mas['site'] = $item['imya'];
                        $mas['phone'] = "123456789";


                        if(!empty($item['khosting']) ){

                            $condition['hosting']['amount'] = 0;
                            $condition['hosting']['amount_year'] = $item['khosting'];
                            $condition['hosting']['condition'] = "hosting";

                            if (!empty($item['data'])){
                                $month = 0;
                                $month_val = trim(mb_strtolower($item['data']));
                                switch ($month_val){
                                    case "январь":
                                        $month = 1;
                                        break;
                                    case "февраль":
                                        $month = 2;
                                        break;
                                    case "март":
                                        $month = 3;
                                        break;
                                    case "апрель":
                                        $month = 4;
                                        break;
                                    case "май":
                                        $month = 5;
                                        break;
                                    case "июнь":
                                        $month = 6;
                                        break;
                                    case "июль":
                                        $month = 7;
                                        break;
                                    case "август":
                                        $month = 8;
                                        break;
                                    case "сентябрь":
                                        $month = 9;
                                        break;
                                    case "октябрь":
                                        $month = 10;
                                        break;
                                    case "ноябрь":
                                        $month = 11;
                                        break;
                                    case "декабрь":
                                        $month = 12;
                                        break;
                                }
                                if(!empty($item["2018"])){
                                    $date['hosting']["created_at"] = "2018-".$month."-7";
                                    $date['hosting']["really_to"] = "2019-".$month."-7";
                                    $date['hosting']["condition"] = "hosting";
                                    $date['hosting']["type"] = "y";
                                    $date['hosting']["amount"] = $item['khosting'];
                                }
                                else{
                                    $date['hosting']["created_at"] = Carbon::now()->format("Y-m-d");
                                    $date['hosting']["really_to"] = "2018-".$month."-7";
                                    $date['hosting']["condition"] = "hosting";
                                    $date['hosting']["type"] = "y";
                                    $date['hosting']["amount"] = $item['khosting'];

                                }

                            }

                        }
                        if (!empty($item['domen'])){
                            $condition['domain']['amount'] = 0;
                            $condition['domain']['amount_year'] = $item['domen'];
                            $condition['domain']['condition'] = "domain";
                            if (!empty($item['data'])){
                                $month = 0;
                                $month_val = trim(mb_strtolower($item['data']));
                                switch ($month_val){
                                    case "январь":
                                        $month = 1;
                                        break;
                                    case "февраль":
                                        $month = 2;
                                        break;
                                    case "март":
                                        $month = 3;
                                        break;
                                    case "апрель":
                                        $month = 4;
                                        break;
                                    case "май":
                                        $month = 5;
                                        break;
                                    case "июнь":
                                        $month = 6;
                                        break;
                                    case "июль":
                                        $month = 7;
                                        break;
                                    case "август":
                                        $month = 8;
                                        break;
                                    case "сентябрь":
                                        $month = 9;
                                        break;
                                    case "октябрь":
                                        $month = 10;
                                        break;
                                    case "ноябрь":
                                        $month = 11;
                                        break;
                                    case "декабрь":
                                        $month = 12;
                                        break;
                                }
                                if(!empty($item["2018"])){
                                    $date['domain']["created_at"] = "2018-".$month."-7";
                                    $date['domain']["really_to"] = "2019-".$month."-7";
                                    $date['domain']["condition"] = "domain";
                                    $date['domain']["type"] = "y";
                                    $date['domain']["amount"] = $item['domen'];
                                }
                                else{
                                    $date['domain']["created_at"] = Carbon::now()->format("Y-m-d");
                                    $date['domain']["really_to"] = "2018-".$month."-7";
                                    $date['domain']["condition"] = "domain";
                                    $date['domain']["type"] = "y";
                                    $date['domain']["amount"] = $item['domen'];

                                }

                            }
                        }

                            DB::transaction(function () use ($mas, $condition, $date) {
                                $hosting = Hosting::create($mas);

                                foreach ($condition as $cond){
                                    $cond['hosting_id'] = $hosting->id;
                                    HostingsCondition::create($cond);
                                }
                                foreach ($date as $finance){
                                    if(!empty($finance['really_to'])){
                                        $finance['hosting_id'] = $hosting->id;
                                        HostingsFinance::create($finance);
                                    }
                                    else{
                                        dd($finance);
                                    }



                                }

                            });

                        }


                }
            });
        }

        Session::put('success', 'You file successfully import in database!!!');

        return back();


    }



}
