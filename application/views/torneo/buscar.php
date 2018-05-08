	
	<div class="container text-center">
		<div class="row">
			<div class="col-md-12">		
			<div class="">
				<br><h2><strong>Buscar Campeonato</strong></h2><br>
			</div>
			<br>	
				<div class="col-md-6">
	                    <a  data-toggle="modal" data-target="#nuevo_torneo" class="btn btn-success">
	                        
	                            <i class="fa fa-fw fa-plus"></i> Nuevo torneo
	                        
	                    </a>
	           </div>

				<div class="row">
					<div class="col-md-6">	
						<form action="<?= base_url() ?>torneo" method="post" role="search" class="form-inline">	

							<div class="form-group">
								<input type="text" name="fecha" class="form-control" placeholder="Buscar por Año">
							</div>	

							<div class="form-group">
								<input class="btn btn-default" type="submit" value="Buscar">
							</div>
						</form>
					</div>	
				</div><br>
			<?php if ($fecha) {?>
			

						<h3>Torneos Encontrados en <?= $fecha ?></h3><br><br>
					
							
						<table class="table table-bordered table-hover">
				  			<tr class="well">
				   			    
				   			    <th>Nombre del Torneo</th>
								<th>Cantidad de Equipos</th>
								<th>Fecha de Inicio</th>
								<th>Fecha de Finalizacion</th>
								<th>Equipo Campeon</th>
								<th>Fixture</th>
								<th>Acciones</th>
								    			
				 			</tr>

						<?php 
							foreach ($torneo->result() as $tor) {?>
								
							<tr> 

								<td><center><?php echo $tor->nombre_torneo ?></center></td> 
								<td><center><?php echo $tor->cantidad_equipos ?></center></td>
								<?php
									$fecha = date("d-m-Y", strtotime($tor->fecha_inicio))
									
								?>
								<td><center><?php echo $fecha ?></center></td>
								<td><center>No se sabe</center></td>
								<td><center>No hay todavia</center></td>
								<?php 
									$this->load->model('fixtur');
									$this->load->model('torn');
									$equipos_tor = $this->torn->equipos_torneo($tor->id_torneo);
									$resultado = $this->fixtur->torneo_equipos($tor->id_torneo);
									if ($equipos_tor->num_rows() > 0) {
										
										if ($resultado->num_rows() > 0) {?>
											<td><center><a href="<?= base_url() ?>torneo/cargar_fecha/<?= $tor->id_torneo ?>">Ir</a></center></td>
										<?php 				
											}
											else{?>

												<td><center><a href="<?= base_url() ?>home/fixture_generar/<?= $tor->id_torneo ?>">Generar Fixture</a></center></td>
										<?php	
											}
										 
									}
									else{?>

										<td><center><a href="<?= base_url() ?>torneo/fecha/<?= $tor->id_torneo ?>">Cargar Equipos</a></center></td>
									<?php	
									}?>					
								<td class="text-center">
											<a href="<?= base_url() ?>fixture/mostrar_fixture/<?= $tor->id_torneo ?>" class="btn btn-sm btn-info">View</a>
			                                <a data-toggle="modal" data-target="#editar_torneo" onclick="selTorneo('<?= $tor->id_torneo ?>', '<?= $tor->nombre_torneo ?>', '<?= $tor->fecha_inicio ?>', '<?= $tor->cantidad_equipos ?>')" class="btn btn-sm btn-primary">Edit</a>
			                                <a href="<?= base_url() ?>torneo/eliminar/<?= $tor->id_torneo ?>" onclick="confirmDelete()" class="btn btn-sm btn-danger btn-delete">Delete</a>
			                    </td>
							</tr>
						
						<?php	
							}?>
				    
						</table>		
							

				<?php	
				  }
				  else{ ?>
				  		<table class="table table-bordered table-hover">
				  			<tr class="well">
				   			    
				   			    <th ><center>Nombre del Torneo</center></th>
								<th ><center>Cantidad de Equipos</center></th>
								<th ><center>Fecha de Inicio</center></th>
								<th ><center>Fecha de Finalizacion</center></th>
								<th ><center>Equipo Campeon</center></th>
								<th ><center>Fixture</center></th>
								<th ><center>Acciones</center></th>
								    			
				 			</tr>

						<?php 
							foreach ($torneo->result() as $tor) {?>
								
							<tr> 

								<td><center><?php echo $tor->nombre_torneo ?></center></td> 
								<td><center><?php echo $tor->cantidad_equipos ?></center></td>
								<?php
									$fecha = strtotime($tor->fecha_inicio);
									$anio = date('d-m-Y',$fecha);
									//date_format($date, 'Y-m-d H:i:s');

								?>
								<td><center><?php echo $anio ?></center></td>
								<td><center>No se sabe</center></td>
								<td><center>No hay todavia</center></td>
								<?php 
									$this->load->model('fixtur');
									$this->load->model('torn');
									$equipos_tor = $this->torn->equipos_torneo($tor->id_torneo);
									$resultado = $this->fixtur->torneo_equipos($tor->id_torneo);
									if ($equipos_tor->num_rows() > 0) {
										
										if ($resultado->num_rows() > 0) {?>
											<td><center><a href="<?= base_url() ?>torneo/cargar_fecha/<?= $tor->id_torneo ?>">Ir</a></center></td>
										<?php 				
											}
											else{?>

												<td><center><a href="<?= base_url() ?>/home/fixture_generar/<?= $tor->id_torneo ?>">Generar Fixture</a></center></td>
										<?php	
											}
										 
									}
									else{?>

										<td><center><a href="<?= base_url() ?>equipos/fecha/<?= $tor->id_torneo ?>">Cargar Equipos</a></center></td>
									<?php	
									}?>
								<td class="text-center">
									
											<a href="<?= base_url() ?>/fixture/mostrar_fixture/<?= $tor->id_torneo ?>" class="btn btn-sm btn-info">View</a>
			                                <a data-toggle="modal" data-target="#editar_torneo" onclick="selTorneo('<?= $tor->id_torneo ?>', '<?= $tor->nombre_torneo ?>', '<?= $tor->fecha_inicio ?>', '<?= $tor->cantidad_equipos ?>')" class="btn btn-sm btn-primary">Edit</a>
			                                <a href="<?= base_url() ?>torneo/eliminar/<?= $tor->id_torneo ?>" onclick="confirmDelete()" class="btn btn-sm btn-danger btn-delete">Delete</a>
			                        
			                    </td>	
							</tr>
						
						<?php	
							}?>
				    
						</table>		
					<?php
					}?>		

		<br><br>
			</div>		
		</div>
	</div>

	<div id="nuevo_torneo" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><strong>Nuevo Torneo</strong></h4>
	      </div>
	      <div class="modal-body">
	      	
		        <form action="<?= base_url() ?>torneo/cargar_torneo" method="post" role="form">	

						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" class="form-control"><br>
						</div>	

						<div class="form-group">
							<label>Fecha de Inicio</label>
							<input type="date" name="fecha" class="form-control"><br>
						</div>
						
						<div class="form-group">	
							<label>Cantidad de Equipos</label>
							<input type="number" name="cant_equipos" class="form-control"><br>
						</div>
						
						<div class="form-group">	
							<input class="btn btn-primary" type="submit" value="CARGAR">
						</div>	
					</form>
	        
	      </div>
	      
	    </div>

	  </div>
	</div>

	<div id="editar_torneo" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title"><strong>Editar Equipo</strong></h4>
	      </div>
	      <div class="modal-body">
	      	
		        <form role="form" name="formedit" id="formedit" action="<?= base_url() ?>torneo/editar_torneo" method="post">	

					<div class='form-group'>
						<input type="hidden" name="id" id="id_torneo" value="" class="form-control">
					</div>

					<div class='form-group'>
						<label>Nombre del Torneo </label>
						<input type="text" name="nombre" id="nombre" class="form-control" value="">
					</div>

					<div class='form-group'>
						<label>Fecha de Inicio </label>
						<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="">
					</div>
					
					<div class='form-group'>
						<label>Cantidad de Equipos </label>
						<input type="number" name="cantidad" id="cantidad" class="form-control" value="">
					</div>

					<div class="modal-footer">
				        <button type="button" class="btn btn-danger btn-delete" data-dismiss="modal">Cerrar</button>
				        <button type="submit" class="btn  btn-primary">Editar</button>
				    </div>
																
				</form>
	        
	      </div>
	      
	    </div>

	  </div>
	</div>

		
	</body>
<script type="text/javascript">
		
		function selTorneo(id, nombre, fecha, cantidad){

			document.getElementById('id_torneo').value=id;
			document.getElementById('nombre').value=nombre;
			document.getElementById('fecha_inicio').value=fecha;
			document.getElementById('cantidad').value=cantidad;


		};

		function confirmDelete(){

			confirm("Esta seguro de Eliminar el Torneo?")
		};

</script>
</html>