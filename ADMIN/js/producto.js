var funcion,
  tabla_tipo,
  tabla_marcas,
  tabla,
  tabla_proveedor,
  tabla_proveedor_agg,
  tabla_producto_agg,
  tabla_ingreo,
  tabla_ingreso_detalle;

function registrar_tipo() {
  var tipo_producto = document.getElementById("tipo_producto").value;

  if (tipo_producto.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar el tipo de producto",
      "warning"
    );
  }

  funcion = "registrar_tipo";
  alerta = [
    "cambio_datos",
    "Se esta creando el tipo de producto, por favor espere....",
    ".:Creando tipo de producto:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion,
      tipo_producto,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = [
          "exito",
          "success",
          "El tipo de producto se creo correctamente :)",
        ];
        cerrar_loader_datos(alerta);
        tabla_tipo.ajax.reload();
        $("#modal_tipo_").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El tipo de producto " + tipo_producto + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el tipo de producto - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_tipo_() {
  funcion = "listar_tipo_";
  tabla_tipo = $("#tabla_tipo").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
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
      { data: "tipo_producto" },
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
  tabla_tipo.on("draw.dt", function () {
    var pageinfo = $("#tabla_tipo").DataTable().page.info();
    tabla_tipo
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_tipo").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo.row(this).data();
  }
  var dato = 0;
  var id = data.id_tipo_producto;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo de producto se cambiara!",
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

$("#tabla_tipo").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo.row(this).data();
  }
  var dato = 1;
  var id = data.id_tipo_producto;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo de producto se cambiara!",
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

$("#tabla_tipo").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo.row(this).data();
  }

  $("#id_tipo_pro").val(data.id_tipo_producto);
  $("#tipo_producto_edit").val(data.tipo_producto);

  $("#modal_editar_").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_").modal("show");
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
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_tipo.ajax.reload();
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

function editar_tio__() {
  var id = document.getElementById("id_tipo_pro").value;
  var tipo_producto = document.getElementById("tipo_producto_edit").value;

  if (tipo_producto.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar el tipo de producto",
      "warning"
    );
  }

  funcion = "editar_tipo__";
  alerta = [
    "cambio_datos",
    "Se esta editando el tipo de producto, por favor espere....",
    ".:Editando tipo de producto:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion,
      id,
      tipo_producto,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = [
          "exito",
          "success",
          "El tipo de producto se edito correctamente :)",
        ];
        cerrar_loader_datos(alerta);
        tabla_tipo.ajax.reload();
        $("#modal_editar_").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El tipo de producto " + tipo_producto + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el tipo de producto - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////////////////
function registrar_marca() {
  var marca_pro = document.getElementById("marca_pro").value;

  if (marca_pro.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar la marca de producto",
      "warning"
    );
  }

  funcion = "registrar_marca";
  alerta = [
    "cambio_datos",
    "Se esta creando la marca de producto, por favor espere....",
    ".:Creando marca de producto:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion,
      marca_pro,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = [
          "exito",
          "success",
          "La marca de producto se creo correctamente :)",
        ];
        cerrar_loader_datos(alerta);
        tabla_marcas.ajax.reload();
        $("#modal_marcas").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "La marca de producto " + marca_pro + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar la marca de producto - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_marcas() {
  funcion = "listar_marcas";
  tabla_marcas = $("#tabla_marcas").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
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
      { data: "marca" },
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
  tabla_marcas.on("draw.dt", function () {
    var pageinfo = $("#tabla_marcas").DataTable().page.info();
    tabla_marcas
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_marcas").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_marcas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_marcas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_marcas.row(this).data();
  }
  var dato = 0;
  var id = data.id_marca;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la marca se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_marca_estado(id, dato);
    }
  });
});

$("#tabla_marcas").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_marcas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_marcas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_marcas.row(this).data();
  }
  var dato = 1;
  var id = data.id_marca;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado de la marca se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_marca_estado(id, dato);
    }
  });
});

$("#tabla_marcas").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_marcas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_marcas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_marcas.row(this).data();
  }

  $("#id_marca_pro").val(data.id_marca);
  $("#marca_producto_edit").val(data.marca);

  $("#modal_editar_marca").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_marca").modal("show");
});

function cambiar_marca_estado(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_marca";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_marcas.ajax.reload();
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

function editar_marca() {
  var id = document.getElementById("id_marca_pro").value;
  var marca_edit = document.getElementById("marca_producto_edit").value;

  if (marca_edit.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar la marca de producto",
      "warning"
    );
  }

  funcion = "editar__marca";
  alerta = [
    "cambio_datos",
    "Se esta editando la marca de producto, por favor espere....",
    ".:Editando marca de producto:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion,
      id,
      marca_edit,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = [
          "exito",
          "success",
          "La marca de producto se edito correctamente :)",
        ];
        cerrar_loader_datos(alerta);
        tabla_marcas.ajax.reload();
        $("#modal_editar_marca").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "La marca de producto " + marca_edit + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar la marca de producto - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////////
function listar_tipo_producto() {
  funcion = "listar_tipo_producto";
  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
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
      $("#tipo_producto").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#tipo_producto").html(cadena);
    }
  });
}

function listar_marca_producto() {
  funcion = "listar_marca_producto";
  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
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
      $("#marca_pro").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#marca_pro").html(cadena);
    }
  });
}

