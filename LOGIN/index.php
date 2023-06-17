<?php
//esto es en caso de que no exista la session me llevara al login index
session_start();
if (isset($_SESSION["id_usu"])) {
	header("location: ../ADMIN/");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- LINEARICONS -->
	<link rel="stylesheet" href="fonts/linearicons/style.css">

	<!-- MATERIAL DESIGN ICONIC FONT -->
	<link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

	<!-- STYLE CSS -->
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<div class="wrapper">
		<div class="inner" style="background: #cccccd; padding: 17px; border-radius: 30px;">
			<h3 style="text-align: center;">INICIAR SESIÓN</h3>

			<div style="    text-align: center;
				background: #ff000094;
				padding: 10px;
				color: white; display:none;" id="none_usu">
				<span><b> Ingrese un usuario para continuar</b></span>
			</div>

			<br>

			<div style="    text-align: center;
				background: #ff000094;
				padding: 10px;
				color: white; display:none;" id="none_pass">
				<span><b> Ingrese un password para continuar</b></span>
			</div>

			<br>

			<div class="form-wrapper">
				<label for="usuario">Usuario *</label>
				<input id="usuario" type="text" class="form-control" placeholder="Ingrese usuario">
			</div>

			<br>

			<div class="form-wrapper">
				<label for="password">Password *</label>
				<input id="password" type="password" class="form-control" placeholder="Ingrese password">
			</div>

			<br>

			<div style="    text-align: center;
				background: #ff000094;
				padding: 10px;
				color: white; display:none;" id="error_logeo">
				<span> <b>Usuario o contraseña incorrectos</b></span>
			</div>

			<br>

			<div class="form-row" style="text-align: -webkit-center;">
				<div class="form-wrapper">
					<button id="ingresar" data-text="Ingresar">
						<span>Ingresar</span>
					</button>
				</div>
				<div class="form-wrapper">
					<a class="btn btn-danger" href="../CARRITO/">
						<button data-text="Regresar" style="background: red;">
							<span> Regresar </span>
						</button>
					</a>
				</div>
			</div>



		</div>
	</div>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="../ADMIN/js/usuario.js"></script>

</html>