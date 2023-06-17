<script type="text/javascript" src="../ADMIN/js/producto.js"></script>

<section class="content-header">
    <h1>
        <b> Registrar producto <i class="fa fa-cube"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Registro producto</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-cube"></i> Registrar producto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-lg-3">
                        <label for="codigo_prod">Codigo producto</label> &nbsp;&nbsp; <label style="color:red;" id="codigo_obligg"></label>
                        <input type="text" maxlength="15" value="<?php echo rand(0, 9999999); ?>" class="form-control" id="codigo_prod" placeholder="Codigo producto" min="0"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="especifi_prod">Especificación del producto</label> &nbsp;&nbsp; <label style="color:red;" id="especifi_obligg"></label>
                        <input type="text" class="form-control" id="especifi_prod" placeholder="Especificación del producto"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="equiva_prod">Equivalente  del producto</label> &nbsp;&nbsp; <label style="color:red;" id="equivalente_obligg"></label>
                        <input type="text" class="form-control" id="equiva_prod" placeholder="Equivalente del producto"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="nombre_producto">Nombre producto</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obligg"></label>
                        <input type="text" class="form-control" id="nombre_producto" placeholder="Ingrese numero de documento"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="tipo_producto">Tipo producto</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_pro_obligg"></label>
                        <select class="tipo_pro form-control" id="tipo_producto" style="width:100%">
                        </select><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="marca_pro">Marca producto</label> &nbsp;&nbsp; <label style="color:red;" id="marca_pro_obligg"></label>
                        <select class="marc form-control" id="marca_pro" style="width:100%">   
                        </select> <br><br>
                    </div>

                

                    <div class="col-lg-12">
                        <label for="detalle_pro">Detalle de producto</label> &nbsp;&nbsp; <label style="color:red;" id="detalle_obligg"></label>
                        <textarea class="form-control" id="detalle_pro" cols="3" rows="3" style="resize: none;"></textarea> <br>
                    </div>

                    <div class="col-lg-3">
                        <label for="precio_pro">Precio venta</label> &nbsp;&nbsp; <label style="color:red;" id="precio_obligg"></label>
                        <input type="text" maxlength="8" class="form-control" id="preio_pro" placeholder="0,00" onkeypress="return filterfloat(event, this);"><br>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="foto">Subir imagen</label> &nbsp;&nbsp; <label style="color:orange;"> La foto no es obligatoria</label>
                            <input id="foto" class="form-control" type="file" name="foto" accept="image/*">
                        </div>
                    </div>

                    <div class="col-lg-12" style="text-align: center">
                        <button type="button" class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/productos/nuevo_producto.php');"><i class="fa fa-trash-o"></i> Limpiar</button> -
                        <button type="button" class="btn btn-success" onclick="registrar_producto_producto()"><i class="fa fa-save"></i> Registrar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#codigo_prod").trigger("focus");

    $(".tipo_pro").select2();
    $(".marc").select2();
    listar_tipo_producto();
    listar_marca_producto();

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