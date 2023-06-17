var funcion,
  tabla_servicio,
  tabla_cliente,
  lista_clientes,
  tabla_vehiculo,
  tabla_marca,
  tabla_vehi_clie,
  tabla_cliente_agg,
  tabla_productos_venta_agg,
  tbla_listado_ventas,
  tbla_listado_servicios,
  tbala_reservass;

function registrar_servicio() {
  var servicio = document.getElementById("tipo_servicio").value;
  var precio = document.getElementById("precio_servicio").value;
  var detalle = document.getElementById("detalle_ser").value;
  var foto = document.getElementById("foto").value;

  if (servicio.trim() == "" || precio.trim() == "" || detalle.trim() == "") {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos completos",
      "warning"
    );
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

  funcion = "registrar_servicio";
  alerta = [
    "cambio_datos",
    "Se esta creando el servicio, por favor espere....",
    ".:Creando servicio:.",
  ];
  mostar_loader_datos(alerta);

  var formdata = new FormData();
  var foto = $("#foto")[0].files[0]; 
  formdata.append("funcion", funcion);
  formdata.append("servicio", servicio);
  formdata.append("precio", precio); 
  formdata.append("detalle", detalle); 

  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response > 0) {
        if (response == 1) {
          alerta = ["exito", "success", "El servicio se creo correctamente :)"];
          cerrar_loader_datos(alerta);
          tabla_servicio.ajax.reload();
          $("#modal_tipo_").modal("hide");
        } else if (response == 2) {
          alerta = [
            "existe",
            "warning",
            "El servicio " + servicio + ", ya esta registrado",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = [
          "error",
          "error",
          "Error al registrar el servicio - FALLO EN LA MATRIX :(",
        ];
        cerrar_loader_datos(alerta);
      }

    },
  });
  return false;

}

