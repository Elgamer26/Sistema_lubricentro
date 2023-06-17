var funcion,
  tabña_respaldoo,
  tbla_auditoria_ventas,
  tbla_auditoria_compras,
  tbla_auditoria_servicios,
  tabla_vehi_clie_usu;

function verificar_ofertas() {
  funcion = "verificar_ofertas";
  $.ajax({
    url: "../ADMIN/controlador/system/system.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (resp) {
    console.log(resp);
  });
}

////////////////////////////para el dashboard
function traer_datos_dasboard_admin() {
  funcion = "traer_datos_dasboard_admin";
  $.ajax({
    url: "../ADMIN/controlador/system/system.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    $("#Empleados_id").html(data[0]["empleado"][0][0]);
    $("#Clientes_id").html(data[0]["cliente"][0][0]);
    $("#Productos_id").html(data[0]["productos"][0][0]);
    $("#Servicios_id").html(data[0]["servicios"][0][0]);
  });
}

////////////////////////////////
function productos_mas_comprados() {
  var tipo_grafico = "doughnut";
  var nombre_grafico = "Dona";
  funcion = "productos_mas_comprados";
  $.ajax({
    url: "../ADMIN/controlador/system/system.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (response) {
    if (response != 0) {
      var nombre_pr = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(response);
      for (var i = 0; i < data.length; i++) {
        nombre_pr.push(data[i][1]);
        cantidad.push(data[i][0]);
        colores.push(colores_rgb());
      }
      mostrar_graficos_cinco_comprados(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
      );
    } else {
      $("canvas#areaChart_p").remove();
    }
  });
}

