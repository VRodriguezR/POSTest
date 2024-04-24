@extends('template')

@section('tite', 'Perfil de Usuario')

@push('css')
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/css/sweetalert2.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-0 text-gray-800">Perfil de Usuario</h1>
        <ol class="breadcrumb mb-4 fs-7 bg-transparent">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Perfil</li>
        </ol>
            <div class="card border-primary">
                <div class="card-header bg-primary text-light">
                    Datos Generales.
                </div>
                <div class="card-body">
                    <form action="{{route('profile.update', ['profile' => $user ])}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-muted"><i class="fas fa-user" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control bg-muted" value="Nombre:" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                    </div>
                                </div>
                        </div>
                        <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-muted"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control bg-muted" value="Correo Electrónico:" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                        </div>
                        <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-muted"><i class="fas fa-key" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control bg-muted" value="Contraseña:" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>
                        </div>
                        <div class="row mb-2">
                                <div class="col-sm-4">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-muted"><i class="fas fa-key" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control bg-muted" value="Confirmar Contraseña:" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                                    </div>
                                </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-muted"><i class="fas fa-venus-mars" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control bg-muted" value="Genero:" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="M" @selected(old('gender') == 'M') {{($user->gender == 'M') ? 'selected' : ''}}>Masculino</option>
                                        <option value="F" @selected(old('gender') == 'F') {{($user->gender == 'F') ? 'selected' : ''}}>Femenino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-muted"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control bg-muted" value="Fecha de Nacimiento:" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $user->birthday }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-muted"><i class="fas fa-phone-square-alt" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control bg-muted" value="Telefono:" disabled>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="phone" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>

                    </form>
                    @if ($errors->any())
                        <hr>
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>

        </div>
    </div>
@endsection

@push('js')
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
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
