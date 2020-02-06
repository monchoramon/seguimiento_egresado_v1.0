<?php

include_once '../../PDO/bd/conexion.php';
include_once "../tipo_privilegio/get_privilegios.php";

// include_once '../consultar_cuestionario/consultar.php';

class registro{

	public $conexion;
	public $numero_control;
	public $periodo;
	public $ano_egreso_largo;
	public $info_input;
	public $id_input;
	public $data_perfil_egresado; 
	public $data_ubicacion_laboral;
	public $data_pertinencia;
	public $id_registro;
	public $nombre_completo;
	public $email;
	public $telefono;
	public $date;
	public $tipo;
	public $PK_col;
	public $PK_col_ident;

	function __construct(){

		date_default_timezone_set('UTC');

		$pdo = new conexion();
		$this->conexion = $pdo->bd();
		$this->numero_control = @$_POST["numero_control"];
		$this->periodo = @$_POST["periodo"];
		$this->ano_egreso_largo = @$_POST["ano_egreso"];
		$this->nombre_completo = @$_POST["nombre_completo"];
		$this->tipo = (int) $_POST["tipe"];
		$this->email = @$_POST["email"];
		$this->telefono = @$_POST["telefono"];
		$this->id_registro = null;
		$this->info_input = null;
		$this->id_input = null;
		$this->data_perfil_egresado = array();
		$this->data_ubicacion_laboral = array();
		$this->data_pertinencia = array();
		$this->date = new DateTime( $this->ano_egreso_largo );
		$this->PK_col = null;
		$this->PK_col_ident = null;
		$this->privilegios = new privilegios();

	}

	public function insert_n_control(){

		if( !registro::confirmar_registro()["tipe"] ){

			$ano_egreso_corto = $this->date->format('Y');

			$stmt = $this->conexion->prepare ("INSERT INTO cuestionario(numero_control, periodo, ano_egreso_largo, ano_egreso_corto) VALUES (:num_control, :periodo, :ano_egreso_largo, :ano_egreso_corto)");

			$stmt -> bindParam(':num_control', $this->numero_control);
			$stmt -> bindParam(':periodo', $this->periodo);
			$stmt -> bindParam(':ano_egreso_largo', $this->ano_egreso_largo);
			$stmt -> bindParam(':ano_egreso_corto', $ano_egreso_corto);

			if( $stmt -> execute() ){

				$this->id_registro = registro::confirmar_registro()["id_registro"];
					registro::cuestionario_A();

			}else{
				print_r(json_encode( array("tipe"=>false, "txt"=>"No se pudo procesar la petición.") ));
			}

		}else{
			print_r(json_encode( array("tipe"=>false, "txt"=>"Usted ya tiene una encuesta registrada.") ));
		}


	}

	public function cuestionario_A(){

				$data_array = registro::array_data();

				// print_r(json_encode(array($info_input, $id_input)));
		
				$ctn = 0;

				foreach ($data_array[0] as $key => $value_txt) {

					$stmt = $this->conexion->prepare ("INSERT INTO preguntas (id_cuestionario, id_tag, respuesta) VALUES (:id_cuestionario, :id_tag, :respuesta)");

					$stmt ->bindParam('id_cuestionario', $this->id_registro);

						if($key != 18){
							$val_id = $data_array[1][$key];
						}else{
							$val_id = $data_array[1][$key][0];
						}

						if($key != 16 && $key != 17 && $key != 19 && $key != 24 && $key != 45){
							$val_txt = $data_array[0][$key];
						}else{
							$val_txt = $data_array[0][$key][0];
						}

					$stmt ->bindParam('id_tag', $val_id);
					$stmt ->bindParam('respuesta', $val_txt);

					if( $stmt ->execute() ){
						$ctn++;
					}

				}


					if( $ctn > 0 ){
						registro::gestionar_reportes();
					}else{
						print_r(json_encode( array("tipe"=>false, "txt"=>"Error interno del servidor :-(") ));
					}	

		// registro::gestionar_reportes();

	}


