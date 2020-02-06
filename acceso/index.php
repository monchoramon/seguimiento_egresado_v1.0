<?php 

	include_once "../reportes/sesion.php";
	if( @$_SESSION["usuario_profesor"] ){

 ?>

	<?php include_once "../scripts/includes/all_scripts.php"; ?>
	<h5>Sesión existente, redireccionando al panel pricipal....</h5>

<?php }else{ ?>

<!DOCTYPE html>
<html>
<head>

	<?php include_once "../scripts/includes/responsive.php"; ?>
	<title>Acceso profesores</title>

	<script src="../scripts/jquery/dist/jquery.min.js"></script>
	<?php include_once '../scripts/includes/include.php'; ?>

</head>
<body id="panel_access">

		<div id="title_a"><h2>Acceso docente</h2></div>
		<header></header>

	<div id="container" class="container">

		<div id="log">

			<form id="datos">

				<div class="form-group">
					<label>Nombre de usuario:</label><br>
					<input class="form-control" type="text" name="usuario">
				</div>

				<div class="form-group">
					<label>Contraseña:</label><br>
					<input class="form-control" type="password" name="contrasena">
				</div>

				<br/>

				<input id="btn_acceder" class="btn btn-primary" type="button" value="Aceptar">

			</form>


		</div>

		<div id="acc_doc">
			<img src="../recursos/imagenes/SEP.png">
		</div>

	</div>

	<?php include_once '../scripts/includes/include_script_js.php'; ?>
	<script src="../scripts/js/confirmacion_acceso.js"></script>

</body>
</html>

<?php } ?>