function mostrar_graficos_cinco_comprados(
  nombre_pr,
  cantidad,
  tipo_grafico,
  nombre_grafico,
  colores
) {
  //esto es para desctuir el grafico porque sale un error
  $("canvas#areaChart_p").remove();
  $("div.chart_p").append(
    '<canvas id="areaChart_p" style="height:100px"></canvas>'
  );
  ///este es el grafico

  var ctx = document.getElementById("areaChart_p").getContext("2d");
  var myChart = new Chart(ctx, {
    type: tipo_grafico,
    data: {
      labels: nombre_pr,
      datasets: [
        {
          label: nombre_grafico,
          data: cantidad,
          backgroundColor: colores,
          borderColor: colores,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}

////////////////////////////////
function servicios_mas_comprados() {
  var tipo_grafico = "pie";
  var nombre_grafico = "Pastel";
  funcion = "servicios_mas_comprados";
  $.ajax({
    url: "../ADMIN/controlador/system/system.php",
    type: "POST",
    data: {
      funcion: funcion,
    },
  }).done(function (response) {
    if (response != 0) {
      var nombre_pr = [];
      var cantidad = [];
      var colores = [];
      var data = JSON.parse(response);
      for (var i = 0; i < data.length; i++) {
        nombre_pr.push(data[i][1]);
        cantidad.push(data[i][0]);
        colores.push(colores_rgb());
      }
      mostrar_graficos_servicios(
        nombre_pr,
        cantidad,
        tipo_grafico,
        nombre_grafico,
        colores
      );
    } else {
      $("canvas#areaChart_s").remove();
    }
  });
}

function mostrar_graficos_servicios(
  nombre_pr,
  cantidad,
  tipo_grafico,
  nombre_grafico,
  colores
) {
  //esto es para desctuir el grafico porque sale un error
  $("canvas#areaChart_s").remove();
  $("div.chart_s").append(
    '<canvas id="areaChart_s" style="height:100px"></canvas>'
  );
  ///este es el grafico

  var ctx = document.getElementById("areaChart_s").getContext("2d");
  var myChart = new Chart(ctx, {
    type: tipo_grafico,
    data: {
      labels: nombre_pr,
      datasets: [
        {
          label: nombre_grafico,
          data: cantidad,
          backgroundColor: colores,
          borderColor: colores,
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
}

/// par los graficos
function colores_rgb() {
  var coolor =
    "(" +
    generar_numero(255) +
    "," +
    generar_numero(255) +
    "," +
    generar_numero(255) +
    ")";
  return "rgb" + coolor;
}

function generar_numero(numero) {
  return (Math.random() * numero).toFixed(0);
}

//////////////////////////////////////
//////////////////////////////////////
function ver_modal_respaldo() {
  $("#ingres_pass").val("");
  $("#conf_pass").val("");

  $("#model_respando_datos").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#model_respando_datos").modal("show");
}

//////////////////
function realizar_respaldo() {
  var pass1 = $("#ingres_pass").val();
  var pass2 = $("#conf_pass").val();

  if (pass1.length == 0 || pass2.length == 0) {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese los password para ralizar el respaldo",
      "warning"
    );
  }

  if (pass1 != pass2) {
    return swal.fire(
      "Mensaje de advertencia",
      "Los 2 password no coinciden",
      "warning"
    );
  }

  funcion = "realizar_respaldo";
  alerta = [
    "datos",
    "Se esta creando el respaldo de informacion",
    "Creando respaldo",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/system/system.php",
    type: "POST",
    data: {
      funcion: funcion,
      pass1: pass1,
    },
  }).done(function (response) {
    if (response == 10) {
      alerta = [
        "error",
        "error",
        "El password ingresado es incorrecto o no pertenece a este usuario",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == 20) {
      alerta = ["error", "error", "No se pudo crear el respaldo"];
      cerrar_loader_datos(alerta);
    } else if (response == 1) {
      $("#model_respando_datos").modal("hide");
      tabña_respaldoo.ajax.reload();
      alerta = ["exito", "success", "El respaldo se creo con exito"];
      cerrar_loader_datos(alerta);
    } else {
      alerta = ["error", "error", "No se pudo crear el respaldo"];
      cerrar_loader_datos(alerta);
    }
  });
}

/////////////////
function listar_respaldo() {
  funcion = "listar_respaldo";
  tabña_respaldoo = $("#tbla_respaldp").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/system/system.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "ruta",
        render: function (data, type, row) {
          return `<a href="${data}" style='font-size:13px;' type='button' class='inactivar btn btn-success' title='Inactivar el Oftalmólogo'> <i class="fa fa-download"></i> </a> `;
        },
      },
      { data: "usuario" },
      { data: "fecha_hora" },
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
    buttons: [
      {
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabña_respaldoo.on("draw.dt", function () {
    var pageinfo = $("#tbla_respaldp").DataTable().page.info();
    tabña_respaldoo
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

/////////////////
function listar_auditoria_ventas() {
  funcion = "listar_auditoria_ventas";
  tbla_auditoria_ventas = $("#tbla_auditoria_ventas").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/system/system.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "operacion",
        render: function (data, type, row) {
          if (data == "Inserto venta") {
            return (
              "<span style='font-size: 14px;' class='label label-success'>" +
              data +
              "</span>"
            );
          } else {
            return (
              "<span style='font-size: 14px;' class='label label-danger'>" +
              data +
              "</span>"
            );
          }
        },
      },
      { data: "usuario" },
      { data: "fecha_hora" },
      { data: "n_venta" },
      { data: "cantidad" },
      { data: "total" },
      { data: "app" },
      { data: "ip" },
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
    buttons: [
      {
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tbla_auditoria_ventas.on("draw.dt", function () {
    var pageinfo = $("#tbla_auditoria_ventas").DataTable().page.info();
    tbla_auditoria_ventas
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

/////////////////
function listar_auditoria_compras() {
  funcion = "listar_auditoria_compras";
  tbla_auditoria_compras = $("#tbla_auditoria_compras").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/system/system.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "operacion",
        render: function (data, type, row) {
          if (data == "Inserto compra") {
            return (
              "<span style='font-size: 14px;' class='label label-success'>" +
              data +
              "</span>"
            );
          } else {
            return (
              "<span style='font-size: 14px;' class='label label-danger'>" +
              data +
              "</span>"
            );
          }
        },
      },
      { data: "usuario" },
      { data: "fecha_hora" },
      { data: "n_venta" },
      { data: "cantidad" },
      { data: "total" },
      { data: "app" },
      { data: "ip" },
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
    buttons: [
      {
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tbla_auditoria_compras.on("draw.dt", function () {
    var pageinfo = $("#tbla_auditoria_compras").DataTable().page.info();
    tbla_auditoria_compras
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

/////////////////
function listar_auditoria_servicios() {
  funcion = "listar_auditoria_servicios";
  tbla_auditoria_servicios = $("#tbla_auditoria_servicios").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/system/system.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "operacion",
        render: function (data, type, row) {
          if (data == "Inserto servicio") {
            return (
              "<span style='font-size: 14px;' class='label label-success'>" +
              data +
              "</span>"
            );
          } else {
            return (
              "<span style='font-size: 14px;' class='label label-danger'>" +
              data +
              "</span>"
            );
          }
        },
      },
      { data: "usuario" },
      { data: "fecha_hora" },
      { data: "n_venta" },
      { data: "total" },
      { data: "app" },
      { data: "ip" },
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
    buttons: [
      {
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tbla_auditoria_servicios.on("draw.dt", function () {
    var pageinfo = $("#tbla_auditoria_servicios").DataTable().page.info();
    tbla_auditoria_servicios
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

/////////cliente usuario
function traer_datos_cliente() {
  funcion = "traer_datos_cliente";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (responce) {
    if (responce != 0) {
      var data = JSON.parse(responce);
      $("#nombre_cliente").val(data[0][1]);
      $("#apellidos").val(data[0][2]);
      $("#direccion_domicilio").val(data[0][5]);
      $("#numero_telefonoo").val(data[0][8]);
      $("#correo_cliente").val(data[0][4]);
      $("#fecha_nacimiento").val(data[0][6]);
      $("#sexo").val(data[0][7]);
      $("#numero_documento").val(data[0][3]);
    }
  });
}

function registrar_cliente_usuario() {
  var nombre = $("#nombre_cliente").val();
  var apellidos = $("#apellidos").val();
  var direccion = $("#direccion_domicilio").val();
  var telefonoo = $("#numero_telefonoo").val();
  var correo = $("#correo_cliente").val();
  var fecha = $("#fecha_nacimiento").val();
  var sexo = $("#sexo").val();
  var numero_documento = $("#numero_documento").val();

  if (
    nombre.length == 0 ||
    apellidos.length == 0 ||
    direccion.length == 0 ||
    telefonoo.length == 0 ||
    correo.length == 0 ||
    numero_documento.length == 0 ||
    fecha.length == 0
  ) {
    validar_registro_cliente_usuario(
      nombre,
      apellidos,
      direccion,
      telefonoo,
      correo,
      numero_documento,
      fecha
    );
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#nombre_obliga").html("");
    $("#app_pat_obliga").html("");
    $("#direccion_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");
    $("#numero_doc_obliga").html("");
    $("#fecha_obliga").html("");
  }

  funcion = "registrar_cliente_usuario";
  alerta = [
    "datos",
    "Se esta editando los datos, por favor espere....",
    ".:Edintado cliente:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      funcion: funcion,
      nombre,
      apellidos,
      direccion,
      telefonoo,
      correo,
      numero_documento,
      fecha,
      sexo,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El cliente se creo con exito :)"];
        cerrar_loader_datos(alerta);
        cargar_contenido("contenido_principal", "vista/datos_cliente.php");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El correo " + correo + " ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 4) {
        alerta = [
          "existe",
          "warning",
          "Los nombres del cliente '" +
            nombre +
            " " +
            apellidos +
            "' ya estan registrados :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 3) {
        alerta = [
          "existe",
          "warning",
          "El numero de documento '" +
            numero_documento +
            "' ya esta registrados :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 20) {
        alerta = [
          "existe",
          "warning",
          "El correo ingresado '" + correo + "' no es valido :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo crear el cliente - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

/// validacion
function validar_registro_cliente_usuario(
  nombre,
  apellidos,
  direccion,
  telefonoo,
  correo,
  numero_documento,
  fecha
) {
  if (nombre.length == 0) {
    $("#nombre_obliga").html("Ingrese nombres");
  } else {
    $("#nombre_obliga").html("");
  }

  if (apellidos.length == 0) {
    $("#app_pat_obliga").html("Ingrese apellidos");
  } else {
    $("#app_pat_obliga").html("");
  }

  if (direccion.length == 0) {
    $("#direccion_obliga").html("Ingrese direccion");
  } else {
    $("#direccion_obliga").html("");
  }

  if (telefonoo.length == 0) {
    $("#telefono_obliga").html("Ingrese telefono");
  } else {
    $("#telefono_obliga").html("");
  }

  if (correo.length == 0) {
    $("#correo_obliga").html("Ingrese correo");
  } else {
    $("#correo_obliga").html("");
  }

  if (numero_documento.length == 0) {
    $("#numero_doc_obliga").html("Ingrese cedula");
  } else {
    $("#numero_doc_obliga").html("");
  }

  if (fecha.length == 0) {
    $("#fecha_obliga").html("Ingrese fecha");
  } else {
    $("#fecha_obliga").html("");
  }
}

///////////
function listado_ventas_cliente() {
  funcion = "listado_ventas_cliente";
  tbla_listado_ventas = $("#tbla_listado_ventas").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/carrito/carrito.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "Vendido") {
            return `<button style='font-size:13px;' type='button' class='pdf btn btn-warning' title='Activar tipo usuario'><i class='fa fa-print'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-eye'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='pdf btn btn-warning' title='Activar tipo usuario'><i class='fa fa-print'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-eye'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "Vendido") {
            return "<span class='label label-success'>Vendido</span>";
          } else {
            return "<span class='label label-danger'>Anulado</span>";
          }
        },
      },
      {
        data: "tipo_pago",
        render: function (data, type, row) {
          if (data == "Caja") {
            return "<span class='label label-warning'>Caja</span>";
          } else {
            return "<span class='label label-primary'>Paypal</span>";
          }
        },
      },
      { data: "cliente" },
      { data: "fecha" },
      { data: "cantidad" },
      { data: "total" },
      { data: "tipo_doc" },
      { data: "numero_comprob" },
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
    buttons: [
      {
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
    order: [[5, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tbla_listado_ventas.on("draw.dt", function () {
    var pageinfo = $("#tbla_listado_ventas").DataTable().page.info();
    tbla_listado_ventas
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

///////////
function lisra_servicios_clientes_usuario() {
  funcion = "lisra_servicios_clientes_usuario";
  tbla_listado_servicios = $("#tbla_listado_servicios").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/carrito/carrito.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button style='font-size:13px;' type='button' class='pdf btn btn-warning' title='Activar tipo usuario'><i class='fa fa-print'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-eye'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='pdf btn btn-warning' title='Activar tipo usuario'><i class='fa fa-print'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-eye'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>Activo</span>";
          } else {
            return "<span class='label label-danger'>Anulado</span>";
          }
        },
      },
      {
        data: "tipo_pago",
        render: function (data, type, row) {
          if (data == "Caja") {
            return "<span class='label label-warning'>Caja</span>";
          } else {
            return "<span class='label label-primary'>Paypal</span>";
          }
        },
      },
      { data: "cliente" },
      { data: "vehiculo" },
      { data: "fecha" },
      { data: "total_servico" },
      { data: "tipo_comprobante" },
      { data: "num_compro" },
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
    buttons: [
      {
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tbla_listado_servicios.on("draw.dt", function () {
    var pageinfo = $("#tbla_listado_servicios").DataTable().page.info();
    tbla_listado_servicios
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

//////////////////lisado de reservas
function listar_reservass_clientes_usuario() {
  funcion = "listar_reservass_clientes_usuario";
  tbala_reservass = $("#tbala_reservass").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/carrito/carrito.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "En espera") {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Anular reserva'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver reservas'><i class='fa fa-eye'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver reservas'><i class='fa fa-eye'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "En espera") {
            return (
              "<span style='font-size:12px;' class='label label-warning'>" +
              data +
              "</span>"
            );
          } else {
            return "<span style='font-size:12px;' class='label label-success'>Atendido</span>";
          }
        },
      },
      { data: "cliente" },
      { data: "title" },
      { data: "start" },
      { data: "descripcion" },
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
    buttons: [
      {
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tbala_reservass.on("draw.dt", function () {
    var pageinfo = $("#tbala_reservass").DataTable().page.info();
    tbala_reservass
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

function listar_vehculos_clientess_usuario() {
  funcion = "listar_vehculos_clientess_usuario";
  tabla_vehi_clie_usu = $("#tabla_vehi_clie_usu").DataTable({
    ordering: true,
    paging: true,
    aProcessing: true,
    aServerSide: true,
    searching: { regex: true },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,

    ajax: {
      url: "../ADMIN/controlador/carrito/carrito.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "-" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el producto'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='editar_img_usu btn btn-warning' title='Editar la imagen del producto'><i class='fa fa-image'></i></button>`;
          } else {
            return `<button style='font-size:10px;' type='button' class='activar btn btn-success' title='Activar el producto'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el producto'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='editar_img_usu btn btn-warning' title='Editar la imagen del producto'><i class='fa fa-image'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span style='font-size: 10px;' class='label label-success'>ACTIVO</span>";
          } else {
            return "<span style='font-size: 10px;' class='label label-danger'>INACTIVO</span>";
          }
        },
      },

      { data: "cliente" },
      { data: "vehiculo" },
      { data: "marca" },
      { data: "fecha" },
      { data: "matrcula" },
      { data: "color" },

      {
        data: "ruta",
        render: function (data, type, row) {
          return (
            '<img loading="lazy" width="53px" height="53px" class="img-circle m-r-10" src="../ADMIN/' +
            data +
            '">'
          );
        },
      },

      { data: "detalle" },
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
    buttons: [
      {
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla_vehi_clie_usu.on("draw.dt", function () {
    var pageinfo = $("#tabla_vehi_clie_usu").DataTable().page.info();
    tabla_vehi_clie_usu
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_vehi_clie_usu").on("click", ".editar_img_usu", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehi_clie_usu.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehi_clie_usu.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehi_clie_usu.row(this).data();
  }
  var fot0 = data.ruta;
  $("#id_prod_foto").val(data.id_clie_vehi);
  document.getElementById("foto_prodt").src = "../ADMIN/" + fot0;
  document.getElementById("foto_ruta").value = data.ruta;

  $("#modal_editar_foto_carro").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_foto_carro").modal("show");
});

$("#tabla_vehi_clie_usu").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehi_clie_usu.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehi_clie_usu.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehi_clie_usu.row(this).data();
  }

  $("#id_vehoculo_cliente").val(data.id_clie_vehi);
  $("#cliente").val(data.id_cliente).trigger("change");

  $("#fecha").val(data.fecha);
  $("#tipo_vehoculo").val(data.tipo_vehoculo).trigger("change");
  $("#tipo_marca").val(data.tipo_marca).trigger("change");
  $("#matrcula").val(data.matrcula);
  $("#color").val(data.color);
  $("#detalle").val(data.detalle);

  $("#modal_editr_vehicuo_cliente").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editr_vehicuo_cliente").modal("show");
});

function cambiar_foto_vehiculo_usu() {
  var id = document.getElementById("id_prod_foto").value;
  var foto = document.getElementById("foto_prod_edit").value;
  var ruta_actual = document.getElementById("foto_ruta").value;

  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  if (foto == "" || ruta_actual.length == 0 || ruta_actual == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para actualizar",
      "warning"
    );
  }

  var formdata = new FormData();
  var foto = $("#foto_prod_edit")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "cambiar_foto_vehoculo";
  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editandi la imagen del vehiculo, por favor espere....",
    ".:Editando imagen vehiculo:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 10) {
          alerta = [
            "error",
            "error",
            "No se puedo mover la foto del producto :)",
          ];
          cerrar_loader_datos(alerta);
          document.getElementById("foto_prod_edit").value = "";
        }
      } else if (resp == 0) {
        alerta = [
          "error",
          "error",
          "No se pudo editar la foto - FALLO EN LA MATRIX:(",
        ];
        cerrar_loader_datos(alerta);
        document.getElementById("foto_prod_edit").value = "";
      } else {
        alerta = [
          "exito",
          "success",
          "La foto del vehiculo se edito con exito :)",
        ];
        cerrar_loader_datos(alerta);
        $("#modal_editar_foto_carro").modal("hide");
        tabla_vehi_clie_usu.ajax.reload();
      }
    },
  });
  return false;
}

function editar_vehiculo_cliente_usu() {
  var id = $("#id_vehoculo_cliente").val();
  var fecha = $("#fecha").val();
  var tipo_vehoculo = $("#tipo_vehoculo").val();
  var tipo_marca = $("#tipo_marca").val();
  var matrcula = $("#matrcula").val();
  var color = $("#color").val();
  var detalle = $("#detalle").val();

  if (
    fecha.length == 0 ||
    tipo_vehoculo.length == 0 ||
    tipo_marca.length == 0 ||
    matrcula.length == 0 ||
    color.length == 0 ||
    detalle.length == 0
  ) {
    validar_registro_vehoculo_cliente_edit_usu(
      fecha,
      tipo_vehoculo,
      tipo_marca,
      matrcula,
      color,
      detalle
    );
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#fecha_obliga").html("");
    $("#tipo_vehoculo_obligg").html("");
    $("#tipo_marca_obligg").html("");
    $("#matricula_obliga").html("");
    $("#color_obliga").html("");
    $("#detalle_obliga").html("");
  }

  funcion = "editar_vehiculo_cliente_usu";
  alerta = [
    "cambio_datos",
    "Se esta editando el vehiculo, por favor espere....",
    ".:Editando vehiculo:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion,
      id,
      fecha,
      tipo_vehoculo,
      tipo_marca,
      matrcula,
      color,
      detalle,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El vehiculo se edito con exito"];
        cerrar_loader_datos(alerta);
        tabla_vehi_clie_usu.ajax.reload();
        $("#modal_editr_vehicuo_cliente").modal("hide");
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el vehiculo del cliente - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

/// validacion
function validar_registro_vehoculo_cliente_edit_usu(
  fecha,
  tipo_vehoculo,
  tipo_marca,
  matrcula,
  color,
  detalle
) {
  if (fecha.length == 0) {
    $("#fecha_obliga").html("Ingrese apellidos");
  } else {
    $("#fecha_obliga").html("");
  }

  if (tipo_vehoculo.length == 0) {
    $("#tipo_vehoculo_obligg").html("No hay vehiculos");
  } else {
    $("#tipo_vehoculo_obligg").html("");
  }

  if (tipo_marca.length == 0) {
    $("#tipo_marca_obligg").html("No hay marca");
  } else {
    $("#tipo_marca_obligg").html("");
  }

  if (matrcula.length == 0) {
    $("#matricula_obliga").html("Ingrese matricula");
  } else {
    $("#matricula_obliga").html("");
  }

  if (color.length == 0) {
    $("#color_obliga").html("Ingrese color");
  } else {
    $("#color_obliga").html("");
  }

  if (detalle.length == 0) {
    $("#detalle_obliga").html("Ingrese detalle del vehiculo");
  } else {
    $("#detalle_obliga").html("");
  }
}

function modal_registro_vehcoo() {

  $("#n_matrcula").val("");
  $("#n_color").val("");
  $("#n_detalle").val("");
  $("#foto").val("");

  $("#n_fecha_obliga").html("");
  $("#n_tipo_vehoculo_obligg").html("");
  $("#n_tipo_marca_obligg").html("");
  $("#n_matricula_obliga").html("");
  $("#n_color_obliga").html("");
  $("#n_detalle_obliga").html("");

  $("#modal_nuevo_registro").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_nuevo_registro").modal("show");
}

////////////////////
function nuevo_registro_vehiculo_usuol() {
  var fecha = $("#fecha_n").val();
  var tipo_vehoculo = $("#n_tipo_vehoculo").val();
  var tipo_marca = $("#n_tipo_marca").val();
  var matrcula = $("#n_matrcula").val();
  var color = $("#n_color").val();
  var detalle = $("#n_detalle").val();
  var foto = $("#foto").val();

  if (
    fecha.length == 0 ||
    tipo_vehoculo.length == 0 ||
    tipo_marca.length == 0 ||
    matrcula.length == 0 ||
    color.length == 0 ||
    detalle.length == 0
  ) {
    validar_registro_vehoculo_cliente_usuu(
      fecha,
      tipo_vehoculo,
      tipo_marca,
      matrcula,
      color,
      detalle
    );
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#n_fecha_obliga").html("");
    $("#n_tipo_vehoculo_obligg").html("");
    $("#n_tipo_marca_obligg").html("");
    $("#n_matricula_obliga").html("");
    $("#n_color_obliga").html("");
    $("#n_detalle_obliga").html("");
  }

  //para scar la fecha para la foto
  var f = new Date();
  //este codigo me captura la extenion del archivo
  var extecion = foto.split(".").pop();
  //renombramoso el archivo con las hora minutos y segundos
  var nombrearchivo =
    "IMG" +
    f.getDate() +
    "" +
    (f.getMonth() + 1) +
    "" +
    f.getFullYear() +
    "" +
    f.getHours() +
    "" +
    f.getMinutes() +
    "" +
    f.getSeconds() +
    "." +
    extecion;

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0];
  //est valores son como los que van en la data del ajax
  funcion = "registra_vehoculo_cliente_usu";
  formdata.append("funcion", funcion);
  formdata.append("fecha", fecha);
  formdata.append("tipo_vehoculo", tipo_vehoculo);
  formdata.append("tipo_marca", tipo_marca);
  formdata.append("matrcula", matrcula);
  formdata.append("color", color);
  formdata.append("detalle", detalle);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta creando el vehiculo, por favor espere....",
    ".:Creando vehiculo:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "El vehiculo se creo con exito :)"];
          cerrar_loader_datos(alerta);
          $("#modal_nuevo_registro").modal("hide");
          tabla_vehi_clie_usu.ajax.reload();
        }
      } else {
        alerta = [
          "error",
          "error",
          "No se pudo crear el registro - FALLO EN LA MATRIX:(",
        ];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

/// validacion
function validar_registro_vehoculo_cliente_usuu(
  fecha,
  tipo_vehoculo,
  tipo_marca,
  matrcula,
  color,
  detalle
) {
  if (fecha.length == 0) {
    $("#n_fecha_obliga").html("Ingrese apellidos");
  } else {
    $("#n_fecha_obliga").html("");
  }

  if (tipo_vehoculo.length == 0) {
    $("#n_tipo_vehoculo_obligg").html("No hay vehiculos");
  } else {
    $("#n_tipo_vehoculo_obligg").html("");
  }

  if (tipo_marca.length == 0) {
    $("#n_tipo_marca_obligg").html("No hay marca");
  } else {
    $("#n_tipo_marca_obligg").html("");
  }

  if (matrcula.length == 0) {
    $("#n_matricula_obliga").html("Ingrese matricula");
  } else {
    $("#n_matricula_obliga").html("");
  }

  if (color.length == 0) {
    $("#n_color_obliga").html("Ingrese color");
  } else {
    $("#n_color_obliga").html("");
  }

  if (detalle.length == 0) {
    $("#n_detalle_obliga").html("Ingrese detalle del vehiculo");
  } else {
    $("#n_detalle_obliga").html("");
  }
}