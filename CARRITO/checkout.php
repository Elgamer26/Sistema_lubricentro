<?php require 'layout/header.php'; ?>

<script src="https://www.paypal.com/sdk/js?client-id=AQO-1N-hiKvY3Sx26QyzAdJHpf5JmwXadO8JiLZZe4AYGkVql1DhcgFV_6kRPgFGMy6sLd4i5Jz5Epwk"></script>

<style>
	/* Media query for mobile viewport */
	@media screen and (max-width: 400px) {
		#paypal-button-container {
			width: 100%;
		}
	}

	/* Media query for desktop viewport */
	@media screen and (min-width: 400px) {
		#paypal-button-container {
			width: 250px;
			display: inline-block;
		}
	}
</style>

<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>VERIFICAR</h3>
	</div>
</div>
<!-- //banner -->
<!-- check out -->
<div class="checkout">
	<div class="container">

		<div id="id_servicios_detalle" style="display: none;">

			<h4 style="text-align: center;"><B>DATOS DE LA RESERVA</B></h4>

			<br>

			<div class="row">

				<?php
				date_default_timezone_set('America/Guayaquil');
				$fecha = date("Y-m-d");
				$time = date('H:i', time());
				?>

				<div class="col-lg-2">
					<div class="form-group">
						<label for="fecha_pac">Fecha</label>
						<input type="date" value="<?php echo $fecha ?>" class="form-control" id="fecha_pac">
					</div>
				</div>

				<div class="col-lg-2">
					<div class="form-group">
						<label for="hora_enevto">Hora</label>
						<input type="time" class="form-control" value="<?php echo $time ?>" id="hora_enevto"><br>
					</div>
				</div>

				<div class="col-lg-8">
					<div class="form-group">
						<label for="asunto">Asunto</label> &nbsp;&nbsp; <label style="color:red;" id="asunto_obligg"></label>
						<input type="text" class="form-control" id="asunto" placeholder="Ingrese asunto de la reserva">
					</div>
				</div>

				<div class="col-lg-12">
					<div class="form-group">
						<label for="nota">Nota</label> &nbsp;&nbsp; <label style="color:red;" id="nota_obligg"></label>
						<textarea class="form-control" id="nota" cols="3" rows="3" style="resize: none;"></textarea>
					</div>
				</div>

				<div class="col-lg-10">
					<div class="form-group">
						<label for="vechouclo_select">Seleccion el vehiculo</label> &nbsp;&nbsp; <label style="color:red;" id="vechouclo_select_obligg"></label>
						<select class="vechouclo_select form-control" id="vechouclo_select" cols="3" rows="3" style="width: 100%;"></select>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="form-group">
						<label for="vechouclo_select">Nueva vehiculo</label>
						<button class="btn btn-primary" data-toggle="modal" data-target="#modal_vehiculo">Nuevo vehiculo</button>
					</div>
				</div>

			</div>

			<br>

			<h3 style="margin: 0;">MI BOLSA DE SERVICIOS</h3>

			<br>

			<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
				<div class="bs-docs-example">
					<table id="table_servi_clie" class="table table-striped">
						<thead>
							<tr style="text-align: center;">
								<th><b> Remover </b></th>
								<th><b> Servicio </b></th>
								<th><b> Costo </b></th>
							</tr>
						</thead>
						<tbody id="unir_tabla_detalle_servicios">

						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th></th>
								<th style="text-align: center;"><span id="unir_total_servicio"></span> <input hidden type="text" id="txt_total_servicio"> </th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>

			<br>
			<br>
			<br>

		</div>

		<h3 style="margin: 0;">MI BOLSA DE COMPRAS</h3>

		<br>

		<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table id="tabla_productoss" class="timetable_sub">
				<thead>
					<tr>
						<th>Remover</th>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Producto nombre</th>
						<th>Precio</th>
						<th>Descuento</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody id="unnir_tabla_detalle">

				</tbody>
			</table>
		</div>

		<div class="checkout-left">

			<div class="row">
				<div class="col-lg-8">
					<a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Seguir comprando</a>
				</div>
			</div>

			<div id="detalle_pagos" style="display: none;" class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
				<h4>CESTA DE LA COMPRA</h4>
				<ul>
					<li>Subtotal <i>-</i> <input hidden value="0" id="txt_unir_subtotal"> <span id="unir_subtotal"></span></li>
					<li>Iva 12% <i>-</i> <input hidden value="0" id="txt_unir_iva_tot"> <span id="unir_iva_tot"></span></li>
					<li>Total a pagar <i>-</i> <input hidden value="0" id="txt_unir_gran_total"> <span id="unir_gran_total"></span></li>

					<div id="pasarela_producto" class="row">
						<div class="col-lg-12">
							<div class="pago_payal_pro" id="paypal-button-container"></div>
						</div>
					</div>

				</ul>
			</div>


			<div class="clearfix"> </div>

		</div>

		<div id="pasarela_servicio" style="display: none;" class="checkout-left">
			<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
				<h4>Pagar servicio</h4>
				<ul>
					<div class="row" style="text-align: center;">
						<div class="col-lg-12" style="display: none;" id="btb_btn_paypa">
							<div class="pago_payal_ser" id="paypal-button-container_ser"></div>
						</div>

						<div class="col-lg-13" id="btn_reerva_verifi" style="display: none;">
							<button style="font-size: 20px;" class="btn btn-success" onclick="realizar_reservar_cliente();">Verificar reserva </button>
						</div>
					</div>



				</ul>
			</div>
			<div class="clearfix"> </div>

		</div>
	</div>


