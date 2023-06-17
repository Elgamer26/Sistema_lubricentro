var tabla_cargo,
  tabla_empleado,
  tabala_asistencias,
  tabla_multas,
  tabla_permisos,
  tabla_beneficios_rol,
  tabla_rol_pagps;
var funcion;

function listar_cargo_() {
  funcion = "listar_cargo_";
  tabla_cargo = $("#tabla_cargo").DataTable({
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
      url: "../ADMIN/controlador/empleado/empleado.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-edit'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar tipo usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-edit'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>ACTIVO</span>";
          } else {
            return "<span class='label label-danger'>INACTIVO</span>";
          }
        },
      },
      { data: "tipo_cargo" },
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
  tabla_cargo.on("draw.dt", function () {
    var pageinfo = $("#tabla_cargo").DataTable().page.info();
    tabla_cargo
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

function nuevo_cargo() {
  $("#cargo").val();
  $("#modal_nuevo_cargo").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_nuevo_cargo").modal("show");
}

$("#tabla_cargo").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cargo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cargo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cargo.row(this).data();
  }
  var dato = 0;
  var id = data.id_cargo;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo de cargo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo(id, dato);
    }
  });
});

$("#tabla_cargo").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cargo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cargo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cargo.row(this).data();
  }
  var dato = 1;
  var id = data.id_cargo;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo de cargo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_tipo(id, dato);
    }
  });
});

$("#tabla_cargo").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cargo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cargo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cargo.row(this).data();
  }

  $("#id_cargo").val(data.id_cargo);
  $("#cargo_edit").val(data.tipo_cargo);

  $("#modal_editar_cargo").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_cargo").modal("show");
});