		public function gestionar_reportes(){

			$data_array = registro::array_data();

			$perfil_egresado = array(2, 7, 10, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44);
			$ubicacion_laboral = array(11, 14, 15, 16, 17, 18, 19, 20, 23, 24, 22, 45);
			$pertinencia = array(25, 26, 27, 28, 29, 30, 31, 32, 33);

			foreach ($perfil_egresado as $key => $value){
				$this->data_perfil_egresado[] = $data_array[0][$value];
			}

				foreach ($ubicacion_laboral as $key => $value){
					if($value != 16 && $value != 17 && $value != 19 && $value != 24 && $value != 45){
						$this->data_ubicacion_laboral[] = $data_array[0][$value];
					}else{
						$this->data_ubicacion_laboral[] = $data_array[0][$value][0];
					}
				}

					foreach ($pertinencia as $key => $value){
						$this->data_pertinencia[] = $data_array[0][$value];
					}

			// print_r(json_encode( array( $this->data_ubicacion_laboral, $_POST["empresa_id"]) ));
			
			if( $this->data_perfil_egresado && $this->data_ubicacion_laboral && $this->data_pertinencia ){
				registro::perfil_egresado();
			}else{
				print_r(json_encode( array("tipe"=>false, "txt"=>"Error interno del servidor :-(") ));
			}


		}


		public function perfil_egresado(){

			// print_r(json_encode( array( $this->data_perfil_egresado, $this->data_ubicacion_laboral, $this->data_pertinencia) ));

			$sexo = @$this->data_perfil_egresado[0];
			$titulado = @$this->data_perfil_egresado[1];
			$posgrado = @$this->data_perfil_egresado[2];
			$lugar_residencia_ciudad = @$this->data_perfil_egresado[3];
			$lugar_residencia_estado = @$this->data_perfil_egresado[4];
			$lenguaje_idioma_a = @$this->data_perfil_egresado[5];
			$lenguaje_porcentaje_a = @$this->data_perfil_egresado[6];
			$lenguaje_idioma_b = @$this->data_perfil_egresado[7];
			$lenguaje_porcentaje_b = @$this->data_perfil_egresado[8];
			$lenguaje_idioma_c = @$this->data_perfil_egresado[9];
			$lenguaje_porcentaje_c = @$this->data_perfil_egresado[10];
			$lenguaje_idioma_d = @$this->data_perfil_egresado[11];
			$lenguaje_porcentaje_d = @$this->data_perfil_egresado[12];

			$stmt = $this->conexion->prepare ("INSERT INTO reporte_perfil_egresado(id_cuestionario, sexo, titulado, posgrado, lugar_residencia_ciudad, lugar_residencia_estado, lenguaje_idioma_a, lenguaje_porcentaje_a, lenguaje_idioma_b, lenguaje_porcentaje_b, lenguaje_idioma_c, lenguaje_porcentaje_c, lenguaje_idioma_d, lenguaje_porcentaje_d) VALUES (
											:id_cuestionario,
											:sexo,
											:titulado,
											:posgrado,
											:lugar_residencia_ciudad,
											:lugar_residencia_estado,
											:lenguaje_idioma_a,
											:lenguaje_porcentaje_a,
											:lenguaje_idioma_b,
											:lenguaje_porcentaje_b,
											:lenguaje_idioma_c,
											:lenguaje_porcentaje_c,
											:lenguaje_idioma_d,
											:lenguaje_porcentaje_d
											) ");

					$stmt ->bindParam(':id_cuestionario', $this->id_registro);
					$stmt ->bindParam(':sexo', $sexo);
					$stmt ->bindParam(':titulado', $titulado);
					$stmt ->bindParam(':posgrado', $posgrado);
					$stmt ->bindParam(':lugar_residencia_ciudad', $lugar_residencia_ciudad);
					$stmt ->bindParam(':lugar_residencia_estado', $lugar_residencia_estado);
					$stmt ->bindParam(':lenguaje_idioma_a', $lenguaje_idioma_a);
					$stmt ->bindParam(':lenguaje_porcentaje_a',$lenguaje_porcentaje_a);
					$stmt ->bindParam(':lenguaje_idioma_b', $lenguaje_idioma_b);
					$stmt ->bindParam(':lenguaje_porcentaje_b', $lenguaje_porcentaje_b);
					$stmt ->bindParam(':lenguaje_idioma_c', $lenguaje_idioma_c);
					$stmt ->bindParam(':lenguaje_porcentaje_c', $lenguaje_porcentaje_c);
					$stmt ->bindParam(':lenguaje_idioma_d', $lenguaje_idioma_d);
					$stmt ->bindParam(':lenguaje_porcentaje_d', $lenguaje_porcentaje_d);

				if( $stmt ->execute() ){
					registro::ubicacion_laboral();
				}else{
					print_r(json_encode( array("tipe"=>false, "txt"=>"Error interno del servidor :-(") ));
				}

		}


