<script type="text/javascript" src="../ADMIN/js/empresa.js"></script>

<section class="content-header">
    <h1>
        <b> Datos de la empresa <i class="fa  fa-university"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Datos de la empresa</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-database"></i> DATOS DE EMPRESA</h3>
            </div>

            <div class="box-body">

                <div class="row">

                    <div class="col-md-12 border text-center mt-3 p-2 bg-light">

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="box box-primary">

                                        <div class="row">
                                            <div class="col-lg-5"><br>
                                                <div class="box-body box-profile">
                                                    <img id="foto_hh" class="profile-user-img img-responsive img-circle" alt="foto empresa" height="100px" width="100px">

                                                    <h3 class="profile-username text-center">Foto</h3>

                                                    <input type="file" id="foto_hacie" accept="image/*"><br>

                                                    <a href="#" onclick="cambiar_foto_optica();" class="btn btn-primary btn-block"><i class="fa fa-undo"></i> <b>Cambiar foto</b></a>

                                                </div>

                                                <input hidden type="text" id="foto_actual"><br>

                                            </div>

                                            <div class="row"><br>
                                                <div class="col-lg-3">
                                                    <label for="haci_nombre">Nombre empresa</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_empresa__obligg"></label>
                                                    <input type="text" class="form-control" id="haci_nombre" onkeypress="return soloLetras(event)"><br>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="Direccion">Direccion</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obligg"></label>
                                                    <input type="text" class="form-control" id="Direccion"><br>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="Telefono">Telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_empresa_obligg"></label>
                                                    <input type="text" maxlength="10" class="form-control" id="Telefono" onkeypress="return soloNumeros(event)"><br>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="Ruc">Ruc</label> &nbsp;&nbsp; <label style="color:red;" id="ruc_empresa_obligg"></label>
                                                    <input type="text" maxlength="13" class="form-control" id="Ruc" maxlength="10" onkeypress="return soloNumeros(event)"><br>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="email">Email</label> &nbsp;&nbsp; <label style="color:red;" id="empresa_empresa_obligg"></label>
                                                    <input type="email" class="form-control" id="email">
                                                    <label for="" id="email_correcto_empe" style="color: red;"></label><br>
                                                </div>

                                                <div class="col-lg-3">
                                                    <label for="fecha_fun">Fecha de fundacion</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_empresa_obligg"></label>
                                                    <input type="date" class="form-control" id="fecha_fun"><br>
                                                </div>

                                                <div class="col-lg-12">
                                                    <label for="lema">Lema de la empresa</label> &nbsp;&nbsp; <label style="color:red;" id="lema_empresa_obligg"></label>
                                                    <input type="text" class="form-control" id="lema"><br>
                                                </div>

                                                <div class="col-lg-12">
                                                    <label for="">Actividades comerciles</label> &nbsp;&nbsp; <label style="color:red;" id="actividad_empresa_obligg"></label>
                                                    <textarea name="Actividad" id="Actividad" cols="30" rows="3" class="form-control" style="resize: none;"></textarea><br>
                                                </div>

                                            </div>

                                            <button style="float: right;" id="actul" type="button" class="btn btn-primary" onclick="editar_datos_optica();"><i class="fa fa-edit"></i> Modificar datos</button>

                                            <br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // $("#modal_editar_usuario").on('shown.bs.modal', function() {
    $("#haci_nombre").trigger("focus");
    // })

    document.getElementById('email').addEventListener('input', function() {
        campo = event.target;
        //este codigo me da formato email
        email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        //esto es para validar si es un email valida
        if (email.test(campo.value)) {
            //estilos para cambiar de color y ocultar el boton
            $(this).css("border", "1px solid green");
            $("#email_correcto_empe").html("");
            // $("#ocutar_p").show();
        } else {
            $(this).css("border", "1px solid red");
            $("#email_correcto_empe").html("Email incorrecto");
            // $("#ocutar_p").hide();
        }
    });

    traer_datos_optica();

    document.getElementById("foto_hacie").addEventListener("change", () => {
        var filename = document.getElementById("foto_hacie").value;
        var idxdot = filename.lastIndexOf(".") + 1;
        var extfile = filename.substr(idxdot, filename.length).toLowerCase();
        if (extfile == "jpg" || extfile == "jpeg" || extfile == "png") {} else {
            swal.fire(
                "Mensaje de informacion",
                "Solo se aceptan imagenes - USTED SUBIO UN ARCHIVO CON LA EXTENCIO ." + extfile,
                "warning"
            );
            document.getElementById("foto_hacie").value = "";
        }
    });
</script>