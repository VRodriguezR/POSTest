@extends('template')

@section('title', 'Categorias')

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
                <h1 class="h3 mb-0 text-gray-800">Clientes</h1>
                <ol class="breadcrumb mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>
            </div>
            <a href="{{ route('clientes.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Añadir Cliente
                </button>
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listado de Clientes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered stripe" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="table-info text-dark fw-bolder">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

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
