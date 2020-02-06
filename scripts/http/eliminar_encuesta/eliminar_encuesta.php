<?php


/**
 * 
 */

include_once "../../PDO/bd/conexion.php";
include_once "../tipo_privilegio/get_privilegios.php";

class eliminar{
	
	public $conexion;
	public $privilegios;

	function __construct(){

		$pdo = new conexion();
		$this->conexion = $pdo->bd();
		$this->privilegios = new privilegios();
	}

	// DELETE FROM reporte_perfil_egresado WHERE id_cuestionario = 4
	// DELETE FROM reporte_pertinencia WHERE id_cuestionario = 4
	// DELETE FROM reporte_ubicacion_laboral WHERE id_cuestionario = 4
	// DELETE FROM preguntas WHERE id_cuestionario = 4
	// DELETE FROM cuestionario WHERE id_cuestionario = 4
	// DELETE FROM cuenta WHERE numero_control = 14560445
	// DELETE FROM egresado WHERE numero_control = 14560445

	public function encuesta(){

		$tipo_privilegio = $this->privilegios->get_privilegio();

		if( $tipo_privilegio != 3 && $tipo_privilegio != 2 ){

			switch ( $tipo_privilegio ) {

				case 1:
					print_r(json_encode( array( "tipo"=>2, "txt"=>"No tiene los privilegios suficientes para ejecutar está función, solo puede consultar." ) ));
					break;
				
				default:
					print_r(json_encode( array( "tipo"=>3, "txt"=>"Usted no cuenta con ningún privilegio asignado válido." ) ));
					break;

			}

		}else{
			eliminar::eliminar_encuesta();
		}

	}


	public function eliminar_encuesta(){

		$ctn_con = 0;
		$tipo = false;

			$sql = array(
				"DELETE reporte_perfil_egresado, reporte_pertinencia, reporte_ubicacion_laboral, preguntas, cuenta
				FROM cuestionario
				INNER JOIN preguntas ON preguntas.id_cuestionario = cuestionario.id_cuestionario 
				INNER JOIN reporte_pertinencia ON reporte_pertinencia.id_cuestionario = cuestionario.id_cuestionario 
				INNER JOIN reporte_ubicacion_laboral ON reporte_ubicacion_laboral.id_cuestionario = cuestionario.id_cuestionario 
				INNER JOIN reporte_perfil_egresado ON reporte_perfil_egresado.id_cuestionario = cuestionario.id_cuestionario 
				INNER JOIN cuenta ON cuenta.numero_control = cuestionario.numero_control
				WHERE cuestionario.id_cuestionario = :id_cuestionario AND cuestionario.numero_control = :numero_control",
				"DELETE FROM cuestionario WHERE numero_control = :numero_control",
				"DELETE FROM egresado WHERE numero_control = :numero_control "
			);

				foreach ($sql as $key => $value) {

					$stmt = $this->conexion->prepare($value);

						if($key == 0){
							$stmt->bindParam(':id_cuestionario', $_POST["id_cuestionario"]);
						}

							$stmt->bindParam(':numero_control', $_POST["numero_control"]);

					if( $stmt->execute() ){
						$ctn_con++;
					}

				}

		if( $ctn_con == 3 ){
			print_r(json_encode( array( "tipo"=>1, "txt"=>"Encuesta eliminada correctamente." ) ));
		}else{
			print_r(json_encode( array( "tipo"=>null, "txt"=>"Error interno del servidor :-(" ) ) );
		}

	}

}

	$eliminar = new eliminar();
	$eliminar->encuesta();

?>