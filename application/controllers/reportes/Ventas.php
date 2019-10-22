<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata('login')) {
			redirect(base_url());
		}
		$this->load->model("Ventas_model");
		$this->load->model("Clientes_model");
		$this->load->model("Productos_model");
	}

	public function index()
	{
		$fechainicio = $this->input->post("fechainicio");
		$fechafin = $this->input->post("fechafin");
		if($this->input->post("buscar")){
			$ventas = $this->Ventas_model->getVentasbyDate($fechainicio,$fechafin);
		}else{
			$ventas = $this->Ventas_model->getVentas();
		}
		$data  = array(
			'ventas' => $ventas,
			'fechainicio'  => $fechainicio,
			'fechafin'  => $fechafin
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/reportes/ventas",$data);
		$this->load->view("layouts/footer");
	}

	public function add(){
		$data = array(
			'tipocomprobantes' => $this->Ventas_model->getComprobantes(),
			'clientes' => $this->Clientes_model->getClientes()
		); 
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/ventas/add',$data);
		$this->load->view('layouts/footer');
	}

	public function getproductos(){
		$valor = $this->input->post("valor");
		$clientes = $this->Ventas_model->getproductos($valor);
		echo json_encode($clientes);
	}

	public function store(){

		$fecha = $this->input->post('fecha');
		$subtotal = $this->input->post('subtotal');
		$igv = $this->input->post('igv');
		$descuento = $this->input->post('descuento');
		$total = $this->input->post('total');
		$idcomprobante = $this->input->post('idcomprobante');
		$idcliente = $this->input->post('idcliente');
		$idusuario = $this->session->userdata('id');
		$numero = $this->input->post('numero');
		$serie = $this->input->post('serie');

		$idproductos = $this->input->post('idproductos');
		$precios = $this->input->post('precios');
		$cantidades = $this->input->post('cantidades');
		$importes = $this->input->post('importes');
		
		$data = array(
				'fecha' => $fecha
				,'subtotal' => $subtotal
				,'igv' => $igv
				,'descuento' => $descuento
				,'total' => $total
				,'tipo_comprovante_id' => $idcomprobante
				,'cliente_id' => $idcliente
				,'usuario_id' => $idusuario
				,'num_documento' => $numero
				,'serie' => $serie
			 );

		if ($this->Ventas_model->save($data)) {
			$idventa = $this->Ventas_model->lastID();
			$this->updateComprobante($idcomprobante);
			$this->save_detalle($idproductos,$idventa,$precios,$cantidades,$importes);

			redirect(base_url().'movimientos/ventas');
		}else{
			redirect(base_url()."movimientos/ventas/add");
		}
	}

	protected function updateComprobante($idcomprobante){
		$comprobanteActual = $this->Ventas_model->getComprobante($idcomprobante);
		$data = array('cantidad' => $comprobanteActual->cantidad + 1 
				);
		$this->Ventas_model->updateComprobante($idcomprobante,$data);
	}

	protected function save_detalle($productos,$idventa,$precios,$cantidades,$importes){
		for($i=0; $i < count($productos); $i++){
			$data = array('producto_id' => $productos[$i]
						,'venta_id' => $idventa
						,'precio' => $precios[$i]
						,'cantidad' => $cantidades[$i]
						,'importe' => $importes[$i]
					);
			$this->Ventas_model->save_detalle($data);
			
			$this->updateProducto($productos[$i],$cantidades[$i]);
		}
	}

	protected function updateProducto($idproducto,$cantidad){
		$productoActual = $this->Productos_model->getproducto($idproducto);
		
		$data = array(
			'stock' => $productoActual->stock - $cantidad
		);
		$this->Productos_model->update($idproducto,$data);
	}

	public function view(){
		$idventa = $this->input->post("id");
		$data = array(
			'venta' => $this->Ventas_model->getVenta($idventa)
			,'detalles' => $this->Ventas_model->getDetalle($idventa)
		);
		$this->load->view('admin/ventas/view', $data);
	}

	public function edit($id){
		$data = array(
			'producto' => $this->Productos_model->getProducto($id),
			'categorias' => $this->Categorias_model->getCategorias()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/productos/edit',$data);
		$this->load->view('layouts/footer');
	}

	public function update(){
		$idProducto = $this->input->post('idproducto');
		$codigo = $this->input->post('codigo');
		$nombre = $this->input->post('nombre');
		$descripcion = $this->input->post('descripcion');
		$precio = $this->input->post('precio');
		$stock = $this->input->post('stock');
		$categoria = $this->input->post('categoria');

		$productoActual = $this->Productos_model->getProducto($idProducto);
		if($codigo == $productoActual->codigo){
			$unique = '';
		}else{
			$unique = '|is_unique[productos.codigo]';
		}

		$this->form_validation->set_rules('codigo', 'Codigo', 'required'.$unique);
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('precio', 'Precio', 'required');
		$this->form_validation->set_rules('stock', 'Stock', 'required');

		if ($this->form_validation->run()) {
			$data = array(
				'codigo' => $codigo
				,'nombre' => $nombre
				,'descripcion' => $descripcion
				,'precio' => $precio
				,'stock' => $stock
				,'categoria_id' => $categoria
			);

			if($this->Productos_model->update($idProducto,$data)){
				redirect(base_url().'mantenimiento/productos');
			}else{
				$this->session->set_flashdata('error', 'No se pudo actualizar sorry :(');
				redirect(base_url().'mantenimiento/categorias/edit/'.$idProducto);
			}
		}else{
			$this->edit($idProducto);
		}

		
	}

	public function delete($id){
		$data = array(
			'estado' => 'N'
			 );
		$this->Productos_model->update($id,$data);
		echo "mantenimiento/productos";
	}
}
