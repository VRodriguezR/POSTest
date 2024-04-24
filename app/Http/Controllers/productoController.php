<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProductoRequest;
use App\Http\Requests\updateProductoRequest;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Presentacione;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class productoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|eliminar-producto', ['only' => ['index']]);
        $this->middleware('permission:crear-producto', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-producto', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-producto', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('marca.caracteristica', 'presentacione.caracteristica', 'categorias.caracteristica')->get();

        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
            ->select('marcas.id', 'c.nombre')
            ->where('c.estado', 1)
            ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
            ->select('presentaciones.id', 'c.nombre')
            ->where('c.estado', 1)
            ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
            ->select('categorias.id', 'c.nombre')
            ->where('c.estado', 1)
            ->get();

        return view('producto.create', compact('marcas', 'presentaciones', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProductoRequest $request)
    {
        try{
            DB::beginTransaction();
            $producto = new Producto();
            if($request->hasFile('img_path')){
                $name = $producto->handleUploadImage($request->file('img_path'));
            }
            else{
                $name = null;
            }
            $producto->fill([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'marca_id' => $request->marca_id,
                'presentacione_id' => $request->presentacione_id,
                'img_path' => $name,
            ]);
            $producto->save();
            $categorias = $request->get('categorias');
            $producto->categorias()->attach($categorias);
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('productos.index')->with('error', $e->getMessage());
        }
        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = Producto::find($id);
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
            ->select('marcas.id', 'c.nombre')
            ->where('c.estado', 1)
            ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
            ->select('presentaciones.id', 'c.nombre')
            ->where('c.estado', 1)
            ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
            ->select('categorias.id', 'c.nombre')
            ->where('c.estado', 1)
            ->get();

        return view('producto.edit', compact('producto', 'marcas', 'presentaciones', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductoRequest $request, Producto $producto)
    {
        try
        {
            DB::beginTransaction();
            if($request->hasFile('img_path')){
                $name = $producto->handleUploadImage($request->file('img_path'));

                if(Storage::disk('public')->exists('img/productos/'.$producto->img_path)){
                    Storage::disk('public')->delete('img/productos/'.$producto->img_path);
                }
            }
            else{
                $name = $producto->img_path;
            }

            $producto->fill([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'marca_id' => $request->marca_id,
                'presentacione_id' => $request->presentacione_id,
                'img_path' => $name,
            ]);
            $producto->save();
            $categorias = $request->get('categorias');
            $producto->categorias()->sync($categorias);
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollBack();
            return redirect()->route('productos.index')->with('error', $e->getMessage());
        }

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $producto = Producto::find($id);
        if($producto->estado == 1)
        {
            Producto::where('id', $producto->id)
            ->update(
                [
                    'estado' => 0,
                ]
            );
            $message = 'Producto eliminado correctamente';
        } else {
            Producto::where('id', $producto->id)
            ->update(
                [
                    'estado' => 1,
                ]
            );
            $message = 'Producto restaurado correctamente';
        }

        return redirect()->route('productos.index')->with('success', $message);
    }
}
