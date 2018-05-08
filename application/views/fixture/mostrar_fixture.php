	<div class="container">
		
			<table class="table table-bordered table-responsive">
	  			<thead>
	   			   <tr class="success">
	   			      <th colspan = '3' class="text-center">
	   			      		Fecha <?= $fecha ?> <?php if ($libre) {?>
	   			      										libre: <?= $libre->nombre_equipo ?>
	   			      										<?php
	   			      								  }?> 
	   			      </th>
	    		   </tr>	
	 			</thead>

			<?php 

				$invertir = 0;

				foreach ($partidos->result() as $partido) {

					$this->load->model('equipo');

					$equipo1 = $this->equipo->buscar_equ($partido->id_equipo1);
					$equipo2 = $this->equipo->buscar_equ($partido->id_equipo2);
/*
					if ($invertir == 0) {
						
						$equipo1 = $this->equipo->buscar_equ($partido->id_equipo1);
						$equipo2 = $this->equipo->buscar_equ($partido->id_equipo2);
						$invertir = 1;

					}
					else{

						$equipo1 = $this->equipo->buscar_equ($partido->id_equipo2);
						$equipo2 = $this->equipo->buscar_equ($partido->id_equipo1);
						$invertir = 0;

					}

*/					
					?>
				<tbody>	
					<tr> 

						<td class="col-md-5 text-center"><?= $equipo1->nombre_equipo ?></td> 
						<td class="col-md-2 text-center">VS</td>
						<td class="col-md-5 text-center"><?= $equipo2->nombre_equipo ?></td>

					</tr>
				</tbody>
			
			<?php	
				}?>
	    
			</table><br>
		
	</div>		
