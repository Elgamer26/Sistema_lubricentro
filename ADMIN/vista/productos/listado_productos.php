<script type="text/javascript" src="../ADMIN/js/producto.js"></script>

<section class="content-header">
    <h1>
        <b> Listado de productos <i class="fa fa-dropbox"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de productos</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado de productos </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_producto" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Disponible</th>
                            <th>Estado</th>
                            <th>Imagen</th>
                            <th>Stock</th>
                            <th>Codigo</th>
                            <th>Especificación</th>
                            <th>Equivalente</th>
                            <th>Nombre producto</th>
                            <th>Tipo de producto</th>
                            <th>Marca del producto</th>
                            <th>Detalle del producto</th>
                            <th>Precio venta</th>
                            <th>Promocion</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Disponible</th>
                            <th>Estado</th>
                            <th>Imagen</th>
                            <th>Stock</th>
                            <th>Codigo</th>
                            <th>Especificación</th>
                            <th>Equivalente</th>
                            <th>Nombre producto</th>
                            <th>Tipo de producto</th>
                            <th>Marca del producto</th>
                            <th>Detalle del producto</th>
                            <th>Precio venta</th>
                            <th>Promocion</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar la imagen del producto -->
<form autocomplete="false" onsubmit="return false">
    <div class="modal fade" id="modal_editar_foto" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #f39c12; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-image"></i> Editar foto del producto</h4>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <input type="number" id="id_prod_foto" hidden>
                        <div class="col-lg-12"><br>
                            <div class="box-body box-profile">
                                <center><img id="foto_prodt" class="img-responsive img-circle" alt="foto producto" width="250px" height="250px"></center>
                                <h3 class="profile-username text-center">Foto</h3>
                                <input type="file" id="foto_prod_edit"><br>
                                <a href="#" onclick="cambiar_foto_prducto();" class="btn btn-primary btn-block"><i class="fa fa-undo"></i> <b>Cambiar foto del producto</b></a>
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
</form>

<!-- ///////////////////este formulario es para editar -->
<form autocomplete="false" onsubmit="return false" id="frm_edit_producto">
    <div class="modal fade" id="modal_editar_producto" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header" style="background: #3c8dbc; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-edit"></i> Editar producto</h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input type="text" id="id_producto_edit" hidden>

                        <div class="col-lg-3">
                            <label for="codigo_prod">Codigo producto</label> &nbsp;&nbsp; <label style="color:red;" id="codigo_obligg"></label>
                            <input type="text" maxlength="15" class="form-control" id="codigo_prod" placeholder="Codigo producto" min="0" onkeypress="return soloNumeros(event)"><br>
                        </div>

                        <div class="col-lg-3">
                            <label for="especifi_prod">Especificación del producto</label> &nbsp;&nbsp; <label style="color:red;" id="especifi_obligg"></label>
                            <input type="text" class="form-control" id="especifi_prod" placeholder="Especificación del producto"><br>
                        </div>

                        <div class="col-lg-3">
                            <label for="equiva_prod">Equivalente del producto</label> &nbsp;&nbsp; <label style="color:red;" id="equivalente_obligg"></label>
                            <input type="text" class="form-control" id="equiva_prod" placeholder="Equivalente del producto"><br>
                        </div>

                        <div class="col-lg-3">
                            <label for="nombre_producto">Nombre producto</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obligg"></label>
                            <input type="text" class="form-control" id="nombre_producto" placeholder="Ingrese numero de documento"><br>
                        </div>

                        <div class="col-lg-3">
                            <label for="tipo_producto">Tipo producto</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_pro_obligg"></label>
                            <select class="tipo_pro form-control" id="tipo_producto" style="width:100%">
                            </select><br><br>
                        </div>

                        <div class="col-lg-3">
                            <label for="marca_pro">Marca producto</label> &nbsp;&nbsp; <label style="color:red;" id="marca_pro_obligg"></label>
                            <select class="marc form-control" id="marca_pro" style="width:100%">
                            </select><br><br>
                        </div>

                        <div class="col-lg-12">
                            <label for="detalle_pro">Detalle de producto</label> &nbsp;&nbsp; <label style="color:red;" id="detalle_obligg"></label>
                            <textarea class="form-control" id="detalle_pro" cols="3" rows="3" style="resize: none;"></textarea> <br>
                        </div>

                        <div class="col-lg-3">
                            <label for="precio_pro">Precio venta</label> &nbsp;&nbsp; <label style="color:red;" id="precio_obligg"></label>
                            <input type="text" maxlength="8" class="form-control" id="preio_pro" min="0" placeholder="Ingrese precio de venta" onkeypress="return filterfloat(event, this);"><br>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar_producto()"><i class="fa fa-edit"></i> Editar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    listar_producto();
    $(".tipo_pro").select2();
    $(".marc").select2();
    listar_tipo_producto();
    listar_marca_producto();

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
</script>