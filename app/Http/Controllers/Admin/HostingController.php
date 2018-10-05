<?php

namespace App\Http\Controllers\Admin;

use App\ConditionType;
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



        $lists = Hosting::with('conditions','latestFinance')->get()->sortBy('latestFinance.really_to')->values();

        $conds = ConditionType::all()->toArray();

        return view('admin.hosting.list')->with(['lists' => $lists, 'conds' => $conds]);

    }

    public function add(){

        return view('admin.hosting.add');
    }

    public function conditionAdd(HostingsCondition $condition, Request $request){

        $cond = $condition->create($request->all());
        return response()->json(['data' => $cond], 200);


    }

    public function conditionUpdate($hosting,HostingsCondition $condition, Request $request){

        $cond = $condition->update($request->all());


        return response()->json(['data' => $condition], 200);


    }


    public function conditionRemove(Hosting $hosting, HostingsCondition $condition){

        $condition->delete();
        return response()->json([], 200);


    }

    public function create(HostingsCreate $request){

        $hosting = $request->only('name','last_name','second_name', 'phone', 'site');
        $acc = Hosting::create($hosting);

        return response()->json([ 'data' => $acc], 201);
    }

    public function show(Hosting $hosting){

        $conds = ConditionType::all()->toArray();
        $finances = $hosting->finances()->with('hosting')->orderBy('created_at', 'desc')->get();

        return view('admin.hosting.card')->with(['hosting' => $hosting
            ->load(['conditions.finance' => function($query) use($hosting) {
                $query->where('hosting_id', $hosting->id );
            }])
            ->load('comments.user'),
            'conds' => $conds,
            'finances' => $finances]);
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

        $data = $request->all();
        $hosting->update($data);


        return response()->json([ 'data' => $hosting], 200);

    }

    public function getSale(Hosting $hosting){

        return view('admin.hosting.sale')->with(['hosting' => $hosting
            ->load(['conditions.finance' => function($query) use($hosting) {
            $query->where('hosting_id', $hosting->id );
            }])
        ]);
    }

    public function sale(Hosting $hosting, HostingSale $sale){

        $data['user_id'] = Auth::id();
        $type = $sale->get('type') == 'm'? 'місяць': 'рік';
        $data['message'] = "Оплачено сумою за ". $type." до ".$sale->get('really_to').". Сума - ".$sale->get('amount')."$";

        DB::transaction(function () use ($data, $hosting, $sale) {
            $hosting->finances()->insert($sale->all());
            $hosting->comments()->create($data);


        });


        return response()->json([], 201);

    }

    public function archive(Hosting $hosting){
        $finances = $hosting->finances()->with('hosting')->orderBy('created_at', 'desc')->get();
//        dd($finances);

        $conds = ConditionType::all()->toArray();

        return view('admin.hosting.archive')->with(['finances' => $finances, 'conds' => $conds]);
    }




    // Calendar

    public function getCalendar(){

        $finances = HostingsFinance::all()->load('hosting.conditions', 'conds');
        $conds = ConditionType::all()->toArray();

        $events = [];
        $resources  = [];
        return view('admin.hosting.calendar')->with(['finances' => $finances, 'conds' => $conds]);
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

    public function api(){
        $action = "get_users";
        $page = "/project/226389/";
        $code = "ce8cbc2b6ec6b3f3e8640d31e61bfaad";
        $hash = md5 ($action.$code);


        $ch = curl_init('https://devcom.worksection.com/api/admin/?action='.$action.'&hash='.$hash);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
        ));

        $list_project = json_decode(curl_exec($ch));
        dd($list_project);

        $action1 = "get_users";
        $hash1 = md5($action1.$code);


        $ch = curl_init('https://devcom.worksection.com/api/admin/?action='.$action1.'&show_subtasks=1&hash='.$hash1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        dd(json_decode(curl_exec($ch)));

    }

}
