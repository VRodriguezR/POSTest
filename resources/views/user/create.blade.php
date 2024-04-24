@extends('template')

@section('title', 'Crear Usuario')

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
                <h1 class="h3 mb-0 text-gray-800">Crear Usuario</h1>
                <ol class="breadcrumb  mb-4 fs-7 bg-transparent">
                    <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">Crear</li>
                </ol>
            </div>
        </div>
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-8 mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                                    <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                                    @error('password_confirm')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="birthday" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{ old('birthday')}}">
                                    @error('birthday')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="phone" class="form-label">Teléfono</label>
                                    <input type="phone" class="form-control" id="phone" name="phone" value="{{ old('phone')}}">
                                    @error('phone')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-8 mb-3">
                                    <label for="gender" class="form-label">Genero</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option selected>Seleccionar...</option>
                                        <option value="M" @selected(old('gender') == 'M')>Masculino</option>
                                        <option value="F" @selected(old('gender') == 'F')>Femenino</option>
                                    </select>
                                        @error('gender')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label for="role" class="form-label">Seleccionar Rol</label>
                                    <select class="form-select" id="role" name="role">
                                        <option selected>Seleccionar...</option>
                                        @foreach ($roles as $rol)
                                            <option value="{{ $rol->name }}" @selected(old('role') == $rol->name)>{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancelar</a>
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
