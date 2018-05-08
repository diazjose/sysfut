<!DOCTYPE HTML>
<html>

	<head>
		
		  <meta charset="UTF-8" />
	      <title>Siempre Pasion</title>
	      <!--<link rel="stylesheet" href="< ?php echo base_url(); ?>assets/css/fomralumno.css" /> -->
	      <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/bootstrap.min.css" />
	      <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/bootstrap.css" />
	      <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/bootstrap.css" />
	      <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/shop-item.css" />
	      <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/bootstrap-switch.css" />
	      <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/jquery-ui.css" />
	      
	      <link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/estilo.css" />
	      
		  <script src="<?php echo base_url(); ?>public/assets/js/jquery-3.1.0.min.js"></script>
		  <script src="<?php echo base_url(); ?>public/assets/js/jquery-ui.js"></script>
		  <script src="<?php echo base_url(); ?>public/assets/js/bootstrap.js"></script>
		  <script src="<?php echo base_url(); ?>public/assets/js/highlight.js"></script>
		  <script src="<?php echo base_url(); ?>public/assets/js/bootstrap-switch.js"></script>
		  <script src="<?php echo base_url(); ?>public/assets/js/main.js"></script>

	</head>

	<body>


		<header>
			<div class="container-fluid">
				<div class="row">
					<div class="text-center col-md-4 hidden-xs hidden-sm">
						<img src="<?= base_url() ?>public/assets/images/Futbol-torneo3.jpg">
					</div>
					<div class="text-center col-md-4">
						<img src="<?= base_url() ?>public/assets/images/Futbol-torneo6.jpg">
					</div>
					<div class="col-md-4 text-center hidden-xs hidden-sm">
						<img src="<?= base_url() ?>public/assets/images/Futbol-torneo3.jpg">
					</div>
				</div>
			</div>
		</header>
			
		<nav class="navbar navbar-inverse navbar-fixed-top " role="navigation">
			<div class="container-fluid">
				
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar1">
						<span class="sr-only">Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>					
					<a class="navbar-brand" href="<?= base_url(); ?>"><strong>Siempre Pasion</strong></a>
				</div>

				<div class="collapse navbar-collapse" id="navbar1">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Torneo<span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a href="<?php echo base_url(); ?>torneo">Buscar Torneo</a></li>
				            <li><a href="<?php echo base_url(); ?>torneo/">Fechas</a></li>
				          </ul>
				        </li>

				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Equipos<span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a href="<?php echo base_url(); ?>equipos/lista_equipo">listar</a></li>
				          </ul>
				        </li>

				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Equipos<span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a href="<?php echo base_url(); ?>equipos/fecha">Fecha</a></li>
				          </ul>
				        </li>

					</ul>
				</div>
			</div>
		</nav>
		<br/>


	

		
