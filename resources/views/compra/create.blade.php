@extends('template')

@section('title', 'Crear Compra')

@push('css')
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bselect/bootstrap-select.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">Compras</h1>
            <ol class="breadcrumb mb-4 fs-7 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item "><a href="{{ route('compras.index') }}">Compras</a></li>
                <li class="breadcrumb-item active">Crear Compra</li>
            </ol>
        </div>
    </div>
    <form action="{{ route('compras.store') }}" method="post">
        @csrf
        <div class="container mt-4">
            <div class="row gy-4">
                <div class="col-md-8">
                    <div class="text-white bg-primary p-1 text-center">
                        Detalles de la compra
                    </div>
                    <div class="p-3 border border-3 border-primary">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="producto_id" class="form-label">Producto:</label>
                                <select class="form-control selectpicker show-tick" data-live-search="true" data-size="1" id="producto_id" name="producto_id" title="selecciona un producto">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->codigo.' - '.$producto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="precio_compra" class="form-label">Precio de Compra:</label>
                                <input type="number" class="form-control" id="precio_compra" name="precio_compra" value="">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="precio_venta" class="form-label">Precio de Venta:</label>
                                <input type="number" class="form-control" id="precio_venta" name="precio_venta" value="">
                            </div>
                            <div class="col-md-12 my-2 text-center">
                                <button id="btn_agregar" type="button" class="btn btn-primary">Agregar</button>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tabla-detalle" class="table table-hover">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Compra</th>
                                                <th>Precio Venta</th>
                                                <th>Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot class="fw-bolder text-dark">
                                            <tr>
                                                <th colspan="4"></th>
                                                <th colspan="2">Sumas</th>
                                                <th id="sumas">0</th>
                                            </tr>
                                            <tr>
                                                <th colspan="4"></th>
                                                <th colspan="2">IVA %</th>
                                                <th id="iva">0</th>
                                            </tr>
                                            <tr>
                                                <th colspan="4"></th>
                                                <th colspan="2">Total</th>
                                                <th><input type="hidden" id="inputTotal" name="total" value="0" /><span id="total">0</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <button type="button" id="btn_cancel_buy" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-danger">Cancelar Compra</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                <div class="text-white bg-success p-1 text-center">
                        Datos generales
                    </div>
                    <div class="p-3 border border-3 border-success">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="proveedore_id" class="form-label">Proveedor:</label>
                                <select class="form-control selectpicker show-tick"  data-live-search="true" data-size="2" id="proveedore_id" name="proveedore_id" title="selecciona un proveedor" required>
                                    @foreach ($proveedores as $proveedore)
                                        <option value="{{ $proveedore->id }}">{{ $proveedore->persona->razon_social }}</option>
                                    @endforeach
                                </select>
                                @error('proveedore_id')
                                    <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="comprobante_id" class="form-label">Comprobante:</label>
                                <select class="form-control selectpicker show-tick" id="comprobante_id" name="comprobante_id" title="selecciona un comprobante" required>
                                    @foreach ($comprobantes as $comprobante)
                                        <option value="{{ $comprobante->id }}">{{ $comprobante->tipo_comprobante }}</option>
                                    @endforeach
                                </select>
                                @error('comprobante_id')
                                    <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="numero_comprobante" class="form-label">Numero de Comprobante:</label>
                                <input type="text" class="form-control" id="numero_comprobante" name="numero_comprobante" value="{{ old('numero_comprobante') }}" required>
                                @error('numero_comprobante')
                                    <span class="text-danger fs-7">{{ '*'.$message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="impuesto" class="form-label">Impuesto:</label>
                                <input type="text" class="form-control" id="impuesto" name="impuesto" value="{{ old('impuesto') }}" readonly>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="fecha" class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ date('Y-m-d') }}" readonly>
                                <?php
                                    use Carbon\Carbon;
                                    $mytime = Carbon::now()->toDateTimeString();
                                ?>
                                <input type="hidden" name="fecha_hora" value="{{ $mytime }}" />
                            </div>

                            <div class="col-md-12 my-2 text-center">
                                <button type="submit" id="btn_save_buy" class="btn btn-success">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Mensaje de Confirmacion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estas seguro que deseas Cancelar la compra?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btn_confirm_cancel">Confirmar</button>
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

    <script src="{{ asset('vendor/sweetalert2/js/sweetalert2.all.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
        var cont = 1;
        var total = 0;
        var iva = 0;
        var subtotal = [];
        var sumas = 0;

        const impuesto = 16;

        function agregarProducto()
        {
            let producto_id = $('#producto_id').val();
            let producto_text = $('#producto_id option:selected').text();
            producto_text = producto_text.split('-')[1].trim();
            let cantidad = $('#cantidad').val();
            let precio_compra = $('#precio_compra').val();
            let precio_venta = $('#precio_venta').val();

            subtotal[cont] = parseInt(cantidad) * parseFloat(precio_compra);
            sumas += subtotal[cont];
            iva = sumas * impuesto / 100;
            total = sumas + iva;

            let fila = '<tr id="fila'+cont+'">'+
                            '<td class="fw-bold">'+cont+'</td>'+
                            '<td><input type="hidden" name="arrayIdProducto[]" value="'+producto_id+'" />'+producto_text+'</td>'+
                            '<td><input type="hidden" name="arrayCantidad[]" value="'+cantidad+'" />'+cantidad+'</td>'+
                            '<td><input type="hidden" name="arrayPrecioCompra[]" value="'+precio_compra+'" />'+precio_compra+'</td>'+
                            '<td><input type="hidden" name="arrayPrecioVenta[]" value="'+precio_venta+'" />'+precio_venta+'</td>'+
                            '<td>'+cantidad*precio_compra+'</td>'+
                            '<td><button type="button" onclick="eliminarProducto('+cont+')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></td>'+
                        '</tr>';
            $('#tabla-detalle tbody').append(fila);
            clear();
            cont++;

            showTotals();
            disableButtons();
        }

        function showTotals()
        {
            $('#sumas').text(sumas.toFixed(2));
            $('#iva').text(iva.toFixed(2));
            $('#total').text(total.toFixed(2));
            $('#inputTotal').val(total.toFixed(2));
            $('#impuesto').val(iva.toFixed(2));
        }

        function eliminarProducto(id)
        {
            sumas -= subtotal[id];
            subtotal.splice(id, 1);
            iva = sumas * impuesto / 100;
            total = sumas + iva;
            $('#sumas').text(sumas.toFixed(2));
            $('#iva').text(iva.toFixed(2));
            $('#total').text(total.toFixed(2));
            $('#fila'+id).remove();
            disableButtons();
        }

        function valida()
        {
            let producto_id = $('#producto_id').val();
            let cantidad = $('#cantidad').val();
            let precio_compra = $('#precio_compra').val();
            let precio_venta = $('#precio_venta').val();
            if(producto_id == '')
                return {status: 'error', message: 'Debe seleccionar un producto'};
            if(cantidad == '' || cantidad <= 0)
                return {status: 'error', message: 'Debe ingresar una cantidad'};
            if(cantidad % 1 != 0)
                return {status: 'error', message: 'La cantidad debe ser un número entero'};
            if(parseFloat(precio_compra) > parseFloat(precio_venta))
                return {status: 'error', message: 'El precio de compra no puede ser mayor al precio de venta'};
            if(precio_compra == '' || precio_compra <= 0)
                return {status: 'error', message: 'Debe ingresar un precio de compra'};
            if(precio_venta == '' || precio_venta <= 0)
                return {status: 'error', message: 'Debe ingresar un precio de venta'};
            return {status: 'success', message: ''};
        }

        function disableButtons()
        {
            if(total == 0)
            {
                $('#btn_save_buy').attr('disabled', true);
                $('#btn_cancel_buy').attr('disabled', true);
            }
            else
            {
                $('#btn_save_buy').attr('disabled', false);
                $('#btn_cancel_buy').attr('disabled', false);
            }
        }

        function cancelarCompra()
        {
            $('#tabla-detalle tbody').empty();
            cont = 1;
            total = 0;
            iva = 0;
            subtotal = [];
            sumas = 0;
            showTotals();
            disableButtons();
        }

        function clear()
        {
            $('#producto_id').selectpicker('val','');
            $('#cantidad').val('');
            $('#precio_compra').val('');
            $('#precio_venta').val('');
        }

        $(document).ready(function() {
            $('#impuesto').val(0);
            disableButtons();
            $('#btn_agregar').click(
                function(){
                    let validar = valida();
                    if(validar.status == 'success')
                        agregarProducto();
                    else
                        swal.fire({
                            title: 'Error',
                            text: validar.message,
                            icon: 'error'
                        });
                }
            );

            $('#btn_confirm_cancel').click(
                function(){
                    cancelarCompra();
                }
            );


        });
    </script>

@endpush
