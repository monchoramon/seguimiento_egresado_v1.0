<?php

	include_once "../../PDO/bd/conexion.php";

class privilegios{
	
		public $conexion;

		function __construct(){

			$pdo = new conexion();
			$this->conexion = $pdo->bd();
		}

		public function get_privilegio(){

			include_once '../../../reportes/sesion.php';
			$stmt = $this->conexion->prepare("SELECT tipo, root FROM cuenta WHERE usuario_profesor =:usuario_profesor");
			$stmt->bindParam(':usuario_profesor', $_SESSION["usuario_profesor"]);
			$stmt->execute();
			$row = $stmt->fetch(2);

			$tipo = 0;

			if( $row["root"] == 1 && $row["tipo"] == 1 ){//ambos
				$tipo = 3;
			}else{
				
				if( $row["root"] == 1 ){ //eliminar
					$tipo = 2;
				}
					if( $row["tipo"] == 1 ){ //consultar
						$tipo = 1;
					}
			}
			
			return $tipo;

		}

}

?>