var funcion;
var tabla_tipo, tabla;

$(document).on("click", "#ingresar", function () {
  var usuario = $("#usuario").val();
  var password = $("#password").val();

  if (parseInt(usuario.length) <= 0 || usuario == "") {
    $("#none_pass").hide();
    $("#none_usu").hide();
    $("#error_logeo").hide();
    $("#none_usu").show(2000);
  } else if (parseInt(password.length) <= 0 || password == "") {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#error_logeo").hide();
    $("#none_pass").show(2000);
  } else {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#error_logeo").hide();

    funcion = "logeo";
    $.ajax({
      url: "../ADMIN/controlador/usuarios/usuarios.php",
      type: "POST",
      data: { usuario: usuario, password: password, funcion: funcion },
    }).done(function (responce) {
      if (responce == 0) {
        $("#none_usu").hide();
        $("#none_pass").hide();
        $("#error_logeo").hide();
        $("#error_logeo").show(2000);
        return false;
      } else {
        var data = JSON.parse(responce);
        if (data[0][3] == 0) {
          Swal.fire({
            icon: "error",
            title: "Usuario inactivo",
            text: "El usuario se encuentra inactivo!",
          });
        } else {
          funcion = "session";
          $.ajax({
            url: "../ADMIN/controlador/usuarios/usuarios.php",
            type: "POST",
            data: {
              id_usu: data[0][0],
              rol: data[0][4],
              funcion: funcion,
            },
          }).done(function (res) {
            if (res == 1) {
              let timerInterval;
              Swal.fire({
                title: "Bienvenido al sistema!",
                html: "Usted sera redireccionado en <b></b> mi.",
                allowOutsideClick: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const b = Swal.getHtmlContainer().querySelector("b");
                  timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft();
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                },
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  location.reload();
                }
              });
            }
          });
        }
      }
    });
  }
});

// function regrear_(){
//   $("a").prop("href", "../CARRITO/");
//   // window.href  = "../CARRITO/";
// }

function traer_datos_usuario() {
  funcion = "traer_usuario";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (responce) {
    if (responce != 0) {
      var data = JSON.parse(responce);
      $("#datos_nombres_empleado").html(
        data[0]["nombres"] + " " + data[0]["apellidos"]
      );
      $("#datos_nombres_empleado_dos").html(
        data[0]["nombres"] + " " + data[0]["apellidos"]
      );
      $("#datos_nombres_empleado_tres").html(data[0]["nombres"]);
      $("#tipo_usuario_centrad").html(data[0]["tipo_rol"]);
      $("#foto_user_dos").attr("src", data[0]["foto"]);
      $("#foto_user_uno").attr("src", data[0]["foto"]);
      $("#foto_user_tres").attr("src", data[0]["foto"]);
    }
  });
}

function abrirmodaleditarconta() {
  $("#modal_ediat_contra").modal({ backdrop: "static", keyboard: false });
  $("#modal_ediat_contra").modal("show");
  traer_datos_usuario_perfil();

  $("#email_per").css("border", "1px solid green");
  $("#emailok").html("");
  $("#ocutar_p").show();
}

function traer_datos_usuario_perfil() {
  funcion = "traer_usuario_perfil";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (responce) {
    if (responce != 0) {
      var data = JSON.parse(responce);
      $("#pefil_nombre").val(data[0]["nombres"]);
      $("#ap_pater_perfil").val(data[0]["apellidos"]);
      $("#cedula_per").val(data[0]["cedual"]);
      $("#telefono_per").val(data[0]["telefono"]);
      $("#email_per").val(data[0]["correo"]);
      $("#usuario_per").val(data[0]["usuario"]);
      $("#direcc_domi").val(data[0]["direccion"]);
      $("#sexo_perfil").val(data[0]["sexo"]);
      $("#fotocambio").attr("src", data[0]["foto"]);
      $("#foto_delte").val(data[0]["foto"]);
      $("#txt_contra_bd").val(data[0]["pass"]);
    }
  });
}

