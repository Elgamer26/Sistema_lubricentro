<script type="text/javascript" src="../ADMIN/js/sytem.js"></script>

<section class="content-header">
    <h1>
        <b> Respaldo de datos <i class="fa fa-database"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Respaldo de datos</a></li>
    </ol>
    <br>
    <button class="btn btn-danger" onclick="ver_modal_respaldo();"><i class="fa fa-plus"></i> Respaldo</button>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Respaldo de datos </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tbla_respaldp" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th> 
                            <th>Usuario</th>
                            <th>Hora y fecha</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th> 
                            <th>Usuario</th>
                            <th>Hora y fecha</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar los permiso -->
<div class="modal fade" id="model_respando_datos" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-key"></i> Crear respaldo de datos</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="ingres_pass">Ingrese password</label>
                        <input type="password" class="form-control" id="ingres_pass" placeholder="Ingrese el password"><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="conf_pass">confirme password</label>
                        <input type="password" class="form-control" id="conf_pass" placeholder="Confirme el password"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="realizar_respaldo()"><i class="fa fa-database"></i> Crear</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_respaldo();
</script>