function listar_servicios_() {
  funcion = "listar_servicios_";
  tabla_servicio = $("#tabla_servicio").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-warning' title='editar foto'><i class='fa fa-photo'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar tipo usuario'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='photo btn btn-warning' title='editar foto'><i class='fa fa-photo'></i></button>`;
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
      { data: "servicio" },
      {
        data: "precio",
        render: function (data, type, row) {
          return "$ " + data + "";
        },
      },
      {
        data: "foto",
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
  tabla_servicio.on("draw.dt", function () {
    var pageinfo = $("#tabla_servicio").DataTable().page.info();
    tabla_servicio
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_servicio").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_servicio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_servicio.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_servicio.row(this).data();
  }
  var dato = 0;
  var id = data.id_servicio;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del servicio se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_servicio(id, dato);
    }
  });
});

$("#tabla_servicio").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_servicio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_servicio.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_servicio.row(this).data();
  }
  var dato = 1;
  var id = data.id_servicio;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del servicio se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_servicio(id, dato);
    }
  });
});

$("#tabla_servicio").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_servicio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_servicio.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_servicio.row(this).data();
  }

  $("#id_servcio").val(data.id_servicio);
  $("#servici_edit").val(data.servicio);
  $("#precio_servicio_edit").val(data.precio);
  $("#detalle_ser_edit").val(data.detalle);

  $("#modal_editar_servicio").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_servicio").modal("show");
});

function cambiar_estado_servicio(id, dato) {
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
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_servicio.ajax.reload();
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

$("#tabla_servicio").on("click", ".photo", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_servicio.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_servicio.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_servicio.row(this).data();
  }

  var foto = data.foto;
  $("#id_prod_foto").val(data.id_servicio);
  document.getElementById("foto_prodt").src = foto;
  document.getElementById("foto_ruta").value = data.foto;

  $("#modal_editar_foto").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_foto").modal("show");
});

function cambiar_foto_servicio() {
  var id = document.getElementById("id_prod_foto").value;
  var foto = document.getElementById("foto_servicio_edit").value;
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
  var foto = $("#foto_servicio_edit")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "cambiar_foto_servicio";
  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = [
    "datos",
    "Se esta editando la imagen del servicio, por favor espere....",
    ".:Editando imagen servicio:.",
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

      console.log(resp);

      if (resp > 0) { 
        if (resp == 1) {

          alerta = [
            "exito",
            "success",
            "La foto del producto se edito con exito :)",
          ];
          cerrar_loader_datos(alerta);
          document.getElementById("foto_servicio_edit").value = "";
          tabla_servicio.ajax.reload();
          $("#modal_editar_foto").modal("hide");

        }
      } else {
        alerta = [
          "error",
          "error",
          "No se pudo editar la foto - FALLO EN LA MATRIX:(",
        ];
        cerrar_loader_datos(alerta); 
      }
    },
  });
  return false;
}

//////////////////////
function editar_servicioo() {
  var id = document.getElementById("id_servcio").value;
  var servicio = document.getElementById("servici_edit").value;
  var precio = document.getElementById("precio_servicio_edit").value;
  var detalle = document.getElementById("detalle_ser_edit").value;

  if (servicio.trim() == "" || precio.trim() == "" || detalle.trim() == "") {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos completos",
      "warning"
    );
  }

  funcion = "editar_servicio";
  alerta = [
    "cambio_datos",
    "Se esta editando el servicio, por favor espere....",
    ".:Editando servicio:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion,
      id,
      servicio,
      precio,
      detalle
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El servicio se edito correctamente :)"];
        cerrar_loader_datos(alerta);
        tabla_servicio.ajax.reload();
        $("#modal_editar_servicio").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El servicio " + servicio + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el servicio - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

/////////////
function registrar_cliente() {
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
    validar_registro_cliente(
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

  funcion = "registrar_cliente";
  alerta = [
    "datos",
    "Se esta creando el cliente, por favor espere....",
    ".:Creando cliente:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
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
        cargar_contenido(
          "contenido_principal",
          "vista/servicio/registro_cliente.php"
        );
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
function validar_registro_cliente(
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

function listar_clientes() {
  funcion = "listar_clientes";
  tabla_cliente = $("#tabla_cliente").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
      { data: "nombres" },
      { data: "apellidos" },
      { data: "sexo" },
      { data: "cedula" },
      { data: "direccion" },
      { data: "telefono" },
      { data: "correo" },
      { data: "fecha" },
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
  tabla_cliente.on("draw.dt", function () {
    var pageinfo = $("#tabla_cliente").DataTable().page.info();
    tabla_cliente
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_cliente").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cliente.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cliente.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cliente.row(this).data();
  }
  var dato = 0;
  var id = data.id_cliente;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del cliente se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_cliente(id, dato);
    }
  });
});

$("#tabla_cliente").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cliente.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cliente.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cliente.row(this).data();
  }
  var dato = 1;
  var id = data.id_cliente;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del cliente se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_cliente(id, dato);
    }
  });
});

$("#tabla_cliente").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cliente.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cliente.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cliente.row(this).data();
  }

  $("#id_cliente").val(data.id_cliente);
  $("#nombre_cliente").val(data.nombres);
  $("#apellidos").val(data.apellidos);
  $("#direccion_domicilio").val(data.direccion);
  $("#numero_telefonoo").val(data.telefono);
  $("#correo_cliente").val(data.correo);
  $("#fecha_nacimiento").val(data.fecha);
  $("#sexo").val(data.sexo);
  $("#numero_documento").val(data.cedula);

  $("#correo_cliente").css("border", "1px solid green");
  $("#email_correcto").html("");

  $("#numero_documento").css("border", "1px solid green");
  $("#cedula_cliente").html("");

  $("#nombre_obliga").html("");
  $("#app_pat_obliga").html("");
  $("#direccion_obliga").html("");
  $("#telefono_obliga").html("");
  $("#correo_obliga").html("");
  $("#numero_doc_obliga").html("");
  $("#fecha_obliga").html("");

  $("#modal_ediatr_cliente").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_ediatr_cliente").modal("show");
});

function cambiar_estado_cliente(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_cliente";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {

    console.log(response);

    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_cliente.ajax.reload();
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

/////////////
function editar_cienteee() {
  var id = $("#id_cliente").val();
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
    validar_edit_cliente(
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

  funcion = "editar_clientee";
  alerta = [
    "datos",
    "Se esta editando el cliente, por favor espere....",
    ".:Editando cliente:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id,
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
        tabla_cliente.ajax.reload();
        $("#modal_ediatr_cliente").modal("hide");
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
function validar_edit_cliente(
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

function consulta_cliente() {
  $("#modal_consulta").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_consulta").modal("show");
}

function listado_clientesss() {
  funcion = "listado_clientesss";
  lista_clientes = $("#tabla_clientes_cita").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      {
        render: function (data, type, row) {
          return `<button style='font-size:13px;' type='button' class='enviar btn btn-warning' title='Inactivar tipo usuario'><i class='fa fa-send'></i></button>`;
        },
      },
      { data: "cliente" },
      { data: "sexo" },
      { data: "cedula" },
      { data: "fecha" },
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
  lista_clientes.on("draw.dt", function () {
    var pageinfo = $("#tabla_clientes_cita").DataTable().page.info();
    lista_clientes
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_clientes_cita").on("click", ".enviar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = lista_clientes.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (lista_clientes.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = lista_clientes.row(this).data();
  }
  //esto es para pasar los valores de la tabla a los inputs
  $("#nombres").val(data.cliente);
  $("#cedula").val(data.cedula);
  $("#id_cliente").val(data.id_cliente);
  $("#sexo_pac").val(data.sexo);
  $("#fecha_pac").val(data.fecha);

  $("#modal_consulta").modal("hide");
});

$("#btn_registrar_cita").click(function () {
  var frm = document.getElementById("frm_registrar");
  var fecha = $("#txtfecha_registrro").val();
  var fecha_inicio =
    $("#txtfecha_registrro").val() + " " + $("#hora_enevto").val();
  var hora = $("#hora_enevto").val();
  var color = $("#color").val();
  var color_etiqueta = $("#color_etiqueta").val();
  var asunto = $("#asunto").val();
  var nota = $("#nota").val();
  var id_cliente = $("#id_cliente").val();
  var paciente = $("#nombres").val();

  if (asunto.length == 0 || nota.length == 0 || id_cliente.length == 0) {
    validar_registro(id_cliente, asunto, nota);
    return swal.fire(
      "Mensaje de advertencia",
      "No debe dejar ningun campo vacio, por favor ingrese todos los datos completo",
      "warning"
    );
  } else {
    $("#nombre_obliga").html("");
    $("#asunto_obligg").html("");
    $("#nota_obligg").html("");
  }

  if (color == color_etiqueta) {
    return swal.fire(
      "Mensaje de advertencia",
      "El color de 'LETRA' es igual al color de 'ETIQUETA', por favor cambie uno de los 2 colores",
      "warning"
    );
  }

  alerta = [
    "datos",
    "Se esta guardando la cita, por favor espere....",
    ".:Gardando cita:.",
  ];
  mostar_loader_datos(alerta);

  funcion = "registrar_cita";

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      fecha_inicio: fecha_inicio,
      color: color,
      color_etiqueta: color_etiqueta,
      asunto: asunto,
      nota: nota,
      id_cliente: id_cliente,
      fecha: fecha,
      hora: hora,
    },
  }).done(function (response) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    if (response > 0) {
      if (response == 2) {
        return swal.fire(
          "Mensaje de advertencia",
          "El cliente '" +
            paciente +
            "' ya tiene una cita agendada en esta fecha '" +
            fecha +
            "'",
          "warning"
        );
      } else if (response == 3) {
        return swal.fire(
          "Mensaje de advertencia",
          "La hora de cita '" + hora + "' no esta disponible por ahora ",
          "warning"
        );
      } else if (response == 4) {
        return swal.fire(
          "Mensaje de advertencia",
          "El paciente '" +
            paciente +
            "' haun tiene citas pendientes, no puede separar citas :( ",
          "warning"
        );
      } else if (response == 10) {
        return swal.fire(
          "Mensaje de advertencia",
          "Lo sentimos la hora ingresada '" +
            hora +
            "', es menor a la hora actual, ingrese una hora mayor a la actual de este fecha '" +
            fecha +
            "'",
          "warning"
        );
      } else if (response == 20) {
        return swal.fire(
          "Mensaje de advertencia",
          "Lo sentimos la hora de atencion es de '8:30' a '17:30, debe ingresar una hora laboral de la empresa",
          "warning"
        );
      }
    } else if (response == 0) {
      Swal.fire(
        "Mensaje de error",
        "No se pudo guardar el evento - FALLO EN LA MATRIX :(",
        "error"
      );
    } else {
      var id = response.split("N");
      $("#calendar").fullCalendar("refetchEvents");
      $("#modal_registro").modal("toggle");

      Swal.fire({
        title: "Mensaje de confirmacion",
        text: "La cita se creo correctamente :), desea imprimir al ticker de la cita??",
        icon: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        allowOutsideClick: false,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, imprimir!!",
      }).then((result) => {
        if (result.value) {
          window.open(
            "../ADMIN/REPORTES/Pdf/ticket_de_cita.php?id=" +
              parseInt(id[1]) +
              "#zoom=100%",
            "Ticket de cita",
            "scrollbards=No"
          );
        }
      });

      // enviar_correo_cita_paciente(parseInt(id[1]));
      // envio_sms_citas(parseInt(id[1]));

      frm.reset();
    }
  });
});

/// validacion
function validar_registro(id_cliente, asunto, nota) {
  if (id_cliente.length == 0) {
    $("#nombre_obliga").html("Ingrese datos del cliente");
  } else {
    $("#nombre_obliga").html("");
  }

  if (asunto.length == 0) {
    $("#asunto_obligg").html("Ingrese el asunto del paciente");
  } else {
    $("#asunto_obligg").html("");
  }

  if (nota.length == 0) {
    $("#nota_obligg").html("Ingrese nota o obervacion del paciente");
  } else {
    $("#nota_obligg").html("");
  }
}

//este es cuando precionesel boton editar
$("#btn_editar_cita").click(function () {
  var hora = $("#hora_cita_edit").val();
  var id_cita = $("#id_cita").val();
  var fecha = $("#fecha_cita_edita").val();
  var fecha_inicio =
    $("#fecha_cita_edita").val() + " " + $("#hora_cita_edit").val();
  var color = $("#color_editar").val();
  var color_etiqueta = $("#txt_color").val();
  var asunto = $("#asunto_asunto").val();
  var nota = $("#nota_editar").val();
  var id_cliente = $("#id_cliente_editar").val();

  var nombre = $("#nombres_edit").val();

  if (asunto.length == 0 || nota.length == 0) {
    validar_registro_edit(asunto, nota);
    return swal.fire(
      "Mensaje de advertencia",
      "No debe dejar ningun campo vacio, por favor ingrese todos los datos completo",
      "warning"
    );
  } else {
    $("#asunto_edit_obligg").html("");
    $("#nota_edit_obligg").html("");
  }

  if (color == color_etiqueta) {
    return swal.fire(
      "Mensaje de advertencia",
      "El color de 'LETRA' es igual al color de 'ETIQUETA', por favor cambie uno de los 2 colores",
      "warning"
    );
  }

  alerta = [
    "datos",
    "Se esta editando la cita, por favor espere....",
    ".:Editando cita:.",
  ];
  mostar_loader_datos(alerta);
  funcion = "editar_cita";

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      id_cita: id_cita,
      funcion: funcion,
      fecha_inicio: fecha_inicio,
      color: color,
      color_etiqueta: color_etiqueta,
      asunto: asunto,
      nota: nota,
      id_cliente: id_cliente,
      fecha: fecha,
      hora: hora,
    },
  }).done(function (response) {
    console.log(response);

    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    if (response > 0) {
      if (response == 1) {
        $("#calendar").fullCalendar("refetchEvents");
        $("#modal_editar_cita").modal("toggle");
        return swal.fire(
          "Mensaje de exito",
          "La reserva se edito con exito",
          "success"
        );

      } else if (response == 2) {
        $("#calendar").fullCalendar("refetchEvents");
        return swal.fire(
          "Mensaje de advertencia",
          "El cliente '" +
            nombre +
            "' ya tiene una cita registrada en esta fecha '" +
            fecha +
            "'",
          "warning"
        );
      } else if (response == 3) {
        $("#calendar").fullCalendar("refetchEvents");
        return swal.fire(
          "Mensaje de advertencia",
          "La hora de cita " + hora + " no esta disponible por ahora ",
          "warning"
        );
      } else {
        return Swal.fire(
          "Mensaje de advertencia",
          "La fecha seleccionada '" +
            fecha +
            "' es menor que la fecha actual, no se puede editar esta cita",
          "warning"
        );
      }
    } else {
      Swal.fire(
        "Mensaje de error",
        "No se pudo editar el evento - FALLO EN LA MATRIX :(",
        "error"
      );
    }
  });
});

/// validacion
function validar_registro_edit(asunto, nota) {
  if (asunto.length == 0) {
    $("#asunto_edit_obligg").html("Ingrese el asunto del paciente");
  } else {
    $("#asunto_edit_obligg").html("");
  }

  if (nota.length == 0) {
    $("#nota_edit_obligg").html("Ingrese nota o obervacion del paciente");
  } else {
    $("#nota_edit_obligg").html("");
  }
}

function editar_eventDrop() {
  var nombre = $("#nombres_edit").val();
  var hora = $("#hora_cita_edit").val();
  var id_cita = $("#id_cita").val();
  var fecha = $("#fecha_cita_edita").val();
  var fecha_inicio =
    $("#fecha_cita_edita").val() + " " + $("#hora_cita_edit").val();
  var color = $("#color_editar").val();
  var color_etiqueta = $("#txt_color").val();
  var asunto = $("#asunto_asunto").val();
  var nota = $("#nota_editar").val();
  var id_cliente = $("#id_cliente_editar").val();

  if (
    fecha_inicio.length == 0 ||
    color.length == 0 ||
    color_etiqueta.length == 0 ||
    asunto.length == 0 ||
    nota.length == 0 ||
    id_cliente.length == 0
  ) {
    return swal.fire(
      "Mensaje de advertencia",
      "No debe dejar ningun campo vacio, por favor ingrese todos los datos completo",
      "warning"
    );
  }
  if (color == color_etiqueta) {
    return swal.fire(
      "Mensaje de advertencia",
      "El color de letra es igual al color de etiqueta, por favor cambie uno de los 2 colores",
      "warning"
    );
  }

  funcion = "editar_cita";
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      id_cita: id_cita,
      funcion: funcion,
      fecha_inicio: fecha_inicio,
      color: color,
      color_etiqueta: color_etiqueta,
      asunto: asunto,
      nota: nota,
      id_cliente: id_cliente,
      fecha: fecha,
      hora: hora,
    },
  }).done(function (response) {
    console.log(response);
    if (response > 0) {
      if (response == 1) {
        $("#calendar").fullCalendar("refetchEvents");
        Swal.fire(
          "Mensaje de confirmacion",
          "La cita se edito correctamente :)",
          "success"
        );
      } else if (response == 2) {
        $("#calendar").fullCalendar("refetchEvents");
        return swal.fire(
          "Mensaje de advertencia",
          "El cliente '" +
            nombre +
            "' ya tiene una cita registrada en esta fecha '" +
            fecha +
            "'",
          "warning"
        );
      } else if (response == 3) {
        $("#calendar").fullCalendar("refetchEvents");
        return swal.fire(
          "Mensaje de advertencia",
          "La hora de cita " + hora + " no esta disponible por ahora ",
          "warning"
        );
      }
    } else {
      Swal.fire("Mensaje de error", "No se pudo guardar el evento", "error");
    }
  });
}

///////////////////
function registrar_vehiculo() {
  var vehiculo = document.getElementById("tipo_vehiculo").value;

  if (vehiculo.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos completos",
      "warning"
    );
  }

  funcion = "registrar_vehiculo";
  alerta = [
    "cambio_datos",
    "Se esta creando el vehiculo, por favor espere....",
    ".:Creando vehiculo:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion,
      vehiculo,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El vehículo se creo correctamente :)"];
        cerrar_loader_datos(alerta);
        tabla_vehiculo.ajax.reload();
        $("#modal_vehiculo").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El vehículo " + vehiculo + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar el vehiculo - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_vehiculo() {
  funcion = "listar_vehiculo";
  tabla_vehiculo = $("#tabla_vehiculo").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
      { data: "vehiculo" },
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
  tabla_vehiculo.on("draw.dt", function () {
    var pageinfo = $("#tabla_vehiculo").DataTable().page.info();
    tabla_vehiculo
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_vehiculo").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehiculo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehiculo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehiculo.row(this).data();
  }
  var dato = 0;
  var id = data.id_vehiculo;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del vehículo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_vehiculo(id, dato);
    }
  });
});

$("#tabla_vehiculo").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehiculo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehiculo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehiculo.row(this).data();
  }
  var dato = 1;
  var id = data.id_vehiculo;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del vehículo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_vehiculo(id, dato);
    }
  });
});

$("#tabla_vehiculo").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehiculo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehiculo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehiculo.row(this).data();
  }

  $("#id_veiulo").val(data.id_vehiculo);
  $("#edit_vehiulo").val(data.vehiculo);

  $("#modal_editar_vehculo").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_vehculo").modal("show");
});

function cambiar_estado_vehiculo(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_vehiculo";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_vehiculo.ajax.reload();
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

function editar_vehiculo() {
  var id = document.getElementById("id_veiulo").value;
  var vehiculo = document.getElementById("edit_vehiulo").value;

  if (vehiculo.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos completos",
      "warning"
    );
  }

  funcion = "editar_vehiculo";
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
      vehiculo,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El vehículo se edito correctamente :)"];
        cerrar_loader_datos(alerta);
        tabla_vehiculo.ajax.reload();
        $("#modal_editar_vehculo").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El vehículo " + vehiculo + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al editar el vehiculo - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////////////
function registrar_marcaa() {
  var marca = document.getElementById("marcah_vehiculo").value;

  if (marca.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos completos",
      "warning"
    );
  }

  funcion = "registrar_marca";
  alerta = [
    "cambio_datos",
    "Se esta creando la marca, por favor espere....",
    ".:Creando marca:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion,
      marca,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La marca se creo correctamente :)"];
        cerrar_loader_datos(alerta);
        tabla_marca.ajax.reload();
        $("#modal_marca").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "La marca " + marca + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar la marca - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function listar_marcha_vehiculo() {
  funcion = "listar_marcha_vehiculo";
  tabla_marca = $("#tabla_marca").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
  tabla_marca.on("draw.dt", function () {
    var pageinfo = $("#tabla_marca").DataTable().page.info();
    tabla_marca
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_marca").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_marca.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_marca.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_marca.row(this).data();
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
      cambiar_estado_m_hiculo(id, dato);
    }
  });
});

$("#tabla_marca").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_marca.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_marca.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_marca.row(this).data();
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
      cambiar_estado_m_hiculo(id, dato);
    }
  });
});

$("#tabla_marca").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_marca.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_marca.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_marca.row(this).data();
  }

  $("#id_marca").val(data.id_marca);
  $("#marcah_vehc_edit").val(data.marca);

  $("#modal_editar_servicio").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_servicio").modal("show");
});

function cambiar_estado_m_hiculo(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_m_hiculo";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_marca.ajax.reload();
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

/////////////////////
function editar_marca_vehocuo() {
  var marca = document.getElementById("marcah_vehc_edit").value;
  var id = document.getElementById("id_marca").value;

  if (marca.length == 0) {
    return swal.fire(
      "Campo vacios",
      "Debe ingresar datos completos",
      "warning"
    );
  }

  funcion = "editar_marca_vehocuo";
  alerta = [
    "cambio_datos",
    "Se esta editando la marca, por favor espere....",
    ".:Editando marca:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion,
      id,
      marca,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "La marca se editp correctamente :)"];
        cerrar_loader_datos(alerta);
        tabla_marca.ajax.reload();
        $("#modal_editar_servicio").modal("hide");
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "La marca " + marca + ", ya esta registrado",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "Error al registrar la marca - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////
function regitro_vehoculos_cliente() {
  var cliente = $("#cliente").val();
  var fecha = $("#fecha").val();
  var tipo_vehoculo = $("#tipo_vehoculo").val();
  var tipo_marca = $("#tipo_marca").val();
  var matrcula = $("#matrcula").val();
  var color = $("#color").val();
  var detalle = $("#detalle").val();
  var foto = $("#foto").val();

  if (
    cliente.length == 0 ||
    fecha.length == 0 ||
    tipo_vehoculo.length == 0 ||
    tipo_marca.length == 0 ||
    matrcula.length == 0 ||
    color.length == 0 ||
    detalle.length == 0
  ) {
    validar_registro_vehoculo_cliente(
      cliente,
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
    $("#cliente_obligg").html("");
    $("#fecha_obliga").html("");
    $("#tipo_vehoculo_obligg").html("");
    $("#tipo_marca_obligg").html("");
    $("#matricula_obliga").html("");
    $("#color_obliga").html("");
    $("#detalle_obliga").html("");
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
  funcion = "registra_vehoculo_cliente";
  formdata.append("funcion", funcion);
  formdata.append("cliente", cliente);
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
          cargar_contenido(
            "contenido_principal",
            "vista/servicio/registro_vehiculo.php"
          );
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
function validar_registro_vehoculo_cliente(
  cliente,
  fecha,
  tipo_vehoculo,
  tipo_marca,
  matrcula,
  color,
  detalle
) {
  if (cliente.length == 0) {
    $("#cliente_obligg").html("No hay clientes");
  } else {
    $("#cliente_obligg").html("");
  }

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
    $("#matricula_obliga").html("Ingrese placa");
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

//////
//////////////
function listar_vehculos_clientess() {
  funcion = "listar_vehculos_clientess";
  tabla_vehi_clie = $("#tabla_vehi_clie").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
            return `<button style='font-size:10px;' type='button' class='inactivar btn btn-danger' title='Inactivar el producto'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el producto'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='editar_img btn btn-warning' title='Editar la imagen del producto'><i class='fa fa-image'></i></button>`;
          } else {
            return `<button style='font-size:10px;' type='button' class='activar btn btn-success' title='Activar el producto'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el producto'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='editar_img btn btn-warning' title='Editar la imagen del producto'><i class='fa fa-image'></i></button>`;
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
  tabla_vehi_clie.on("draw.dt", function () {
    var pageinfo = $("#tabla_vehi_clie").DataTable().page.info();
    tabla_vehi_clie
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_vehi_clie").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehi_clie.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehi_clie.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehi_clie.row(this).data();
  }
  var dato = 0;
  var id = data.id_clie_vehi;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del vehiculo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_vehiculo_registro_cli(id, dato);
    }
  });
});