function cambiar_estado_tipo(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_tipo";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_cargo.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo cambiar el estado - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_carggo() {
  var cargo = document.getElementById("cargo").value;

  if (cargo.length == 0 || cargo == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un tipo de cargo, no debe queda el campo vacio",
      "warning"
    );
  }

  funcion = "registro_cargo";
  alerta = [
    "datos",
    "Se esta guardando el registro, por favor espere....",
    ".:Guardando cargo:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { cargo: cargo, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        tabla_cargo.ajax.reload();

        alerta = ["exito", "success", "El registro se guardo con exito :)"];
        cerrar_loader_datos(alerta);
        $("#modal_nuevo_cargo").modal("hide");
      } else {
        alerta = [
          "existe",
          "warning",
          "El tipo de cargo '" + cargo + "' ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo guardar el registro - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////
function editar_cargo() {
  var id = document.getElementById("id_cargo").value;
  var cargo = document.getElementById("cargo_edit").value;

  if (cargo.length == 0 || cargo == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un tipo de cargo, no debe queda el campo vacio",
      "warning"
    );
  }

  funcion = "editar_cargo";
  alerta = [
    "datos",
    "Se esta editando el registro, por favor espere....",
    ".:Editar cargo:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { id: id, cargo: cargo, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        tabla_cargo.ajax.reload();

        alerta = ["exito", "success", "El cargo se edito con exito :)"];
        cerrar_loader_datos(alerta);
        $("#modal_editar_cargo").modal("hide");
      } else {
        alerta = [
          "existe",
          "warning",
          "El tipo de cargo '" + cargo + "' ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo editar el registro - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////////////
function listar_combo_cargo() {
  funcion = "listar_combo_cargo";
  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#cargo").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#cargo").html(cadena);
    }
  });
}

//////////////
//registrar empleado
function registrar_empleado() {
  var nombres = document.getElementById("nombre_empleado").value;
  var apellidos = document.getElementById("apellido_paterno").value;
  var estado_civil = document.getElementById("estado_civil").value;
  var direccion = document.getElementById("direccion_domicilio").value;
  var telefono = document.getElementById("numero_telefonoo").value;
  var correo = document.getElementById("correo_empleado").value;
  var fecha_n = document.getElementById("fecha_nacimiento").value;
  var sexo = document.getElementById("sexo").value;
  var cedula = document.getElementById("numero_documento").value;
  var nivel_es = document.getElementById("nivel_estudio").value;
  var totulo = document.getElementById("titulo_").value;
  var experiencia = document.getElementById("experi_laboral").value;
  var fech_i = document.getElementById("fecha_ingreso").value;
  var cargo = document.getElementById("cargo").value;
  var valor_hora = document.getElementById("valor_hora").value;

  if (
    nombres.length == 0 ||
    apellidos.length == 0 ||
    estado_civil.length == 0 ||
    direccion.length == 0 ||
    telefono.length == 0 ||
    correo.length == 0 ||
    fecha_n.length == 0 ||
    sexo.length == 0 ||
    cedula.length == 0 ||
    nivel_es.length == 0 ||
    totulo.length == 0 ||
    experiencia.length == 0 ||
    fech_i.length == 0 ||
    cargo.length == 0 ||
    valor_hora.length == 0
  ) {
    validar_registro(
      nombres,
      apellidos,
      estado_civil,
      direccion,
      telefono,
      correo,
      fecha_n,
      sexo,
      cedula,
      nivel_es,
      totulo,
      experiencia,
      fech_i,
      cargo,
      valor_hora
    );

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#nombre_obliga").html("");
    $("#app_pat_obliga").html("");
    $("#app_pat_obliga").html("");
    $("#civil_obligg").html("");
    $("#direccion_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");
    $("#fecha_obliga").html("");
    $("#sexo_olbig").html("");
    $("#numero_doc_obliga").html("");
    $("#nival_obliggg").html("");
    $("#totulo_obligg").html("");
    $("#expero_obligg").html("");
    $("#fecha_ingreso_obligg").html("");
    $("#cargo_olbiggg").html("");
    $("#valor_obligg").html("");
  }

  funcion = "registrar_empleado";
  alerta = [
    "cambio_datos",
    "Se creando el empleado, por favor espere....",
    ".:Creando empleado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion,
      nombres,
      apellidos,
      estado_civil,
      direccion,
      telefono,
      correo,
      fecha_n,
      sexo,
      cedula,
      nivel_es,
      totulo,
      experiencia,
      fech_i,
      cargo,
      valor_hora,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El empleado se creo correctamente :)"];
        cerrar_loader_datos(alerta);
        cargar_contenido(
          "contenido_principal",
          "vista/empleado/nuevo_empleado.php"
        );
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El numero de documento '" +
            cedula +
            "' ya esta registrado en el sistema :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 3) {
        alerta = [
          "existe",
          "warning",
          "El correo '" + correo + "' ya esta registrado en el sistema :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el empleado - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro(
  nombres,
  apellidos,
  estado_civil,
  direccion,
  telefono,
  correo,
  fecha_n,
  sexo,
  cedula,
  nivel_es,
  totulo,
  experiencia,
  fech_i,
  cargo,
  valor_hora
) {
  if (nombres.length == 0) {
    $("#nombre_obliga").html("Ingrese nombres");
  } else {
    $("#nombre_obliga").html("");
  }

  if (apellidos.length == 0) {
    $("#app_pat_obliga").html("Ingrese apellido paterno");
  } else {
    $("#app_pat_obliga").html("");
  }

  if (estado_civil.length == 0) {
    $("#civil_obligg").html("Ingrese estado civil");
  } else {
    $("#civil_obligg").html("");
  }

  if (direccion.length == 0) {
    $("#direccion_obliga").html("Ingrese direccion");
  } else {
    $("#direccion_obliga").html("");
  }

  if (telefono.length == 0) {
    $("#telefono_obliga").html("Ingrese telefono");
  } else {
    $("#telefono_obliga").html("");
  }

  if (correo.length == 0) {
    $("#correo_obliga").html("Ingrese correo");
  } else {
    $("#correo_obliga").html("");
  }

  if (fecha_n.length == 0) {
    $("#fecha_obliga").html("Ingrese fecha nac.");
  } else {
    $("#fecha_obliga").html("");
  }

  if (sexo.length == 0) {
    $("#sexo_olbig").html("Ingrese sexo");
  } else {
    $("#sexo_olbig").html("");
  }

  if (cedula.length == 0) {
    $("#numero_doc_obliga").html("Ingrese cedula");
  } else {
    $("#numero_doc_obliga").html("");
  }

  if (nivel_es.length == 0) {
    $("#nival_obliggg").html("Ingrese nivel estudio");
  } else {
    $("#nival_obliggg").html("");
  }

  if (totulo.length == 0) {
    $("#totulo_obligg").html("Ingrese titulo");
  } else {
    $("#totulo_obligg").html("");
  }

  if (experiencia.length == 0) {
    $("#expero_obligg").html("Ingrese experiencia");
  } else {
    $("#expero_obligg").html("");
  }

  if (fech_i.length == 0) {
    $("#fecha_ingreso_obligg").html("Ingrese fecha ingreso");
  } else {
    $("#fecha_ingreso_obligg").html("");
  }

  if (cargo.length == 0) {
    $("#cargo_olbiggg").html("Ingrese cargo empleado");
  } else {
    $("#cargo_olbiggg").html("");
  }

  if (valor_hora.length == 0) {
    $("#valor_obligg").html("Ingrese valor por hora");
  } else {
    $("#valor_obligg").html("");
  }
}

function listado_empleados() {
  funcion = "listado_empleados";
  tabla_empleado = $("#tabla_empleado").DataTable({
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
      url: "../ADMIN/controlador/empleado/empleado.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-edit'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar tipo usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-edit'></i></button>`;
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>ACTIVO</span>";
          } else {
            return "<span class='label label-danger'>INACTIVO</span>";
          }
        },
      },
      { data: "tipo_cargo" },
      { data: "empleado" },
      { data: "estado_civil" },
      { data: "direccion" },
      { data: "telefono" },
      { data: "fecha_n" },
      { data: "sexo" },
      { data: "cedula" },
      { data: "nivel_es" },
      { data: "totulo" },
      { data: "experiencia" },
      { data: "fech_i" },
      { data: "valor_hora" },
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
  tabla_empleado.on("draw.dt", function () {
    var pageinfo = $("#tabla_empleado").DataTable().page.info();
    tabla_empleado
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_empleado").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_empleado.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_empleado.row(this).data();
  }
  var dato = 0;
  var id = data.id_empleado;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del empleado se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_empleados(id, dato);
    }
  });
});

$("#tabla_empleado").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_empleado.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_empleado.row(this).data();
  }
  var dato = 1;
  var id = data.id_empleado;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del empleado se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_empleados(id, dato);
    }
  });
});

