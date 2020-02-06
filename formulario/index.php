<!DOCTYPE html>
<html>
<head>

	<?php include_once "../scripts/includes/responsive.php"; ?>
	<title>Egresados</title>
	<?php include_once '../scripts/includes/include.php'; ?>
	<?php include_once '../scripts/http/include.php'; ?>

</head>
<body>


	<div id="title_a"><h3>ENCUESTA PARA SEGUIMIENTO DE EGRESADOS</h3></div>
	<header></header>

<!-- 	<div id="main">
		<div id="menu" style="position: fixed;">

			<h6>Seguimiento de egresados</h6>

			<ul>
				<li>Cerrar sesión</li>
				<li>Crear nuevo administrador</li>
				<li id="registro_docente">Registro docente</li>
			</ul>

		</div>
	</div> -->

	<div class="container">

		<form id="encuesta_egresados">	

			<div id="perfiles">
				<h4>Perfil de egresado</h4>
			</div>

			<div id="form_container">
				
				<div class="container_pre">

					<!---------Perfil del egresado------->

					<div class="form-group">
						<label>1. Número de control:</label>	
						<input type="text" id="numero_control" class="form-control" name="numero_control">
						<input type="hidden" class="numero_control" name="numero_control_id">
					</div>

					<div class="form-group">
						<label>2. Nombre completo:</label>
						<input type="text" id="nombre_completo" class="form-control" name="nombre_completo">	
						<input type="hidden" class="nombre_completo" name="nombre_completo_id">
					</div>

					<div class="form-group" id="sexo_padre">

						<label>3. Sexo:</label>

						<div class="form-check" id="sexo_madre">
							<input id="sexo_a" class="form-check-input" type="radio" name="sexo" value="Masculino">
							<label>Masculino</label>
						</div>

						<div class="form-check" id="sexo_madre">
							<input id="sexo_b" class="form-check-input" type="radio" name="sexo" value="Femenino">
							<label>Femenino</label>
						</div>

						<input type="hidden" name="sexo_id">

					</div>

					<div class="form-group">
						<label>4. Télefono:</label>
						<input type="text" id="telefono" class="form-control" name="telefono">	
						<input type="hidden" class="telefono" name="telefono_id">
					</div>

					<div class="form-group">
						<label>5. Email:</label>
						<input type="email" id="email" class="form-control" name="email">	
						<input type="hidden" class="email" name="email_id">
					</div>

					<div class="form-group">
						<label>6. Año de egreso: </label>
						<input type="date" id="ano_egreso" class="form-control" name="ano_egreso">
						<input type="hidden" class="ano_egreso" name="ano_egreso_id">
					</div>

					<div class="form-group" id="periodo_padre">

						<label>Periodo de egreso: </label>

						<div class="form-check" id="periodo_madre">
							<input id="periodo_a" class="form-check-input" type="radio" name="periodo" value="ENE-JUN">
							<label>Enero-Junio</label>
						</div>

						<div class="form-check" id="periodo_madre">
							<input id="periodo_b" class="form-check-input" type="radio" name="periodo" value="AGO-DIC">
							<label>Agosto-Diciembre</label>
						</div>

						<input type="hidden" name="periodo_id">

					</div>

					<div class="form-group">

						<div class="form-group">
							<label><b>7. Lugar de residencia actual:</b></label>
						</div>

						<label>Estado:</label>
						<input type="text" id="estado" class="form-control" name="estado">
						<input type="hidden" class="estado" name="estado_id">
					</div>

					<div class="form-group">
						<label>Ciudad:</label>
						<input type="text" id="ciudad" class="form-control" name="ciudad">
						<input type="hidden" class="ciudad" name="ciudad_id">
					</div>

					<div class="form-group" id="titulado_padre">

						<div>
							<label><b>8. ¿Está titulado?</b></label>
						</div>

						<div class="form-check" id="titulado_madre">
							<input id="titulado_a" class="form-check-input" type="radio" name="titulo" value="Si">
							<label>Si</label>
						</div>

					    <div class="form-check" id="titulado_madre">
					    	<input id="titulado_b" class="form-check-input" type="radio" name="titulo" value="No">
					   		<label>No</label>
					    </div>

						<input type="hidden" name="titulo_id">

					</div>

					<div class="form-group" id="posgrado_padre">

						<label><b>9. ¿Tiene posgrado?</b></label>

						<div id="posgrado_tipe_madre" class="form-check">
							<input class="form-check-input" id="tip_pos_1" type="radio" name="posgrado" value="Si">
							<label>Si</label>
						</div>
					
						<div id="posgrado_tipe_madre" class="form-check">
							<input class="form-check-input" id="tip_pos_0" type="radio" name="posgrado" value="No">
							<label>No</label>	
						</div>

						<div class="alert alert-secondary" role="alert">
							<label>Respuesta seleccionada:</label>
							<input type="text" id="posgrado_a" class="form-control" name="pos_grado_txt">
							<input type="hidden" name="pos_grado_txt_id" value="posgrado_a">
						</div>

						<input type="hidden" name="posgrado_id">

					</div>

					<!-- Modal {posgrado} -->
					<div class="modal fade" id="modal_posgrado" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLongTitle">
					        	Seleccione una de las siguientes opciones:
					        </h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>

					      <div class="modal-body" id="tipo_pos_padre">

					      	<div class="form-check" id="tipo_pos_madre">
							    <input id="tipo_pos_a" class="form-check-input" type="radio" name="tipo_pos" value="Maestria">
							     <label>Maestria</label>
							</div>

							<div class="form-check" id="tipo_pos_madre">
								<input id="tipo_pos_b" class="form-check-input" type="radio" name="tipo_pos" value="Doctorado">
							    <label>Doctorado</label>
							</div>

							<div class="form-check" id="tipo_pos_madre">
							    <input id="tipo_pos_c" class="form-check-input" type="radio" name="tipo_pos" value="Posdoctorado">
							    <label>Posdoctorado</label>
							</div>

							<input type="hidden" name="tipo_pos_id">

					      </div>

					      <div class="modal-footer">
					        <button id="btn_cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
					      </div>

							<input type="hidden" name="tipe" value="1">

					    </div>
					  </div>
					</div>


					<div class="form-group" id="padre_idiomas">

						<label><b>10. ¿Qué lenguaje extranjero domina?</b></label>

						<div class="form-check" id="idioma_a_madre">
							
							<input class="form-check-input" id="idioma_a" type="checkbox" name="idioma_a" value="Inglés"/>
							<label>Inglés</label>
							<input class="idioma_a" type="hidden" name="idioma_a_id">

							<div class="form-group">
								<label>Porcentaje de dominio</label>
								<input type="text" class="form-control" id="porcentaje_dom_a" name="porcentaje_dom_a" placeholder="20% al 100%">
								<input class="porcentaje_dom_a" type="hidden" name="porcentaje_dom_a_id">
							</div>

						</div>

						<div class="form-check" id="idioma_b_madre">

							<input class="form-check-input" id="idioma_b" type="checkbox" name="idioma_b" value="Francés">
							<label>Francés</label>
							<input class="idioma_b" type="hidden" name="idioma_b_id">

							<div class="form-group">
								<label>Porcentaje de dominio</label>
								<input type="text" class="form-control" id="porcentaje_dom_b" name="porcentaje_dom_b" placeholder="20% al 100%">
								<input class="porcentaje_dom_b" type="hidden" name="porcentaje_dom_b_id">
							</div>

						</div>

						<div class="form-check" id="idioma_c_madre">

							<input class="form-check-input" id="idioma_c" type="checkbox" name="idioma_c" value="Alemán"> 
							<label>Alemán</label>
							<input class="idioma_c" type="hidden" name="idioma_c_id">

							<div class="form-group">
								<label>Porcentaje de dominio</label>
								<input type="text" class="form-control" id="porcentaje_dom_c" name="porcentaje_dom_c" placeholder="20% al 100%">
								<input class="porcentaje_dom_c" type="hidden" name="porcentaje_dom_c_id">
							</div>

						</div>

						<div id="idioma_d_madre">

						    <label>Otro</label>
						    <input type="text" class="form-control" id="idioma_d" name="idioma_d" placeholder="Chino, Ruso, etc.">
						    <small class="form-text text-muted">Especifique</small>
						    <input class="idioma_d" type="hidden" name="idioma_d_id">

						    <div class="form-group">
								<label>Porcentaje de dominio</label>
								<input type="text" class="form-control" id="porcentaje_dom_d" name="porcentaje_dom_d" placeholder="20% al 100%">
								<input class="porcentaje_dom_d" type="hidden" name="porcentaje_dom_d_id">
							</div>

					  	</div>

					</div>

					<!-- Diferente -->

				</div>

			<!---------Perfil del egresado------->


				<hr/>

			<!---------Reporte de ubicación laboral------->

			<div class="container_pre">

				<div id="perfiles">
					<h4>Ubicación laboral</h4>
				</div>

				<div class="form-group" id="act_act_padre">
					
					<label><b>1. Actividad a la que se dedica actualmente</b></label>

					<div id="act_actual_madre">
						<input id="act_a" type="radio" name="acti_actual" value="Trabaja">
						<label>Trabaja</label>
					</div>
					
					<div id="act_actual_madre">
						<input id="act_b" type="radio" name="acti_actual" value="Estudia">
						<label>Estudia</label>
					</div>

					<div id="act_actual_madre">
						<input id="act_c" type="radio" name="acti_actual" value="Estudia y trabaja">
						<label>Estudia y trabaja</label>
					</div>

					<div id="act_actual_madre">
						<input id="act_d" type="radio" name="acti_actual" value="No estudia ni trabaja">
						<label>No estudia ni trabaja</label>
					</div>

					<input type="hidden" name="acti_actual_id"/>
					<input type="hidden" name="id_radio_act[]"/>

				</div>

			<input type="hidden" id="tipo_t" name="tipo_t">
			
			<div id="padre_ubicacion_laboral" class="block">

				<div class="form-group" id="trabajando_padre">
					
					<label>
						2. Seleccione la dependencia o area donde labora <!--  En caso de trabajar:  -->
					</label>

					<div id="trabajando_madre">
						<input id="tipe_0" type="radio" name="trabaja_tipo" value="Si">
						<label>Seleccionar</label>
					</div>
					
					<!--<div id="trabajando_madre">
							<input id="tipe_1" type="radio" name="trabaja_tipo" value="No">
							<label>No</label>
						</div> -->

					<div class="alert alert-secondary" role="alert">
						<label>Respuesta seleccionada:</label>
						<input type="text" id="trabajo_actual_conf" class="form-control" name="trabajo_actual_conf">
						<input type="hidden" name="trabajo_actual_conf_id" value="trabajo_actual_conf">
					</div>

					<input type="hidden" name="trabaja_tipo_id">

				</div>

				<!-- Modal {trabajo} -->

				<div class="modal fade" id="modal_trabajo_actual" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLongTitle">
				        	Seleccione una de las siguientes opciones:
				        </h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body" id="tipo_trabajo_padre">

				      	<div class="form-check" id="tipo_trabajo_madre">
				      		<input id="tipo_trabajo_a" class="form-check-input" type="radio" name="tipo" value="Comercio propio">
						    <label>Comercio propio</label>
						</div>

						<div class="form-check" id="tipo_trabajo_madre">
							<input id="tipo_trabajo_b" class="form-check-input" type="radio" name="tipo" value="Empleado en comercio">
							<label>Empleado en comercio</label>
						</div>

						<div class="form-check" id="tipo_trabajo_madre">
						    <input id="tipo_trabajo_c" class="form-check-input" type="radio" name="tipo" value="Empresa propia de informática o afín">
						    <label>Empresa propia de informática o afín</label>
						</div>

						<div class="form-check" id="tipo_trabajo_madre">
						    <input id="tipo_trabajo_d" class="form-check-input" type="radio" name="tipo" value="Empleado en empresa de informatica o afin">
						    <label>Empleado en empresa de informatica o afin</label>
						</div>

						<div class="form-check" id="tipo_trabajo_madre">
						    <input id="tipo_trabajo_e" class="form-check-input" type="radio" name="tipo" value="Dueño de PYME en ISC">
						    <label>Dueño de PYME en ISC</label>
						</div>

						<div class="form-check" id="tipo_trabajo_madre">
						    <input id="tipo_trabajo_f" class="form-check-input" type="radio" name="tipo" value="Empleado de PYME en ISC">
						    <label>Empleado de PYME en ISC</label>
						</div>

						<div class="form-check" id="tipo_trabajo_madre">
						    <input id="tipo_trabajo_g" class="form-check-input" type="radio" name="tipo" value="Empleado en institución educativa laborando en el centro de cómputo o afín">
						    <label>
						    	Empleado en institución educativa laborando en el centro de cómputo o afín
						    </label>
						</div>

						<div class="form-check" id="tipo_trabajo_madre">
						    <input id="tipo_trabajo_h" class="form-check-input" type="radio" name="tipo" value="Empleado en institución educativa laborando como docente">
						    <label>Empleado en institución educativa laborando como docente</label>
						</div>

						<input type="hidden" name="tipo_id">

				      </div>

				      <div class="modal-footer">
				        <button id="btn_cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
				      </div>

				    </div>
				  </div>
				</div>

				<!-- Modal {institucion educativa (trabajo) } -->
				
				<div class="modal fade" id="modal_instituto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLongTitle">
				        	Seleccione una de las siguientes opciones:
				        </h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>

				      <div class="modal-body" id="instituto_padre">

				      	<div class="form-check" id="instituto_madre">
						    <input id="instituto_a" class="form-check-input" type="radio" name="esc_tra" value="Preescolar">
						     <label>Preescolar</label>
						</div>

						<div class="form-check" id="instituto_madre">
							<input id="instituto_b" class="form-check-input" type="radio" name="esc_tra" value="Primaria">
						    <label>Primaria</label>
						</div>

						<div class="form-check" id="instituto_madre">
						    <input id="instituto_c" class="form-check-input" type="radio" name="esc_tra" value="Secundaria">
						    <label>Secundaria</label>
						</div>

						<div class="form-check" id="instituto_madre">
						    <input id="instituto_d" class="form-check-input" type="radio" name="esc_tra" value="Medio superior">
						    <label>Medio superior</label>
						</div>

						<div class="form-check" id="instituto_madre">
						    <input id="instituto_e" class="form-check-input" type="radio" name="esc_tra" value="Superior">
						    <label>Superior</label>
						</div>

						<div class="form-check" id="instituto_madre">
						    <input id="instituto_f" class="form-check-input" type="radio" name="esc_tra" value="Posgrado">
						    <label>Posgrado</label>
						</div>

						<input type="hidden" name="esc_tra_id">

				      </div>

				      <div class="modal-footer">
				        <button id="btn_cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">		
				        	Aceptar
				        </button>
				      </div>

				    </div>
				  </div>
				</div>

				<!-- <div class="form-group">
					<label>3. En caso de trabajar: ¿Cuál es su puesto de trabajo?</label>
					<input type="text" id="puesto_trabajo" class="form-control" name="puesto_trabajo" placeholder="Técnico, Superior, Jefe de area, etc.">
					<input type="hidden" class="puesto_trabajo" name="puesto_trabajo_id">
				</div> -->


				<div id="sect_empresa_padre" class="form-group">

					<label>3. Empresa donde labora</label>

					<div class="form-check" id="empresa_madre">
						<input id="empresa_a" class="form-check-input" type="radio" name="empresa_trabajo[]" value="Mittal">
						<label>Mittal</label>
					</div>

					<div class="form-check" id="empresa_madre">
						<input id="empresa_b" class="form-check-input" type="radio" name="empresa_trabajo[]" value="CFE de área">
						<label>CFE</label>
					</div>

					<div class="form-check" id="empresa_madre">
						<input id="empresa_c" class="form-check-input" type="radio" name="empresa_trabajo[]" value="Terminal Portuaria de Contenedores"> 
						<label>Terminal Portuaria de Contenedores</label>
					</div>

					<div class="form-group" id="empresa_madre">
					    <label>Otra</label>
					    <input type="text" id="empresa_d" class="form-control" name="empresa_trabajo[]">
					    <small class="form-text text-muted">Especifique</small>
				  	</div>

				  	<input type="hidden" name="empresa_id"/>

				</div>

				<div id="puesto_trabajo_padre" class="form-group">

					<label>4. ¿Cuál es su puesto de trabajo?</label> <!-- En caso de trabajar: -->

					<div class="form-check" id="puesto_trabajo_madre">
						<input id="puesto_trabajo_a" class="form-check-input" type="radio" name="puesto_trabajo[]" value="Gerente">
						<label>Gerente</label>
					</div>

					<div class="form-check" id="puesto_trabajo_madre">
						<input id="puesto_trabajo_b" class="form-check-input" type="radio" name="puesto_trabajo[]" value="Jefe de área">
						<label>Jefe de área</label>
					</div>

					<div class="form-check" id="puesto_trabajo_madre">
						<input id="puesto_trabajo_c" class="form-check-input" type="radio" name="puesto_trabajo[]" value="Supervisor"> 
						<label>Supervisor</label>
					</div>

					<div class="form-check" id="puesto_trabajo_madre">
						<input id="puesto_trabajo_d" class="form-check-input" type="radio" name="puesto_trabajo[]" value="Encargado de depto."> 
						<label>Encargado de depto.</label>
					</div>

					<div class="form-group" id="puesto_trabajo_madre">
					    <label>Otro</label>
					    <input type="text" id="puesto_trabajo_e" class="form-control" name="puesto_trabajo[]">
					    <small class="form-text text-muted">Especifique</small>
				  	</div>

				  	<input type="hidden" name="puesto_trabajo_id"/>

				</div>

				<div class="form-group" id="sect_sueldo_actual">

					<label>5. Salario actual:</label>

					<div class="form-check" id="sueldo_checked">
						<input id="sueldo_actual_a" class="form-check-input" type="radio" name="sueldo_act[]" value="5000 a 10000">
						<label>De 5000 a 10000 mensuales</label>
					</div>

					<div class="form-check" id="sueldo_checked">
						<input id="sueldo_actual_b" class="form-check-input" type="radio" name="sueldo_act[]" value="10000 a 15000">
						<label>De 10000 a 15000 mensuales</label>
					</div>

					<div class="form-check" id="sueldo_checked">
						<input id="sueldo_actual_c" class="form-check-input" type="radio" name="sueldo_act[]" value="15000 a 20000"> 
						<label>De 15000 a 20000 mensuales</label>
					</div>

					<div class="form-group" id="sueldo_checked">
						<label>Otra cantidad:</label>
						<input type="text" id="sueldo_actual_d" class="form-control" name="sueldo_act[]">
					</div>

					<input type="hidden" class="sueldo_dat" name="sueldo_act_id">
					<input type="hidden" name="salario_actual_id[]">

				</div>

				<div class="form-group" id="tipo_contrato_padre">

					<label>
						6. ¿Cuál es el tipo de contrato que tiene con la empresa?
					</label>

					<div class="form-check" id="tipo_contrato_madre">
						<input id="tipo_contrato_a" class="form-check-input" type="radio" name="tipo_contrato" value="Base">
						<label>Base</label>
					</div>

					<div class="form-check" id="tipo_contrato_madre">
						<input id="tipo_contrato_b" class="form-check-input" type="radio" name="tipo_contrato" value="Eventual">
						<label>Eventual</label>
					</div>

					<div class="form-check" id="tipo_contrato_madre">
						<input id="tipo_contrato_c" class="form-check-input" type="radio" name="tipo_contrato" value="Contrato">
						<label>Contrato</label>
					</div>

					<input type="hidden" name="tipo_contrato_id">
					<input type="hidden" name="tipo_contrato_id[]">

				</div>

				<div class="form-group" id="idioma_padre_tra">

					<label>7. ¿Cuál es el idioma que utiliza en la empresa?</label>

					<div class="form-check" id="idioma_madre_traba">
						<input id="idioma_tra_a" class="form-check-input" type="radio" name="idioma_empresa[]" value="Ingles">
						<label>Ingles</label>
					</div>

					<div class="form-check" id="idioma_madre_traba">
						<input id="idioma_tra_b" class="form-check-input" type="radio" name="idioma_empresa[]" value="Frances">
						<label>Frances</label>
					</div>

					<div class="form-check" id="idioma_madre_traba">
						<input id="idioma_tra_c" class="form-check-input" type="radio" name="idioma_empresa[]" value="Aleman"> 
						<label>Aleman</label>
					</div>

					<div class="form-check" id="idioma_madre_traba">
						<input id="idioma_tra_d" class="form-check-input" type="radio" name="idioma_empresa[]" value="Japones"> 
						<label>Japones</label>
					</div>

					<div class="form-group" id="idioma_madre_traba">
						<label>Otra:</label>
						<input type="text" id="idioma_tra_e" class="form-control" name="idioma_empresa[]">
					</div>

					<input type="hidden" name="idioma_empresa_id">
					<input type="hidden" class="idioma_emp" name="idioma_utl_trab_id">

				</div>

				<div class="form-group" id="antigueda_empleo_padre">

					<label>8. ¿Cuál es la antigüedad que tiene en la empresa?</label>

					<div class="form-check" id="antigueda_empleo_madre">
						<input id="antigueda_empleo_a" class="form-check-input" type="radio" name="antigueda_empresa" value="Menos de un año">
						<label>Menos de un año</label>
					</div>

					<div class="form-check" id="antigueda_empleo_madre">
						<input id="antigueda_empleo_b" class="form-check-input" type="radio" name="antigueda_empresa" value="Un año">
						<label>Un año</label>
					</div>

					<div class="form-check" id="antigueda_empleo_madre">
						<input id="antigueda_empleo_c" class="form-check-input" type="radio" name="antigueda_empresa" value="Dos años"> 
						<label>Dos años</label>
					</div>

					<div class="form-check" id="antigueda_empleo_madre">
						<input id="antigueda_empleo_d" class="form-check-input" type="radio" name="antigueda_empresa" value="Tres años"> 
						<label>Tres años</label>
					</div>

					<div class="form-check" id="antigueda_empleo_madre">
						<input id="antigueda_empleo_e" class="form-check-input" type="radio" name="antigueda_empresa" value="Mas de tres años"> 
						<label>Mas de tres años</label>
					</div>

					<input type="hidden" name="antigueda_empresa_id">
					<input type="hidden" class="antigueda_empleo_madre" name="antigueda_empleo_id">

				</div>

				<div class="form-group">
					<label>Año de ingreso:</label>
					<input type="text" id="ano_ingreso" class="form-control" name="ano_ingreso">
					<!-- <input type="hidden" class="ano_ingreso" name="ano_ingreso_id"> -->
					<input type="hidden" class="ano_ingreso" name="ano_ingreso_id">
				</div>

				<div class="form-group" id="tiempo_enc_trabajo_padre">

					<label>9. Tiempo transcurrido para obtener el primer empleo</label> <!-- En caso de trabajar: -->
					
					<div class="form-check" id="tiempo_enc_trabajo_madre">
						<input id="tim_ec_tra_a" class="form-check-input" type="radio" name="tim_enc_tra" value="Antes de egresar">
						<label>Antes de egresar</label>
					</div>

					<div class="form-check" id="tiempo_enc_trabajo_madre">
						<input id="tim_ec_tra_b" class="form-check-input" type="radio" name="tim_enc_tra" value="Menos de seis meses">
						<label>Menos de seis meses</label>
					</div>

					<div class="form-check" id="tiempo_enc_trabajo_madre">
						<input id="tim_ec_tra_c" class="form-check-input" type="radio" name="tim_enc_tra" value="Entre seis meses y un año"> 
						<label>Entre seis meses y un año</label>
					</div>

					<div class="form-check" id="tiempo_enc_trabajo_madre">
						<input id="tim_ec_tra_d" class="form-check-input" type="radio" name="tim_enc_tra" value="Más de un año"> 
						<label>Más de un año</label>
					</div>

					<input type="hidden" name="tim_enc_tra_id">
					<input type="hidden" name="select_id_enc_tra[]"/>

				</div>

				<div id="sect_medio_empleo_padre" class="form-group">

					<label>10. ¿Cuál fue el medio usado para obtener su primer empleo?</label>

					<div class="form-check" id="sect_medio_empleo_madre">
						<input id="medio_trabajo_a" class="form-check-input" type="radio" name="medio_trabajo[]" value="Bolsa de trabajo del plantel">
						<label>Bolsa de trabajo del plantel</label>
					</div>

					<div class="form-check" id="sect_medio_empleo_madre">
						<input id="medio_trabajo_b" class="form-check-input" type="radio" name="medio_trabajo[]" value="Contactos personales">
						<label>Contactos personales</label>
					</div>

					<div class="form-check" id="sect_medio_empleo_madre">
						<input id="medio_trabajo_c" class="form-check-input" type="radio" name="medio_trabajo[]" value="Residencia profesional"> 
						<label>Residencia profesional</label>
					</div>

					<div class="form-group" id="sect_medio_empleo_madre">
					    <label>Otro</label>
					    <input type="text" id="medio_trabajo_d" class="form-control" name="medio_trabajo[]">
					    <small class="form-text text-muted">Especifique</small>
				  	</div>

				  	<input type="hidden" name="medio_trabajo_id"/>

				</div>

				<div class="form-group" id="main_tam_emp">

					<label>11. ¿De qué tamaño es la empresa donde labora?</label>

					<div class="form-check" id="tam_emp">
						<input id="tam_emp_a" class="form-check-input" type="radio" name="tam_emp" value="Microempresa (1-30) personas">
						<label>Microempresa (1-30) personas</label>
					</div>

					<div class="form-check" id="tam_emp">
						<input id="tam_emp_b" class="form-check-input" type="radio" name="tam_emp" value="Pequeña (31-100) personas">
						<label>Pequeña (31-100) personas</label>
					</div>

					<div class="form-check" id="tam_emp">
						<input id="tam_emp_c" class="form-check-input" type="radio" name="tam_emp" value="Mediana (101-500) personas"> 
						<label>Mediana (101-500) personas</label>
					</div>

					<div class="form-check" id="tam_emp">
						<input id="tam_emp_d" class="form-check-input" type="radio" name="tam_emp" value="Grande (más de 500) personas "> 
						<label>Grande (más de 500) personas</label>
					</div>

					<input type="hidden" name="tam_emp_id"/>
					<input type="hidden" name="tamano_empresa_id"/>

				</div>


				<div class="form-group" id="efi_acti_padre">

					<label>
						12. ¿Cómo es su eficiencia para realizar las actividades laborales en relación con su formación académica?
					</label>

					<div class="form-check" id="efi_acti_madre">
						<input id="efi_acti_a" class="form-check-input" type="radio" name="efi_acti" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="efi_acti_madre">
						<input id="efi_acti_b" class="form-check-input" type="radio" name="efi_acti" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="efi_acti_madre">
						<input id="efi_acti_c" class="form-check-input" type="radio" name="efi_acti" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="efi_acti_madre">
						<input id="efi_acti_d" class="form-check-input" type="radio" name="efi_acti" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="efi_acti_id">

				</div>

				<div class="form-group" id="form_acad_padre">

					<label>
						13. ¿Cómo califica su formación académica con respecto a su desempeño laboral?
					</label>

					<div class="form-check" id="form_acad_madre">
						<input id="form_acad_a" class="form-check-input" type="radio" name="form_acad" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="form_acad_madre">
						<input id="form_acad_b" class="form-check-input" type="radio" name="form_acad" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="form_acad_madre">
						<input id="form_acad_c" class="form-check-input" type="radio" name="form_acad" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="form_acad_madre">
						<input id="form_acad_d" class="form-check-input"type="radio" name="form_acad" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="form_acad_id">

				</div>

				<div class="form-group" id="utl_rprof_padre">

					<label>
						14. Utilidad de las residencias profesionales o prácticas profesionales para su desarrollo laboral y profesional
					</label>

					<div class="form-check" id="utl_rprof_madre">
						<input id="utl_rprof_a" class="form-check-input" type="radio" name="utl_rprof" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="utl_rprof_madre">
						<input id="utl_rprof_b" class="form-check-input" type="radio" name="utl_rprof" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="utl_rprof_madre">
						<input id="utl_rprof_c" class="form-check-input" type="radio" name="utl_rprof" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="utl_rprof_madre">
						<input id="utl_rprof_d" class="form-check-input"type="radio" name="utl_rprof" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="utl_rprof_id">

				</div>

			</div>

		</div>

			<!---------Reporte de ubicación laboral------->

			<hr/>

			<!---------pertinencia y disponibilidad de medios y recursos para el aprendizaje------------>

			<div class="container_pre">

				<div id="perfiles">
					<h4>
						Pertinencia y disponibilidad de medios y recursos para el aprendizaje
					</h4>
				</div>

				<div class="form-group" id="calidad_doc_padre">

					<label>1. ¿Cómo considera la calidad de los docentes del ITLAC?</label>

					<div class="form-check" id="calidad_doc_madre">
						<input id="calidad_doc_a" class="form-check-input" type="radio" name="calidad_doc" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="calidad_doc_madre">
						<input id="calidad_doc_b" class="form-check-input" type="radio" name="calidad_doc" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="calidad_doc_madre">
						<input id="calidad_doc_c" class="form-check-input" type="radio" name="calidad_doc" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="calidad_doc_madre">
						<input id="calidad_doc_d" class="form-check-input" type="radio" name="calidad_doc" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="calidad_doc_id">

				</div>

				<div class="form-group" id="plan_es_padre">

					<label>2. ¿Cómo considera el plan de estudios del ITLAC?</label>

					<div class="form-check" id="plan_es_madre">
						<input id="plan_es_a" class="form-check-input" type="radio" name="plan_es" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="plan_es_madre">
						<input id="plan_es_b" class="form-check-input" type="radio" name="plan_es" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="plan_es_madre">
						<input id="plan_es_c" class="form-check-input" type="radio" name="plan_es" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="plan_es_madre">
						<input id="plan_es_d" class="form-check-input" type="radio" name="plan_es" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="plan_es_id">

				</div>

				<div class="form-group" id="opot_proy_padre">

					<label>3. ¿Cómo son las oportunidades de participar en proyectos de investigación y desarrollo?</label>

					<div class="form-check" id="opot_proy_madre">
						<input id="opot_proy_a" class="form-check-input" type="radio" name="opot_proy" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="opot_proy_madre">
						<input id="opot_proy_b" class="form-check-input" type="radio" name="opot_proy" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="opot_proy_madre">
						<input id="opot_proy_c" class="form-check-input" type="radio" name="opot_proy" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="opot_proy_madre">
						<input id="opot_proy_d" class="form-check-input" type="radio" name="opot_proy" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="opot_proy_id">

				</div>

				<div class="form-group" id="investigacion_ense_padre">

					<label>
						4. Énfasis que se le prestaba a la investigación dentro del proceso de enseñanza 
					</label>

					<div class="form-check" id="investigacion_ense_madre">
						<input id="investigacion_ense_a" class="form-check-input" type="radio" name="investigacion" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="investigacion_ense_madre">
						<input id="investigacion_ense_b" class="form-check-input" type="radio" name="investigacion" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="investigacion_ense_madre">
						<input id="investigacion_ense_c" class="form-check-input" type="radio" name="investigacion" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="investigacion_ense_madre">
						<input id="investigacion_ense_d" class="form-check-input" type="radio" name="investigacion" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="investigacion_id">

				</div>

				<div class="form-group" id="cond_es_padre">

					<label>
						5. ¿Cuál fue su satisfacción con las condiciones de estudio (infraestructura)?
					</label>

					<div class="form-check" id="cond_es_madre">
						<input id="cond_es_a" class="form-check-input" type="radio" name="cond_es" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="cond_es_madre">
						<input id="cond_es_b" class="form-check-input" type="radio" name="cond_es" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="cond_es_madre">
						<input id="cond_es_c" class="form-check-input" type="radio" name="cond_es" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="cond_es_madre">
						<input id="cond_es_d" class="form-check-input" type="radio" name="cond_es" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="cond_es_id">

				</div>

				<div class="form-group" id="exp_res_padre">

					<label>
						6. ¿Cómo fue su experiencia obtenida a través de la residencia profesional?
					</label>

					<div class="form-check" id="exp_res_madre">
						<input id="exp_res_a" class="form-check-input" type="radio" name="exp_res" value="Muy buena">
						<label>Muy buena</label>
					</div>

					<div class="form-check" id="exp_res_madre">
						<input id="exp_res_b" class="form-check-input" type="radio" name="exp_res" value="Buena">
						<label>Buena</label>
					</div>

					<div class="form-check" id="exp_res_madre">
						<input id="exp_res_c" class="form-check-input" type="radio" name="exp_res" value="Regular"> 
						<label>Regular</label>
					</div>

					<div class="form-check" id="exp_res_madre">
						<input id="exp_res_d" class="form-check-input" type="radio" name="exp_res" value="Mala"> 
						<label>Mala</label>
					</div>

					<input type="hidden" name="exp_res_id">

				</div>

				<div class="form-group">
					<label>
						7. ¿Tiene alguna sugerencia o comentario para mejorar la calidad de enseñanza en el ITLAC?
					</label>
					<textarea id="sugerencia" class="form-control" name="sugerencia"></textarea>
					<input type="hidden" class="sugerencia" name="sugerencia_id">
				</div> 

				<button id="btn_aceptar" type="button" class="btn btn-primary">Guardar</button>

			</div>

				<!--
		         <button id="btn_consultar" type="button" class="btn btn-primary">Consultar</button>
                -->

		</div>

	<!-- 	Notificacion -->

	<!-- Modal -->
		<div class="modal fade" id="notificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">Notificación</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<h6 id="nota_modal"></h6>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>

	</form>

	</div>

	<?php include_once '../scripts/http/include_script_js.php'; ?>

</body>
</html>