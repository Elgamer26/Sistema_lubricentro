<script type="text/javascript" src="../ADMIN/js/servicio.js"></script>

<section class="content-header">
    <h1>
        <b> Ingreso de venta <i class="fa fa-shopping-cart"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Ingreso de venta</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Ingreso de venta</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <input type="number" id="id_cliente" hidden>

                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: 0px">
                            <b>
                                <h3 class="box-title"><i class="fa fa-user"></i> Datos del cliente</h3>
                            </b>
                        </div><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="nume_doc">N° documento</label>
                        <input readonly type="number" class="form-control" id="nume_doc" placeholder="Numero doc."><br>
                    </div>

                    <div class="col-lg-4">
                        <label for="nombres_clie">Nombres</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obigg"></label>
                        <input readonly type="text" class="form-control" id="nombres_clie" placeholder="Nombres"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="sexo_clie">Sexo</label>
                        <input readonly type="text" class="form-control" id="sexo_clie" placeholder="Sexo"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="correo_clie">Correo electronico</label>
                        <input readonly type="email" class="form-control" id="correo_clie" placeholder="Correo electronico">
                    </div>

                    <div class="col-lg-1">
                        <label>Buscar</label><br>
                        <button readonly type="button" class="btn btn-primary" onclick="modal_cliente();" title="Buscar un proveedor"><i class="fa fa-search"></i></button>
                    </div><br>

                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background:  #286090; color:white; padding: 0px">
                            <b>
                                <h3 class="box-title"><i class="fa fa-shopping-cart"></i> Datos de venta</h3>
                            </b>
                        </div><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Impuesto %</label> &nbsp;&nbsp; <label style="color:red;" id="impuesto_obligg"></label>
                        <input readonly type="number" class="form-control" id="inpuesto" value="12">
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="tipo_comprobante">Tipo comprobante</label>
                            <select id="tipo_comprobante" class="tipo_compro form-control" name="tipo_comprobante" style="width: 100%;">
                                <option value="FACTURA">FACTURA</option>
                                <option value="BOLETA">BOLETA</option>
                            </select>
                        </div>
                    </div>

                    <?php
                    date_default_timezone_set('America/Guayaquil');
                    $fecha = date("Y-m-d");
                    $time = date('H:i', time());
                    $numero = date("YmdHms");
                    ?>

                    <div class="col-lg-3">
                        <label for="fecha_venta">Fecha venta</label>
                        <input type="dATE" class="form-control" id="fecha_venta" value="<?php echo $fecha; ?>"><br>
                    </div>

                    <div class="col-lg-3">
                        <label for="">N° comprobante</label> &nbsp;&nbsp; <label style="color:red;" id="number_obligg"></label>
                        <input type="text" class="form-control" id="numeroe_comprobante" value="<?php echo $numero; ?>" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <input type="number" id="id_producto_agg" hidden>

                    <div class="col-lg-3">
                        <label for="nombre_prodc">Producto</label> &nbsp;&nbsp; <label style="color:red;" id="producto_obligg_a"></label>
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

                    <div class="col-lg-2">
                        <label for="stock_product">Stock</label> &nbsp;&nbsp; <label style="color:red;" id="stock_obligg_a"></label>
                        <input readonly type="text" class="form-control" id="stock_product" placeholder="Stock"><br>
                    </div>

                    <div class="col-lg-1">
                        <label>Buscar</label>
                        <button readonly type="button" class="btn btn-warning" onclick="modal_productoos();" title="Buscar un producto"><i class="fa fa-search"></i></button><br>
                    </div><br>

                    <div class="col-lg-2">
                        <label for="">Fecha fin</label>
                        <input readonly class="form-control" id="fecha_fin" type="date"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Tipo promocion</label>
                        <input readonly class="form-control" id="tipo_pro" type="text"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Descuento % promocion</label>
                        <input readonly class="form-control" id="descuento_promo" value="0" type="number"><br>
                    </div>

                    <div class="col-lg-12">
                    </div>

                    <div class="col-lg-2">
                        <label for="">Cantidad por unidad</label> &nbsp;&nbsp; <label style="color:red;" id="cantidada_obligg_a"></label>
                        <input min="1" class="form-control" id="cantidad" type="number" min="1" value="0" onkeypress="return soloNumeros(event)"><br>
                    </div>

                    <div class=" col-lg-2">
                        <label for="">Precio $/</label> &nbsp;&nbsp; <label style="color:red;" id="precio_obligg_a"></label>
                        <input readonly type="text" value="0" class="form-control" id="precio" style="background: #dd4b39; color: white;"><br>
                    </div>

                    <div class="col-lg-2">
                        <label for="">Descuento %</label> &nbsp;&nbsp; <label style="color:red;" id="descuenot_obligg_a"></label>
                        <input onkeypress="return filterfloat(event, this);" min="0" type="text" value="0" class="form-control" id="descuento"><br>
                    </div>

                    <div class="col-lg-2">
                        <label>Ingresar</label><br>
                        <button readonly type="button" class="btn btn-success" onclick="ingresar_producto_venta();" title="Buscar un producto"><i class="fa fa-download"></i> Ingresar</button>
                    </div>

                    <!-- /////////////////////// -->

                    <div class="col-lg-12" style="text-align: center;">
                        <h4><b>.:Detalle de productos:.</b> </h4>
                    </div>

                    <div class="col-lg-12 table-responsive">
                        &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_obligg"></label>
                        <table id="detalle_venta" class="table table-striped table-bordered">
                            <thead bgcolor="black" style="color:#fff;">
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Desc.% promocion</th>
                                    <th>Tipo promo</th>
                                    <th>Desc. moneda</th>
                                    <th>Subtotal</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_detalle_prodcuto_venta">

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
                        <button type="button" class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/servicio/nueva_venta.php');"><i class="fa fa-trash-o"></i> Limpiar</button> -
                        <button type="button" class="btn btn-success" onclick="registrar_venta_()"><i class="fa fa-save"></i> Ingresar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- modal para el listado de los clientes -->
