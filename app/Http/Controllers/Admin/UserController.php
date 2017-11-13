<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Institution;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function index()
    {
      $institutions = Institution::with('users')->get();
      $users = User::with('institution')->whereHas('role', function($role){
        $role->where('name','<>','admin');
      })->get();
      return view('admin.users', compact('users','institutions'));
    }

    public function store(Request $request)
    {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->institution_id = $request->institution;
      $user->role_id = Role::where('name','=','user')->first()->id;
      $user->save();
      return redirect()->route('users.index');
    }
}
