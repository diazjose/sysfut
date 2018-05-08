

		<center>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">		
				<h2>Agregar Equipo</h2><br><br>
					
				<form role="form" action="<?= base_url() ?>equipos/equipo_cargar" method="post">	

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
		</div>	
		</center><br><br>

	</body>

</html>