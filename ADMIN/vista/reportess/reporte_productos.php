<style>
    .contennidor {
        background: gray;
        min-height: 90vh;
    }
</style>

<section class="content-header">
    <h1>
        <b> Reporte de productos <i class="fa fa-cubes"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Reporte de productos</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-file"></i> Reporte de productos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">

                    <div class="col-lg-5">
                        <label>Marca</label>
                        <select class="id_marca form-control" style="width: 100%;" id="id_marca"></select>
                    </div>

                    <div class="col-lg-5">
                        <label>Tipo</label>
                        <select class="id_tipo form-control" style="width: 100%;" id="id_tipo"></select>
                    </div>

                    <div class="col-lg-1">
                        <label></label>
                        <button onclick="ver_reporte_producto();" class="btn btn-danger"><i class="fa fa-eye"></i> Todos</button>
                    </div>

                    <br> <br> <br> <br> <br>

                    <div class="col-lg-12">
                        <center>
                            <iframe width="100%" height="100%" class="contennidor" id="iframe_productos"></iframe>
                        </center>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".id_marca").select2();
    $(".id_tipo").select2();

    $(document).ready(function() {

        ver_reporte_producto();
        listar_tipo_producto();
        listar_marca_producto();

    });

    ///////////////////////
    function listar_tipo_producto() {
        funcion = "listar_tipo_producto";
        $.ajax({
            url: "../ADMIN/controlador/producto/producto.php",
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
                $("#id_tipo").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#id_tipo").html(cadena);
            }
        });
    }

    function listar_marca_producto() {
        funcion = "listar_marca_producto";
        $.ajax({
            url: "../ADMIN/controlador/producto/producto.php",
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
                $("#id_marca").html(cadena);
            } else {
                cadena += "<option value=''>No hay datos</option>";
                $("#id_marca").html(cadena);
            }
        });
    }

    $("#id_marca").change(function() {
        var id = $("#id_marca").val();

        var ifrm = document.getElementById("iframe_productos");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_producto_m.php?id='" + id + "'");

    });

    $("#id_tipo").change(function() {
        var id = $("#id_tipo").val();

        var ifrm = document.getElementById("iframe_productos");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_producto_t.php?id='" + id + "'");

    });

    function ver_reporte_producto() {

        var ifrm = document.getElementById("iframe_productos");
        ifrm.setAttribute("src", "../ADMIN/REPORTES/Pdf/Reportes/reporte_producto.php");

    }
</script>