		public function ubicacion_laboral(){


				$actividad_actual = @$this->data_ubicacion_laboral[0];
				$area_dependencia = @$this->data_ubicacion_laboral[1];
				$nivel_educacion = @$this->data_ubicacion_laboral[2];
				$puesto_trabajo = @$this->data_ubicacion_laboral[3];
				$salario_actual = @$this->data_ubicacion_laboral[4];
				$tipo_contrato = @$this->data_ubicacion_laboral[5];
				$idioma_trabajo = @$this->data_ubicacion_laboral[6];
				$antiguedad_empresa = @$this->data_ubicacion_laboral[7];
				$tiempo_transcurrido_empleo = @$this->data_ubicacion_laboral[8];
				$medio_usado_empleo = @$this->data_ubicacion_laboral[9];
				$tamano_empresa = @$this->data_ubicacion_laboral[10];
				$empresa_trabajo = @$this->data_ubicacion_laboral[11];

				$stmt = $this->conexion->prepare (" INSERT INTO reporte_ubicacion_laboral(id_cuestionario, actividad_actual, area_dependencia, nivel_educacion, puesto_trabajo, salario_actual, tipo_contrato, idioma_trabajo, antiguedad_empresa, tiempo_transcurrido_empleo, medio_usado_empleo, tamano_empresa, empresa_trabajo) VALUES (
											:id_cuestionario,
											:actividad_actual,
											:area_dependencia,
											:nivel_educacion,
											:puesto_trabajo,
											:salario_actual,
											:tipo_contrato,
											:idioma_trabajo,
											:antiguedad_empresa,
											:tiempo_transcurrido_empleo,
											:medio_usado_empleo,
											:tamano_empresa,
											:empresa_trabajo
										) ");

				$stmt ->bindParam(':id_cuestionario', $this->id_registro);
				$stmt ->bindParam(':actividad_actual', $actividad_actual);
				$stmt ->bindParam(':area_dependencia', $area_dependencia);
				$stmt ->bindParam(':nivel_educacion', $nivel_educacion);
				$stmt ->bindParam(':puesto_trabajo', $puesto_trabajo);
				$stmt ->bindParam(':salario_actual', $salario_actual);
				$stmt ->bindParam(':tipo_contrato', $tipo_contrato);
				$stmt ->bindParam(':idioma_trabajo', $idioma_trabajo);
				$stmt ->bindParam(':antiguedad_empresa', $antiguedad_empresa);
				$stmt ->bindParam(':tiempo_transcurrido_empleo', $tiempo_transcurrido_empleo);
				$stmt ->bindParam(':medio_usado_empleo', $medio_usado_empleo);
				$stmt ->bindParam(':tamano_empresa', $tamano_empresa);
				$stmt ->bindParam(':empresa_trabajo', $empresa_trabajo);

			if( $stmt ->execute() ){
				registro::pertinencia();
			}else{
				print_r(json_encode( array("tipe"=>false, "txt"=>"Error interno del servidor :-(") ));
			}

		}