$("#tabla_empleado").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_empleado.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_empleado.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_empleado.row(this).data();
  }

  document.getElementById("id_empleado").value = data.id_empleado;

  document.getElementById("nombre_empleado").value = data.nombres;
  document.getElementById("apellido_paterno").value = data.apellidos;
  document.getElementById("estado_civil").value = data.estado_civil;
  document.getElementById("direccion_domicilio").value = data.direccion;
  document.getElementById("numero_telefonoo").value = data.telefono;
  document.getElementById("correo_empleado").value = data.correo;
  document.getElementById("fecha_nacimiento").value = data.fecha_n;
  document.getElementById("sexo").value = data.sexo;
  document.getElementById("numero_documento").value = data.cedula;
  document.getElementById("nivel_estudio").value = data.nivel_es;
  document.getElementById("titulo_").value = data.totulo;
  document.getElementById("experi_laboral").value = data.experiencia;
  document.getElementById("fecha_ingreso").value = data.fech_i;
  $("#cargo").val(data.id_cargo).trigger("change");
  document.getElementById("valor_hora").value = data.valor_hora;

  $("#numero_documento").css("border", "1px solid green");
  $("#cedula_empleado").html("");

  $("#correo_empleado").css("border", "1px solid green");
  $("#email_correcto").html("");

  $("#modal_editar_emleado").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_emleado").modal("show");
});

function cambiar_estado_empleados(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_tipo_empleado";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_empleado.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo cambiar el estado - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

/////////////////
function editar_empleado() {
  var id = document.getElementById("id_empleado").value;
  var nombres = document.getElementById("nombre_empleado").value;
  var apellidos = document.getElementById("apellido_paterno").value;
  var estado_civil = document.getElementById("estado_civil").value;
  var direccion = document.getElementById("direccion_domicilio").value;
  var telefono = document.getElementById("numero_telefonoo").value;
  var correo = document.getElementById("correo_empleado").value;
  var fecha_n = document.getElementById("fecha_nacimiento").value;
  var sexo = document.getElementById("sexo").value;
  var cedula = document.getElementById("numero_documento").value;
  var nivel_es = document.getElementById("nivel_estudio").value;
  var totulo = document.getElementById("titulo_").value;
  var experiencia = document.getElementById("experi_laboral").value;
  var fech_i = document.getElementById("fecha_ingreso").value;
  var cargo = document.getElementById("cargo").value;
  var valor_hora = document.getElementById("valor_hora").value;

  if (
    nombres.length == 0 ||
    apellidos.length == 0 ||
    estado_civil.length == 0 ||
    direccion.length == 0 ||
    telefono.length == 0 ||
    correo.length == 0 ||
    fecha_n.length == 0 ||
    sexo.length == 0 ||
    cedula.length == 0 ||
    nivel_es.length == 0 ||
    totulo.length == 0 ||
    experiencia.length == 0 ||
    fech_i.length == 0 ||
    cargo.length == 0 ||
    valor_hora.length == 0
  ) {
    validar_registro_edit(
      nombres,
      apellidos,
      estado_civil,
      direccion,
      telefono,
      correo,
      fecha_n,
      sexo,
      cedula,
      nivel_es,
      totulo,
      experiencia,
      fech_i,
      cargo,
      valor_hora
    );

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#nombre_obliga").html("");
    $("#app_pat_obliga").html("");
    $("#app_pat_obliga").html("");
    $("#civil_obligg").html("");
    $("#direccion_obliga").html("");
    $("#telefono_obliga").html("");
    $("#correo_obliga").html("");
    $("#fecha_obliga").html("");
    $("#sexo_olbig").html("");
    $("#numero_doc_obliga").html("");
    $("#nival_obliggg").html("");
    $("#totulo_obligg").html("");
    $("#expero_obligg").html("");
    $("#fecha_ingreso_obligg").html("");
    $("#cargo_olbiggg").html("");
    $("#valor_obligg").html("");
  }

  funcion = "editar_empleadod";
  alerta = [
    "cambio_datos",
    "Se editando el empleado, por favor espere....",
    ".:Editando empleado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion,
      id,
      nombres,
      apellidos,
      estado_civil,
      direccion,
      telefono,
      correo,
      fecha_n,
      sexo,
      cedula,
      nivel_es,
      totulo,
      experiencia,
      fech_i,
      cargo,
      valor_hora,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El empleado se edito correctamente :)"];
        cerrar_loader_datos(alerta);
        tabla_empleado.ajax.reload();
        $("#modal_editar_emleado").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El numero de documento '" +
            cedula +
            "' ya esta registrado en el sistema :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 3) {
        alerta = [
          "existe",
          "warning",
          "El correo '" + correo + "' ya esta registrado en el sistema :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al ediar el empleado - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_edit(
  nombres,
  apellidos,
  estado_civil,
  direccion,
  telefono,
  correo,
  fecha_n,
  sexo,
  cedula,
  nivel_es,
  totulo,
  experiencia,
  fech_i,
  cargo,
  valor_hora
) {
  if (nombres.length == 0) {
    $("#nombre_obliga").html("Ingrese nombres");
  } else {
    $("#nombre_obliga").html("");
  }

  if (apellidos.length == 0) {
    $("#app_pat_obliga").html("Ingrese apellido paterno");
  } else {
    $("#app_pat_obliga").html("");
  }

  if (estado_civil.length == 0) {
    $("#civil_obligg").html("Ingrese estado civil");
  } else {
    $("#civil_obligg").html("");
  }

  if (direccion.length == 0) {
    $("#direccion_obliga").html("Ingrese direccion");
  } else {
    $("#direccion_obliga").html("");
  }

  if (telefono.length == 0) {
    $("#telefono_obliga").html("Ingrese telefono");
  } else {
    $("#telefono_obliga").html("");
  }

  if (correo.length == 0) {
    $("#correo_obliga").html("Ingrese correo");
  } else {
    $("#correo_obliga").html("");
  }

  if (fecha_n.length == 0) {
    $("#fecha_obliga").html("Ingrese fecha nac.");
  } else {
    $("#fecha_obliga").html("");
  }

  if (sexo.length == 0) {
    $("#sexo_olbig").html("Ingrese sexo");
  } else {
    $("#sexo_olbig").html("");
  }

  if (cedula.length == 0) {
    $("#numero_doc_obliga").html("Ingrese cedula");
  } else {
    $("#numero_doc_obliga").html("");
  }

  if (nivel_es.length == 0) {
    $("#nival_obliggg").html("Ingrese nivel estudio");
  } else {
    $("#nival_obliggg").html("");
  }

  if (totulo.length == 0) {
    $("#totulo_obligg").html("Ingrese titulo");
  } else {
    $("#totulo_obligg").html("");
  }

  if (experiencia.length == 0) {
    $("#expero_obligg").html("Ingrese experiencia");
  } else {
    $("#expero_obligg").html("");
  }

  if (fech_i.length == 0) {
    $("#fecha_ingreso_obligg").html("Ingrese fecha ingreso");
  } else {
    $("#fecha_ingreso_obligg").html("");
  }

  if (cargo.length == 0) {
    $("#cargo_olbiggg").html("Ingrese cargo empleado");
  } else {
    $("#cargo_olbiggg").html("");
  }

  if (valor_hora.length == 0) {
    $("#valor_obligg").html("Ingrese valor por hora");
  } else {
    $("#valor_obligg").html("");
  }
}

////////////////////////
function listar_comob_empplado() {
  funcion = "listar_comob_empplado";
  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#empleado_id").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#empleado_id").html(cadena);
    }
  });
}

