<?php

	include_once '../../PDO/bd/conexion.php';


/**
 * Consulta encuesta totales
 */

class consultar{
	
	public $conexion;
	public $id_cuestionario;

	function __construct(){

		$pdo = new conexion();
		$this->conexion = $pdo->bd();

	}

		public function encuestas(){

			$stmt = $this->conexion->prepare("SELECT * FROM cuestionario");
			$stmt->execute();

			while ( $row = $stmt->fetch(2) ) {
				$data[] = $row;
			}

				if( @$data ){

					// $data_final = consultar::get_nombre( $data  );

					// foreach ($data_final as $key => $value) {
					// 	$data[$key] = $data_final[$key];
					// }

					print_r(json_encode( array("data"=>@$data ) ));

				}

		}

			public function get_nombre( $data ){

				foreach ($data as $key => $value) {
					
					$stmt = $this->conexion->prepare("SELECT nombre_completo FROM egresado WHERE numero_control = :numero_control");

					$numero_control = $value["numero_control"];

					$stmt->bindParam(':numero_control',  $numero_control);

					$stmt->execute();

					while ( $row = $stmt->fetch(2) ) {
						$data_alu[] = $row;
					}						

				}	

				return $data_alu;

			}



}

$consultar = new consultar();
$consultar->encuestas();

?>