		public function pertinencia(){

			$calidad_docente = @$this->data_pertinencia[0];
			$plan_estudio = @$this->data_pertinencia[1];
			$oportunidades_proyectos_inve = @$this->data_pertinencia[2];
			$investigacion_ensenansa = @$this->data_pertinencia[3];
			$infraestructura = @$this->data_pertinencia[4];
			$experiencia_residencia = @$this->data_pertinencia[5];
			$actividades_laborales = @$this->data_pertinencia[6];
			$formacion_academica = @$this->data_pertinencia[7];
			$utilidad_residencia = @$this->data_pertinencia[8];

			$stmt = $this->conexion->prepare ("INSERT INTO reporte_pertinencia(id_cuestionario, calidad_docente, plan_estudio, oportunidades_proyectos_inve, investigacion_ensenansa, infraestructura, experiencia_residencia, actividades_laborales, formacion_academica, utilidad_residencia) VALUES (
											:id_cuestionario,
											:calidad_docente,
											:plan_estudio,
											:oportunidades_proyectos_inve,
											:investigacion_ensenansa,
											:infraestructura,
											:experiencia_residencia,
											:actividades_laborales,
											:formacion_academica,
											:utilidad_residencia
										) ");

				$stmt ->bindParam(':id_cuestionario', $this->id_registro);
				$stmt ->bindParam(':calidad_docente', $calidad_docente);
				$stmt ->bindParam(':plan_estudio', $plan_estudio);
				$stmt ->bindParam(':oportunidades_proyectos_inve', $oportunidades_proyectos_inve);
				$stmt ->bindParam(':investigacion_ensenansa', $investigacion_ensenansa);
				$stmt ->bindParam(':infraestructura', $infraestructura);
				$stmt ->bindParam(':experiencia_residencia', $experiencia_residencia);
				$stmt ->bindParam(':actividades_laborales', $actividades_laborales);
				$stmt ->bindParam(':formacion_academica', $formacion_academica);
				$stmt ->bindParam(':utilidad_residencia', $utilidad_residencia);

			if( $stmt ->execute() ){
				print_r(json_encode( array("tipe"=>true, "txt"=>"Su encuesta se registro correctamente, gracias por su apotación!!!") ));
			}else{
				print_r(json_encode( array("tipe"=>false, "txt"=>"Error interno del servidor :-(") ));
			}

		}

		public function confirmar_registro(){

			$sql = "SELECT cuestionario.id_cuestionario FROM cuestionario WHERE cuestionario.numero_control = :numero_control";

			$statement = $this->conexion->prepare($sql);
			$statement->bindParam(':numero_control', $this->numero_control);
			$statement->execute();
			$users = $statement->fetch(2);

				$id_registro =  @$users["id_cuestionario"];

				if( $id_registro ){
					return array("tipe"=>true, "id_registro"=>$id_registro);
				}else{
					return array("tipe"=>false);
				}

		}


		public function get_id_data_idioma(){

			//ID tag's
			$id_idioma_txt = $_POST["id_idioma_txt"];
			$id_idioma_por = $_POST["id_idioma_por"];

			//Idiomas y porcentajes
			$idioma = $_POST["idioma"];
			$porcentaje_dom = $_POST["porcentaje_dom"];

			$data_final =  array( 
									$id_idioma_txt,
									$idioma,  
									$id_idioma_por,
									$porcentaje_dom
								);

			$id_idioma_main = array( $id_idioma_txt, $id_idioma_por);
			$data_idioma_main = array($idioma, $porcentaje_dom); //porcentaje y idioma 

				//Eliminar espacios en blanco ID idioma
				foreach ($id_idioma_main as $key => $value) {
					foreach ($value as $key => $final) {
						if( $final ){
							$id_idioma_final[] = $final; //ID idioma y porcentaje
						}
					}
				}

					foreach ($data_idioma_main as $key => $value) {
						foreach ($value as $key => $final) {
							if( $final ){
								$data_idioma_final[] = $final; //ID idioma y porcentaje
							}
						}
					}

			// print_r(json_encode( array(  $id_idioma_main, 
			// 	                         $id_idioma_final, 
			// 	                         $data_idioma_main, 
			// 	                         $data_idioma_final
			// 	                      )));

					return array($id_idioma_final, $data_idioma_final);

		}


