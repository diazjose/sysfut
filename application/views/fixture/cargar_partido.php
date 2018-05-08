	<div class="container">
		
			<table class="table table-bordered table-responsive">
	  			<thead>
	   			   <tr class="success">
	   			      <th colspan = '6' class="text-center">
	   			      		Fecha <?= $fecha ?> 
	   			      		<?php if ($libre) {?>
	   			      					libre: <?= $libre->nombre_equipo ?>
	   			      			<?php
	   			      			  }?> 
	   			      </th>
	    		   </tr>	
	 			</thead>

	 			<tbody>

			<?php 

				$invertir = 0;

				if ($resultado == 0) {
					$i = 1;
					?>					
					<form action="<?= base_url() ?>torneo/guardar_resultado" method="POST">
					<?php					
					foreach ($partidos->result() as $partido) {

						$this->load->model('equipo');
						
						if ($invertir == 0) {
							
							$equipo1 = $this->equipo->buscar_equ($partido->id_equipo1);
							$gol1 = $partido->equipo1_gol;
							$equipo2 = $this->equipo->buscar_equ($partido->id_equipo2);
							$gol2 = $partido->equipo2_gol;
							$invertir = 1;

						}
						else{

							$equipo1 = $this->equipo->buscar_equ($partido->id_equipo2);
							$gol1 = $partido->equipo2_gol;
							$equipo2 = $this->equipo->buscar_equ($partido->id_equipo1);
							$gol2 = $partido->equipo1_gol;
							$invertir = 0;

						}?>						
						
							
							<tr> 

								<td class="col-md-4 text-center"><?= $equipo1->nombre_equipo ?></td> 
								<td class="col-md-1 text-center"><input type="hidden" name="id_equipo1<?= $i ?>" value="<?= $equipo1->id ?>"><input type="number" name="gol_equipo1<?= $i ?>"></td>
								<td class="col-md-1 text-center">VS</td>
								<td class="col-md-1 text-center"><input type="hidden" name="id_equipo2<?= $i ?>" value="<?= $equipo2->id ?>"><input type="number" name="gol_equipo2<?= $i ?>"></td>
								<td class="col-md-4 text-center"><input type="hidden" name="partido<?= $i ?>" value="<?= $partido->id_partido_torneo ?>"><?= $equipo2->nombre_equipo ?></td>								
							</tr>
							
													
						<?php	
						
						$i++;	
					}?>
						<input type="hidden" name="cantidad" value="<?= $i ?>">
						<input type="hidden" name="torneo" value="<?= $torneo ?>">
						<br>
						<input type="submit" value="Cargar" class="btn btn-primary btn-block">
					</form>	
				<?php
				}else{
					
					foreach ($partidos->result() as $partido) {

						$this->load->model('equipo');
						
						if ($invertir == 0) {
							
							$equipo1 = $this->equipo->buscar_equ($partido->id_equipo1);
							$gol1 = $partido->equipo1_gol;
							$equipo2 = $this->equipo->buscar_equ($partido->id_equipo2);
							$gol2 = $partido->equipo2_gol;
							$invertir = 1;

						}
						else{

							$equipo1 = $this->equipo->buscar_equ($partido->id_equipo2);
							$gol1 = $partido->equipo2_gol;
							$equipo2 = $this->equipo->buscar_equ($partido->id_equipo1);
							$gol2 = $partido->equipo1_gol;
							$invertir = 0;

						}?>						
							<tr> 

								<td class="col-md-4 text-center"><?= $equipo1->nombre_equipo ?></td> 
								<td class="col-md-1 text-center"><?= $gol1 ?></td>
								<td class="col-md-1 text-center">VS</td>
								<td class="col-md-1 text-center"><?= $gol2 ?></td>
								<td class="col-md-4	 text-center"><?= $equipo2->nombre_equipo ?></td>
								<?php
								if ($partido->resultado == 1) {?>
									<td class="text-center">
										<a data-toggle="modal" data-target="#editar_partido" 
												onclick="selPartido('<?= $partido->id_partido_torneo ?>',
																   '<?= $equipo1->nombre_equipo ?>',
																   '<?= $partido->id_equipo1 ?>',
																   '<?= $gol1 ?>',
																   '<?= $gol2 ?>',
																   '<?= $partido->id_equipo2 ?>',
																   '<?= $equipo2->nombre_equipo ?>',
																   '<?= $torneo ?>')" 
												class="btn btn-sm btn-primary">Edit
										</a>
									</td>
								<?php
								}
								?>
							</tr>
						
													
						<?php							
					}?>		
				<?php
				}?>
	    		</tbody>
			</table><br>
		
	</div>		


	<div id="editar_partido" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Editar Partido</h4>
	      </div>
	      <div class="modal-body">
	      	
		        <form role="form" name="formedit" id="formedit" action="<?= base_url() ?>torneo/editar_partido" method="post">	

					<div class='form-group'>
						<input type="hidden" name="id_partido" id="id_partido" value="" class="form-control">
					</div>

					<div class='form-group'>
						<input type="hidden" name="torneo" id="torneo" value="" class="form-control">
					</div>

					<div class='form-group'>
						<input type="hidden" name="id_equipo1" id="id_equipo1" value="" class="form-control">
					</div>
					<div class='form-group'>
						<input type="hidden" name="id_equipo2" id="id_equipo2" value="" class="form-control">
					</div>

					<div class='form-group'>
						<label>Equipo </label>
						<input type="text" name="equipo1" disabled="" id="equipo1" class="form-control" value=""><br>
					</div>

					<div class='form-group'>
						<input type="text" name="gol_equ1" id="gol_equ1" class="form-control" value=""><br>
					</div>

					<div class='form-group'>
						<label>Equipo </label>
						<input type="text" name="equipo2" disabled="" id="equipo2" class="form-control" value=""><br>
					</div>

					<div class='form-group'>
						<input type="text" name="gol_equ2" id="gol_equ2" class="form-control" value=""><br>
					</div>
					
					<div class='form-group'>					
						<input  class="btn btn-primary" type="submit" value="EDITAR">	
					</div>
						
				</form>
	        
	      </div>
	     
	    </div>

	  </div>
	</div>

<script type="text/javascript">
	
	function selPartido(id, nombre1, id_equipo1, gol1, gol2, id_equipo2, nombre2, torneo){

			document.getElementById('id_partido').value=id;
			document.getElementById('id_equipo1').value=id_equipo1;
			document.getElementById('id_equipo2').value=id_equipo2;
			document.getElementById('equipo1').value=nombre1;
			document.getElementById('equipo2').value=nombre2;
			document.getElementById('gol_equ1').value=gol1; 
			document.getElementById('gol_equ2').value=gol2; 
			document.getElementById('torneo').value=torneo; 
		
		}

</script>