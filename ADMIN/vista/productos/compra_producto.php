<script type="text/javascript" src="../ADMIN/js/producto.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$fecha = date("YmdHms");
$numero = date("Hms-dmY");
?>

<section class="content-header">
    <h1>
        <b> Compra de producto <i class="fa fa-cubes"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Compra de producto</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-cubes"></i> Compra de producto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <input type="number" id="id_proveedor" hidden>

                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: 0;">
                            <b>
                                <h3 class="box-title"><b><i class="fa fa-truck"></i> Datos del proveedor</b></h3>
                            </b>
                        </div><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="razon_spcial">Razon social</label> &nbsp;&nbsp; <label style="color:red;" id="razon_obligg"></label>
                        <input readonly type="text" class="form-control" id="razon_spcial" placeholder="Razon social"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="numero_doc">Numero de documento</label>
                        <input readonly type="text" class="form-control" id="numero_doc" placeholder="Numero de documento"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="encargado_pr">Encargado</label>
                        <input readonly type="text" class="form-control" id="encargado_pr" placeholder="Encargado"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="correo_prov">Correo electronico</label>
                        <input readonly type="email" class="form-control" id="correo_prov" placeholder="Correo electronico">
                    </div>

                    <div class="col-lg-1">
                        <label for="correo_prov">Buscar</label><br>
                        <button readonly type="button" class="btn btn-primary" onclick="modal_proveedor();" title="Buscar un proveedor"><i class="fa fa-search"></i></button>
                    </div><br>

                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background: #286090; color:black; height: 5px;">
                            <b>
                                <h3 class="box-title"> </h3>
                            </b>
                        </div><br>
                    </div>

                    <!-- //////////////////// -->

                    <div class="col-lg-2">
                        <label for="">Inpuesto %</label> &nbsp;&nbsp; <label style="color:red;" id="impuesto_obligg"></label>
                        <input type="text" maxlength="4" value="12" class="form-control" id="inpuesto" placeholder="12" onkeypress="return filterfloat(event, this);">
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tipo_comprobante">Tipo comprobante</label>
                            <select id="tipo_comprobante" class="form-control" name="tipo_comprobante" style="width: 100%;">
                                <option value="FACTURA">FACTURA</option>
                                <option value="BOLETA">BOLETA</option>
                                <!-- <option value="TICKET">TICKET</option> -->
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <label for="">Serie comprobante</label> &nbsp;&nbsp; <label style="color:red;" id="serie_obligg"></label>
                        <input type="text" maxlength="15" class="form-control" value="<?php echo $numero; ?>" id="serie_comprobante"><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="">Numero comprobante</label> &nbsp;&nbsp; <label style="color:red;" id="numero_obligg"></label>
                        <input type="text" maxlength="15" class="form-control" id="numeroe_comprobante" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <input type="number" id="id_producto_agg" hidden>

                    <div class="col-lg-2">
                        <label for="codigo_producto">Codigo productos</label>
                        <input readonly type="text" maxlength="15" class="form-control" id="codigo_producto" placeholder="Ingrese codigo prod." onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="nombre_prodc">Producto</label> &nbsp;&nbsp; <label style="color:red;" id="produco_obligg"></label>
                        <input readonly type="text" class="form-control" id="nombre_prodc" placeholder="Producto"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="tipo_producto">Tipo producto</label>
                        <input readonly type="text" class="form-control" id="tipo_producto" placeholder="Tipo producto"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="marca_product">Marca producto</label>
                        <input readonly type="text" class="form-control" id="marca_product" placeholder="Marca producto"><br>
                    </div>

                    <div class="col-lg-1" style="padding-left: 1px;">
                        <label>Buscar</label>
                        <button readonly type="button" class="btn btn-warning" onclick="modal_productoss();" title="Buscar un producto"><i class="fa fa-search"></i></button>
                    </div><br>

                    <div class="col-lg-2">
                        <label for="cantidad">Cantidad de cajas</label> &nbsp;&nbsp; <label style="color:red;" id="cantidad_obligg"></label>
                        <input min="1" class="form-control" id="cantidad" maxlength="4" type="text" value="0" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="unidad">Cantidad de unidades</label> &nbsp;&nbsp; <label style="color:red;" id="unidades_obligg"></label>
                        <input min="1" class="form-control" id="unidad" maxlength="4" type="text" value="0" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Precio caja $/</label> &nbsp;&nbsp; <label style="color:red;" id="precio_olbigg"></label>
                        <input onkeypress="return filterfloat(event, this);" maxlength="8" type="text" value="0" class="form-control" id="precio"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Descuento ($)</label> &nbsp;&nbsp; <label style="color:red;" id="desc_obligg"></label>
                        <input onkeypress="return filterfloat(event, this);" maxlength="8" type="text" value="0" class="form-control" id="descuento"><br>
                    </div>

                    <div class="col-lg-2">
                        <label>Agregar al detalle</label><br>
                        <button readonly type="button" class="btn btn-success" onclick="agg_prodcuto();" title="Buscar un producto"><i class="fa fa-download"></i> Agregar al detalle</button>
                    </div>

                    <div class="col-lg-12" style="text-align: center;">
                        <h4><b>.:Detalle de compra:.</b> </h4>
                    </div>

                    <div class="col-lg-12 table-responsive">

                        <table id="detalle_ingreso" class="table table-striped table-bordered">
                            <thead bgcolor="black" style="color:#fff;">
                                <tr>
                                    <th hidden>Id</th>
                                    <th>Producto</th>
                                    <th>Cajas</th>
                                    <th>Unidad</th>
                                    <th>Precio $</th>
                                    <th>Descuento $</th>
                                    <th>Subtotal $</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_detalle_prodcuto">

                            </tbody>

                        </table>

                    </div>

                    <div class="col-lg-12" style="text-align: right;">
                        <label for="" id="lbl_totalneto"></label>
                        <input hidden type="text" id=txt_totalneto>
                    </div>


                    <div class="col-lg-12" style="text-align: right;">
                        <label for="" id="lbl_impuesto"></label>
                        <input hidden type="text" id=txt_impuesto>
                    </div>

                    <div class="col-lg-12" style="text-align: right;">
                        <label for="" id="lbl_a_pagar"></label>
                        <input hidden type="text" id=txt_a_pagar>
                    </div> <br>

                    <div class="col-lg-12" style="text-align: center">
                        <button type="button" class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/productos/compra_producto.php');"><i class="fa fa-trash-o"></i> Limpiar</button> -
                        <button type="button" class="btn btn-success" onclick="registrar_producto()"><i class="fa fa-save"></i> Ingresar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal para el listado de los proveedores -->