///
function listar_asistencias() {
  funcion = "listar_asistencias";
  tabala_asistencias = $("#tabla_asistecnia").DataTable({
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
      url: "../ADMIN/controlador/empleado/empleado.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-info' title='Editar asistncia'><i class='fa fa-edit'></i></button>`;
        },
      },
      {
        data: "asistencia",
        render: function (data, type, row) {
          if (data == "Asistio") {
            return (
              "<span class='label label-success' style='font-size: 14px;'>" +
              data +
              "</span>"
            );
          } else {
            return (
              "<span class='label label-danger' style='font-size: 14px;'>" +
              data +
              "</span>"
            );
          }
        },
      },
      { data: "tipo_cargo" },
      { data: "nombres" },
      { data: "fecha" },
      { data: "hora_ingreso" },
      { data: "hora_salida" },
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
  tabala_asistencias.on("draw.dt", function () {
    var pageinfo = $("#tabla_asistecnia").DataTable().page.info();
    tabala_asistencias
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

function regitrar_asistencia() {
  var id = document.getElementById("empleado_id").value;
  var fecha = document.getElementById("fecha_ingreso").value;
  var hotra_ingreso = document.getElementById("hotra_ingreso").value;
  var hotra_salida = document.getElementById("hotra_salida").value;
  var estado = document.getElementById("estado").value;

  if (
    id.length == 0 ||
    fecha.length == 0 ||
    hotra_ingreso.length == 0 ||
    hotra_salida.length == 0 ||
    estado.length == 0
  ) {
    validar_registro_asistencia(id, fecha, hotra_ingreso, hotra_salida, estado);

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#empleado_obligg").html("");
    $("#fecha_oblig").html("");
    $("#hora_ingreso_obligg").html("");
    $("#hora_salida_obligg").html("");
    $("#ESTADO_OLBGG").html("");
  }

  funcion = "registrar_asistencia";
  alerta = [
    "cambio_datos",
    "Se esta creando la asistencia, por favor espere....",
    ".:Creando asistencia:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion,
      id,
      fecha,
      hotra_ingreso,
      hotra_salida,
      estado,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La asistencia se creo correctamente :)"];
        cerrar_loader_datos(alerta);
        tabala_asistencias.ajax.reload();
        $("#modal_marcar_asistenia").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El empleado ya tiene una asistencia registrada en la fecha '" +
            fecha +
            "'",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar la asistencia - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_asistencia(
  id,
  fecha,
  hotra_ingreso,
  hotra_salida,
  estado
) {
  if (id.length == 0) {
    $("#empleado_obligg").html("Ingrese empleado");
  } else {
    $("#empleado_obligg").html("");
  }

  if (fecha.length == 0) {
    $("#fecha_oblig").html("Ingrese fecha");
  } else {
    $("#fecha_oblig").html("");
  }

  if (hotra_ingreso.length == 0) {
    $("#hora_ingreso_obligg").html("XXX");
  } else {
    $("#hora_ingreso_obligg").html("");
  }

  if (hotra_salida.length == 0) {
    $("#hora_salida_obligg").html("XXX");
  } else {
    $("#hora_salida_obligg").html("");
  }

  if (estado.length == 0) {
    $("#ESTADO_OLBGG").html("Ingrese estado");
  } else {
    $("#ESTADO_OLBGG").html("");
  }
}

$("#tabla_asistecnia").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabala_asistencias.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabala_asistencias.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabala_asistencias.row(this).data();
  }

  document.getElementById("id_asistencia").value = data.id_asistencia;
  document.getElementById("edit_fecha_ingreso").value = data.fecha;
  document.getElementById("edit_hotra_ingreso").value = data.hora_ingreso;
  document.getElementById("edit_hotra_salida").value = data.hora_salida;
  document.getElementById("edit_estado").value = data.asistencia;

  $("#modal_editar_asistenia").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_asistenia").modal("show");
});

function editar_asistencia() {
  var id = document.getElementById("id_asistencia").value;
  var fechaingreso = document.getElementById("edit_fecha_ingreso").value;
  var hora_ingreso = document.getElementById("edit_hotra_ingreso").value;
  var hora_saida = document.getElementById("edit_hotra_salida").value;
  var estado = document.getElementById("edit_estado").value;

  if (
    id.length == 0 ||
    fechaingreso.length == 0 ||
    hora_ingreso.length == 0 ||
    hora_saida.length == 0 ||
    estado.length == 0
  ) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  }

  funcion = "editar_asistencia";
  alerta = [
    "cambio_datos",
    "Se esta editando la asistencia, por favor espere....",
    ".:Editando asistencia:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion,
      id: id,
      fechaingreso: fechaingreso,
      hora_ingreso: hora_ingreso,
      hora_saida: hora_saida,
      estado: estado,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La asistencia se edito correctamente :)"];
        cerrar_loader_datos(alerta);
        tabala_asistencias.ajax.reload();
        $("#modal_editar_asistenia").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El empleado ya tiene una asistencia registrada en la fecha '" +
            fecha +
            "'",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar la asistencia - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

//////////
$("#tabla_asistecnia").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabala_asistencias.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabala_asistencias.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabala_asistencias.row(this).data();
  }

  var id = data.id_asistencia;

  Swal.fire({
    title: "Eliminar asistencia?",
    text: "La asistencia se eliminara del registro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_asistencia(id);
    }
  });
});

