@extends('template')

@section('title', 'Realizar Venta')

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
            <h1 class="h3 mb-0 text-gray-800">Ventas</h1>
            <ol class="breadcrumb mb-4 fs-7 bg-transparent">
                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                <li class="breadcrumb-item "><a href="{{ route('compras.index') }}">Ventas</a></li>
                <li class="breadcrumb-item active">Realizar Venta</li>
            </ol>
        </div>
    </div>
    <form action="{{ route('ventas.store') }}" method="post">
        @csrf
        <div class="container mt-4">
            <div class="row gy-4">
                <div class="col-md-8">
                    <div class="text-white bg-primary p-1 text-center">
                        Detalles de la venta
                    </div>
                    <div class="p-3 border border-3 border-primary">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label for="producto_id" class="form-label">Producto:</label>
                                <select class="form-control selectpicker show-tick" data-live-search="true" data-size="1" id="producto_id" name="producto_id" title="selecciona un producto">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}-{{ $producto->stock }}-{{ $producto->precio_venta }}">{{ $producto->codigo.' - '.$producto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <div class="col-md-6 mb-2">
                                    <div class="row">
                                        <label for="stock" class="form-label col-sm-4">En stock:</label>
                                        <div class="col-sm-8">
                                            <input id="stock" class="form-control" type="text" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="precio_venta" class="form-label">Precio de Venta:</label>
                                <input type="number" class="form-control" id="precio_venta" name="precio_venta" disabled value="">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label for="descuento" class="form-label">Descuento:</label>
                                <input type="number" class="form-control" id="descuento" name="descuento" value="">
                            </div>
                            <div class="col-md-12 my-2 text-center">
                                <button id="btn_agregar" type="button" class="btn btn-primary">Agregar</button>
                            </div>

                            <div class="col-md-12">
                                <div class="table-responsive table-borderless">
                                    <table id="tabla-detalle" class="table table-hover">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Venta</th>
                                                <th>Descuento</th>
                                                <th>Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot class="fw-bolder text-dark">
                                            <tr>
                                                <th colspan="4"></th>
                                                <th colspan="2">Subtotal</th>
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
                                <button type="button" id="btn_cancel_buy" data-bs-toggle="modal" data-bs-target="#confirmModal" class="btn btn-danger">Cancelar Venta</button>
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
                                <label for="cliente_id" class="form-label">Cliente:</label>
                                <select class="form-control selectpicker show-tick"  data-live-search="true" data-size="2" id="cliente_id" name="cliente_id" title="selecciona un cliente" required>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->persona->razon_social }}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
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
                                <input type="text" class="form-control" id="numero_comprobante" name="numero_comprobante" value="{{ $numero }}" readonly>
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

                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" />

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
                    ¿Estas seguro que deseas Cancelar la Venta?
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
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script>
        // var productos = [];
        $(document).ready(function() {
            $('#producto_id').change(mostrarValores);

            $('#btn_agregar').click(function() {
                agregarProducto();
            });

            $('#btn_confirm_cancel').click(function() {
                $('#tabla-detalle tbody').empty();
                // retornarElementos();
                calcularTotales();
            });

        });

        // const retornarElementos = function()
        // {
        //     for (key in productos)
        //     {
        //         $('#producto_id').append('<option value="'+key+'">'+productos[key]+'</option>');
        //     }
        //     productos = [];
        //     $('#producto_id').selectpicker('refresh');
        // }

        const agregarProducto = function()
        {
            let valor = $('#producto_id').val();
            // productos[valor] =  $('#producto_id option:selected').text();
            let producto = $('#producto_id').val().split('-');
            let producto_id = producto[0];
            let producto_nombre = $('#producto_id option:selected').text();
            let cantidad = $('#cantidad').val();
            let precio_venta = $('#precio_venta').val();
            let descuento = $('#descuento').val();
            let stock = $('#stock').val();

            if(descuento == '') descuento = 0;

            descuento = parseFloat(descuento).toFixed(2);

            if(producto_id != '' && cantidad != '' && cantidad > 0 && precio_venta != '')
            {
                if(parseInt(stock) >= parseInt(cantidad))
                {
                    let subtotal = cantidad * precio_venta - descuento;
                    let fila = '<tr class="text-center" id="fila'+producto_id+'">'+
                                    '<td><input type="hidden" name="arrayProductos[]" value="'+producto_id+'"/>'+producto_id+'</td>'+
                                    '<td><input type="hidden" name="arrayProductoNombre[]" value="'+producto_nombre+'"/>'+producto_nombre+'</td>'+
                                    '<td><input type="hidden" name="arrayCantidad[]" value="'+cantidad+'"/>'+cantidad+'</td>'+
                                    '<td><input type="hidden" name="arrayPrecioVenta[]" value="'+precio_venta+'"/>$'+precio_venta+'</td>'+
                                    '<td><input type="hidden" name="arrayDescuento[]" value="'+descuento+'"/> -$'+descuento+'</td>'+
                                    '<td>'+subtotal+'</td>'+
                                    '<td><button type="button" class="btn btn-danger btn-sm" onclick="eliminar('+producto_id+')"><i class="fa fa-trash"> </i></button></td>'+
                                '</tr>';
                    $('#tabla-detalle tbody').append(fila);
                    // removerElemento(valor);
                    calcularTotales();
                    limpiarCampos();
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La cantidad a vender supera el stock del producto',
                    });
                }
            }
            else
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Debe completar todos los campos del detalle de la venta',
                });
            }

        }

        const removerElemento = function(valor)
        {
            $('#producto_id').find('[value="'+valor+'"]').remove();
            $('#producto_id').selectpicker('render');
        }

        const limpiarCampos = function()
        {
            $('#producto_id').selectpicker('val', '');
            $('#cantidad').val('');
            $('#precio_venta').val('');
            $('#descuento').val('');
        }

        const eliminar = function(producto_id)
        {
            $('#fila'+producto_id).remove();
            calcularTotales();
        }


        const calcularTotales = function()
        {
            let sumas = 0;
            let iva = 0;
            let total = 0;
            let impuesto = 0.16;

            $('#tabla-detalle tbody tr').each(function(){
                total += parseFloat($(this).find('td:eq(5)').text());
            });

            sumas = total * (1-impuesto);
            iva = total - sumas;

            $('#sumas').text(sumas.toFixed(2));
            $('#iva').text(iva.toFixed(2));
            $('#total').text(total.toFixed(2));
            $('#impuesto').val(iva.toFixed(2));
            $('#inputTotal').val(total.toFixed(2));
        }

        const mostrarValores = function()
        {
            let producto = $('#producto_id').val().split('-');
            $('#precio_venta').val(producto[2]);
            $('#stock').val(producto[1]);
        }
    </script>

@endpush
