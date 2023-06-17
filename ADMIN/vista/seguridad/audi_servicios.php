<script type="text/javascript" src="../ADMIN/js/sytem.js"></script>

<section class="content-header">
    <h1>
        <b>Auditoria de servicios <i class="fa fa-dollar"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado de servicios</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Auditoria de servicios </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tbla_auditoria_servicios" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Operacion</th>
                            <th>Usuario</th>
                            <th>Fecha - hora</th>
                            <th>N° servicio</th>
                            <th>Total</th>
                            <th>App</th>
                            <th>Ip</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Operacion</th>
                            <th>Usuario</th>
                            <th>Fecha - hora</th>
                            <th>N° servicio</th>
                            <th>Total</th>
                            <th>App</th>
                            <th>Ip</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
 
<script>
     listar_auditoria_servicios();
</script>