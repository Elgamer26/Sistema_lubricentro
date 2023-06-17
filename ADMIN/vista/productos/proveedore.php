<script type="text/javascript" src="../ADMIN/js/producto.js"></script>
<script type="text/javascript" src="../ADMIN/js/numero.min.js"></script>

<section class="content-header">
    <h1>
        <b> Registrar proveedor <i class="fa fa-truck"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Registro proveedor</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-truck"></i> Registrar proveedor</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-lg-4">
                        <label for="razon_spcial">Razon social</label> &nbsp;&nbsp; <label style="color:red;" id="razon_spcial_obliga"></label>
                        <input type="text" class="form-control" id="razon_spcial" placeholder="Ingrese razon social"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="numero_doc">Numero de documento</label> &nbsp;&nbsp; <label style="color:red;" id="numero_doc_obliga"></label>
                        <input type="text" maxlength="13" class="form-control" id="numero_doc" placeholder="Ingrese numero de documento" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="direccion_p">Direccion</label> &nbsp;&nbsp; <label style="color:red;" id="direccion_p_obliga"></label>
                        <input type="text" class="form-control" id="direccion_p" placeholder="Ingrese direccion de proveedor"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="provincia">Provincia</label> &nbsp;&nbsp; <label style="color:red;" id="provincia_obliga"></label>
                        <input type="text" maxlength="30" class="form-control" id="provincia"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="ciudad">Ciudad</label> &nbsp;&nbsp; <label style="color:red;" id="ciudad_obliga"></label>
                        <input  type="text" maxlength="30" class="form-control" id="ciudad"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="numero_telefono_p">Numero de telefono</label> &nbsp;&nbsp; <label style="color:red;" id="numero_telefono_p_obliga"></label>
                        <input type="text" maxlength="10" class="form-control" id="numero_telefono_p" placeholder="Ingrese numero de telefono" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="correo_prov">Correo electronico</label> &nbsp;&nbsp; <label style="color:red;" id="correo_p_obliga"></label>
                        <input type="email" class="form-control" id="correo_prov" placeholder="Ingrese un correo electronico">
                        <label for="" id="email_correcto_prov" style="color: red;"></label><br>
                    </div>

                    <div class="col-lg-12">
                        <label for="actividad_pro">Actividad</label> &nbsp;&nbsp; <label style="color:red;" id="actividad_pro_obliga"></label>
                        <input type="text" class="form-control" id="actividad_pro" placeholder="Ingrese la actividad del proveedor"> <br>
                    </div>

                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding:0px;">
                            <b>
                                <h3 class="box-title"><i class="fa fa-user"></i> Encargado/a</h3>
                            </b>
                        </div><br>
                    </div>

                    <div class="col-lg-6">
                        <label for="nombre_enca">Nombres del encargado</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_enca_obliga"></label>
                        <input type="text" class="form-control" id="nombre_enca" placeholder="Ingrese nombres del encargado"> <br>
                    </div>

                    <div class="col-lg-2">
                        <label>Sexo</label>
                        <select id="sexo_enc" style="width: 100%;" class="select form-control">
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="telefono_encargado">Telefono encargado</label> &nbsp;&nbsp; <label style="color:red;" id="telefono_encargado_obliga"></label>
                        <input type="text" maxlength="10" class="form-control" id="telefono_encargado" placeholder="Ingrese telefono de encargado" onkeypress="return soloNumeros(event)"> <br>
                    </div>

                    <div class="col-lg-12" style="text-align: center">
                        <button type="button" class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/productos/proveedore.php');"><i class="fa fa-trash-o"></i> Limpiar</button> -
                        <button type="button" class="btn btn-success" onclick="registrar_proveedor()"><i class="fa fa-save"></i> Registrar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#razon_spcial").trigger("focus");

    $("#correo_prov").keyup(function() {
        if (this.value != "") {
            document.getElementById('correo_prov').addEventListener('input', function() {
                campo = event.target;
                //este codigo me da formato email
                email = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                //esto es para validar si es un email valida
                if (email.test(campo.value)) {
                    //estilos para cambiar de color y ocultar el boton
                    $(this).css("border", "1px solid green");
                    $("#email_correcto_prov").html("");
                } else {
                    $(this).css("border", "1px solid red");
                    $("#email_correcto_prov").html("Email incorrecto");
                }
            });
        } else {
            $(this).css("border", "1px solid green");
            $("#email_correcto_prov").html("");
        }
    });

    $("#numero_doc").validarCedulaEC({
        onValid: function() {
            alertify.success('Ruc correcto');
        },
        onInvalid: function() {
            alertify.error('Ruc incorrecto');
            $("#numero_doc").val("");
            $("#numero_doc").focus();
        }
    });
</script>