@extends('template')

@section('title', 'Editar Categoria')

@push('css')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        #descripcion {
            resize: none;
        }
    </style>
@endpush

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="col-md-8">
                <h1 class="h3 mb-0 text-gray-800">Editar Categoria</h1>
                <ol class="breadcrumb  mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categorias.index') }}">Categorias</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('categorias.update', ['categoria'=> $categoria]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $categoria->caracteristica->nombre) }}">
                                    @error('nombre')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="descripcion" class="form-label">Descripcion</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $categoria->caracteristica->descripcion)}}</textarea>
                                    @error('descripcion')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary ms-auto">Cancelar</a>
                                    <button type="reset" class="btn btn-info mx-2">Reiniciar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
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

@endpush
