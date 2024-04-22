@extends('template')

@section('title', 'Crear Rol')

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
                <h1 class="h3 mb-0 text-gray-800">Editar Rol</h1>
                <ol class="breadcrumb  mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Editar</li>
                </ol>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('roles.update', ['role'=>$role]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-8 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="name" value="{{ old('name', $role->name) }}">
                                    @error('name')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">Permisos</label>
                                        @foreach ($permisos as $permiso)
                                            @if (in_array($permiso->id, $role->permissions->pluck('id')->toArray()))
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" id="prm_{{ $permiso->id }}" type="checkbox" value="{{ $permiso->name }}" name="permission[]" checked>
                                                    <label class="form-check-label" for="prm_{{ $permiso->id }}">
                                                        {{ $permiso->name }}
                                                    </label>
                                                </div>
                                            @else
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" id="prm_{{ $permiso->id }}" type="checkbox" value="{{ $permiso->name }}" name="permission[]">
                                                    <label class="form-check-label" for="prm_{{ $permiso->id }}">
                                                        {{ $permiso->name }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @error('permission')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                                    <button type="reset" class="btn btn-secondary">Reiniciar</button>
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
