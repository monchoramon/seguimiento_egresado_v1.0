<?php 
	include_once "../reportes/sesion.php";
	if( @$_SESSION["usuario_profesor"] ){
 ?>

<!DOCTYPE html>
<html>
<head>

	<?php include_once "../scripts/includes/responsive.php"; ?>
	<title>Panel administrador</title>
	<?php include_once '../scripts/includes/include.php'; ?>

</head>
<body>

	<div id="title_a">
		<h3>ENCUESTA PARA SEGUIMIENTO DE EGRESADOS</h3>
		<div id="btn">
			<button type="button" id="btn_m">
				<div id="main_div"></div>
				<div></div>
				<div></div>
			</button>
		</div>
	</div>
	
	<header></header>

		<div id="main">

			<div id="menu">

				<h6>Seguimiento de egresados</h6>

				<ul>
					<li id="cerrar_sesion">Cerrar sesión</li>
					<li id="registro_docente">Crear nuevo administrador</li>
					<li id="actualizar_info_docente">Actualizar información docente</li>
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
			<div class="modal fade" id="registro_usuario" tabindex="-1" role="dialog" aria-labelledby="registro_usuario" aria-hidden="true">
			  <div class="modal-dialog" role="document">
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
							    Editar, crear y eliminar
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


			<!-- Modal {verificacion eliminar} -->
			<div class="modal fade" id="verificacion" tabindex="-1" role="dialog" aria-labelledby="modal_verificacion" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">
			        	Eliminar encuesta:
			        </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body" id="tipo_pos_padre">

						  <div class="form-group">
						    <label>¿Realmente desea eliminar esta encuesta?</label>
						  </div>

						  <button id="btn_eliminar_conf" type="button" class="btn btn-primary">
							 Si, eliminarla
						  </button>

						  <div id="info" class="alert alert-success" role="alert"></div>

						  <input type="hidden" name="id_encuesta">
						  <input type="hidden" name="numero_control">	
						
			      </div>

			      <div class="modal-footer"></div>

			    </div>
			  </div>
			</div>

			<!-- Modal {verificacion eliminar} -->
			<div class="modal fade" id="info_docente" tabindex="-1" role="dialog" aria-labelledby="modal_verificacion" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title">
			        	Actualizar información docente:
			        </h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body">

					 <form id="docentes">

						  <div class="form-group">
				  		  	
				  		  	<label>Seleccione al docente:</label>

				  		  	<select class="form-control" name="profesor"></select>

				  		  	<div class="alert alert-danger" role="alert"></div>

				  		  </div>

				  		  <input type="hidden" name="tipo" value="2">

				  		  <button type="button" id="btn_iniciar_act" class="btn btn-primary">
				  		  	Aceptar
				  		  </button>

					 </form>
						
			      </div>

			      <div class="modal-footer"></div>

			    </div>
			  </div>
			</div>


		</div>

	<?php include_once '../scripts/includes/include_script_js.php'; ?>
	<?php include_once '../scripts/includes/include_confirmacion.php'; ?>

</body>
</html>

<?php }else{ ?>

	<?php include_once "../scripts/includes/all_scripts.php"; ?>
	<h5>No se ha iniciado sesión, redireccionando a acceso docente....</h5>

<?php } ?>