			public function registro_cuenta(){

					switch ( $this->tipo ) {

						case 1:
								$this->PK_col = "numero_control";
								$this->PK_col_ident = ":numero_control";
								registro::cuenta_alumno_main();
							break;
						
						case 2:
								$this->PK_col = "usuario_profesor";
								$this->PK_col_ident = ":usuario_profesor";
						 		registro::cuenta_docente();
							break;

						case 3:
							registro::actualizar();
							break;

						default:
							print_r(json_encode(array("tipe"=>false, 
												      "info"=>"Tipo no válido.")));
						break;

					}

			}


			public function cuenta_alumno_main(){

				$stmt = $this->conexion->prepare("INSERT INTO egresado (numero_control, nombre_completo, ano_egreso) VALUES(?, ?, ?)");

				$stmt -> bindParam(1, $this->numero_control);
				$stmt -> bindParam(2, $this->nombre_completo);
				$stmt -> bindParam(3, $this->ano_egreso_largo);

				if( $stmt -> execute() ){
					//registro::cuenta_alumno_nucleo();
					$estatus = 1;
					$tipo = null;
					$root = null;
		            registro::general_registro_cuenta($estatus
												     ,$tipo
												     ,$root
												     ,null
												     ,null);
				}else{
					print_r(json_encode((array("tipe"=>false, "txt"=>"No puedes contestar mas de una vez la encuesta."))));
				}

			}


				public function cuenta_docente(){

					$tipo_privilegio = $this->privilegios->get_privilegio();

					if( $tipo_privilegio != 2 && $tipo_privilegio != 3 ){

						print_r(json_encode( array( "tipo"=>false, "info"=>"No tiene los privilegios suficientes para ejecutar está función, consulte al administrador principal." ) ));

					}else{

						$usuario_profesor = @$_POST["usuario_profesor"];
						$estatus = 1;
						$tipo = @$_POST["con_priv"];
						$root = @$_POST["edit_del_priv"];
						$usuario_profesor = @$_POST["usuario_profesor"];
						$password = @$_POST["password"];

						$data_docente = array(
							$usuario_profesor,
							$estatus, 
							$tipo,
							$root,
							$usuario_profesor,
							$password
						);

						$long = sizeof( $data_docente );
					    $conf = registro::verificar_datos( $data_docente );

					    if( $conf == $long ){

					    	$stmt = $this->conexion->prepare ("INSERT INTO profesor (usuario_profesor, nombre_completo) VALUES (:usuario_profesor, :nombre_completo)");

								$stmt ->bindParam('usuario_profesor', $usuario_profesor);
								$stmt ->bindParam('nombre_completo',  $this->nombre_completo);

							if( $stmt -> execute() ){
								//registro::cuenta_docente_nucleo();

								  registro::general_registro_cuenta(
								  	$estatus
									,$tipo
									,$root
									,$usuario_profesor
									,$password
								  );

							}else{
								print_r(json_encode(array("tipo"=>false, "info"=>"Error, no se pudo completar el registro, el nombre de usuario ya existe.")));
							}

					    }else{
					    	print_r(json_encode(array("tipo"=>false, "info"=>"Todos los campos son necesarios, asegúrese de seleccionar al menos un privilegio.")));
					    }

					}

				}		


