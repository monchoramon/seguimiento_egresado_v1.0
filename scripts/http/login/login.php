<?php

	require_once '../../PDO/bd/conexion.php';
	session_start();

/**
 * 
 */

class login{

	public $conexion;

	function __construct(){

		$pdo = new conexion();
		$this->conexion = $pdo->bd();
	}

	public function confirmar(){

			$usuario = $_POST["usuario"];
			$contrasena = $_POST["contrasena"];

			$sql = "SELECT cuenta.usuario_profesor FROM cuenta WHERE cuenta.usuario_profesor = :usuario_profesor AND cuenta.contrasena = :contrasena";

			$statement = $this->conexion->prepare($sql);
			$statement->bindParam(':usuario_profesor', $usuario);
			$statement->bindParam(':contrasena', $contrasena);
			$statement->execute();
			$users = $statement->fetch(2);

			if( $users ){
				login::noficacion( true, $users );
			}else{
				login::noficacion( false, false );
			}

	}

		public function noficacion( $tipe, $usuario ){

			switch ( $tipe ) {

				case true:
					login::datos_usuario( $usuario["usuario_profesor"] );
					$info = array('tipe' => true, "title"=>"Procesando, iniciando sesión...");
					break;

				case false:
					$info = array('tipe' => false, "title"=>"No se ha podido iniciar sesión, revise sus credenciales.");
					break;

			}

				print_r(json_encode( $info ));

		}

			public function datos_usuario( $usuario ){

				$sql = "SELECT profesor.nombre_completo, profesor.usuario_profesor FROM profesor WHERE profesor.usuario_profesor = :usuario_profesor";

				$statement = $this->conexion->prepare($sql);
				$statement->bindParam(':usuario_profesor', $usuario);
				$statement->execute();
				$user = $statement->fetch(2);

					$_SESSION["nombre_completo"] = $user["nombre_completo"];
					$_SESSION["usuario_profesor"] = $user["usuario_profesor"];
						login::marcar_session(1, $_SESSION["usuario_profesor"]);

			}


		public function marcar_session($tipo, $usuario){

			$stmt = $this->conexion->prepare("UPDATE cuenta SET session = '$tipo' WHERE usuario_profesor = :usuario_profesor");
			$stmt->bindParam(":usuario_profesor", $usuario);

			if( $stmt->execute() ){
				if( $tipo == 0 ){
					login::terminar_session();
				}
			}

		}

			public function terminar_session(){

				if( session_destroy() ){
					print_r(json_encode( array(
												"tipo"=>true, 
											  )));
				}

			}


		public function confirmar_session(){

			$tipo = false;
			$usuario = @$_SESSION["usuario_profesor"];

			$stmt = $this->conexion->prepare("SELECT session FROM cuenta WHERE usuario_profesor = :usuario_profesor");
			$stmt->bindParam(":usuario_profesor", $usuario);
			$stmt->execute();
			$session = $stmt->fetch();

			if( $usuario ){
				$tipo = true;
			}

			print_r(json_encode(array( "tipo"=>$tipo )));

		}


}

$login = new login();

switch ( @$_POST["tipo"] ) {

	case 1:
		$login->marcar_session(0, @$_SESSION["usuario_profesor"]);
		break;

	case 2:
		$login->confirmar_session();
		break;
	
	default:
		$login->confirmar();
		break;
}


?>