<?php
	ob_start();
	session_start();
	if( !@$_SESSION["nombre_completo"]){
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>Acceso profesores</title>

	<script src="../scripts/jquery/dist/jquery.min.js"></script>
	<?php include_once '../scripts/http/include.php'; ?>

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

	<?php include_once '../scripts/http/include_script_js.php'; ?>

</body>
</html>

<?php }else{ ?>
	<?php 
		ob_start();
		header("Location: ../panel_admin/");
	?>
<?php }?>