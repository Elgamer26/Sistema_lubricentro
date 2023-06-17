<?php require 'layout/header.php'; ?>


<div class="page-head">
	<div class="container">
		<h3>SERVICIOS</h3>
	</div>
</div>


<div class="container">
	<div class="ele-bottom-grid">
		<h3><span>SERVICIOS </span>DISPONIBLES</h3>

		<div class="col-md-3 header-left">
			<div class="search">
				<input type="text" id="busqueda_servicios" placeholder="Buscar...">
			</div>
		</div>

		<br><br>

		<div class="clearfix"></div> 

		<div id="unir_servicios">

		</div>

		<div class="clearfix"></div>

		<ul class="pagination pagination-lg" id="unir_paguinador_servicios">

		</ul>

		<div class="clearfix"></div>
		<div class="clearfix"></div>
	</div>
</div>


<?php require 'layout/footer.php'; ?>

<script>
     pagination_servicios(1);
</script>