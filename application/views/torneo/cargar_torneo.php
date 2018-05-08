

	

			<div class="text-center">
				<h2>Cargar Torneo</h2><br><br>
			</div>	
	
				<div class="col-md-6 col-md-offset-3">
					<form action="<?= base_url() ?>torneo/cargar_torneo" method="post" role="form">	

						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" class="form-control"><br><br>
						</div>	

						<div class="form-group">
							<label>Fecha de Inicio</label>
							<input type="date" name="fecha" class="form-control"><br><br>
						</div>
						
						<div class="form-group">	
							<label>Cantidad de Equipos</label>
							<input type="number" name="cant_equipos" class="form-control"><br><br>
						</div>
						
						<div class="form-group">	
							<input class="btn btn-primary" type="submit" value="CARGAR">
						</div>	
					</form>
				</div>	
				
	

	</body>

</html>