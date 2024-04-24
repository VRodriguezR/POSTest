<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeUserRequest;
use App\Http\Requests\updateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-usuario|crear-usuario|editar-usuario|eliminar-usuario', ['only' => ['index']]);
        $this->middleware('permission:crear-usuario', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-usuario', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-usuario', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeUserRequest $request)
    {
        try{
            DB::beginTransaction();
            $fieldHash = Hash::make($request->password);
            $request->merge(['password' => $fieldHash]);
            $user = User::create($request->all());
            $user->assignRole($request->role);
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Ha ocurrido un error al crear el usuario - ' . $e->getMessage());
        }

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequest $request, User $user)
    {
        try
        {
            DB::beginTransaction();
            if(empty($request->password))
            {
                $user->update($request->except('password'));
            }
            else
            {
                $fieldHash = Hash::make($request->password);
                $request->merge(['password' => $fieldHash]);
                $user->update($request->all());
            }
            $user->syncRoles($request->role);
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->route('users.index')->with('error', 'Ha ocurrido un error al actualizar el usuario - ' . $e->getMessage());
        }
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::find($id);
            $user->removeRole($user->roles->first());
            $user->delete();
        }
        catch(\Exception $e){
            return redirect()->route('users.index')->with('error', 'Ha ocurrido un error al eliminar el usuario - ' . $e->getMessage());
        }
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }
}
