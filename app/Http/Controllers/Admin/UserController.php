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
        $users = User::where('role','!=','admin')->get();

        $roles = Role::where('name', '!=', 'admin')->get();

        return view('admin.users.index', compact('users', 'roles'));
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

    public function inviteUser()
    {
        $user = User::create([
            'name' => request('data')['name'],
            'email' => request('data')['email'],
            'role' => request('data')['select'],
            'password' => bcrypt('secret'),
            'email_token' => base64_encode(request('data')['email'])
        ]);

        Mail::to(request('data')['email'])->send(new InvatetionEmail($user));
    }

}
