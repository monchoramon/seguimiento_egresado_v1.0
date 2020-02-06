
<?php
	ob_start();
	session_start();
	if( @$_SESSION["nombre_completo"] ){
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>Panel administrador</title>

	<?php include_once '../scripts/http/include.php'; ?>

</head>
<body>

	<div id="title_a"><h3>ENCUESTA PARA SEGUIMIENTO DE EGRESADOS</h3></div>
	<header></header>

		<div id="main">

			<div id="menu">

				<h6>Seguimiento de egresados</h6>

				<ul>
					<li>Cerrar sesión</li>
					<li id="registro_docente">Crear nuevo administrador</li>
					<li id="generar_reportes">Generar reporte</li>
				</ul>

			</div>

			<div id="contenido">

				<div id="usuario">
					<div class="bie">Bienvenido:</div>
					<div><?php echo $_SESSION["nombre_completo"]; ?></div>
				</div>	

				<div id="cont_tabla">

					<h4>Encuestas totales actuales</h4>

					<table id="tabla_egresados" class="table table-striped table-bordered">
				        <thead>
				            <tr>
				                <th>ID</th>
				                <th>Número de control</th>
				               <!--  <th>Nombre del alumno</th>
				                <th>Fecha de graduación</th> -->
				                <th>Eliminar encuesta</th>
				                <th>Ver encuesta</th>
				            </tr>
				        </thead>
				    </table>

				</div>

			</div>

			<!-- Modal {posgrado} -->
			<div class="modal fade bd-example-modal-lg" id="registro_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">
			        	Registro nuevo docente:
			        </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body" id="tipo_pos_padre">

			      		<form id="data_prof">

						  <div class="form-group">
						    <label>Nombre de usuario</label>
						    <input type="text" class="form-control" id="usuario_profesor" name="usuario_profesor">
						  </div>

						   <div class="form-group">
						    <label>Nombre completo</label>
						    <input type="text" class="form-control" id="nombre_completo" name="nombre_completo">
						  </div>

						   <div class="form-group">
						    <label>Contraseña</label>
						    <input type="password" class="form-control" id="password" name="password">
						    <small class="form-text text-muted">Escriba una contraseña</small>
						  </div>

						  <h4>Privilegios</h4>

							<div class="form-check">
							  <input class="form-check-input" type="checkbox" value="1" id="con_priv" name="con_priv">
							  <label class="form-check-label">
							   Consultar
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" value="1" id="edit_del_priv" name="edit_del_priv">
							  <label class="form-check-label">
							    Editar y eliminar
							  </label>
							</div>

							<input type="hidden" name="tipe" value="2">

							<br/>

						  <button id="btn_registrar" type="button" class="btn btn-primary">Registrar</button>

						</form>
						
			      </div>

			      <div class="modal-footer"></div>

			    </div>
			  </div>
			</div>


			<!-- Modal {reporte} -->
			<div class="modal fade" id="reporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">
			        	Reportes perfil del egresado:
			        </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body" id="tipo_pos_padre">

			      		<form id="data_reporte">

						  <div class="form-group">
						    <label>Periodo</label>
						    <select name="periodo" class="form-control">
						    	<option value="0">Seleccione el periodo</option>
						    	<option value="ENE-JUN">ENE-JUN</option>
						    	<option value="AGO-DIC">AGO-DIC</option>
						    </select>
						  </div>

						  <div class="form-group">
						    <label>Año</label>
						    <select name="ano" id="ano_egreso" class="form-control">
						    	<option value="1">Seleccione un año</option>
						    </select>
						  </div>

						  <button id="btn_generar_reporte" type="button" class="btn btn-primary">
							 Generar reporte
						  </button>

						</form>
						
			      </div>

			      <div class="modal-footer"></div>

			    </div>
			  </div>
			</div>


		</div>

	<?php include_once '../scripts/http/include_script_js.php'; ?>

</body>
</html>

<?php }else{ ?>
	<?php 
		ob_end_flush();
		header("Location: ../acceso/");
	?>
<?php }?>