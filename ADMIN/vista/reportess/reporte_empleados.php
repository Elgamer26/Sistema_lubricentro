<style>
    .contennidor {
        background: gray;
        min-height: 90vh;
    }
</style>

<section class="content-header">
    <h1>
        <b> Reporte rol de pago <i class="fa fa-dollar"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Reporte rol de pago</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-file"></i> Reporte rol de pago</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-lg-5">
                        <label>Empleado</label>
                        <select class="id_empleado form-control" style="width: 100%;" id="id_empleado"></select>
                    </div>

                    <div class="col-lg-3">
                        <label>Fecha inicio</label>
                        <input type="date" class="form-control" id="fecha_cli_ini"><br>
                    </div>

                    <div class="col-lg-3">
                        <label>Fecha fin</label>
                        <input type="date" class="form-control" id="fecha_cli_fin"><br>
                    </div>

                    <div class="col-lg-1">
                        <label>Buscar</label>
                        <button class="btn btn-danger" onclick="ver_reporte_empleado_fecha();"> <i class="fa fa-eye"></i> Ver</button>
                    </div>

                    <div class="col-lg-12">
                        <center>
                            <iframe width="100%" height="100%" class="contennidor" id="iframe_empleado"></iframe>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".id_empleado").select2();

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

        listar_comob_empplado();
    });

    function listar_comob_empplado() {
        funcion = "listar_comob_empplado";
        $.ajax({
            url: "../ADMIN/controlador/empleado/empleado.php",
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
                        "<option value='" + data[i][0] + "'> " + data[i][1] + " </option>";
                }
                //aqui concadenamos al id del select
                $("#id_empleado").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#id_empleado").html(cadena);
            }
        });
    }

    function ver_reporte_empleado_fecha() {

        var fecha_inicio = $("#fecha_cli_ini").val();
        var fecha_fin = $("#fecha_cli_fin").val();
        var id = $("#id_empleado").val()

        if (id.length == 0) {
            return Swal.fire(
                "Mensaje de advertencia",
                "No hay empleado para realizar una busqueda",
                "warning"
            );
        }

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

        var ifrm = document.getElementById("iframe_empleado");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_empleado.php?id='" + id + "'&f_i='" + fecha_inicio + "'&f_f='" + fecha_fin + "'");

    }
</script>