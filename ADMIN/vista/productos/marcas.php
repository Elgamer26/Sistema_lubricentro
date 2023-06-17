<script type="text/javascript" src="../ADMIN/js/producto.js"></script>

<section class="content-header">
    <h1>
        <b> Marcas <i class="fa fa-cube"></i> </b> <button class="btn btn-danger" onclick="nuevo_marca();"><i class="fa fa-plus"></i> Nuevo tipo</button>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Marcas</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Marcas </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_marcas" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Nombre</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_marcas" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Nueva marca</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-lg-12">
                        <label for="marca_pro">Marca de producto</label>
                        <input type="text" maxlength="150" class="form-control" id="marca_pro" placeholder="Ingrese marca de producto"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="registrar_marca()"><i class="fa fa-save"></i> Registrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_editar_marca" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background: #3c8dbc; color:white;">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar marca de producto</h4>
            </div>

            <div class="modal-body">
                <div class="row">

                    <input hidden type="text" id="id_marca_pro">

                    <div class="col-lg-12">
                        <label for="marca_producto_edit">Marca de producto</label>
                        <input type="text" maxlength="150" class="form-control" id="marca_producto_edit" placeholder="Ingrese marca de producto"><br>
                    </div>

                </div>
            </div>

            <div class="modal-footer" style="background: silver;">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editar_marca()"><i class="fa fa-edit"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<script>
   listar_marcas();

    function nuevo_marca() {
        document.getElementById("marca_pro").value = "";
        $("#modal_marcas").modal({
            backdrop: "static",
            keyboard: false,
        });
        $("#modal_marcas").modal("show");
    }
</script>