<?php

namespace App\Http\Controllers\Admin;

use App\ConditionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{





    public function index(ConditionType $type){

        $conditions = $type->get();



        return view('admin.settings.index', compact('conditions'));

    }

    public function addCondition(ConditionType $type, Request $request){


        $type->create($request->all());


        return response()->json();


    }




}