$("#tabla_vehi_clie").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehi_clie.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehi_clie.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehi_clie.row(this).data();
  }
  var dato = 1;
  var id = data.id_clie_vehi;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del vehiculo se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_vehiculo_registro_cli(id, dato);
    }
  });
});

function cambiar_estado_vehiculo_registro_cli(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "cambiar_estado_vehiculo_registro_cli";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
        cerrar_loader_datos(alerta);
        tabla_vehi_clie.ajax.reload();
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

$("#tabla_vehi_clie").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehi_clie.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehi_clie.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehi_clie.row(this).data();
  }

  $("#id_vehoculo_cliente").val(data.id_clie_vehi);
  $("#cliente").val(data.id_cliente).trigger("change");

  $("#fecha").val(data.fecha);
  $("#tipo_vehoculo").val(data.tipo_vehoculo).trigger("change");
  $("#tipo_marca").val(data.tipo_marca).trigger("change");
  $("#matrcula").val(data.matrcula);
  $("#color").val(data.color);
  $("#detalle").val(data.detalle);

  $("#validacion_placa").html('');
  $("#btn_acpetaraa").show();

  $("#modal_editr_vehicuo_cliente").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editr_vehicuo_cliente").modal("show");
});

$("#tabla_vehi_clie").on("click", ".editar_img", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_vehi_clie.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_vehi_clie.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_vehi_clie.row(this).data();
  }
  var fot0 = data.ruta;
  $("#id_prod_foto").val(data.id_clie_vehi);
  document.getElementById("foto_prodt").src = fot0;
  document.getElementById("foto_ruta").value = data.ruta;

  $("#modal_editar_foto_carro").modal({ backdrop: "static", keyboard: false });
  $("#modal_editar_foto_carro").modal("show");
});

