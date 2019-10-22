<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Backend_model extends CI_Model {
	
		public function getId($link)
		{
			$this->db->like('link', $link);
			
			$resultados = $this->db->get("menus");
			return $resultados->row();
		}

		public function getPermisos($menu,$rol){
			$this->db->where('menu_id', $menu);
			$this->db->where('rol_id', $rol);
			$resultados = $this->db->get("permisos");
			return $resultados->row();
		}

		public function rowCount($tabla){
			if($tabla != 'venta')
				$this->db->where('estado', 'S');
			$resultados = $this->db->get($tabla);
			return $resultados->num_rows();
		}
		public function getParents($rol) { 
			$this->db->select("m.*"); $this->db->from("menus m"); 
			$this->db->join("permisos p", "p.menu_id = m.id"); 
			$this->db->where("p.rol_id",$rol); 
			$this->db->where("p.read","1"); 
			$this->db->where("m.parent","0"); 
			$this->db->order_by("m.orden"); 
			$resultados = $this->db->get(); 
			if ($resultados->num_rows() > 0) { 
				return $resultados->result(); 
			} else{ 
				return false; 
			} 
		}

		public function getChildren($rol,$idMenu) { 
			$this->db->select("m.*"); 
			$this->db->from("menus m"); 
			$this->db->join("permisos p", "p.menu_id = m.id"); 
			$this->db->where("p.rol_id",$rol); 
			$this->db->where("p.read","1"); 
			$this->db->where("m.parent",$idMenu); 
			$resultados = $this->db->get(); 
			if ($resultados->num_rows() > 0) { 
				return $resultados->result(); 
			}else{ 
				return false;
			} 
		} 

		/**
Por ultimo el aside.php debe quedar asi: <aside class="main-sidebar"> <!-- sidebar: style can be found in sidebar.less --> <section class="sidebar"> <!-- sidebar menu: : style can be found in sidebar.less --> <ul class="sidebar-menu" data-widget="tree"> <li class="header">Menu</li> <!-- Sidebar user panel --> <div class="user-panel"> <div class="pull-left image"> <img src="<?php echo base_url();?>img/quicheladas.png" alt="Avatar" /> </div> <div class="pull-left info"> <p><?php echo $this->session->userdata("nombre")?></p> <p><i class="fa fa-circle text-success"></i> En Linea</p> </div> </div> <?php echo $this->backend_lib->getMenu();?> </ul> </section> <!-- /.sidebar --> </aside>


        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">      
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    
                    <?php echo $this->backend_lib->getMenu();?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->
		**/

	}
?>