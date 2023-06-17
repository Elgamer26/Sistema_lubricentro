<script type="text/javascript" src="../ADMIN/js/empleado.js"></script>

<section class="content-header">
    <h1>
        <b> Listado de empleados <i class="fa fa-users"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de empleados</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de empleados </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_empleado" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cargo</th>
                            <th>Nombres</th>
                            <th>Estado civil</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Fecha nacimiento</th>
                            <th>Sexo</th>
                            <th>Cedula</th>
                            <th>Nivel estudio</th>
                            <th>Titulo</th>
                            <th>Experiencia laboral</th>
                            <th>Fecha ingreso</th>
                            <th>Valor por hora</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cargo</th>
                            <th>Nombres</th>
                            <th>Estado civil</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Fecha nacimiento</th>
                            <th>Sexo</th>
                            <th>Cedula</th>
                            <th>Nivel estudio</th>
                            <th>Titulo</th>
                            <th>Experiencia laboral</th>
                            <th>Fecha ingreso</th>
                            <th>Valor por hora</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- ///////////////////este formulario es para editar el usuario-->
<div class="modal fade" id="modal_editar_emleado" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar empleado</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                <input id="id_empleado" hidden>

                    <div class="col-lg-5">
                        <label for="nombre_empleado">Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obliga"></label>
                        <input type="text" class="form-control" id="nombre_empleado" placeholder="Ingrese nombres del empleado" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-5">
                        <label for="apellido_paterno">Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="app_pat_obliga"></label>
                        <input type="text" class="form-control" id="apellido_paterno" placeholder="Ingrese apellido paterno" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="estado_civil">Estado civil</label> &nbsp;&nbsp; <label style="color:red;" id="civil_obligg"></label>
                        <select class="form-control" id="estado_civil" style="width:100%">
                            <option value="Soltero">Soltero</option>
                            <option value="Soltera">Soltera</option>
                            <option value="Casado">Casado</option>
                            <option value="Casada">Casada</option>
                            <option value="Viudo">Viudo</option>
                            <option value="Viuda">Viuda</option>
                        </select>
                    </div>

                    <div class="col-lg-5">
                        <label for="direccion_domicilio">Direccion domicilio</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                        <input type="text" class="form-control" id="direccion_domicilio" placeholder="Ingrese direccion de domicilio"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="numero_telefonoo">Numero de telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_obliga"></label>
                        <input type="text" class="form-control" maxlength="10" id="numero_telefonoo" placeholder="Ingrese numero de telefono" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="correo_empleado">Correo electronico</label> &nbsp;&nbsp; <label style="color:red;" id="correo_obliga"></label>
                        <input type="email" class="form-control" id="correo_empleado" placeholder="Ingrese un correo electronico">
                        <label for="" id="email_correcto" style="color: red;"></label><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="fecha_nacimiento">Fecha nacimiento</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
                        <input type="date" class="form-control" id="fecha_nacimiento"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="sexo">Sexo</label> &nbsp;&nbsp; <label style="color:red;" id="sexo_olbig"></label>
                        <select class="form-control" id="sexo" style="width:100%">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label for="numero_documento">Numero de Doc.</label> &nbsp;&nbsp; <label style="color:red;" id="numero_doc_obliga"></label>
                        <input type="text" class="form-control" id="numero_documento" maxlength="10" placeholder="Ingrese numero de documento" onkeypress="return soloNumeros(event)">
                        <label for="" id="cedula_empleado" style="color: red; font-size: 12px;"></label><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="sexo">Nivel de estudio</label> &nbsp;&nbsp; <label style="color:red;" id="nival_obliggg"></label>
                        <select class="form-control" id="nivel_estudio" style="width:100%">
                            <option value="EDUCACION_BASICA">EDUCACION BÁSICA</option>
                            <option value="BACHILLERATO">BACHILLERATO</option>
                            <option value="TECNICO_SUPERIOR">TÉCNICO SUPERIOR</option>
                            <option value="TERCER_NIVEL">TERCER NIVEL</option>
                            <option value="POSTGRADO">POSTGRADO</option>
                        </select><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="titulo_">Titulo</label> &nbsp;&nbsp; <label style="color:red;" id="totulo_obligg"></label>
                        <input type="text" class="form-control" id="titulo_" maxlength="50" placeholder="Ingrese tituo de Senescyt"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="experi_laboral">Experiencia Laboral</label> &nbsp;&nbsp; <label style="color:red;" id="expero_obligg"></label>
                        <input type="text" class="form-control" id="experi_laboral" maxlength="50" placeholder="Ingrese experiencia"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="fecha_ingreso">Fecha de ingreso</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_ingreso_obligg"></label>
                        <input type="date" class="form-control" id="fecha_ingreso"><br>
                    </div>


                    <div class="col-lg-4">
                        <label for="cargo">Cargo</label> &nbsp;&nbsp; <label style="color:red;" id="cargo_olbiggg"></label>
                        <select class="cargo_ form-control" id="cargo" style="width:100%"></select><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="valor_hora">Valor por hora</label> &nbsp;&nbsp; <label style="color:red;" id="valor_obligg"></label>
                        <input type="number" class="form-control" id="valor_hora" placeholder="Ingrese valor por hora"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_empleado()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_combo_cargo();
    listado_empleados();
    $(".cargo_").select2();

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
                        $("#cedula_empleado").html("");
                    } else {
                        document.getElementById("cedula_empleado").innerHTML = ("cedula Inválida");
                        $(this).css("border", "1px solid red");
                    }
                } else {
                    document.getElementById("cedula_empleado").innerHTML = ("La cedula no tiene 10 digitos");
                    $(this).css("border", "1px solid red");
                }
            } else {
                document.getElementById("cedula_empleado").innerHTML = ("Debe ingresra una cedula");
                $(this).css("border", "1px solid red");
            }
        } else {
            $(this).css("border", "1px solid green");
            $("#cedula_empleado").html("");
        }
    })

    $("#correo_empleado").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_empleado').addEventListener('input', function() {
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
</script>