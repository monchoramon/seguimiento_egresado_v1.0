<?php

/**
 * 
 */

include_once dirname(__FILE__).'/../scripts/PDO/bd/conexion.php';

class pre{
	
		public $conexion;
		
		function __construct(){

			$pdo = new conexion();
			$this->conexion = $pdo->bd();

		}


		public function get_id_cuestionario(){

			// $periodo = "ENE-JUN";
			// $ano_egreso_corto = "2017";

			include_once "sesion.php";
			$periodo = $_SESSION["periodo"];
			$ano = $_SESSION["ano"];
		
			$stmt = $this->conexion->prepare("SELECT id_cuestionario FROM cuestionario  WHERE periodo = :periodo AND ano_egreso_corto = :ano_egreso_corto");
			$stmt->bindParam(':periodo', $periodo);
			$stmt->bindParam(':ano_egreso_corto', $ano);

			$stmt->execute();

			while( $fila = $stmt->fetch(2) ) {
				$data[] = $row;
			}


			if( @$data ){
				return @$data;
			}

			//print_r(json_encode( $data ));

		}

		public function get_sexo_alumnos(){ // aplica para la tabla de egresados :V

			$id_cuestionario = pre::get_id_cuestionario();

			$ctn_h = $ctn_m = $otro = $total = $porc_h = $porc_m = $porc_tot = 0;

			foreach ($id_cuestionario as $key => $value) {

				 $stmt = $this->conexion->prepare("SELECT sexo FROM reporte_perfil_egresado WHERE id_cuestionario = :id_cuestionario");
				 
				 $stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

				 $stmt->execute();

				 while ( $row = $stmt->fetch(2) ) {

					$sexo_alumnos[] = $row;
					$sexo = $row["sexo"];

					switch ( $sexo ) {

						case 'Masculino':
							$ctn_h++;
							break;

						case 'Femenino':
							$ctn_m++;
							break;

						default:
							$otro++;
							break;

					}

					//print_r(json_encode( $row["sexo"] ));

				}

			}

			//Operaciones aritméticas
			$total = ($ctn_h+$ctn_m);

			if( $total > 0){
				$porc_h = round( (($ctn_h*100) / $total) );
				$porc_m = round( (($ctn_m*100) / $total) );
				$porc_tot = round( ($porc_h+$porc_m) );
			}

			$total_sexos = array( 
									"hombre"=>$ctn_h, 
									"mujer"=>$ctn_m, 
									"otro"=>$otro, 
									"total"=>$total,
									"porc_h"=>$porc_h,
									"porc_m"=>$porc_m,
									"porc_tot"=>$porc_tot
								);

			//print_r(json_encode( array( $sexo_alumnos, $total_sexos ) ));
				
				return $total_sexos;

		}


		public function get_titulados(){

			$id_cuestionario = pre::get_id_cuestionario();

			$ctn_si_h = $ctn_si_m = $total_si = 0;
			$ctn_no_h = $ctn_no_m = $total_no = 0;

			$porc_h_si = $porc_m_si = $porc_tot_si = 0;
			$porc_h_no = $porc_m_no = $porc_tot_no = 0;

			foreach ($id_cuestionario as $key => $value) {

				 $stmt = $this->conexion->prepare("SELECT sexo, titulado FROM reporte_perfil_egresado WHERE id_cuestionario = :id_cuestionario");
				 
				 $stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

				 $stmt->execute();

				 while ( $row = $stmt->fetch(2) ) {

					$titulados[] = $row;
					$tipo = $row["titulado"];
					$sexo = $row["sexo"];

					if( $tipo == "Si" && $sexo == "Masculino" ){
						$ctn_si_h++;
					}else{
						if( $tipo == "No" && $sexo == "Masculino" ){
							$ctn_no_h++;
						}else{
							if( $tipo == "Si" && $sexo == "Femenino" ){
								$ctn_si_m++;
							}else{
								if( $tipo == "No" && $sexo == "Femenino" ){
									$ctn_no_m++;
								}
							}
						}
					}


					//print_r(json_encode( $row["sexo"] ));

				}

			}


				$total_si = ($ctn_si_h+$ctn_si_m);

				if( $total_si > 0 ){
					$porc_h_si = round( (($ctn_si_h*100) / $total_si) );
					$porc_m_si = round( (($ctn_si_m*100) / $total_si) );
					$porc_tot_si = ( $porc_h_si+$porc_m_si );
				}


				$total_no = ($ctn_no_h+$ctn_no_m);

				if( $total_no > 0 ){
					$porc_h_no = round( (($ctn_no_h*100) / $total_no) );
					$porc_m_no = round( (($ctn_no_m*100) / $total_no) );
					$porc_tot_no = ( $porc_h_no+$porc_m_no );
				}

				$data_titulados = array( 

									"si_hombre"=>$ctn_si_h, 
									"si_mujer"=>$ctn_si_m, 
									"total_si"=>$total_si,
									"porc_h_si"=>$porc_h_si,
									"porc_m_si"=>$porc_m_si,
									"porc_tot_si"=>$porc_tot_si,
									"no_hombre"=>$ctn_no_h, 
									"no_mujer"=>$ctn_no_m,
									"total_no"=>$total_no,
									"porc_h_no"=>$porc_h_no,
									"porc_m_no"=>$porc_m_no,
									"porc_tot_no"=>$porc_tot_no

									);

				

			//print_r(json_encode( array( $titulados, @$data_titulados ) ));
				return $data_titulados;

		}

