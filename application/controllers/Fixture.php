<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fixture extends CI_Controller {

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
	public function fixture_generar($tor)
	{
		$this->load->model('fixtur');
		$this->load->model('equipo');
		$this->load->model('torn');

		$this->load->view('estructura/head');

		$torneo = $this->torn->buscar_torneo($tor);

		if ($torneo->cantidad_equipos%2==0) {
			$cant = $torneo->cantidad_equipos;	
		}else{	
			$cant = $torneo->cantidad_equipos+1;
		}
		 
	
		$cant_fechas = $cant - 1;

		$cant_equipos = $cant/2;


		$cant_equipos1 = $cant_equipos - 1;

		$e = 2;

		for ($i = 0; $i < $cant_equipos; $i++) { 
				
			$equipo[] = $e;
			$e++;

		}

		for ($i=0 ; $i < $cant_equipos1 ; $i++ ) { 
			

			$equipo1[] = $e;
			$e++;

		}

		$seg_equipo = array_reverse($equipo1);

		for ($i=1; $i <= $cant_fechas; $i++) { 
			
			foreach ($equipo as $e1) {
				
				$one = 1;

				$uno = $this->fixtur->sacar_id($torneo->id_torneo, $one);

				$consulta = $this->fixtur->part_fecha($uno->id_equipo, $torneo->id_torneo, $i);
				
				if ($consulta == 1) {
					
					$idequipo = $this->fixtur->sacar_id($torneo->id_torneo, $e1);
					
					foreach ($seg_equipo as $e2) {

						$consulta1 = $this->fixtur->part_fecha($idequipo->id_equipo, $torneo->id_torneo, $i);
						
						$idequipo1 = $this->fixtur->sacar_id($torneo->id_torneo, $e2);

						$consulta2 = $this->fixtur->part_fecha($idequipo1->id_equipo, $torneo->id_torneo, $i);
						
						if ($consulta1 == 0 and $consulta2 == 0) {
							
							$consulta3 = $this->fixtur->partido_gurdado($idequipo->id_equipo, $idequipo1->id_equipo, $torneo->id_torneo);
							
							if ($consulta3 == 0) {								
								
								$this->fixtur->cargar_partido($torneo->id_torneo, $idequipo->id_equipo, $idequipo1->id_equipo, $i);

							}
							
						}
											
					}
						

				}
				else{

					$idequipo = $this->fixtur->sacar_id($torneo->id_torneo, $e1);

					$consulta2 = $this->fixtur->partido_gurdado($uno->id_equipo, $idequipo->id_equipo, $torneo->id_torneo);
					
					if ($consulta2 == 0) {

						$this->fixtur->cargar_partido($torneo->id_torneo, $uno->id_equipo, $idequipo->id_equipo, $i);
					
					}
					
				}

			}

			$ultimo = array_pop($equipo);

			$insertar_ultimo = array_push($seg_equipo, $ultimo);
 
			$primero = array_shift($seg_equipo);

			$insertar_principio = array_unshift($equipo, $primero);	
			
		}
		redirect('fixture/mostrar_fixture/'.$tor);
	}

	public function mostrar_fixture($tor)
	{

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

		for ($i=1; $i < $cant; $i++) { 

			$resultado = $this->fixtur->mostrar_fixture($i, $tor);
			$libre	= $this->fixtur->libre($i, $tor);

			
					
			if ($libre) {
				if ($libre->id_equipo1 == 30) {				
					$lib = $this->equipo->buscar_equ($libre->id_equipo2);
					
				}else{
					$lib = $this->equipo->buscar_equ($libre->id_equipo1);
				}
				$data = array('fecha' => $i, 'libre' => $lib, 'partidos' => $resultado);
			}else{
				$data = array('fecha' => $i, 'libre' => '', 'partidos' => $resultado);
			}		
			
			$this->load->view('fixture/mostrar_fixture', $data);

		}

		$this->load->view('estructura/pie');
		
	}

	public function reporte_fixture(){

		$this->load->model('fixtur');
		$this->load->model('equipo');

		$tor = 7;

		$cant = $this->equipo->cant_fecha($tor);

		$invertido = 0;

		for ($i=1; $i < $cant; $i++) { 
			
			if ($invertido == 0) {

				$resultado = $this->fixtur->mostrar_fixture($i, $tor);

				$data = array('fecha' => $i, 'partidos' => $resultado);
		
				$this->load->view('fixture/mostrar_fixture', $data);

				$invertido = 1;

			}
			else{

				$resultado = $this->fixtur->fixture_mostrar($i, $tor);

				$data = array('fecha' => $i, 'partidos' => $resultado);
		
				$this->load->view('fixture/mostrar_fixture', $data);

				$invertido = 0;


			}
			
		}?>

			<center>
			<br><br>
			<a href="<?= base_url() ?>reporte/fixture">PDF >> </a>
			</center>
		<?php	

		$this->load->view('estructura/pie');

	}
	
}
