
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Permisos
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
                        <form action="<?php echo base_url();?>administrador/permisos/store" method="post">
                            <div class="form-group">
                                <label for="rol">Roles:</label>
                                <select name="rol" id="rol" class="form-control">
                                    <?php foreach($roles as $rol): ?>
                                        <option value="<?php echo $rol->id;?>">
                                            <?php echo $rol->nombre;?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="menu">Menu:</label>
                                <select name="menu" id="menu" class="form-control">
                                    <?php foreach($menus as $menu): ?>
                                        <option value="<?php echo $menu->id;?>">
                                            <?php echo $menu->nombre;?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="read">Leer:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="read" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="read" value="0" >No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="insert">Agregar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="insert" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="insert" value="0" >No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="update">Editar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="update" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="update" value="0" >No
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="delete">Eliminar:</label>
                                <label class="radio-inline">
                                    <input type="radio" name="delete" value="1" checked="checked">Si
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="delete" value="0" >No
                                </label>
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
