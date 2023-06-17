<script type="text/javascript" src="../ADMIN/js/servicio.js"></script>

<section class="content-header">
    <h1>
        <b> Calendario de reservas <i class="fa fa-calendar"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Calendario de reservas</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Calendario de citas</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-11">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>

<script>
    $(document).ready(function() {
        activar_fullcalendario();
    });

    ///////////////////////////////////
    function activar_fullcalendario() {
        var n = new Date();
        var y = n.getFullYear();
        var m = n.getMonth() + 1;
        var d = n.getDate();
        if (d < 10) {
            d = '0' + d;
        }
        if (m < 10) {
            m = '0' + m;
        }
        var dia = y + "-" + m + "-" + d;

        $('#calendar').fullCalendar({
            height: 650,
            header: {
                language: 'es',
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultDate: dia,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectHelper: true,
            selectable: true,
            //-----------------
            customButtons: {
                // este boton yo lo cree
                Miboton: {
                    text: "Boton 1",
                    click: function() {
                        alert("Acciom del boton");
                    }
                }
            },

            // //esto es para obtener los valores de dia fecha y cambir de color
            // dayClick: function(date, jsEvent, view) {
            //     //  limpiar_datos();
            //     // alert("valor es: " + date.format() + " Vista actual: " + dia);

            //     if (dia > date.format()) {
            //         return Swal.fire(
            //             "Mensaje de advertencia",
            //             "La fecha seleccionada '" +
            //             date.format() +
            //             "' es menor que la fecha '" +
            //             dia +
            //             "'",
            //             "warning"
            //         );
            //     }

            //     $("#nombre_obliga").html("");
            //     $("#asunto_obligg").html("");
            //     $("#nota_obligg").html("");

            //     $("#titulo_evento_re").html("Fecha seleccionada: " + date.format());
            //     $("#txtfecha_registrro").val(date.format());
            //     $("#fecha_evento_fin").val(date.format());

            //     $(this).css("background", "#fcf8e3");

            //     $("#modal_registro").modal({
            //         backdrop: "static",
            //         keyboard: false,
            //     });
            //     $("#modal_registro").modal("show");
            // },

            events: "../ADMIN/controlador/servicio/listar_calendario.php",

            //este funcion mostrara los datos del evento seleccionado del cintillo
            eventClick: function(calEvent, jsEvent, view) {

                $("#id_cita").val(calEvent.id_cita);
                $("#id_cliente_editar").val(calEvent.cliente_id);
                $("#fecha_cita_edita").val(moment(calEvent.start).format("YYYY-MM-DD"));
                $("#titulo_evento_editar").html("Editar cita: " + moment(calEvent.start).format("YYYY-MM-DD"));
                $("#hora_cita_edit").val(moment(calEvent.start).format("HH:mm"));
                $("#nombres_edit").val(calEvent.cliente);
                $("#cedula_editar").val(calEvent.cedula);
                $("#asunto_asunto").val(calEvent.titulo);
                $("#nota_editar").val(calEvent.descripcion);
                $("#color_editar").val(calEvent.color);
                $("#txt_color").val(calEvent.textColor);

                $("#modal_editar_cita").modal({
                    backdrop: "static",
                    keyboard: false,
                });
                $("#modal_editar_cita").modal("show");
            },

            //este es para cuandos se mueve el evento lo actualize
            eventDrop: function(calEvent) {

                if (dia > moment(calEvent.start).format("YYYY-MM-DD")) {
                    $("#calendar").fullCalendar("refetchEvents");
                    return Swal.fire(
                        "Mensaje de advertencia",
                        "La fecha seleccionada '" +
                        moment(calEvent.start).format("YYYY-MM-DD") +
                        "' es menor que la fecha '" +
                        dia +
                        "', no se puede editar esta cita",
                        "warning"
                    );
                }

                $("#id_cita").val(calEvent.id_cita);
                $("#id_cliente_editar").val(calEvent.cliente_id);
                $("#fecha_cita_edita").val(moment(calEvent.start).format("YYYY-MM-DD"));
                $("#titulo_evento_editar").html("Editar cita: " + moment(calEvent.start).format("YYYY-MM-DD"));
                $("#hora_cita_edit").val(moment(calEvent.start).format("HH:mm"));
                $("#nombres_edit").val(calEvent.cliente);
                $("#cedula_editar").val(calEvent.cedula);
                $("#asunto_asunto").val(calEvent.titulo);
                $("#nota_editar").val(calEvent.descripcion);
                $("#color_editar").val(calEvent.color);
                $("#txt_color").val(calEvent.textColor);
                editar_eventDrop();
            }
        });
    }
</script>


<form id="frm_registrar" onsubmit="return false">
    <div class="modal fade" id="modal_registro">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background: #00a65a; color:white;">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="titulo_evento_re"></h4>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <input hidden type="text" id="txtfecha_registrro">
                        <input hidden type="number" id="id_cliente">

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="cedula">Cedula</label>
                                <input disabled type="text" maxlength="10" class="form-control" id="cedula" onkeypress="return soloNumeros(event)">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="nombres">Nombres del cliente</label> &nbsp;&nbsp; <label style="color:red;" id="nombre_obliga"></label>
                                <input disabled type="text" class="form-control" id="nombres">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="sexo_pac">Sexo</label> &nbsp;&nbsp; <label style="color:red;" id="sexo_obligg"></label>
                                <input type="text" readonly class="form-control" id="sexo_pac">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="fecha_pac">Fecha Nac.</label>
                                <input type="text" readonly class="form-control" id="fecha_pac">
                            </div>
                        </div>

                        <div class="col-lg-1">
                            <label>Buscar</label>
                            <button onclick="consulta_cliente();" class="btn btn-primary"><i class="fa fa-eye"></i></button>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="asunto">Asunto</label> &nbsp;&nbsp; <label style="color:red;" id="asunto_obligg"></label>
                                <input type="text" class="form-control" id="asunto">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="color">Color etiqueta</label>
                                <input type="color" class="form-control" id="color" value="#ff0000" name="color">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="color_etiqueta">Color letra</label>
                                <input type="color" class="form-control" id="color_etiqueta" value="#FFFFFF" name="color_etiqueta">
                            </div>
                        </div>

                        <?php
                        date_default_timezone_set('America/Guayaquil');
                        $time = date('H:i', time());
                        ?>

                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="hora_enevto">Hora</label>
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="time" maxlength="5" class="form-control" value="<?php echo $time ?>" id="hora_enevto" onkeypress="return soloNumeros(event)"><br>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nota">Nota</label> &nbsp;&nbsp; <label style="color:red;" id="nota_obligg"></label>
                                <textarea class="form-control" id="nota" cols="3" rows="3" style="resize: none;"></textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="background: silver;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close" style=" font-size: 20px;"></i> Cerrar</button>
                    <button id="btn_registrar_cita" type="button" class="btn btn-success"><i class="fa fa-save"></i> Registrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="modal fade" id="modal_editar_cita">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titulo_evento_editar"></h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="number" id="id_cita">
                    <input hidden type="number" id="id_cliente_editar">

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="cedula_editar">Cedula</label>
                            <input disabled type="text" maxlength="10" class="form-control" id="cedula_editar" onkeypress="return soloNumeros(event)">
                        </div>
                    </div>

                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="nombres_edit">Nombres del cliente</label>
                            <input disabled type="text" class="form-control" id="nombres_edit">
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="asunto_asunto">Asunto</label> &nbsp;&nbsp; <label style="color:red;" id="asunto_edit_obligg"></label>
                            <input type="text" class="form-control" id="asunto_asunto">
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="fecha_cita_edita">Fecha</label>
                            <input type="date" class="form-control" id="fecha_cita_edita">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="hora_cita_edit">Hora Inicio</label>
                            <div class="input-group clockpicker" data-autoclose="true">
                                <input type="text" maxlength="5" class="form-control" id="hora_cita_edit" onkeypress="return soloNumeros(event)">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="nota_editar">Nota</label> &nbsp;&nbsp; <label style="color:red;" id="nota_edit_obligg"></label>
                            <textarea class="form-control" id="nota_editar" cols="3" rows="3" style="resize: none;"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="color_editar">Color etiqueta </label>
                            <input type="color" class="form-control" id="color_editar" value="#ff0000">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <label for="txt_color">Color letra</label>
                            <input type="color" class="form-control" id="txt_color" value="#FFFFFF">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close" style=" font-size: 20px;"></i> Cerrar</button>
                <button id="btn_editar_cita" type="button" class="btn btn-success"><i class="fa fa-edit"></i> Editar</button>
                <!-- <button id="btn_inactivar_cita" type="button" style="color: black;" class="btn btn-warning"><i class="fa fa-trash"></i> Eliminar</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_consulta" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 12px;">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align: center;"><b>Listado de clientes</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                        <table id="tabla_clientes_cita" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Nombres</th>
                                    <th>Sexo</th>
                                    <th>N° documento</th>
                                    <th>Fecha nacimiento</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Enviar</th>
                                    <th>Nombres</th>
                                    <th>Sexo</th>
                                    <th>N° documento</th>
                                    <th>Fecha nacimiento</th>
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
    listado_clientesss();
</script>