<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $users = User::where('role','!=','admin')->get();

        return view('admin.users.index', compact('users'));
    }

    public function getUsers()
    {
        $users = User::where('role','!=','admin')->get();
        return $users;
    }

    public function getRoles()
    {
        $users = Role::where('name','!=','admin')->get();
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

}
