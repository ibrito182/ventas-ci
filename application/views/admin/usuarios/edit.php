
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Editar
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
                        <form action="<?php echo base_url();?>administrador/usuarios/update" method="post">
                            <input type="hidden" name="idusuario" value="<?php echo $usuario->id; ?>">
                            <div class="form-group ">
                                <label for="nombres">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $usuario->nombres; ?>">
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $usuario->apellidos; ?>">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $usuario->telefono; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $usuario->email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Usuario:</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo $usuario->username; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="rol">Roles:</label>
                                <select name="rol" id="rol" class="form-control">
                                    <?php foreach($roles as $rol): ?>
                                    <option value="<?php echo $rol->id; ?>" <?php echo $rol->id == $usuario->rol_id ? "selected":""; ?> ><?php echo $rol->nombre; ?></option>
                                    <?php endforeach; ?>    
                                </select>
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
