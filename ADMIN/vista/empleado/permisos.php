<script type="text/javascript" src="../ADMIN/js/empleado.js"></script>

<section class="content-header">
    <h1>
        <b> Permisos de empleado <i class="fa fa-times"></i> </b> - <button class="btn btn-danger" onclick="muevo_permisoss();"><i class="fa fa-plus"></i> Nuevo permiso</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Permisos de empleado</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de permisos </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_permisos" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>                           
                            <th>Cargo</th>
                            <th>Nombres</th>
                            <th>Fecha</th> 
                            <th>Tipo permiso</th>
                            <th>Observacion</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>#</th>
                            <th>Acci&oacute;n</th>                           
                            <th>Cargo</th>
                            <th>Nombres</th>
                            <th>Fecha</th> 
                            <th>Tipo permiso</th>
                            <th>Observacion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar el usuario-->
<div class="modal fade" id="modal_nuevo_permiso" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-times"></i> Nuevo permiso</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="empleado_id">Empleado</label> &nbsp;&nbsp; <label style="color:red;" id="empleado_obligg"></label>
                        <select class="empleado form-control" id="empleado_id" style="width:100%"></select><br>
                    </div>

                    <br>

                    <div class="col-lg-4"><br>
                        <label for="fecha_ingreso">Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_oblig"></label>
                        <input type="date" class="form-control" id="fecha_ingreso"><br>
                    </div>

                    <div class="col-lg-5"><br>
                        <label for="tipo">Tipo permiso</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_obligg"></label>
                        <select class="form-control" id="tipo" style="width:100%">
                            <option value="Maternidad">Maternidad</option>
                            <option value="Paternidad">Paternidad</option>
                            <option value="Enfermedad">Enfermedad</option>
                            <option value="Medico">Medico</option>
                            <option value="Fallecimiento_familiar">Fallecimiento familiar</option>
                            <option value="Estudios">Estudios</option>
                            <option value="Calamidad">Calamidad</option>
                            <option value="Otros">Otros</option>
                        </select><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="observacion">Observacion</label> &nbsp;&nbsp; <label style="color:red;" id="observacion_obligg"></label>
                        <textarea class="form-control" id="observacion"></textarea><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="regitrar_permiso()"><i class="fa fa-save"></i> Registrar</button>
            </div>

        </div>
    </div>
</div>

<script>
    listar_permisos();

    listar_comob_empplado();
    $(".empleado").select2();

    function muevo_permisoss() {
        $("#modal_nuevo_permiso").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_nuevo_permiso").modal("show");
    }
</script>