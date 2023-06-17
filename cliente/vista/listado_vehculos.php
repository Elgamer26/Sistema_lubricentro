<script type="text/javascript" src="../ADMIN/js/sytem.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("Y-m-d");
?>

<section class="content-header">
    <h1>
        <b> Listado de vehiculos <i class="fa fa-user"></i> <i class="fa fa-car"></i> </b> <button onclick="modal_registro_vehcoo();" class="btn btn-danger"><i class="fa fa-plus"></i> Registrar</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de vehiculos</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de vehiculos </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_vehi_clie_usu" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Vehiculo</th>
                            <th>Marca</th>
                            <th>Fecha registro</th>
                            <th>Matricula</th>
                            <th>Color</th>
                            <th>Foto</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Vehiculo</th>
                            <th>Marca</th>
                            <th>Fecha registro</th>
                            <th>Matricula</th>
                            <th>Color</th>
                            <th>Foto</th>
                            <th>Detalle</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /////////////////// -->
<div class="modal fade" id="modal_nuevo_registro" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #00a65a; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo registro</h4>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-lg-2">
                        <label for="fecha_n">Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="n_fecha_obliga"></label>
                        <input type="date" readonly class="form-control" id="fecha_n" value="<?php echo $fecha ?>"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="n_tipo_vehoculo">Tipo vehiculo</label> &nbsp;&nbsp; <label style="color:red;" id="n_tipo_vehoculo_obligg"></label>
                        <select class="n_tipo_vehoculo form-control" id="n_tipo_vehoculo" style="width: 100%;"></select><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="n_tipo_marca">Tipo marca</label> &nbsp;&nbsp; <label style="color:red;" id="n_tipo_marca_obligg"></label>
                        <select class="n_tipo_marca form-control" id="n_tipo_marca" style="width: 100%;"></select><br>
                    </div>


                    <div class="col-lg-3">
                        <label for="n_matrcula">Matricula</label> &nbsp;&nbsp; <label style="color:red;" id="n_matricula_obliga"></label>
                        <input type="text" maxlength="20" class="form-control" id="n_matrcula" placeholder="Ingrese matricula"><br>
                    </div>

                    <div class="col-lg-5">
                        <label for="n_color">Color/es</label> &nbsp;&nbsp; <label style="color:red;" id="n_color_obliga"></label>
                        <input type="text" onkeypress="return soloLetras(event);" maxlength="40" class="form-control" id="n_color" placeholder="Ingrese color de vehiculos"><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="n_detalle">Detalle del vehiculo</label> &nbsp;&nbsp; <label style="color:red;" id="n_detalle_obliga"></label>
                        <textarea type="email" class="form-control" id="n_detalle"> </textarea> <br>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="foto">Subir imagen</label>
                            <input id="foto" class="form-control" type="file" name="foto" accept="image/*"><br>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="nuevo_registro_vehiculo_usuol();"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editr_vehicuo_cliente" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar datos</h4>
            </div>

            <div class="modal-body">

                <input id="id_vehoculo_cliente" type="hidden">

                <div class="row">

                    <div class="col-lg-2">
                        <label for="fecha">Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
                        <input type="date" readonly class="form-control" id="fecha"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="tipo_vehoculo">Tipo vehiculo</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_vehoculo_obligg"></label>
                        <select class="tipo_vehoculo form-control" id="tipo_vehoculo" style="width: 100%;"></select><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="tipo_marca">Tipo marca</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_marca_obligg"></label>
                        <select class="tipo_marca form-control" id="tipo_marca" style="width: 100%;"></select><br>
                    </div>


                    <div class="col-lg-3">
                        <label for="matrcula">Matricula</label> &nbsp;&nbsp; <label style="color:red;" id="matricula_obliga"></label>
                        <input type="text" maxlength="20" class="form-control" id="matrcula" placeholder="Ingrese matricula"><br>
                    </div>

                    <div class="col-lg-5">
                        <label for="color">Color/es</label> &nbsp;&nbsp; <label style="color:red;" id="color_obliga"></label>
                        <input type="text" onkeypress="return soloLetras(event);" maxlength="40" class="form-control" id="color" placeholder="Ingrese color de vehiculos"><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="detalle">Detalle del vehiculo</label> &nbsp;&nbsp; <label style="color:red;" id="detalle_obliga"></label>
                        <textarea type="email" class="form-control" id="detalle"> </textarea> <br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_vehiculo_cliente_usu();"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_foto_carro" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #f39c12; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-image"></i> Editar foto del vehiculo</h4>
            </div>

            <div class="modal-body">

                <div class="row">
                    <input type="number" id="id_prod_foto" hidden>
                    <div class="col-lg-12"><br>
                        <div class="box-body box-profile">
                            <center><img id="foto_prodt" class="img-responsive img-circle" alt="foto producto" width="250px" height="250px"></center>
                            <h3 class="profile-username text-center">Foto</h3>
                            <input type="file" id="foto_prod_edit"><br>
                            <a href="#" onclick="cambiar_foto_vehiculo_usu();" class="btn btn-primary btn-block"><i class="fa fa-undo"></i> <b>Cambiar foto del producto</b></a>
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
    listar_vehculos_clientess_usuario();

    listar_tpi_vehculo();
    listar_marca();
    $(".tipo_vehoculo").select2();
    $(".tipo_marca").select2();
    $(".n_tipo_vehoculo").select2();
    $(".n_tipo_marca").select2();

    function listar_tpi_vehculo() {
        funcion = "listar_tpi_vehculo_combo";
        $.ajax({
            url: "../ADMIN/controlador/servicio/servicio.php",
            type: "POST",
            data: {
                funcion: funcion
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_vehoculo").html(cadena);
                $("#n_tipo_vehoculo").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#tipo_vehoculo").html(cadena);
                $("#n_tipo_vehoculo").html(cadena);
            }
        });
    }

    function listar_marca() {
        funcion = "listar_marca_combo";
        $.ajax({
            url: "../ADMIN/controlador/servicio/servicio.php",
            type: "POST",
            data: {
                funcion: funcion
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            var cadena = "";
            if (data.length > 0) {
                //bucle para extraer los datos del rol
                for (var i = 0; i < data.length; i++) {
                    cadena +=
                        "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
                }
                //aqui concadenamos al id del select
                $("#tipo_marca").html(cadena);
                $("#n_tipo_marca").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#tipo_marca").html(cadena);
                $("#n_tipo_marca").html(cadena);
            }
        });
    }

    document.getElementById("foto_prod_edit").addEventListener("change", () => {
        var filename = document.getElementById("foto_prod_edit").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de informacion",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_prod_edit").value = "";
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
            document.getElementById("foto_prod_edit").value = "";
        }
    });
</script>