</div>
<!-- //check out -->

<?php require 'layout/footer.php'; ?>


<!-- <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
	paypal.Button.render({

		// Set your environment
		env: 'sandbox', // sandbox | production
		// Specify the style of the button
		style: {
			label: 'checkout', // checkout | credit | pay | buynow | generic
			size: 'responsive', // small | medium | large | responsive
			shape: 'pill', // pill | rect
			color: 'gold' // gold | blue | silver | black
		},
		// PayPal Client IDs - replace with your own
		// Create a PayPal app: https://developer.paypal.com/developer/applications/create
		client: {
			sandbox: 'AQO-1N-hiKvY3Sx26QyzAdJHpf5JmwXadO8JiLZZe4AYGkVql1DhcgFV_6kRPgFGMy6sLd4i5Jz5Epwk',
			production: '<insert production client id>'
		},
		// Wait for the PayPal button to be clicked
		payment: function(data, actions) { 
			var cantidad = 12; //$("#txt_unir_gran_total").val();
			return actions.payment.create({
				payment: {
					transactions: [{
						amount: {
							total: cantidad,
							currency: 'USD'
						}
					}]
				}
			});
		},

		// Wait for the payment to be authorized by the customer

		onAuthorize: function(data, actions) {
			return actions.payment.execute().then(function() {
				window.alert('Payment Complete!');
			});
		}

	}, '#paypal-button-container');
</script> -->

