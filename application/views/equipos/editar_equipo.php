

		<center>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">		
				<h2>Editar Equipo</h2><br><br>
					
				<form role="form" action="<?= base_url() ?>equipos/editar_equipo" method="post">	

					<div class='form-group'>
						<input type="hidden" name="id" class="form-control" value="<?= $equipo->id ?>"><br><br>
					</div>

					<div class='form-group'>
						<label>Nombre del Equipo </label>
						<input type="text" name="nombre" class="form-control" value="<?= $equipo->nombre_equipo ?>"><br><br>
					</div>

					<div class='form-group'>
						<label>Fecha de Inscripcion </label>
						<input type="date" name="fecha_ingreso" class="form-control" value="<?= $equipo->fecha_ingreso ?>"><br><br>
					</div>
					
					<div class='form-group'>	
						<label>Categoria </label>
						<select name="categoria" class="form-control" value="<?= $equipo->Categoria ?>">	
							<option>Pre-Veteranos</option>
							<option>Veteranos</option>

						</select><br><br> 					
					</div>

					<div class='form-group'>	
						<label>Estado </label>
						<input type="checkbox" name="estado" value="1">
					</div>

										
					<div class='form-group'>					
						<input  class="btn btn-primary" type="submit" value="CARGAR">	
					</div>
						
				</form>
				
			</div>
		</div>	
		</center><br><br>

	</body>

</html>