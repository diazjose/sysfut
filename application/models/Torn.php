<?php

	/**
	* 
	*/
	class Torn extends CI_Model
	{
		
		public function buscar_torneo($id){

			$resultado = $this->db->where('id_torneo', $id);
			$resultado = $this->db->get('torneo');

			return $resultado->row();


		}		

		public function torneo_fecha($anio){

			$resultado = $this->db->where('anio', $anio);
			$resultado = $this->db->get('torneo');

			return $resultado;

		}

		public function buscar_todos(){

			$resultado = $this->db->order_by('fecha_inicio', 'DESC');
			$resultado = $this->db->get("torneo");

			return $resultado;

		}

		public function cargar_torneo($nombre, $fecha, $cant_equipos, $anio){

			$insert = array('nombre_torneo' => $nombre,
						    'fecha_inicio' => $fecha,
						    'cantidad_equipos' => $cant_equipos,
						    'anio' => $anio);
		
			$this->db->insert('torneo', $insert);	


		}

		public function equipos_torneo($id_torneo){
			
			$resultado = $this->db->where('id_torneo', $id_torneo);
			$resultado = $this->db->get('equipo_torneo');
			return $resultado;


		}

		public function edit_torneo($id, $nombre, $fecha_inicio, $cantidad){

			$update = array('nombre_torneo' => $nombre,
							'fecha_inicio' => $fecha_inicio,
							'cantidad_equipos' => $cantidad
							);
			$this->db->where('id_torneo', $id);
			$this->db->update('torneo', $update);


		}

		public function elim_partidos($id){

			$this->db->where('id_partido_torneo', $id);
			$this->db->delete('partido_torneo');

		}

		public function elim_equipos($id){

			$this->db->where('id_equipo_torneo', $id);
			$this->db->delete('equipo_torneo');

		}

		public function eliminar($id){

			$this->db->where('id_torneo', $id);
			$this->db->delete('torneo');

		}

		public function equipos($id){

			$resultado = $this->db->where('id_partido_torneo', $id);
			$resultado = $this->db->get('partido_torneo');

			return $resultado->row();


		}

		public function cargar_resultado($partido, $equipo1, $gol1, $equipo2, $gol2){

			if ($gol1>$gol2) {
				$update = array('id_equipo1' => $equipo1,
								'equipo1_gol' => $gol1,
								'id_equipo2' => $equipo2,							
								'equipo2_gol' => $gol2,
								'resultado' => 1,
								'ganador' => $equipo1
								);
					
			}else{
				if ($gol2>$gol1) {
					$update = array('id_equipo1' => $equipo1,
								'equipo1_gol' => $gol1,
								'id_equipo2' => $equipo2,							
								'equipo2_gol' => $gol2,
								'resultado' => 1,
								'ganador' => $equipo2
								);				
				}else{
					$update = array('id_equipo1' => $equipo1,
								'equipo1_gol' => $gol1,
								'id_equipo2' => $equipo2,							
								'equipo2_gol' => $gol2,
								'resultado' => 1,
								'ganador' => 0
								);				
				}
				
			}
				$this->db->where('id_partido_torneo', $partido);
				$this->db->update('partido_torneo', $update);
			
		}

		public function puntos_equipo($torneo,$equipo){

			$resultado = $this->db->query("SELECT * FROM partido_torneo 
												WHERE id_torneo = $torneo
													AND resultado = 1
														AND id_equipo1 <> 30 
															AND id_equipo2 <> 30
																AND (id_equipo1 = $equipo 
																	OR id_equipo2 = $equipo)");
			return $resultado;

		}
		
	}


?>