function eliminar_asistencia(id) {
  funcion = "eliminar_asistencia";
  alerta = [
    "datos",
    "Se esta eliminando la asistencia",
    "por favor espere....",
    ".:Eliminado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { id: id, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La asistencia se elimino con extio :)"];
        cerrar_loader_datos(alerta);
        tabala_asistencias.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo eliminar la asistencia - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

/////////////////////////
function listar_multas() {
  funcion = "listar_multas";
  tabla_multas = $("#tabla_multas").DataTable({
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
      url: "../ADMIN/controlador/empleado/empleado.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button>`;
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span style='font-size: 15px;' class='label label-danger'>DEUDA</span>";
          } else {
            return "<span style='font-size: 15px;' class='label label-success'>PAGADO</span>";
          }
        },
      },
      { data: "tipo_cargo" },
      { data: "nombre" },
      { data: "fecha" },
      { data: "monto" },
      { data: "tipo" },
      { data: "observacion" },
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
  tabla_multas.on("draw.dt", function () {
    var pageinfo = $("#tabla_multas").DataTable().page.info();
    tabla_multas
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

function regitrar_multa() {
  var id = document.getElementById("empleado_id").value;
  var fecha = document.getElementById("fecha_ingreso").value;
  var tipo = document.getElementById("tipo").value;
  var monto = document.getElementById("monto").value;
  var observacion = document.getElementById("observacion").value;

  if (
    id.length == 0 ||
    fecha.length == 0 ||
    tipo.length == 0 ||
    monto.length == 0 ||
    observacion.length == 0
  ) {
    validar_registro_multa(id, fecha, tipo, monto, observacion);

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#empleado_obligg").html("");
    $("#fecha_oblig").html("");
    $("#tipo_obligg").html("");
    $("#monto_obligg").html("");
    $("#observacion_obligg").html("");
  }

  funcion = "registrar_multa";
  alerta = [
    "cambio_datos",
    "Se esta creando la multa, por favor espere....",
    ".:Creando multa:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion,
      id,
      fecha,
      tipo,
      monto,
      observacion,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La multa se creo correctamente :)"];
        cerrar_loader_datos(alerta);

        document.getElementById("monto").value = "";
        document.getElementById("observacion").value = "";

        tabla_multas.ajax.reload();
        $("#modal_multas_empleados").modal("hide");
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar la multa - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_multa(id, fecha, tipo, monto, observacion) {
  if (id.length == 0) {
    $("#empleado_obligg").html("Ingrese empleado");
  } else {
    $("#empleado_obligg").html("");
  }

  if (fecha.length == 0) {
    $("#fecha_oblig").html("Ingrese fecha");
  } else {
    $("#fecha_oblig").html("");
  }

  if (tipo.length == 0) {
    $("#tipo_obligg").html("XXX");
  } else {
    $("#tipo_obligg").html("");
  }

  if (monto.length == 0) {
    $("#monto_obligg").html("Ingrese monto");
  } else {
    $("#monto_obligg").html("");
  }

  if (observacion.length == 0) {
    $("#observacion_obligg").html("Ingrese observacion");
  } else {
    $("#observacion_obligg").html("");
  }
}

$("#tabla_multas").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_multas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_multas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_multas.row(this).data();
  }

  var id = data.id_multa;

  Swal.fire({
    title: "Eliminar multa?",
    text: "La multa se eliminara del registro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_multa(id);
    }
  });
});

