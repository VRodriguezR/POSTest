@extends('template')

@section('title', 'Editar Proveedor')

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
                <h1 class="h3 mb-0 text-gray-800">Editar Proveedor</h1>
                <ol class="breadcrumb  mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('proveedores.update', ['proveedore'=> $proveedore]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre" class="form-label">Tipo de Persona:<span class="fw-bold"> {{ strtoupper($proveedore->persona->tipo_persona) }}</span></label>
                                </div>
                                <div class="col-md-12 mb-3" id="box-razon_social">
                                    @if($proveedore->persona->tipo_persona == 'natural')
                                        <label id="label_natural" for="razon_social" class="form-label">Nombre Completo:</label>
                                    @else
                                        <label id="label_juridica" for="razon_social" class="form-label">Nombre de la Empresa:</label>
                                    @endif
                                    <input type="text" class="form-control" id="razon_social" name="razon_social" value="{{ old('razon_social', $proveedore->persona->razon_social)}}"/>
                                    @error('razon_social')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="direccion" class="form-label">Direccion:</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" value="{{ old('direccion', $proveedore->persona->direccion)}}"/>
                                    @error('direccion')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="documento_id" class="form-label">Tipo de Documento:</label>
                                    <select class="form-control" name="documento_id" id="documento_id">
                                        @foreach($documentos as $documento)
                                            @if($documento->id == $proveedore->persona->documento_id)
                                                <option value="{{ $documento->id }}"  {{ old('documento_id') == $documento->id ? selected : '' }} selected>{{ $documento->tipo_documento }}</option>
                                            @else
                                                <option value="{{ $documento->id }}" {{ old('documento_id') == $documento->id ? selected : '' }}>{{ $documento->tipo_documento }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('documento_id')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="numero_documento" class="form-label">Numero de Documento:</label>
                                    <input type="text" class="form-control" id="numero_documento" name="numero_documento" value="{{ old('numero_documento', $proveedore->persona->numero_documento)}}"/>
                                    @error('numero_documento')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary me-2">Cancelar</a>
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

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

@endpush