			public function general_registro_cuenta(
														$estatus
														,$tipo
														,$root
														,$usuario_profesor
														,$password
													){

					$fecha_creacion = date('Y-m-d');

					$stmt = $this->conexion->prepare ("INSERT INTO cuenta (
									 email, 
									 estatus, 
									 tipo, 
									 root, 
									 fecha_creacion, 
									 fecha_modificacion,
									 telefono,
									 contrasena,
									 $this->PK_col
									 ) VALUES (
									 :email,
									 :estatus,
									 :tipo,
									 :root,
									 :fecha_creacion,
									 :fecha_modificacion,
									 :telefono,
									 :contrasena,
									 $this->PK_col_ident)");

					$stmt->bindParam(':email', $this->email);
					$stmt->bindParam(':estatus', $estatus);
					$stmt->bindParam(':tipo', $tipo);
					$stmt->bindParam(':root', $root);
					$stmt->bindParam(':fecha_creacion',  $fecha_creacion);
					$stmt->bindParam(':fecha_modificacion',  $fecha_creacion);
					$stmt->bindParam(':telefono', $this->telefono);

					$stmt->bindParam(':email', $this->email);
					$stmt->bindParam(':estatus', $estatus);
					$stmt->bindParam(':tipo', $tipo);
					$stmt->bindParam(':root', $root);
					$stmt->bindParam(':fecha_creacion',  $fecha_creacion);
					$stmt->bindParam(':fecha_modificacion', $fecha_creacion);
					$stmt->bindParam(':telefono', $this->telefono);
					
						if( $this->tipo == 1){
							$stmt->bindParam(':contrasena', $password);
							$stmt->bindParam($this->PK_col_ident, $this->numero_control);
						}else{
							$stmt->bindParam(':contrasena', $password);
							$stmt->bindParam($this->PK_col_ident, $usuario_profesor);
						}


					if( $stmt->execute() ){
						if( $this->tipo == 1){
							registro::insert_n_control();
						}else{
							print_r(json_encode(array("tipo"=>true, "info"=>"Registro generado correctamente.")));
						}
					}else{
						print_r(json_encode(array("tipo"=>false, "info"=>"Error interno del servidor.")));				
					}

					// print_r(json_encode(array("ABC: $this->PK_col_ident")));


				}


			public function verificar_datos( $data ){

				$ctn = 0;

				foreach ($data as $key => $value) {

					if( ($key != 2 && $key != 3) ){
						if($value != ""){
							$ctn++;
						}
					}else{
						if( $data[2] || $data[3] ){
							$ctn++;
						}
					}

				}

					return $ctn;

			}

			public function actualizar(){

				session_start();

				$stmt = $this->conexion->prepare("UPDATE profesor SET nombre_completo = :nombre_completo WHERE usuario_profesor = :usuario_profesor");

				$stmt->bindParam(':nombre_completo', $_POST["nombre_completo"]);
				$stmt->bindParam(':usuario_profesor', $_SESSION["user_act"]);

				if( $stmt->execute() ){

					$stmt = $this->conexion->prepare("UPDATE cuenta SET tipo = :tipo, root = :root, contrasena = :contrasena WHERE usuario_profesor = :usuario_profesor");

					$stmt->bindParam(':tipo', $_POST["con_priv"]);
					$stmt->bindParam(':root',  $_POST["edit_del_priv"]);
					$stmt->bindParam(':contrasena', $_POST["password"]);
					$stmt->bindParam(':usuario_profesor', $_SESSION["user_act"]);

					if( $stmt->execute() ){
						print_r(json_encode( array( "tipo"=>true, "info"=>"Datos actualizados correctamente." ) ));
					}

				}

			}


