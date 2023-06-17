<style>
    input[type="checkbox"] {
        position: relative;
        width: 60px;
        height: 30px;
        -webkit-appearance: none;
        background: rgb(168, 168, 168);
        outline: none;
        border-radius: 15px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .5);
    }

    input:checked[type="checkbox"] {
        background: rgb(0, 123, 255);
    }

    input[type="checkbox"]:before {
        content: "";
        position: absolute;
        width: 30px;
        height: 30px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: white;
        transition: 0.5s;

    }

    input:checked[type="checkbox"]:before {
        left: 30px;
    }
</style>

<script type="text/javascript" src="../ADMIN/js/usuario.js"></script>

<section class="content-header">
    <h1>
        <b> Listado de usuarios <i class="fa fa-user"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de usuarios</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de usuarios </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_usuarios" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Foto</th>
                            <th>Nombre y Apellidos</th>
                            <th>Sexo</th>
                            <th>Telfono</th>
                            <th>Direccion</th>
                            <th>Correo</th>
                            <th>Cedula</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Foto</th>
                            <th>Nombre y Apellidos</th>
                            <th>Sexo</th>
                            <th>Telfono</th>
                            <th>Direccion</th>
                            <th>Correo</th>
                            <th>Cedula</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar los permiso -->
<div class="modal fade" id="modal_editar_permisos" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-key"></i> editar permisos de usuario</h4>
            </div>

            <div class="modal-body">
                <div class="row" id="unir">

                    <input hidden type="text" id="id_permiso">
                    <input hidden type="text" id="id_usu">

                    <div class='col-lg-12' style="text-align:center">
                        <div class='col-lg-2' style="text-align:center">
                            <label for='confi'>Configracion</label><br>
                            <input type='checkbox' id='confi'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='emples'>Empleado</label><br>
                            <input type='checkbox' id='emples'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='asistens'>Asistencias</label><br>
                            <input type='checkbox' id='asistens'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='mults'>Multas</label><br>
                            <input type='checkbox' id='mults'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='bens'>Beneficios</label><br>
                            <input type='checkbox' id='bens'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='rols'>Rol pagos</label><br>
                            <input type='checkbox' id='rols'><br>
                        </div>

                        <br>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='prods'>Productos</label><br>
                            <input type='checkbox' id='prods'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='creat_pords'>Registro producto</label><br>
                            <input type='checkbox' id='creat_pords'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='provees'>Proveedores</label><br>
                            <input type='checkbox' id='provees'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='comps'>Compras</label><br>
                            <input type='checkbox' id='comps'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='list_comps'>Listado compras</label><br>
                            <input type='checkbox' id='list_comps'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='ofertas'>Ofertas</label><br>
                            <input type='checkbox' id='ofertas'><br>
                        </div>

                        <br>   

                        <div class='col-lg-2' style="text-align:center">
                            <label for='servs'>Servicios</label><br>
                            <input type='checkbox' id='servs'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='creat_cliens'>Registro cliente</label><br>
                            <input type='checkbox' id='creat_cliens'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='crea_vehs'>Registro vehiculo</label><br>
                            <input type='checkbox' id='crea_vehs'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='vents'>Ventas</label><br>
                            <input type='checkbox' id='vents'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='cret_sers'>Registro servicios</label><br>
                            <input type='checkbox' id='cret_sers'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='list_reser'>Listado Reservas</label><br>
                            <input type='checkbox' id='list_reser'><br>
                        </div>

                        <br>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='reports'>Reportes</label><br>
                            <input type='checkbox' id='reports'><br>
                        </div>

                        <div class='col-lg-2' style="text-align:center">
                            <label for='segurs'>Seguridad</label><br>
                            <input type='checkbox' id='segurs'><br>
                        </div>
                        
                        <br>
                    </div><br>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_permisos_usuario()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar el usuario-->
<div class="modal fade" id="modal_editar_usuario" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> editar usuario</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden id="id_usuario">

                    <div class="col-lg-4">
                        <label for="nombres">Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obliga"></label>
                        <input type="text" class="form-control" id="nombres" placeholder="Ingrese nombres" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="apellidos">Apellidos</label> &nbsp;&nbsp; <label style="color:red;" id="app_pat_obliga"></label>
                        <input type="text" class="form-control" id="apellidos" placeholder="Ingrese apellidos" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="direccion_domicilio">Direccion domicilio</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_obliga"></label>
                        <input type="text" class="form-control" id="direccion_domicilio" placeholder="Ingrese direccion"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="numero_telefonoo">Numero de telefono</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_obliga"></label>
                        <input type="text" class="form-control" maxlength="10" id="numero_telefonoo" placeholder="Ingrese numero de telefono" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="sexo">Sexo</label>&nbsp;&nbsp; <label style="color:red;" id="sexo_olgigg"></label>
                        <select class="form-control" id="sexo" style="width:100%">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label for="numero_documento">Numero de Doc.</label> &nbsp;&nbsp; <label style="color:red;" id="numero_doc_obliga"></label>
                        <input type="text" class="form-control" id="numero_documento" maxlength="10" placeholder="Ingrese numero de cedula" onkeypress="return soloNumeros(event)">
                        <label for="" id="cedula_empleado" style="color: red; font-size: 12px;"></label><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="correo_empleado">Correo electronico</label> &nbsp;&nbsp; <label style="color:red;" id="correo_obliga"></label>
                        <input type="email" class="form-control" id="correo_empleado" placeholder="Ingrese un correo electronico">
                        <label for="" id="email_correcto" style="color: red;"></label><br>
                    </div>

                    <div class="col-lg-6">
                        <label for="tipo_usuario_agg">Tipo de usuario</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_usu_obli"></label>
                        <select class="select2_tipo form-control" id="tipo_usuario_agg" style="width:100%"></select><br>
                        <label></label>
                    </div>

                    <div class="col-lg-6">
                        <label for="usuario_agg">Usuario </label> &nbsp;&nbsp; <label style="color:red;" id="usu_obli"></label>
                        <input type="text" class="form-control" id="usuario_agg" placeholder="Ingrese usuario"><br>
                    </div>

                    <div class="col-lg-5">
                        <label for="pasw_agg">Password </label> &nbsp;&nbsp; <label style="color:red;" id="pass_obli"></label>
                        <input type="password" class="form-control" id="pasw_agg" placeholder="Ingrese password"><br>
                    </div>

                    <div class="col-lg-1">
                        <label> ver </label>
                        <button class="btn btn-danger" onclick="mostrar_edit();"><i class="fa fa-eye"></i></button><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_usuario()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_usuarios_list();

    $(".select2_tipo").select2();
    listar_tipo_usuario_x();

    function mostrar_edit() {
        var ver = document.getElementById("pasw_agg");

        if (ver.type == "password") {
            ver.type = "text";
        } else {
            ver.type = "password";
        }
    }

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