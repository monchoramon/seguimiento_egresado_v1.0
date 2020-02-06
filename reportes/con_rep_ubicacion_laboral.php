<?php

	/**
	 * 
	 */

	include_once 'con_rep_perfil_egre.php';

	class ubicacion_laboral extends pre{
		
		public $conexion;
		public $pre;

		function __construct(){

			$pdo = new conexion();
			$this->conexion = $pdo->bd();
			$this->pre = new pre();

		}


	 	public function get_tipo_genero(){

	 		$data_id_cues = $this->pre->get_id_cuestionario();
			// print_r(json_encode( $data_id_cues ));

				foreach ($data_id_cues as $key => $value) {

					$stmt = $this->conexion->prepare("SELECT sexo FROM reporte_perfil_egresado WHERE id_cuestionario = :id_cuestionario");
					 
					$stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

					$stmt->execute();
					
					while ( $row = $stmt->fetch() ) {
						$data[] = $row;
			 		}

			 }

			 //print_r(json_encode( $data ));
		 		return $data;

		}

		public function get_trabaja(){

			$data_id_cues = $this->pre->get_id_cuestionario();
			$genero = ubicacion_laboral::get_tipo_genero();
			

			foreach ($data_id_cues as $key => $value) {

				$stmt = $this->conexion->prepare("SELECT id_cuestionario, actividad_actual FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
				 
				$stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

				$stmt->execute();
				
				while ( $row = $stmt->fetch(2) ) {
					$data_actividad_actual[] = $row;
				}

				$data_actividad_actual[$key]["sexo"] = $genero[$key]["sexo"];

			}


			$array_actividad_actual = array(
				"Trabaja",
				"Estudia",
				"Estudia y trabaja",
				"No estudia ni trabaja"
			);

			$actividad_actual_h = array(						
								$trabaja_h = 0,
								$estudia_h = 0,
								$est_tra_h = 0,
								$no_est_tra_h = 0
							   );
		
			$actividad_actual_m = array(						
								$trabaja_m = 0,
								$estudia_m = 0,
								$est_tra_m = 0,
								$no_est_tra_m = 0
								);


		foreach ($data_actividad_actual as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($array_actividad_actual as $key_b => $value_b) {

					if( $value_a["actividad_actual"] == $value_b ){

						if( $tipe == 0){
							$actividad_actual_h[$key_b]++;
						}else{
							$actividad_actual_m[$key_b]++;
						}

					}

				}


		}


		$final_array = array(
			"data_actividad_actual"=>@$data_actividad_actual,
			"actividad_actual_h"=>$actividad_actual_h,
			"actividad_actual_m"=>$actividad_actual_m,
		);

		// print_r(json_encode(
		// 	$final_array
		// ));

			return $final_array;


	}

	public function get_trabajo(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		$dependencia = array(
						"Comercio propio",
						"Empleado en comercio",
						"Empresa propia de informática o afín",
						"Empleado en empresa de informatica o afin",
						"Dueño de PYME en ISC",
						"Empleado de PYME en ISC",
						"Empleado en institución educativa laborando en el centro de cómputo o afín",
						"Empleado en institución educativa laborando como docente"
					);

		$array_hombres = array(
								$ctn_come_pro_h = 0,
								$ctn_empl_comercio_h = 0,
								$ctn_emp_propia_h = 0,
								$ctn_empl_infor_h = 0,
								$ctn_dueno_pyme_h = 0,
								$ctn_empl_pyme_h = 0,
								$ctn_empl_inst_h = 0,
								$ctn_empl_inst_doc_h = 0
							);

		$array_mujeres = array(
								$ctn_come_pro_m = 0,
								$ctn_empl_comercio_m = 0,
								$ctn_emp_propia_m = 0,
								$ctn_empl_infor_m = 0,
								$ctn_dueno_pyme_m = 0,
								$ctn_empl_pyme_m = 0,
								$ctn_empl_inst_m = 0,
								$ctn_empl_inst_doc_m = 0
							);


		$nivel_educacion = array(
						"Preescolar",
						"Primaria",
						"Secundaria",
						"Medio superior",
						"Superior",
						"Posgrado"
					);

		$array_educacion_m = array(
						$preescolar = 0,
						$primaria = 0,
						$secundaria = 0,
						$medio_superior = 0,
						$superior = 0,
						$posgrado = 0
					);

		$array_educacion_h = array(
						$preescolar = 0,
						$primaria = 0,
						$secundaria = 0,
						$medio_superior = 0,
						$superior = 0,
						$posgrado = 0
					);

		foreach ($data_id_cues as $key => $value) {

			$stmt = $this->conexion->prepare("SELECT id_cuestionario, area_dependencia, nivel_educacion FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
			 
			$stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

			$stmt->execute();
			
			while ( $row = $stmt->fetch(2) ) {
				$data[] = $row;
			}

			$data[$key]["sexo"] = $genero[$key]["sexo"];

		}

			foreach ($data as $key => $value_a) {

				switch ( $value_a["sexo"] ) {

					case 'Femenino':
						$tipe = 0;
						break;

					case 'Masculino':
						$tipe = 1;
						break;
					
				}

				foreach ($dependencia as $key => $value_b) {

					if( $value_b == $value_a["area_dependencia"] ){

						if($tipe == 0){
							$array_mujeres[$key]++;
						}else{
							$array_hombres[$key]++;
						}

						if( $value_a["area_dependencia"] == $dependencia[7] ){

							foreach ($nivel_educacion as $key => $value) {
								if( $value_a["nivel_educacion"] == $value ){
									if($tipe == 0){
										$array_educacion_m[$key]++;
									}else{
										$array_educacion_h[$key]++;
									}	
								}
							}

						}
	
					}

				}

			}


		//meter data array

		$ctn_a = sizeof($array_hombres);

		foreach ($array_educacion_h as $key => $value) {
			$array_hombres[$ctn_a] = $value;
			$ctn_a++;
		}

		$ctn_a = sizeof($array_mujeres);

		foreach ($array_educacion_m as $key => $value) {
			$array_mujeres[$ctn_a] = $value;
			//print_r(json_encode(array($value, $ctn_a) ));
			$ctn_a++;
		}


		$final_array = array(
			"data general"=>$data, 
			"ctn_dependencia_h"=>$array_hombres, 
			"ctn_dependencia_m"=>$array_mujeres, 
			"nivel_educacion_h"=>$array_educacion_h,
			"nivel_educacion_m"=>$array_educacion_m
		);

			// print_r(json_encode(
			// 	$final_array
			// ));

				return $final_array;

	}


	public function get_puesto_trabajo(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();


		$puesto_trabajo = array(
								"Gerente",
								"Jefe de área",
								"Supervisor",
								"Encargado de depto."
							   );

		$array_mujeres = array(
								$gerente_m = 0,
								$jefe_area_m = 0,
								$supervisor_m = 0,
								$encargado_depto_m = 0,
								$otro = 0
							  );

		$array_hombres = array(
								$gerente_h = 0,
								$jefe_area_h = 0,
								$supervisor_h = 0,
								$encargado_depto_h = 0,
								$otro = 0
							  );

			foreach ($data_id_cues as $key => $value) {

				$stmt = $this->conexion->prepare("SELECT id_cuestionario, puesto_trabajo FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
				 
				$stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

				$stmt->execute();
				
				while ( $row = $stmt->fetch(2) ) {
					$data[] = $row;
				}

				$data[$key]["sexo"] = $genero[$key]["sexo"];

			}


				foreach ($data as $key_a => $value_a) {
					
					switch ( $value_a["sexo"] ) {

						case 'Femenino':
							$tipe = 0;
							break;

						case 'Masculino':
							$tipe = 1;
							break;
						
					}

						foreach ($puesto_trabajo as $key_b => $value_b) {

							if( $value_b == $value_a["puesto_trabajo"] ){

								if($tipe == 0){
									$array_mujeres[$key_b]++;
								}else{
									$array_hombres[$key_b]++;
								}

								$index_iguales[] = $key_a;

							}

						}

						$aux_puesto =  $value_a["puesto_trabajo"];

						if( 
							$aux_puesto != $puesto_trabajo[0] &&
							$aux_puesto != $puesto_trabajo[1] &&
							$aux_puesto != $puesto_trabajo[2] &&
							$aux_puesto != $puesto_trabajo[3] 

						 ){	
						 	
						 	if($tipe == 0){
						 		$array_mujeres[4]++;
						 	}else{
						 		$array_hombres[4]++;
						 	}

						 	$index_puesto_dif[] = $key_a;
						 	
						}


				}

				$ctn = 0;

		$final_array = array(
			"data_general"=>@$data, 
			"ctn_puesto_h"=>@$array_hombres,  
			"ctn_puesto_m"=>@$array_mujeres,
			"index_puesto_dif"=>@$index_puesto_dif
		);

			// print_r(json_encode(
			// 	$final_array
			// ));

				return $final_array;

	}


	public function get_salario_actual(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		foreach ($data_id_cues as $key => $value) {

			$stmt = $this->conexion->prepare("SELECT id_cuestionario, salario_actual FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");

			$stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);
			$stmt->execute();

			while ( $row = $stmt->fetch(2) ) {
				$data_salario[] = $row;
			}

			$data_salario[$key]["sexo"] = $genero[$key]["sexo"];

		}

			$salarios = array(
								"5000 a 10000",
								"10000 a 15000",
								"15000 a 20000"
							);

			$total_salario_h = array(
				$salario_a = 0,
				$salario_b = 0,
				$salario_c = 0,
				$otro = 0
			);

			$total_salario_m = array(
				$salario_a = 0,
				$salario_b = 0,
				$salario_c = 0,
				$otro = 0
			);

			foreach ($data_salario as $key_a => $value_a) {

				switch ($value_a["sexo"]) {
					case 'Masculino':
						$tipe = 0;
						break;

					case 'Femenino':
						$tipe = 1;
						break;
				}

					foreach($salarios as $key_b => $value_b) {

						if( $value_a["salario_actual"] == $value_b ){

							if($tipe == 0){
								$total_salario_h[$key_b]++;
							}else{
								$total_salario_m[$key_b]++;
							}

						}

					}

				$aux_salario =  $value_a["salario_actual"];

				if( 
					$aux_salario != $salarios[0] &&
					$aux_salario != $salarios[1] &&
					$aux_salario != $salarios[2] 

				 ){	
				 	
				 	if($tipe == 0){
				 		$total_salario_h[3]++;
				 	}else{
				 		$total_salario_m[3]++;
				 	}

				 	$index_salario_dif[] = $key_a;

				}

			}


			$final_array = array(
				"data_final"=>@$data_salario, 
				"salario_h"=>@$total_salario_h, 
				"salario_m"=>@$total_salario_m,
				"index_salario_dif"=>@$index_salario_dif
			);

				// print_r(json_encode(
				// 	$final_array
				// ));

					return $final_array;

	}


	public function get_tipo_contrato(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		$tipo_contrato = array(
			"Base",
			"Eventual",
			"Contrato"
		);

		$ctn_contrato_h = array(
			$base = 0,
			$eventual = 0,
			$contrato = 0,
			// $otro = 0
		);

		$ctn_contrato_m = array(
			$base = 0,
			$eventual = 0,
			$contrato = 0,
			// $otro = 0
		);

		foreach ($data_id_cues as $key => $value) {

			$stm = $this->conexion->prepare("SELECT id_cuestionario, tipo_contrato FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
			$stm->bindParam('id_cuestionario', $value["id_cuestionario"]);
			$stm->execute();

			while ( $row = $stm->fetch(2) ) {
				$data_contrato[] = $row;
			}

			$data_contrato[$key]["sexo"] = $genero[$key]["sexo"];

		}


		foreach ($data_contrato as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($tipo_contrato as $key_b => $value_b) {

					if( $value_a["tipo_contrato"] == $value_b ){

						if( $tipe == 0){
							$ctn_contrato_h[$key_b]++;
						}else{
							$ctn_contrato_m[$key_b]++;
						}

					}

				}

				// $aux_contrato = $value_a["tipo_contrato"];

				// if(
				// 	$aux_contrato != $tipo_contrato[0] &&
				// 	$aux_contrato != $tipo_contrato[1] &&
				// 	$aux_contrato != $tipo_contrato[2] 
				// ){
				// 	if( $tipe==0 ){
				// 		$ctn_contrato_h[3]++;
				// 	}else{
				// 		$ctn_contrato_m[3]++;							
				// 	}

				// 		$index_no[] = $key_a;

				// }

		}


		$final_array = array(
			"data_contrato"=>@$data_contrato,
			"ctn_contrato_h"=>@$ctn_contrato_h,
			"ctn_contrato_m"=>@$ctn_contrato_m,
			// "index_no"=>$index_no
		);

			// print_r(json_encode(
			// 	$final_array
			// ));

				return $final_array;

	}

	public function get_idioma(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		$idioma_trabajo = array(
			"Ingles",
			"Frances",
			"Aleman",
			"Japones",
		);

		$ctn_idioma_h = array(
			$ingles = 0,
			$frances = 0,
			$aleman = 0,
			$japones = 0,
			$otro = 0
		);

		$ctn_idioma_m = array(
			$ingles = 0,
			$frances = 0,
			$aleman = 0,
			$japones = 0,
			$otro = 0
		);

		foreach ($data_id_cues as $key => $value) {

			$stm = $this->conexion->prepare("SELECT id_cuestionario, idioma_trabajo FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
			$stm->bindParam('id_cuestionario', $value["id_cuestionario"]);
			$stm->execute();

			while ( $row = $stm->fetch(2) ) {
				$data_idioma[] = $row;
			}

			$data_idioma[$key]["sexo"] = $genero[$key]["sexo"];

		}


		foreach ($data_idioma as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($idioma_trabajo as $key_b => $value_b) {

					if( $value_a["idioma_trabajo"] == $value_b ){

						if( $tipe == 0){
							$ctn_idioma_h[$key_b]++;
						}else{
							$ctn_idioma_m[$key_b]++;
						}

					}

				}

				$aux_idioma = $value_a["idioma_trabajo"];

				if(
					$aux_idioma != $idioma_trabajo[0] &&
					$aux_idioma != $idioma_trabajo[1] &&
					$aux_idioma != $idioma_trabajo[2] &&
					$aux_idioma != $idioma_trabajo[3]
				){
					if( $tipe==0 ){
						$ctn_idioma_h[4]++;
					}else{
						$ctn_idioma_m[4]++;							
					}

						$index_no[] = $key_a;

				}

		}

		$final_array = array(
			"data_idioma"=>@$data_idioma,
			"ctn_idioma_h"=>@$ctn_idioma_h,
			"ctn_idioma_m"=>@$ctn_idioma_m,
			"index_no"=>@$index_no
		);

			// print_r(json_encode( 
			// 	$final_array
			// ));

				return $final_array;

	}


	public function get_antiguedad_empresa(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		$antiguedad_trabajo = array(
			"Menos de un año",
			"Un año",
			"Dos años",
			"Tres años",
			"Mas de tres años"
		);

		$ctn_antiguedad_h = array(
			$menos_de_un_ano = 0,
			$un_ano = 0,
			$dos_anos = 0,
			$tres_anos = 0,
			$mas_de_tres_anos = 0
		);

		$ctn_antiguedad_m = array(
			$menos_de_un_ano = 0,
			$un_ano = 0,
			$dos_anos = 0,
			$tres_anos = 0,
			$mas_de_tres_anos = 0
		);

		foreach ($data_id_cues as $key => $value) {

			$stm = $this->conexion->prepare("SELECT id_cuestionario, antiguedad_empresa FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
			$stm->bindParam('id_cuestionario', $value["id_cuestionario"]);
			$stm->execute();

			while ( $row = $stm->fetch(2) ) {
				$data_antiguedad[] = $row;
			}

			$data_antiguedad[$key]["sexo"] = $genero[$key]["sexo"];

		}


		foreach ($data_antiguedad as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($antiguedad_trabajo as $key_b => $value_b) {

					if( $value_a["antiguedad_empresa"] == $value_b ){

						if( $tipe == 0){
							$ctn_antiguedad_h[$key_b]++;
						}else{
							$ctn_antiguedad_m[$key_b]++;
						}

					}

				}


		}


		$final_array = array(
			"data_antiguedad"=>@$data_antiguedad,
			"ctn_antiguedad_h"=>@$ctn_antiguedad_h,
			"ctn_antiguedad_m"=>@$ctn_antiguedad_m,
		);

			// print_r(json_encode(
			// 	$final_array
			// ));

				return $final_array;


	}


	public function get_timpo_primer_empleo(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		$tiempo_obtener_trabajo = array(
			"Antes de egresar",
			"Menos de seis meses",
			"Entre seis meses y un año",
			"Más de un año"
		);

		$ctn_tiempo_obtener_h = array(
			$antes_de_egresar=0,
			$menos_de_seis_meses=0,
			$entre_seis_meses_y_un_ano=0,
			// $tres_anos=0,
			$mas_de_un_ano=0
		);

		$ctn_tiempo_obtener_m = array(
			$antes_de_egresar=0,
			$menos_de_seis_meses=0,
			$entre_seis_meses_y_un_ano=0,
			// $tres_anos=0,
			$mas_de_un_ano=0
		);

		foreach ($data_id_cues as $key => $value) {

			$stm = $this->conexion->prepare("SELECT id_cuestionario, tiempo_transcurrido_empleo FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
			$stm->bindParam('id_cuestionario', $value["id_cuestionario"]);
			$stm->execute();

			while ( $row = $stm->fetch(2) ) {
				$data_tiempo_tra_empleo[] = $row;
			}

			$data_tiempo_tra_empleo[$key]["sexo"] = $genero[$key]["sexo"];

		}


		foreach ($data_tiempo_tra_empleo as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($tiempo_obtener_trabajo as $key_b => $value_b) {

					if( $value_a["tiempo_transcurrido_empleo"] == $value_b ){

						if( $tipe == 0){
							$ctn_tiempo_obtener_h[$key_b]++;
						}else{
							$ctn_tiempo_obtener_m[$key_b]++;
						}

					}

				}

			}


			$final_array = array(
				"data_tiempo_tra_empleo"=>@$data_tiempo_tra_empleo,
				"ctn_tiempo_obtener_h"=>@$ctn_tiempo_obtener_h,
				"ctn_tiempo_obtener_m"=>@$ctn_tiempo_obtener_m
			);


			// print_r(json_encode(
			// 	$final_array
			// ));


			return $final_array;


	}


	public function get_medio_usado_empleo(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		$medio_usado_empleo = array(
			"Bolsa de trabajo del plantel",
			"Contactos personales",
			"Residencia profesional"
		);

		$ctn_medio_usado_h = array(
			$bolsa_de_trabajo_del_plantel=0,
			$contactos_personales=0,
			$residencia_profesional=0,
			$otro=0
		);

		$ctn_medio_usado_m = array(
			$bolsa_de_trabajo_del_plantel=0,
			$contactos_personales=0,
			$residencia_profesional=0,
			$otro=0
		);

		foreach ($data_id_cues as $key => $value) {

			$stm = $this->conexion->prepare("SELECT id_cuestionario, medio_usado_empleo FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
			$stm->bindParam('id_cuestionario', $value["id_cuestionario"]);
			$stm->execute();

			while ( $row = $stm->fetch(2) ) {
				$data_medio_udado_empleo[] = $row;
			}

			$data_medio_udado_empleo[$key]["sexo"] = $genero[$key]["sexo"];

		}


		foreach ($data_medio_udado_empleo as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($medio_usado_empleo as $key_b => $value_b) {

					if( $value_a["medio_usado_empleo"] == $value_b ){

						if( $tipe == 0){
							$ctn_medio_usado_h[$key_b]++;
						}else{
							$ctn_medio_usado_m[$key_b]++;
						}

					}

				}


				$aux_medio = $value_a["medio_usado_empleo"];

				if(
					$aux_medio != $medio_usado_empleo[0] &&
					$aux_medio != $medio_usado_empleo[1] &&
					$aux_medio != $medio_usado_empleo[2] 
				){
					if( $tipe==0 ){
						$ctn_medio_usado_h[3]++;
					}else{
						$ctn_medio_usado_m[3]++;							
					}

						$index_no[] = $key_a;

				}

			}


			$final_array = array(
				"data_medio_udado_empleo"=>@$data_medio_udado_empleo,
				"ctn_medio_usado_h"=>@$ctn_medio_usado_h,
				"ctn_medio_usado_m"=>@$ctn_medio_usado_m,
				"index_no"=>@$index_no,
			);

				// print_r(json_encode(
				// 	$final_array
				// ));

					return $final_array;

	}


	public function get_tamano_empresa_labora(){

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = ubicacion_laboral::get_tipo_genero();

		$tamano_empresa = array(
			"Microempresa (1-30) personas",
			"Pequeña (31-100) personas",
			"Mediana (101-500) personas",
			"Grande (más de 500) personas"
		);

		$ctn_tamano_empresa_h = array(
			$microempresa=0,
			$pequeña=0,
			$mediana=0,
			$grande=0
		);

		$ctn_tamano_empresa_m = array(
			$microempresa=0,
			$pequeña=0,
			$mediana=0,
			$grande=0
		);

		foreach ($data_id_cues as $key => $value) {

			$stm = $this->conexion->prepare("SELECT id_cuestionario, tamano_empresa FROM reporte_ubicacion_laboral WHERE id_cuestionario = :id_cuestionario");
			$stm->bindParam('id_cuestionario', $value["id_cuestionario"]);
			$stm->execute();

			while ( $row = $stm->fetch(2) ) {
				$data_tamano_empresa[] = $row;
			}

			$data_tamano_empresa[$key]["sexo"] = $genero[$key]["sexo"];

		}


		foreach ($data_tamano_empresa as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($tamano_empresa as $key_b => $value_b) {

					if( trim($value_a["tamano_empresa"]) == $value_b ){

						if( $tipe == 0){
							$ctn_tamano_empresa_h[$key_b]++;
						}else{
							$ctn_tamano_empresa_m[$key_b]++;
						}

					}

				}

		}


		$final_array = array(
			"data_tamano_empresa"=>@$data_tamano_empresa,
			"ctn_tamano_empresa_h"=>@$ctn_tamano_empresa_h,
			"ctn_tamano_empresa_m"=>@$ctn_tamano_empresa_m,
		);

			// print_r(json_encode( 	
			// 	$final_array
			// ));

				return $final_array;

	}


}


	$ubicacion_laboral = new ubicacion_laboral();
	$ubicacion_laboral->get_tamano_empresa_labora();
	

?>