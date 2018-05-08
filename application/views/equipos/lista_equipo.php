<br>
<div class="container text-center">
	<div class="row">
		<div class="col-md-12">
			<center><h2>Buscar Equipo</h2></center><br><br>
			   <div class="col-md-6">
	                    <a  data-toggle="modal" data-target="#nuevo_equipo" class="btn btn-success">
	                        
	                            <i class="fa fa-fw fa-plus"></i> Nuevo Equipo
	                        
	                    </a>
	           </div>

	           <div class="row">
	           		
	                <div class="col-md-6">    
	                    <form method="post" action="<?= base_url() ?>equipos/buscar_equipo" class="form-inline" role="search">
		           	   		
		           	   		<div class="form-group">
		           	   			<input type="text" name="query" class="form-control" placeholder="Buscar Equipo" required>
		           	   		</div>	
		           	   		<input type="submit" value="Buscar" class="btn btn-default">
		           	   
		           	   </form>
		           	</div>   
               </div><br>

               <table class="table table-bordered table-hover">
				  	<tr class="well">
				   	    
				   	    <th ><center>Nombre del Equipo</center></th>
						<th ><center>Fecha de Incripcion</center></th>
						<th ><center>Categoria</center></th>
						<th ><center>Estado</center></th>
						<th ><center>Acciones</center></th>
								    			
				 			</tr>

						<?php 
						if ($equipos) {
							
						
							foreach ($equipos->result() as $equipo) {?>
								
							<tr> 

								<td><center><?php echo $equipo->nombre_equipo ?></center></td> 
								<?php
									$fecha = date("d-m-Y", strtotime($equipo->fecha_ingreso))
									
								?>
								<td><center><?php echo $fecha ?></center></td>
								<td><center><?= $equipo->categoria ?></center></td>
								<td><center><?php if ($equipo->estado == 0) {?>
									<a href="<?= base_url() ?>equipos/activar/<?= $equipo->id ?>"><font color="red">Activar</font></a><?php
								}
								else{?>
									<font color="blue">Activo</font>
									<?php
									}  ?>
								</center></td>
								<td><center>
		                                <a href="<?= base_url() ?>" class="btn btn-sm btn-info">View</a>
		                                <a data-toggle="modal" data-target="#editar_equipo" onclick="selEquipo('<?= $equipo->id ?>', '<?= $equipo->nombre_equipo ?>', '<?= $fecha ?>')" class="btn btn-sm btn-primary">Edit</a>
		                                <a href="<?= base_url() ?>" onclick="confirmDelete()" class="btn btn-sm btn-danger btn-delete">Delete</a>
		                        </center>
		                        </td>
					
								
							</tr>
						
						<?php	
							}
						}else{	

							if ($equipo) {?>
								<tr> 

								<td><center><?php echo $equipo->nombre_equipo ?></center></td> 
								<?php
									$fecha = date("d-m-Y", strtotime($equipo->fecha_ingreso))
									
								?>
								<td><center><?php echo $fecha ?></center></td>
								<td><center><?= $equipo->categoria ?></center></td>
								<td><center><?php if ($equipo->estado == 0) {?>
									<a href="<?= base_url() ?>equipos/activar/<?= $equipo->id ?>"><font color="red">Activar</font></a><?php
								}
								else{?>
									<font color="blue">Activo</font>
									<?php
									}  ?>
								</center></td>
								<td><center>
		                                <a href="<?= base_url() ?>" class="btn btn-sm btn-info">View</a>
		                                <a data-toggle="modal" data-target="#editar_equipo" onclick="selEquipo('<?= $equipo->id ?>', '<?= $equipo->nombre_equipo ?>', '<?= $fecha ?>')" class="btn btn-sm btn-primary">Edit</a>
		                                <a href="<?= base_url() ?>" onclick="confirmDelete()" class="btn btn-sm btn-danger btn-delete">Delete</a>
		                        </center>
		                        </td>
					
								
							</tr>
								

								
						<?php			
							}							
						
						}	?>
				    
						</table>		
						

            
		</div>
	
	</div>

	<div id="nuevo_equipo" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Nuevo Equipo</h4>
	      </div>
	      <div class="modal-body">
	      	
		        <form role="form" action="<?= base_url() ?>cargar/equipo_cargar" method="post">
		        	
		        	<div class='form-group'>
						<label>Nombre del Equipo </label>
						<input type="text" name="nombre" class="form-control"><br><br>
					</div>
					
					<div class='form-group'>	
						<label>Categoria </label>
						<select name="categoria" class="form-control">	
							<option>Pre-Veteranos</option>
							<option>Veteranos</option>

						</select> 					
					</div>
					
					<div class='form-group'>					
						<input  class="btn btn-primary" type="submit" value="CARGAR">	
					</div>

		        </form>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
	
	<div id="editar_equipo" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Editar Equipo</h4>
	      </div>
	      <div class="modal-body">
	      	
		        <form role="form" name="formedit" id="formedit" action="<?= base_url() ?>equipos/editar_equipo" method="post">	

					<div class='form-group'>
						<input type="hidden" name="id" id="id_equipo" value="" class="form-control">
					</div>

					<div class='form-group'>
						<label>Nombre del Equipo </label>
						<input type="text" name="nombre" id="nombre" class="form-control" value=""><br>
					</div>

					<div class='form-group'>
						<label>Fecha de Inscripcion </label>
						<input type="date" name="fecha_ingreso" id="fecha" class="form-control" value=""><br>
					</div>
					
					<div class='form-group'>	
						<label>Categoria </label>
						<select name="categoria" class="form-control">	
							<option>Pre-Veteranos</option>
							<option>Veteranos</option>

						</select><br> 					
					</div>

					<div class='form-group'>	
						<label>Estado </label>
						<input type="checkbox" name="estado" value="1">
					</div>

										
					<div class='form-group'>					
						<input  class="btn btn-primary" type="submit" value="EDITAR">	
					</div>
						
				</form>
	        
	      </div>
	      1
	    </div>

	  </div>
	</div>


</div>
<script type="text/javascript">
		
		function selEquipo(id, nombre, fecha){

			document.getElementById('id_equipo').value=id;
			document.getElementById('nombre').value=nombre;
			document.getElementById('fecha').value=fecha; 
		}

</script>