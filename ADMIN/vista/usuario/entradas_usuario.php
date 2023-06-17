<script type="text/javascript" src="../ADMIN/js/usuario.js"></script>

<section class="content-header">
    <h1>
        <b> Listado entradas de usuarios <i class="fa fa-user"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado entradas de usuarios</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado entradas de usuarios </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_uingreso_u" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Fecha y hora</th>
                            <th>Ip</th>
                            <th>Dispositivo</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Estado</th>
                            <th>Usuario</th>
                            <th>Fecha y hora</th>
                            <th>Ip</th>
                            <th>Dispositivo</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    listar_etradas_usuaio();
</script>