

		
			<div class="col-md-6 col-md-offset-3">
					
					<h2>Cargar Equipos del Campeonato</h2><br><br>
						
					<form role="form" action="<?= base_url() ?>torneo/equipos_torneo" method="post" enctype="multipart/form-data">	

						<input class='form-group' type="hidden" name="torneo" value="<?= $torneo ?>">					
						<input type="hidden" name="cant" value="<?= $cantidad ?>">

						<?php  
						
							for ($i=1; $i <= $cantidad; $i++) {?>

								<h3>Equipo <?= $i ?></h3>
									<select class="form-control sel" id="sel" name="equipo<?= $i ?>" required>
									    <option>Selecciona</option>
								<?php
									foreach ($equipos->result() as $equ) {
										echo "<option value='$equ->id'>$equ->nombre_equipo</option>";	    
									}?>	    
				                        
									</select>
								<br><br>
								<input type="hidden" name="orden<?= $i ?>" value="<?= $i ?>">
						<?php
							}
							if ($cantidad%2!=0) {?>

								<input type="hidden" name="equipo<?= $i ?>" value="30">
								<input type="hidden" name="orden<?= $i ?>" value="<?= $i ?>">
						<?php		
							}
							?>	
						<br>
						
						<div class='form-group'>	
							<input class='btn btn-primary btn-lg btn-block' type="submit" value="CARGAR" >	
						</div>

					</form>
				
			</div>
		
		<script type="text/javascript">

			$(document).on('change','#sel',function(){
			  $(this).siblings().find('option[value="'+$(this).val()+'"]').remove();
			});
			
		</script>

	</body>
	
					
</html>