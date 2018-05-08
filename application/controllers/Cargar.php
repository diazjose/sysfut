<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargar extends CI_Controller {

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
	public function cargar_equ($id_torneo)
	{
				
		$this->load->model('fixtur');
		$this->load->model('equipo');
		$this->load->model('torn');


		$torneo = $this->torn->buscar_torneo($id_torneo);
		$equipo = $this->equipo->equipos_todos();


		$cant = $torneo->cantidad_equipos; 

		$data = array('cantidad' => $cant, 'torneo' => $id_torneo, 'equipos' => $equipo);

		$this->load->view('estructura/head');
		$this->load->view('equipos/cargar_equipos', $data);


	}
	
}
