@extends('template')

@section('title', 'Crear Producto')

@push('css')

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bselect/bootstrap-select.min.css') }}" rel="stylesheet">
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
                <h1 class="h3 mb-0 text-gray-800">Crear Producto</h1>
                <ol class="breadcrumb  mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row g-3">
                                <div class="col-md-4 mb-3">
                                    <label for="codigo" class="form-label fw-bolder">Codigo de Barras:</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}">
                                    @error('codigo')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="nombre" class="form-label fw-bolder">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
                                    @error('nombre')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="descripcion" class="form-label fw-bolder">Descripcion:</label>
                                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion')}}</textarea>
                                    @error('descripcion')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="marca_id" class="form-label fw-bolder">Marcas:</label>
                                    <select name="marca_id" id="marca_id" data-live-search="true" title="Selecciona una marca" data-size="4" class="form-control selectpicker show-tick">
                                        @foreach ($marcas as $marca)
                                            <option value="{{ $marca->id }}" {{ old('marca_id') == $marca->id ? 'selected' : ''}}>{{ $marca->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('marca_id')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="presentacione_id" class="form-label fw-bolder">Presentacion:</label>
                                    <select name="presentacione_id" id="presentacione_id" title="Selecciona una presentacion" data-size="4" data-live-search="true" class="form-control selectpicker show-tick">
                                        @foreach ($presentaciones as $presentacion)
                                            <option value="{{ $presentacion->id }}" {{ old('presentacione_id') == $presentacion->id ? 'selected' : ''}}>{{ $presentacion->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('presentacione_id')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="categoria_id" class="form-label fw-bolder">Categoria:</label>
                                    <select name="categorias[]" id="categoria_id" title="Selecciona las categoria" multiple data-size="4" data-live-search="true" class="form-control selectpicker show-tick">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}" {{ (in_array( $categoria->id, old('categorias', []))) ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('categorias')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_vencimiento" class="form-label fw-bolder">Fecha de Vencimiento:</label>
                                    <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}">
                                    @error('fecha_vencimiento')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="img_path" class="form-label fw-bolder">Imagen:</label>
                                    <input type="file" accept="Image" class="form-control" id="img_path" name="img_path" value="{{ old('img_path') }}">
                                    @error('img_path')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('productos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
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
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/bselect/bootstrap-select.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#marca_id').selectpicker();
            $('#presentacione_id').selectpicker();
            $('#categoria_id').selectpicker();
        });
    </script>
@endpush