			public  function array_data(){

				$this->info_input = array
								(
								$numero_control = @$_POST["numero_control"],
								$this->nombre_completo,
								$sexo = @$_POST["sexo"],
								$this->telefono,
								$this->email,
								$this->ano_egreso_largo,
								$this->periodo,
								$titulo = @$_POST["titulo"],
								$posgrado = @$_POST["posgrado"],
								$pos_grado_txt = @$_POST["pos_grado_txt"],
								$tipo_pos = @$_POST["tipo_pos"],
								$acti_actual = @$_POST["acti_actual"],
								$trabaja_tipo = @$_POST["trabaja_tipo"],
								$trabajo_actual_conf = @$_POST["trabajo_actual_conf"],
								$tipo = @$_POST["tipo"],
								$esc_tra = @$_POST["esc_tra"],
								$puesto_trabajo = @$_POST["puesto_trabajo"],
								$sueldo_act = @$_POST["sueldo_act"],
								$tipo_contrato = @$_POST["tipo_contrato"],
								$idioma_empresa = @$_POST["idioma_empresa"],
								$antigueda_empresa = @$_POST["antigueda_empresa"],
								$ano_ingreso = @$_POST["ano_ingreso"],
								$tam_emp = @$_POST["tam_emp"],
								$tim_enc_tra = @$_POST["tim_enc_tra"],
								$medio_trabajo =@$_POST["medio_trabajo"],
								$calidad_doc = @$_POST["calidad_doc"],
								$plan_es = @$_POST["plan_es"],
								$opot_proy = @$_POST["opot_proy"],
								$investigacion = @$_POST["investigacion"],
								$cond_es = @$_POST["cond_es"],
								$exp_res = @$_POST["exp_res"],
								$efi_acti = @$_POST["efi_acti"],
								$form_acad = @$_POST["form_acad"],
								$utl_rprof = @$_POST["utl_rprof"],
								$sugerencia = @$_POST["sugerencia"],
								$ciudad = @$_POST["ciudad"],
								$estado = @$_POST["estado"],
								$idioma_a = @$_POST["idioma_a"],
								$porcentaje_dom_a = @$_POST["porcentaje_dom_a"],
								$idioma_b = @$_POST["idioma_b"],
								$porcentaje_dom_b = @$_POST["porcentaje_dom_b"],
								$idioma_c = @$_POST["idioma_c"],
								$porcentaje_dom_c = @$_POST["porcentaje_dom_c"],
								$idioma_d = @$_POST["idioma_d"],
								$porcentaje_dom_d = @$_POST["porcentaje_dom_d"],
								$empresa_trabajo = @$_POST["empresa_trabajo"]
								);

				$this->id_input = array
						(
						$numero_control_id = @$_POST["numero_control_id"],
						$nombre_completo_id = @$_POST["nombre_completo_id"],
						$sexo_id = @$_POST["sexo_id"],
						$telefono_id = @$_POST["telefono_id"],
						$email_id = @$_POST["email_id"],
						$ano_egreso_id = @$_POST["ano_egreso_id"],
						$periodo_id = @$_POST["periodo_id"],
						$titulo_id = @$_POST["titulo_id"],
						$posgrado_id = @$_POST["posgrado_id"],
						$pos_grado_txt_id = @$_POST["pos_grado_txt_id"],
						$tipo_pos_id = @$_POST["tipo_pos_id"],
						$acti_actual_id = @$_POST["acti_actual_id"],
						$trabaja_tipo_id = @$_POST["trabaja_tipo_id"],
						$trabajo_actual_conf_id = @$_POST["trabajo_actual_conf_id"],
						$tipo_id = @$_POST["tipo_id"],
						$esc_tra_id = @$_POST["esc_tra_id"],
						$puesto_trabajo_id = @$_POST["puesto_trabajo_id"],
						$sueldo_act_id = @$_POST["sueldo_act_id"],
						$tipo_contrato_id = @$_POST["tipo_contrato_id"],
						$idioma_empresa_id = @$_POST["idioma_empresa_id"],
						$antigueda_empresa_id = @$_POST["antigueda_empresa_id"],
						$ano_ingreso_id = @$_POST["ano_ingreso_id"],
						$tam_emp_id = @$_POST["tam_emp_id"],
						$tim_enc_tra_id = @$_POST["tim_enc_tra_id"],
						$medio_trabajo_id = @$_POST["medio_trabajo_id"],
						$calidad_doc_id = @$_POST["calidad_doc_id"],
						$plan_es_id = @$_POST["plan_es_id"],
						$opot_proy_id = @$_POST["opot_proy_id"],
						$investigacion_id = @$_POST["investigacion_id"],
						$cond_es_id = @$_POST["cond_es_id"],
						$exp_res_id = @$_POST["exp_res_id"],
						$efi_acti_id = @$_POST["efi_acti_id"],
						$form_acad_id = @$_POST["form_acad_id"],
						$utl_rprof_id = @$_POST["utl_rprof_id"],
						$sugerencia_id = @$_POST["sugerencia_id"],
						$ciudad_id = @$_POST["ciudad_id"],
						$estado_id = @$_POST["estado_id"],
						$idioma_a_id = @$_POST["idioma_a_id"],
						$porcentaje_dom_a_id = @$_POST["porcentaje_dom_a_id"],	
						$idioma_b_id = @$_POST["idioma_b_id"],
						$porcentaje_dom_b_id = @$_POST["porcentaje_dom_b_id"],
						$idioma_c_id = @$_POST["idioma_c_id"],
						$porcentaje_dom_c_id = @$_POST["porcentaje_dom_c_id"],	
						$idioma_d_id = @$_POST["idioma_d_id"],	
						$porcentaje_dom_d_id = @$_POST["porcentaje_dom_d_id"],
						$empresa_id = $_POST["empresa_id"]
						);

				return array($this->info_input, $this->id_input);


			}


