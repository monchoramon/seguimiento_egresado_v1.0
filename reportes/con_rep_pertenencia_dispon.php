<?php


/**
 * Pertinencia y disponibilidad de medios y recursos para el aprendizaje 
 */

include_once 'con_rep_perfil_egre.php';
include_once 'con_rep_ubicacion_laboral.php';

class pertenencia extends pre{

		public $conexion;
		public $pre;
		public $ubicacion_laboral;
		public $ctn;
		public $ctn_escala_h;
		public $ctn_escala_m;
		public $ctn_escala_all;
		public $final_data_escala;
		public $array_final;
		public $preguntas;
		public $array_final_dat;

		function __construct(){

			$pdo = new conexion();
			$this->conexion = $pdo->bd();
			$this->pre = new pre();
			$this->ubicacion_laboral = new ubicacion_laboral();
			$this->ctn = 0;	

			$this->ctn_escala_h;
			$this->ctn_escala_m;
			$this->ctn_escala_all;
			$this->array_final;

			$this->preguntas = array(
				"calidad_docente",
				"plan_estudio",
				"oportunidades_proyectos_inve",
				"investigacion_ensenansa",
				"infraestructura",
				"experiencia_residencia",
				"actividades_laborales",
				"formacion_academica",
				"utilidad_residencia",
			);

			$this->final_data_escala = array();
			$this->array_final_dat;

		}


	public function contador_pre_escala(){

			$this->ctn_escala_h = array(
				$muy_buena=0,
				$buena=0,
				$regular=0,
				$mala=0
			);

				$this->ctn_escala_m = array(
					$muy_buena=0,
					$buena=0,
					$regular=0,
					$mala=0
				);

					$this->ctn_escala_all = array(
						$muy_buena=0,
						$buena=0,
						$regular=0,
						$mala=0
					);




			$this->array_final = array( 
				                        $this->ctn_escala_h, 
				                        $this->ctn_escala_m, 
				                        $this->ctn_escala_all
				                    );

	}

	public function escala(){

		$escala = array(
			"Muy buena",
			"Buena",
			"Regular",
			"Mala"
		);


			return $escala;

	}

	public function get_calidad_docente( $columna ){

		pertenencia::contador_pre_escala();
		$escala = pertenencia::escala();

		$data_id_cues = $this->pre->get_id_cuestionario();
		$genero = $this->ubicacion_laboral->get_tipo_genero();

		foreach ($data_id_cues as $key => $value) {

			$stm = $this->conexion->prepare("SELECT id_cuestionario, $columna
				   FROM reporte_pertinencia WHERE id_cuestionario = :id_cuestionario");
			$stm->bindParam('id_cuestionario', $value["id_cuestionario"]);
			$stm->execute();

			while ( $row = $stm->fetch(2) ) {
				$data_calidad_docente[] = $row;
			}

			$data_calidad_docente[$key]["sexo"] = $genero[$key]["sexo"];

		}


		foreach ($data_calidad_docente as $key_a => $value_a) {

			switch ( $value_a["sexo"] ) {

				case 'Masculino':
					$tipe = 0;
					break;
				
				case 'Femenino':
					$tipe = 1;
					break;

			}

				foreach ($escala as $key_b => $value_b) {

					if( trim($value_a[$columna]) == $value_b ){

						if( $tipe == 0){
							$this->array_final[0][$key_b]++;
						}else{
							$this->array_final[1][$key_b]++;
						}

						$this->array_final[2][$key_b]++;

					}

				}

		}


		$this->final_data_escala[$this->ctn] = $this->array_final;
			// pertenencia::get_plan_estudio();

		if( $this->ctn == (sizeof($this->preguntas)-1) ){

			$this->array_final_dat = array(
				"data_final"=>@$this->final_data_escala,
				"data_main"=>@$data_calidad_docente
			);

				// print_r(json_encode( $this->array_final_dat ));

		}

		$this->ctn++;
		
	}

	public function main(){

		foreach ($this->preguntas as $key => $value) {
			pertenencia::get_calidad_docente( $value );
		}

			//print_r(json_encode( $this->array_final_dat ));

	}

		public function return_data(){
			return $this->array_final_dat;
		}

}

$pertenencia = new pertenencia();
$pertenencia->main();
	

?>