function eliminar_multa(id) {
  funcion = "eliminar_multa";
  alerta = [
    "datos",
    "Se esta eliminando la multa",
    "por favor espere....",
    ".:Eliminado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { id: id, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La multa se elimino con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_multas.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo eliminar la multa - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////////////
function listar_permisos() {
  funcion = "listar_permisos";
  tabla_permisos = $("#tabla_permisos").DataTable({
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
      url: "../ADMIN/controlador/empleado/empleado.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button>`;
        },
      },
      { data: "tipo_cargo" },
      { data: "empledao" },
      { data: "fecha" },
      { data: "tipo" },
      { data: "motivo" },
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
  tabla_permisos.on("draw.dt", function () {
    var pageinfo = $("#tabla_permisos").DataTable().page.info();
    tabla_permisos
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

function regitrar_permiso() {
  var id = document.getElementById("empleado_id").value;
  var fecha = document.getElementById("fecha_ingreso").value;
  var tipo = document.getElementById("tipo").value;
  var observacion = document.getElementById("observacion").value;

  if (
    id.length == 0 ||
    fecha.length == 0 ||
    tipo.length == 0 ||
    observacion.length == 0
  ) {
    validar_registro_permiso(id, fecha, tipo, observacion);

    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#empleado_obligg").html("");
    $("#fecha_oblig").html("");
    $("#tipo_obligg").html("");
    $("#observacion_obligg").html("");
  }

  funcion = "registra_permiso";
  alerta = [
    "cambio_datos",
    "Se esta creando el permiso, por favor espere....",
    ".:Creando permiso:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion,
      id,
      fecha,
      tipo,
      observacion,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El permiso se creo correctamente :)"];
        cerrar_loader_datos(alerta);

        document.getElementById("observacion").value = "";

        tabla_permisos.ajax.reload();
        $("#modal_nuevo_permiso").modal("hide");
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el permiso - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_permiso(id, fecha, tipo, observacion) {
  if (id.length == 0) {
    $("#empleado_obligg").html("Ingrese empleado");
  } else {
    $("#empleado_obligg").html("");
  }

  if (fecha.length == 0) {
    $("#fecha_oblig").html("Ingrese fecha");
  } else {
    $("#fecha_oblig").html("");
  }

  if (tipo.length == 0) {
    $("#tipo_obligg").html("XXX");
  } else {
    $("#tipo_obligg").html("");
  }

  if (observacion.length == 0) {
    $("#observacion_obligg").html("Ingrese observacion");
  } else {
    $("#observacion_obligg").html("");
  }
}

$("#tabla_permisos").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_permisos.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_permisos.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_permisos.row(this).data();
  }

  var id = data.id_permiso;

  Swal.fire({
    title: "Eliminar permiso?",
    text: "El permiso se eliminara del registro!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_permiso(id);
    }
  });
});

function eliminar_permiso(id) {
  funcion = "eliminar_permiso";
  alerta = [
    "datos",
    "Se esta eliminando el permiso",
    "por favor espere....",
    ".:Eliminado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: { id: id, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El permiso se elimino con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_permisos.ajax.reload();
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo eliminar el permiso - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////////
///////////////////
function modal_beneficios() {
  $("#modal_benficios_rol_pagoss").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_benficios_rol_pagoss").modal("show");
}

function listar_bebficios_rol() {
  funcion = "listar_bebficios_rol";
  tabla_beneficios_rol = $("#tabla_beneficios_rol").DataTable({
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
      url: "../ADMIN/controlador/empleado/empleado.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      { data: "nombre" },
      { data: "valor" },
      {
        data: "tipo",
        render: function (data, type, row) {
          if (data == "Ingreso") {
            return "<span class='label label-success'>" + data + "</span>";
          } else {
            return "<span class='label label-danger'>" + data + "</span>";
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='enviar btn btn-warning' title='Enviar datos'><i class='fa fa-send-o'></i></button>`;
        },
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
    order: [[0, "desc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla_beneficios_rol.on("draw.dt", function () {
    var pageinfo = $("#tabla_beneficios_rol").DataTable().page.info();
    tabla_beneficios_rol
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_beneficios_rol").on("click", ".enviar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_beneficios_rol.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_beneficios_rol.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_beneficios_rol.row(this).data();
  }

  var id = data.id_beneficio;
  var nombre = data.nombre;
  var cantidad = data.valor;
  var tipo = data.tipo;
  var valor = $("#monto_dra").val();
  var plata = 0;

  if (tipo == "Ingreso") {
    if (verificar_ingreso(id)) {
      return Swal.fire(
        "Mensaje de advertencia",
        "El ingreso '" +
          nombre +
          "' , ya fue agregado al detalle de 'INGRESOS'",
        "warning"
      );
    }

    plata = parseFloat((valor * cantidad) / 100).toFixed(2);

    var datos_agg_ingreso = "<tr>";
    datos_agg_ingreso += "<td for='id'>" + id + "</td>";
    datos_agg_ingreso += "<td>" + nombre + "</td>";
    datos_agg_ingreso += "<td>" + plata + "</td>";
    datos_agg_ingreso +=
      "<td><button onclick='remove_ingreso(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
    datos_agg_ingreso += "</tr>";

    //esto me ayuda a enviar los datos a la tabla
    $("#tbody_detalle_ingreso").append(datos_agg_ingreso);
  } else {
    if (verificar_egreso(id)) {
      return Swal.fire(
        "Mensaje de advertencia",
        "El egreso '" + nombre + "' , ya fue agregado al detalle 'EGRESOS'",
        "warning"
      );
    }

    plata = parseFloat((valor * cantidad) / 100).toFixed(2);

    var datos_agg_egreso = "<tr>";
    datos_agg_egreso += "<td for='id'>" + id + "</td>";
    datos_agg_egreso += "<td>" + nombre + "</td>";
    datos_agg_egreso += "<td>" + plata + "</td>";
    datos_agg_egreso +=
      "<td><button onclick='remove_egreso(this)' class='btn btn-danger'><i class='fa fa-trash'></i></button></td>";
    datos_agg_egreso += "</tr>";

    //esto me ayuda a enviar los datos a la tabla
    $("#tbody_detalle_egreso").append(datos_agg_egreso);
  }
  $("#modal_benficios_rol_pagoss").modal("hide");

  //////////////////////
  calculat_ingreso();
  calcular_egreso();
});

function remove_egreso(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
  /////////////////////
  calcular_egreso();
}

function remove_ingreso(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);
  ////////////
  calculat_ingreso();
}

function verificar_egreso(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalle_egreso td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

function verificar_ingreso(id) {
  let idverificar = document.querySelectorAll(
    "#tbody_detalle_ingreso td[for='id']"
  );
  return [].filter.call(idverificar, (td) => td.textContent == id).length == 1;
}

////////////////
function calculat_ingreso() {
  let arreglo_ingreso = new Array();
  let sub_ingreso = 0;
  var count_ingreso = 0;
  let total_ingreso = 0;

  $("#detalle_tabla_ingreso tbody#tbody_detalle_ingreso tr").each(function () {
    arreglo_ingreso.push($(this).find("td").eq(2).text());
    count_ingreso++;
  });

  for (var i = 0; i < count_ingreso; i++) {
    var suma = arreglo_ingreso[i];
    sub_ingreso = (parseFloat(sub_ingreso) + parseFloat(suma)).toFixed(2);
  }
  total_ingreso = sub_ingreso;

  $("#lbl_total_ingreso").html(
    "<b>Total ingreso: $ " + parseFloat(total_ingreso).toFixed(2) + "</b"
  );
  $("#txt_total_ingreso").val(parseFloat(total_ingreso).toFixed(2));

  ///////////////
  calcular_neto();
}

function calcular_egreso() {
  let arreglo_egreso = new Array();
  let sub_egreso = 0;
  var count_egreso = 0;
  let total_egreso = 0;

  $("#detalle_tabla_egreso tbody#tbody_detalle_egreso tr").each(function () {
    arreglo_egreso.push($(this).find("td").eq(2).text());
    count_egreso++;
  });

  for (var i = 0; i < count_egreso; i++) {
    var suma = arreglo_egreso[i];
    sub_egreso = (parseFloat(sub_egreso) + parseFloat(suma)).toFixed(2);
  }
  total_egreso = sub_egreso;
  $("#lbl_total_egreso").html(
    "Total egreso: $/. " + parseFloat(total_egreso).toFixed(2)
  );
  $("#txt_total_egreso").val(parseFloat(total_egreso).toFixed(2));

  ///////////////////
  calcular_neto();
}

function calcular_neto() {
  var bandera1 = $("#txt_total_egreso").val();
  var bandera2 = $("#txt_total_ingreso").val();
  var neto = 0;
  neto = bandera2 - bandera1;
  $("#lbl_neto_pagar").html("$ " + parseFloat(neto).toFixed(2));
  $("#txtneto_pagar").val(parseFloat(neto).toFixed(2));
}

///////////////
function Crear_rol_pagos() {
  Swal.fire({
    title: "Se creará un rol de pago de empleado",
    text: "Desea crear un rol de pago del empleado?",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, si crear!!",
  }).then((result) => {
    if (result.value) {
      var id_empleado = $("#id_empleado").val();
      var fecha_pago = $("#fecha_pago").val() + " " + $("#hora").val();
      var valor_hora = $("#valor_hora").val();
      var monto_dra = $("#monto_dra").val();
      var total_ingreso = $("#txt_total_ingreso").val();
      var total_egreso = $("#txt_total_egreso").val();
      var txtneto_pagar = $("#txtneto_pagar").val();
      var count_ingreso = 0;
      var count_egreso = 0;
      var count_asiste = 0;

      if (id_empleado.length == 0) {
        $("#id_empleado_obliga").html("No hay datos del empleado");
        return swal.fire(
          "Campo vacios",
          "Debe haber un empleado para realizar el rol de pagos",
          "warning"
        );
      } else {
        $("#id_empleado_obliga").html("");
      }

      $("#detalle_tabla_ingreso tbody#tbody_detalle_ingreso tr").each(
        function () {
          count_ingreso++;
        }
      );

      $("#detalle_tabla_egreso tbody#tbody_detalle_egreso tr").each(
        function () {
          count_egreso++;
        }
      );

      $(
        "#detalle_tabla_asistencia tbody#tbody_detalle_tabla_asistencia tr"
      ).each(function () {
        count_asiste++;
      });

      if (count_ingreso == 0) {
        $("#detalle_ingreso_obligg").html(
          "No hay datos de ingreso en la tabla"
        );
        return Swal.fire(
          "Mensaje de advertencia",
          "No hay datos en la tabla ingreso,(TABLA INGRESO)",
          "warning"
        );
      } else {
        $("#detalle_ingreso_obligg").html("");
      }

      if (count_egreso == 0) {

        var n_n = "No tiene egresos";
        var v_v = "0.00";
        var c_c = 0;

        var datos_agg_multas = "<tr>";
        datos_agg_multas += "<td for='id'>" + c_c + "</td>";
        datos_agg_multas += "<td>" + n_n + "</td>";
        datos_agg_multas += "<td>" + v_v + "</td>";
        datos_agg_multas += "<td style='color:red;'>No egresos</td>";
        datos_agg_multas += "</tr>";

        $("#tbody_detalle_egreso").append(datos_agg_multas);

      } else {
        $("#detalle_eggreso_obligg").html("");
      }

      if (count_asiste == 0) {
        $("#detalle_asistencia_obligg").html(
          "No hay datos de asistencia en la tabla"
        );
        return Swal.fire(
          "Mensaje de advertencia",
          "No hay datos en la tabla asistencias,(TABLA ASISTENCIAS)",
          "warning"
        );
      } else {
        $("#detalle_asistencia_obligg").html("");
      }

      funcion = "registrar_rol_de_pagos";
      alerta = [
        "datos",
        "Se esta creando el rol pagos del empleado",
        "Creando rol de pagos",
      ];
      mostar_loader_datos(alerta);

      $.ajax({
        url: "../ADMIN/controlador/empleado/empleado.php",
        type: "POST",
        data: {
          funcion: funcion,
          id_empleado: id_empleado,
          fecha_pago: fecha_pago,
          valor_hora: valor_hora,
          monto_dra: monto_dra,
          total_ingreso: total_ingreso,
          total_egreso: total_egreso,
          txtneto_pagar: txtneto_pagar,
          count_ingreso: count_ingreso,
          count_egreso: count_egreso,
        },
      }).done(function (resp) {
        if (resp > 0) {
          rgistrar_detalle_ingreso(parseInt(resp));
          pagar_multas_empleado(parseInt(id_empleado));
          sacar_asistencias(parseInt(id_empleado));
        } else {
          alerta = [
            "error",
            "error",
            "No se pudo crear el rol de pagos del empleado",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
}

function rgistrar_detalle_ingreso(id) {
  var count = 0;
  var arrego_nombre = new Array();
  var arreglo_cantidad = new Array();

  $("#detalle_tabla_ingreso tbody#tbody_detalle_ingreso tr").each(function () {
    arrego_nombre.push($(this).find("td").eq(1).text());
    arreglo_cantidad.push($(this).find("td").eq(2).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var nombre = arrego_nombre.toString();
  var cantidad = arreglo_cantidad.toString();

  if (count == 0) {
    return false;
  }

  funcion = "registrar_detalle_ingreso";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    if (resp > 0) {
      rgistrar_detalle_egreso(id);
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo regitrar el detalle deel ingreso",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function rgistrar_detalle_egreso(id) {
  var count = 0;
  var arrego_nombre = new Array();
  var arreglo_cantidad = new Array();

  $("#detalle_tabla_egreso tbody#tbody_detalle_egreso tr").each(function () {
    arrego_nombre.push($(this).find("td").eq(1).text());
    arreglo_cantidad.push($(this).find("td").eq(2).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var nombre = arrego_nombre.toString();
  var cantidad = arreglo_cantidad.toString();

  if (count == 0) {
    return false;
  }

  funcion = "registrar_detalle_egreso";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
      cantidad: cantidad,
    },
  }).done(function (resp) {
    if (resp > 0) {
      Swal.fire({
        title: "Se impirmira el rol de pagos del empleado",
        text: "Desea imprimir el rol de pagos del empleado??",
        icon: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        allowOutsideClick: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, imprimir!!",
      }).then((result) => {
        window.open(
          "../ADMIN/REPORTES/Pdf/rol_depagos.php?id=" +
            parseInt(id) +
            "#zoom=100%",
          "Rol de pagos",
          "scrollbards=No"
        );
      });

      cargar_contenido("contenido_principal", "vista/empleado/rol_pagos.php");
    } else {
      alerta = ["error", "error", "No se pudo regitrar el detalle deel egreso"];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////
function pagar_multas_empleado(id) {
  var count = 0;
  var arrego_id_multa = new Array();

  $("#tabla_sanciones tbody#tbody_detalle_sanciones tr").each(function () {
    arrego_id_multa.push($(this).find("td").eq(0).text());
    count++;
  });

  if (count == 0) {
    console.log("No multa");
    return false;
  }

  //aqui combierto el arreglo a un string
  var id_multa = arrego_id_multa.toString();

  funcion = "pagar_multa_sancion";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      id_multa: id_multa,
    },
  }).done(function (resp) {
    console.log("Multa:" + resp);
  });
}

function sacar_asistencias(id) {
  var count = 0;
  var arrego_idasistencia = new Array();

  $("#detalle_tabla_asistencia tbody#tbody_detalle_tabla_asistencia tr").each(
    function () {
      arrego_idasistencia.push($(this).find("td").eq(0).text());
      count++;
    }
  );

  if (count == 0) {
    console.log("No asistencia");
    return false;
  }

  //aqui combierto el arreglo a un string
  var idasistencia = arrego_idasistencia.toString();

  funcion = "sacra_asistencias";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/empleado/empleado.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idasistencia: idasistencia,
    },
  }).done(function (resp) {
    console.log("Asistencia:" + resp);
  });
}

//////////////////////////
/////////////////
function listar_rol_pagos() {
  funcion = "listar_rol_pagos";
  tabla_rol_pagps = $("#tabla_rol_pagos").DataTable({
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
      url: "../ADMIN/controlador/empleado/empleado.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='anular btn btn-danger' title=anular rol'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='ver_pdf btn btn-primary' title='imprimir rol'><i class='fa fa-print'></i></button> `;
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>ACTIVO</span>";
          } else {
            return "<span class='label label-danger'>ANULADO</span>";
          }
        },
      },
      { data: "tipo_cargo" },
      { data: "empleado" },
      { data: "fecha_pago" },
      { data: "valor_hora" },
      { data: "monto" },
      { data: "total_ingreso" },
      { data: "total_egreso" },
      { data: "txtneto_pagar" },
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
  tabla_rol_pagps.on("draw.dt", function () {
    var pageinfo = $("#tabla_rol_pagos").DataTable().page.info();
    tabla_rol_pagps
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_rol_pagos").on("click", ".ver_pdf", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_rol_pagps.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_rol_pagps.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_rol_pagps.row(this).data();
  }

  var id = data.id_rol_pagos;

  Swal.fire({
    title: "Se impirmira el rol de pagos del empleado",
    text: "Desea imprimir el rol de pagos del empleado??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, imprimir!!",
  }).then((result) => {
    window.open(
      "../ADMIN/REPORTES/Pdf/rol_depagos.php?id=" + parseInt(id) + "#zoom=100%",
      "Rol de pagos",
      "scrollbards=No"
    );
  });
});