function registrar_producto_producto() {
  var codigo = document.getElementById("codigo_prod").value;
  var nombre = document.getElementById("nombre_producto").value;
  var tipo = document.getElementById("tipo_producto").value;
  var marca = document.getElementById("marca_pro").value;
  var detalle = document.getElementById("detalle_pro").value;
  var precio = document.getElementById("preio_pro").value;

  var especifi = document.getElementById("especifi_prod").value;
  var equiva = document.getElementById("equiva_prod").value;

  var tipo_m = $("#tipo_producto option:selected").text();
  var marca_m = $("#marca_pro option:selected").text();

  var foto = document.getElementById("foto").value;

  if (
    codigo.length == 0 ||
    nombre.length == 0 ||
    tipo.length == 0 ||
    marca.length == 0 ||
    detalle.length == 0 ||
    precio.length == 0 ||
    equiva.length == 0 ||
    especifi.length == 0
  ) {
    validar_registro_pro(
      codigo,
      nombre,
      tipo,
      marca,
      detalle,
      precio,
      equiva,
      especifi
    );
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#codigo_obligg").html("");
    $("#nombre_obligg").html("");
    $("#tipo_pro_obligg").html("");
    $("#marca_pro_obligg").html("");
    $("#detalle_obligg").html("");
    $("#precio_obligg").html("");
    $("#equivalente_obligg").html("");
    $("#especifi_obligg").html("");
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
  funcion = "registra_producto";
  formdata.append("funcion", funcion);
  formdata.append("codigo", codigo);
  formdata.append("nombre", nombre);
  formdata.append("tipo", tipo);
  formdata.append("marca", marca);
  formdata.append("detalle", detalle);
  formdata.append("precio", precio);

  formdata.append("equiva", equiva);
  formdata.append("especifi", especifi);

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta creando el producto, por favor espere....",
    ".:Creando producto:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          alerta = ["exito", "success", "El producto se creo con exito :)"];
          cerrar_loader_datos(alerta);
          cargar_contenido(
            "contenido_principal",
            "vista/productos/nuevo_producto.php"
          );
        } else if (resp == 2) {
          alerta = [
            "existe",
            "warning",
            "El codigo '" +
              codigo +
              "' del producto, ya se encuentra registrado :(",
          ];
          cerrar_loader_datos(alerta);
        } else if (resp == 4) {
          alerta = [
            "existe",
            "warning",
            "El nombre '" +
              nombre +
              "' del producto, ya se encuentra registrado :(",
          ];
          cerrar_loader_datos(alerta);
        } else {
          alerta = [
            "existe",
            "warning",
            "El producto '" +
              nombre +
              "' con el tipo '" +
              tipo_m +
              "' y la marca '" +
              marca_m +
              "', ya se encuentra registrado :(",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = [
          "error",
          "error",
          "No se pudo crear el producto - FALLO EN LA MATRIX:(",
        ];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

/// validacion
function validar_registro_pro(
  codigo,
  nombre,
  tipo,
  marca,
  detalle,
  precio,
  equiva,
  especifi
) {
  if (codigo.length == 0) {
    $("#codigo_obligg").html("Ingrese codigo");
  } else {
    $("#codigo_obligg").html("");
  }

  if (nombre.length == 0) {
    $("#nombre_obligg").html("Ingrese nombre");
  } else {
    $("#nombre_obligg").html("");
  }

  if (tipo.length == 0) {
    $("#tipo_pro_obligg").html("Ingrese tipo");
  } else {
    $("#tipo_pro_obligg").html("");
  }

  if (marca.length == 0) {
    $("#marca_pro_obligg").html("Ingrese marca");
  } else {
    $("#marca_pro_obligg").html("");
  }

  if (detalle.length == 0) {
    $("#detalle_obligg").html("Ingrese detalle del producto");
  } else {
    $("#detalle_obligg").html("");
  }

  if (precio.length == 0) {
    $("#precio_obligg").html("Ingrese precio venta");
  } else {
    $("#precio_obligg").html("");
  }

  ///
  if (equiva.length == 0) {
    $("#equivalente_obligg").html("Ingrese equivalente");
  } else {
    $("#equivalente_obligg").html("");
  }

  if (especifi.length == 0) {
    $("#especifi_obligg").html("Ingrese especificación");
  } else {
    $("#especifi_obligg").html("");
  }
}

//////////////
function listar_producto() {
  funcion = "listar_producto";
  tabla = $("#tabla_producto").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "-" },
      {
        data: "_eliminado",
        render: function (data, type, row) {
          if (data == 1) {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el producto'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el producto'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='editar_img btn btn-warning' title='Editar la imagen del producto'><i class='fa fa-image'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el producto'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el producto'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='editar_img btn btn-warning' title='Editar la imagen del producto'><i class='fa fa-image'></i></button>`;
          }
        },
      },
      {
        data: "_eliminado",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span style='font-size: 13px;' class='label label-success'>Si</span>";
          } else {
            return "<span style='font-size: 13px;' class='label label-danger'>No</span>";
          }
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "activo") {
            return "<span class='label label-success'>" + data + "</span>";
          } else {
            return "<span class='label label-danger'>" + data + "</span>";
          }
        },
      },
      {
        data: "producto_foto",
        render: function (data, type, row) {
          return (
            '<img loading="lazy" width="53px" height="53px" class="img-circle m-r-10" src="../ADMIN/' +
            data +
            '">'
          );
        },
      },
      {
        data: "stock",
        render: function (data, type, row) {
          if (data == null) {
            return "<span style='font-size: 11px;' class='label label-danger'>No hay stock</span>";
          } else {
            return data;
          }
        },
      },
      { data: "poducto_codigo" },
      { data: "especificacion" },
      { data: "equivalente" },
      { data: "producto_nombre" },
      { data: "tipo_producto" },
      { data: "marca" },
      { data: "producto_detalle" },
      { data: "producto_precio_venta" },
      {
        data: "producto_destacar",
        render: function (data, type, row) {
          if (data == 0) {
            return "<span style='font-size: 12px;' class='label label-primary'>No tiene promocion</span>";
          } else {
            return "<span style='font-size: 12px;' class='label label-success'>Si tiene promocion</span>";
          }
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
  tabla.on("draw.dt", function () {
    var pageinfo = $("#tabla_producto").DataTable().page.info();
    tabla
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_producto").on("click", ".editar_img", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }
  var fot0 = data.producto_foto;
  $("#id_prod_foto").val(data.id_producto);
  document.getElementById("foto_prodt").src = fot0;
  document.getElementById("foto_ruta").value = data.producto_foto;

  $("#modal_editar_foto").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_foto").modal("show");
});

function cambiar_foto_prducto() {
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
  funcion = "cambiar_foto_producto";
  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editandi la imagen del producto, por favor espere....",
    ".:Editando imagen producto:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
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
          "La foto del producto se edito con exito :)",
        ];
        cerrar_loader_datos(alerta);
        document.getElementById("foto_prod_edit").value = "";
        document.getElementById("foto_prodt").src = "img/producto/" + resp;
        document.getElementById("foto_ruta").value = "img/producto/" + resp;
        tabla.ajax.reload();
      }
    },
  });
  return false;
}

$("#tabla_producto").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }
  var dato = "inactivo";
  var id = data.id_producto;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del producto se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado(id, dato);
    }
  });
});

$("#tabla_producto").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }
  var dato = "activo";
  var id = data.id_producto;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del producto se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado(id, dato);
    }
  });
});

function cambiar_estado(id, dato) {
  var res;

  if (dato == "inactivo") {
    res = 0;
  } else {
    res = 1;
  }

  funcion = "estado_producto";
  alerta = [
    "datos",
    "Se esta cambiando el estado a '" + dato + "', por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: { id: id, res: res, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = [
          "exito",
          "success",
          "EL producto se '" + dato + "' con extio :)",
        ];
        cerrar_loader_datos(alerta);
        tabla.ajax.reload();
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

$("#tabla_producto").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }

  document.getElementById("id_producto_edit").value = data.id_producto;
  document.getElementById("codigo_prod").value = data.poducto_codigo;
  document.getElementById("nombre_producto").value = data.producto_nombre;

  $("#tipo_producto").val(data.tipo_producto_id).trigger("change");
  $("#marca_pro").val(data.marca_producto_id).trigger("change");

  document.getElementById("detalle_pro").value = data.producto_detalle;
  document.getElementById("preio_pro").value = data.producto_precio_venta;

  document.getElementById("especifi_prod").value = data.especificacion;
  document.getElementById("equiva_prod").value = data.equivalente;

  $("#codigo_obligg").html("");
  $("#nombre_obligg").html("");
  $("#tipo_pro_obligg").html("");
  $("#marca_pro_obligg").html("");
  $("#detalle_obligg").html("");
  $("#precio_obligg").html("");

  $("#especifi_obligg").html("");
  $("#equivalente_obligg").html("");

  $("#modal_editar_producto").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_producto").modal("show");
});

function editar_producto() {
  var id = document.getElementById("id_producto_edit").value;
  var codigo = document.getElementById("codigo_prod").value;
  var nombre = document.getElementById("nombre_producto").value;
  var tipo = document.getElementById("tipo_producto").value;
  var marca = document.getElementById("marca_pro").value;
  var detalle = document.getElementById("detalle_pro").value;
  var precio = document.getElementById("preio_pro").value;

  var especifi = document.getElementById("especifi_prod").value;
  var equiva = document.getElementById("equiva_prod").value;

  var tipo_m = $("#tipo_producto option:selected").text();
  var marca_m = $("#marca_pro option:selected").text();

  if (
    codigo.length == 0 ||
    nombre.length == 0 ||
    tipo.length == 0 ||
    marca.length == 0 ||
    detalle.length == 0 ||
    precio.length == 0 ||
    especifi.length == 0 ||
    equiva.length == 0 ||
    id.length == 0
  ) {
    validar_registro_edit_prod(
      codigo,
      nombre,
      tipo,
      marca,
      detalle,
      precio,
      especifi,
      equiva
    );
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#codigo_obligg").html("");
    $("#nombre_obligg").html("");
    $("#tipo_pro_obligg").html("");
    $("#marca_pro_obligg").html("");
    $("#detalle_obligg").html("");
    $("#precio_obligg").html("");
    $("#especifi_obligg").html("");
    $("#equivalente_obligg").html("");
  }

  funcion = "editar_producto";
  alerta = [
    "datos",
    "Se esta cambiando los datos del producto, por favor espere....",
    ".:Cambiando datos:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      codigo: codigo,
      nombre: nombre,
      tipo: tipo,
      marca: marca,
      detalle: detalle,
      precio: precio,
      especifi: especifi,
      equiva: equiva,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = [
          "exito",
          "success",
          "Los datos del producto se cambio con extio :)",
        ];
        cerrar_loader_datos(alerta);
        tabla.ajax.reload();
        $("#modal_editar_producto").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El codigo '" +
            codigo +
            "' del producto, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 4) {
        alerta = [
          "existe",
          "warning",
          "El nombre '" +
            nombre +
            "' del producto, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else {
        alerta = [
          "existe",
          "warning",
          "El producto '" +
            nombre +
            "' con el tipo '" +
            tipo_m +
            "' y la marca '" +
            marca_m +
            "', ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo cambiar los datos del producto - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

/// validacion
function validar_registro_edit_prod(
  codigo,
  nombre,
  tipo,
  marca,
  detalle,
  precio,
  especifi,
  equiva
) {
  if (codigo.length == 0) {
    $("#codigo_obligg").html("Ingrese codigo");
  } else {
    $("#codigo_obligg").html("");
  }

  if (nombre.length == 0) {
    $("#nombre_obligg").html("Ingrese nombre");
  } else {
    $("#nombre_obligg").html("");
  }

  if (tipo.length == 0) {
    $("#tipo_pro_obligg").html("Ingrese tipo");
  } else {
    $("#tipo_pro_obligg").html("");
  }

  if (marca.length == 0) {
    $("#marca_pro_obligg").html("Ingrese marca");
  } else {
    $("#marca_pro_obligg").html("");
  }

  if (detalle.length == 0) {
    $("#detalle_obligg").html("Ingrese detalle del producto");
  } else {
    $("#detalle_obligg").html("");
  }

  if (precio.length == 0) {
    $("#precio_obligg").html("Ingrese precio venta");
  } else {
    $("#precio_obligg").html("");
  }

  ///
  if (equiva.length == 0) {
    $("#equivalente_obligg").html("Ingrese equivalente");
  } else {
    $("#equivalente_obligg").html("");
  }

  if (especifi.length == 0) {
    $("#especifi_obligg").html("Ingrese especificación");
  } else {
    $("#especifi_obligg").html("");
  }
}

///////////////// proveedor
function registrar_proveedor() {
  var razon = document.getElementById("razon_spcial").value;
  var numero = document.getElementById("numero_doc").value;
  var direccion = document.getElementById("direccion_p").value;
  var provincia = document.getElementById("provincia").value;
  var ciudad = document.getElementById("ciudad").value;
  var numero_telefono = document.getElementById("numero_telefono_p").value;
  var correo = document.getElementById("correo_prov").value;
  var actividad = document.getElementById("actividad_pro").value;
  var nombre_enca = document.getElementById("nombre_enca").value;
  var sexo = document.getElementById("sexo_enc").value;
  var telefono_encargado = document.getElementById("telefono_encargado").value;

  if (
    razon.length == 0 ||
    numero.length == 0 ||
    direccion.length == 0 ||
    provincia.length == 0 ||
    ciudad.length == 0 ||
    numero_telefono.length == 0 ||
    actividad.length == 0 ||
    nombre_enca.length == 0 ||
    telefono_encargado.length == 0 ||
    correo.length == 0
  ) {
    validar_registro(
      razon,
      numero,
      direccion,
      provincia,
      ciudad,
      numero_telefono,
      actividad,
      nombre_enca,
      telefono_encargado,
      correo
    );
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#razon_spcial_obliga").html("");
    $("#numero_doc_obliga").html("");
    $("#direccion_p_obliga").html("");
    $("#provincia_obliga").html("");
    $("#ciudad_obliga").html("");
    $("#numero_telefono_p_obliga").html("");
    $("#actividad_pro_obliga").html("");
    $("#nombre_enca").html("");
    $("#telefono_encargado_obliga").html("");
    $("#correo_p_obliga").html("");
  }

  funcion = "registrar_proveedor";
  alerta = [
    "datos",
    "Se esta creando el proveedor, por favor espere....",
    ".:Creando proveedor:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      razon: razon,
      numero: numero,
      direccion: direccion,
      provincia: provincia,
      ciudad: ciudad,
      numero_telefono: numero_telefono,
      correo: correo,
      actividad: actividad,
      nombre_enca: nombre_enca,
      sexo: sexo,
      telefono_encargado: telefono_encargado,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El proveedor se creo con exito :)"];
        cerrar_loader_datos(alerta);
        cargar_contenido(
          "contenido_principal",
          "vista/productos/proveedore.php"
        );
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El numero de documento '" +
            numero +
            "' del proveedor, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 3) {
        alerta = [
          "existe",
          "warning",
          "EL correo '" +
            correo +
            "' del proveedor, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 4) {
        alerta = [
          "existe",
          "warning",
          "La razon social '" +
            razon +
            "' del proveedor, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else {
        alerta = [
          "existe",
          "warning",
          "El correo '" + correo + "' ingresado, es invalido :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo crear el proveedor - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

/// validacion
function validar_registro(
  razon,
  numero,
  direccion,
  provincia,
  ciudad,
  numero_telefono,
  actividad,
  nombre_enca,
  telefono_encargado,
  correo
) {
  if (razon.length == 0) {
    $("#razon_spcial_obliga").html("Ingrese razon social");
  } else {
    $("#razon_spcial_obliga").html("");
  }

  if (numero.length == 0) {
    $("#numero_doc_obliga").html("Ingrese ruc");
  } else {
    $("#numero_doc_obliga").html("");
  }

  if (direccion.length == 0) {
    $("#direccion_p_obliga").html("Ingrese direccion");
  } else {
    $("#direccion_p_obliga").html("");
  }

  if (provincia.length == 0) {
    $("#provincia_obliga").html("Ingrese provincia");
  } else {
    $("#provincia_obliga").html("");
  }

  if (ciudad.length == 0) {
    $("#ciudad_obliga").html("Ingrese ciudad");
  } else {
    $("#ciudad_obliga").html("");
  }

  if (numero_telefono.length == 0) {
    $("#numero_telefono_p_obliga").html("Ingrese telefono");
  } else {
    $("#numero_telefono_p_obliga").html("");
  }

  if (actividad.length == 0) {
    $("#actividad_pro_obliga").html("Ingrese actividad del proveedor");
  } else {
    $("#actividad_pro_obliga").html("");
  }

  if (nombre_enca.length == 0) {
    $("#nombre_enca_obliga").html("Ingrese encargado");
  } else {
    $("#nombre_enca_obliga").html("");
  }

  if (telefono_encargado.length == 0) {
    $("#telefono_encargado_obliga").html("Ingrese telef. encargado");
  } else {
    $("#telefono_encargado_obliga").html("");
  }

  if (correo.length == 0) {
    $("#correo_p_obliga").html("Ingrese un correo");
  } else {
    $("#correo_p_obliga").html("");
  }
}

function listar_proveedor() {
  funcion = "listar_proveedor";
  tabla_proveedor = $("#tabla_proveedor").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "-" },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "1") {
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el proveedor'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el proveedor'><i class='fa fa-edit'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el proveedor'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el proveedor'><i class='fa fa-edit'></i></button>`;
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
      { data: "razon_social" },
      { data: "ruc" },
      { data: "proveedor_direccion" },
      { data: "provincia_id" },
      { data: "ciudad_id" },
      { data: "proveedor_telefono" },
      { data: "proveedor_correo" },
      { data: "proveedor_actividad" },
      { data: "encargado" },
      { data: "encargado_sexo" },
      { data: "encargado_telefono" },
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
  tabla_proveedor.on("draw.dt", function () {
    var pageinfo = $("#tabla_proveedor").DataTable().page.info();
    tabla_proveedor
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_proveedor").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_proveedor.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_proveedor.row(this).data();
  }
  var dato = 0;
  var id = data.proveedor_id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del proveedor se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_proveedor(id, dato);
    }
  });
});

$("#tabla_proveedor").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_proveedor.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_proveedor.row(this).data();
  }
  var dato = 1;
  var id = data.proveedor_id;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del proveedor se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_proveedor(id, dato);
    }
  });
});

