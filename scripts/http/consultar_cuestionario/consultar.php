<?php 

include_once '../../PDO/bd/conexion.php';
include_once "../tipo_privilegio/get_privilegios.php";

/**
 * 
 */

class consulta{

	public $conexion;
	public $id_cuestionario;
	public $privilegios;

	function __construct(){

		$pdo = new conexion();
		$this->conexion = $pdo->bd();
		$this->id_cuestionario = $_GET["id_encuesta"];
		$this->privilegios = new privilegios();

	}


		public function cuestionario(){

			$tipo_privilegio = $this->privilegios->get_privilegio();

			if( $tipo_privilegio != 3 && $tipo_privilegio != 1 ){

				switch ( $tipo_privilegio ) {

					case 2:
						print_r(json_encode( array( "tipo"=>1, "txt"=>"No tiene privilegios para consultar las encuestas." ) ));
					break;

					default:
						print_r(json_encode( array( "tipo"=>2, "txt"=>"Usted no cuenta con ningún privilegio asignado válido." ) ));
					break;

				}

			}else{

				$sql = "SELECT preguntas.id_cuestionario, preguntas.id_tag, preguntas.respuesta FROM preguntas WHERE preguntas.id_cuestionario = :id_cuestionario";

				$statement = $this->conexion->prepare($sql);
				$statement->bindParam(':id_cuestionario', $this->id_cuestionario);
				$statement->execute();
				
				while ( $row = $statement->fetch(2) ) {
					$data[] = $row;
				}

				print_r(json_encode( @$data ));

			}
			
		}

}

 $consulta = new consulta();
 $consulta->cuestionario();

?>