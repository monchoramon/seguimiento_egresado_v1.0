<?php

	/**
	 * 
	 */

	include_once '../../PDO/bd/conexion.php';

	class verificar{
		
		public $conexion;
		
		function __construct(){

			$pdo = new conexion();
			$this->conexion = $pdo->bd();

		}

			public function cuestionario(){

				$tipe = false;

				$stmt = $this->conexion->prepare("SELECT id_cuestionario FROM cuestionario  WHERE periodo = :periodo AND ano_egreso_corto = :ano_egreso_corto");
				$stmt->bindParam(':periodo', $_POST["periodo"]);
				$stmt->bindParam(':ano_egreso_corto', $_POST["ano"]);

				$stmt->execute();

				while( $row = $stmt->fetch(2) ) {
					$data[] = $row;
				}

					if(@$data){
						$tipe = true;

						include_once "../../../reportes/sesion.php";
						$_SESSION["periodo"] = $_POST["periodo"];
						$_SESSION["ano"] = $_POST["ano"];

					}

				print_r(json_encode( array("tipe"=>$tipe) ));

			}	

	}


$verificar = new verificar();
$verificar->cuestionario();

?>