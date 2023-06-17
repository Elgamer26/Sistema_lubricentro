<script type="text/javascript" src="../ADMIN/js/empleado.js"></script>

<section class="content-header">
    <h1>
        <b> Tipos de cargo <i class="fa fa-cubes"></i> </b> <button class="btn btn-danger" onclick="nuevo_cargo();"><i class="fa fa-plus"></i> Nuevo cargo</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Tipos de cargo</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Tipos de cargo </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_cargo" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Tipo cargo</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Tipo cargo</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar el usuario-->
<div class="modal fade" id="modal_nuevo_cargo" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo cargo</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="cargo">Cargo</label>
                        <input type="text" class="form-control" id="cargo" placeholder="Ingrese cargo" onkeypress="return soloLetras(event)"><br>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_carggo()"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_editar_cargo" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar cargo</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden id="id_cargo">

                    <div class="col-lg-12">
                        <label for="cargo_edit">Cargo</label>
                        <input type="text" class="form-control" id="cargo_edit" placeholder="Ingrese cargo" onkeypress="return soloLetras(event)"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_cargo()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_cargo_();
</script>