<div class="modal fade" id="modal__lista_provee" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"><b><i class="fa fa-list"></i> Listado de proveedores</b></h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <table id="tabla_proveedores_agg" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Razon social</th>
                                    <th>Ruc</th>
                                    <th>Encargado</th>
                                    <th>Direccion</th>
                                    <th>Provincia</th>
                                    <th>Ciudad</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Razon social</th>
                                    <th>Ruc</th>
                                    <th>Encargado</th>
                                    <th>Direccion</th>
                                    <th>Provincia</th>
                                    <th>Ciudad</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button id="cerraraa" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close" style=" font-size: 20px;"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- modal para el listado de los proveedores -->
<div class="modal fade" id="modal__lista_prroductos" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"><b><i class="fa fa-list"></i> Listado de productos</b></h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <table id="tabla_productos_agg" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Estado</th>
                                    <th>Codigo Prod.</th>
                                    <th>Cantidad</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Tipo producto</th>
                                    <th>Marca producto</th>

                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Estado</th>
                                    <th>Codigo Prod.</th>
                                    <th>Cantidad</th>
                                    <th>Foto</th>
                                    <th>Nombre</th>
                                    <th>Tipo producto</th>
                                    <th>Marca producto</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button id="cerraraa" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close" style=" font-size: 20px;"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listar_proveedor_compra();
    listado_productos_agg();

    $("#tipo_comprobante").on("change", function() {
        var valor = $(this).val();

        if (valor == "BOLETA") {
            $("#inpuesto").attr("disabled", true);
            $("#inpuesto").val("0");
        } else {
            $("#inpuesto").removeAttr("disabled");
            $("#inpuesto").val("12");
        }
    });

    // esto es para agregar el producto al detallada
    function agg_prodcuto() {
        var id_prod = $("#id_producto_agg").val();
        var nombre = $("#nombre_prodc").val();
        var tipo = $("#tipo_producto").val();
        var marca = $("#marca_product").val();
        var cantidad = $("#cantidad").val();
        var precio = $("#precio").val();
        var descuento = $("#descuento").val();
        var inpuesto = $("#inpuesto").val();
        var unidad = $("#unidad").val();

        var comprobante_tipo = $("#tipo_comprobante").val();

        if (comprobante_tipo == "FACTURA") {
            if (inpuesto.length == 0 || inpuesto == "") {
                $("#impuesto_obligg").html("Ingrese valor");

                return swal.fire(
                    "Campo vacios",
                    "Debe ingresar el impuesto",
                    "warning"
                );
            } else {
                $("#impuesto_obligg").html("");
            }
        } else {
            $("#impuesto_obligg").html("");
        }

        if (
            id_prod.length == 0 ||
            nombre.length == 0 ||
            cantidad.length == 0 ||
            descuento.length == 0 ||
            precio.length == 0
        ) {
            validar_ingreso_prod(
                id_prod,
                nombre,
                cantidad,
                descuento,
                precio
            );
            return Swal.fire(
                "Mensaje de advertencia",
                "Debe ingresar todo los datos del producto para su ingreso al detalle",
                "warning"
            );
        } else {
            $("#produco_obligg").html("");
            $("#cantidad_obligg").html("");
            $("#precio_olbigg").html("");
            $("#desc_obligg").html("");
        }

        if (parseInt(cantidad) < 1) {
            $("#cantidad_obligg").html("X");
            return Swal.fire(
                "Mensaje de advertencia",
                "La cantidad debe ser mayor a cero (0)",
                "warning"
            );
        } else {
            $("#cantidad_obligg").html("");
        }

        if (parseInt(unidad) <= 0) {
            $("#unidades_obligg").html("X");
            return Swal.fire(
                "Mensaje de advertencia",
                "El unidad debe ser mayor a cero (0)",
                "warning"
            );
        } else {
            $("#unidades_obligg").html("");
        }

        if (parseInt(precio) < 1) {
            $("#precio_olbigg").html("X");
            return Swal.fire(
                "Mensaje de advertencia",
                "El precio debe ser mayor a cero (0)",
                "warning"
            );
        } else {
            $("#precio_olbigg").html("");
        }

        var desc;
        var sub_ta;
        if (descuento == 0 || descuento == "" || descuento.length == 0) {
            desc = 0;
            sub_ta = parseFloat(cantidad * parseFloat(precio)).toFixed(2);
        } else {
            if (descuento == "" || descuento.length == 0 || descuento <= 0) {
                $("#desc_obligg").html("X");
                return Swal.fire(
                    "Mensaje de advertencia",
                    "El descuento debe ser mayor a cero (0)",
                    "warning"
                );
            }

            $("#desc_obligg").html("");
            desc = descuento;
            sub_ta = parseFloat(cantidad * parseFloat(precio) - parseFloat(descuento)).toFixed(2);
        }

        if (verificar_ingreso_pro_id(parseInt(id_prod))) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El producto '" +
                nombre +
                " - " +
                tipo +
                " - " +
                marca +
                "' ,ya fue agregado al detalle",
                "warning"
            );
        }

        //aqui agrego los labores para unir a la tabla
        let datos_agg = "<tr>";
        datos_agg += "<td hidden for='id'>" + id_prod + "</td>";
        datos_agg += "<td>" + nombre + " - " + tipo + " - " + marca + "</td>";
        datos_agg += "<td>" + cantidad + "</td>";
        datos_agg += "<td>" + unidad + "</td>";
        datos_agg += "<td>" + precio + "</td>";
        datos_agg += "<td>" + desc + "</td>";
        datos_agg += "<td>" + sub_ta + "</td>";
        datos_agg +=
            "<td><button onclick='remove_producto_deta(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_prodcuto").append(datos_agg);

        $("#codigo_producto").val("");
        $("#id_producto_agg").val("");
        $("#nombre_prodc").val("");
        $("#tipo_producto").val("");
        $("#marca_product").val("");

        $("#unidad").val(0);
        $("#cantidad").val(0);
        $("#precio").val(0);
        $("#descuento").val(0);

        sumartotalneto();
    }

    //esta funcion es para verificar si el id de la tabla de repide
    function verificar_ingreso_pro_id(id) {
        let idverificar = document.querySelectorAll("#detalle_ingreso td[for='id']");
        return (
            [].filter.call(idverificar, (td) => td.textContent == id).length == 1
        );
    }

    function remove_producto_deta(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
        sumartotalneto();
    }

    /// validacion
    function validar_ingreso_prod(
        id_prod,
        nombre,
        cantidad,
        descuento,
        precio
    ) {
        if (id_prod.length == 0 || nombre.length == 0) {
            $("#produco_obligg").html("Ingrese producto");
        } else {
            $("#produco_obligg").html("");
        }

        if (cantidad.length == 0) {
            $("#cantidad_obligg").html("X");
        } else {
            $("#cantidad_obligg").html("");
        }

        if (descuento.length == 0) {
            $("#precio_olbigg").html("X");
        } else {
            $("#precio_olbigg").html("");
        }

        if (precio.length == 0) {
            $("#desc_obligg").html("X");
        } else {
            $("#desc_obligg").html("");
        }
    }

    function sumartotalneto() {
        let arreglo_total = new Array();
        let count = 0;
        let total = 0;
        let impuestototal = 0;
        let subtotal = 0;
        let impuesto = document.getElementById("inpuesto").value;
        $("#detalle_ingreso tbody#tbody_detalle_prodcuto tr").each(function() {
            arreglo_total.push($(this).find("td").eq(6).text());
            count++;
        });
        for (var i = 0; i < count; i++) {
            var suma = arreglo_total[i];
            subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);
            impuestototal = parseFloat(subtotal * impuesto / 100).toFixed(2);
        }
        total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

        let tipo_comprobante = document.getElementById("tipo_comprobante").value;

        if (tipo_comprobante == "FACTURA") {
            $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
            $("#lbl_impuesto").html(
                "<b>impuesto: % " + impuesto + " </b> $/." + impuestototal
            );
            $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);

            $("#txt_totalneto").val(subtotal);
            $("#txt_impuesto").val(impuestototal);
            $("#txt_a_pagar").val(total);

        } else {

            $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);
            $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
            $("#lbl_impuesto").html(
                "<b>impuesto: % " + impuesto + " </b> $/." + impuestototal
            );

            $("#txt_totalneto").val(subtotal);
            $("#txt_impuesto").val(impuestototal);
            $("#txt_a_pagar").val(total);
        }
    }
</script>