<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeVentasRequest;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Comprobante;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;


class ventaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('comprobante','cliente.persona')->where('estado', 1)->latest()->get();
        return view('venta.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $numero = Venta::where('numero_comprobante', 'like', 'V-%')->latest()->select('numero_comprobante')->first();
        if($numero == null)
            $numero = 1;
        else{
            $numero = explode('-', $numero->numero_comprobante)[1];
            $numero = intval($numero) + 1;
        }
        $numero = 'V-'.str_pad($numero, 10, '0', STR_PAD_LEFT);

        $clientes = Cliente::whereHas(
            'persona',
            function ($query) {
                $query->where('estado', 1);
            }
        )->get();

        $subquery = DB::table('compra_producto')
            ->select('producto_id', DB::raw('MAX(created_at) as max_created_at'))
            ->groupBy('producto_id');

        $productos = Producto::join('compra_producto as cpr', function($join) use ($subquery){
            $join->on('productos.id', '=', 'cpr.producto_id')
                ->whereIn('cpr.created_at', function($query) use ($subquery){
                    $query->select('max_created_at')
                        ->fromSub($subquery, 'sub')
                        ->whereRaw('sub.producto_id = cpr.producto_id');
                });
            })
            ->select('productos.id', 'productos.nombre', 'productos.stock', 'cpr.precio_venta', 'productos.codigo')
            ->where('productos.estado', 1)
            ->where('productos.stock', '>', 0)
            ->get();

        $comprobantes = Comprobante::all();

        return view('venta.create', compact('productos', 'clientes', 'comprobantes', 'numero'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeVentasRequest $request)
    {
        try{
            DB::beginTransaction();
            $venta = Venta::create($request->validated());
            $arrayProductos = $request->get('arrayProductos');
            $arrayCantidad = $request->get('arrayCantidad');
            $arrayPrecioVenta = $request->get('arrayPrecioVenta');
            $arrayDescuento = $request->get('arrayDescuento');

            $i = 0;
            while ($i < count($arrayProductos)) {
                $venta->productos()->syncWithoutDetaching([
                    $arrayProductos[$i] => [
                        'cantidad' => $arrayCantidad[$i],
                        'precio_venta' => $arrayPrecioVenta[$i],
                        'descuento' => $arrayDescuento[$i]
                    ]
                ]);
                $producto = Producto::find($arrayProductos[$i]);
                $stockActual = $producto->stock;
                $stockNuevo = intval($arrayCantidad[$i]);
                DB::table('productos')->where('id', $producto->id)->update(['stock' => $stockActual - $stockNuevo]);
                $i++;
            }
            DB::commit();
        }catch(\Exception $e){
            dd($e);
            DB::rollBack();
            return redirect()->back()->with('error', 'Ocurrió un error al registrar la venta');
        }
        return redirect()->route('ventas.create')->with('success', 'Venta registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        return view('venta.show', compact('venta'));
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
        Venta::where('id', $id)->update(['estado' => 0]);

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }
}
