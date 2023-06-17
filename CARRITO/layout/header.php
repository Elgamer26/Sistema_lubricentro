<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>DON GATO</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //for-mobile-apps -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
	<!-- pignose css -->
	<link href="css/pignose.layerslider.css" rel="stylesheet" type="text/css" media="all" />


	<!-- //pignose css -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!-- //js -->
	<!-- cart -->
	<script src="js/simpleCart.min.js"></script>
	<!-- cart -->
	<!-- for bootstrap working -->
	<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
	<!-- //for bootstrap working -->
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>

	<script src="js/jquery.easing.min.js"></script>

	<!-- <script src="../ADMIN/plugins/SELECT2/css/select2.min.js"></script> -->

</head>

<body>
	<!-- banner -->
	<div class="ban-top">
		<div class="container">
			<div class="top_nav_left">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav menu__list">
								<li class="active menu__item menu__item--current"><a class="menu__link" href="index.php">Home <span class="sr-only">(current)</span></a></li>

								<li class=" menu__item"><a class="menu__link" href="ofertas.php">Ofertas</a></li>
								<li class=" menu__item"><a class="menu__link" href="servicios.php">Servicios</a></li>

								<?php
								if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {
								?>

									<li class=" menu__item"><a class="menu__link" href="checkout.php">Detalle carrito</a></li>
									<li class="menu__item" style="background: orange;"><a href="../cliente/" target="_blank" class="menu__link"><?php echo $_SESSION["nombre_cli"]; ?></a></li>
									<li class=" menu__item" style="background: red;"><a class="menu__link" href="layout/cerrar.php">Cerrar sesión</a></li>

								<?php
								}
								?>

								<!-- <li class=" menu__item"><a class="menu__link" href="codes.html">Short Codes</a></li> -->

							</ul>
						</div>
					</div>
				</nav>
			</div>
			<div class="top_nav_right">

				<?php
				if (isset($_SESSION["id_cli"]) && isset($_SESSION["nombre_cli"])) {
				?>
					<div class="cart box_1">
						<a href="checkout.php">
							<h3>
								<div class="total">
									<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
									(<span id="cantidad_carrito"></span> items)
								</div>

							</h3>
						</a>
						<p style="display: none;"><a href="javascript:;" onclick="vaciar_carrito();">Vaciar carrito</a></p>
						<p><a href="javascript:;">Carrito</a></p>
					</div>

				<?php } else { ?>

					<ul class="nav navbar-nav menu__list">

						<li style="background: orange;" class="menu__item"><a href="#" style="color: white;" class="use1" data-toggle="modal" data-target="#myModal4">Login/Registrar</a></li>

					</ul>

				<?php } ?>

			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- //banner-top -->