function editar_foto() {
  var foto = document.getElementById("foto_perfoil").value;
  var ruta_actual = document.getElementById("foto_delte").value;

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
  var foto = $("#foto_perfoil")[0].files[0];

  //est valores son como los que van en la data del ajax
  funcion = "cambiar_foto_perfil_user";
  formdata.append("funcion", funcion);
  formdata.append("foto", foto);
  formdata.append("ruta_actual", ruta_actual);
  formdata.append("nombrearchivo", nombrearchivo);

  alerta = ["datos", "Se esta editando la foto del perfil", "Editando foto"];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      console.log(resp);

      if (resp > 0) {
        if (resp == 1) {
          document.getElementById("foto_perfoil").value = "";
          traer_datos_usuario();
          traer_datos_usuario_perfil();

          alerta = ["exito", "success", "La foto se edito con exito :)"];
          cerrar_loader_datos(alerta);
        }
      } else {
        alerta = ["error", "error", "La foto no se pudo editar :("];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function editar_contra() {
  var db = document.getElementById("txt_contra_bd").value;
  var actual = document.getElementById("txt_contra1").value;
  var nueva = document.getElementById("txt_contra2").value;
  var repetir = document.getElementById("txt_contra3").value;

  if (
    db.length == 0 ||
    actual.length == 0 ||
    nueva.length == 0 ||
    repetir.length == 0
  ) {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese todo los datos, no debe queda ningun campo vacio",
      "warning"
    );
  }

  if (db != actual) {
    return swal.fire(
      "Mensaje de advertencia",
      "La clave actual es incorrecta",
      "warning"
    );
  }

  if (nueva != repetir) {
    return swal.fire(
      "Mensaje de advertencia",
      "La clave nueva no coincide con la clave repetir",
      "warning"
    );
  }

  funcion = "cambiar_pass";
  alerta = [
    "datos",
    "Se esta modificando el password, por favor espere....",
    ".:Cambiando datos del usuario:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { nueva: nueva, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        traer_datos_usuario();
        traer_datos_usuario_perfil();

        document.getElementById("txt_contra1").value = "";
        document.getElementById("txt_contra2").value = "";
        document.getElementById("txt_contra3").value = "";

        alerta = [
          "exito",
          "success",
          "La clave del usuario se actualizo correctamente :)",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se puede cambiar el password - ERROR EN LA MATRIX :)",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function editar_usuario_perfil() {
  var nomber = document.getElementById("pefil_nombre").value;
  var apellido = document.getElementById("ap_pater_perfil").value;
  var telefono = document.getElementById("telefono_per").value;
  var email = document.getElementById("email_per").value;
  var usuario = document.getElementById("usuario_per").value;
  var sexo = document.getElementById("sexo_perfil").value;
  var direcc_domi = document.getElementById("direcc_domi").value;

  if (
    nomber.length == 0 ||
    apellido.length == 0 ||
    email.length == 0 ||
    telefono.length == 0 ||
    email.length == 0 ||
    usuario.length == 0 ||
    sexo.length == 0 ||
    direcc_domi.length == 0
  ) {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese todo los datos, no debe quedar ningun campo vacio",
      "warning"
    );
  }

  funcion = "cambiar_datos_perfil";
  alerta = [
    "datos",
    "Se esta modificando los datos de perfil, por favor espere....",
    ".:Cambiando datos del usuario:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: {
      funcion: funcion,
      nomber: nomber,
      apellido: apellido,
      telefono: telefono,
      email: email,
      usuario: usuario,
      sexo: sexo,
      direcc_domi: direcc_domi,
    },
  }).done(function (response) {
    console.log(response);

    if (response > 0) {
      if (response == 1) {
        traer_datos_usuario_perfil();
        traer_datos_usuario();
        alerta = [
          "exito",
          "success",
          "Los datos de perfil se actualizo con exito :)",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 10) {
        alerta = [
          "eiste",
          "warning",
          "El correo ingresado '" + email + "' es invalido :(",
        ];
        cerrar_loader_datos(alerta);
      } else {
        alerta = [
          "existe",
          "warning",
          "El usuario " + usuario + " ya se encuentra registrado :(",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo actualizar el registro - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////
//////////////////////////////////
function listar_tipo_usuario() {
  funcion = "listar_tipo_usuario";
  tabla_tipo = $("#tabla_tipo_usuario").DataTable({
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
      url: "../ADMIN/controlador/usuarios/usuarios.php",
      type: "POST",
      data: { funcion: funcion },
    },
    //hay que poner la misma cantidad de columnas y tambien en el html
    columns: [
      { defaultContent: "" },
      { data: "tipo_rol" },
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
    var pageinfo = $("#tabla_tipo_usuario").DataTable().page.info();
    tabla_tipo
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

function abrir_modal() {
  $("#tipo_usuario").val();
  $("#modal_registro_tipo_usuario").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_registro_tipo_usuario").modal("show");
}

function registar_tipo_usuario() {
  var form = document.getElementById("form_tipo_usuario");
  var tipo = document.getElementById("tipo_usuario").value;

  if (tipo.length == 0 || tipo == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un tipo de usuario, no debe queda el campo vacio",
      "warning"
    );
  }

  funcion = "registro_tipo";
  alerta = [
    "datos",
    "Se esta guardando el registro, por favor espere....",
    ".:Guardando tipo de usuario:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { tipo: tipo, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        tabla_tipo.ajax.reload();
        alerta = ["exito", "success", "El registro se guardo con exito :)"];
        cerrar_loader_datos(alerta);
        form.reset();
        $("#modal_registro_tipo_usuario").modal("hide");
      } else {
        alerta = [
          "existe",
          "warning",
          "El tipo de usuario '" + tipo + "' ya se encuentra registrado :(",
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

$("#tabla_tipo_usuario").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo.row(this).data();
  }
  var dato = 0;
  var id = data.id_rol;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo de usuario se cambiara!",
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

$("#tabla_tipo_usuario").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo.row(this).data();
  }
  var dato = 1;
  var id = data.id_rol;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del tipo de usuario se cambiara!",
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

$("#tabla_tipo_usuario").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla_tipo.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla_tipo.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla_tipo.row(this).data();
  }

  $("#id_tipo_user").val(data.id_rol);
  $("#tipo_usuario_edit").val(data.tipo_rol);

  if (data.tipo_rol == "ADMINistrador") {
    $("#editr_tipo_usu").hide();
  } else {
    $("#editr_tipo_usu").show();
  }

  $("#modal_ediatr_tipo_usuario").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_ediatr_tipo_usuario").modal("show");
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
    url: "../ADMIN/controlador/usuarios/usuarios.php",
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

function editar_tipo_usuario() {
  var tipo = document.getElementById("tipo_usuario_edit").value;
  var id = document.getElementById("id_tipo_user").value;

  if (tipo.length == 0 || tipo == "" || id.length == 0 || id == "") {
    return swal.fire(
      "Mensaje de advertencia",
      "Ingrese un dato, no debe queda el campo vacio",
      "warning"
    );
  }

  funcion = "editar_tipo";
  alerta = [
    "datos",
    "Se esta editando el registro, por favor espere....",
    ".:Editando tipo de usuario:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { tipo: tipo, funcion: funcion, id: id },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        tabla_tipo.ajax.reload();
        alerta = ["exito", "success", "El registro se edito con exito :)"];
        cerrar_loader_datos(alerta);
        $("#modal_ediatr_tipo_usuario").modal("hide");
      } else {
        alerta = [
          "existe",
          "warning",
          "El tipo de usuario '" + tipo + "' ya se encuentra registrado :(",
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
function listar_tipo_usuario_x() {
  funcion = "listar_tipo_usuario_x";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);
    var cadena = "<option value=''>--- Ingrese rol de usuario ---</option>";
    if (data.length > 0) {
      //bucle para extraer los datos del rol
      for (var i = 0; i < data.length; i++) {
        cadena +=
          "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
      }
      //aqui concadenamos al id del select
      $("#tipo_usuario_agg").html(cadena);
    } else {
      cadena += "<option value=''>No hay datos</option>";
      $("#tipo_usuario_agg").html(cadena);
    }
  });
}

//////////////
function registrar_usurio() {
  var nombre = document.getElementById("nombres").value;
  var apellidos = document.getElementById("apellidos").value;
  var direccion = document.getElementById("direccion_domicilio").value;
  var telefono = document.getElementById("numero_telefonoo").value;
  var sexo = document.getElementById("sexo").value;
  var cedula = document.getElementById("numero_documento").value;
  var correo = document.getElementById("correo_empleado").value;
  var tipo_usu = document.getElementById("tipo_usuario_agg").value;
  var usuario = document.getElementById("usuario_agg").value;
  var pass = document.getElementById("pasw_agg").value;
  var foto = document.getElementById("foto").value;

  if (
    nombre.length == 0 ||
    apellidos.length == 0 ||
    direccion.length == 0 ||
    telefono.length == 0 ||
    sexo.length == 0 ||
    cedula.length == 0 ||
    correo.length == 0 ||
    tipo_usu.length == 0 ||
    usuario.length == 0 ||
    pass.length == 0
  ) {
    validar_registro(
      nombre,
      apellidos,
      direccion,
      telefono,
      sexo,
      cedula,
      correo,
      tipo_usu,
      usuario,
      pass
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
    $("#sexo_olgigg").html("");
    $("#numero_doc_obliga").html("");
    $("#correo_obliga").html("");
    $("#tipo_usu_obli").html("");
    $("#usu_obli").html("");
    $("#pass_obli").html("");
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

  alerta = [
    "datos",
    "Se esta creando el usuario, por favor espere....",
    ".:Creando usuario usuario:.",
  ];
  mostar_loader_datos(alerta);

  funcion = "registrar_usuario_u";
  formdata.append("funcion", funcion);

  formdata.append("nombre", nombre);
  formdata.append("apellidos", apellidos);
  formdata.append("direccion", direccion);
  formdata.append("telefono", telefono);
  formdata.append("sexo", sexo);
  formdata.append("cedula", cedula);
  formdata.append("correo", correo);
  formdata.append("tipo_usu", tipo_usu);
  formdata.append("usuario", usuario);
  formdata.append("pass", pass);
  formdata.append("foto", foto);
  formdata.append("nombrearchivo", nombrearchivo);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    //aqui envio toda la formdata
    data: formdata,
    contentType: false,
    processData: false,
    success: function (resp) {
      if (resp > 0) {
        registrar_permisos(parseInt(resp));
      } else if (resp == "b") {
        alerta = [
          "existe",
          "warning",
          "El numero de documento '" +
            cedula +
            "' ya esta registrado en el sistemas :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (resp == "c") {
        alerta = [
          "existe",
          "warning",
          "El correo '" + correo + "' ya esta registrado en el sistemas :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (resp == "d") {
        alerta = [
          "existe",
          "error",
          "El correo ingresado '" +
            correo_empleado +
            "' es invalido - ingreso un correo correcto :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (resp == "a") {
        alerta = [
          "error",
          "error",
          "Error al registrar el empleado - FALLO EN LA MATRIX :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (resp == "e") {
        alerta = [
          "existe",
          "warning",
          "El usuario '" + usuario + "', ya existe en el sistema",
        ];
        cerrar_loader_datos(alerta);
      }
    },
  });
  return false;
}

function validar_registro(
  nombre,
  apellidos,
  direccion,
  telefono,
  sexo,
  cedula,
  correo,
  tipo_usu,
  usuario,
  pass
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

  if (telefono.length == 0) {
    $("#telefono_obliga").html("Ingrese telefono");
  } else {
    $("#telefono_obliga").html("");
  }

  if (sexo.length == 0) {
    $("#sexo_olgigg").html("Ingrese sexo");
  } else {
    $("#sexo_olgigg").html("");
  }

  if (cedula.length == 0) {
    $("#numero_doc_obliga").html("Ingrese cedula");
  } else {
    $("#numero_doc_obliga").html("");
  }

  if (correo.length == 0) {
    $("#correo_obliga").html("Ingrese correo");
  } else {
    $("#correo_obliga").html("");
  }

  if (tipo_usu.length == 0) {
    $("#tipo_usu_obli").html("Ingrese tipo de usuario");
  } else {
    $("#tipo_usu_obli").html("");
  }

  if (usuario.length == 0) {
    $("#usu_obli").html("Ingrese usuario");
  } else {
    $("#usu_obli").html("");
  }

  if (pass.length == 0) {
    $("#pass_obli").html("Ingrese password");
  } else {
    $("#pass_obli").html("");
  }
}

function registrar_permisos(id) {
  var id = id;

  var conf = document.getElementById("confi").checked;
  var emples = document.getElementById("emples").checked;
  var asistens = document.getElementById("asistens").checked;
  var mults = document.getElementById("mults").checked;
  var bens = document.getElementById("bens").checked;
  var rols = document.getElementById("rols").checked;
  var prods = document.getElementById("prods").checked;
  var creat_pords = document.getElementById("creat_pords").checked;
  var provees = document.getElementById("provees").checked;
  var comps = document.getElementById("comps").checked;
  var list_comps = document.getElementById("list_comps").checked;
  var ofertas = document.getElementById("ofertas").checked;
  var servs = document.getElementById("servs").checked;
  var creat_cliens = document.getElementById("creat_cliens").checked;
  var crea_vehs = document.getElementById("crea_vehs").checked;
  var vents = document.getElementById("vents").checked;
  var cret_sers = document.getElementById("cret_sers").checked;
  var list_reser = document.getElementById("list_reser").checked;
  var reports = document.getElementById("reports").checked;
  var segurs = document.getElementById("segurs").checked;

  funcion = "crear_permisos";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      conf: conf,
      emples: emples,
      asistens: asistens,
      mults: mults,
      bens: bens,
      rols: rols,
      prods: prods,
      creat_pords: creat_pords,
      provees: provees,
      comps: comps,
      list_comps: list_comps,
      ofertas: ofertas,
      servs: servs,
      creat_cliens: creat_cliens,
      crea_vehs: crea_vehs,
      vents: vents,
      cret_sers: cret_sers,
      list_reser: list_reser,
      reports: reports,
      segurs: segurs,
    },
  }).done(function (response) {
    console.log(response);

    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El usuario se creo con exito :)"];
        cerrar_loader_datos(alerta);
        cargar_contenido(
          "contenido_principal",
          "vista/usuario/registrar_usuario.php"
        );
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo crear los permisos del usuario - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

///////////////////
function listar_usuarios_list() {
  funcion = "listar_usuarios_list";
  tabla = $("#tabla_usuarios").DataTable({
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
      url: "../ADMIN/controlador/usuarios/usuarios.php",
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
            return `<button style='font-size:13px;' type='button' class='inactivar btn btn-danger' title='Inactivar el empleado'><i class='fa fa-times'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el empleado'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='llave btn btn-warning' title='Editar los permisos de usuario'><i class='fa fa-key'></i></button>`;
          } else {
            return `<button style='font-size:13px;' type='button' class='activar btn btn-success' title='Activar el empleado'><i class='fa fa-check'></i></button> - <button style='font-size:13px;' type='button' class='editar btn btn-primary' title='Editar el empleado'><i class='fa fa-edit'></i></button> - <button style='font-size:13px;' type='button' class='llave btn btn-warning' title='Editar los permisos de usuario'><i class='fa fa-key'></i></button>`;
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
      { data: "usuario" },
      { data: "tipo_rol" },
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
      { data: "nombres" },
      { data: "sexo" },
      { data: "telefono" },
      { data: "direccion" },
      { data: "correo" },
      { data: "cedual" },
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
    order: [[0, "asc"]],
  });

  //esto es para crearn un contador para la tabla este contador es automatico
  tabla.on("draw.dt", function () {
    var pageinfo = $("#tabla_usuarios").DataTable().page.info();
    tabla
      .column(0, { page: "current" })
      .nodes()
      .each(function (cell, i) {
        cell.innerHTML = i + 1 + pageinfo.start;
      });
  });
}

$("#tabla_usuarios").on("click", ".inactivar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }
  var dato = 0;
  var id = data.id_usuario;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del usuario se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

$("#tabla_usuarios").on("click", ".activar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }
  var dato = 1;
  var id = data.id_usuario;

  Swal.fire({
    title: "Cambiar estado?",
    text: "El estado del usuario se cambiara!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, cambiar!",
  }).then((result) => {
    if (result.isConfirmed) {
      cambiar_estado_usuario(id, dato);
    }
  });
});

function cambiar_estado_usuario(id, dato) {
  var res = "";

  if (dato == 1) {
    res = "activo";
  } else {
    res = "inactivo";
  }

  funcion = "estado_usuario";
  alerta = [
    "datos",
    "Se esta cambiando el estado a " + res + ", por favor espere....",
    ".:Cambiando estado:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { id: id, dato: dato, funcion: funcion },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "EL estado se " + res + " con extio :)"];
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

////////////
$("#tabla_usuarios").on("click", ".editar", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }

  $("#id_usuario").val(data.id_usuario);
  $("#nombres").val(data.nombres);
  $("#apellidos").val(data.apellidos);
  $("#direccion_domicilio").val(data.direccion);
  $("#numero_telefonoo").val(data.telefono);
  $("#sexo").val(data.sexo);
  $("#numero_documento").val(data.cedual);
  $("#correo_empleado").val(data.correo);
  $("#tipo_usuario_agg").val(data.id_rol).trigger("change");
  $("#usuario_agg").val(data.usuario);
  $("#pasw_agg").val(data.pass);

  $("#nombre_obliga").html("");
  $("#app_pat_obliga").html("");
  $("#direccion_obliga").html("");
  $("#telefono_obliga").html("");
  $("#sexo_olgigg").html("");
  $("#numero_doc_obliga").html("");
  $("#correo_obliga").html("");
  $("#tipo_usu_obli").html("");
  $("#usu_obli").html("");
  $("#pass_obli").html("");

  $("#correo_empleado").css("border", "1px solid green");
  $("#email_correcto").html("");

  $("#numero_documento").css("border", "1px solid green");
  $("#cedula_empleado").html("");

  $("#modal_editar_usuario").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modal_editar_usuario").modal("show");
});

function editar_usuario() {
  var id = document.getElementById("id_usuario").value;
  var nombre = document.getElementById("nombres").value;
  var apellidos = document.getElementById("apellidos").value;
  var direccion = document.getElementById("direccion_domicilio").value;
  var telefono = document.getElementById("numero_telefonoo").value;
  var sexo = document.getElementById("sexo").value;
  var cedula = document.getElementById("numero_documento").value;
  var correo = document.getElementById("correo_empleado").value;
  var tipo_usu = document.getElementById("tipo_usuario_agg").value;
  var usuario = document.getElementById("usuario_agg").value;
  var pass = document.getElementById("pasw_agg").value;

  if (
    nombre.length == 0 ||
    apellidos.length == 0 ||
    direccion.length == 0 ||
    telefono.length == 0 ||
    sexo.length == 0 ||
    cedula.length == 0 ||
    correo.length == 0 ||
    tipo_usu.length == 0 ||
    usuario.length == 0 ||
    pass.length == 0
  ) {
    validar_registro_edit(
      nombre,
      apellidos,
      direccion,
      telefono,
      sexo,
      cedula,
      correo,
      tipo_usu,
      usuario,
      pass
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
    $("#sexo_olgigg").html("");
    $("#numero_doc_obliga").html("");
    $("#correo_obliga").html("");
    $("#tipo_usu_obli").html("");
    $("#usu_obli").html("");
  }

  funcion = "editar_usuariosss";
  alerta = [
    "cambio_datos",
    "Se esta editando el usuario, por favor espere....",
    ".:Editando usuario:.",
  ];
  mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
      nombre: nombre,
      apellidos: apellidos,
      direccion: direccion,
      telefono: telefono,
      sexo: sexo,
      cedula: cedula,
      correo: correo,
      tipo_usu: tipo_usu,
      usuario: usuario,
      pass: pass,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        alerta = ["exito", "success", "El usuario se edito correctamente :)"];
        cerrar_loader_datos(alerta);
        tabla.ajax.reload();
        $("#modal_editar_usuario").modal("hide");
      }
    } else if (response == "b") {
      alerta = [
        "existe",
        "warning",
        "El numero de documento '" +
          cedula +
          "' ya esta registrado en el sistemas :(",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "c") {
      alerta = [
        "existe",
        "warning",
        "El correo '" + correo + "' ya esta registrado en el sistemas :(",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "a") {
      alerta = [
        "error",
        "error",
        "Error al registrar el empleado - FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "e") {
      alerta = [
        "existe",
        "warning",
        "El usuario '" + usuario + "', ya existe en el sistema",
      ];
      cerrar_loader_datos(alerta);
    }

    // if (response > 0) {
    //   if (response == 3) {
    //     alerta = [
    //       "existe",
    //       "warning",
    //       "El usuario '" + usuario_agg + "' ya existe en el sistema :(",
    //     ];
    //     cerrar_loader_datos(alerta);
    //   } else if (response == 2) {
    //     alerta = [
    //       "existe",
    //       "warning",
    //       "El empleado " +
    //         emplado_agg +
    //         " con el tipo " +
    //         tipo_usuario_agg +
    //         " ya se encuentra registrado :(",
    //     ];
    //     cerrar_loader_datos(alerta);
    //   } else {
    //     alerta = ["exito", "success", "El usuario se edito correctamente :)"];
    //     cerrar_loader_datos(alerta);
    //     tabla.ajax.reload();
    //     $("#modal_editar_usuario").modal("hide");
    //   }
    // } else {
    //   alerta = [
    //     "error",
    //     "error",
    //     "No se pudo editar el usuario - FALLO EN LA MATRIX:(",
    //   ];
    //   cerrar_loader_datos(alerta);
    // }
  });
}

function validar_registro_edit(
  nombre,
  apellidos,
  direccion,
  telefono,
  sexo,
  cedula,
  correo,
  tipo_usu,
  usuario,
  pass
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

  if (telefono.length == 0) {
    $("#telefono_obliga").html("Ingrese telefono");
  } else {
    $("#telefono_obliga").html("");
  }

  if (sexo.length == 0) {
    $("#sexo_olgigg").html("Ingrese sexo");
  } else {
    $("#sexo_olgigg").html("");
  }

  if (cedula.length == 0) {
    $("#numero_doc_obliga").html("Ingrese cedula");
  } else {
    $("#numero_doc_obliga").html("");
  }

  if (correo.length == 0) {
    $("#correo_obliga").html("Ingrese correo");
  } else {
    $("#correo_obliga").html("");
  }

  if (tipo_usu.length == 0) {
    $("#tipo_usu_obli").html("Ingrese tipo de usuario");
  } else {
    $("#tipo_usu_obli").html("");
  }

  if (usuario.length == 0) {
    $("#usu_obli").html("Ingrese usuario");
  } else {
    $("#usu_obli").html("");
  }

  if (pass.length == 0) {
    $("#pass_obli").html("Ingrese password");
  } else {
    $("#pass_obli").html("");
  }
}

$("#tabla_usuarios").on("click", ".llave", function () {
  //esto esta extrayendo los datos de la tabla el (data)
  var data = tabla.row($(this).parents("tr")).data(); //a que fila deteta que doy click
  //esta condicion es importante para el responsibe porque salda un error si no lo pongo
  if (tabla.row(this).child.isShown()) {
    //esto es cuando esta en tamaño responsibo
    var data = tabla.row(this).data();
  }

  var id = data.id_usuario;

  alerta = [
    "cambio_datos",
    "Se estan obteniendo los permisos actuales del usuario, por favor espere....",
    ".:Obteniendo permisos de usuario:.",
  ];
  mostar_loader_datos(alerta);
  obtener_permisos(parseInt(id));
});

function obtener_permisos(id) {
  funcion = "obtener_permisos";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { funcion: funcion, id: id },
  }).done(function (response) {
    var data = JSON.parse(response);

    $("#id_usu").val(id);
    $("#id_permiso").val(data[0]["permido_id"]);

    data[0]["configuracion"].toString() == "true"
      ? ($("#confi")[0].checked = true)
      : $("#confi").removeAttr("checked");

    data[0]["emples"].toString() == "true"
      ? ($("#emples")[0].checked = true)
      : $("#emples").removeAttr("checked");

    data[0]["asistens"].toString() == "true"
      ? ($("#asistens")[0].checked = true)
      : $("#asistens").removeAttr("checked");

    data[0]["mults"].toString() == "true"
      ? ($("#mults")[0].checked = true)
      : $("#mults").removeAttr("checked");

    data[0]["bens"].toString() == "true"
      ? ($("#bens")[0].checked = true)
      : $("#bens").removeAttr("checked");

    data[0]["rols"].toString() == "true"
      ? ($("#rols")[0].checked = true)
      : $("#rols").removeAttr("checked");

    data[0]["prods"].toString() == "true"
      ? ($("#prods")[0].checked = true)
      : $("#prods").removeAttr("checked");

    data[0]["creat_pords"].toString() == "true"
      ? ($("#creat_pords")[0].checked = true)
      : $("#creat_pords").removeAttr("checked");

    data[0]["provees"].toString() == "true"
      ? ($("#provees")[0].checked = true)
      : $("#provees").removeAttr("checked");

    data[0]["comps"].toString() == "true"
      ? ($("#comps")[0].checked = true)
      : $("#comps").removeAttr("checked");

    data[0]["list_comps"].toString() == "true"
      ? ($("#list_comps")[0].checked = true)
      : $("#list_comps").removeAttr("checked");

    data[0]["ofertas"].toString() == "true"
      ? ($("#ofertas")[0].checked = true)
      : $("#ofertas").removeAttr("checked");

    data[0]["servs"].toString() == "true"
      ? ($("#servs")[0].checked = true)
      : $("#servs").removeAttr("checked");

    data[0]["creat_cliens"].toString() == "true"
      ? ($("#creat_cliens")[0].checked = true)
      : $("#creat_cliens").removeAttr("checked");

    data[0]["crea_vehs"].toString() == "true"
      ? ($("#crea_vehs")[0].checked = true)
      : $("#crea_vehs").removeAttr("checked");

    data[0]["vents"].toString() == "true"
      ? ($("#vents")[0].checked = true)
      : $("#vents").removeAttr("checked");

    data[0]["cret_sers"].toString() == "true"
      ? ($("#cret_sers")[0].checked = true)
      : $("#cret_sers").removeAttr("checked");

    data[0]["list_reser"].toString() == "true"
      ? ($("#list_reser")[0].checked = true)
      : $("#list_reser").removeAttr("checked");

    data[0]["reports"].toString() == "true"
      ? ($("#reports")[0].checked = true)
      : $("#reports").removeAttr("checked");

    data[0]["segurs"].toString() == "true"
      ? ($("#segurs")[0].checked = true)
      : $("#segurs").removeAttr("checked");

    alerta = ["none", "", ""];
    cerrar_loader_datos(alerta);
    $("#modal_editar_permisos").modal({
      backdrop: "static",
      keyboard: false,
    });
    $("#modal_editar_permisos").modal("show");
  });
}

function editar_permisos_usuario() {
  var id_permis = document.getElementById("id_permiso").value;
  var id_usu = document.getElementById("id_usu").value;
  var conf = document.getElementById("confi").checked;

  var emples = document.getElementById("emples").checked;
  var asistens = document.getElementById("asistens").checked;
  var mults = document.getElementById("mults").checked;
  var bens = document.getElementById("bens").checked;
  var rols = document.getElementById("rols").checked;
  var prods = document.getElementById("prods").checked;
  var creat_pords = document.getElementById("creat_pords").checked;
  var provees = document.getElementById("provees").checked;
  var comps = document.getElementById("comps").checked;
  var list_comps = document.getElementById("list_comps").checked;
  var ofertas = document.getElementById("ofertas").checked;
  var servs = document.getElementById("servs").checked;
  var creat_cliens = document.getElementById("creat_cliens").checked;
  var crea_vehs = document.getElementById("crea_vehs").checked;
  var vents = document.getElementById("vents").checked;
  var cret_sers = document.getElementById("cret_sers").checked;
  var list_reser = document.getElementById("list_reser").checked;
  var reports = document.getElementById("reports").checked;
  var segurs = document.getElementById("segurs").checked;

  funcion = "editar_permisos";
  alerta = [
    "cambio_datos",
    "Se esta cambiano los permisos del usuario, por favor espere....",
    ".:Cambiando permisos usuario:.",
  ];
  mostar_loader_datos(alerta);
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: {
      funcion: funcion,
      id_permis: id_permis,
      id_usu: id_usu,
      conf: conf,
      emples: emples,
      asistens: asistens,
      mults: mults,
      bens: bens,
      rols: rols,
      prods: prods,
      creat_pords: creat_pords,
      provees: provees,
      comps: comps,
      list_comps: list_comps,
      ofertas: ofertas,
      servs: servs,
      creat_cliens: creat_cliens,
      crea_vehs: crea_vehs,
      vents: vents,
      cret_sers: cret_sers,
      list_reser: list_reser,
      reports: reports,
      segurs: segurs,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        tabla.ajax.reload();
        alerta = [
          "existe",
          "success",
          "Los permisos del usuario se editaron correctamente :)",
        ];
        cerrar_loader_datos(alerta);
        $("#modal_editar_permisos").modal("hide");
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo editar los permisos del usuario - FALLO EN LA MATRIX:(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

//////////////
/////////// traer datos de accesos de usuario
function traer_datos_permisos_usuario() {
  funcion = "obtener_permisos_usuario_logeado";
  $.ajax({
    url: "../ADMIN/controlador/usuarios/usuarios.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    var data = JSON.parse(response);

    data[0]["configuracion"].toString() == "true"
      ? $("#permiso_config").css("display", "block")
      : $("#permiso_config").css("display", "none");

    data[0]["emples"].toString() == "true"
      ? $("#permiso_emples").css("display", "block")
      : $("#permiso_emples").css("display", "none");

    data[0]["asistens"].toString() == "true"
      ? $("#permiso_asistens").css("display", "block")
      : $("#permiso_asistens").css("display", "none");

    data[0]["mults"].toString() == "true"
      ? $("#permiso_mults").css("display", "block")
      : $("#permiso_mults").css("display", "none");

    data[0]["bens"].toString() == "true"
      ? $("#permiso_bens").css("display", "block")
      : $("#permiso_bens").css("display", "none");

    data[0]["rols"].toString() == "true"
      ? $("#permiso_rols").css("display", "block")
      : $("#permiso_rols").css("display", "none");

    data[0]["prods"].toString() == "true"
      ? $("#permiso_prods").css("display", "block")
      : $("#permiso_prods").css("display", "none");

    data[0]["creat_pords"].toString() == "true"
      ? $("#permiso_creat_pords").css("display", "block")
      : $("#permiso_creat_pords").css("display", "none");

    data[0]["provees"].toString() == "true"
      ? $("#permiso_provees").css("display", "block")
      : $("#permiso_provees").css("display", "none");

    data[0]["comps"].toString() == "true"
      ? $("#permiso_comps").css("display", "block")
      : $("#permiso_comps").css("display", "none");

    data[0]["list_comps"].toString() == "true"
      ? $("#permiso_list_comps").css("display", "block")
      : $("#permiso_list_comps").css("display", "none");

    data[0]["ofertas"].toString() == "true"
      ? $("#permiso_ofertas").css("display", "block")
      : $("#permiso_ofertas").css("display", "none");

    data[0]["servs"].toString() == "true"
      ? $("#permiso_servs").css("display", "block")
      : $("#permiso_servs").css("display", "none");

    data[0]["creat_cliens"].toString() == "true"
      ? $("#permiso_creat_cliens").css("display", "block")
      : $("#permiso_creat_cliens").css("display", "none");

    data[0]["crea_vehs"].toString() == "true"
      ? $("#permiso_crea_vehs").css("display", "block")
      : $("#permiso_crea_vehs").css("display", "none");

    data[0]["vents"].toString() == "true"
      ? $("#permiso_vents").css("display", "block")
      : $("#permiso_vents").css("display", "none");

    data[0]["cret_sers"].toString() == "true"
      ? $("#permiso_cret_sers").css("display", "block")
      : $("#permiso_cret_sers").css("display", "none");

    data[0]["list_reser"].toString() == "true"
      ? $("#permiso_list_reser").css("display", "block")
      : $("#permiso_list_reser").css("display", "none");

    data[0]["reports"].toString() == "true"
      ? $("#permiso_reports").css("display", "block")
      : $("#permiso_reports").css("display", "none");

    data[0]["segurs"].toString() == "true"
      ? $("#permiso_segurs").css("display", "block")
      : $("#permiso_segurs").css("display", "none");
  });
}
