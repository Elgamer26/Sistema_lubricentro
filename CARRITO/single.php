<?php require 'layout/header.php'; ?>
<?php require '../ADMIN/modelo/conection/conections.php'; ?>

<?php

$id = $_GET['id'];

$consult_producto = 'SELECT
producto.id_producto,
producto.poducto_codigo,
producto.producto_nombre,
producto.tipo_producto_id,
tipo_producto.tipo_producto,
producto.marca_producto_id,
marca.marca,
producto.producto_detalle,
producto.producto_precio_venta,
producto.producto_foto,
producto.estado,
producto.producto_destacar,
producto._eliminado,
producto.stock 
FROM
	marca
	INNER JOIN producto ON marca.id_marca = producto.marca_producto_id
	INNER JOIN tipo_producto ON producto.tipo_producto_id = tipo_producto.id_tipo_producto                
WHERE
producto.id_producto = ' . $id . '';
$resulta_producto = $mysqli->query($consult_producto);
$data_producto = mysqli_fetch_assoc($resulta_producto);

// print_r($data_producto);

?>

<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>DETALLE</h3>
	</div>
</div>

<!-- //banner -->
<!-- single -->
<div class="single">
	<div class="container">
		<div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					<!-- FlexSlider -->
					<script>
						// Can also be used with $(document).ready()
						$(window).load(function() {
							$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
							});
						});
					</script>
					<!-- //FlexSlider-->
					<ul class="slides">
						<li data-thumb="images/d2.jpg">
							<div class="thumb-image"> <img src="../ADMIN/<?php echo $data_producto['producto_foto']; ?>" data-imagezoom="true" class="img-responsive"> </div>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

		<div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
			<h3><?php echo $data_producto['producto_nombre']; ?></h3>

			<p><span class="item_price">$. <?php echo $data_producto['producto_precio_venta']; ?></p>

			 
			<div class="description">
				<h5><b>Detalle:</b> <?php echo $data_producto['producto_detalle']; ?></h5>
			</div>

			
			<div class="occasional">
				<h5>Tipo :</h5>
				<div class="colr ert">
					<label><?php echo $data_producto['tipo_producto']; ?></label>
				</div>

				<br><br>

				<h5>Marca :</h5>
				<div class="colr ert">
					<label><?php echo $data_producto['marca']; ?></label>
				</div>
			 
				<div class="clearfix"> </div>
			</div>
			<div class="occasion-cart">
				<a onclick="agg_carrito(<?php echo $data_producto['id_producto']; ?>);" class="item_add hvr-outline-out button2">Agregar al carrito</a>
			</div>

		</div>
		<div class="clearfix"> </div>

	</div>
</div>

<?php require 'layout/footer.php'; ?>