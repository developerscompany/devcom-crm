<?php

namespace App\Http\Controllers\Admin;

use App\ConditionType;
use App\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{





    public function index(ConditionType $type, Currency $currency){

        $conditions = $type->get();

        $currencies = $currency->get();



        return view('admin.settings.index', compact('conditions', 'currencies'));

    }

    public function addCondition(ConditionType $type, Request $request){


        $type->create($request->all());


        return response()->json();


    }

    public function addCurrency(Currency $currency, Request $request){


        $currency->create($request->all());

        return response()->json();

    }

    public function remCondition(ConditionType $condition){

        $condition->delete();



        return response()->json();


    }

    public function remCurrency(Currency $currency){

        $currency->delete();

        return response()->json();

    }




}
