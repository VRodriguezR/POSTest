<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProveedoreRequest;
use App\Http\Requests\updateProveedoreRequest;
use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Persona;
use App\Models\Proveedore;
use Illuminate\Support\Facades\DB;
class proveedoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedore::with('persona.documento')->get();

        return view('proveedore.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all();
        return view('proveedore.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProveedoreRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->proveedore()->create([
                'persona_id' => $persona->id,
            ]);
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollBack();
        }
        return redirect()->route('proveedores.index')->with('success', 'Registro guardado exitosamente');
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
    public function edit(Proveedore $proveedore)
    {
        $proveedore->load('persona.documento');
        $documentos = Documento::all();
        return view('proveedore.edit', compact('proveedore', 'documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProveedoreRequest $request, Proveedore $proveedore)
    {
        try
        {
            DB::beginTransaction();
            Persona::where('id', $proveedore->persona->id)->update($request->validated());
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollBack();
        }
        return redirect()->route('proveedores.index')->with('success', 'Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $persona = Persona::find($id);
        if($persona->estado == 1)
        {
            Persona::where('id', $persona->id)
            ->update(
                [
                    'estado' => 0,
                ]
            );
            $message = 'Proveedor eliminado correctamente';
        } else {
            Persona::where('id', $persona->id)
            ->update(
                [
                    'estado' => 1,
                ]
            );
            $message = 'Proveedor restaurado correctamente';
        }

        return redirect()->route('proveedores.index')->with('success', $message);
    }
}
