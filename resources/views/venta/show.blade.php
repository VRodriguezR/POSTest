@extends('template')

@section('title', 'Ver Venta')

@push('css')
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('vendor/bselect/bootstrap-select.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-2">
    <div class="col-md-8">
        <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
        <ol class="breadcrumb mb-4 fs-7 bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item "><a href="{{ route('ventas.index') }}">Ventas</a></li>
            <li class="breadcrumb-item active">Ver Venta</li>
        </ol>
    </div>
</div>

<div class="row bg-white mb-2 mx-3 py-3">
    <div class="container">

        <div class="card border-primary mb-4">
            <div class="card-header bg-primary text-light">
                Datos Generales.
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="fas fa-file" aria-hidden="true"></i></span>
                            <input type="text" class="form-control bg-white" value="Tipo de Comprobante:" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $venta->comprobante->tipo_comprobante }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="fas fa-hashtag" aria-hidden="true"></i></span>
                            <input type="text" class="form-control bg-white" value="Numero de Comprobante:" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $venta->numero_comprobante }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="fas fa-user-tie" aria-hidden="true"></i></span>
                            <input type="text" class="form-control bg-white" value="Cliente:" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $venta->cliente->persona->razon_social }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="fas fa-user" aria-hidden="true"></i></span>
                            <input type="text" class="form-control bg-white" value="Vendedor:" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $venta->user->name }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="fas fa-calendar-alt" aria-hidden="true"></i></span>
                            <input type="text" class="form-control bg-white" value="Fecha:" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->isoFormat('dddd, D [de] MMMM [de] YYYY')}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="fas fa-clock" aria-hidden="true"></i></span>
                            <input type="text" class="form-control bg-white" value="Hora:" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($venta->fecha_hora)->isoFormat('hh:mm:ss A') }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-white"><i class="fas fa-percent" aria-hidden="true"></i></span>
                            <input type="text" class="form-control bg-white" value="Impuesto:" disabled>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{ $venta->impuesto }}" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="card border-primary mb-4">
            <div class="card-header bg-primary text-light">
                Detalles de la compra.
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-success text-dark fw-bolder">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Venta</th>
                                <th>Subtotal</th>
                                <th>Descuento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($venta->productos as $detalle)
                            <tr>
                                <td>{{ $detalle->nombre }}</td>
                                <td>{{ $detalle->pivot->cantidad }}</td>
                                <td>{{ $detalle->pivot->precio_venta }}</td>
                                <td>{{ $detalle->pivot->cantidad * $detalle->pivot->precio_venta }}</td>
                                <td>{{ $detalle->pivot->descuento }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">SUBTOTAL:</th>
                                <th id="th_sumas"></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">IVA:</th>
                                <th id="th_iva"></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">DESCUENTO:</th>
                                <th id="th_descuento"></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">TOTAL:</th>
                                <th id="th_total"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script src="{{ asset('vendor/bselect/bootstrap-select.min.js') }}"></script>

<script src="{{ asset('vendor/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<script>
    $(document).ready(function() {
        let sumas = 0;
        let iva = 0;
        let total = 0;
        let precio_venta = 0;
        let cantidad = 0;
        let subtotal = 0;
        let descuento = 0;

        $('tbody tr').each(function() {
            precio_venta = parseFloat($(this).find('td').eq(2).text());
            cantidad = parseFloat($(this).find('td').eq(1).text());
            total += precio_venta * cantidad;
            descuento += parseFloat($(this).find('td').eq(4).text());
        });

        iva = (total - descuento) * 0.16;
        subtotal = total - iva + descuento;

        $('#th_sumas').text('$'+subtotal.toFixed(2));
        $('#th_iva').text('$'+iva.toFixed(2));
        $('#th_descuento').text('- $'+descuento.toFixed(2));
        $('#th_total').text('$'+total.toFixed(2));
    });
</script>
@endpush
