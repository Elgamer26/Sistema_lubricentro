<style>
    .contennidor {
        background: gray;
        min-height: 90vh;
    }
</style>

<section class="content-header">
    <h1>
        <b> Reporte de ventas <i class="fa fa-shopping-cart"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Reporte de ventas</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-file"></i> Reporte de ventas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-lg-5">
                        <label>Fecha inicio</label>
                        <input type="date" class="form-control" id="fecha_cli_ini"><br>
                    </div>

                    <div class="col-lg-5">
                        <label>Fecha fin</label>
                        <input type="date" class="form-control" id="fecha_cli_fin"><br>
                    </div>

                    <div class="col-lg-1">
                        <label>Buscar</label>
                        <button class="btn btn-danger" onclick="ver_reporte_ventas();"> <i class="fa fa-eye"></i> Ver</button>
                    </div>

                    <div class="col-lg-12">
                        <center>
                            <iframe width="100%" height="100%" class="contennidor" id="iframe_ventas"></iframe>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        var n = new Date();
        var y = n.getFullYear();
        var m = n.getMonth() + 1;
        var d = n.getDate();
        if (d < 10) {
            d = '0' + d;
        }
        if (m < 10) {
            m = '0' + m;
        }

        document.getElementById("fecha_cli_ini").value = y + "-" + m + "-" + d;
        document.getElementById("fecha_cli_fin").value = y + "-" + m + "-" + d;

    });


    function ver_reporte_ventas() {

        var fecha_inicio = $("#fecha_cli_ini").val();
        var fecha_fin = $("#fecha_cli_fin").val();

        if (fecha_inicio > fecha_fin) {
            return Swal.fire(
                "Mensaje de advertencia",
                "La fecha inicio '" +
                fecha_inicio +
                "' es mayor a la fecha final '" +
                fecha_fin +
                "'",
                "warning"
            );
        }

        var ifrm = document.getElementById("iframe_ventas");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_ventas.php?f_i='" + fecha_inicio + "'&f_f='" + fecha_fin + "'");

    }
</script>