<?php

namespace App\Http\Controllers;

use App\Http\Requests\updateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $profile)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $profile->id,
            'gender' => 'required|string|in:M,F',
            'password' => 'nullable|min:8|same:password_confirm',
        ]);

        try
        {
            if(empty($request->password))
            {
                $profile->update($request->except('password'));
            }
            else
            {
                $fieldHash = Hash::make($request->password);
                $request->merge(['password' => $fieldHash]);
                $profile->update($request->all());
            }
        }
        catch(\Exception $e)
        {
            return redirect()->route('profile.index')->with('error', 'Ha ocurrido un error al actualizar el perfil - ' . $e->getMessage());
        }
        return redirect()->route('profile.index')->with('success', 'Perfil actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
