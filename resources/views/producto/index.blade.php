@extends('template')

@section('title', 'Productos')

@push('css')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/css/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0 text-gray-800">Productos</h1>
                <ol class="breadcrumb mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Productos</li>
                </ol>
            </div>
            <a href="{{ route('productos.create') }}">
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Añadir producto
                </button>
            </a>
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Listado de Productos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered stripe" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="table-info text-dark fw-bolder">
                                        <tr>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Descripcion</th>
                                            <th>Marca</th>
                                            <th>Categoria</th>
                                            <th>Presentacion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td>{{ $producto->codigo }}</td>
                                                <td>{{ $producto->nombre }}</td>
                                                <td>{{ $producto->descripcion }}</td>
                                                <td>{{ $producto->marca->caracteristica->nombre }}</td>
                                                <td>{{ $producto->presentacione->caracteristica->nombre }}</td>
                                                <td>
                                                    @foreach ($producto->categorias as $categoria)
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col">
                                                                <span class="badge bg-primary text-white text-center">{{ $categoria->caracteristica->nombre }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($producto->estado == 1)
                                                        <span class="badge bg-success text-white">Activo</span>
                                                    @else

                                                        <span class="badge bg-danger text-white">Inactivo</span>
                                                    @endif
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('productos.edit', ['producto' => $producto]) }}" class="btn btn-primary">
                                                                <i class="fas fa-edit"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detailModal-{{$producto->id}}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        @if ($producto->estado == 1)
                                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$producto->id}}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        @else
                                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$producto->id}}">
                                                                <i class="fas fa-trash-restore"></i>
                                                            </button>
                                                        @endif
                                                    </div>

                                                </td>
                                            </tr>
                                            <div class="modal fade" id="deleteModal-{{$producto->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Mensaje de Confirmacion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $producto->estado == 1 ? '¿Estas seguro de eliminar este producto?' : '¿Estas seguro de activar este producto nuevamente?'}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form method="POST" action="{{ route('productos.destroy', ['producto'=>$producto->id]) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Confirmar</button>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="detailModal-{{$producto->id}}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="detailModalLabel">Detalles del producto.</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-1">
                                                            <label for=""><span class="fw-bolder" style="font-weight: bolder !important; ">Descripcion:</span> {{$producto->descripcion}}</label>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label for=""><span class="fw-bolder" style="font-weight: bolder !important; ">Fecha de Vencimiento:</span> {{$producto->fecha_vencimiento == '' ? 'N/A' : $producto->fecha_vencimiento}}</label>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <label for=""><span class="fw-bolder" style="font-weight: bolder !important; ">Stock:</span> {{$producto->stock}}</label>
                                                        </div>
                                                        <div class="row mb-1">
                                                            @if($producto->img_path != '')
                                                                <img src="{{ Storage::url('public/productos/'.$producto->img_path) }}" alt="{{ $producto->nombre}}" class="img-fluid img-thumbnail">
                                                            @else
                                                                <img src="{{ Storage::url('public/productos/default.png') }}" alt="{{ $producto->nombre}}" class="img-fluid img-thumbnail">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
