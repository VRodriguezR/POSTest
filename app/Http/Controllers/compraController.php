<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeCompraRequest;
use Illuminate\Http\Request;
use App\Models\Proveedore;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Support\Facades\DB;

class compraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('comprobante','proveedore.persona')->where('estado', 1)->latest()->get();
        return view('compra.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedore::whereHas('persona', function ($query) {
            $query->where('estado', 1);
        })->get();
        $comprobantes = Comprobante::all();
        $productos = Producto::where('estado', 1)->get();
        return view('compra.create', compact('proveedores', 'comprobantes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeCompraRequest $request)
    {
        try {
            DB::beginTransaction();
            $compra = Compra::create($request->validated());
            $arrayProductos = $request->get('arrayIdProducto');
            $arrayCantidad = $request->get('arrayCantidad');
            $arrayPrecioCompra = $request->get('arrayPrecioCompra');
            $arrayPrecioVenta = $request->get('arrayPrecioVenta');

            $i = 0;
            while ($i < count($arrayProductos)) {
                $compra->productos()->syncWithoutDetaching([
                    $arrayProductos[$i] => [
                        'cantidad' => $arrayCantidad[$i],
                        'precio_compra' => $arrayPrecioCompra[$i],
                        'precio_venta' => $arrayPrecioVenta[$i],
                    ]
                ]);
            $producto = Producto::find($arrayProductos[$i]);
            $stockActual = $producto->stock;
            $stockNuevo = intval($arrayCantidad[$i]);

            DB::table('productos')->where('id', $producto->id)->update(['stock' => $stockActual + $stockNuevo]);
            $i++;
        }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('compras.index')->with('error', 'Error al crear la compra');
        }
        return redirect()->route('compras.index')->with('success', 'Compra creada correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        // dd($compra);
        return view('compra.show', compact('compra'));
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
