<script type="text/javascript" src="../ADMIN/js/servicio.js"></script>

<section class="content-header">
    <h1>
        <b> Listado de clientes <i class="fa fa-user"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de clientes</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de clientes </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_cliente" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Sexo</th>
                            <th>N° documento</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Fecha nacimiento</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Sexo</th>
                            <th>N° documento</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Fecha nacimiento</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar -->
<form autocomplete="false" onsubmit="return false" id="frm_edit_cliente">
    <div class="modal fade" id="modal_ediatr_cliente" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> editar cliente</h4>
                </div>

                <div class="modal-body">

                    <input id="id_cliente" type="hidden">

                    <div class="row">

                        <div class="col-lg-6">
                            <label for="nombre_cliente">Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obliga"></label>
                            <input type="text" class="form-control" id="nombre_cliente" placeholder="Ingrese nombres del cliente" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-lg-6">
                            <label for="apellidos">Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="app_pat_obliga"></label>
                            <input type="text" class="form-control" id="apellidos" placeholder="Ingrese apellido paterno" onkeypress="return soloLetras(event)"><br>
                        </div>

                        <div class="col-lg-4">
                            <label for="direccion_domicilio">Direccion</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                            <input type="text" class="form-control" id="direccion_domicilio" placeholder="Ingrese direccion de domicilio"><br>
                        </div>

                        <div class="col-lg-3">
                            <label for="numero_telefonoo">Numero de telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_obliga"></label>
                            <input type="text" maxlength="10" class="form-control" id="numero_telefonoo" placeholder="Numero de telefono" onkeypress="return soloNumeros(event)"><br>
                        </div>

                        <div class="col-lg-5">
                            <label for="correo_cliente">Correo electronico</label> &nbsp;&nbsp; <label style="color:red;" id="correo_obliga"></label>
                            <input type="email" class="form-control" id="correo_cliente" placeholder="Ingrese un correo electronico">
                            <label for="" id="email_correcto" style="color: red;"></label><br>
                        </div>

                        <div class="col-lg-3">
                            <label for="fecha_nacimiento">Fecha nacimiento</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
                            <input type="date" class="form-control" id="fecha_nacimiento"><br>
                        </div>

                        <div class="col-lg-2">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" id="sexo" style="width:100%">
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label for="numero_documento">Numero de documento</label> &nbsp;&nbsp; <label style="color:red;" id="numero_doc_obliga"></label>
                            <input type="text" maxlength="10" class="form-control" id="numero_documento" placeholder="Ingrese numero de documento" onkeypress="return soloNumeros(event)">
                            <label for="" id="cedula_cliente" style="color: red; font-size: 12px;"></label><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_cienteee()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_clientes();

    $("#correo_cliente").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_cliente').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#email_correcto").html("");
                    // $("#ocutar_p").show();
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto").html("Email incorrecto");
                    // $("#ocutar_p").hide();
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto").html("");
        }
    });

    $("#numero_documento").keyup(function() {
        if (this.value != "") {
            var cad = document.getElementById("numero_documento").value.trim();
            var total = 0;
            var longitud = cad.length;
            var longcheck = longitud - 1;

            if (cad != "") {
                if (cad !== "" && longitud === 10) {
                    for (i = 0; i < longcheck; i++) {
                        if (i % 2 === 0) {
                            var aux = cad.charAt(i) * 2;
                            if (aux > 9) aux -= 9;
                            total += aux;
                        } else {
                            total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar           
                        }
                    }
                    total = total % 10 ? 10 - total % 10 : 0;
                    if (cad.charAt(longitud - 1) == total) {
                        $(this).css("border", "1px solid green");
                        $("#cedula_cliente").html("");
                        // $("#ocutar_p").show();
                    } else {
                        document.getElementById("cedula_cliente").innerHTML = ("cedula Inválida");
                        $(this).css("border", "1px solid red");
                        // $("#ocutar_p").hide();
                    }
                } else {
                    document.getElementById("cedula_cliente").innerHTML = ("La cedula no tiene 10 digitos");
                    $(this).css("border", "1px solid red");
                    // $("#ocutar_p").hide();
                }
            } else {
                document.getElementById("cedula_cliente").innerHTML = ("Debe ingresra una cedula");
                $(this).css("border", "1px solid red");
                // $("#ocutar_p").hide();
            }
        } else {
            $(this).css("border", "1px solid green");
            $("#cedula_cliente").html("");
        }
    });
</script>