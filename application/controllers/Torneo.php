<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Torneo extends CI_Controller {

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
	public function index()
	{
		$this->load->model('torn');
		$this->load->model('fixtur');

		if ($this->input->post()) {
			
			$post = $this->input->post();

			$fecha = $post['fecha'];	
			$resultado = $this->torn->torneo_fecha($fecha);
			$data['torneo'] = $resultado;	
			$data['fecha'] = $fecha;		
			
			$this->load->view('estructura/head');
			$this->load->view('torneo/buscar', $data);

		}
		else{

			$resultado = $this->torn->buscar_todos();
			$data = array('torneo' => $resultado, 'fecha' => '' );
			$this->load->view('estructura/head');
			$this->load->view('torneo/buscar', $data);	
			
			
		}

	}

	public function cargar_torneo(){

		$this->load->model('torn');
		$this->load->model('fixtur');
		
		if ($this->input->post()) {
			
			$post = $this->input->post();

			$nombre = $post['nombre'];
			$fecha = $post['fecha'];
			$cant_equipos = $post['cant_equipos'];

			$fecha1 = strtotime($fecha);
			$anio = date('Y',$fecha1);
			
			$this->torn->cargar_torneo($nombre, $fecha, $cant_equipos, $anio);

		}
		
		redirect('torneo');

	}

	public function editar_torneo(){

		$this->load->model('torn');
		
		if ($this->input->post()) {
			
			$id_torneo = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$fecha_inicio = $this->input->post('fecha_inicio');
			$cantidad = $this->input->post('cantidad');

			$this->torn->edit_torneo($id_torneo, $nombre, $fecha_inicio, $cantidad);
		}		

		redirect('torneo');			

	}

	public function eliminar($id){

		$this->load->model('torn');
		$this->load->model('fixtur');

		$partidos = $this->fixtur->torneo_equipos($id);
		$equipos = $this->torn->equipos_torneo($id);

		if ($partidos) {
			foreach ($partidos->result() as $partido) {
				
				$this->torn->elim_partidos($partido->id_partido_torneo);	
			}
		}
		
		if ($equipos) {
			foreach ($equipos->result() as $equipo) {
				
				$this->torn->elim_partidos($equipo->id_equipo_torneo);	
			}
		}
		
		$this->torn->eliminar($id);	

		redirect('torneo');
	}

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

	public function fecha($tor){

		$this->load->model('torn');
		$this->load->model('equipo');

		$cant = $this->torn->buscar_torneo($tor);
		$equipo = $this->equipo->equipos_todos();

		$data = array('cantidad' => $cant, 'equipos' => $equipo);
		$this->load->view('estructura/head');
		$this->load->view('fixture/carga_fecha', $data);

	}

	public function equipos_torneo(){

		$this->load->model('equipo');
				
		if ($this->input->post()) {
			
			$post = $this->input->post();
			$torneo = $post['torneo'];
			
			if ($post['cant']%2!=0) {
				$cant = $post['cant']+1;
			}else{
				$cant = $post['cant'];
			}	
			
			for ($i=1; $i <= $cant; $i++) { 
				
				$orden = $post['orden'.$i];
				$equipo = $post['equipo'.$i];
				
				$this->equipo->cargar_equipo($torneo, $equipo, $orden);
				
			}
	
		}
		redirect(base_url('fixture/fixture_generar/'.$torneo));

	}

	public function cargar_fecha($tor){

		$this->load->model('fixtur');
		$this->load->model('torn');
		$this->load->model('equipo');

		$cant = $this->equipo->cant_fecha($tor);

		$fixt = $this->fixtur->torneo_equipos($tor);
		$equipos = $this->torn->equipos_torneo($tor);

		$data['torneo'] = $this->torn->buscar_torneo($tor);	
		$data['tor'] = $tor;
		$data['equipos'] = $equipos;
		$data['fixture'] = $fixt;

		$this->load->view('estructura/head');
		$this->load->view('torneo/view_torneo', $data);

		$invertido = 0;
		$si = 0;
		
		for ($i=1; $i < $cant; $i++) { 

			$resultado = $this->fixtur->mostrar_fixture($i, $tor);
			$libre	= $this->fixtur->libre($i, $tor);

			if ($si == 0) {
				foreach ($resultado->result() as $part_result) {
					if ($part_result->resultado == 0) {
						$result = 0;
						$si = 1;
					}else{
						$result = 1;
					}
				}
			}else{
				$result = 1;
			}
			
								
			if ($libre) {
				if ($libre->id_equipo1 == 30) {				
					$lib = $this->equipo->buscar_equ($libre->id_equipo2);
					
				}else{
					$lib = $this->equipo->buscar_equ($libre->id_equipo1);
				}				

				$data = array('torneo' => $tor,'fecha' => $i, 'libre' => $lib, 'partidos' => $resultado, 'resultado' => $result);
			}else{
				$data = array('torneo' => $tor,'fecha' => $i, 'libre' => '', 'partidos' => $resultado, 'resultado' => $result);
			}		
			
			$this->load->view('fixture/cargar_partido', $data);
						
		}

		$this->load->view('estructura/pie');
		
		

	}

	public function guardar_resultado(){
		
		if ($this->input->post()) {
			
			$this->load->model('torn');

			$e = $this->input->post('cantidad');
			
			for ($i=1; $i < $e; $i++) { 
				
				$partido = $this->input->post('partido'.$i);
				$equipo1 = $this->input->post('id_equipo1'.$i);
				$equipo2 = $this->input->post('id_equipo2'.$i);
				$gol1 = $this->input->post('gol_equipo1'.$i);
				$gol2 = $this->input->post('gol_equipo2'.$i);
				$torneo = $this->input->post('torneo');
				
				$resultado = $this->torn->equipos($partido);
				
				if ($resultado->id_equipo1 == $equipo1) {
					$this->torn->cargar_resultado($partido, $equipo1, $gol1, $equipo2, $gol2);
				}else{
					$this->torn->cargar_resultado($partido, $equipo2, $gol2, $equipo1, $gol1);
				}						

			}

			redirect(base_url('torneo/cargar_fecha/'.$torneo));

		}

	}

	public function tabla($tor){

		$this->load->model('torn');
		$this->load->model('equipo');
		
		$resultado = $this->torn->equipos_torneo($tor);
		$i = 1;
		foreach ($resultado->result() as $e) {
			
			$equipo = $e->id_equipo;	
			
			$partidos = $this->torn->puntos_equipo($tor, $equipo);
			
			$puntos_equipo = 0;
			$gol_favor = 0;
			$gol_contra = 0;
			$part = 0; 

			foreach ($partidos->result() as $partido) {
				$part = $part + 1;
				
				if ($partido->ganador == $equipo) {
					$puntos_equipo = $puntos_equipo + 3;
				}else{
					if ($partido->ganador = 0) {
						$puntos_equipo = $puntos_equipo +1;
					}
				}
			
				if ($partido->id_equipo1 == $equipo) {
					$gol_favor = $gol_favor + $partido->equipo1_gol;
					$gol_contra = $gol_contra + $partido->equipo2_gol;
				}else{
					$gol_favor = $gol_favor + $partido->equipo2_gol;
					$gol_contra = $gol_contra + $partido->equipo1_gol;
				}				
			}

			$eq = $this->equipo->buscar_equ($equipo);

			$dif = $gol_favor - $gol_contra;
			$equi = array('nombre' => $eq->nombre_equipo,
						  'puntos' => $puntos_equipo,
						  'gol_favor' => $gol_favor,
						  'gol_contra' =>$gol_contra, 
						  'partido' => $part,
						  'diferencia' => $dif);

			$equipos['equipo'.$i] = $equi;
			$i++;
		}	

		foreach ($equipos as $key => $row) {
		    $puntos[$key] = $row['puntos'];
		    $diferencia[$key] = $row['diferencia'];
		}

		array_multisort($puntos, SORT_DESC, $diferencia, SORT_DESC, $equipos);
		$torneo = $this->torn->buscar_torneo($tor);
		$data = array('equipos' => $equipos, 'torneo' => $torneo);

		$this->load->view('estructura/head');
		$this->load->view('torneo/tabla_posiciones',$data);
		$this->load->view('estructura/pie');		
	}

	public function editar_partido(){

		$this->load->model('torn');
		
		if ($this->input->post()) {
			
			$partido = $this->input->post('id_partido');
			$equipo1 = $this->input->post('id_equipo1');
			$equipo2 = $this->input->post('id_equipo2');
			$gol1 = $this->input->post('gol_equ1');
			$gol2 = $this->input->post('gol_equ2');
			$torneo = $this->input->post('torneo');

			//echo $partido." ".$equipo1." ".$equipo2."  ".$gol1." ".$gol2." ".$torneo;

			$this->torn->cargar_resultado($partido, $equipo1, $gol1, $equipo2, $gol2);

		}
		redirect('torneo/cargar_fecha/'.$torneo);
	}


}
