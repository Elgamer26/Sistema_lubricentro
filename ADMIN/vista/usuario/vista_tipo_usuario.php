<script type="text/javascript" src="../ADMIN/js/usuario.js"></script>

<section class="content-header">
    <h1>
        <b> Tipo de usuario </b>
        <small> <button onclick="abrir_modal();" class="btn btn-danger" style="width: 100%;"><i class="fa fa-plus"></i> Nuevo tipo usuario</button></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Tipo usuario</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de tipos de usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_tipo_usuario" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo usuario</th>
                            <th>Estado</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tipo usuario</th>
                            <th>Estado</th>
                            <th>Acci&oacute;n</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para regitrar -->
<form autocomplete="false" onsubmit="return false" id="form_tipo_usuario">
    <div class="modal fade" id="modal_registro_tipo_usuario" role="dialog">
        <div class="modal-dialog modal-ml">
            <div class="modal-content">
                <div class="modal-header" style="background: #00a65a; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo tipo usuario</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <label for="usuario">Nuvo tipo de usuario</label>
                            <input type="text" class="form-control" id="tipo_usuario" placeholder="Ingrese tipo de usuario" onkeypress="return soloLetras(event)"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="button" class="btn btn-success" onclick="registar_tipo_usuario()"><i class="fa fa-save"></i> Registrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- ///////////////////este formulario es para editar -->
<form autocomplete="false" onsubmit="return false" id="form_tipo_usuario_edit">
    <div class="modal fade" id="modal_ediatr_tipo_usuario" role="dialog">
        <div class="modal-dialog modal-ml">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> editar tipo usuario</h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" id="id_tipo_user" hidden>
                            <label for="tipo_usuario_edit">tipo de usuario</label>
                            <input type="text" class="form-control" id="tipo_usuario_edit" placeholder="Ingrese tipo de usuario" onkeypress="return soloLetras(event)"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button id="editr_tipo_usu" type="button" class="btn btn-primary" onclick="editar_tipo_usuario()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $("#modal_registro_tipo_usuario").on('shown.bs.modal', function() {
        $("#tipo_usuario").trigger("focus");
    })

    $("#modal_ediatr_tipo_usuario").on('shown.bs.modal', function() {
        $("#tipo_usuario_edit").trigger("focus");
    })

    listar_tipo_usuario();
</script>