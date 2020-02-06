

<?php

	
	/**
	 * 
	 */

	include_once '../../PDO/bd/conexion.php';

	class data_reporte{

		public $conexion;

		function __construct(){
			$pdo = new conexion();
			$this->conexion = $pdo->bd();
		}

		public function ano_egreso(){

			$stmt = $this->conexion->prepare("SELECT ano_egreso_corto FROM cuestionario ORDER BY  ano_egreso_corto ASC");
			$stmt->execute();

			while ( $row = $stmt->fetch(2) ) {
				$data[] = $row["ano_egreso_corto"];
			}

				$final = array();
				$eliminados = array_unique($data);

					foreach ($eliminados as $key => $value) {
						$final_array[] = $value;
					}

				print_r(json_encode( array(
					$final_array
				) ));

		}

	}


	$data_reporte = new data_reporte();
	$data_reporte->ano_egreso();


?>