<style>
    .contennidor {
        background: gray;
        min-height: 90vh;
    }
</style>

<section class="content-header">
    <h1>
        <b> Reporte de clientes <i class="fa fa-users"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Reporte de clientes</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-file"></i> Reporte de clientes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-lg-12">
                        <center>
                            <iframe width="100%" height="100%" class="contennidor" id="iframe_clientes"></iframe>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        ver_reporte_clientes();
    });

    function ver_reporte_clientes() {
        var ifrm = document.getElementById("iframe_clientes");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_clientes.php");
    }
</script>