		public function get_posgrado(){

			$id_cuestionario = pre::get_id_cuestionario();

			$ctn_pos_h = $ctn_pos_m = $tot_pos = 0;
			$porc_pos_h = $porc_pos_m = $tot_porc_pos = 0;
			$pos_maes_h = $pos_doct_h = $pos_posdoct_h = 0;
			$pos_maes_m = $pos_doct_m = $pos_posdoct_m = 0;
			$prom_h = $prom_m = 0;

			foreach ($id_cuestionario as $key => $value) {

				$stmt = $this->conexion->prepare("SELECT id_cuestionario, sexo, posgrado FROM reporte_perfil_egresado WHERE id_cuestionario = :id_cuestionario");

				$stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

				$stmt->execute();

				while ( $row = $stmt->fetch(2) ) {

					$posgrado[] = $row;

					if( $row["sexo"] == "Masculino" && $row["posgrado"] ){

						$pos = $row["posgrado"];

						if( $pos == "Maestria" || 
							$pos == "Doctorado" || 
							$pos == "Posdoctorado"){
							$ctn_pos_h++;
						}

						switch ( $row["posgrado"] ) {

							case 'Maestria':
									$pos_maes_h++;
								break;

							case 'Doctorado':
									$pos_doct_h++;
								break;

							case 'Posdoctorado':
									$pos_posdoct_h++;
								break;

						}

					}else{

						if( $row["sexo"] == "Femenino" && $row["posgrado"] ){

							$pos = $row["posgrado"];

							if( $pos == "Maestria" || 
								$pos == "Doctorado" || 
								$pos == "Posdoctorado"){
								$ctn_pos_m++;
							}


							switch ( $row["posgrado"] ) {

								case 'Maestria':
										$pos_maes_m++;
									break;

								case 'Doctorado':
										$pos_doct_m++;
									break;

								case 'Posdoctorado':
										$pos_posdoct_m++;
									break;

							}

						}

					}

				}

			}

			$tot_pos = ($ctn_pos_h+$ctn_pos_m);

			if( $tot_pos > 0 ){
				$prom_h  = round((($ctn_pos_h/$tot_pos)*100));
				$prom_m  = round((($ctn_pos_m/$tot_pos)*100));
			}

			$data_posgrado = array(
									"ctn_pos_h" => $ctn_pos_h,
									"ctn_pos_m" => $ctn_pos_m,
									"tot_pos" => $tot_pos,
									"pos_maes_h"=>$pos_maes_h,
									"pos_doct_h"=>$pos_doct_h,
									"pos_posdoct_h"=>$pos_posdoct_h,
									"pos_maes_m"=>$pos_maes_m,
									"pos_doct_m"=>$pos_doct_m,
									"pos_posdoct_m"=>$pos_posdoct_m,
									"prom_h"=>$prom_h,
									"prom_m"=>$prom_m 
								  );	

			//print_r(json_encode( array( $posgrado, @$data_posgrado ) ));
				return $data_posgrado;

		}


