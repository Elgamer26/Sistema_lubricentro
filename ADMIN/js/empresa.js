var funcion, tabña_respaldoo;

function traer_datos_optica() {
  funcion = "trae_datos_optica";
  var id = 1;
  $.ajax({
    url: "../ADMIN/controlador/empresa/empresa.php",
    type: "POST",
    data: { id: id, funcion: funcion },
  }).done(function (resp) {
    var data = JSON.parse(resp);

    document.getElementById("haci_nombre").value = data[0][1];
    document.getElementById("Direccion").value = data[0][2];
    document.getElementById("Telefono").value = data[0][3];
    document.getElementById("Ruc").value = data[0][4];
    document.getElementById("email").value = data[0][5];
    document.getElementById("fecha_fun").value = data[0][6];

    document.getElementById("lema").value = data[0][7];
    document.getElementById("Actividad").innerHTML = data[0][8];

    document.getElementById("foto_actual").value = data[0][9];
    document.getElementById("foto_hh").src = data[0][9];
  });
}

function cambiar_foto_optica() {
  var id = 1;
  var foto = $("#foto_hacie").val();
  var ruta_actual = $("#foto_actual").val();

  if (foto.length == 0 || ruta_actual.length == 0) {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese una imagen para actualizar",
      "warning"
    );
  }

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
  var foto = $("#foto_hacie")[0].files[0];

  funcion = "cambiar_imagen";
  alerta = [
    "datos",
    "Se esta cambiando la imagen de la empresa, por favor espere....",
    ".:Cambiando imagen:.",
  ];
  mostar_loader_datos(alerta);

  formdata.append("funcion", funcion);
  formdata.append("id", id);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../ADMIN/controlador/empresa/empresa.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        if (resp == 1) {
          traer_datos_optica();
          document.getElementById("foto_hacie").value = "";

          alerta = [
            "exito",
            "success",
            "La imagen de la empresa se edito con exito :)",
          ];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = [
          "error",
          "error",
          "No se pudo editar la imagen de la empresa - FALLO EN LA MATRIX:(",
        ];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function editar_datos_optica() {
  var id = 1;
  var haci_nombre = $("#haci_nombre").val();
  var Direccion = $("#Direccion").val();
  var Telefono = $("#Telefono").val();
  var Ruc = $("#Ruc").val();
  var email = $("#email").val();
  var fecha_fun = $("#fecha_fun").val();
  var lema = $("#lema").val();
  var Actividad = $("#Actividad").val();

  if (
    email.length == 0 ||
    haci_nombre.length == 0 ||
    Direccion.length == 0 ||
    Telefono.length == 0 ||
    Ruc.length == 0 ||
    fecha_fun.length == 0 ||
    Actividad.length == 0 
  ) {
    validar_registro_editar(
      haci_nombre,
      Direccion,
      Telefono,
      Ruc,
      email,
      fecha_fun,
      lema,
      Actividad
    );
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese todo los datos, no debe queda ningun campo vacio",
      "warning"
    );
  } else {
    $("#nombre_empresa__obligg").html("");
    $("#direccion_obligg").html("");
    $("#telefono_empresa_obligg").html("");
    $("#ruc_empresa_obligg").html("");
    $("#empresa_empresa_obligg").html("");
    $("#fecha_empresa_obligg").html("");
    $("#lema_empresa_obligg").html("");
    $("#actividad_empresa_obligg").html("");
  }

  funcion = "editar_datos_optica";
  alerta = [
    "datos",
    "Se esta editando los datos de la empresa, por favor espere....",
    ".:Editando datos de la empresa:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/empresa/empresa.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      haci_nombre: haci_nombre,
      Direccion: Direccion,
      Telefono: Telefono,
      Ruc: Ruc,
      fecha_fun: fecha_fun,
      Actividad: Actividad,
      lema: lema,
      email: email
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        $("#foto_hacie").val("");
        traer_datos_optica();
        alerta = [
          "exito",
          "success",
          "Datos de la empresa editados con exito :)",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 10) {
        alerta = [
          "existe",
          "warning",
          "El correo ingresaso '" + email + "' es invalido :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo editar la empresa - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

// validar registro_editar
function validar_registro_editar(
  haci_nombre,
  Direccion,
  Telefono,
  Ruc,
  email,
  fecha_fun,
  lema,
  Actividad
) {
  if (haci_nombre.length == 0) {
    $("#nombre_empresa__obligg").html("Ingrese dato");
  } else {
    $("#nombre_empresa__obligg").html("");
  }

  if (Direccion.length == 0) {
    $("#direccion_obligg").html("Ingrese dato");
  } else {
    $("#direccion_obligg").html("");
  }

  if (Telefono.length == 0) {
    $("#telefono_empresa_obligg").html("Ingrese data");
  } else {
    $("#telefono_empresa_obligg").html("");
  }

  if (Ruc.length == 0) {
    $("#ruc_empresa_obligg").html("Ingrese Ruc");
  } else {
    $("#ruc_empresa_obligg").html("");
  }

  if (email.length == 0) {
    $("#empresa_empresa_obligg").html("Ingrese email");
  } else {
    $("#empresa_empresa_obligg").html("");
  }

  if (fecha_fun.length == 0) {
    $("#fecha_empresa_obligg").html("Ingrese fecha");
  } else {
    $("#fecha_empresa_obligg").html("");
  }

  if (lema.length == 0) {
    $("#lema_empresa_obligg").html("Ingrese un lema de la empresa");
  } else {
    $("#lema_empresa_obligg").html("");
  }

  if (Actividad.length == 0) {
    $("#actividad_empresa_obligg").html("Ingrese activdad de la empresa");
  } else {
    $("#actividad_empresa_obligg").html("");
  }
}
