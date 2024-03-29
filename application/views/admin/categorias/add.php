
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Categorias
        <small>Nuevo</small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
               <div class="row">
                    <div class="col-md-12">
                        <?php if ($this->session->flashdata('error')):?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" data-dismiss="alert" aria-hidden="true" class="close">&times;</button>
                                <p><i class="icon fa fa-ban"></i>
                                    <?php echo $this->session->flashdata('error'); ?></p>
                            </div>
                        <?php endif; ?>    
                        <form action="<?php echo base_url();?>mantenimiento/categorias/store" method="post">
                            <div class="form-group <?php echo !empty(form_error("nombre"))? 'has-error':''?>">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo set_value("nombre"); ?>">
                                <?php echo form_error("nombre","<span class='help-block'>","</span>") ?>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat" >Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