		public function get_idioma(){

			$id_cuestionario = pre::get_id_cuestionario();

			$ctn_ingle_h = $ctn_ingle_m = $tot_ingles = 0;
			$ingles_porc_h = $ingles_porc_m = $tot_porc_ingle = 0;

			$ctn_fran_h = $ctn_fran_m = $tot_fran = 0;
			$fran_porc_h = $fran_porc_m = $tot_porc_fran = 0;

			$ctn_alem_h = $ctn_alem_m = $tot_alem = 0;
			$alem_porc_h = $alem_porc_m = $tot_porc_alem = 0;

			$ctn_otro_h = $ctn_otro_m = $tot_otro = 0;
			$otro_porc_h = $otro_porc_m = $tot_porc_otro = 0;

			foreach ($id_cuestionario as $key => $value) {

				$stmt = $this->conexion->prepare("SELECT id_cuestionario, sexo, lenguaje_idioma_a, lenguaje_porcentaje_a, lenguaje_idioma_b, lenguaje_porcentaje_b, lenguaje_idioma_c, lenguaje_porcentaje_c, lenguaje_idioma_d, lenguaje_porcentaje_d FROM reporte_perfil_egresado WHERE id_cuestionario = :id_cuestionario");

				$stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

				$stmt->execute();

				while ( $row = $stmt->fetch(2) ) {

					$idiomas[] = $row;

					if( $row["lenguaje_idioma_a"] && $row["lenguaje_porcentaje_a"] ){

						switch ( $row["sexo"] ) {

							case 'Masculino':
									$ingles_porc_h += trim($row["lenguaje_porcentaje_a"], "%");
									$ctn_ingle_h++;
								break;

							case 'Femenino':
									$ingles_porc_m += trim($row["lenguaje_porcentaje_a"], "%");
									$ctn_ingle_m++;
								break;

						}

					}


					if( $row["lenguaje_idioma_b"] && $row["lenguaje_porcentaje_b"] ){

						switch ( $row["sexo"] ) {

							case 'Masculino':
									$fran_porc_h += trim($row["lenguaje_porcentaje_b"], "%");
									$ctn_fran_h++;
								break;

							case 'Femenino':
									$fran_porc_m += trim($row["lenguaje_porcentaje_b"], "%");
									$ctn_fran_m++;
								break;

						}

					}


					if( $row["lenguaje_idioma_c"] && $row["lenguaje_porcentaje_c"] ){

						switch ( $row["sexo"] ) {

							case 'Masculino':
									$alem_porc_h += trim($row["lenguaje_porcentaje_c"], "%");
									$ctn_alem_h++;
								break;

							case 'Femenino':
									$alem_porc_m += trim($row["lenguaje_porcentaje_c"], "%");
									$ctn_alem_m++;
								break;

						}

					}

					if( $row["lenguaje_idioma_d"] && $row["lenguaje_porcentaje_d"] ){

						switch ( $row["sexo"] ) {

							case 'Masculino':
								$otro_porc_h += trim($row["lenguaje_porcentaje_d"], "%");
								$ctn_otro_h++;
								break;

							case 'Femenino':
								$otro_porc_m += trim($row["lenguaje_porcentaje_d"], "%");
								$ctn_otro_m++;
								break;

						}

					} // end if

				} // while

			} //foreach

			$tot_ingles = ($ctn_ingle_h+$ctn_ingle_m);
			$tot_fran = ($ctn_fran_h+$ctn_fran_m);
			$tot_alem = ($ctn_alem_h+$ctn_alem_m);
			$tot_otro = ($ctn_otro_h+$ctn_otro_m);

			// $prom_h  = round((($ctn_pos_h/$tot_pos)*100));
			// $prom_m  = round((($ctn_pos_m/$tot_pos)*100));

			$data_ingles = array(
				"ctn_ingle_h" => $ctn_ingle_h,
				"ctn_ingle_m" => $ctn_ingle_m,
				"tot_ingles" => $tot_ingles,
				"ingles_porc_h" => $ingles_porc_h,
				"ingles_porc_m" => $ingles_porc_m

			);	

			$data_frances = array(
				"ctn_fran_h" => $ctn_fran_h,
				"ctn_fran_m" => $ctn_fran_m,
				"tot_fran" => $tot_fran,
				"fran_porc_h" => $fran_porc_h,
				"fran_porc_m" => $fran_porc_m
			);

			$data_aleman = array(
				"ctn_alem_h" => $ctn_alem_h,
				"ctn_alem_m" => $ctn_alem_m,
				"tot_alem" => $tot_alem,
				"alem_porc_h" => $alem_porc_h,
				"alem_porc_m" => $alem_porc_m
			);

			$data_otro = array(
				"ctn_otro_h" => $ctn_otro_h,
				"ctn_otro_m" => $ctn_otro_m,
				"tot_otro" => $tot_otro,
				"otro_porc_h" => $otro_porc_h,
				"otro_porc_m" => $otro_porc_m
			);

			$data_final = array(
				$data_ingles,
				$data_frances,
				$data_aleman,
				$data_otro
			);

			//print_r(json_encode(  $data_final ));
				return $data_final;

		}



		public function get_residencia_actual(){


			$id_cuestionario = pre::get_id_cuestionario();


			foreach ($id_cuestionario as $key => $value) {

				 $stmt = $this->conexion->prepare("SELECT id_cuestionario, lugar_residencia_ciudad, lugar_residencia_estado FROM reporte_perfil_egresado WHERE id_cuestionario = :id_cuestionario");
				 
				 $stmt->bindParam(':id_cuestionario', $value["id_cuestionario"]);

				 $stmt->execute();

				 while ( $row = $stmt->fetch(2) ) {
					$residencia[] = $row;
				}

			}

			//get estados post comparacion

			$aux_ciudad = $residencia[0]["lugar_residencia_ciudad"];
			$aux_estado = $residencia[0]["lugar_residencia_estado"];

				foreach ($residencia as $key_b => $value) {

					$ciudad = $residencia[$key_b]["lugar_residencia_ciudad"];
					$estado = $residencia[$key_b]["lugar_residencia_estado"];

					if( $aux_ciudad != $ciudad && $aux_estado != $estado ){

						$new_data[$key_b][0] = $ciudad;
						$new_data[$key_b][1] = $estado;

						$aux_ciudad = $residencia[$key_b]["lugar_residencia_ciudad"];
						$aux_estado = $residencia[$key_b]["lugar_residencia_estado"];

					}

				}


			print_r(json_encode( array( $residencia, @$new_data ) ));

				// print_r(json_encode( array(  $ciudades, $residencia ) ));

		}

}

	$pre = new pre();
	$pre->get_posgrado();

?>