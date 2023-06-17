<script type="text/javascript" src="../ADMIN/js/empleado.js"></script>

<section class="content-header">
    <h1>
        <b> Beneficios <i class="fa fa-plus"></i> </b> <button class="btn btn-danger" onclick="nuevo_beneficio();"><i class="fa fa-plus"></i> Nuevo beneficio</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Beneficios</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Beneficios </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_beneficios" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre del beneficio</th>
                            <th>Valor/porcentaje</th>
                            <th>Tipo del beneficio</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre del beneficio</th>
                            <th>Valor/porcentaje</th>
                            <th>Tipo del beneficio</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_beneficios" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Nuevo beneficio</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="nombre_beneficio">Nombre beneficio</label>
                        <input type="text" maxlength="150" class="form-control" id="nombre_beneficio" placeholder="Ingrese nombres del beneficio" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-6">
                        <label for="valor_beneficio">Valor</label>
                        <input type="text" maxlength="7" class="form-control" id="valor_beneficio" placeholder="Ingrese porcentaje del beneficio" onkeypress="return filterfloat(event, this);"><br>
                    </div>

                    <div class="col-lg-6">
                        <label for="tipo_beneficio">Tipo beneficio</label>
                        <select id="tipo_beneficio" style="width: 100%" class="tipo_bene form-control">
                            <option value="Ingreso">Ingreso</option>
                            <option value="Egreso">Egreso</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_beneficio()"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_benificio" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar permiso</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="text" id="id_edit_benefiio">

                    <div class="col-lg-12">
                        <label for="nombre_beneficio_edit">Nombre beneficio</label>
                        <input type="text" maxlength="150" class="form-control" id="nombre_beneficio_edit" placeholder="Ingrese nombres del beneficio" onkeypress="return soloLetras(event)"><br>
                    </div>

                    <div class="col-lg-6">
                        <label for="valor_beneficio_edit">Valor</label>
                        <input type="text" maxlength="5" class="form-control" id="valor_beneficio_edit" placeholder="Ingrese porcentaje del beneficio" onkeypress="return filterfloat(event, this);"><br>
                    </div>

                    <div class="col-lg-6">
                        <label for="tipo_beneficio_edir">Tipo beneficio</label>
                        <select id="tipo_beneficio_edir" style="width: 100%" class="tipo_bene form-control">
                            <option value="Ingreso">Ingreso</option>
                            <option value="Egreso">Egreso</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_beneficio()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
    listra_beneficios();
    var funcion, tabla_beneficio;

    function nuevo_beneficio() {

        $("#nombre_beneficio").val("");
        $("#valor_beneficio").val("");

        $("#modal_beneficios").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_beneficios").modal("show");
    }

    /////////////
    function registrar_beneficio() {

        var nombre = $("#nombre_beneficio").val();
        var valor = $("#valor_beneficio").val();
        var tipo = $("#tipo_beneficio").val();

        if (nombre.length == 0 || valor.length == 0) {
            return Swal.fire({
                icon: "warning",
                title: "No hay datos completos no deben quedar campos vacios",
                text: "Ingrese un datos completos no deben quedar campos vacios!!",
            });
        }

        funcion = "registrar_beneficio";
        alerta = ["datos", "Se esta creando el beneficio", "Creando beneficio."];
        mostar_loader_datos(alerta);

        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: {
                funcion: funcion,
                nombre: nombre,
                valor: valor,
                tipo: tipo,
            },
        }).done(function(response) {
            if (response > 0) {
                if (response == 1) {
                    alerta = [
                        "exito",
                        "success",
                        "El beneficio se creo con exito",
                    ];
                    cerrar_loader_datos(alerta);
                    tabla_beneficio.ajax.reload();
                    $("#modal_beneficios").modal("hide");
                } else {
                    alerta = [
                        "existe",
                        "warning",
                        "El beneficio " + nombre + ", ingresado ya existe",
                    ];
                    cerrar_loader_datos(alerta);
                }
            } else {
                alerta = ["error", "error", "No se pudo crear el beneficio"];
                cerrar_loader_datos(alerta);
            }
        });

    }

    function listra_beneficios() {
        funcion = "listra_beneficios";
        tabla_beneficio = $("#tabla_beneficios").DataTable({
            ordering: true,
            paging: true,
            aProcessing: true,
            aServerSide: true,
            searching: {
                regex: true
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            pageLength: 10,
            destroy: true,
            async: false,
            processing: true,

            ajax: {
                url: "../ADMIN/controlador/empleado/empleado.php",
                type: "POST",
                data: {
                    funcion: funcion
                },
            },
            //hay que poner la misma cantidad de columnas y tambien en el html
            columns: [{
                    defaultContent: ""
                },
                {
                    data: "estado",
                    render: function(data, type, row) {
                        if (data == 1) {
                            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el Oftalmólogo'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                        } else {
                            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el Oftalmólogo'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el Oftalmólogo'><i class='fa fa-edit'></i></button>`;
                        }
                    },
                },
                {
                    data: "estado",
                    render: function(data, type, row) {
                        if (data == 1) {
                            return "<span class='label label-success'>ACTIVO</span>";
                        } else {
                            return "<span class='label label-danger'>INACTIVO</span>";
                        }
                    },
                },
                {
                    data: "nombre"
                },
                {
                    data: "valor"
                },
                {
                    data: "tipo"
                },
            ],

            language: {
                rows: "%d fila seleccionada",
                processing: "Tratamiento en curso...",
                search: "Buscar&nbsp;:",
                lengthMenu: "Agrupar en _MENU_ items",
                info: "Mostrando los item (_START_ al _END_) de un total _TOTAL_ items",
                infoEmpty: "No existe datos.",
                infoFiltered: "(filtrado de _MAX_ elementos en total)",
                infoPostFix: "",
                loadingRecords: "Cargando...",
                zeroRecords: "No se encontro resultados en tu busqueda",
                emptyTable: "No hay datos disponibles en la tabla",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Ultimo",
                },
                select: {
                    rows: "%d fila seleccionada",
                },
                aria: {
                    sortAscending: ": active para ordenar la columa en orden ascendente",
                    sortDescending: ": active para ordenar la columna en orden descendente",
                },
            },
            select: true,
            responsive: "true",
            dom: "Bfrtilp",
            buttons: [{
                    extend: "excelHtml5",
                    text: "Excel",
                    titleAttr: "Exportar a Excel",
                    className: "btn btn-success greenlover",
                },
                {
                    extend: "pdfHtml5",
                    text: "PDF",
                    titleAttr: "Exportar a PDF",
                    className: "btn btn-danger redfule",
                },
                {
                    extend: "print",
                    text: "Imprimir",
                    titleAttr: "Imprimir",
                    className: "btn btn-primary azuldete",
                },
            ],
            order: [
                [0, "desc"]
            ],
        });

        //esto es para crearn un contador para la tabla este contador es automatico
        tabla_beneficio.on("draw.dt", function() {
            var pageinfo = $("#tabla_beneficios").DataTable().page.info();
            tabla_beneficio
                .column(0, {
                    page: "current"
                })
                .nodes()
                .each(function(cell, i) {
                    cell.innerHTML = i + 1 + pageinfo.start;
                });
        });
    }

    ///////////////////
    $("#tabla_beneficios").on("click", ".inactivar", function() {
        //esto esta extrayendo los datos de la tabla el (data)
        var data = tabla_beneficio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
        //esta condicion es importante para el responsibe porque salda un error si no lo pongo
        if (tabla_beneficio.row(this).child.isShown()) {
            //esto es cuando esta en tamaño responsibo
            var data = tabla_beneficio.row(this).data();
        }
        var dato = 0;
        var id = data.id_beneficio;

        Swal.fire({
            title: "Cambiar estado?",
            text: "El estado del beneficio se cambiara!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, cambiar!",
        }).then((result) => {
            if (result.isConfirmed) {
                cambiar_estado_beneficio(id, dato);
            }
        });
    });

    $("#tabla_beneficios").on("click", ".activar", function() {
        //esto esta extrayendo los datos de la tabla el (data)
        var data = tabla_beneficio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
        //esta condicion es importante para el responsibe porque salda un error si no lo pongo
        if (tabla_beneficio.row(this).child.isShown()) {
            //esto es cuando esta en tamaño responsibo
            var data = tabla_beneficio.row(this).data();
        }
        var dato = 1;
        var id = data.id_beneficio;

        Swal.fire({
            title: "Cambiar estado?",
            text: "El estado del beneficio se cambiara!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, cambiar!",
        }).then((result) => {
            if (result.isConfirmed) {
                cambiar_estado_beneficio(id, dato);
            }
        });
    });

    function cambiar_estado_beneficio(id, dato) {
        var res = "";
        if (dato == 1) {
            res = "activo";
        } else {
            res = "inactivo";
        }

        funcion = "estado_benedifico";
        alerta = [
            "datos",
            "Se esta cambiando el estado a " + res + "",
            "Cambiando estado",
        ];
        mostar_loader_datos(alerta);

        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: {
                id: id,
                dato: dato,
                funcion: funcion
            },
        }).done(function(response) {
            if (response > 0) {
                if (response == 1) {
                    alerta = ["exito", "success", "EL estado se " + res + " con extio"];
                    cerrar_loader_datos(alerta);
                    tabla_beneficio.ajax.reload();
                }
            } else {
                alerta = [
                    "error",
                    "error",
                    "No se pudo cambiar el estado",
                ];
                cerrar_loader_datos(alerta);
            }
        });
    }

    $("#tabla_beneficios").on("click", ".editar", function() {
        //esto esta extrayendo los datos de la tabla el (data)
        var data = tabla_beneficio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
        //esta condicion es importante para el responsibe porque salda un error si no lo pongo
        if (tabla_beneficio.row(this).child.isShown()) {
            //esto es cuando esta en tamaño responsibo
            var data = tabla_beneficio.row(this).data();
        }

        $("#id_edit_benefiio").val(data.id_beneficio);
        $("#nombre_beneficio_edit").val(data.nombre);
        $("#valor_beneficio_edit").val(data.valor);
        $("#tipo_beneficio_edir").val(data.tipo);

        $("#modal_editar_benificio").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_editar_benificio").modal("show");
    });

    function editar_beneficio() {
        var id = $("#id_edit_benefiio").val();
        var nombre = $("#nombre_beneficio_edit").val();
        var valor = $("#valor_beneficio_edit").val();
        var tipo = $("#tipo_beneficio_edir").val();

        if (nombre.length == 0 || valor.length == 0) {
            return Swal.fire({
                icon: "warning",
                title: "No hay datos completos no deben quedar campos vacios",
                text: "Ingrese un datos completos no deben quedar campos vacios!!",
            });
        }

        funcion = "editr_beneficio";
        alerta = ["datos", "Se esta editando el beneficio", "Editando beneficio."];
        mostar_loader_datos(alerta);

        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
            type: "POST",
            data: {
                funcion: funcion,
                nombre: nombre,
                valor: valor,
                tipo: tipo,
                id: id,
            },
        }).done(function(response) {
            if (response > 0) {
                if (response == 1) {
                    alerta = [
                        "exito",
                        "success",
                        "El beneficio se edito con exito",
                    ];
                    cerrar_loader_datos(alerta);
                    tabla_beneficio.ajax.reload();
                    $("#modal_editar_benificio").modal("hide");
                } else {
                    alerta = [
                        "existe",
                        "warning",
                        "El beneficio " + nombre + ", ingresado ya existe",
                    ];
                    cerrar_loader_datos(alerta);
                }
            } else {
                alerta = ["error", "error", "No se pudo editar el beneficio"];
                cerrar_loader_datos(alerta);
            }
        });
    }
</script>