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
      try {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->institution_id = $request->institution;
        $user->role_id = Role::where('name','=','user')->first()->id;
        $user->save();

        $request->session()->flash('success', 'Docente creado correctamente');

      } catch (\Exception $e) {

        $request->session()->flash('warning', 'Ha ocurrido un error. Recuerde que el email es único. Intente nuevamente o contacte al administrador del sistema');

      }


      return redirect()->route('users.index');
    }
}
