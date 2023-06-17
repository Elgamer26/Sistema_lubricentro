<script type="text/javascript" src="js/empleado.js"></script>

<?php
date_default_timezone_set('America/Guayaquil');
$time = date('H:i', time());
$fecha = date("Y-m-d");
?>

<section class="content-header">
    <h1>
        <b> Rol de pagos <i class="fa fa-dollar"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Rol de pagos</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-money"></i> Crear rol de pagos </h3>
            </div>

            <div class="row">

                <div class="col-lg-12">

                    <div class="col-sm-4 form-group">
                        <label>Empleado</label> &nbsp;&nbsp; <label style="color:red;" id="id_empleado_obliga"></label>
                        <select id="id_empleado" class="id_empleado form-control" style="width: 100%"> </select>
                    </div>

                    <div class="col-sm-2 form-group">
                        <label>Fecha pago</label>
                        <input readonly type="date" value="<?php echo $fecha; ?>" class="form-control" id="fecha_pago">
                    </div>

                    <div class="col-lg-2">
                        <label for="hora">Hora</label>
                        <input readonly type="time" maxlength="5" class="form-control" id="hora" value="<?php echo $time ?>"><br>
                    </div>


                    <div class="col-sm-2 form-group">
                        <label>Valor hora</label> &nbsp;&nbsp; <label style="color:red;" id="apellido_obliga"></label>
                        <input type="text" readonly class="form-control" id="valor_hora">
                    </div>

                    <div class="col-sm-1 form-group">
                        <label style="color:green;"><b>Total</b></label>
                        <input type="text" readonly class="form-control" id="monto_dra">
                    </div>

                    <div id="benecios_rol" class="col-sm-1 form-group">
                        <label>Beneficios</label>
                        <button class="btn btn-primary" onclick="modal_beneficios();"> <i class="fa fa-plus"></i> </button>
                    </div>

                    <div style="display:none;" id="tabla_multas_em" class="col-lg-12 table-responsive">
                        <label><b>Multas sanciones</b></label>
                        <table id="tabla_sanciones" class="table table-striped table-bordered">
                            <thead bgcolor="red" style="color:#fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha multa</th>
                                    <th>Tipo de sancion</th>
                                    <th>Motivo</th>
                                    <th>Multa</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_detalle_sanciones">

                            </tbody>
                        </table>

                        <div class="col-lg-12" style="text-align: right;">
                            <label style="color: red;" id="lbl_total_sanciones"></label>
                            <input type="hidden" id="txt_total_sanciones">
                        </div>

                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: 0px;">
                            <b>
                                <h4 class="box-title"> <b>Asistencias</b></h4>
                            </b>
                        </div>
                    </div>
                    <div class="ibox-body">
                        <div class="col-lg-12 table-responsive">
                            &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_asistencia_obligg"></label>
                            <table id="detalle_tabla_asistencia" class="table table-striped table-bordered">
                                <thead bgcolor="black" style="color:#fff;">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Hora ingreso</th>
                                        <th>Hora salida</th>
                                        <th>Costo por hora</th>
                                        <th>Horas</th>
                                        <th>Estado</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>

                                <tbody id="tbody_detalle_tabla_asistencia">

                                </tbody>
                            </table>

                            <div class="col-lg-12" style="text-align: right;">
                                <label style="color:green;" id="lbl_total_asistencias"></label>
                                <input type="hidden" id="txt_total_asistencias">
                            </div>

                            <div class="col-lg-12" style="text-align: right;">
                                <label style="color: red;" id="lbl_total_faltas"></label>
                                <input type="hidden" id="txt_total_faltas">
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox ibox-success">
                        <div class="col-lg-12">
                            <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: 0px;">
                                <b>
                                    <h4 class="box-title"> <b>Ingresos</b></h4>
                                </b>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="col-lg-12 table-responsive">
                                &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_ingreso_obligg"></label>
                                <table id="detalle_tabla_ingreso" class="table table-striped table-bordered">
                                    <thead bgcolor="black" style="color:#fff;">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbody_detalle_ingreso">

                                    </tbody>
                                </table>

                                <div class="col-lg-12" style="text-align: right;">
                                    <label style="color:green;" id="lbl_total_ingreso"></label>
                                    <input type="hidden" id="txt_total_ingreso">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox ibox-danger">
                        <div class="col-lg-12">
                            <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: 0px;">
                                <b>
                                    <h4 class="box-title"> <b>Egresos</b></h4>
                                </b>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="col-lg-12 table-responsive">
                                &nbsp;&nbsp; <label style="color:red; text-align: center;" id="detalle_eggreso_obligg"></label>
                                <table id="detalle_tabla_egreso" class="table table-striped table-bordered">
                                    <thead bgcolor="black" style="color:#fff;">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbody_detalle_egreso">

                                    </tbody>

                                </table>

                                <div class="col-lg-12" style="text-align: right;">
                                    <label style="color:red;" id="lbl_total_egreso"></label>
                                    <input type="hidden" id="txt_total_egreso">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="box-header with-border center" style="text-align: center; background: orange; color:black; padding: 0px;">
                            <b>
                                <h4 class="box-title"><b><i class="fa fa-dollar"></i> Neto a pagar : <span id="lbl_neto_pagar"></span> </b> </h4> <input type="hidden" id="txtneto_pagar">
                            </b>
                        </div>
                    </div>
                </div>

                <br>

                <div class="col-lg-12" style="padding: 30px;">
                    <div class="box-header with-border center" style="text-align: center; color:black; padding: 0px;">
                        <button class="btn btn-primary" onclick="Crear_rol_pagos();"> <i class="fa fa-money"></i> Crear rol de pagos</button> - <button class="btn btn-danger" onclick="cargar_contenido('contenido_principal','vista/empleado/rol_pagos.php');"> <i class="fa fa-times"></i> Limpiar</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- ///////////////////este formulario es para editar el usuario-->
