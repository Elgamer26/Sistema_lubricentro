<script type="text/javascript" src="../ADMIN/js/servicio.js"></script>

<section class="content-header">
    <h1>
        <b> Listado de ventas <i class="fa fa-shopping-cart"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de ventas</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de ventas </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tbla_listado_ventas" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Tipo pago</th>
                            <th>Cliente</th>
                            <th>Fecha venta</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Tipo de comprobante</th>
                            <th>Numero de comprobante</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Tipo pago</th>
                            <th>Cliente</th>
                            <th>Fecha venta</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Tipo de comprobante</th>
                            <th>Numero de comprobante</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario editra la venta -->
<form autocomplete="false" onsubmit="return false" id="form_edit_venta">
    <div class="modal fade" id="modal_editar_venta" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-list"></i> Detalle venta</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- /////////////////////// -->

                        <div class="col-lg-12" style="text-align: center;">
                            <h4><b>.:Detalle de productos:.</b> </h4>
                        </div>

                        <div class="col-lg-12 table-responsive">
                            &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                            <table id="detalle_venta_edit" class="table table-striped table-bordered">
                                <thead bgcolor="black" style="color:#fff;">
                                    <tr>
                                        <th>Id</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Desc.% promocion</th>
                                        <th>Tipo promo</th>
                                        <th>Desc. moneda</th>
                                        <th>Subtotal</th>

                                    </tr>
                                </thead>

                                <tbody id="tbody_detalle_prodcuto_venta_edit">
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_totalneto"></label>
                            <input hidden type="text" id=txt_totalneto>
                        </div>


                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_impuesto"></label>
                            <input hidden type="text" id=txt_impuesto>
                        </div>

                        <div class="col-lg-12" style="text-align: right;">
                            <label for="" id="lbl_a_pagar"></label>
                            <input hidden type="text" id=txt_a_pagar>
                        </div> <br>


                    </div>
                </div>

                <div class=" modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close" style="font-size: 20px;"></i> Cerrar</button> 
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listado_ventas();
</script>