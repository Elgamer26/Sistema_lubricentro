<script type="text/javascript" src="../ADMIN/js/producto.js"></script>

<section class="content-header">
    <h1>
        <b> Listado de compras <i class="fa fa-cubes"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de compras</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de compras </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tbla_ingresos" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Proveedor</th>
                            <th>Fecha ingreso</th>
                            <th>Tipo comprobante</th>
                            <th>Iva %</th>
                            <th>Numero de comprobante</th>
                            <th>Total del ingreso</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Proveedor</th>
                            <th>Fecha ingreso</th>
                            <th>Tipo comprobante</th>
                            <th>Iva %</th>
                            <th>Numero de comprobante</th>
                            <th>Total del ingreso</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal para el listado de los proveedores -->
<div class="modal fade" id="modal__lista_prroductos_detalle" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"><b><i class="fa fa-list"></i> Listado detalle de ingreso</b></h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <table id="tabla_productos_agg_ingrso" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Caja</th>
                                    <th>Unidad</th>
                                    <th>Precio</th>
                                    <th>Descuento</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                   <th>Producto</th>
                                    <th>Tipo</th>
                                    <th>Marca</th>
                                    <th>Caja</th>
                                    <th>Unidad</th>
                                    <th>Precio</th>
                                    <th>Descuento</th>
                                    <th>Total</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button id="cerraraa" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close" style=" font-size: 20px;"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- ///////////////////este formulario es para anular la compra -->
<form autocomplete="false" id="form_anular_compra">
    <div class="modal fade" id="modal_anular_compra" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #dd4b39; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-times"></i> Anular compra</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="number" id="id_compra_anular">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="motivo_anular">Motivo para anular la compra</label>
                                <textarea class="form-control" id="motivo_anular_compra" cols="3" rows="3" style="resize: none;"></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close" style="font-size: 20px;"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="anular_ingreso();"><i class="fa fa-save"></i> Anular</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
      listar_ingreso();
</script>