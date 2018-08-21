<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\HostingsCreate;
use App\Model\Admin\Hosting\Hosting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

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

        return view('admin.hosting.card')->with(['hosting' => $hosting->load('conditions')]);
    }

}