function cambiar_estado_proveedor(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_proveedor";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_proveedor.ajax.reload();
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

$("#tabla_proveedor").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_proveedor.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_proveedor.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_proveedor.row(this).data();
  }
  $("#id_proveedor_edit").val(data.proveedor_id);
  $("#razon_spcial").val(data.razon_social);
  $("#numero_doc").val(data.ruc);
  $("#direccion_p").val(data.proveedor_direccion);
  $("#provincia").val(data.provincia_id);
  $("#ciudad").val(data.ciudad_id);

  $("#numero_telefono_p").val(data.proveedor_telefono);
  $("#correo_prov").val(data.proveedor_correo);

  $("#actividad_pro").val(data.proveedor_actividad);
  $("#nombre_enca").val(data.encargado);
  $("#sexo_enc").val(data.encargado_sexo);
  $("#telefono_encargado").val(data.encargado_telefono);

  $("#razon_spcial_obliga").html("");
  $("#numero_doc_obliga").html("");
  $("#direccion_p_obliga").html("");
  $("#provincia_obliga").html("");
  $("#ciudad_obliga").html("");
  $("#numero_telefono_p_obliga").html("");
  $("#actividad_pro_obliga").html("");
  $("#nombre_enca").html("");
  $("#telefono_encargado_obliga").html("");
  $("#telefono_encargado_obliga").html("");

  $("#correo_prov").css("border", "1px solid green");
  $("#email_correcto_prov").html("");

  $("#modal_editar_proveedor").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_proveedor").modal("show");
});

