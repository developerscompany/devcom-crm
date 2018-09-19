<?php

namespace App\Http\Controllers\User;

use App\Bid;
use App\BidsCustomers;
use App\Source;
use App\Status;
use App\Timing;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user()->toArray();
//        $action = "get_all_tasks";
        $action = "get_projects";
        $page = "";
        $code = "ce8cbc2b6ec6b3f3e8640d31e61bfaad";
        $hash = md5($action . $code);


        $ch = curl_init('https://devcom.worksection.com/api/admin/?action=' . $action . '&hash=' . $hash . '&show_subtasks=1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));

        $projects = json_decode(curl_exec($ch), true)['data'];

        foreach ($projects as $key => $project) {

            $actionTemp = "get_tasks";
            $pageTemp = $project['page'];


            $codeTemp = "ce8cbc2b6ec6b3f3e8640d31e61bfaad";
            $hashTemp = md5($pageTemp . $actionTemp . $codeTemp);

            $ch = curl_init('https://devcom.worksection.com/api/admin/?action=' . $actionTemp . '&page=' . $pageTemp . '&hash=' . $hashTemp . '&show_subtasks=1');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
            ));

            $projects[$key]['tasks'] = json_decode(curl_exec($ch), true)['data'];


        }

        $users_projects = [];
        $childs = [];
        $tasks = [];

        foreach ($projects as $key => $users_project) {

            foreach ($users_project['tasks'] as $key1 => $task) {


                if (!empty($task['child'])) {

                    foreach ($task['child'] as $key2 => $child) {
                        if ($child['user_to']['email'] == $user['email'] or $child['user_from']['email'] == $user['email']) {

                            $childs[$key2] = $child;


                        }


                    }

                    if (!empty($childs)) {
                        $task['child'] = $childs;
                        array_push($tasks, $task);

                    } else {
                        if ($task['user_to']['email'] == $user['email'] or $task['user_from']['email'] == $user['email']) {
                            array_push($tasks, $task);
                        }
                    }
                    $childs = [];

//                    dd($childs);
                } else {
                    if ($task['user_to']['email'] == $user['email'] or $task['user_from']['email'] == $user['email']) {
                        array_push($tasks, $task);
                    }
                }


            }

//            dd($tasks);

            if (!empty($tasks)) {
                $users_project['tasks'] = $tasks;
                array_push($users_projects, $users_project);
            }
            $tasks = [];
        }

        /*$users_projects = array_values(array_filter(array_map(
            function ($project) use ($user) {
                if (!empty($project['tasks'])) {
                    $tasks = $project['tasks'];
                    $users_tasks = array_values(array_filter(array_map(
                        function ($task) use ($user) {
                            if ($task['user_to']['email'] == $user['email'] or $task['user_from']['email'] == $user['email']) {
                                return $task;
                            } else {
                                if(!empty($task['child'])){

                                    $childs = $task['child'];
                                    $users_childs = array_values(array_filter(array_map(
                                            function ($child) use ($user) {
                                                if ($child['user_to']['email'] == $user['email'] or $child['user_from']['email'] == $user['email']) {
                                                    return $child;
                                                }
                                                else return null;

                                            }, $childs)

                                        , function ($item) {
                                            return !empty($item);
                                        }));
                                    return !empty($users_childs)? $task : null;

                                }

                                else return false;


                            }
                        },
                        $tasks),
                        function ($item) {
                            return !empty($item);
                        }
                    ));

                    return !empty($users_tasks)? $project : null;
                } else {
                    if ($project['user_to']['email'] == $user['email'] or $project['user_from']['email'] == $user['email']) {
                        return $project;
                    } else {
                        return null;
                    }
                }


            }, $projects),
            function ($item) {
                return !empty($item);
            }));*/


//        return view('admin.users.card', compact('users_projects'));

        return view('user.index', compact('users_projects'));
    }

    public function bids()
    {

        if (auth()->user()->role == 'admin')
        {
            return redirect('/admin/bids');
        }

        $lines = array_reverse(Bid::where('user_id', auth()->user()->id)->get()->toArray());

        $sourses = Source::all();
        $statuses = Status::all();
        $timings = Timing::orderBy('id', 'asc')->get();
        $customers = BidsCustomers::all();

//        dd($timings);

        return view('user.welcome',
            compact('lines', 'sourses', 'statuses', 'timings', 'customers'));
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
            'customer' => request('customer'),
            'agent' => auth()->user()->name,
            'source' => request('source'),
            'link' => request('link'),
            'niche' => request('niche'),
            'current' => request('site'),
            'segment' => request('segment'),
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
    public function bidResp()
    {
        $bid = Bid::where('user_id', auth()->user()->id)->where('id', request('data')['id'])->first();

        $bid->update([
            'response' => request('data')['res']
        ]);
    }

    public function stat()
    {

        $lines = array_reverse(Bid::where('user_id', auth()->user()->id)->get()->toArray());

        $sourses = Source::all();
        $statuses = Status::all();
        $timings = Timing::orderBy('id', 'asc')->get();

        return view('user.stat', compact('lines', 'sourses', 'statuses', 'timings'));
    }
}
