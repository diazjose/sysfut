

<div class="container">

	<div class="row">
		<div class="col-md-10">
			<ol class="breadcrumb">
			  <li><a href="<?= base_url() ?>">Inicio</a></li>
			  <li><a href="<?= base_url() ?>">Torneos</a></li>
			  <li class="active">Cargar Fecha</li>
			</ol>	
		</div>
	</div>

	<div class="row">		

		<div class="col-md-3"></div>
		<div class="col-md-6">
		
			<form role="form" action="<?= base_url() ?>cargar/cargar_equipo" method="post">
				
				<div id="titulo" class="text-center">
					<br>
					<h2>
						<strong><font color="">Torneo <?= $cantidad->nombre_torneo ?> <?= $cantidad->anio ?></font></strong>
					</h2>
				</div><br>
				
				<input type="hidden" name="cant" value="<?= $cantidad->cantidad_equipos ?>">
				<input type="hidden" name="torneo" value="<?= $cantidad->id_torneo ?>">
				
				<?php						    
				
				if ($cantidad->cantidad_equipos%2==0) {
					$hasta = $cantidad->cantidad_equipos / 2;
					$final = $cantidad->cantidad_equipos +3;
				}else{
					$cantidad = $cantidad->cantidad_equipos+1;
					$hasta = $cantidad / 2;
					$final = $cantidad+3;
				}
				
				$n = 1;
		
			    for ($i=1; $i <= $hasta+1 ; $i++) {?> 

					<?php
					if ($i == 1) {?>
						<div class="text-center">
							<h4><strong>Partido <?= $n ?></strong></h4>
						</div>	
							<select class="sel form-control" id="sel" name="equipo<?= $i ?>" required>
								<option>Selecciona</option>
								<?php
								foreach ($equipos->result() as $equ) {
								echo "<option value='$equ->id'>$equ->nombre_equipo</option>";	    
								}?>
							</select>
							
							<input type="hidden" name="orden<?= $i ?>" value="<?= $i ?>">


						<div class="text-center">
							<h4><strong>VS</strong></h4>
						</div>	


							<select  class="sel form-control" id="sel" name="equipo<?= $i=$i+1 ?>" required>
								<option>Selecciona</option>
								<?php
								foreach ($equipos->result() as $equ) {
								echo "<option value='$equ->id'>$equ->nombre_equipo</option>";	    
								}?>	    
									                        
							</select>
							<input type="hidden" name="orden<?= $i ?>" value="<?= $i ?>">
							
							<br>


					<?php	
					}else{?>

						<div class="text-center">
							<h4><strong>Partido <?= $n ?></strong></h4>
						</div>	
							<select class="sel form-control" id="sel" name="equipo<?= $i ?>" required>
								<option>Selecciona</option>
								<?php
								foreach ($equipos->result() as $equ) {
								echo "<option value='$equ->id'>$equ->nombre_equipo</option>";	    
								}?>
							</select>
							
							<input type="hidden" name="orden<?= $i ?>" value="<?= $i ?>">


						<div class="text-center">
							<h4><strong>VS</strong></h4>
						</div>	


							<select  class="sel form-control" id="sel" name="equipo<?= $e=$final-$i ?>" required>
								<option>Selecciona</option>
								<?php
								foreach ($equipos->result() as $equ) {
								echo "<option value='$equ->id'>$equ->nombre_equipo</option>";	    
								}?>	    
									                        
							</select>
							<input type="hidden" name="orden<?= $e ?>" value="<?= $e ?>">
							
							<br>
	
				<?php
					}
				$n++;
				}?>
				<br>
				<div class="">
					<input type="submit" class="btn btn-primary btn-block btn-lg" value="Carga Fecha">
				</div>
				<br><br>

			</form>	

		</div>
	</div>

</div>

		<script type="text/javascript">

			$(document).on('change','.sel',function(){
			  $(this).siblings().find('option[value="'+$(this).val()+'"]').remove();
			});
			
		</script>
	</body>
</html>