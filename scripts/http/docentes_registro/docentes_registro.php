<?php

/**
 * 
 */

include_once '../../PDO/bd/conexion.php';
include_once "../tipo_privilegio/get_privilegios.php";

class docentes{

	public $conexion;
	public $privilegios;

	function __construct(){
		$pdo = new conexion();
		$this->conexion = $pdo->bd();
		$this->privilegios = new privilegios();
	}
	

	public function registro(){

		$tipo_privilegio = $this->privilegios->get_privilegio();

		if( $tipo_privilegio == 2 || $tipo_privilegio == 3 ){

			$stmt = $this->conexion->prepare("SELECT profesor.nombre_completo, cuenta.usuario_profesor FROM profesor INNER JOIN cuenta ON cuenta.usuario_profesor = profesor.usuario_profesor");

			$stmt->execute();

			while ($row = $stmt->fetch(2) ) {
				$data[] = $row;
			}

			print_r(json_encode( array( "tipo"=>true, "data"=>$data ) ));

		}else{
			print_r(json_encode( array( "tipo"=>false, "txt"=>"No tiene los privilegios necesarios para actualizar la información de los docentes." ) ));
		}

		// 

	}

		function consulta_datos_doncente(){

			session_start();
			$_SESSION["user_act"] = $_POST["profesor"];

			$stmt = $this->conexion->prepare("SELECT cuenta.usuario_profesor, profesor.nombre_completo, cuenta.contrasena, cuenta.tipo, cuenta.root FROM profesor INNER JOIN cuenta ON cuenta.usuario_profesor = profesor.usuario_profesor WHERE profesor.usuario_profesor = :usuario_profesor");

			$stmt->bindParam(':usuario_profesor', $_POST["profesor"]);
			$stmt->execute();
			$data = $stmt->fetch(2);

			// while ( ) {
			// 	$data[] = $row;
			// }

				if( @$data ){
					print_r(json_encode( array( "tipo"=>true, "data"=>$data ) ));
				}

		}	

}


	$docentes = new docentes();

	switch ( $_POST["tipo"] ) {

		case 1:
			$docentes->registro();
			break;

		case 2:
			$docentes->consulta_datos_doncente();
			break;
		
		default:
			print_r(json_encode(array("tipo"=>false, "info"=>"Error, tipo no valido.")));
			break;

	}

?>