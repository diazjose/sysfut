<div class="container text-center">
	
	<h2 class="text-center">Tabla de Posiciones del Torneo <?= $torneo->nombre_torneo ?>  <?= $torneo->anio ?></h2><br>

	<table class="table table-bordered table-hover">
		<thead>
			<tr class="well">					   	    
				<th class="text-center col-md-1">Puesto</th>
				<th class="text-center">Equpos</th>
				<th class="text-center">PJ</th>
				<th class="text-center">GF</th>
				<th class="text-center">GC</th>
				<th class="text-center">Dif</th>
				<th class="text-center">Puntos</th>				
			</tr>
		</thead>

		<tbody>
			
			<?php 
			$i=1;
			foreach ($equipos as $key => $row) {?>
			<tr>
				<td><?= $i ?></td>
				<td><?= $row['nombre'] ?></td>
				<td><?= $row['partido'] ?></td>
				<td><?= $row['gol_favor'] ?></td>
				<td><?= $row['gol_contra'] ?></td>
				<td><?= $row['diferencia'] ?></td>
				<td><?= $row['puntos'] ?></td>
			</tr>
			<?php
				$i++; 
			}?>	
			
		</tbody>
	</table>
</div>