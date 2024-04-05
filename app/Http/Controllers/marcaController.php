<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeMarcaRequest;
use App\Http\Requests\updateMarcaRequest;
use App\Models\Caracteristica;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;

class marcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::with('caracteristica')->latest()->get();

        return view('marca.index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeMarcaRequest $request)
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->marca()->create([
                'caracteristica_id' => $caracteristica->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('marcas.index')->with('success', 'Marca creada correctamente');
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
    public function edit(Marca $marca)
    {
        return view('marca.edit', ['marca' => $marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateMarcaRequest $request, Marca $marca)
    {
        Caracteristica::where('id', $marca->caracteristica->id)->update($request->validated());
        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $marca = Marca::find($id);
        if($marca->caracteristica->estado == 1)
        {
            Caracteristica::where('id', $marca->caracteristica->id)
            ->update(
                [
                    'estado' => 0,
                ]
            );
            $message = 'Marca eliminada correctamente';
        } else {
            Caracteristica::where('id', $marca->caracteristica->id)
            ->update(
                [
                    'estado' => 1,
                ]
            );
            $message = 'Marca restaurada correctamente';
        }

        return redirect()->route('marcas.index')->with('success', $message);
    }
}
