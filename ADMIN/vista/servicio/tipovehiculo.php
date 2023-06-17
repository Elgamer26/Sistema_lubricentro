<script type="text/javascript" src="../ADMIN/js/servicio.js"></script>

<section class="content-header">
    <h1>
        <b> Tipo de vehiculo <i class="fa fa-car"></i> </b> <button class="btn btn-danger" onclick="nuevo_vehiculo();"><i class="fa fa-plus"></i> Nuevo tipo</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Tipo de vehiculo</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Tipo de vehiculo </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_vehiculo" class="display responsive nowrap" style="width:100%">
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

<div class="modal fade" id="modal_vehiculo" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo vehículo</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="tipo_vehiculo">Tipo de vehículo</label>
                        <input type="text" maxlength="150" class="form-control" id="tipo_vehiculo" placeholder="Ingrese tipo de vehículo" onkeypress="return soloLetras(event)"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_vehiculo()"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_vehculo" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar vehículo</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="text" id="id_veiulo">

                    <div class="col-lg-12">
                        <label for="edit_vehiulo">Tipo de vehículo</label>
                        <input type="text" maxlength="150" class="form-control" id="edit_vehiulo" placeholder="Ingrese vehículo" onkeypress="return soloLetras(event)"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_vehiculo()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_vehiculo();

    function nuevo_vehiculo() {
        document.getElementById("tipo_vehiculo").value = "";
        $("#modal_vehiculo").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_vehiculo").modal("show");
    }
</script>