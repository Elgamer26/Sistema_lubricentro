//////////////////////
$(document).on("click", "#login_ingreso_cli", function () {
  var email = $("#login_email").val();
  var cedula = $("#login_ci").val();

  if (parseInt(email.length) <= 0 || email == "") {
    $("#none_pass").hide();
    $("#none_usu").hide();
    $("#error_logeo").hide();
    $("#none_usu").show(2000);
  } else if (parseInt(cedula.length) <= 0 || cedula == "") {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#error_logeo").hide();
    $("#none_pass").show(2000);
  } else {
    $("#none_usu").hide();
    $("#none_pass").hide();
    $("#error_logeo").hide();

    funcion = "logeo_cliente";
    $.ajax({
      url: "../ADMIN/controlador/carrito/carrito.php",
      type: "POST",
      data: { email: email, cedula: cedula, funcion: funcion },
    }).done(function (responce) {
      if (responce == 0) {
        $("#none_usu").hide();
        $("#none_pass").hide();
        $("#error_logeo").hide();
        $("#error_logeo").show(2000);
        return false;
      } else {
        var data = JSON.parse(responce);
        if (data[0][5] == 0) {
          Swal.fire({
            icon: "error",
            title: "Usuario inactivo",
            text: "El usuario se encuentra inactivo!",
          });
        } else {
          funcion = "session_cli";
          $.ajax({
            url: "../ADMIN/controlador/carrito/carrito.php",
            type: "POST",
            data: {
              id_cli: data[0][0],
              nombre_cli: data[0][1],
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

//////////////////////// productos
$(document).on("keyup", "#busqueda_pro", function () {
  let valor = $(this).val();
  if (valor != "" || valor != null || valor.length > 0) {
    pagination(1, valor);
  } else {
    pagination(1);
  }
});

function pagination(partida, valor) {
  funcion = "paguinar_prod_car";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      partida: partida,
      funcion: funcion,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_prod").html(array[0]);
      $("#unir_paguinador").html(array[1]);
    } else {
      $("#unir_prod").html(
        "<div class='col-lg-12' style='text-align: center; justify-content: center; align-items: center'><br>" +
          "<label style='font-size: 20px;'></i>.:No se encontro producto '" +
          valor +
          "':.<label>" +
          "</div>"
      );
      $("#unir_paguinador").html("");
    }
  });
}

//////////ofertas
$(document).on("keyup", "#busqueda_pro_oferta", function () {
  let valor = $(this).val();
  if (valor != "" || valor != null || valor.length > 0) {
    pagination_ofertas(1, valor);
  } else {
    pagination_ofertas(1);
  }
});

function pagination_ofertas(partida, valor) {
  funcion = "pagination_ofertas";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      partida: partida,
      funcion: funcion,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_prod_oferta").html(array[0]);
      $("#unir_paguinador_oferta").html(array[1]);
    } else {
      $("#unir_prod_oferta").html(
        "<div class='col-lg-12' style='text-align: center; justify-content: center; align-items: center'><br>" +
          "<label style='font-size: 20px;'></i>.:No se encontro producto '" +
          valor +
          "':.<label>" +
          "</div>"
      );
      $("#unir_paguinador_oferta").html("");
    }
  });
}

///////////////////SERICIOS
$(document).on("keyup", "#busqueda_servicios", function () {
  let valor = $(this).val();
  if (valor != "" || valor != null || valor.length > 0) {
    pagination_servicios(1, valor);
  } else {
    pagination_servicios(1);
  }
});

function pagination_servicios(partida, valor) {
  funcion = "pagination_servicios";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      partida: partida,
      funcion: funcion,
      valor: valor,
    },
  }).done(function (response) {
    var array = eval(response);
    if (array[0]) {
      $("#unir_servicios").html(array[0]);
      $("#unir_paguinador_servicios").html(array[1]);
    } else {
      $("#unir_servicios").html(
        "<div class='col-lg-12' style='text-align: center; justify-content: center; align-items: center'><br>" +
          "<label style='font-size: 20px;'></i>.:No se encontro servicio '" +
          valor +
          "':.<label>" +
          "</div>"
      );
      $("#unir_paguinador_servicios").html("");
    }
  });
}

function agg_carrito(id) {
  funcion = "agg_carrito";

  // alerta = [
  //   "datos",
  //   "Agregando producto al carrito, por favor espere....",
  //   ".:Agregando producto:.",
  // ];
  // mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (response) {
    mostrar_tu_carrito();

    if (response == "100") {
      alerta = [
        "existe",
        "warning",
        "Para poder agregar el producto al carrito debe inicar sesion :(",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "1") {
      alerta = [
        "exito",
        "success",
        "El producto se agregó al carrito con exito :)",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "2") {
      alerta = [
        "exito",
        "success",
        "El producto ya esta registrado en el carrito, SE AUMENTO LA CANTIDAD :)",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "3" || response == "0") {
      alerta = [
        "error",
        "error",
        "No se pudo agregar el producto al carrito, FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    } else {
      alerta = [
        "existe",
        "warning",
        "No hay stock suficiente para la cantidad ingresada, " +
          response +
          "  :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function agg_carrito_oferta(id) {
  funcion = "agregar_carrito_oferta";

  // alerta = [
  //   "datos",
  //   "Agregando producto en oferta al carrito, por favor espere....",
  //   ".:Agregando producto:.",
  // ];
  // mostar_loader_datos(alerta);

  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (response) {
    mostrar_tu_carrito();

    if (response == "100") {
      alerta = [
        "existe",
        "warning",
        "Para poder agregar el producto al carrito debe inicar sesion :(",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "1") {
      alerta = [
        "exito",
        "success",
        "El producto se agregó al carrito con exito :)",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "2") {
      alerta = [
        "exito",
        "success",
        "El producto ya esta registrado en el carrito, SE AUMENTO LA CANTIDAD :)",
      ];
      cerrar_loader_datos(alerta);
    } else if (response == "3" || response == "0") {
      alerta = [
        "error",
        "error",
        "No se pudo agregar el producto al carrito, FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    } else {
      alerta = [
        "existe",
        "warning",
        "No hay stock suficiente para la cantidad ingresada, " +
          response +
          "  :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

function mostrar_tu_carrito() {
  funcion = "mostrar_tu_carrito";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    if (response != 100) {
      var data = JSON.parse(response);
      if (data) {
        $("#cantidad_carrito").html("");
        $("#cantidad_carrito").html(data[0][0]);
      } else {
        $("#cantidad_carrito").html(0);
      }
    } else {
      $("#cantidad_carrito").html(0);
    }
  });
}

function vaciar_carrito() {
  Swal.fire({
    title: "Vaciar carrito?",
    text: "El carrito e vaciara por completo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, vaciar!",
  }).then((result) => {
    if (result.isConfirmed) {
      funcion = "vaciar_carrito";
      $.ajax({
        url: "../ADMIN/controlador/carrito/carrito.php",
        type: "POST",
        data: { funcion: funcion },
      }).done(function (response) {
        mostrar_carrito_compra_detalle();
        mostrar_tu_carrito();

        if (response == "100") {
          alerta = [
            "existe",
            "warning",
            "Para poder agregar el producto al carrito debe inicar sesion :(",
          ];
          cerrar_loader_datos(alerta);
        } else if (response == "1") {
          alerta = ["exito", "success", "El carrito se vacio con exito"];
          cerrar_loader_datos(alerta);
        } else {
          alerta = ["error", "error", "Error al vaciar el carrito"];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
}

//////////////////////////
function mostrar_carrito_compra_detalle() {
  funcion = "mostrar_carrito_compra_detalle";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    if (response != 100) {
      var array = eval(response);
      var sub = parseFloat(array[1]).toFixed(2);
      var iva = parseFloat(array[2]).toFixed(2);
      var grantotal = parseFloat(array[3]).toFixed(2);

      if (array[0]) {
        $("#unnir_tabla_detalle").html(array[0]);
        $("#unir_subtotal").html("$. " + sub);
        $("#unir_iva_tot").html("$. " + iva);
        $("#unir_gran_total").html("$. " + grantotal);

        $("#txt_unir_subtotal").val(sub);
        $("#txt_unir_iva_tot").val(iva);
        $("#txt_unir_gran_total").val(grantotal);

        $("#detalle_pagos").css("display", "block");

        // $('#sub_total_compra').val(sub);
        // $('#iva_cmpra').val(iva);
        // $("#total_compra").val(grantotal);

        // $("#ver_botones").css("display", "block");
        // $('#botn_vaciar_car').show();
      } else {
        $("#unnir_tabla_detalle").html("");
        $("#unir_subtotal").html("");
        $("#unir_iva_tot").html("");
        $("#unir_gran_total").html("");

        $("#txt_unir_subtotal").val("0");
        $("#txt_unir_iva_tot").val("0");
        $("#txt_unir_gran_total").val("0");

        $("#detalle_pagos").css("display", "none");

        // $('#sub_total_compra').val("0");
        // $('#iva_cmpra').val("0");
        // $("#total_compra").val("0");

        // $("#ver_botones").css("display", "none");
        // $('#botn_vaciar_car').hide();
        // $("#pago_ceparado").css("display", "none");
        // $(".pago_payal").css("display", "none");
      }
    } else {
      $("#unnir_tabla_detalle").html("");
      $("#unir_subtotal").html("");
      $("#unir_iva_tot").html("");
      $("#unir_gran_total").html("");

      $("#txt_unir_subtotal").val("0");
      $("#txt_unir_iva_tot").val("0");
      $("#txt_unir_gran_total").val("0");

      $("#detalle_pagos").css("display", "none");

      // $('#sub_total_compra').val("");
      // $('#iva_cmpra').val("");
      // $("#total_compra").val("");

      // $("#ver_botones").css("display", "none");
      // $('#botn_vaciar_car').hide();
      // $("#pago_ceparado").css("display", "none");
      // $(".pago_payal").css("display", "none");
    }
  });
}

function mostrar_carrito_servicios() {
  funcion = "mostrar_carrito_servicios";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: { funcion: funcion },
  }).done(function (response) {
    if (response != 100) {
      var array = eval(response);
      var sub = parseFloat(array[1]).toFixed(2);
      var count = 0;

      if (array[0]) {
        $("#unir_tabla_detalle_servicios").html(array[0]);
        $("#unir_total_servicio").html("$. " + sub);
        $("#txt_total_servicio").val(sub);

        $("#id_servicios_detalle").css("display", "block");
        $("#btn_reerva_verifi").css("display", "block");

        $("#table_servi_clie tbody#unir_tabla_detalle_servicios tr").each(
          function () {
            count++;
          }
        );

        if (count == 0) {
          $("#pasarela_producto").css("display", "block");
          $("#pasarela_servicio").css("display", "none");
        } else {
          $("#pasarela_producto").css("display", "none");
          $("#pasarela_servicio").css("display", "block");
        }
      } else {
        $("#unir_tabla_detalle_servicios").html("");
        $("#unir_total_servicio").html("");
        $("#txt_total_servicio").val("");
        $("#id_servicios_detalle").css("display", "none");
        $("#btn_reerva_verifi").css("display", "none");

        $("#table_servi_clie tbody#unir_tabla_detalle_servicios tr").each(
          function () {
            count++;
          }
        );

        if (count == 0) {
          $("#pasarela_producto").css("display", "block");
          $("#pasarela_servicio").css("display", "none");
        } else {
          $("#pasarela_producto").css("display", "none");
          $("#pasarela_servicio").css("display", "block");
        }
      }
    } else {
      $("#unir_tabla_detalle_servicios").html("");
      $("#unir_total_servicio").html("");
      $("#txt_total_servicio").val("");
      $("#id_servicios_detalle").css("display", "none");
      $("#btn_reerva_verifi").css("display", "none");

      $("#table_servi_clie tbody#unir_tabla_detalle_servicios tr").each(
        function () {
          count++;
        }
      );

      if (count == 0) {
        $("#pasarela_producto").css("display", "block");
        $("#pasarela_servicio").css("display", "none");
      } else {
        $("#pasarela_producto").css("display", "none");
        $("#pasarela_servicio").css("display", "block");
      }
    }
  });
}

function quitar_producto_detalle(id_cli, id_pro) {
  Swal.fire({
    title: "Quitar producto?",
    text: "El producto se quitara del detalle!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, quitar!",
  }).then((result) => {
    if (result.isConfirmed) {
      funcion = "quitar_producto_detalle";

      $.ajax({
        url: "../ADMIN/controlador/carrito/carrito.php",
        type: "POST",
        data: {
          funcion: funcion,
          id_cli: id_cli,
          id_pro: id_pro,
        },
      }).done(function (response) {
        if (response == 1) {
          mostrar_carrito_compra_detalle();
          mostrar_tu_carrito();
        } else {
          alerta = [
            "error",
            "error",
            "No se puedo quitar el producto, error en la matrix",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
}

function quitar_servicio_detalle(id_cli, id_serv) {
  Swal.fire({
    title: "Quitar servicio?",
    text: "El servicio se quitara del detalle!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, quitar!",
  }).then((result) => {
    if (result.isConfirmed) {
      funcion = "quitar_servicio_detalle";

      $.ajax({
        url: "../ADMIN/controlador/carrito/carrito.php",
        type: "POST",
        data: {
          funcion: funcion,
          id_cli: id_cli,
          id_serv: id_serv,
        },
      }).done(function (response) {
        if (response == 1) {
          mostrar_carrito_servicios();
        } else {
          alerta = [
            "error",
            "error",
            "No se puedo quitar el servicio, error en la matrix",
          ];
          cerrar_loader_datos(alerta);
        }
      });
    }
  });
}

function aumen_cantidad_prod(id_cli, id_pro, cantidad) {
  idcli = id_cli;
  idpro = id_pro;
  cant = parseInt(cantidad + 1);
  cantidad_producto(idcli, idpro, cant);
}

function dismi_cantidad_prod(id_cli, id_pro, cantidad) {
  idcli = id_cli;
  idpro = id_pro;
  cant = parseInt(cantidad - 1);
  cantidad_producto(idcli, idpro, cant);
}

function cantidad_producto(idcli, idpro, cant) {
  funcion = "cantidad_producto_carrito";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: { funcion: funcion, idcli: idcli, idpro: idpro, cant: cant },
  }).done(function (response) {
    if (response > 0) {
      if (response == 1) {
        mostrar_carrito_compra_detalle();
      }
    } else if (response == 0) {
      alert("No se pudo aumentar el producto - ERROR MATRIX :(");
    } else {
      alerta = [
        "datos",
        "warning",
        "La cantidad ingresada, supera el stock '" +
          response +
          "', del producto :(",
      ];
      cerrar_loader_datos(alerta);
      Swal.fire(
        "Stock no disponible",
        "La cantidad ingresada esta al limite del '" +
          response +
          "', del producto :(",
        "warning"
      );
    }
  });
}

function agg_carrito_servicios(id) {
  funcion = "agg_carrito_servicios";

  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      funcion: funcion,
      id: id,
    },
  }).done(function (response) {
    if (response > 0) {
      if (response == 100) {
        alerta = [
          "existe",
          "warning",
          "Para poder agregar el servicio al carrito debe inicar sesion :(",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 1) {
        alerta = [
          "exito",
          "success",
          "El servicio se agregó al carrito con exito :)",
        ];
        cerrar_loader_datos(alerta);
      } else if (response == 2) {
        alerta = [
          "existe",
          "warning",
          "El servicio ya esta registrado en el carrito",
        ];
        cerrar_loader_datos(alerta);
      }
    } else {
      alerta = [
        "error",
        "error",
        "No se pudo agregar el servicio al carrito, FALLO EN LA MATRIX :(",
      ];
      cerrar_loader_datos(alerta);
    }
  });
}

//////////////////////////////////////
////////////////////////////////////////
function realizar_reservar_cliente() {
  var fecha = $("#fecha_pac").val();
  var fecha_inicio = $("#fecha_pac").val() + " " + $("#hora_enevto").val();
  var hora = $("#hora_enevto").val();
  var asunto = $("#asunto").val();
  var nota = $("#nota").val();
  var vehiculo = $("#vechouclo_select").val();

  if (asunto.length == 0 || nota.length == 0 || vehiculo.length == 0) {
    validar_registro(vehiculo, asunto, nota);
    return swal.fire(
      "Mensaje de advertencia",
      "No debe dejar ningun campo vacio, por favor ingrese todos los datos completo",
      "warning"
    );
  } else {
    $("#vechouclo_select_obligg").html("");
    $("#asunto_obligg").html("");
    $("#nota_obligg").html("");
  }

  ///////////////////
  alerta = [
    "datos",
    "Procesando servicio, por favor espere....",
    ".:Procesando servicio:.",
  ];

  mostar_loader_datos(alerta);
  funcion = "realizar_reservar_cliente";
  $.ajax({
    url: "../ADMIN/controlador/carrito/carrito.php",
    type: "POST",
    data: {
      funcion: funcion,
      fecha: fecha,
      fecha_inicio: fecha_inicio,
      hora: hora,
      asunto: asunto,
      nota: nota,
      vehiculo: vehiculo,
    },
  }).done(function (response) {
    alerta = ["", "", ""];
    cerrar_loader_datos(alerta);

    if (response > 0) {
      if (response == 1) {
        $("#btb_btn_paypa").css("display", "block");
        $("#btn_reerva_verifi").css("display", "none");

        $("#fecha_pac").attr("readonly", true);
        $("#hora_enevto").attr("readonly", true);

        return swal.fire(
          "Mensaje de exito",
          "Verificación exitosa, ingrese pago para finalizar la reserva",
          "success"
        );
      } else if (response == 2) {
        return swal.fire(
          "Mensaje de advertencia",
          "Ya tiene una cita agendada en esta fecha '" + fecha + "'",
          "warning"
        );
      } else if (response == 3) {
        return swal.fire(
          "Mensaje de advertencia",
          "La hora de reserva '" + hora + "' no esta disponible por ahora ",
          "warning"
        );
      } else if (response == 4) {
        return swal.fire(
          "Mensaje de advertencia",
          "Ya tiene una reserva pendiente, no puede separar mas reservas",
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
    } else {
      Swal.fire(
        "Mensaje de error",
        "No se pudo guardar la reserva - FALLO EN LA MATRIX :(",
        "error"
      );
    }
  });
}

/// validacion
function validar_registro(vehiculo, asunto, nota) {
  if (vehiculo.length == 0) {
    $("#vechouclo_select_obligg").html("Ingrese vehiculo");
  } else {
    $("#vechouclo_select_obligg").html("");
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