<div class="modal fade" id="modal_benficios_rol_pagoss" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Beneficios</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">

                        <table id="tabla_beneficios_rol" class="table table-striped table-bordered">
                            <thead bgcolor="black" style="color:#fff;">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Tipo</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>

                            <tbody id="tbody_beneficios_rol">

                            </tbody>

                        </table>

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
    listar_comob_empplado();
    $(".id_empleado").select2();
    listar_bebficios_rol();

    ////////////////////////
    function listar_comob_empplado() {
        funcion = "listar_comob_empplado";
        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
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
                        "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#id_empleado").html(cadena);
                var id = $("#id_empleado").val();
                traer_costo_hora(parseInt(id));
                // traer_asistencias(parseInt(id));
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#id_empleado").html(cadena);
            }
        });
    }

    $("#id_empleado").change(function() {
        var id = $("#id_empleado").val();
        traer_costo_hora(parseInt(id));
        // traer_asistencias(parseInt(id));
    });

    function traer_costo_hora(id) {
        funcion = "traer_costo_hora";
        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id
            },
        }).done(function(response) {
            var data = JSON.parse(response);
            $("#valor_hora").val(data[0]);
            traer_asistencias(parseInt(id));
            traer_multas(parseInt(id));

            $("#tbody_detalle_tabla_asistencia").empty();
            $("#tbody_detalle_ingreso").empty();
            $("#tbody_detalle_egreso").empty();

            ////////////////////
            $("#lbl_total_egreso").html("");
            $("#txt_total_egreso").val("");
            ///////////////
            $("#lbl_total_ingreso").html("");
            $("#txt_total_ingreso").val("");
            //////////////////////
            $("#lbl_neto_pagar").html("");
            $("#txtneto_pagar").val("");
            /////////////////////
            $("#detalle_ingreso_obligg").html("");
            $("#detalle_eggreso_obligg").html("");
            $("#detalle_asistencia_obligg").html("");
        });
    }

    function traer_multas(id) {
        var funcion = "traer_multas";
        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id,
            },
        }).done(function(resp) {

            if (resp != 0) {
                let total = 0;
                var data = JSON.parse(resp);
                var llenat = "";
                data["data"].forEach(row => {

                    llenat += `<tr>
                    <td>${row["id_multa"]}</td>
                    <td>${row["fecha"]}</td>
                    <td>${row["tipo"]}</td>
                    <td>${row["observacion"]}</td>
                    <td>${row["monto"]}</td> 
                    </tr>`;

                    total = parseFloat(total) + parseFloat(row["monto"]);
                });

                $("#lbl_total_sanciones").html("<b>Total multa: </b> $ " + parseFloat(total).toFixed(2));
                $("#txt_total_sanciones").val(parseFloat(total).toFixed(2));

                $("#tbody_detalle_sanciones").html(llenat);
                $("#tabla_multas_em").css("display", "block");

                
                cargar_multas();
                // cargar_faltas();
            } else {
                $("#tbody_detalle_sanciones").empty();
                $("#tabla_multas_em").css("display", "none");
                $("#lbl_total_sanciones").html("");
                $("#txt_total_sanciones").val("");
            }
        });
    }

    function traer_asistencias(id) {
        var funcion = "traer_asistencias";
        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: {
                funcion: funcion,
                id: id,
            },
        }).done(function(resp) {
            if (resp != 0) {
                var costoxhora = $("#valor_hora").val();
                var hora1, hora2, t1 = new Date(),
                    t2 = new Date(),
                    horas, total_pago = 0;
                let subtotal = 0,
                    sib_faltas = 0;

                var data = JSON.parse(resp);
                var llenat = "";
                data["data"].forEach(row => {

                    hora1 = (row["hora_salida"]).split(":");
                    hora2 = (row["hora_ingreso"]).split(":");

                    t1.setHours(hora1[0], hora1[1], hora1[2]);
                    t2.setHours(hora2[0], hora2[1], hora2[2]);

                    //Aquí hago la resta
                    t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes(), t1.getSeconds() - t2.getSeconds());
                    //Imprimo el resultado
                    horas = (t1.getHours() + 1);
                    total_pago = parseFloat(horas * costoxhora).toFixed(2);

                    llenat += `<tr>
                    <td>${row["id_asistencia"]}</td>
                    <td>${row["fecha"]}</td>
                    <td>${row["hora_ingreso"]}</td>
                    <td>${row["hora_salida"]}</td>
                    <td>${costoxhora}</td>
                    <td>${horas}</td>
                    <td>${row["asistencia"]}</td>
                    <td>${total_pago}</td>
                    </tr>`;

                    if (row["asistencia"] == 'Asistio') {
                        subtotal = (parseFloat(subtotal) + parseFloat(total_pago)).toFixed(2);
                    } else {
                        sib_faltas = (parseFloat(sib_faltas) + parseFloat(total_pago)).toFixed(2);
                    }

                });

                $("#monto_dra").val(subtotal);

                $("#txt_total_asistencias").val(subtotal);
                $("#lbl_total_asistencias").html("<b>Total asistencias: $ " + subtotal + "</b>");

                $("#txt_total_faltas").val(sib_faltas);
                $("#lbl_total_faltas").html("<b>Total faltas: $ " + sib_faltas + "</b>");

                $("#tbody_detalle_tabla_asistencia").html(llenat);
                $("#detalle_asistencia_obligg").html("");
                cargar_pago();
                cargar_faltas();
            } else {
                $("#detalle_asistencia_obligg").html("El empleado no tiene asistencias registradas");

                $("#txt_total_asistencias").val("");
                $("#lbl_total_asistencias").html("");

                $("#txt_total_faltas").val("");
                $("#lbl_total_faltas").html("");

                $("#tbody_detalle_tabla_asistencia").empty();
                $("#tbody_detalle_ingreso").empty();
                $("#tbody_detalle_egreso").empty();
            }
        });
    }


    //////////////////////
    function cargar_pago() {
        var valor = $("#monto_dra").val();
        var datos = "Sueldo";
        var count = 0;

        var datos_agg_sueldo = "<tr>";
        datos_agg_sueldo += "<td for='id'>" + count + "</td>";
        datos_agg_sueldo += "<td>" + datos + "</td>";
        datos_agg_sueldo += "<td>" + valor + "</td>";
        datos_agg_sueldo += "<td style='color:green;'>Sueldo</td>";
        datos_agg_sueldo += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_ingreso").append(datos_agg_sueldo);

        calculat_ingreso();
    }

    function cargar_faltas() {
        var valor_falta = $("#txt_total_faltas").val();
        if (valor_falta == 0 || valor_falta.length == 0 || valor_falta == "0" || valor_falta == "") {
            $("#tbody_detalle_egreso").empty();
        } else {
            var nombre = "Falta por asistencia";
            var count = 0;

            var datos_agg_multas = "<tr>";
            datos_agg_multas += "<td for='id'>" + count + "</td>";
            datos_agg_multas += "<td>" + nombre + "</td>";
            datos_agg_multas += "<td>" + valor_falta + "</td>";
            datos_agg_multas += "<td style='color:red;'>Falta asistencia</td>";
            datos_agg_multas += "</tr>";

            //esto me ayuda a enviar los datos a la tabla
            $("#tbody_detalle_egreso").append(datos_agg_multas);
        }
        calcular_egreso();
    }

    function cargar_multas() {
        var valor_multa = $("#txt_total_sanciones").val();
        var nombre = "Valor de las multas";
        var count = 0;

        var datos_agg_multas = "<tr>";
        datos_agg_multas += "<td for='id'>" + count + "</td>";
        datos_agg_multas += "<td>" + nombre + "</td>";
        datos_agg_multas += "<td>" + valor_multa + "</td>";
        datos_agg_multas += "<td style='color:red;'>Multa/sancion</td>";
        datos_agg_multas += "</tr>";

        //esto me ayuda a enviar los datos a la tabla
        $("#tbody_detalle_egreso").append(datos_agg_multas);

        calcular_egreso();
    }
</script>