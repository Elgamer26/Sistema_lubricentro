<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<style>
    input[type="checkbox"] {
        position: relative;
        width: 60px;
        height: 30px;
        -webkit-appearance: none;
        background: rgb(168, 168, 168);
        outline: none;
        border-radius: 15px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .5);
    }

    input:checked[type="checkbox"] {
        background: rgb(0, 123, 255);
    }

    input[type="checkbox"]:before {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: white;
        transition: 0.5s;

    }

    input:checked[type="checkbox"]:before {
        left: 30px;
    }
</style>

<script type="text/javascript" src="../ADMIN/js/producto.js"></script>

<section class="content-header">
    <h1>
        <b> Productos en ofertas <i class="fa fa-gift"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Productos en ofertas</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Productos en ofertas </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-lg-10"> <label for="codigo_prod">Buscar producto...</label>
                        <div class="input-group input-group-sm">
                            <input type="text" id="buscar_prod" class="form-control" placeholder="Ingrese el codigo o nombre del producto">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-2"> <label>Nueva oferta</label>
                        <button class="btn btn-danger" onclick="nueva_oferta();"><i class="fa fa-plus"></i> Nuevo oferta</button>
                    </div>

                    <br> <br> <br>

                    <!-- <div class="col-lg-12"> <label>Total de productos: <span id="total_pro_n_promo"></span></label> </div> -->

                    <div class="col-lg-12">
                        <div id="unir_inve">

                        </div><br>
                    </div>

                    <div class="col-lg-12">
                        <center>
                            <ul class='pagination' id="paguination"></ul>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_ofertas_new" role="dialog">
    <div class="modal-dialog modal-ml">
        <div class="modal-content">
            <div class="modal-header" style="background: #00a65a; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-cube"></i> Nueva oferta</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12" style="text-align: center;">

                        <div class="col-lg-12">
                            <label for="producto_id">Seleccione el producto</label> &nbsp;&nbsp; <label style="color:red;" id="producto_obligg"></label>
                            <select class="producto_select form-control" id="producto_id" style="width:100%"></select><br><br>
                        </div><br>
                        <br>
                        <div class="col-lg-6">
                            <label for="fecha_inic">Fecha inicio</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_i"></label>
                            <input type="date" readonly class="form-control" id="fecha_inic" value="<?php echo $fecha; ?>"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="fecha_fin">Fecha Fin</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_f"></label>
                            <input type="date" class="form-control" id="fecha_fin" value="<?php echo $fecha; ?>"><br>
                        </div>

                        <div class="col-lg-12">
                            <label for="nombre_oferta">Nombre de la oferta</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_olbigg"></label>
                            <input type="text" maxlength="75" class="form-control" id="nombre_oferta" placeholder="Ingrese un nombre oferta" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="tipo_descue">Tipo de promocion</label>
                            <select class="select2_empe form-control" id="tipo_descue" style="width:100%">
                                <option value="Descuento">Descuento %</option>
                            </select><br>
                            <label></label>
                        </div>

                        <div class="col-lg-6">
                            <label for="procentaje">Ingrese el pocentaje %</label> &nbsp;&nbsp; <label style="color:red;" id="porcent_obligg"></label>
                            <input type="text" maxlength="2" class="form-control" id="procentaje" placeholder="Ingrese un procentaje" onkeypress="return soloNumeros(event)"><br>
                        </div>


                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button id="save_promo" hidden class="btn btn-success" onclick="registra_oferta()"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para destacar -->
<div class="modal fade" id="modl_editar_oferta" role="dialog">
    <div class="modal-dialog modal-ml">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar oferta</h4>
            </div>

            <div class="modal-body">

                <input id="oferta_id" type="hidden">

                <div class="row">

                    <div class="col-lg-12" style="text-align: center;">

                        <div class="col-lg-6">
                            <label for="fecha_inic_edit">Fecha inicio</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_i_edit"></label>
                            <input type="date" readonly class="form-control" id="fecha_inic_edit"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="fecha_fin_edit">Fecha Fin</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_f_edit"></label>
                            <input type="date" class="form-control" id="fecha_fin_edit"><br>
                        </div>

                        <div class="col-lg-12">
                            <label for="nombre_oferta_edit">Nombre de la oferta</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_olbigg_edit"></label>
                            <input type="text" maxlength="75" class="form-control" id="nombre_oferta_edit" placeholder="Ingrese un nombre oferta" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="tipo_descue_edit">Tipo de promocion</label>
                            <select class="select2_empe form-control" id="tipo_descue_edit" style="width:100%">
                                <option value="Descuento">Descuento %</option>
                            </select><br>
                            <label></label>
                        </div>

                        <div class="col-lg-6">
                            <label for="procentaje_edit">Ingrese el pocentaje %</label> &nbsp;&nbsp; <label style="color:red;" id="porcent_obligg_edit"></label>
                            <input type="text" maxlength="2" class="form-control" id="procentaje_edit" placeholder="Ingrese un procentaje" onkeypress="return soloNumeros(event)"><br>
                        </div>

                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button hidden class="btn btn-success" onclick="editar_oferta_save()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    pagination(1);

    $(".producto_select").select2();
    listar_productos_ofertas();

    function nueva_oferta() {

        $("#nombre_oferta").val("");
        $("#procentaje").val("");

        $("#modal_ofertas_new").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_ofertas_new").modal("show");
    }
</script>