function ediatr_proveedor() {
  var id = document.getElementById("id_proveedor_edit").value;
  var razon = document.getElementById("razon_spcial").value;
  var numero = document.getElementById("numero_doc").value;
  var direccion = document.getElementById("direccion_p").value;
  var provincia = document.getElementById("provincia").value;
  var ciudad = document.getElementById("ciudad").value;
  var numero_telefono = document.getElementById("numero_telefono_p").value;
  var correo = document.getElementById("correo_prov").value;
  var actividad = document.getElementById("actividad_pro").value;
  var nombre_enca = document.getElementById("nombre_enca").value;
  var sexo = document.getElementById("sexo_enc").value;
  var telefono_encargado = document.getElementById("telefono_encargado").value;

  if (
    razon.length == 0 ||
    numero.length == 0 ||
    direccion.length == 0 ||
    provincia.length == 0 ||
    ciudad.length == 0 ||
    numero_telefono.length == 0 ||
    actividad.length == 0 ||
    nombre_enca.length == 0 ||
    telefono_encargado.length == 0 ||
    correo.length == 0
  ) {
    validar_registro_edit(
      razon,
      numero,
      direccion,
      provincia,
      ciudad,
      numero_telefono,
      actividad,
      nombre_enca,
      telefono_encargado,
      correo
    );
    return swal.fire(
      "Campo vacios",
      "Debe ingresar todos los datos en los campos, no deben quedar campos vacios",
      "warning"
    );
  } else {
    $("#razon_spcial_obliga").html("");
    $("#numero_doc_obliga").html("");
    $("#direccion_p_obliga").html("");
    $("#provincia_obliga").html("");
    $("#ciudad_obliga").html("");
    $("#numero_telefono_p_obliga").html("");
    $("#actividad_pro_obliga").html("");
    $("#nombre_enca").html("");
    $("#telefono_encargado_obliga").html("");
    $("#telefono_encargado_obliga").html("");
  }

  funcion = "editar_datos_proveedor";
  alerta = [
    "datos",
    "Se esta editando el proveedor, por favor espere....",
    ".:Editando proveedor:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      razon: razon,
      numero: numero,
      direccion: direccion,
      provincia: provincia,
      ciudad: ciudad,
      numero_telefono: numero_telefono,
      correo: correo,
      actividad: actividad,
      nombre_enca: nombre_enca,
      sexo: sexo,
      telefono_encargado: telefono_encargado,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El proveedor se edito con exito :)"];
        cerrar_loader_datos(alerta);
        tabla_proveedor.ajax.reload();
        $("#modal_editar_proveedor").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El numero de documento '" +
            numero +
            "' del proveedor, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 3) {
        alerta = [
          "existe",
          "warning",
          "EL correo '" +
            correo +
            "' del proveedor, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 4) {
        alerta = [
          "existe",
          "warning",
          "La razon social '" +
            razon +
            "' del proveedor, ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      } else {
        alerta = [
          "existe",
          "warning",
          "El correo '" + correo + "' ingresado, es invalido :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo editar el proveedor - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_registro_edit(
  razon,
  numero,
  direccion,
  provincia,
  ciudad,
  numero_telefono,
  actividad,
  nombre_enca,
  telefono_encargado,
  correo
) {
  if (razon.length == 0) {
    $("#razon_spcial_obliga").html("Ingrese razon social");
  } else {
    $("#razon_spcial_obliga").html("");
  }

  if (numero.length == 0) {
    $("#numero_doc_obliga").html("Ingrese ruc");
  } else {
    $("#numero_doc_obliga").html("");
  }

  if (direccion.length == 0) {
    $("#direccion_p_obliga").html("Ingrese direccion");
  } else {
    $("#direccion_p_obliga").html("");
  }

  if (provincia.length == 0) {
    $("#provincia_obliga").html("Ingrese provincia");
  } else {
    $("#provincia_obliga").html("");
  }

  if (ciudad.length == 0) {
    $("#ciudad_obliga").html("Ingrese ciudad");
  } else {
    $("#ciudad_obliga").html("");
  }

  if (numero_telefono.length == 0) {
    $("#numero_telefono_p_obliga").html("Ingrese telefono");
  } else {
    $("#numero_telefono_p_obliga").html("");
  }

  if (actividad.length == 0) {
    $("#actividad_pro_obliga").html("Ingrese actividad del proveedor");
  } else {
    $("#actividad_pro_obliga").html("");
  }

  if (nombre_enca.length == 0) {
    $("#nombre_enca_obliga").html("Ingrese encargado");
  } else {
    $("#nombre_enca_obliga").html("");
  }

  if (telefono_encargado.length == 0) {
    $("#telefono_encargado_obliga").html("Ingrese telef. encargado");
  } else {
    $("#telefono_encargado_obliga").html("");
  }

  if (correo.length == 0) {
    $("#correo_p_obligaedit").html("Ingrese correo electronico");
  } else {
    $("#correo_p_obligaedit").html("");
  }
}

///////////////compras
function modal_proveedor() {
  $("#modal__lista_provee").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal__lista_provee").modal("show");
}

function listar_proveedor_compra() {
  funcion = "listar_proveedor_compra";
  tabla_proveedor_agg = $("#tabla_proveedores_agg").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "-" },
      {
        render: function () {
          return `<button style='font-size:13px;' type='button' class='enviar btn btn-warning' title='Enviar datos del cliente'><i class='fa fa-send-o'></i></button>`;
        },
      },
      { data: "razon_social" },
      { data: "ruc" },
      { data: "encargado" },
      { data: "proveedor_direccion" },
      { data: "provincia_id" },
      { data: "ciudad_id" },
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
  tabla_proveedor_agg.on("draw.dt", function () {
    var pageinfo = $("#tabla_proveedores_agg").DataTable().page.info();
    tabla_proveedor_agg
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_proveedores_agg").on("click", ".enviar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_proveedor_agg.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_proveedor_agg.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_proveedor_agg.row(this).data();
  }

  //esto es para pasar los valores de la tabla a los inputs
  $("#id_proveedor").val(data.proveedor_id);
  $("#razon_spcial").val(data.razon_social);
  $("#numero_doc").val(data.ruc);
  $("#encargado_pr").val(data.encargado);
  $("#correo_prov").val(data.proveedor_correo);

  //cierro el modal
  $("#modal__lista_provee").modal("hide");
});

//// tabla productos
function modal_productoss() {
  $("#modal__lista_prroductos").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal__lista_prroductos").modal("show");
}

function listado_productos_agg() {
  funcion = "listado_productos_agg";
  tabla_producto_agg = $("#tabla_productos_agg").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "-" },
      {
        render: function () {
          return `<button style='font-size:13px;' type='button' class='enviar btn btn-success' title='Enviar datos del produto'><i class='fa fa-send-o'></i></button>`;
        },
      },
      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "activo") {
            return "<span class='label label-success'>" + data + "</span>";
          } else {
            return "<span class='label label-danger'>" + data + "</span>";
          }
        },
      },
      { data: "poducto_codigo" },
      {
        data: "stock",
        render: function (data, type, row) {
          if (data == null) {
            return "<span style='font-size: 11px;' class='label label-danger'>No hay stock</span>";
          } else {
            return data;
          }
        },
      },
      {
        data: "producto_foto",
        render: function (data, type, row) {
          return (
            '<img loading="lazy" width="53px" height="53px" class="img-circle m-r-10" src="../ADMIN/' +
            data +
            '">'
          );
        },
      },
      { data: "producto_nombre" },
      { data: "tipo_producto" },
      { data: "marca" },
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
  tabla_producto_agg.on("draw.dt", function () {
    var pageinfo = $("#tabla_productos_agg").DataTable().page.info();
    tabla_producto_agg
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_productos_agg").on("click", ".enviar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_producto_agg.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_producto_agg.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_producto_agg.row(this).data();
  }

  //esto es para pasar los valores de la tabla a los inputs
  $("#id_producto_agg").val(data.id_producto);
  $("#codigo_producto").val(data.poducto_codigo);
  $("#nombre_prodc").val(data.producto_nombre);
  $("#tipo_producto").val(data.tipo_producto);
  $("#marca_product").val(data.marca);
  $("#cantidad").val(1);

  //cierro el modal
  $("#modal__lista_prroductos").modal("hide");
});

