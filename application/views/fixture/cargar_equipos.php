

		<center>

			<h2>Cargar Equipos del Campeonato</h2><br><br>
				
			<form role="form" action="<?= base_url() ?>cargar/cargar_equipo" method="post">	

				<div class='form-group'>
					<input type="hidden" name="campeonato" value="<?= $torneo ?>">					
				</div>

				<?php  
				
					for ($i=1; $i <= $cantidad; $i++) {


						echo "Equipo ".$i." ";
						echo "<div class='form-group'>";
						echo"<input type='hidden' name='orden$i' value='$i'>";
						echo "</div>";

						echo "<div class='form-group'>";
						echo "<select name='equipo$i'>";
							echo "<option selected disabled value=''>Seleccione un Equipo</option>";
							
						 foreach ($equipos->result() as $equipo) {

								
							echo "<option name='equipo$i' value='$equipo->id'> $equipo->nombre_equipo </option>";
							
						}?>	
							
						</select>
						</div>
					<br><br>
					<?php	
					//
					}?>	
				<br>
				<div class='form-group'>	
					<input type="submit" class="btn btn-primary" value="CARGAR">	
				</div>	
			</form>
		
		</center><br><br>

	</body>

</html>