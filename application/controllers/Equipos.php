<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipos extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){

		$this->load->view('estructura/head');
		$this->load->view('equipos/equipos_cargar');


	}

	public function equipo_cargar(){

		$this->load->model('equipo');

		$equipo = $this->equipo->equipos_todos();

		$nombre = $this->input->post('nombre');
		$data['equipos'] = $equipo;	
		$resultado = $this->equipo->buscar_equipo($nombre);

		if ($resultado == null) {
			
			$categoria = $this->input->post('categoria');	
			$fecha = date('Y-m-d');
			$estado = 1;

			$this->equipo->equipo_cargar($nombre, $categoria, $fecha, $estado);
 			
 			$resultado = $this->equipo->equipos_todos();
			$data['equipos'] = $resultado;


			$this->load->view('estructura/head');
			$this->load->view('equipos/lista_equipo', $data);
	


		}
		else{
			echo "<h2>Este Equipo ya Existe en la Base de Datos</h2>";
		}

	}

	public function lista_equipo(){
		
		$this->load->model('equipo');
		$resultado = $this->equipo->equipos_todos();
		$data['equipos'] = $resultado;
		$data['equipo'] = '';


		$this->load->view('estructura/head');
		$this->load->view('equipos/lista_equipo', $data);

	}

	public function buscar_equipo(){

		$this->load->model('equipo');

		$nombre = $this->input->post('query');
		$equipo = $this->equipo->buscar_equipo($nombre);
		//$resultado = $this->equipo->equipos_todos();
		$data['equipo'] = $equipo;
		$data['equipos'] = '';


		$this->load->view('estructura/head');
		$this->load->view('equipos/lista_equipo', $data);


	}

	public function editar($id){

		$this->load->model('equipo');

		$equipo = $this->equipo->buscar_equ($id);

		$data['equipo'] = $equipo;

		$this->load->view('estructura/head');
		$this->load->view('equipos/editar_equipo', $data);

	}

	public function editar_equipo(){

		$this->load->model('equipo');	

		if ($this->input->post()) {
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$fecha_ingreso = $this->input->post('fecha_ingreso');
			$categoria = $this->input->post('categoria');
			$estado = $this->input->post('estado');

			$this->equipo->update_equipo($id, $nombre, $fecha_ingreso, $categoria, $estado);
		}

		$data['equipos'] = $this->equipo->equipos_todos();	
		$this->load->view('estructura/head');
		$this->load->view('equipos/lista_equipo', $data);

	}

	public function activar($id){

		$this->load->model('equipo');

		$this->equipo->activar($id);

		$resultado = $this->equipo->equipos_todos();
		$data['equipos'] = $resultado;


		$this->load->view('estructura/head');
		$this->load->view('equipos/lista_equipo', $data);

	}
}
