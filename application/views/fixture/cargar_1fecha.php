		




	
	
		<div class="col-md-6 col-md-offset-3">
			
			<div class="center-block">
			<h2 class="text-center"><?= $cantidad->nombre_torneo ?>  <?= $cantidad->anio ?></h2><br>
			
			<form class="form-horizontal">
				
				<table class="table table-bordered" >
				  <thead class="thead-dark">
				    <tr>
				      <th colspan="3" class="success text-center"><h4><strong>Fecha 1</strong></h4></th>				      
				    </tr>
				  </thead>
				  <tbody>
				    
				    <?php
				    
				    $hasta = $cantidad->cantidad_equipos / 2;

				    for ($i=1; $i < $cantidad->cantidad_equipos ; $i=$i+2) {?> 
				    <tr>
				      <td>
					      	<select class="sel" id="sel" name="equipo<?= $i ?>" required>
					      		<option>Selecciona</option>
							<?php
							foreach ($equipos->result() as $equ) {
								echo "<option value='$equ->id'>$equ->nombre_equipo</option>";	    
							}?>	    
						                        
					      	</select>
					      	<input type="hidden" name="orden<?= $i ?>" value="<?= $i ?>">
				      </td>

				      <td>VS</td>
				      
				      <td>
				      		<select  class="sel" id="sel" name="equipo<?= $e=$i+1 ?>" required>
					      		<option>Selecciona</option>
							<?php
							foreach ($equipos->result() as $equ) {
								echo "<option value='$equ->id'>$equ->nombre_equipo</option>";	    
							}?>	    
						                        
					      	</select>
					      	<input type="hidden" name="orden<?= $e ?>" value="<?= $e =$i+1 ?>">
				      </td>
				    </tr>  
				    <?php						 		
				 	}?>

				 			    
				  </tbody>
				</table>	
				
				<div class="">	
					<input class="btn btn-primary btn-lg btn-block" value="Cargar Fecha" >
				</div>	
				<br>
				<br>
			</form>
			</div>
		</div>		
		
	<script type="text/javascript">

			$(document).on('change','.sel',function(){
			  $(this).siblings().find('option[value="'+$(this).val()+'"]').remove();
			});
			
		</script>
	</body>
</html>