<script type="text/javascript" src="../ADMIN/js/servicio.js"></script>

<section class="content-header">
    <h1>
        <b> Tipo de servicio <i class="fa fa-cube"></i> </b> <button class="btn btn-danger" onclick="nuevo_servicio();"><i class="fa fa-plus"></i> Nuevo tipo</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Tipo de servicio</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Tipo de servicio </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_servicio" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Foto</th>
                            <th>Detalle</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>

                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Foto</th>
                            <th>Detalle</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tipo_" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo servicio</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="tipo_servicio">Tipo de servicio</label>
                        <input type="text" maxlength="150" class="form-control" id="tipo_servicio" placeholder="Ingrese tipo de servicio" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="precio_servicio">Precio de servicio</label>
                        <input type="number" maxlength="150" class="form-control" id="precio_servicio" placeholder="Precio tipo de servicio"><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="detalle_ser">Detalle</label>
                        <textarea class="form-control" id="detalle_ser" cols="2" rows="2"></textarea> <br>
                    </div>

                    <div class="col-lg-12">
                        <label for="foto">Foto</label>
                        <input type="file" class="form-control" id="foto"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_servicio()"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_servicio" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar servicios</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="text" id="id_servcio">

                    <div class="col-lg-12">
                        <label for="servici_edit">servicio</label>
                        <input type="text" maxlength="150" class="form-control" id="servici_edit" placeholder="Ingrese servicio" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="precio_servicio_edit">Precio de servicio</label>
                        <input type="number" maxlength="150" class="form-control" id="precio_servicio_edit" placeholder="Precio tipo de servicio"><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="detalle_ser_edit">Detalle</label>
                        <textarea class="form-control" id="detalle_ser_edit" cols="2" rows="2"></textarea> <br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_servicioo()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_foto" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #f39c12; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-image"></i> Editar foto del servicio</h4>
            </div>

            <div class="modal-body">

                <div class="row">
                    <input type="number" id="id_prod_foto" hidden>
                    <div class="col-lg-12"><br>
                        <div class="box-body box-profile">
                            <center><img id="foto_prodt" class="img-responsive img-circle" alt="foto producto" width="250px" height="250px"></center>
                            <h3 class="profile-username text-center">Foto</h3>
                            <input type="file" id="foto_servicio_edit"><br>
                            <a href="#" onclick="cambiar_foto_servicio();" class="btn btn-primary btn-block"><i class="fa fa-undo"></i> <b>Cambiar foto del servicio</b></a>
                        </div>
                        <input hidden type="text" id="foto_ruta"><br>
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_servicios_();

    function nuevo_servicio() {
        document.getElementById("tipo_servicio").value = "";
        document.getElementById("precio_servicio").value = "";
        document.getElementById("detalle_ser").value = "";
        document.getElementById("foto").value = "";

        $("#modal_tipo_").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_tipo_").modal("show");
    }

    document.getElementById("foto_servicio_edit").addEventListener("change", () => {
        var filename = document.getElementById("foto_servicio_edit").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de informacion",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_servicio_edit").value = "";
        }
    });

    document.getElementById("foto").addEventListener("change", () => {
        var filename = document.getElementById("foto").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de informacion",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto").value = "";
        }
    });
</script>