function cambiar_foto_vehiculo() {
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
        document.getElementById("foto_prod_edit").value = "";
        document.getElementById("foto_prodt").src = "img/vehiculo/" + resp;
        document.getElementById("foto_ruta").value = "img/vehiculo/" + resp;
        tabla_vehi_clie.ajax.reload();
      }
    },
  });
  return false;
}

function editar_vehiculo_cliente() {
  var id = $("#id_vehoculo_cliente").val();
  var cliente = $("#cliente").val();
  var fecha = $("#fecha").val();
  var tipo_vehoculo = $("#tipo_vehoculo").val();
  var tipo_marca = $("#tipo_marca").val();
  var matrcula = $("#matrcula").val();
  var color = $("#color").val();
  var detalle = $("#detalle").val();

  if (
    cliente.length == 0 ||
    fecha.length == 0 ||
    tipo_vehoculo.length == 0 ||
    tipo_marca.length == 0 ||
    matrcula.length == 0 ||
    color.length == 0 ||
    detalle.length == 0
  ) {
    validar_registro_vehoculo_cliente_edit(
      cliente,
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
    $("#cliente_obligg").html("");
    $("#fecha_obliga").html("");
    $("#tipo_vehoculo_obligg").html("");
    $("#tipo_marca_obligg").html("");
    $("#matricula_obliga").html("");
    $("#color_obliga").html("");
    $("#detalle_obliga").html("");
  }

  funcion = "editar_vehiculo_cliente";
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
      cliente,
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
        alerta = [
          "exito",
          "success",
          "El vehiculo del cliente se edito con exito :)",
        ];
        cerrar_loader_datos(alerta);
        tabla_vehi_clie.ajax.reload();
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
function validar_registro_vehoculo_cliente_edit(
  cliente,
  fecha,
  tipo_vehoculo,
  tipo_marca,
  matrcula,
  color,
  detalle
) {
  if (cliente.length == 0) {
    $("#cliente_obligg").html("No hay clientes");
  } else {
    $("#cliente_obligg").html("");
  }

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
    $("#matricula_obliga").html("Ingrese placa");
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

////////////////////
//////////////// par las ventas
function modal_cliente() {
  $("#modal__lista_cliente").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal__lista_cliente").modal("show");
}

function listar_clientes_agg() {
  funcion = "listar_clientes_agg";
  tabla_cliente_agg = $("#tabla_cliente_agg").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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

      { data: "cliente" },
      { data: "sexo" },
      { data: "cedula" },
      { data: "correo" },
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
  tabla_cliente_agg.on("draw.dt", function () {
    var pageinfo = $("#tabla_cliente_agg").DataTable().page.info();
    tabla_cliente_agg
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_cliente_agg").on("click", ".enviar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_cliente_agg.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_cliente_agg.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_cliente_agg.row(this).data();
  }
  //esto es para pasar los valores de la tabla a los inputs
  $("#id_cliente").val(data.id_cliente);
  $("#nume_doc").val(data.cedula);
  $("#nombres_clie").val(data.cliente);
  $("#sexo_clie").val(data.sexo);
  $("#correo_clie").val(data.correo);
  //cierro el modal
  $("#modal__lista_cliente").modal("hide");
});

function modal_productoos() {
  $("#modal__lista_prroductos_venta").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal__lista_prroductos_venta").modal("show");
}

function listado_prodcutos_venta_agg() {
  funcion = "listado_prodcutos_venta_agg";
  tabla_productos_venta_agg = $("#tabla_productos_venta_agg").DataTable({
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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

      {
        data: "estado",
        render: function (data, type, row) {
          if (data == "activo") {
            return "<span class='label label-success'>" + data + "</span>";
          } else {
            return "<span class='label label-warning'>" + data + "</span>";
          }
        },
      },

      {
        data: "producto_destacar",
        render: function (data, type, row) {
          if (data == 1) {
            return "<span class='label label-success'>Si</span>";
          } else {
            return "<span class='label label-warning'>No</span>";
          }
        },
      },

      { data: "poducto_codigo" },

      {
        data: "producto_foto",
        render: function (data, type, row) {
          return (
            '<img width="53px" height="53px" class="img-circle m-r-10" src="../ADMIN/' +
            data +
            '">'
          );
        },
      },
      { data: "stock" },
      { data: "producto_precio_venta" },
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
  tabla_productos_venta_agg.on("draw.dt", function () {
    var pageinfo = $("#tabla_productos_venta_agg").DataTable().page.info();
    tabla_productos_venta_agg
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_productos_venta_agg").on("click", ".enviar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_productos_venta_agg.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_productos_venta_agg.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_productos_venta_agg.row(this).data();
  }

  $("#id_producto_agg").val(data.id_producto);
  $("#nombre_prodc").val(data.producto_nombre);
  // $("#codigo_pro").val(data.);
  $("#tipo_producto").val(data.tipo_producto);
  $("#marca_product").val(data.marca);
  $("#stock_product").val(data.stock);
  $("#precio").val(data.producto_precio_venta);
  $("#cantidad").val(1);
  traer_promocion(data.id_producto);

  $("#modal__lista_prroductos_venta").modal("hide");
});

function traer_promocion(id) {
  funcion = "traer_promocion_prod";
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (response) {
    var dato = JSON.parse(response);
    if (dato.length != 0) {
      // $("#fecha_ini").val(dato[0]["fecha_inicio"]);
      $("#fecha_fin").val(dato[0]["fecha_fin"]);
      $("#tipo_pro").val("Descuento");
      $("#descuento_promo").val(dato[0]["procentaje"]);
    } else {
      // $("#fecha_ini").val("");
      $("#fecha_fin").val("");
      $("#tipo_pro").val("No tiene");
      $("#descuento_promo").val("0");
    }
  });
}

function registrar_venta_() {
  var id_cliente = $("#id_cliente").val();
  var impuesto = $("#inpuesto").val();
  var tipo_comprobante = $("#tipo_comprobante").val();
  var num_compro = $("#numeroe_comprobante").val();
  var fecha_venta = $("#fecha_venta").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();

  var count = 0;

  if (id_cliente.length == 0) {
    $("#nombre_obigg").html("Ingrese cliente");
    return Swal.fire(
      "Mensaje de advertencia",
      "Debe ingresar datos del cliente",
      "warning"
    );
  } else {
    $("#nombre_obigg").html("");
  }

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

  if (num_compro.length == 0) {
    $("#number_obligg").html("Ingrese N° comp.");
    return Swal.fire(
      "Mensaje de advertencia",
      "Debe ingresar el valor de inpuesto",
      "warning"
    );
  } else {
    $("#number_obligg").html("");
  }

  $("#detalle_venta tbody#tbody_detalle_prodcuto_venta tr").each(function () {
    count++;
  });

  if (count == 0) {
    $("#detalle_obligg").html(
      "Ingrese productos al detalle para realizar la venta"
    );
    return Swal.fire(
      "Mensaje de advertencia",
      "El detalle de venta debe tener un producto por lo menos,(TABLA PRODUCTO)",
      "warning"
    );
  } else {
    $("#detalle_obligg").html("");
  }

  funcion = "registrar_venta";
  alerta = [
    "datos",
    "Se esta registrando la venta, por favor espere....",
    ".:Registrando la venta:.",
  ];
  mostar_loader_datos(alerta);
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id_cliente: id_cliente,
      impuesto: impuesto,
      tipo_comprobante: tipo_comprobante,
      num_compro: num_compro,
      fecha_venta: fecha_venta,
      count: count,
      txt_totalneto: txt_totalneto,
      txt_impuesto: txt_impuesto,
      txt_a_pagar: txt_a_pagar,
    },
  }).done(function (resp) {
    if (resp > 0) {
      registrar_detalle_venta(parseInt(resp));
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo regitrar la venta - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_venta(id) {
  var tipo_comprobante = $("#tipo_comprobante").val();

  var count = 0;
  var arrego_idproducto = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_des_promo = new Array();
  var arreglo_tipo_promo = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  //con esto estoy recorriendo toda la tabla de registros
  $("#detalle_venta tbody#tbody_detalle_prodcuto_venta tr").each(function () {
    //qui ago referencia al id de la tabala y en EQ va el id poscion (0)
    arrego_idproducto.push($(this).find("td").eq(0).text());
    arreglo_cantidad.push($(this).find("td").eq(2).text());
    arreglo_precio.push($(this).find("td").eq(3).text());
    arreglo_des_promo.push($(this).find("td").eq(4).text());
    arreglo_tipo_promo.push($(this).find("td").eq(5).text());
    arreglo_descuento_moneda.push($(this).find("td").eq(6).text());
    arreglo_subtotal.push($(this).find("td").eq(7).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var idproducto = arrego_idproducto.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des_promo = arreglo_des_promo.toString();
  var tipo_promo = arreglo_tipo_promo.toString();
  var descuento_moneda = arreglo_descuento_moneda.toString();
  var subtotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_venta";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idproducto: idproducto,
      cantidad: cantidad,
      precio: precio,
      des_promo: des_promo,
      tipo_promo: tipo_promo,
      descuento_moneda: descuento_moneda,
      subtotal: subtotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["", "", ""];
        cerrar_loader_datos(alerta);

        ///////////////
        envio_correo_venta(parseInt(id));
        ///////////////

        Swal.fire({
          title: "Imprimir reporte de venta",
          text: "Desea imprimir el reporte de venta??",
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
              "../ADMIN/REPORTES/Pdf/factura_venta.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de ingreso",
              "scrollbards=No"
            );
          }
        });
        cargar_contenido(
          "contenido_principal",
          "vista/servicio/nueva_venta.php"
        );
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
        "No se pudo regitrar el detalle de la venta - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////envio de correo
function envio_correo_venta(id) {
  $.ajax({
    url: "../ADMIN/modelo/envio_correo/envio_venta.php",
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (response) {
    console.log(response);
  });
}

///////////
function listado_ventas() {
  funcion = "listado_ventas";
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='pdf btn btn-warning' title='Activar tipo usuario'><i class='fa fa-print'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-eye'></i></button>`;
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

$("#tbla_listado_ventas").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbla_listado_ventas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbla_listado_ventas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbla_listado_ventas.row(this).data();
  }

  var id = data.id_venta;
  var iva = data.impuesto;

  alerta = [
    "datos",
    "Se esta cargando el registro, por favor espere....",
    ".:Cargando la venta:.",
  ];
  mostar_loader_datos(alerta);
  cargar_detalle_venta(parseInt(id), iva);
});

function cargar_detalle_venta(id, iva) {
  funcion = "detalle_de_venta";
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    let arreglo_total = new Array();
    let total = 0;
    let impuestototal = 0;
    let subtotal = 0;
    let impuesto = iva;

    var data = JSON.parse(resp);
    var llenat = "";
    var count = 0;
    data["data"].forEach((row) => {
      count++;
      llenat += `     <tr>
                          <td for='id'>${count}</td>
                          <td>${row["producto_nombre"]} - ${row["tipo_producto"]} - ${row["marca"]}</td>
                          <td>${row["cantidad"]}</td>
                          <td>${row["precio"]}</td>
                          <td>${row["descuento_oferta"]}</td>
                          <td>${row["tipo_promo"]}</td>
                          <td>${row["descuento_moneda"]}</td>
                          <td>${row["subtotal"]}</td>
                          </tr>`;

      arreglo_total = row["subtotal"];

      subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(2);
      impuestototal = parseFloat((subtotal * impuesto) / 100).toFixed(2);
      total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

      $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
      $("#lbl_impuesto").html(
        "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
      );

      $("#lbl_a_pagar").html("<b>Total a pagar: </b> $/." + total);
      $("#txt_totalneto").val(subtotal);
      $("#txt_impuesto").val(impuestototal);
      $("#txt_a_pagar").val(total);
      $("#tbody_detalle_prodcuto_venta_edit").html(llenat);
    });

    $("#modal_editar_venta").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_editar_venta").modal("show");
  });
}

$("#tbla_listado_ventas").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbla_listado_ventas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbla_listado_ventas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbla_listado_ventas.row(this).data();
  }
  var id = data.id_venta;

  Swal.fire({
    title: "Anular venta",
    text: "Desea anular la venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      funcion = "anula_venta";
      alerta = [
        "datos",
        "Se esta anulando la venta, por favor espere....",
        ".:Anulando venta:.",
      ];
      mostar_loader_datos(alerta);
      $.ajax({
        url: "../ADMIN/controlador/servicio/servicio.php",
        type: "POST",
        data: {
          funcion: funcion,
          id: id,
        },
      }).done(function (resp) {
        if (resp > 0) {
          if (resp == 1) {
            tbla_listado_ventas.ajax.reload();
            alerta = ["exito", "success", "La venta se anulo con exito"];
            cerrar_loader_datos(alerta);
          }
        } else {
          alerta = [
            "error",
            "error",
            "La venta no se puedo anular, fallo en laa matrix",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
});

$("#tbla_listado_ventas").on("click", ".pdf", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbla_listado_ventas.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbla_listado_ventas.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbla_listado_ventas.row(this).data();
  }
  var id = data.id_venta;

  Swal.fire({
    title: "Imprimir reporte de venta",
    text: "Desea imprimir el reporte de venta??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        "../ADMIN/REPORTES/Pdf/factura_venta.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Factura venta",
        "scrollbards=No"
      );
    }
  });
});

////////////////////
/////////////////
function registar_servicio_cliente() {
  var cliente_id = $("#cliente_id").val();
  var vehculos_id = $("#vehculos_id").val();
  var inpuesto = $("#inpuesto").val();
  var tipo_comprobante = $("#tipo_comprobante").val();
  var num_compro = $("#numeroe_comprobante").val();
  var fecha = $("#fecha_venta").val();

  var txt_total_servico = $("#txt_sub_servicio").val();

  var txt_totalneto = $("#txt_totalneto").val();
  var txt_impuesto = $("#txt_impuesto").val();
  var txt_a_pagar = $("#txt_a_pagar").val();

  var count = 0;
  var count_pro = 0;

  if (cliente_id.length == 0) {
    $("#clienet_obligg").html("Ingrese cliente");
    return Swal.fire(
      "Mensaje de advertencia",
      "Debe ingresar datos del cliente",
      "warning"
    );
  } else {
    $("#clienet_obligg").html("");
  }

  if (vehculos_id.length == 0) {
    $("#vehculo_obligg").html("Ingrese vehiculo");
    return Swal.fire(
      "Mensaje de advertencia",
      "Debe ingresar datos del vehiculo",
      "warning"
    );
  } else {
    $("#vehculo_obligg").html("");
  }

  $("#tabla_servicios tbody#tbody_servicios tr").each(function () {
    count++;
  });

  $("#detalle_venta tbody#tbody_detalle_prodcuto_venta tr").each(function () {
    count_pro++;
  });

  if (count == 0) {
    return Swal.fire(
      "Mensaje de advertencia",
      "Ingrese servicios en la table detalle de servicios",
      "warning"
    );
  }

  funcion = "registar_servicio_cliente";

  alerta = [
    "datos",
    "Se esta registrando el servicio, por favor espere....",
    ".:Registrando el servicio:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      vehculos_id: vehculos_id,
      inpuesto: inpuesto,
      tipo_comprobante: tipo_comprobante,
      num_compro: num_compro,
      fecha: fecha,
      txt_total_servico: txt_total_servico,
      txt_totalneto: txt_totalneto,
      txt_impuesto: txt_impuesto,
      txt_a_pagar: txt_a_pagar,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (count_pro == 0) {
        registrar_detalle_sericio(parseInt(resp));
      } else {
        registrar_detalle_producto_servicio(parseInt(resp));
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo regitrar el servicio - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function registrar_detalle_producto_servicio(id) {
  var id = id;
  var count = 0;
  var arrego_idproducto = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_des_promo = new Array();
  var arreglo_tipo_promo = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  //con esto estoy recorriendo toda la tabla de registros
  $("#detalle_venta tbody#tbody_detalle_prodcuto_venta tr").each(function () {
    //qui ago referencia al id de la tabala y en EQ va el id poscion (0)
    arrego_idproducto.push($(this).find("td").eq(0).text());
    arreglo_cantidad.push($(this).find("td").eq(2).text());
    arreglo_precio.push($(this).find("td").eq(3).text());
    arreglo_des_promo.push($(this).find("td").eq(4).text());
    arreglo_tipo_promo.push($(this).find("td").eq(5).text());
    arreglo_descuento_moneda.push($(this).find("td").eq(6).text());
    arreglo_subtotal.push($(this).find("td").eq(7).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var idproducto = arrego_idproducto.toString();
  var cantidad = arreglo_cantidad.toString();
  var precio = arreglo_precio.toString();
  var des_promo = arreglo_des_promo.toString();
  var tipo_promo = arreglo_tipo_promo.toString();
  var descuento_moneda = arreglo_descuento_moneda.toString();
  var subtotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_producto_servicio";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idproducto: idproducto,
      cantidad: cantidad,
      precio: precio,
      des_promo: des_promo,
      tipo_promo: tipo_promo,
      descuento_moneda: descuento_moneda,
      subtotal: subtotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        registrar_detalle_sericio(parseInt(id));
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo regitrar el detalle de producto - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

//////////
function registrar_detalle_sericio(id) {
  var tipo_comprobante = $("#tipo_comprobante").val();

  var count = 0;
  var arrego_idservicio = new Array();
  var arreglo_cantidad = new Array();
  var arreglo_precio = new Array();
  var arreglo_descuento_moneda = new Array();
  var arreglo_subtotal = new Array();

  //con esto estoy recorriendo toda la tabla de registros
  $("#tabla_servicios tbody#tbody_servicios tr").each(function () {
    //qui ago referencia al id de la tabala y en EQ va el id poscion (0)
    arrego_idservicio.push($(this).find("td").eq(0).text());
    arreglo_precio.push($(this).find("td").eq(2).text());
    arreglo_cantidad.push($(this).find("td").eq(3).text());
    arreglo_descuento_moneda.push($(this).find("td").eq(4).text());
    arreglo_subtotal.push($(this).find("td").eq(5).text());
    count++;
  });

  //aqui combierto el arreglo a un string
  var idservicio = arrego_idservicio.toString();
  var precio = arreglo_precio.toString();
  var cantidad = arreglo_cantidad.toString();
  var descuento = arreglo_descuento_moneda.toString();
  var subtotal = arreglo_subtotal.toString();

  if (count == 0) {
    return;
  }

  funcion = "registrar_detalle_servicioo";
  //ajax para guardar detalle registros
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      idservicio: idservicio,
      precio: precio,
      cantidad: cantidad,
      descuento: descuento,
      subtotal: subtotal,
    },
  }).done(function (resp) {
    if (resp > 0) {
      if (resp == 1) {
        alerta = ["", "", ""];
        cerrar_loader_datos(alerta);

        envio_correo_servicio(parseInt(id));
        Swal.fire({
          title: "Imprimir reporte de servicio",
          text: "Desea imprimir el reporte de servicio??",
          icon: "warning",
          showCancelButton: true,
          showConfirmButton: true,
          allowOutsideClick: false,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, imprimir!!",
        }).then((result) => {
          if (result.value) {
            window.open(
              "../ADMIN/REPORTES/Pdf/factura_servicios.php?id=" +
                parseInt(id) +
                "#zoom=100%",
              "Reporte de ingreso",
              "scrollbards=No"
            );
          }
        });

        cargar_contenido(
          "contenido_principal",
          "vista/servicio/nueva_venta.php"
        );
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
        "No se pudo regitrar el detalle de la venta - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

////////////////envio de correo
function envio_correo_servicio(id) {
  $.ajax({
    url: "../ADMIN/modelo/envio_correo/envio_servicio.php",
    type: "POST",
    data: {
      id: id,
    },
  }).done(function (response) {
    console.log(response);
  });
}

///////////
function lisra_servicios_clientes() {
  funcion = "lisra_servicios_clientes";
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar tipo usuario'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='pdf btn btn-warning' title='Activar tipo usuario'><i class='fa fa-print'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar tipo de usuario'><i class='fa fa-eye'></i></button>`;
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

$("#tbla_listado_servicios").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbla_listado_servicios.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbla_listado_servicios.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbla_listado_servicios.row(this).data();
  }

  var id = data.id_servicio_cliente;
  var iva = data.inpuesto;

  alerta = [
    "datos",
    "Se esta cargando el registro, por favor espere....",
    ".:Cargando el servicio:.",
  ];

  mostar_loader_datos(alerta);

  cargar_detalle_servciio(parseInt(id));
  cargar_detalle_venta_servicio(parseInt(id), iva);
});

function cargar_detalle_servciio(id) {
  funcion = "cargar_detalle_servciio";
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    let arreglo_total = new Array();
    let subtotal = 0;

    var data = JSON.parse(resp);
    var llenat = "";
    var count = 0;
    data["data"].forEach((row) => {
      count++;
      llenat += `     <tr>
                          <td>${count}</td>
                          <td>${row["servicio"]}</td>
                          <td>${row["precio"]}</td>
                          <td>${row["cantidad"]}</td>
                          <td>${row["descuento"]}</td>
                          <td>${row["subtotal"]}</td> 
                          </tr>`;

      arreglo_total = row["subtotal"];
      subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(2);
      $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
      $("#tbody_detalle_prodcuto_servicios_detalle").html(llenat);
    });

    $("#modal_ver_servicio_detalle").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_ver_servicio_detalle").modal("show");
  });
}

function cargar_detalle_venta_servicio(id, iva) {
  funcion = "cargar_detalle_venta_servicio";
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp != 0) {
      let arreglo_total = new Array();
      let total = 0;
      let impuestototal = 0;
      let subtotal = 0;
      let impuesto = iva;

      var data = JSON.parse(resp);
      var llenat = "";
      var count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `     <tr>
                          <td for='id'>${count}</td>
                          <td>${row["producto_nombre"]} - ${row["tipo_producto"]} - ${row["marca"]}</td>
                          <td>${row["cantidad"]}</td>
                          <td>${row["precio"]}</td>
                          <td>${row["descuento_oferta"]}</td>
                          <td>${row["tipo_promo"]}</td>
                          <td>${row["descuento_moneda"]}</td>
                          <td>${row["subtotal"]}</td>
                          </tr>`;

        arreglo_total = row["subtotal"];

        subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(
          2
        );
        impuestototal = parseFloat((subtotal * impuesto) / 100).toFixed(2);
        total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

        $("#lbl_totalneto_pro").html("<b>Total neto: </b> $/." + subtotal);
        $("#lbl_impuesto_pro").html(
          "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
        );
        $("#lbl_a_pagar_p").html("<b>Total a pagar: </b> $/." + total);

        $("#tbody_detalle_prodcuto_productos_detalle").html(llenat);
      });
    } else {
      $("#tbody_detalle_prodcuto_productos_detalle").empty();
      $("#lbl_totalneto_pro").html("");
      $("#lbl_impuesto_pro").html("");
      $("#lbl_a_pagar_p").html("");
    }
  });
}

$("#tbla_listado_servicios").on("click", ".pdf", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbla_listado_servicios.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbla_listado_servicios.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbla_listado_servicios.row(this).data();
  }
  var id = data.id_servicio_cliente;

  Swal.fire({
    title: "Imprimir reporte de servicio",
    text: "Desea imprimir el reporte de servicio??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, imprimir!!",
  }).then((result) => {
    if (result.value) {
      window.open(
        "../ADMIN/REPORTES/Pdf/factura_servicios.php?id=" +
          parseInt(id) +
          "#zoom=100%",
        "Reporte de ingreso",
        "scrollbards=No"
      );
    }
  });
});

$("#tbla_listado_servicios").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbla_listado_servicios.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbla_listado_servicios.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbla_listado_servicios.row(this).data();
  }
  var id = data.id_servicio_cliente;

  Swal.fire({
    title: "Anular servicio",
    text: "Desea anular el servicio??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, anular!!",
  }).then((result) => {
    if (result.value) {
      funcion = "anula_servicio_compra";
      alerta = [
        "datos",
        "Se esta anulando la servicio, por favor espere....",
        ".:Anulando servicio:.",
      ];
      mostar_loader_datos(alerta);
      $.ajax({
        url: "../ADMIN/controlador/servicio/servicio.php",
        type: "POST",
        data: {
          funcion: funcion,
          id: id,
        },
      }).done(function (resp) {
        if (resp > 0) {
          if (resp == 1) {
            tbla_listado_servicios.ajax.reload();
            alerta = ["exito", "success", "El servicio se anulo con exito"];
            cerrar_loader_datos(alerta);
          }
        } else {
          alerta = [
            "error",
            "error",
            "El servicio no se puedo anular, fallo en laa matrix",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
});

//////////////////lisado de reservas
function listar_reservass() {
  funcion = "listar_reservass";
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
      url: "../ADMIN/controlador/servicio/servicio.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Anular reserva'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='antender btn btn-primary' title='Anteder reserva'><i class='fa fa-wrench'></i></button> - <button style='font-size:13px;' type='button' class='ver btn btn-warning' title='ver reservas'><i class='fa fa-eye'></i></button>`;
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
            return (
              "<span style='font-size:12px;' class='label label-success'>Atendido</span>"
            );
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

$("#tbala_reservass").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbala_reservass.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbala_reservass.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbala_reservass.row(this).data();
  }
  var id_cita = data.id_cita;
  var id_reserva = data.id_reserva;

  Swal.fire({
    title: "Eliminar reserva",
    text: "Desea eliminar la reserva?",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar!",
  }).then((result) => {
    if (result.value) {

      funcion = "eliminar_reserva_cliente";
      alerta = [
        "datos",
        "Se esta eliminando la reserva, por favor espere....",
        ".:Eliminando reserva:.",
      ];

      mostar_loader_datos(alerta);
      $.ajax({
        url: "../ADMIN/controlador/servicio/servicio.php",
        type: "POST",
        data: {
          funcion: funcion,
          id_cita: id_cita,
          id_reserva: id_reserva,
        },
      }).done(function (resp) {
        if (resp > 0) {
          if (resp == 1) {
            tbala_reservass.ajax.reload();
            alerta = ["exito", "success", "La reserva se elimino con exito"];
            cerrar_loader_datos(alerta);
          }
        } else {
          alerta = [
            "error",
            "error",
            "La reserva no se puedo eliminar, fallo en la matrix",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
});

$("#tbala_reservass").on("click", ".ver", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbala_reservass.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbala_reservass.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbala_reservass.row(this).data();
  }

  var id = data.id_reserva;
  var iva = 12;

  alerta = [
    "datos",
    "Se esta cargando el detalle, por favor espere....",
    ".:Cargando el detalle:.",
  ];

  mostar_loader_datos(alerta);

  cargar_detalle_servciio_reserva(parseInt(id));
  cargar_detalle_venta_servicio_reserva(parseInt(id), iva);
});

function cargar_detalle_servciio_reserva(id) {
  funcion = "cargar_detalle_servciio";
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    let arreglo_total = new Array();
    let subtotal = 0;

    var data = JSON.parse(resp);
    var llenat = "";
    var count = 0;
    data["data"].forEach((row) => {
      count++;
      llenat += `     <tr>
                          <td>${count}</td>
                          <td>${row["servicio"]}</td>
                          <td>${row["precio"]}</td>
                          <td>${row["cantidad"]}</td>
                          <td>${row["descuento"]}</td>
                          <td>${row["subtotal"]}</td> 
                          </tr>`;

      arreglo_total = row["subtotal"];
      subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(2);
      $("#lbl_totalneto").html("<b>Total neto: </b> $/." + subtotal);
      $("#tbody_detalle_prodcuto_servicios_detalle").html(llenat);
    });

    $("#modal_ver_servicio_detalle").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_ver_servicio_detalle").modal("show");
  });
}

function cargar_detalle_venta_servicio_reserva(id, iva) {
  funcion = "cargar_detalle_venta_servicio";
  $.ajax({
    url: "../ADMIN/controlador/servicio/servicio.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (resp) {
    if (resp != 0) {
      let arreglo_total = new Array();
      let total = 0;
      let impuestototal = 0;
      let subtotal = 0;
      let impuesto = iva;

      var data = JSON.parse(resp);
      var llenat = "";
      var count = 0;
      data["data"].forEach((row) => {
        count++;
        llenat += `     <tr>
                          <td for='id'>${count}</td>
                          <td>${row["producto_nombre"]} - ${row["tipo_producto"]} - ${row["marca"]}</td>
                          <td>${row["cantidad"]}</td>
                          <td>${row["precio"]}</td>
                          <td>${row["descuento_oferta"]}</td>
                          <td>${row["tipo_promo"]}</td>
                          <td>${row["descuento_moneda"]}</td>
                          <td>${row["subtotal"]}</td>
                          </tr>`;

        arreglo_total = row["subtotal"];

        subtotal = (parseFloat(subtotal) + parseFloat(arreglo_total)).toFixed(
          2
        );
        impuestototal = parseFloat((subtotal * impuesto) / 100).toFixed(2);
        total = (parseFloat(subtotal) + parseFloat(impuestototal)).toFixed(2);

        $("#lbl_totalneto_pro").html("<b>Total neto: </b> $/." + subtotal);
        $("#lbl_impuesto_pro").html(
          "<b>inpuesto: % " + impuesto + " </b> $/." + impuestototal
        );
        $("#lbl_a_pagar_p").html("<b>Total a pagar: </b> $/." + total);

        $("#tbody_detalle_prodcuto_productos_detalle").html(llenat);
      });
    } else {
      $("#tbody_detalle_prodcuto_productos_detalle").empty();
      $("#lbl_totalneto_pro").html("");
      $("#lbl_impuesto_pro").html("");
      $("#lbl_a_pagar_p").html("");
    }
  });
}

$("#tbala_reservass").on("click", ".antender", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tbala_reservass.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tbala_reservass.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tbala_reservass.row(this).data();
  }
  var id = data.id_cita;

  Swal.fire({
    title: "Atender servicio",
    text: "Desea atender el servicio del cliente??",
    icon: "warning",
    showCancelButton: true,
    showConfirmButton: true,
    allowOutsideClick: false,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, atender!!",
  }).then((result) => {
    if (result.value) {
      funcion = "atendiendo_servicio_reserva";
      alerta = [
        "datos",
        "Se esta atendiendo el servicio, por favor espere....",
        ".:Atendiendo servicio:.",
      ];
      mostar_loader_datos(alerta);

      $.ajax({
        url: "../ADMIN/controlador/servicio/servicio.php",
        type: "POST",
        data: {
          funcion: funcion,
          id: id,
        },
      }).done(function (resp) {
        if (resp > 0) {
          if (resp == 1) {
            tbala_reservass.ajax.reload();
            alerta = ["exito", "success", "La reserva se atendio con exito"];
            cerrar_loader_datos(alerta);
          }
        } else {
          alerta = [
            "error",
            "error",
            "No se pudo atneder la reserva, fallo en laa matrix",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
});
