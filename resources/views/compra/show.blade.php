@extends('template')

@section('title', 'Ver Compra')

@push('css')
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bselect/bootstrap-select.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">Compras</h1>
            <ol class="breadcrumb mb-4 fs-7 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item "><a href="{{ route('compras.index') }}">Compras</a></li>
                <li class="breadcrumb-item active">Ver Compra</li>
            </ol>
        </div>
    </div>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white"><i class="fas fa-file" aria-hidden="true"></i></span>
                    <input type="text" class="form-control bg-white" value="Tipo de Comprobante:" disabled>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{ $compra->comprobante->tipo_comprobante }}" disabled>
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
                    <input type="text" class="form-control" value="{{ $compra->numero_comprobante }}" disabled>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text bg-white"><i class="fas fa-user-tie" aria-hidden="true"></i></span>
                    <input type="text" class="form-control bg-white" value="Proveedor:" disabled>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{ $compra->proveedore->persona->razon_social }}" disabled>
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
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($compra->fecha_hora)->isoFormat('dddd, D [de] MMMM [de] YYYY')}}" disabled>
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
                    <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($compra->fecha_hora)->isoFormat('hh:mm:ss A') }}" disabled>
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
                    <input type="text" class="form-control" value="{{ $compra->impuesto }}" disabled>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Tabla de detalle de la compra.
            </div>
            <div class="card-body">
                <div class="table-responsive ">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-info text-dark fw-bolder">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Compra</th>
                                <th>Precio Venta</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($compra->productos as $detalle)
                                <tr>
                                    <td>{{ $detalle->nombre }}</td>
                                    <td>{{ $detalle->pivot->cantidad }}</td>
                                    <td>{{ $detalle->pivot->precio_compra }}</td>
                                    <td>{{ $detalle->pivot->precio_venta }}</td>
                                    <td>{{ $detalle->pivot->cantidad * $detalle->pivot->precio_compra }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">SUMAS:</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">IVA:</th>
                                <th></th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-end fw-bold">TOTAL:</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
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
@endpush
