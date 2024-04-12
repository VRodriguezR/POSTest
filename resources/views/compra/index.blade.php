@extends('template')

@section('title', 'Compras')

@push('css')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('vendor/datatables/dataTables.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/css/sweetalert2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0 text-gray-800">Compras</h1>
                <ol class="breadcrumb mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Compras</li>
                </ol>
            </div>
            <a href="{{ route('compras.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Añadir Compras
                </button>
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listado de Compras</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="table-info text-dark fw-bolder">
                                        <tr>
                                            <th>Comprobante</th>
                                            <th>Proveedor</th>
                                            <th>Fecha y Hora</th>
                                            <th>Total</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($compras as $compra)
                                            <tr>
                                                <td>
                                                    <p class="fw-semibold mb-1 text-dark fs-7 p-0">{{ $compra->comprobante->tipo_comprobante }}</p>
                                                    <p class="text-muted mb-0 fs-7 p-0">{{ $compra->numero_comprobante}}</p>
                                                </td>
                                                <td>
                                                    <p class="fw-semibold mb-1 text-dark fs-7 p-0">{{ ucfirst($compra->proveedore->persona->tipo_persona) }}</p>
                                                    <p class="text-muted mb-0 fs-7 p-0">{{ $compra->proveedore->persona->razon_social }}</p>

                                                </td>
                                                <td>
                                                    {{
                                                        \Carbon\Carbon::parse($compra->fecha_hora)->isoFormat('dddd, D [de] MMMM [de] YYYY') . ' - ' . \Carbon\Carbon::parse($compra->fecha_hora)->isoFormat('hh:mm:ss A')
                                                    }}
                                                </td>
                                                <td>{{ $compra->total }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="acciones">
                                                        <form action="{{ route('compras.show', ['compra' => $compra]) }}" method="get">
                                                            @csrf
                                                            <button type="submit" class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye
                                                                "></i>
                                                            </button>
                                                        </form>
                                                        <button type="button" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash
                                                            "></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

    </div>
@endsection

@push('js')
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('vendor/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
    @if (session('success'))
        <script defer>
            $(document).ready(function() {
                let message = "{{ session('success') }}";
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "success",
                title: message,
                });
            });
        </script>
    @endif
@endpush
