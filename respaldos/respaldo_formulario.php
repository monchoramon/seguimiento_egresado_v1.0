
<?php
	session_start();
	if( @$_SESSION["nombre_completo"] ){
?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>Consulta encuesta</title>
	<?php include_once '../scripts/http/include.php'; ?>

</head>
<body>

	<div id="title_a"><h3>ENCUESTA PARA SEGUIMIENTO DE EGRESADOS</h3></div>
	<header></header>

	<div class="container">

			<form id="encuesta_egresados">	

				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

				  <div class="collapse navbar-collapse" id="navbarText">
				    <ul class="navbar-nav mr-auto">
				      <li class="nav-item active">
				        <a class="nav-link" href="#">Incio <span class="sr-only">(current)</span></a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Cerrar sesión</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="#">Crear nuevo administrador</a>
				      </li>
				        <li class="nav-item">
				        <a class="nav-link" href="#">Registro docente</a>
				      </li>
				    </ul>

				    <span class="navbar-text">
				      Seguimiento de egresados
				    </span>

				  </div>
				</nav>

				<div id="perfiles">
					<h4>Perfil de egresado</h4>
				</div>

				<div id="form_container">
					
					<div class="container_pre">

						<!---------Perfil del egresado------->

						<div class="form-group">
							<label>1. Número de control:</label>	
							<input type="text" id="numero_control" class="form-control" name="numero_control">
							<input type="hidden" class="numero_control" name="select_id[]">
						</div>

						<div class="form-group">
							<label>2. Nombre completo:</label>
							<input type="text" id="nombre_completo" class="form-control" name="nombre_completo">	
							<input type="hidden" class="nombre_completo" name="select_id[]">
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

							<input type="hidden" name="select_id[]">

						</div>

						<div class="form-group">
							<label>4. Télefono:</label>
							<input type="text" id="telefono" class="form-control" name="telefono">	
							<input type="hidden" class="telefono" name="select_id[]">
						</div>

						<div class="form-group">
							<label>5. Email:</label>
							<input type="email" id="email" class="form-control" name="email">	
							<input type="hidden" class="email" name="select_id[]">
						</div>

						<div class="form-group">
							<label>6. Año de egreso: </label>
							<input type="date" id="ano_egreso" class="form-control" name="ano_egreso">
							<input type="hidden" class="ano_egreso" name="select_id[]">
						</div>

						<div class="form-group" id="titulado_padre">

							<div>
								<label>7. ¿Estás titulado?</label>
							</div>

							<div class="form-check" id="titulado_madre">
								<input id="titulado_a" class="form-check-input" type="radio" name="titulo" value="Si">
								<label>Si</label>
							</div>

						    <div class="form-check" id="titulado_madre">
						    	<input id="titulado_b" class="form-check-input" type="radio" name="titulo" value="No">
						   		<label>No</label>
						    </div>

							<input type="hidden" name="select_id[]">

						</div>

						<div class="form-group" id="posgrado_padre">

							<label><b>8. ¿Tienes posgrado?</b></label>

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
								<input type="hidden" name="id_input_pos" value="posgrado_a">
							</div>

							<input type="hidden" name="id_tipe_radio_pos">

						</div>
			

						<div class="form-group" id="padre_idiomas">

							<label><b>9. ¿Qué lenguaje extranjero dominas?</b></label>

							<div class="form-check" id="idioma_a_madre">
								
								<input class="form-check-input" id="idioma_a" type="checkbox" name="idioma[]" value="Inglés">
								<label>Inglés</label>
								<input class="idioma_a" type="hidden" name="id_idioma_txt[]">

								<div class="form-group">
									<label>Porcentaje de dominio</label>
									<input type="text" class="form-control" id="porcentaje_dom_a" name="porcentaje_dom[]" placeholder="20% al 100%">
									<!-- <input class="porcentaje_dom_a" type="hidden" name="porcentaje_id[]"> -->
									<input class="porcentaje_dom_a" type="hidden" name="id_idioma_por[]">
								</div>

							</div>

							<div class="form-check" id="idioma_b_madre">

								<input class="form-check-input" id="idioma_b" type="checkbox" name="idioma[]" value="Francés">
								<label>Francés</label>
								<input class="idioma_b" type="hidden" name="id_idioma_txt[]">

								<div class="form-group">
									<label>Porcentaje de dominio</label>
									<input type="text" class="form-control" id="porcentaje_dom_b" name="porcentaje_dom[]" placeholder="20% al 100%">
									<!-- <input class="porcentaje_dom_b" type="hidden" name="porcentaje_id[]">-->		<input class="porcentaje_dom_b" type="hidden" name="id_idioma_por[]">
								</div>

							</div>

							<div class="form-check" id="idioma_c_madre">

								<input class="form-check-input" id="idioma_c" type="checkbox" name="idioma[]" value="Alemán"> 
								<label>Alemán</label>
								<input class="idioma_c" type="hidden" name="id_idioma_txt[]">

								<div class="form-group">
									<label>Porcentaje de dominio</label>
									<input type="text" class="form-control" id="porcentaje_dom_c" name="porcentaje_dom[]" placeholder="20% al 100%">
									<!-- <input class="porcentaje_dom_c" type="hidden" name="porcentaje_id[]"> -->
									<input class="porcentaje_dom_c" type="hidden" name="id_idioma_por[]">
								</div>

							</div>

							<div id="idioma_d_madre">

							    <label>Otro</label>
							    <input type="text" class="form-control" id="idioma_d" name="idioma[]" placeholder="Chino, Ruso, etc.">
							    <small class="form-text text-muted">Especifique</small>
							    <input class="idioma_d" type="hidden" name="id_idioma_txt[]">

							    <div class="form-group">
									<label>Porcentaje de dominio</label>
									<input type="text" class="form-control" id="porcentaje_dom_d" name="porcentaje_dom[]" placeholder="20% al 100%">
									<!-- <input class="porcentaje_dom_d" type="hidden" name="porcentaje_id[]"> -->
									<input class="porcentaje_dom_d" type="hidden" name="id_idioma_por[]">
								</div>

						  	</div>

						</div>

					</div>

				<!---------Perfil del egresado------->


					<hr/>

				<!---------Reporte de ubicación laboral------->

				<div class="container_pre">

					<div id="perfiles">
						<h4>Ubicación laboral</h4>
					</div>

					<div class="form-group" id="trabajando_padre">
						
						<label><b>1. ¿Estás trabajando?</b></label>

						<div id="trabajando_madre">
							<input id="tipe_0" type="radio" name="trabaja_tipo" value="Si">
							<label>Si</label>
						</div>
						
						<div id="trabajando_madre">
							<input id="tipe_1" type="radio" name="trabaja_tipo" value="No">
							<label>No</label>
						</div>

						<div class="alert alert-secondary" role="alert">
							<label>Respuesta seleccionada:</label>
							<input type="text" id="trabajo_actual_conf" class="form-control" name="trabajo_actual_conf">
							<input type="hidden" name="id_input_trabajo" value="trabajo_actual_conf">
						</div>

						<input type="hidden" name="id_radio_trabajando_val[]">

					</div>

					<div class="form-group">
						<label>2. ¿Cuál es tu puesto de trabajo?</label>
						<input type="text" id="puestro_traba" class="form-control" name="puestro_traba">
						<input type="hidden" class="puestro_traba" name="select_id[]">
					</div>

					<div class="form-group" id="sect_sueldo_actual">

						<label>3. Salario actual:</label>

						<div class="form-check" id="sueldo_checked">
							<input id="sueldo_actual_a" class="form-check-input" type="radio" name="sueldo_act[]" value="5000 a 10000">
							<label>De 5000 a 10000</label>
						</div>

						<div class="form-check" id="sueldo_checked">
							<input id="sueldo_actual_b" class="form-check-input" type="radio" name="sueldo_act[]" value="10000 a 15000">
							<label>De 10000 a 15000</label>
						</div>

						<div class="form-check" id="sueldo_checked">
							<input id="sueldo_actual_c" class="form-check-input" type="radio" name="sueldo_act[]" value="15000 a 20000"> 
							<label>De 15000 a 20000</label>
						</div>

						<div class="form-group" id="sueldo_checked">
							<label>Otra cantidad:</label>
							<input type="text" id="sueldo_actual_d" class="form-control" name="sueldo_act[]">
						</div>

						<input type="hidden" class="sueldo_dat" name="select_id[]">

					</div>

					<div class="form-group" id="tipo_contrato_padre">

						<label>4. ¿Cuál es el tipo de contrato que tienes con la empresa?</label>

						<div class="form-check" id="tipo_contrato_madre">
							<input id="tipo_contrato_a" class="form-check-input" type="radio" name="tipo_contrato" value="Base">
							<label>Base</label>
						</div>

						<div class="form-check" id="tipo_contrato_madre">
							<input id="tipo_contrato_b" class="form-check-input" type="radio" name="tipo_contrato" value="Eventual">
							<label>Eventual</label>
						</div>

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group">

						<label>5. ¿Cuál es el idioma que utilizas en la empresa?</label>

						<div>
						    <input type="text" id="idioma_emp" class="form-control" name="idioma_emp" placeholder="Inglés, Chino, Ruso, etc.">
							<input type="hidden" class="idioma_emp" name="select_id[]">
					  	</div>

					</div>

					<div class="form-group">
						<label>6. ¿Cuál es la antigüedad que tienes en la empresa?</label>
						<input id="ant_emp" class="form-control" type="text" name="ant_emp">
						<input type="hidden" class="ant_emp" name="select_id[]">
					</div>

					<div class="form-group" id="main_tam_emp">

						<label>7. ¿De qué tamaño es la empresa donde laboras?</label>

						<div class="form-check" id="tam_emp">
							<input id="tam_emp_a" class="form-check-input" type="radio" name="tam_emp" value="Microempresa (1-30) personas">
							<label>Microempresa (1-30) personas</label>
						</div>

						<div class="form-check" id="tam_emp">
							<input id="tam_emp_b" class="form-check-input" type="radio" name="tam_emp" value="Pequeña (31-100) personas">
							<label>Pequeña (31-100) personas</label>
						</div>

						<div class="form-check" id="tam_emp">
							<input id="tam_emp_c" class="form-check-input" type="radio" name="tam_emp" value="Mediana (101-500) personas "> 
							<label>Mediana (101-500) personas</label>
						</div>

						<div class="form-check" id="tam_emp">
							<input id="tam_emp_d" class="form-check-input" type="radio" name="tam_emp" value="Grande (más de 500) personas "> 
							<label>Grande (más de 500) personas</label>
						</div>

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group">
						<label>8. ¿Cuál fue el tiempo transcurrido para obtener tu primer empleo?</label>
						<input id="timp_emp" class="form-control" type="text" name="timp_emp">
						<input type="hidden" class="timp_emp" name="select_id[]">
					</div>

					<div id="sect_medio_empleo_padre" class="form-group">

						<label>9. ¿Cuál fue el medio usado para obtener tu primer empleo?</label>

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

					  	<input type="hidden" name="select_id[]">

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

						<label>¿Cómo consideras la calidad de los docentes del ITLAC?</label>

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

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="plan_es_padre">

						<label>¿Cómo consideras el plan de estudios del ITLAC?</label>

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

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="opot_proy_padre">

						<label>¿Cómo son las oportunidades de participar en proyectos de investigación y desarrollo?</label>

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

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="investigacion_ense_padre">

						<label>
							Énfasis que se le prestaba a la investigación dentro del proceso de enseñanza 
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

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="cond_es_padre">

						<label>
							¿Cuál fue su satisfacción con las condiciones de estudio (infraestructura)?
						</label>

						<div class="form-check" id="cond_es_madre">
							<input id="cond_es_a" class="form-check-input" type="radio" name="cond_es" value="Excelente">
							<label>Excelente</label>
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

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="exp_res_padre">

						<label>
							¿Cómo fue tu experiencia obtenida a través de la residencia profesional?
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

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="efi_acti_padre">

						<label>
							¿Cómo es su eficiencia para realizar las actividades laborales en relación con su formación académica?
						</label>

						<div class="form-check" id="efi_acti_madre">
							<input id="efi_acti_a" class="form-check-input" type="radio" name="efi_acti" value="Muy eficiente">
							<label>Muy eficiente</label>
						</div>

						<div class="form-check" id="efi_acti_madre">
							<input id="efi_acti_b" class="form-check-input" type="radio" name="efi_acti" value="Eficiente">
							<label>Eficiente</label>
						</div>

						<div class="form-check" id="efi_acti_madre">
							<input id="efi_acti_c" class="form-check-input" type="radio" name="efi_acti" value="Poco eficiente"> 
							<label>Poco eficiente</label>
						</div>

						<div class="form-check" id="efi_acti_madre">
							<input id="efi_acti_d" class="form-check-input" type="radio" name="efi_acti" value="Deficiente"> 
							<label>Deficiente</label>
						</div>

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="form_acad_padre">

						<label>
							¿Cómo califica su formación académica con respecto a su desempeño laboral?
						</label>

						<div class="form-check" id="form_acad_madre">
							<input id="form_acad_a" class="form-check-input" type="radio" name="form_acad" value="Excelente">
							<label>Excelente</label>
						</div>

						<div class="form-check" id="form_acad_madre">
							<input id="form_acad_b" class="form-check-input" type="radio" name="form_acad" value="Bueno">
							<label>Bueno</label>
						</div>

						<div class="form-check" id="form_acad_madre">
							<input id="form_acad_c" class="form-check-input" type="radio" name="form_acad" value="Regular"> 
							<label>Regular</label>
						</div>

						<div class="form-check" id="form_acad_madre">
							<input id="form_acad_d" class="form-check-input"type="radio" name="form_acad" value="Malo"> 
							<label>Malo</label>
						</div>

						<div class="form-check" id="form_acad_madre">
							<input id="form_acad_e" class="form-check-input"type="radio" name="form_acad" value="Pesimo"> 
							<label>Pesimo</label>
						</div>

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group" id="utl_rprof_padre">

						<label>
							Utilidad de las residencias profesionales o prácticas profesionales para su desarrollo laboral y profesional
						</label>

						<div class="form-check" id="utl_rprof_madre">
							<input id="utl_rprof_a" class="form-check-input" type="radio" name="utl_rprof" value="Excelente">
							<label>Excelente</label>
						</div>

						<div class="form-check" id="utl_rprof_madre">
							<input id="utl_rprof_b" class="form-check-input" type="radio" name="utl_rprof" value="Bueno">
							<label>Bueno</label>
						</div>

						<div class="form-check" id="utl_rprof_madre">
							<input id="utl_rprof_c" class="form-check-input" type="radio" name="utl_rprof" value="Regular"> 
							<label>Regular</label>
						</div>

						<div class="form-check" id="utl_rprof_madre">
							<input id="utl_rprof_d" class="form-check-input"type="radio" name="utl_rprof" value="Malo"> 
							<label>Malo</label>
						</div>

						<div class="form-check" id="utl_rprof_madre">
							<input id="utl_rprof_e" class="form-check-input"type="radio" name="utl_rprof" value="Pesimo"> 
							<label>Pesimo</label>
						</div>

						<input type="hidden" name="select_id[]">

					</div>

					<div class="form-group">
						<label>¿Tienes alguna sugerencia o comentario para mejorar la calidad de enseñanza en el ITLAC?</label>
						<textarea id="sugerencia" class="form-control" name="sugerencia"></textarea>
						<input type="hidden" class="sugerencia" name="select_id[]">
					</div> 

				</div>

				<!--Modales-->

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

						<input type="hidden" name="id_tipo_trabajo_radio">

				      </div>

				      <div class="modal-footer">
				        <button id="btn_cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">Aceptar</button>
				      </div>
				    </div>
				  </div>
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

						<input type="hidden" name="id_posgrado_radio">

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

						<input type="hidden" name="id_radio_instituto_select">

				      </div>

				      <div class="modal-footer">
				        <button id="btn_cerrar" type="button" class="btn btn-secondary" data-dismiss="modal">		Aceptar
				        </button>
				      </div>

				    </div>
				  </div>
				</div>

<!-- 				<button id="btn_consultar" type="button" class="btn btn-primary">Consultar</button>
 -->
			</div>

		</form>

	</div>

	</div>

	<?php include_once '../scripts/http/include_script_js.php'; ?>
	<script src="../scripts/js/pintar_encuesta.js"></script>

</body>
</html>

<?php }else{ ?>
	<?php 
		header("Location: ../acceso/");
	?>
<?php }?>