<script type="text/javascript" src="../ADMIN/js/servicio.js"></script>

<section class="content-header">
    <h1>
        <b> Marca de vehiculo <i class="fa fa-cube"></i> </b> <button class="btn btn-danger" onclick="nueva_marca();"><i class="fa fa-plus"></i> Nueva marca</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Marca de vehiculo</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Marca de vehiculo </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_marca" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_marca" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo marca</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="marcah_vehiculo">Nombre de marca</label>
                        <input type="text" maxlength="150" class="form-control" id="marcah_vehiculo" placeholder="Ingrese marca" onkeypress="return soloLetras(event)"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_marcaa()"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_servicio" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar marca vehiculo</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="text" id="id_marca">

                    <div class="col-lg-12">
                        <label for="marcah_vehc_edit">servicio</label>
                        <input type="text" maxlength="150" class="form-control" id="marcah_vehc_edit" placeholder="Ingrese marca" onkeypress="return soloLetras(event)"><br>
                    </div> 

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_marca_vehocuo()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_marcha_vehiculo();

    function nueva_marca() {
        document.getElementById("marcah_vehiculo").value = "";
        $("#modal_marca").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_marca").modal("show");
    }
</script>