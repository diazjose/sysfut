<?php

class Fixtur extends CI_Model {

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
	public function part_fecha($equipo = '',$torneo = '', $fecha = ''){

		$resultado = $this->db->where('id_torneo', $torneo);
		$resultado = $this->db->where('id_equipo1', $equipo);
		$resultado = $this->db->where('numero_fecha', $fecha);
		$resultado = $this->db->get('partido_torneo');

		$resultado1 = $this->db->where('id_torneo', $torneo);
		$resultado1 = $this->db->where('id_equipo2', $equipo);
		$resultado1 = $this->db->where('numero_fecha', $fecha);
		$resultado1 = $this->db->get('partido_torneo');

		if ($resultado->num_rows() >= 1) {
			$valor = 1;
		}
		else{
			
			if ($resultado1->num_rows() >= 1) {
				$valor = 1;	
			}
			else{

				$valor = 0;
			}
		}	

		//$resultado = $this->db->query("SELECT * FROM partido_torneo	
		//									 WHERE id_torneo = '$torneo'  
		//									 	AND id_equipo1 = '$equipo1' 
		//									 		AND numero_fecha = '$fecha'");
		return $valor;
		//return $resultado->row();

	}

	public function partido_gurdado($equipo1 = '', $equipo2 = '', $torneo = ''){

		$resultado = $this->db->where('id_torneo', $torneo);
		$resultado = $this->db->where('id_equipo1', $equipo1);
		$resultado = $this->db->where('id_equipo2', $equipo2);
		$resultado = $this->db->get('partido_torneo');

		$resultado1 = $this->db->where('id_torneo', $torneo);
		$resultado1 = $this->db->where('id_equipo1', $equipo2);
		$resultado1 = $this->db->where('id_equipo2', $equipo1);
		$resultado1 = $this->db->get('partido_torneo');

		if ($resultado->num_rows() >= 1) {
			$valor = 1;
		}
		else{
			
			if ($resultado1->num_rows() >= 1) {
				$valor = 1;	
			}
			else{

				$valor = 0;
			}
		}	

		//$resultado = $this->db->query("SELECT * FROM partido_torneo	
		//									 WHERE id_torneo = '$torneo'  
		//									 	AND id_equipo1 = '$equipo1' 
		//									 		AND numero_fecha = '$fecha'");
		return $valor;
		//return $resultado->row();



	}

	public function sacar_id($torneo = '', $equipo = ''){

		$resultado = $this->db->where('id_torneo', $torneo);
		$resultado = $this->db->where('orden', $equipo);
		$resultado = $this->db->get('equipo_torneo');
		
		return $resultado->row();


	}

	public function cargar_partido($torneo = '', $equipo1 = '', $equipo2 = '', $fecha = ''){

		$insert = array('id_torneo' => $torneo,
						    'id_equipo1' => $equipo1,
			   				'id_equipo2' => $equipo2,
			   				'numero_fecha' => $fecha );
		
		$this->db->insert('partido_torneo', $insert);	

	}

	public function libre($fecha, $torneo){

		$resultado = $this->db->query("SELECT * FROM partido_torneo 
										WHERE numero_fecha = $fecha 
											AND id_torneo = $torneo
												AND (id_equipo1 = 30
													OR id_equipo2 = 30)");
		
		return $resultado->row();

	}

	public function mostrar_fixture($fecha, $torneo){

		$resultado = $this->db->query("SELECT * FROM partido_torneo 
										WHERE numero_fecha = $fecha 
											AND id_torneo = $torneo 
												AND id_equipo1  <> 30 
													AND id_equipo2 <> 30");
		
		return $resultado;

	}
	
	public function fixture_mostrar($fecha = '', $torneo = ''){

		$resultado = $this->db->where('numero_fecha', $fecha);
		$resultad1 = $this->db->where('id_torneo', $torneo);

		$query = $this->db->order_by("id_partido_torneo","DESC");
		
		$resultado = $this->db->get('partido_torneo');

		return $resultado;

	}


	public function torneo_equipos($id){

		$resultado = $this->db->where('id_torneo', $id);
		$resultado = $this->db->get('partido_torneo');
		return $resultado;

	}
}