//////////////////-----compra de productos
/// registrar el ingreso
function registrar_producto() {
  Swal.fire({
    title: "Guardar compra",
    text: "Desea guardar la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, guardar!!",
  }).then((result) => {
    if (result.value) {
      let count = 0;
      var id_provee = $("#id_proveedor").val();
      var razon = $("#razon_spcial").val();
      var inpuesto = $("#inpuesto").val();
      var tipo_compro = $("#tipo_comprobante").val();
      var serie_compro = $("#serie_comprobante").val();
      var numero_compro = $("#numeroe_comprobante").val();
      var txt_totalneto = $("#txt_totalneto").val();
      var txt_impuesto = $("#txt_impuesto").val();
      var txt_a_pagar = $("#txt_a_pagar").val();

      if (
        id_provee.length == 0 ||
        razon.length == 0 ||
        serie_compro.length == 0 ||
        numero_compro.length == 0
      ) {
        validar_ingreso_(id_provee, razon, serie_compro, numero_compro);
        return Swal.fire(
          "Mensaje de advertencia",
          "No debe dejar campos vacios",
          "warning"
        );
      } else {
        $("#razon_obligg").html("");
        $("#serie_obligg").html("");
        $("#numero_obligg").html("");
      }

      $("#detalle_ingreso tbody#tbody_detalle_prodcuto tr").each(function () {
        count++;
      });

      if (count == 0) {
        return Swal.fire(
          "Mensaje de advertencia",
          "El detalle de ingreso debe tener un producto por lo menos,(TABLA PRODUCTO)",
          "warning"
        );
      }

      funcion = "registrar_ingreso";
      alerta = [
        "datos",
        "Se esta registrando el compra, por favor espere....",
        ".:Registrando la compra:.",
      ];
      mostar_loader_datos(alerta);

      $.ajax({
        url: "../ADMIN/controlador/producto/producto.php",
        type: "POST",
        data: {
          funcion: funcion,
          id_provee: id_provee,
          inpuesto: inpuesto,
          tipo_compro: tipo_compro,
          serie_compro: serie_compro,
          numero_compro: numero_compro,
          txt_totalneto: txt_totalneto,
          txt_impuesto: txt_impuesto,
          txt_a_pagar: txt_a_pagar,
          count: count,
        },
      }).done(function (resp) {
        if (resp > 0) {
          registrar_detalle_ingreso(parseInt(resp));
        } else {
          alerta = [
            "error",
            "error",
            "No se pudo regitrar la compra - FALLO EN LA MATRIX:(",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
}

function validar_ingreso_(id_provee, razon, serie_compro, numero_compro) {
  if (id_provee.length == 0 || razon.length == 0) {
    $("#razon_obligg").html("Ingrese proveedor");
  } else {
    $("#razon_obligg").html("");
  }

  if (serie_compro.length == 0) {
    $("#serie_obligg").html("Ingrese N° compr.");
  } else {
    $("#serie_obligg").html("");
  }

  if (numero_compro.length == 0) {
    $("#numero_obligg").html("Ingrese N° serie");
  } else {
    $("#numero_obligg").html("");
  }
}

function registrar_detalle_ingreso(id) {
  var count = 0;
  var arrego_idproducto = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_unidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento = new Array();
  var arreglo_subtotal = new Array();

  //con esto estoy recorriendo toda la tabla de registros
  $("#detalle_ingreso tbody#tbody_detalle_prodcuto tr").each(function () {
    //qui ago referencia al id de la tabala y en EQ va el id poscion (0)
    arrego_idproducto.push($(this).find("td").eq(0).text());
    arreglo_cantidad.push($(this).find("td").eq(2).text());
    arreglo_unidad.push($(this).find("td").eq(3).text());
    arreglo_precio.push($(this).find("td").eq(4).text());
    arreglo_descuento.push($(this).find("td").eq(5).text());
    arreglo_subtotal.push($(this).find("td").eq(6).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var idproducto = arrego_idproducto.toString();
  var cantidad = arreglo_cantidad.toString();
  var unidad = arreglo_unidad.toString();
  var precio = arreglo_precio.toString();
  var descuento = arreglo_descuento.toString();
  var subtotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }
  funcion = "registrar_detalle_insumo";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idproducto: idproducto,
      cantidad: cantidad,
      unidad: unidad,
      precio: precio,
      descuento: descuento,
      subtotal: subtotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["no", "no", "no"];
        cerrar_loader_datos(alerta);

        Swal.fire({
          title: "Imprimir reporte de compra",
          text: "Desea imprimir el reporte de compra??",
          icon: "success",
          showCancelButton: true,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, Imprimir!!",
        }).then((result) => {
          if (result.value) {
            window.open(
              "../ADMIN/REPORTES/Pdf/factura_compra.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de ingreso",
              "scrollbards=No"
            );
          }
          cargar_contenido(
            "contenido_principal",
            "vista/productos/compra_producto.php"
          );
        });
      } else {
        alerta = [
          "error",
          "error",
          "Error al modificar el stock del producto - FALLO EN LA MATRIX:(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo regitrar el detalle de la compra - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_ingreso() {
  funcion = "listar_ingreso";
  tabla_ingreo = $("#tbla_ingresos").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "-" },
      {
        data: "ingreso_estado",
        render: function (data, type, row) {
          if (data == "INGRESADO") {
            return `<button style='font-size:13px;' type='button' class='factura btn btn-warning' title='factura del ingreso'><i class='fa fa-print'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-primary' title='ver el detalle del ingreso'><i class='fa fa-eye'></i></button> - <button style='font-size:13px;' type='button' class='anular btn btn-danger' title='Anular el ingreso'><i class='fa fa-times'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='factura btn btn-warning' title='factura del ingreso'><i class='fa fa-print'></i></button> - <button disabled style='font-size:13px;' type='button' class='ver btn btn-primary' title='ver el detalle del ingreso'><i class='fa fa-eye'></i></button> - <button disabled style='font-size:13px;' type='button' class='anular btn btn-danger' title='Anular el ingreso'><i class='fa fa-times'></i></button>`;
          }
        },
      },
      {
        data: "ingreso_estado",
        render: function (data, type, row) {
          if (data == "INGRESADO") {
            return "<span class='label label-success'>" + data + "</span>";
          } else {
            return "<span class='label label-danger'>" + data + "</span>";
          }
        },
      },
      { data: "usuario" },
      { data: "razon_social" },
      { data: "ingreso_fecha" },
      { data: "ingreso_ticomprobante" },
      {
        data: "ingreso_porcentaje",
        render: function (data, type, row) {
          return "<span>% " + data + "</span>";
        },
      },
      {
        data: "ingreso_numcomrpobante",
      },
      {
        data: "ingreso_impuestototal",
        render: function (data, type, row) {
          return "<span>$ " + data + "</span>";
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
  tabla_ingreo.on("draw.dt", function () {
    var pageinfo = $("#tbla_ingresos").DataTable().page.info();
    tabla_ingreo
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tbla_ingresos").on("click", ".factura", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_ingreo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_ingreo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_ingreo.row(this).data();
  }
  Swal.fire({
    title: "Imprimir reporte de ingreso",
    text: "Desea imprimir el reporte de ingreso??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        "../ADMIN/REPORTES/Pdf/factura_compra.php?id=" +
          parseInt(data.ingreso_id) +
          "#zoom=100%",
        "Reporte de ingreso",
        "scrollbards=No"
      );
    }
  });
});

$("#tbla_ingresos").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_ingreo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_ingreo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_ingreo.row(this).data();
  }
  $("#modal__lista_prroductos_detalle").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal__lista_prroductos_detalle").modal("show");

  listar_detalle_ingreso(parseInt(data.ingreso_id));
});

function listar_detalle_ingreso(id) {
  funcion = "listar_detalle_ingreso";
  tabla_ingreso_detalle = $("#tabla_productos_agg_ingrso").DataTable({
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
      url: "../ADMIN/controlador/producto/producto.php",
      type: "POST",
      data: { id: id, funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { data: "producto_nombre" },
      { data: "tipo_producto" },
      { data: "marca" },
      { data: "cantidad" },
      { data: "unidad" },
      { data: "precio" },
      { data: "descuento" },
      { data: "subtotal" },
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
}

$("#tbla_ingresos").on("click", ".anular", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_ingreo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_ingreo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_ingreo.row(this).data();
  }

  Swal.fire({
    title: "Anular la compra",
    text: "Desea anular la compra??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, Anular!!",
  }).then((result) => {
    if (result.value) {
      anular_ingreso(data.ingreso_id);
    }
  });
});

function anular_ingreso(id) {
  funcion = "anular_ingreso";
  alerta = [
    "datos",
    "Se esta anulando la compra, por favor espere....",
    ".:Anulando el ingreso:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp > 0) {
      alerta = ["exito", "success", "La compra se anulo con exito :)"];
      cerrar_loader_datos(alerta);
      tabla_ingreo.ajax.reload();
    } else {
      alerta = [
        "error",
        "error",
        "NO se pudo anular la compra - ERROR EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////ofertas
///////////////////////
function listar_productos_ofertas() {
  funcion = "listar_productos_ofertas";
  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" +
          data[i][0] +
          "'> Codigo: " +
          data[i][1] +
          " - Nombre: " +
          data[i][2] +
          " - Marca: " +
          data[i][3] +
          " - Tipo: " +
          data[i][4] +
          " </option>";
      }
      //aqui concadenamos al id del select
      $("#producto_id").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#producto_id").html(cadena);
    }
  });
}

function registra_oferta() {
  var producto_id = $("#producto_id").val();
  var fecha_inic = $("#fecha_inic").val();
  var fecha_fin = $("#fecha_fin").val();
  var nombre_oferta = $("#nombre_oferta").val();
  var procentaje = $("#procentaje").val();
  var tipo_descue = $("#tipo_descue").val();

  if (
    producto_id.length == 0 ||
    fecha_inic.length == 0 ||
    fecha_fin.length == 0 ||
    nombre_oferta.length == 0 ||
    procentaje.length == 0
  ) {
    validar_ingreso_oferta(
      producto_id,
      fecha_inic,
      fecha_fin,
      nombre_oferta,
      procentaje
    );
    return Swal.fire(
      "Mensaje de advertencia",
      "No debe dejar campos vacios",
      "warning"
    );
  } else {
    $("#producto_obligg").html("");
    $("#fecha_i").html("");
    $("#fecha_f").html("");
    $("#nombre_olbigg").html("");
    $("#porcent_obligg").html("");
  }

  if (fecha_inic > fecha_fin) {
    $("#fecha_i").html("XXX");
    $("#fecha_f").html("XXX");
    return swal.fire(
      "Mensaje de advertencia",
      "La fecha inicio " +
        fecha_inic +
        ", no debe sobrepasar a la fecha fin " +
        fecha_fin +
        "",
      "warning"
    );
  } else {
    $("#fecha_i").html("");
    $("#fecha_f").html("");
  }

  funcion = "registrar_ofertass";
  alerta = [
    "datos",
    "Se esta registrando la oferta, por favor espere....",
    ".:Registrando la oferta:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      producto_id,
      fecha_inic,
      fecha_fin,
      nombre_oferta,
      procentaje,
      tipo_descue,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp != 0) {
        enviar_oferta_id(resp);
        pagination(1);
        listar_productos_ofertas();
        $("#modal_ofertas_new").modal("hide");
        alerta = ["exito", "success", "La oferta se creo con exito"];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo regitrar la oferta - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_ingreso_oferta(
  producto_id,
  fecha_inic,
  fecha_fin,
  nombre_oferta,
  procentaje
) {
  if (producto_id.length == 0) {
    $("#producto_obligg").html("No hay producto");
  } else {
    $("#producto_obligg").html("");
  }

  if (fecha_inic.length == 0) {
    $("#fecha_i").html("Ingrese fecha inicio");
  } else {
    $("#fecha_i").html("");
  }

  if (fecha_fin.length == 0) {
    $("#fecha_f").html("Ingrese fecha fin");
  } else {
    $("#fecha_f").html("");
  }

  if (nombre_oferta.length == 0) {
    $("#nombre_olbigg").html("Ingrese nombre");
  } else {
    $("#nombre_olbigg").html("");
  }

  if (procentaje.length == 0) {
    $("#porcent_obligg").html("Ingrese descuento");
  } else {
    $("#porcent_obligg").html("");
  }
}

/////////////////
$(document).on("keyup", "#buscar_prod", function () {
  let valor = $(this).val();
  if (valor != "" || valor != null || valor.length > 0) {
    pagination(1, valor);
  } else {
    pagination(1);
  }
});

function pagination(partida, valor) {
  funcion = "paguinar";
  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      partida: partida,
      funcion: funcion,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_inve").html(array[0]);
      $("#paguination").html(array[1]);
    } else {
      $("#unir_inve").html(
        "<div class='col-lg-12' style='text-align: center; justify-content: center; align-items: center'><br>" +
          "<label style='font-size: 20px;'></i>.:No se encontro producto '" +
          valor +
          "':.<label>" +
          "</div>"
      );
      $("#paguination").html("");
    }
  });
}

function elimnar(id) {
  Swal.fire({
    title: "Eliminar oferta",
    text: "Desea eliminar la oferta?",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.value) {
      funcion = "eliminar_ofertas";
      alerta = [
        "datos",
        "Se esta eliminado la oferta, por favor espere....",
        ".:Eliminando la oferta:.",
      ];
      mostar_loader_datos(alerta);

      $.ajax({
        url: "../ADMIN/controlador/producto/producto.php",
        type: "POST",
        data: {
          funcion: funcion,
          id,
        },
      }).done(function (resp) {
        if (resp > 0) {
          if (resp == 1) {
            pagination(1);
            listar_productos_ofertas();
            alerta = ["exito", "success", "La oferta se eliminon con exito"];
            cerrar_loader_datos(alerta);
          }
        } else {
          alerta = [
            "error",
            "error",
            "No se pudo eliminar la oferta - FALLO EN LA MATRIX:(",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
}

function editar_oferta(id) {
  funcion = "traer_datos_editar";
  alerta = [
    "datos",
    "Mostrando datos, por favor espere....",
    ".:Mostrando datos:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      id,
    },
  }).done(function (resp) {
    var data = JSON.parse(resp);

    $("#oferta_id").val(data[0][0]);
    $("#fecha_inic_edit").val(data[0][2]);
    $("#fecha_fin_edit").val(data[0][3]);
    $("#nombre_oferta_edit").val(data[0][4]);
    $("#procentaje_edit").val(data[0][5]);

    $("#producto_obligg_edit").html("");
    $("#fecha_i_edit").html("");
    $("#fecha_f_edit").html("");
    $("#nombre_olbigg_edit").html("");
    $("#porcent_obligg_edit").html("");

    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    $("#modl_editar_oferta").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modl_editar_oferta").modal("show");
  });
}

function editar_oferta_save() {
  var id = $("#oferta_id").val();
  var fecha_inic = $("#fecha_inic_edit").val();
  var fecha_fin = $("#fecha_fin_edit").val();
  var nombre_oferta = $("#nombre_oferta_edit").val();
  var procentaje = $("#procentaje_edit").val();
  var tipo_descue = $("#tipo_descue_edit").val();

  if (
    fecha_inic.length == 0 ||
    fecha_fin.length == 0 ||
    nombre_oferta.length == 0 ||
    procentaje.length == 0
  ) {
    validar_editar_oferta(fecha_inic, fecha_fin, nombre_oferta, procentaje);
    return Swal.fire(
      "Mensaje de advertencia",
      "No debe dejar campos vacios",
      "warning"
    );
  } else {
    $("#producto_obligg_edit").html("");
    $("#fecha_i_edit").html("");
    $("#fecha_f_edit").html("");
    $("#nombre_olbigg_edit").html("");
    $("#porcent_obligg_edit").html("");
  }

  if (fecha_inic > fecha_fin) {
    $("#fecha_i_edit").html("XXX");
    $("#fecha_f_edit").html("XXX");
    return swal.fire(
      "Mensaje de advertencia",
      "La fecha inicio " +
        fecha_inic +
        ", no debe sobrepasar a la fecha fin " +
        fecha_fin +
        "",
      "warning"
    );
  } else {
    $("#fecha_i_edit").html("");
    $("#fecha_f_edit").html("");
  }

  funcion = "editar_ofertas";
  alerta = [
    "datos",
    "Se esta editando la oferta, por favor espere....",
    ".:Editando la oferta:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/producto/producto.php",
    type: "POST",
    data: {
      funcion: funcion,
      id,
      fecha_inic,
      fecha_fin,
      nombre_oferta,
      procentaje,
      tipo_descue,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        pagination(1);
        $("#modl_editar_oferta").modal("hide");
        alerta = ["exito", "success", "La oferta se edito con exito"];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo editar la oferta - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function validar_editar_oferta(
  fecha_inic,
  fecha_fin,
  nombre_oferta,
  procentaje
) {
  if (fecha_inic.length == 0) {
    $("#fecha_i_edit").html("Ingrese fecha inicio");
  } else {
    $("#fecha_i_edit").html("");
  }

  if (fecha_fin.length == 0) {
    $("#fecha_f_edit").html("Ingrese fecha fin");
  } else {
    $("#fecha_f_edit").html("");
  }

  if (nombre_oferta.length == 0) {
    $("#nombre_olbigg_edit").html("Ingrese nombre");
  } else {
    $("#nombre_olbigg_edit").html("");
  }

  if (procentaje.length == 0) {
    $("#porcent_obligg_edit").html("Ingrese descuento");
  } else {
    $("#porcent_obligg_edit").html("");
  }
}

function enviar_correo(id) {
  Swal.fire({
    title: "Envío de oferta",
    text: "Desea enviar la oferta?",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, enviar!",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "../ADMIN/modelo/envio_correo/envio_oferta.php",
        type: "POST",
        data: {
          id: id,
        },
      }).done(function (resp) {});
      alertify.success("Ofertas enviadas");
    }
  });
}

function enviar_oferta_id(id) {
  $.ajax({
    url: "../ADMIN/modelo/envio_correo/envio_oferta.php",
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (resp) {});
  alertify.success("Ofertas enviadas");
}