		public function get_data(){

			if( $this->tipo != 2 && $this->tipo != 3){
			
				$data = registro::array_data();

				$index_validad_val_a = array(  $data[0][0], 
											   $data[0][1], 
											   $data[0][2],
											   $data[0][3],
											   $data[0][4],
											   $data[0][5],
											   $data[0][6],
											   $data[0][36],
											   $data[0][35],
											   $data[0][7],
											   $data[0][8],
											   $data[0][9],
											   //ingles_nivel
											   $data[1][25],
											   $data[1][26],
											   $data[1][27],
											   $data[1][28],
											   $data[1][29],
											   $data[0][34]
											);

					$index_validad_val_b = array(
											   $data[0][11],
											   $data[0][12], 
											   $data[0][13],
											   $data[0][21],
											   $data[1][14],
											   $data[1][15],
											   $data[1][45],
											   $data[1][16],
											   $data[1][17],
											   $data[1][18],
											   $data[1][19],
											   $data[1][20],
											   $data[1][21],
											   $data[1][23],
											   $data[1][24],
											   $data[1][22],
											   $data[1][31],
											   $data[1][32],
											   $data[1][33]
											   );

					registro::validar_data_entrada_a( $index_validad_val_a, $index_validad_val_b );

						//print_r(json_encode(array( $index_validad_val_a, $index_validad_val_b )));

				// print_r(json_encode("Registro encuesta"));

			}else{
				registro::registro_cuenta();
				//print_r(json_encode("Registro docente."));
			}

		}

		public function validar_data_entrada_a( $data_a, $data_b ){

			// tipo_trabajo_h => 3
			// instituto_f => 4

			$ctn_v = 0;
			$txt_info = null;

			foreach ($data_a as $key => $value) {

				if( $value == ""){
					$ctn_v++;
				}

			}


				if( $ctn_v == 0 ){
					
					if( !$_POST["tipo_t"] ){
						registro::validar_data_entrada_b( $data_b );
					}else{
						//print_r(json_encode("Registrar encuesta"));
						registro::registro_cuenta();
					}

				}else{
					print_r(json_encode( array("tipe"=>false, "txt"=>"Verifique que todos los campos estén llenos.") ));
				}	

				// $ctns = array( $ctn_v );
				//  	$array_data = array( $data, $ctns );
				// 		print_r(json_encode( $array_data ));


		}

			public function validar_data_entrada_b( $data_b ){

				$ctn_v = 0;
				$txt_info = null;
				$tipo = 0;

				foreach ($data_b as $key => $value) {

					if( $key != 9 ){

						if( $key == 4 ){
							if( $value == "tipo_trabajo_h"){
								if( $data_b[5] == "" ){

									$tipo = 1;
									print_r(json_encode( array("tipe"=>false, "txt"=>"Seleccione una institución educativa en la sección: Ubicación laboral, pregunta 2, para continuar.") ));

								}
							}
						}

						$txt_info = $value;

					}else{
						$txt_info = $value[0];
					}

						if( $txt_info == ""){
							$ctn_v++;
						}

				}

					if( $ctn_v == 0 ){
						// print_r(json_encode( array(  $ctn_v, $data_b ) ));
						   registro::registro_cuenta();
					}else{

						if( $tipo == 0){
							print_r(json_encode( array("tipe"=>false, "txt"=>"Verifique que todos los campos estén llenos, en la sección, Ubicación laboral.") ));
						}

					}

			}



			// public function prueba(){

			// 	// $stmt = $this->conexion->prepare("SELECT * FROM cuenta");
			// 	// $stmt->execute();
			// 	// $users = $stmt->fetch(2);

			// 	// print_r(json_encode($users));

			// 	print_r(json_encode( array( $_POST["empresa_trabajo"], $_POST["empresa_id"] ) ));

			// }




}


$registro = new registro();
$registro->get_data(); //registro_cuenta();


?>