<script>
	// Render the PayPal button into #paypal-button-container
	paypal.Buttons({
		style: {
			shape: 'pill',
			label: 'pay'
		},
		createOrder: function(data, actions) {
			var cantidad = $("#txt_unir_gran_total").val();
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: cantidad
					}
				}]
			});
		},

		onApprove: function(data, actions) {
			actions.order.capture().then(function(orderData) {
				if (orderData.status == "COMPLETED") {
					// console.log(orderData);

					// var correo_cliente = orderData.payer.email_address;
					// var id_paypal = orderData.id;
					// var payer_id = orderData.payer.payer_id;
					// var nombre_usu = orderData.payer.name.given_name + " " + orderData.payer.name.surname;
					// var status = orderData.status;
					// var hora_fecha = orderData.update_time;

					var count = 0;
					var funcion;
					var sub = $("#txt_unir_subtotal").val();
					var iva = $("#txt_unir_iva_tot").val();
					var total = $("#txt_unir_gran_total").val();
					var impuesto = 12;
					var tipo_doc = "FACTURA";

					$("#tabla_productoss tbody#unnir_tabla_detalle tr").each(function() {
						count++;
					});

					alerta = [
						"datos",
						"Procesando compra de productos, por favor espere....",
						".:Procesando compra:.",
					];

					mostar_loader_datos(alerta);
					funcion = "registrapago_paypal";
					$.ajax({
						url: "../ADMIN/controlador/carrito/carrito.php",
						type: "POST",
						data: {
							funcion: funcion,
							sub: sub,
							iva: iva,
							total: total,
							impuesto: impuesto,
							tipo_doc: tipo_doc,
							count: count
						},
					}).done(function(response) {
						if (response > 0) {
							registra_detalle_compra_cliente(parseInt(response));
						} else {
							return swal.fire("Error al procesar la compra", "Error al procesar su compra", "error");
						}
					});
				} else {
					return swal.fire("Error al pagar", "Ocurrio un error en el proceso de pago", "error");
				}
			});
		},

		onCancel: function(data) {
			swal.fire("Compra cancelada", "La compra se canceló, no se compró el o los productos", "error");
		}
	}).render('#paypal-button-container');


	/////////////////////////////
	///////////////////////////
	paypal.Buttons({
		style: {
			shape: 'pill',
			label: 'pay'
		},
		createOrder: function(data, actions) {
			var cantidad = $("#txt_total_servicio").val();
			return actions.order.create({
				purchase_units: [{
					amount: {
						value: cantidad
					}
				}]
			});
		},

		onApprove: function(data, actions) {
			actions.order.capture().then(function(orderData) {
				if (orderData.status == "COMPLETED") {
					// console.log(orderData);

					var funcion;
					var fecha = $("#fecha_pac").val();
					var fecha_inicio = $("#fecha_pac").val() + " " + $("#hora_enevto").val();
					var hora = $("#hora_enevto").val();
					var asunto = $("#asunto").val();
					var nota = $("#nota").val();
					var vehiculo = $("#vechouclo_select").val();

					var total_ser = $("#txt_total_servicio").val();

					var sub = $("#txt_unir_subtotal").val();
					var iva = $("#txt_unir_iva_tot").val();
					var total = $("#txt_unir_gran_total").val();
					var impuesto = 12;
					var tipo_doc = "FACTURA";
					var count_pro = 0;

					$("#tabla_productoss tbody#unnir_tabla_detalle tr").each(function() {
						count_pro++;
					});

					alerta = [
						"datos",
						"Procesando compra de servicio, por favor espere....",
						".:Procesando servicio:.",
					];

					mostar_loader_datos(alerta);
					funcion = "registrapago_paypal_servicio";
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
							total_ser: total_ser,
							sub: sub,
							iva: iva,
							total: total,
							impuesto: impuesto,
							tipo_doc: tipo_doc
						},
					}).done(function(response) {
						if (response > 0) {
							if (count_pro == 0) {
								registrar_detalle_sericio_paypal(parseInt(response));
							} else {
								registrar_detalle_producto_servicio_paypal(parseInt(response));
							}
						} else {
							return swal.fire("Error al procesar la compra de servicio", "Error al procesar su compra de servicio", "error");
						}
					});
				} else {
					return swal.fire("Error al pagar", "Ocurrio un error en el proceso de pago", "error");
				}
			});
		},

		onCancel: function(data) {
			swal.fire("Compra cancelada", "La compra se canceló, no se compró el o los productos", "error");
		}
	}).render('#paypal-button-container_ser');

	//////////
	/////////////////////////////////////////////////
	function registra_detalle_compra_cliente(id) {
		funcion = "registrar_detalle_compra";
		$.ajax({
			url: "../ADMIN/controlador/carrito/carrito.php",
			type: "POST",
			data: {
				funcion: funcion,
				id: id,
			},
		}).done(function(resp) {
			if (resp == 1) {
				envio_correo_solo_venta(parseInt(id));
				Swal.fire({
					title: 'Venta realizada con exito!!',
					text: "Desea imprimir la factura de venta??",
					icon: 'warning',
					showCancelButton: true,
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si, Imprimir!!'
				}).then((result) => {
					if (result.value) {
						// location.reload();
						window.open(
							"../ADMIN/REPORTES/Pdf/factura_venta.php?id=" +
							parseInt(id) +
							"#zoom=100%",
							"Factura venta",
							"scrollbards=No"
						);
					}
					location.reload();
				});
			} else {
				alerta = [
					"error",
					"error",
					"La compra mo se realizo con exito - FALLA EN LA MATRIX :(;",
				];
				cerrar_loader_tipo_pago_trans(alerta);
			}
		});
	}

	////////////////////
	function registrar_detalle_producto_servicio_paypal(id) {
		funcion = "registrar_detalle_producto_servicio_paypal";
		//ajax para guardar detalle registros
		$.ajax({
			url: "../ADMIN/controlador/carrito/carrito.php",
			type: "POST",
			data: {
				funcion: funcion,
				id: id,
			},
		}).done(function(resp) {
			if (resp > 0) {
				if (resp == 1) {
					registrar_detalle_sericio_paypal(parseInt(id));
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

	function registrar_detalle_sericio_paypal(id) {
		funcion = "registrar_detalle_sericio_paypal";
		$.ajax({
			url: "../ADMIN/controlador/carrito/carrito.php",
			type: "POST",
			data: {
				funcion: funcion,
				id: id,
			},
		}).done(function(resp) {
			if (resp == 1) {

				envio_correo_servicio_carp(parseInt(id));
				// enviar_sms_servicio(parseInt(id));

				Swal.fire({
					title: 'Servicio realizado con exito!!',
					text: "Desea imprimir la factura de servicio??",
					icon: 'warning',
					showCancelButton: true,
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si, Imprimir!!'
				}).then((result) => {
					if (result.value) {
						window.open("../ADMIN/REPORTES/Pdf/factura_servicios.php?id=" + parseInt(id) + "#zoom=100%", "Reporte de ingreso", "scrollbards=No");
					}
					location.reload();
				});
			} else {
				alerta = [
					"error",
					"error",
					"La compra mo se realizo con exito - FALLA EN LA MATRIX :(;",
				];
				cerrar_loader_tipo_pago_trans(alerta);
			}
		});
	}

	/////////////////
	////////////////
	function envio_correo_solo_venta(id) {
		$.ajax({
			url: "../ADMIN/modelo/envio_correo/envio_venta.php",
			type: "POST",
			data: {
				id: id,
			},
		}).done(function(response) {
			console.log(response);
		});
	}

	////////////////envio de correo
	function envio_correo_servicio_carp(id) {
		$.ajax({
			url: "../ADMIN/modelo/envio_correo/envio_servicio.php",
			type: "POST",
			data: {
				id: id,
			},
		}).done(function(response) {
			console.log(response);
		});
	}
	///////////
	function enviar_sms_servicio(id){
		$.ajax({
			url: "../ADMIN/modelo/sms/cita.php",
			type: "POST",
			data: {
				id: id,
			},
		}).done(function(response) {
			console.log(response);
		});
	}
</script>

<script>
	listar_tpi_vehculo();
	listar_marca();

	function listar_tpi_vehculo() {
		funcion = "listar_tpi_vehculo_combo";
		$.ajax({
			url: "../ADMIN/controlador/servicio/servicio.php",
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
						"<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
				}
				//aqui concadenamos al id del select
				$("#tipo_vehoculo").html(cadena);
			} else {
				cadena += "<option value=''>No hay datos</option>";
				$("#tipo_vehoculo").html(cadena);
			}
		});
	}

	function listar_marca() {
		funcion = "listar_marca_combo";
		$.ajax({
			url: "../ADMIN/controlador/servicio/servicio.php",
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
						"<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
				}
				//aqui concadenamos al id del select
				$("#tipo_marca").html(cadena);
			} else {
				cadena += "<option value=''>No hay datos</option>";
				$("#tipo_marca").html(cadena);
			}
		});
	}

	mostrar_carrito_compra_detalle();
	mostrar_carrito_servicios();
	listar_vehoculo_cliente();

	function listar_vehoculo_cliente() {
		funcion = "listar_vehoculo_cliente";
		$.ajax({
			url: "../ADMIN/controlador/carrito/carrito.php",
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
						"<option value='" + data[i][0] + "'>Vehiculo: " + data[i][3] + " - Matricula: " + data[i][2] + " - Marca: " + data[i][4] + " - Color/es: " + data[i][5] + " - Detalle: " + data[i][6] + "</option>";
				}
				//aqui concadenamos al id del select
				$("#vechouclo_select").html(cadena);
			} else {
				cadena += "<option value=''>No hay datos</option>";
				$("#vechouclo_select").html(cadena);
			}
		});
	}

	/////////////////////////
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
			success: function(resp) {
				if (resp > 0) {
					if (resp == 1) {
						alerta = ["exito", "success", "El vehiculo se creo con exito :)"];
						cerrar_loader_datos(alerta);
						listar_vehoculo_cliente();
						$("#modal_vehiculo").modal("hide");

						$("#matrcula").val("");
						$("#color").val("");
						$("#detalle").val("");
						$("#foto").val("");
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
</script>


<div class="modal fade" id="modal_vehiculo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-info">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body modal-spa">

				<div class="row">
					<input hidden id="cliente" value="<?php echo $_SESSION["id_cli"]; ?>">
					<div class="col-lg-4">
						<label for="fecha">Fecha</label> &nbsp;&nbsp; <label style="color:red;" id="fecha_obliga"></label>
						<input readonly type="date" class="form-control" id="fecha" value="<?php echo $fecha ?>"><br>
					</div>

					<div class="col-lg-4">
						<label for="tipo_vehoculo">Tipo vehiculo</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_vehoculo_obligg"></label>
						<select class="tipo_vehoculo form-control" id="tipo_vehoculo" style="width: 100%;"></select><br>
					</div>

					<div class="col-lg-4">
						<label for="tipo_marca">Tipo marca</label> &nbsp;&nbsp; <label style="color:red;" id="tipo_marca_obligg"></label>
						<select class="tipo_marca form-control" id="tipo_marca" style="width: 100%;"></select><br>
					</div>


					<div class="col-lg-5">
						<label for="matrcula">Matricula</label> &nbsp;&nbsp; <label style="color:red;" id="matricula_obliga"></label>
						<input type="text" maxlength="20" class="form-control" id="matrcula" placeholder="Ingrese matricula"><br>
					</div>

					<div class="col-lg-7">
						<label for="color">Color/es</label> &nbsp;&nbsp; <label style="color:red;" id="color_obliga"></label>
						<input type="text" onkeypress="return soloLetras(event)" maxlength="40" class="form-control" id="color" placeholder="Ingrese color de vehiculos"><br>
					</div>

					<div class="col-lg-12">
						<label for="detalle">Detalle del vehiculo</label> &nbsp;&nbsp; <label style="color:red;" id="detalle_obliga"></label>
						<textarea class="form-control" id="detalle"> </textarea> <br>
					</div>

					<div class="col-lg-12">
						<div class="form-group">
							<label for="foto">Subir imagen</label>
							<input id="foto" class="form-control" type="file" name="foto" accept="image/*"><br>
						</div>
					</div>

					<div class="col-lg-12" style="text-align: center">
						<button type="button" class="btn btn-success" onclick="regitro_vehoculos_cliente()"><i class="fa fa-save"></i> Registrar</button>
					</div>

				</div>

			</div>
		</div>

	</div>

</div>

<script>
	function soloLetras(e) {
		key = e.keyCode || e.which;
		tecla = String.fromCharCode(key).toLowerCase();
		letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
		especiales = "8-37-39-46";
		tecla_especial = false
		for (var i in especiales) {
			if (key == especiales[i]) {
				tecla_especial = true;
				break;
			}
		}
		if (letras.indexOf(tecla) == -1 && !tecla_especial) {
			return swal.fire(
				"No se permiten numeros!!",
				"Solo se permiten letras",
				"warning"
			);
		}
	}
</script>

