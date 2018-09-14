<?php

namespace App\Http\Controllers\User;

use App\Bid;
use App\Source;
use App\Status;
use App\Timing;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function bids()
    {

        if (auth()->user()->role == 'admin')
        {
            return redirect('/admin/bids');
        }

        $lines = Bid::where('user_id', auth()->user()->id)->get()->toArray();


        $sourses = Source::all();
        $statuses = Status::all();
        $timings = Timing::orderBy('id', 'asc')->get();

//        dd($timings);

        return view('user.welcome', compact('lines', 'sourses', 'statuses', 'timings'));
    }

    public function show()
    {
        $array = Bid::where('user_id', auth()->user()->id)->get();

        return array_reverse($array->toArray());
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

    public function store(Request $request)
    {
        Bid::create([
            'user_id' => auth()->user()->id,
            'date' => date("d.m.Y"),
            'agent' => auth()->user()->name,
            'source' => request('source'),
            'link' => request('link'),
            'niche' => request('niche'),
            'current' => request('site'),
            'description' => request('desc'),
            'timing' => request('timing'),
            'budget' => request('budget'),
            'response' => request('resp'),
            'status' => request('status'),
            'execut' => request('execut'),
            'comment' => request('comment')
        ]);

        return redirect('/user');
    }

    public function update(Request $request)
    {

        $bid = Bid::where('user_id', auth()->user()->id)->where('id', request('data')['id'])->first();

        $bid->update([
            'status' => request('data')['10']
        ]);

    }
}
