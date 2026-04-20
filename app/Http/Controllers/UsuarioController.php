<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all(); // retornamos todos los usuarios de la tabla
        return view('admin.usuarios.index', ['usuarios'=>$usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $datos = request->all();
        // return response()->json($datos);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = $request->password;
        $user->save(); 
        
        //return redirect('admin/usuarios');
        return redirect()->route('usuarios.index')
            ->with('mensaje','Usuario registrado correctamente')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $usuario = User::FindOrFail($id); // retornamos al usuarios de la tabla
        return view('admin.usuarios.show', ['usuario'=>$usuario]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $usuario = User::FindOrFail($id); // retornamos al usuarios de la tabla
        return view('admin.usuarios.edit', ['usuario'=>$usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
         $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = User::Find($id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->password = Hash::make($request['password']);
        $user->save(); 
        
        return redirect()->route('usuarios.index')
            ->with('mensaje','Usuario actualizado correctamente')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // User:destroy($id);
        $user = User::findOrFail($id);
        $user->delete();

        //return redirect()->back()->with('success', 'User deleted successfully');

        return redirect()->route('usuarios.index')
            ->with('mensaje','Usuario eliminado correctamente')
            ->with('icono','success');
    }
}
