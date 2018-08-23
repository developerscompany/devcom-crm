<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\{HostingSale, HostingsCreate, HostingsMessage};
use App\Model\Admin\Hosting\Hosting;
use App\Model\Admin\Hosting\HostingsComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\{Auth, DB};

class HostingController extends Controller
{
    public function index(){

        $lists = Hosting::all()->load('conditions');

        return view('admin.hosting.list')->with(['lists' => $lists]);

    }

    public function add(){

        return view('admin.hosting.add');
    }

    public function create(HostingsCreate $request){

        $hosting = $request->only('name','last_name','second_name', 'phone');
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

        return view('admin.hosting.card')->with(['hosting' => $hosting->load('conditions.finance')->load('comments.user')]);
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

        $data = $request->only('name','last_name','second_name', 'phone');
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

        return view('admin.hosting.sale')->with(['hosting' => $hosting->load('conditions.finance')]);
    }

    public function sale(Hosting $hosting, HostingSale $sale){

        $hosting->finances()->create($sale->all());

        return response()->json([], 201);

    }


}