<div class="modal fade" id="modal__lista_cliente" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"><b><i class="fa fa-list"></i> Listado de clientes</b></h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <table id="tabla_cliente_agg" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Nombres</th>
                                    <th>Sexo</th>
                                    <th>N° documento</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Nombres</th>
                                    <th>Sexo</th>
                                    <th>N° documento</th>
                                    <th>Correo</th>
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


<!-- modal para el listado de los producto -->
<div class="modal fade" id="modal__lista_prroductos_venta" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"><b><i class="fa fa-list"></i> Listado de productos</b></h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12 table-responsive">
                        <table id="tabla_productos_venta_agg" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Estado</th>
                                    <th>Destacado</th>
                                    <th>Codigo Prod.</th>
                                    <th>Foto</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
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
                                    <th>Destacado</th>
                                    <th>Codigo Prod.</th>
                                    <th>Foto</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
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
    $(".tipo_compro").select2();

    $("#tipo_comprobante").change(function() {
        var dato = $("#tipo_comprobante").val();
        if (dato == "BOLETA") {
            $("#inpuesto").val("0");
        } else {
            $("#inpuesto").val("12");
        }
    });

    listar_clientes_agg();
    listado_prodcutos_venta_agg();


    function ingresar_producto_venta() {
        ////
        var impuesto = $("#inpuesto").val();
        //////
        var id_pro = $("#id_producto_agg").val();

        var nombre = $("#nombre_prodc").val();
        var tipo = $("#tipo_producto").val();
        var marca = $("#marca_product").val();
        //////
        var stock = $("#stock_product").val();
        /////
        var tipo_pro = $("#tipo_pro").val();
        ////
        var cantidad = $("#cantidad").val();
        var precio = $("#precio").val();
        var descuento = $("#descuento").val();
        /////
        var desc_promo = $("#descuento_promo").val();
        ///
        var subtotal = 0;
        var total = 0;
        var des_promo = 0;
        des_promo = desc_promo;

        if (impuesto.length == 0) {
            $("#impuesto_obligg").html("No hay impuesto");
            return Swal.fire(
                "Mensaje de advertencia",
                "Debe ingresar el valor de inpuesto",
                "warning"
            );
        } else {
            $("#impuesto_obligg").html("");
        }

        if (id_pro.length == 0 || nombre.length == 0) {
            $("#producto_obligg_a").html("Ingrese el producto");
            $("#codigog_obligg_a").html("Ingrese codigo");
            return Swal.fire(
                "Mensaje de advertencia",
                "Debe ingresar datos del producto",
                "warning"
            );
        } else {
            $("#producto_obligg_a").html("");
            $("#codigog_obligg_a").html("");
        }

        if (stock.length == 0 || stock == 0) {
            $("#stock_obligg_a").html("No hay stock");
            return Swal.fire(
                "Mensaje de advertencia",
                "No hay stock de producto",
                "warning"
            );
        } else {
            $("#stock_obligg_a").html("");
        }

        if (verificar_producto_venta_id(id_pro)) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El producto '" +
                nombre +
                " - " +
                tipo +
                " - " +
                marca +
                "' , ya fue agregado al detalle",
                "warning"
            );
        }

        if (tipo_pro.length > 0) {
            if (tipo_pro == "Descuento") {
                des_promo = parseFloat((precio * desc_promo) / 100).toFixed(2);
            }
        } else {
            tipo_pro = "Sin pormocion"
        }

        if (cantidad.length == 0 || cantidad == 0) {
            $("#cantidada_obligg_a").html("Ingrese cantidad");
            return Swal.fire(
                "Mensaje de advertencia",
                "Ingrese cantidad de producto",
                "warning"
            );
        } else {
            $("#cantidada_obligg_a").html("");
        }

        if (precio.length == 0 || precio == 0) {
            $("#precio_obligg_a").html("No hay precio");
            return Swal.fire(
                "Mensaje de advertencia",
                "No hya precio de producto",
                "warning"
            );
        } else {
            $("#precio_obligg_a").html("");
        }

        if (parseInt(cantidad) < 1) {
            $("#cantidada_obligg_a").html("X");
            return Swal.fire(
                "Mensaje de advertencia",
                "La cantidad debe ser mayor a cero (0)",
                "warning"
            );
        } else {
            $("#cantidada_obligg_a").html("");
        }

        if (parseInt(cantidad) > parseInt(stock)) {
            $("#cantidada_obligg_a").html("X");
            $("#stock_obligg_a").html("X");
            return Swal.fire(
                "Mensaje de advertencia",
                "La cantidad '" + cantidad + "' no debe ser mayor a stock '" + stock + "'",
                "warning"
            );
        } else {
            $("#stock_obligg_a").html("");
            $("#cantidada_obligg_a").html("");
        }

        if (descuento.length == 0 || descuento.text == "") {
            $("#descuenot_obligg_a").html("X");
            return Swal.fire(
                "Mensaje de advertencia",
                "El campo descuento moneda, no puede quedar vacion",
                "warning"
            );
        } else {
            $("#descuenot_obligg_a").html("");
        }

        cantidad = $("#cantidad").val();
        var desd = parseFloat(precio * descuento / 100).toFixed(2);
        subtotal = parseFloat((cantidad * precio - desd)).toFixed(2);
        total = parseFloat(subtotal - des_promo).toFixed(2);


        if ($("#tipo_pro").val() != "") {
            if (tipo_pro == "2 x 1") {
                $("#cantidad").val("2");
                cantidad = $("#cantidad").val();
                if ($("#cantidad").val() % 2 == 0) {
                    subtotal = parseFloat((cantidad * precio) / cantidad).toFixed(2);
                    total = parseFloat(subtotal - des_promo - desd).toFixed(2);

                }
            }
        }

        if (total < 0) {
            return Swal.fire(
                "Mensaje de advertencia",
                "El subtotal del a pagar es '" + total + "', no es posible ingresar valores nagativos",
                "warning"
            );
        }

        //aqui agrego los labores para unir a la tabla
        var datos_agg = "<tr>";
        datos_agg += "<td for='id'>" + id_pro + "</td>";
        datos_agg += "<td>" + nombre + " - " + tipo + " - " + marca + "</td>";
        datos_agg += "<td>" + cantidad + "</td>";
        datos_agg += "<td>" + precio + "</td>";
        datos_agg += "<td>" + des_promo + "</td>";
        datos_agg += "<td>" + tipo_pro + "</td>";
        datos_agg += "<td>" + desd + "</td>";
        datos_agg += "<td>" + total + "</td>";
        datos_agg +=
            "<td><button onclick='remove_producto_venta_detalle(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
        datos_agg += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_prodcuto_venta").append(datos_agg);

        sumartotalneto();

        $("#id_producto_agg").val("");
        $("#nombre_prodc").val("");
        $("#codigo_pro").val("");
        $("#tipo_producto").val("");
        $("#marca_product").val("");
        $("#stock_product").val("");

        $("#precio").val("0");
        $("#cantidad").val("0");
        $("#descuento").val("0");

        $("#fecha_ini").val("");
        $("#fecha_fin").val("");
        $("#tipo_pro").val("");
        $("#descuento_promo").val("0");

    }

    function remove_producto_venta_detalle(t) {
        var td = t.parentNode;
        var tr = td.parentNode;
        var table = tr.parentNode;
        table.removeChild(tr);
        sumartotalneto();
    }

    //esta funcion es para el tota neto
    function sumartotalneto() {
        let arreglo_total = new Array();
        let count = 0;
        let total = 0;
        let impuestototal = 0;
        let subtotal = 0;
        let impuesto = document.getElementById("inpuesto").value;

        $("#detalle_venta tbody#tbody_detalle_prodcuto_venta tr").each(function() {
            arreglo_total.push($(this).find("td").eq(7).text());
            count++;
        });

        for (var i = 0; i < count; i++) {
            var suma = arreglo_total[i];
            subtotal = (parseFloat(subtotal) + parseFloat(suma)).toFixed(2);
            impuestototal = parseFloat(subtotal * impuesto / 100).toFixed(2);
        }
        total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

        $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
        $("#lbl_impuesto").html(
            "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
        );
        $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);

        $("#txt_totalneto").val(subtotal);
        $("#txt_impuesto").val(impuestototal);
        $("#txt_a_pagar").val(total);

    }

    //esta funcion es para verificar si el id de la tabla de repide
    function verificar_producto_venta_id(id_pro) {
        let idverificar = document.querySelectorAll(
            "#tbody_detalle_prodcuto_venta td[for='id']"
        );
        return (
            [].filter.call(idverificar, (td) => td.textContent == id_pro).length == 1
        );
    }
</script>