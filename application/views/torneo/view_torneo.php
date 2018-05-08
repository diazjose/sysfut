<div class="container">
	<div>
		<div class="panel panel-info">
		  
		  <div class="panel-heading text-center"><h4><strong>Informacion del Torneo</strong></h4></div>

		  <div class="panel-body">
		  	<div class="row">
		  		<div class="col-md-4 text-center">	
		  			<strong>Nombre   </strong> <?= $torneo->nombre_torneo ?><br><br>
		  		</div>	
		  		<div class="col-md-4 text-center">
		  			<strong>Fecha de Inicio   </strong> <?= date('d-m-Y',strtotime($torneo->fecha_inicio)) ?><br><br>	
		  		</div>
		  		<div class="col-md-4 text-center">
		  			<strong>Cantidad de Equipos   </strong> <?= $torneo->cantidad_equipos ?><br><br>
		 		</div>
		 	</div>
		  </div>
		  
		</div>
	</div>

	<div>
		<div class="panel panel-info">
		  
		  <div class="panel-heading text-center"><h4><strong>Equipos del Torneo</strong></h4></div>

		  <div class="panel-body">

		  		<?php

				if ($equipos->num_rows() > 0) {?>
				
			    <div id="mos">
			  	   <a href="#" onclick="mostrar()">Mostar Equipos >></a>
			    </div>
				<div id="equipos" style='display:none;'>	  
				  <?php 
				  	  $i = 1;
						  	  					  	  			  			
				  	  foreach ($equipos->result() as $equipo) {
				  	  	$this->load->model('equipo');
				  	  	if ($equipo->id_equipo != 30) {
				  	  		$equi = $this->equipo->buscar_equ($equipo->id_equipo);
					  ?>
					  		<strong>Equipo <?= $i ?>   </strong> <?= $equi->nombre_equipo ?><br><br>

					  <?php
					  		$i++;
				  	  	}
				  	  	
					  }?>
					  <a href="#" onclick="ocultar()">Ocultar Equipos >> </a>
				<?php	  
				}else{?>
					<h4><font color="red">No se Cargaron Equipos en Este Campeonato</font></h4>
				<?php
				}	  
				  ?>
				 </div>
				  
		  </div>
		  
		</div>
	</div>	
</div><br><br>
<?php
		
	if ($equipos->num_rows() == 0) {?>
	<div class="container">
		<div class="row">
			<div class="col-md-6 text-center">
				<a href="<?= base_url() ?>equipos/fecha/<?= $tor ?>" class="btn btn-lg btn-info btn-block">Cargar 1° Fecha</a>
			</div>
			<div class="col-md-6 text-center">
				<a href="<?= base_url() ?>cargar/cargar_equ/<?= $tor ?>" class="btn btn-lg btn-info btn-block">Cargar Equipos</a>
			</div>
		</div>
	</div>	
<?php
	}
	else{
		
		if ($fixture->num_rows() == 0) {?>
			<center><h4><a href="<?= base_url() ?>fixture/fixture_generar/<?= $tor ?>"><font color="red">Generar Fixture</font></a></h4></center>
	<?php				
		}
		else{?>
			<center>
				<font color="red">EXPORTAR A PDF</font><a class="" href="<?= base_url() ?>reporte/fixture/<?= $tor ?>" ><img src="<?= base_url() ?>public/assets/images/PDF.png"></a>
				<a class="" href="<?= base_url() ?>torneo/tabla/<?= $tor ?>" >TABLA</a>
			</center><br><br>
			
	<?php
		}
	}	
	?>
<script type="text/javascript">
	
	function mostrar(){
		$('#equipos').show();
		$('$mos').hide(); 
	};

	function ocultar(){
		$('#equipos').hide();
		$('$mos').show();
	};

</script>
