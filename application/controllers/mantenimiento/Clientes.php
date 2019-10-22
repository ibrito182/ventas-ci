<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model("Clientes_model");
	}

	public function index()
	{
		$data = array(
			'clientes' => $this->Clientes_model->getClientes()
		);
		
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/clientes/list',$data);
		$this->load->view('layouts/footer');
	}
	
	public function add(){
		$data = array(
			'tipoclientes' => $this->Clientes_model->getTipoClientes(),
			'tipodocumentos' => $this->Clientes_model->getTipoDocumentos()
		);
		$this->load->view('layouts/header');
		$this->load->view('layouts/aside');
		$this->load->view('admin/clientes/add',$data);
		$this->load->view('layouts/footer');
	}
	
	public function store(){

		$nombre = $this->input->post("nombre");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocliente = $this->input->post("tipocliente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");

		$data  = array(
			'nombre' => $nombre, 
			'tipo_documento_id' => $tipodocumento,
			'tipo_cliente_id' => $tipocliente,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'num_documento' => $num_documento,
			'estado' => "S"
		);

		if ($this->Clientes_model->save($data)) {
			redirect(base_url()."mantenimiento/clientes");
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."mantenimiento/clientes/add");
		}
	}

	public function edit($id){
		$data  = array(
			'cliente' => $this->Clientes_model->getCliente($id), 
			"tipoclientes" => $this->Clientes_model->getTipoClientes(),
			"tipodocumentos" => $this->Clientes_model->getTipoDocumentos()
		);
		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/clientes/edit",$data);
		$this->load->view("layouts/footer");
	}

	public function update(){
		$idcliente = $this->input->post("idcliente");
		$nombre = $this->input->post("nombre");
		$tipodocumento = $this->input->post("tipodocumento");
		$tipocliente = $this->input->post("tipocliente");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$num_documento = $this->input->post("numero");


		$data = array(
			'nombre' => $nombre, 
			'tipo_documento_id' => $tipodocumento,
			'tipo_cliente_id' => $tipocliente,
			'direccion' => $direccion,
			'telefono' => $telefono,
			'num_documento' => $num_documento,
		);

		if ($this->Clientes_model->update($idcliente,$data)) {
			redirect(base_url()."mantenimiento/clientes");
		}
		else{
			$this->session->set_flashdata("error","No se pudo actualizar la informacion");
			redirect(base_url()."mantenimiento/clientes/edit/".$idcliente);
		}

	}
	
	public function view($id){
		$data = array(
			'categoria' => $this->Clientes_model->getCliente($id)
			 );
		$this->load->view('admin/cliente/view', $data);
	}
	public function delete($id){
		$data = array(
			'estado' => 'N'
			 );
		$this->Clientes_model->update($id,$data);
		echo "mantenimiento/clientes";
	} 
}
?>