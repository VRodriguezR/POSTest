<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storePresentacioneRequest;
use App\Http\Requests\updatePresentacioneRequest;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use Illuminate\Support\Facades\DB;


class presentacioneController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ver-presentacione|crear-presentacione|editar-presentacione|eliminar-presentacione', ['only' => ['index']]);
        $this->middleware('permission:crear-presentacione', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-presentacione', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-presentacione', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('presentacione.index', compact('presentaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentacione.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storePresentacioneRequest $request)
    {
        try {
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->presentacione()->create([
                'caracteristica_id' => $caracteristica->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('presentaciones.index')->with('success', 'Presentacion creada correctamente');
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
    public function edit(Presentacione $presentacione)
    {
        return view('presentacione.edit', ['presentacione' => $presentacione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updatePresentacioneRequest $request, Presentacione $presentacione)
    {
        Caracteristica::where('id', $presentacione->caracteristica->id)->update($request->validated());
        return redirect()->route('presentaciones.index')->with('success', 'Presentacion actualizada correctamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $presentacion = Presentacione::find($id);
        if($presentacion->caracteristica->estado == 1)
        {
            Caracteristica::where('id', $presentacion->caracteristica->id)
            ->update(
                [
                    'estado' => 0,
                ]
            );
            $message = 'Presentacion eliminada correctamente';
        } else {
            Caracteristica::where('id', $presentacion->caracteristica->id)
            ->update(
                [
                    'estado' => 1,
                ]
            );
            $message = 'Presentacion restaurada correctamente';
        }

        return redirect()->route('presentaciones.index')->with('success', $message);
    }
}
