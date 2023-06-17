<?php require 'layout/header.php'; ?>

<!-- banner -->
<div class="banner-grid">
	<div id="visual">
		<div class="slide-visual" style="width: 100%;">
			<!-- Slide Image Area (1000 x 424) -->
			<ul class="slide-group" style="width: 70%;">
				<li style="width: 1350px;"><img style="width: 100%; height: 100%;" class="img-responsive" src="images/imagen_gato/chica4.jpeg" alt="Dummy Image" /></li>
				<li style="width: 1350px;"><img style="width: 100%; height: 100%;" class="img-responsive" src="images/imagen_gato/gato.jpeg" alt="Dummy Image" /></li>
				<li style="width: 1350px;"><img style="width: 100%; height: 100%;" class="img-responsive" src="images/imagen_gato/chica2.jpeg" alt="Dummy Image" /></li>
			</ul>

			<!-- Slide Description Image Area (316 x 328) -->
			<!-- <div class="script-wrap">
				<ul class="script-group">
					<li>
						<div class="inner-script"><img class="img-responsive" src="images/baa1.e" alt="Dummy Image" /></div>
					</li>
					<li>
						<div class="inner-script"><img class="img-responsive" src="images/baa2.jpg" alt="Dummy Image" /></div>
					</li>
					<li>
						<div class="inner-script"><img class="img-responsive" src="images/baa3.jpg" alt="Dummy Image" /></div>
					</li>
				</ul>
				<div class="slide-controller">
					<a href="#" class="btn-prev"><img src="images/btn_prev.png" alt="Prev Slide" /></a>
					<a href="#" class="btn-play"><img src="images/btn_play.png" alt="Start Slide" /></a>
					<a href="#" class="btn-pause"><img src="images/btn_pause.png" alt="Pause Slide" /></a>
					<a href="#" class="btn-next"><img src="images/btn_next.png" alt="Next Slide" /></a>
				</div>
			</div> -->
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	<script type="text/javascript" src="js/pignose.layerslider.js"></script>
	<script type="text/javascript">
		//<![CDATA[
		$(window).load(function() {
			$('#visual').pignoseLayerSlider({
				play: '.btn-play',
				pause: '.btn-pause',
				next: '.btn-next',
				prev: '.btn-prev'
			});
		});
		//]]>
	</script>

</div>
<!-- //banner -->

<!-- product-nav -->

<div class="product-easy">
	<div class="container">

		<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#horizontalTab').easyResponsiveTabs({
					type: 'default', //Types: default, vertical, accordion           
					width: 'auto', //auto or any width like 600px
					fit: true // 100% fit in a container
				});

				$('#horizontalTab_1').easyResponsiveTabs({
					type: 'default', //Types: default, vertical, accordion           
					width: 'auto', //auto or any width like 600px
					fit: true // 100% fit in a container
				});
			});
		</script>

		<div class="sap_tabs">
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Productos</span></li>
				</ul>

				<div class="col-md-3 header-left">
					<div class="search">
						<input type="text" id="busqueda_pro" placeholder="Buscar...">
					</div>
				</div>

				<br><br>

				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">

						<div id="unir_prod">

						</div>

						<div class="clearfix"></div>

						<ul class="pagination pagination-lg" id="unir_paguinador">

						</ul>

					</div>
				</div>
			</div>
		</div>

		<hr>

		<div class="sap_tabs">
			<div id="horizontalTab_1" style="display: block; width: 100%; margin: 0px;">
				<ul class="resp-tabs-list">
					<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Ofertas</span></li>
				</ul>

				<div class="col-md-3 header-left">
					<div class="search">
						<input type="text" id="busqueda_pro_oferta" placeholder="Buscar...">
					</div>
				</div>

				<br><br>

				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">

						<div id="unir_prod_oferta">

						</div>

						<div class="clearfix"></div>

						<ul class="pagination pagination-lg" id="unir_paguinador_oferta">

						</ul>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- //product-nav -->
<?php require 'layout/footer.php'; ?>