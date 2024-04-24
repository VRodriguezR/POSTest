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
                <h1 class="h3 mb-0 text-gray-800">Proveedores</h1>
                <ol class="breadcrumb mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Proveedores</li>
                </ol>
            </div>
            <a href="{{ route('proveedores.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Añadir Proveedor
                </button>
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listado de Proveedores</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered stripe" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="table-info text-dark fw-bolder">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Direccion</th>
                                            <th>Tipo de Documento</th>
                                            <th>Numero de Documento</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($proveedores as $proveedore)
                                            <tr>
                                                <td>{{ $proveedore->persona->razon_social }}</td>
                                                <td>{{ $proveedore->persona->direccion }}</td>
                                                <td>{{ $proveedore->persona->documento->tipo_documento }}</td>
                                                <td>{{ $proveedore->persona->numero_documento }}</td>
                                                <td>
                                                    @if ($proveedore->persona->estado == 1)
                                                        <span class="badge badge-success rounded-pill d-inline text-white">Activo</span>
                                                    @else
                                                        <span class="badge badge-danger rounded-pill d-inline text-white">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Grupo">
                                                        <a href="{{ route('proveedores.edit', ['proveedore'=> $proveedore]) }}" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if ($proveedore->persona->estado == 1)
                                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$proveedore->persona->id}}" >
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$proveedore->persona->id}}" >
                                                                <i class="fas fa-trash-restore"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade"
                                                id="deleteModal-{{$proveedore->persona->id}}"
                                                tabindex="-1"
                                                aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{ ($proveedore->persona->estado ==1)? 'Eliminar' : 'Restaurar' }} Proveedor</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body
                                                            text-center">
                                                            @if ($proveedore->persona->estado == 1)
                                                                <p>¿Estas seguro de dar de baja el proveedor?</p>
                                                            @else
                                                                <p>¿Estas seguro de restaurar el proveedor?</p>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('proveedores.destroy', ['proveedore'=> $proveedore->persona->id]) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="btn btn-danger">Confirmar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    @elseif (session('error'))
        <script defer>
            $(document).ready(function() {
                let message = "{{ session('error') }}";
                const Alert = Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: message,
                });
            });
        </script>
    @endif
@endpush
