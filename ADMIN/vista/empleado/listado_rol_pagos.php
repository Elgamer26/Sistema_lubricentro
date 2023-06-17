<script type="text/javascript" src="../ADMIN/js/empleado.js"></script>

<section class="content-header">
    <h1>
        <b> Listado rol de pagos <i class="fa fa-dollar"></i> </b>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> principal</a></li>
        <li><a href="#">Listado rol de pagos</a></li>
    </ol>
</section>

<div class="content">
    <div class="col-md-13">
        <div class="box box-success box-solid">
            <div class="box-header with-border center" style="text-align: center;">
                <h3 class="box-title"><i class="fa fa-list-alt"></i> Listado rol de pagos </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tabla_rol_pagos" class="display responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cargo</th>
                            <th>Datos del empleado</th>
                            <th>Fecha y hora</th>
                            <th>Valor por hora</th>
                            <th>Monto</th>
                            <th>Total ingreso</th>
                            <th>Total egreso</th>
                            <th>Total neto</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th>#</th>
                            <th>Acci&oacute;n</th>
                            <th>Estado</th>
                            <th>Cargo</th>
                            <th>Datos del empleado</th>
                            <th>Fecha y hora</th>
                            <th>Valor por hora</th>
                            <th>Monto</th>
                            <th>Total ingreso</th>
                            <th>Total egreso</th>
                            <th>Total neto</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    listar_rol_pagos();
</script>