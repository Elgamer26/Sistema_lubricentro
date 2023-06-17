<script type="text/javascript" src="../ADMIN/js/empleado.js"></script>

<section class="content-header">
    <h1>
        <b> Asistencias del empleado <i class="fa fa-clock-o"></i> </b> - <button class="btn btn-danger" onclick="nueva_asistencia();"><i class="fa fa-plus"></i> Marcar asistencia</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Asistencias del empleado</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de asistencias </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_asistecnia" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cargo</th>
                            <th>Nombres</th>
                            <th>Fecha</th>
                            <th>Hora ingreso</th>
                            <th>Hora salida</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cargo</th>
                            <th>Nombres</th>
                            <th>Fecha</th>
                            <th>Hora ingreso</th>
                            <th>Hora salida</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- ///////////////////este formulario es para editar el usuario-->
<div class="modal fade" id="modal_marcar_asistenia" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-clock-o"></i> Asistencia del empleado</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input id="id_empleado" hidden>

                    <div class="col-lg-9">
                        <label for="empleado_id">Empleado</label> &nbsp;&nbsp; <label style="color:red;" id="empleado_obligg"></label>
                        <select class="empleado form-control" id="empleado_id" style="width:100%"></select>
                    </div>

                    <div class="col-lg-3">
                        <label for="fecha_ingreso">Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_oblig"></label>
                        <input type="date" class="form-control" id="fecha_ingreso"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="hotra_ingreso">Hora ingreso</label> &nbsp;&nbsp; <label style="color:red;" id="hora_ingreso_obligg"></label>
                        <input type="time" class="form-control" id="hotra_ingreso"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="hotra_salida">Hora salida</label> &nbsp;&nbsp; <label style="color:red;" id="hora_salida_obligg"></label>
                        <input type="time" class="form-control" id="hotra_salida"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="estado">Estado de asistencia</label> &nbsp;&nbsp; <label style="color:red;" id="ESTADO_OLBGG"></label>
                        <select class="form-control" id="estado" style="width:100%">
                            <option value="Asistio">Asistio</option>
                            <option value="Falto">Falto</option>
                        </select><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="regitrar_asistencia()"><i class="fa fa-save"></i> Registrar</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_asistenia" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-clock-o"></i> Editar asistencia del empleado</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input id="id_asistencia" hidden>

                    <div class="col-lg-4">
                        <label for="fecha_ingreso">Fecha</label>
                        <input type="date" class="form-control" id="edit_fecha_ingreso"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="hotra_ingreso">Hora ingreso</label>
                        <input type="time" class="form-control" id="edit_hotra_ingreso"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="hotra_salida">Hora salida</label>
                        <input type="time" class="form-control" id="edit_hotra_salida"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="estado">Estado de asistencia</label> 
                        <select class="form-control" id="edit_estado" style="width:100%">
                            <option value="Asistio">Asistio</option>
                            <option value="Falto">Falto</option>
                        </select><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_asistencia()"><i class="fa fa-edit"></i> Editar</button>
            </div>

        </div>
    </div>
</div>

<script>
    listar_asistencias();

    listar_comob_empplado();
    $(".empleado").select2();

    function nueva_asistencia() {
        $("#modal_marcar_asistenia").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_marcar_asistenia").modal("show");
    }
</script>