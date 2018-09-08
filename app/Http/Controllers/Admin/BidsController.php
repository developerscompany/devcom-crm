<?php

namespace App\Http\Controllers\Admin;

use App\Bid;
use App\Source;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Google_Client;
use Google_Service_Sheets;
use Revolution\Google\Sheets\Sheets;

class BidsController extends Controller
{
    public function index()
    {
        $rows = array_reverse(Bid::all()->toArray());

        return view('admin.index', compact('rows'));
    }

    public function show()
    {
        $rows = Bid::all()->toArray();

        return array_reverse($rows);
    }

    public function getAgent()
    {
        $agents = User::where('role','!=','admin')->get();
        return $agents;
    }

    public function getSource()
    {
        $sources = Source::all();
        return $sources;
    }

    public function getStatus()
    {
        $statuss = Status::all();
        return $statuss;
    }
}
