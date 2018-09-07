<?php

namespace App\Http\Controllers\Admin;

use App\Mail\InvatetionEmail;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
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
        $users = User::where('role', '!=', 'admin')->get();

        $roles = Role::where('name', '!=', 'admin')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function getUsers()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return $users;
    }

    public function getRoles()
    {
        $users = Role::where('name', '!=', 'admin')->get();
        return $users;
    }

    public function editRole(Request $request)
    {
        $user = User::find(request('data')['id']);

        $user->update([
            'name' => request('data')['name'],
            'email' => request('data')['email'],
            'role' => request('data')['role'],
        ]);

        return $user;
    }

    public function inviteUser()
    {
        $user = User::create([
            'name' => request('data')['name'],
            'email' => request('data')['email'],
            'role' => request('data')['select'],
            'password' => bcrypt('secret'),
            'email_token' => base64_encode(request('data')['email'])
        ]);

        $mail = new InvatetionEmail($user);

        Mail::to(request('data')['email'])->send($mail);
    }

    public function show(User $user)
    {
        $user = $user->toArray();
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

        foreach ($projects as $key=>$users_project){

            foreach ($users_project['tasks'] as $key1=>$task){


                if(!empty($task['child'])){

                    foreach ($task['child'] as $key2=>$child){
                        if ($child['user_to']['email'] == $user['email'] or $child['user_from']['email'] == $user['email']) {

                            $childs[$key2] = $child;


                        }


                    }

                    if(!empty($childs)){
                        $task['child'] = $childs;
                        array_push($tasks, $task);

                    }
                    else{
                        $task['child'] = null;

                    }
                    $childs = [];

//                    dd($childs);
                }


                if($task['user_to']['email'] == $user['email'] or $task['user_from']['email'] == $user['email']){
                    array_push($tasks, $task);
                }





            }

//            dd($tasks);

            if(!empty($tasks)){
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


        return view('admin.users.card', compact('users_projects'));

    }

}
