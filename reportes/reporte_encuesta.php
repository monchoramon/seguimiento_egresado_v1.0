<?php

/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */

// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

require_once dirname(__FILE__).'/../scripts/PDO/bd/conexion.php';

/** Include PHPExcel */
require_once dirname(__FILE__).'/../scripts/PHPExcel/Classes/PHPExcel.php';


/*reportes*/
require_once 'con_rep_perfil_egre.php';
require_once 'con_rep_ubicacion_laboral.php';
require_once 'con_rep_pertenencia_dispon.php';
require_once "sesion.php";

/**
 * generar Excel
 */
class reporte_perfil extends pre{


	public $conexion;
	public $objPHPExcel;
	// public $periodo;
	// public $ano;
	public $pre;
	public $ubicacion_laboral;
	public $pertenencia;

	// public $sheet_reference;

	function __construct(){

		$pdo = new conexion();
		$this->conexion = $pdo->bd();
		// Create new PHPExcel object
		$this->objPHPExcel = new PHPExcel();

		//reportes, consultas
		$this->pre = new pre();
		$this->ubicacion_laboral = new ubicacion_laboral();
		$this->pertenencia = new pertenencia();
		// $this->sheet_reference = null;

	}


	public function create_sheet( $title ){

		$sheet = $this->objPHPExcel->createSheet();
		$sheet->setTitle( $title );

	}


	// public function sheet_main_reference(){
	// 	$this->sheet_reference = ;
	// }

	public function propiedades_excel(){

		// include_once "sesion.php";
		// $_SESSION["periodo"] = @$_GET["periodo"];
		// $_SESSION["ano"] = @$_GET["ano"];

		if (PHP_SAPI == 'cli')

			die('This example should only be run from a Web Browser');

		// Set document properties
		$this->objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
									 ->setLastModifiedBy("Maarten Balliauw")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");

		// Rename worksheet // Nombre de la hoja de trabajo
		$this->objPHPExcel->getActiveSheet(0)->setTitle('Perfil del egresado');
			reporte_perfil::tabla_sexo();

	}


	public function header_sheet( $sheet_index ){
		$this->objPHPExcel->setActiveSheetIndex( $sheet_index )
			 ->setCellValue('B2', "INSTITUTO TECNOLÓGICO DE LÁZARO CÁRDENAS");
	}

	public function tabla_sexo(){

				$data = $this->pre->get_sexo_alumnos();
				/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas

				reporte_perfil::header_sheet( 0 );

				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B4', "I.PERFIL DEL EGRESADO")
					->setCellValue('B5', $_SESSION["periodo"].' '.$_SESSION["ano"]) // A
		            ->setCellValue('B6', "SEXO") // B
		            ->setCellValue('D6', "NÚMERO DE ALUMNOS") // C
		            ->setCellValue('G6', "%"); // D


		        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1

					->setCellValue('B7', "MASCULINO")
		            ->setCellValue('B8', "FEMENINO")
		            ->setCellValue('B9', "TOTAL")

		            //columna 2	

		            ->setCellValue('D7', $data["hombre"])
		            ->setCellValue('D8', $data["mujer"])


		            // ->setCellValue('I7', $this->periodo)
		            // ->setCellValue('I8', $this->ano)

		            ->setCellValue('D9', '=SUM(D7+D8)')

		            //columna 2	

		            ->setCellValue('G7', '=IF(D7 > 0, (D7*100/D9), 0)')
		            ->setCellValue('G8', '=IF(D8 > 0, (D8*100/D9), 0)')
		            ->setCellValue('G9', '=SUM(G7+G8)');


		        //Unir celdas
	            $this->objPHPExcel->getActiveSheet(0)
	            	->mergeCells('B2:L2')
	            	->mergeCells('B4:E4')
        			->mergeCells('B5:G5')
        			->mergeCells('B6:C6')
        			->mergeCells('D6:F6')
        			->mergeCells('B7:C7')
        			->mergeCells('B8:C8')
        			->mergeCells('B9:C9')
        			->mergeCells('D7:F7')
        			->mergeCells('D8:F8')
        			->mergeCells('D9:F9')
        			; 


			reporte_perfil::tabla_egresados();

	}


		public function tabla_egresados(){

			$data = $this->pre->get_sexo_alumnos();

			/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B12', "TABLA DE EGRESADOS")
					->setCellValue('B13', $_SESSION["periodo"].' '.$_SESSION["ano"])
		            ->setCellValue('B14', "EGRESADOS")
		            ->setCellValue('D14', "NÚMERO DE ALUMNOS EGRESADOS")
		            ->setCellValue('H14', "%");


		        //Contenido
		        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1

					->setCellValue('B15', "HOMBRES")
		            ->setCellValue('B16', "MUJERES")
		            ->setCellValue('B17', "TOTAL")

		            //columna 2	

		            ->setCellValue('D15', $data["hombre"])
		            ->setCellValue('D16', $data["mujer"])
		            ->setCellValue('D17', '=SUM(D15+D16)')

		            //columna 2	

		            ->setCellValue('H15', '=IF(D15 > 0, (D15*100/D17), 0)')
		            ->setCellValue('H16', '=IF(D16 > 0, (D16*100/D17), 0)')
		            ->setCellValue('H17', '=SUM(H15+H16)');


		             //Unir celdas
		            $this->objPHPExcel->getActiveSheet(0)
		            	->mergeCells('B12:E12')
		            	->mergeCells('B13:H13')
	        			->mergeCells('B14:C14')
	        			->mergeCells('D14:G14')
	        			->mergeCells('B15:C15')
	        			->mergeCells('B16:C16')
	        			->mergeCells('B17:C17')
	        			->mergeCells('D15:G15')
	        			->mergeCells('D16:G16')
	        			->mergeCells('D17:G17')
	        			; 

			reporte_perfil::tabla_titulados();

		}



		public function tabla_titulados(){

			$data = $this->pre->get_titulados();

			/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B20', "TABLA DE TITULADOS")
					->setCellValue('B21', $_SESSION["periodo"].' '.$_SESSION["ano"])
		            ->setCellValue('B22', "ALUMNOS TITULADOS")
		            ->setCellValue('D22', "SI")
		            ->setCellValue('F22', "NO");


		        //Contenido
		        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1

					->setCellValue('B23', "HOMBRES")
		            ->setCellValue('B24', "MUJERES")
		            ->setCellValue('B25', "TOTAL")

		            //columna 2	

		            ->setCellValue('D23', $data["si_hombre"])
		            ->setCellValue('D24', $data["si_mujer"])
		            ->setCellValue('D25', '=SUM(D23:D24)')

		            //columna 2	

		            ->setCellValue('F23', $data["no_hombre"])
		            ->setCellValue('F24', $data["no_mujer"])
		            ->setCellValue('F25', '=SUM(F23:F24)');


		             //Unir celdas
		            $this->objPHPExcel->getActiveSheet(0)
		            	->mergeCells('B20:E20')
		            	->mergeCells('B21:G21')
	        			->mergeCells('B22:C22')
	        			->mergeCells('D22:E22')
	        			->mergeCells('F22:G22')
	        			->mergeCells('B23:C23')
	        			->mergeCells('B24:C24')
	        			->mergeCells('B25:C25')
	        			->mergeCells('D23:E23')
	        			->mergeCells('D24:E24')
	        			->mergeCells('D25:E25')
	        			->mergeCells('F23:G23')
	        			->mergeCells('F24:G24')
	        			->mergeCells('F25:G25')
	        			; 

		
			reporte_perfil::tabla_posgrados();


		}


		public function tabla_posgrados(){

				$data = $this->pre->get_posgrado();

				/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B28', "TABLA DE POSGRADO")
					->setCellValue('B29', $_SESSION["periodo"].' '.$_SESSION["ano"])
		            ->setCellValue('B30', "POSGRADO")
		            ->setCellValue('D30', "NUMERO DE ALUMNOS CON POSGRADO")
		            ->setCellValue('H30', "%")
		            ->setCellValue('I29', "TIPO DE POSGRADO")
		            ->setCellValue('I30', "MAESTRIA")
		            ->setCellValue('K30', "DOCTORADO")
		            ->setCellValue('M30', "POSDOCTORADO")
		            ;

		        //Contenido
		        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1

					->setCellValue('B31', "HOMBRES")
		            ->setCellValue('B32', "MUJERES")
		            ->setCellValue('B33', "TOTAL")

		            //columna 2	

		            ->setCellValue('D31', $data["ctn_pos_h"])
		            ->setCellValue('D32', $data["ctn_pos_m"])
		            ->setCellValue('D33', '=SUM(D31+D32)')

		            //columna 3

		            ->setCellValue('H31', '=IF(D31>0,(D31*100/D33),0)')
		            ->setCellValue('H32', '=IF(D32>0,(D32*100/D33),0)')
		            ->setCellValue('H33', '=SUM(H31+H32)')

		             //columna 4 *

		            ->setCellValue('I31', $data["pos_maes_h"])
		            ->setCellValue('K31', $data["pos_doct_h"])
		            ->setCellValue('M31', $data["pos_posdoct_h"])

		             //columna 5
		            ->setCellValue('I32', $data["pos_maes_m"])
		            ->setCellValue('K32', $data["pos_doct_m"])
		            ->setCellValue('M32', $data["pos_posdoct_m"]);

		             //columna 6

		            // ->setCellValue('I33', '=SUM(H31+H32)')
		            // ->setCellValue('K33', '=SUM(H31+H32)')
		            // ->setCellValue('M33', '=SUM(H31+H32)');


		             //Unir celdas
		            $this->objPHPExcel->getActiveSheet(0)
		            	->mergeCells('B28:E28')
		            	->mergeCells('B29:G29')
	        			->mergeCells('B30:C30')
	        			->mergeCells('D30:G30')

	        			->mergeCells('B31:C31')
	        			->mergeCells('B32:C32')
	        			->mergeCells('B33:C33')

	        			->mergeCells('D31:G31')
	        			->mergeCells('D32:G32')
	        			->mergeCells('D33:G33')

	        			// *
	        			->mergeCells('I29:N29')
	        			->mergeCells('I30:J30')
	        			->mergeCells('I31:J31')
	        			->mergeCells('I32:J32')
	        			->mergeCells('I33:J33')

	        			->mergeCells('K30:L30')
	        			->mergeCells('K31:L31')
	        			->mergeCells('K32:L32')
	        			->mergeCells('K33:L33')

	        			->mergeCells('M30:N30')
	        			->mergeCells('M31:N31')
	        			->mergeCells('M32:N32')
	        			->mergeCells('M33:N33')
	        			; 

    		reporte_perfil::table_dominio_idioma();

		}


		public function table_dominio_idioma(){

			$data = $this->pre->get_idioma();

			$ingle_porc_h = $data[0]["ingles_porc_h"];
			$ingle_porc_m = $data[0]["ingles_porc_m"];
			$fran_porc_h = $data[1]["fran_porc_h"];
			$fran_porc_m = $data[1]["fran_porc_m"];
			$alem_porc_h = $data[2]["alem_porc_h"];
			$alem_porc_m = $data[2]["alem_porc_m"];
			$otro_porc_h = $data[3]["otro_porc_h"];
			$otro_porc_m = $data[3]["otro_porc_m"];

				/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B36', "TABLA DEL DOMINIO DE IDIOMA")
					->setCellValue('B37', $_SESSION["periodo"].' '.$_SESSION["ano"])
		            ->setCellValue('B38', "IDIOMA")
		            ->setCellValue('B39', "HOMBRES")
		            ->setCellValue('B40', "MUJERES")
		            ->setCellValue('B41', "TOTAL")
		            ->setCellValue('E38', "INGLÉS")
		            ->setCellValue('G38', "PORCENTAJE PROMEDIO")
		            ->setCellValue('I38', "FRANCÉS")
		            ->setCellValue('K38', "PORCENTAJE PROMEDIO")
		            ->setCellValue('M38', "ALEMÁN")
		            ->setCellValue('O38', "PORCENTAJE PROMEDIO")
		            ->setCellValue('Q38', "OTRO")
		            ->setCellValue('S38', "PORCENTAJE PROMEDIO");

			        //Contenido
			        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1
					->setCellValue('E39', $data[0]["ctn_ingle_h"])
		            ->setCellValue('E40', $data[0]["ctn_ingle_m"])
		            ->setCellValue('E41', '=SUM(E39:E40)')

		            //columna 2	
		            ->setCellValue('G39', '=IF( E39 > 0, ('.$ingle_porc_h.'/E39), 0)')
		            ->setCellValue('G40', '=IF( E40 > 0, ('.$ingle_porc_m.'/E40), 0)')
		            // ->setCellValue('G41', '=SUM(G39:G40)')

		            //columna 3
		            ->setCellValue('I39', $data[1]["ctn_fran_h"])
		            ->setCellValue('I40', $data[1]["ctn_fran_m"])
		            ->setCellValue('I41', '=SUM(I39+I40)')

		              //columna 4
		            ->setCellValue('K39', '=IF( I39 > 0,  ('.$fran_porc_h.'/I39), 0)')
		            ->setCellValue('K40', '=IF( I40 > 0,  ('.$fran_porc_m.'/I40), 0)')
		            // ->setCellValue('K41', '=SUM(K39:K40)')

		             //columna 5 *
		            ->setCellValue('M39', $data[2]["ctn_alem_h"])
		            ->setCellValue('M40', $data[2]["ctn_alem_m"])
		            ->setCellValue('M41', '=SUM(M39+M40)')

		             //columna 6
		            ->setCellValue('O39', '=IF( M39 > 0,('.$alem_porc_h.'/M39), 0)')
		            ->setCellValue('O40', '=IF( M40 > 0,('.$alem_porc_m.'/M40), 0)')
		            // ->setCellValue('O41', '=SUM(O39:O40)')

		            //columna 7
		            ->setCellValue('Q39', $data[3]["ctn_otro_h"])
		            ->setCellValue('Q40', $data[3]["ctn_otro_m"])
		            ->setCellValue('Q41', '=SUM(Q39:Q40)')

		             //columna 7
		            ->setCellValue('S39', '=IF( Q39 > 0,('.$otro_porc_h.'/Q39), 0)')
		            ->setCellValue('S40', '=IF( Q40 > 0,('.$otro_porc_m.'/Q40), 0)')
		            // ->setCellValue('S41', '=SUM(S39:S40)')
		            ;

			//reporte_perfil::residencia_actual();

		    //revisar los demas scripts+++++++++++++++++++++++++++++++++++++++++++
            reporte_perfil::create_sheet( 'Ubicación laboral' );
				reporte_perfil::sheet_ubicacion_laboral();
			            //reporte_perfil::generar_excel();


		}

		//FALTA//

		// public function residencia_actual(){


		// 		/*******************Hoja 1********************/
				
		// 		// Add some data // Encabezado columnas
		// 		$this->objPHPExcel->setActiveSheetIndex(0)
		// 			->setCellValue('B36', "TABLA DE RESIDENCIA ACTUAL")
		// 			->setCellValue('B37', "AGO-DIC 2016")
		//             ->setCellValue('B38', "CIUDAD")
		//             ->setCellValue('D38', "ESTADO")
		//             ->setCellValue('F38', "M")
		//             ->setCellValue('G38', "F")
		//             ->setCellValue('H38', "TOTAL")
		//             ;

		//         //Contenido
		//         $this->objPHPExcel->setActiveSheetIndex(0)

		//         	//columna 1

		// 			->setCellValue('B39', "LÁZARO CÁRDENAS")
		//             ->setCellValue('B40', "LA HUACANA")
		//             ->setCellValue('B41', "CHILPANCINGO")
		//             ->setCellValue('B42', "PAPANOA");

	           
	 //        	// Rename worksheet // Nombre de la hoja de trabajo
		// 		$this->objPHPExcel->getActiveSheet(0)->setTitle('Perfil del egresado');

		// 		// Set active sheet index to the first sheet, so Excel opens this as the first sheet // Indice de la hoja donde se creara la tabla
		// 		$this->objPHPExcel->setActiveSheetIndex(0);


		// 		reporte_perfil::create_sheet( 'Ubicación laboral' );
		// 			reporte_perfil::sheet_ubicacion_laboral();

		// }

		/************Ubicación Laboral************/

		public function sheet_ubicacion_laboral(){

			//header
			reporte_perfil::header_sheet( 1 );
				reporte_perfil::table_trabajando_tipo();
		}


		public function table_trabajando_tipo(){


			//get array data
			$data = $this->ubicacion_laboral->get_trabaja();

			//Columnas y filas principales
			$this->objPHPExcel->setActiveSheetIndex(1)
					->setCellValue('B3', "UBICACIÓN LABORAL")
					->setCellValue('B5', "ACTIVIDAD A LA QUE SE DEDICA ACTUALMENTE")
					->setCellValue('B6', $_SESSION["periodo"].' '.$_SESSION["ano"])
		            ->setCellValue('B7', "HOMBRES")
		            ->setCellValue('B8', "MUJERES")
		            ->setCellValue('B9', "TOTAL")
		            ->setCellValue('C6', "TRABAJA")
		            ->setCellValue('D6', "ESTUDIA")
		            ->setCellValue('E6', "ESTUDIA Y TRABAJA")
		            ->setCellValue('F6', "NO ESTUDIA NI TRABAJA")
		            ;

		        $this->objPHPExcel->setActiveSheetIndex(1)

		            //columna 2	

		            ->setCellValue('C7', $data["actividad_actual_h"][0])
		            ->setCellValue('D7', $data["actividad_actual_h"][1])
		            ->setCellValue('E7', $data["actividad_actual_h"][2])
		            ->setCellValue('F7', $data["actividad_actual_h"][3])

		            //columna 2	

		            ->setCellValue('C8', $data["actividad_actual_m"][0])
		            ->setCellValue('D8', $data["actividad_actual_m"][1])
		            ->setCellValue('E8', $data["actividad_actual_m"][2])
		            ->setCellValue('F8', $data["actividad_actual_m"][3])

		            ->setCellValue('C9', "=SUM(C7:C8)")
		            ->setCellValue('D9', "=SUM(D7:D8)")
		            ->setCellValue('E9', "=SUM(E7:E8)")
		            ->setCellValue('F9', "=SUM(F7:F8)");


		        //Unir celdas
	            $this->objPHPExcel->getActiveSheet(1)
	            	->mergeCells('B5:D5'); 

        	reporte_perfil::tabla_trabaja_area();

		}


		public function tabla_trabaja_area(){

			//get array data
			$data = $this->ubicacion_laboral->get_trabajo();

				//Columnas y filas principales
				$this->objPHPExcel->setActiveSheetIndex(1)
						->setCellValue('B12', "¿EN QUÉ TRABAJA?")
						->setCellValue('B13', $_SESSION["periodo"].' '.$_SESSION["ano"])
			            ->setCellValue('B14', "TRABAJO")
			            ->setCellValue('B15', "HOMBRES")
			            ->setCellValue('B16', "MUJERES")
			            ->setCellValue('B17', "TOTAL")

			            ->setCellValue('C14', "COMERCIO PROPIO")
			            ->setCellValue('D14', "EMPLEADO EN COMERCIO")
			            ->setCellValue('E14', "EMPRESA PROPIA DE INFORMATICA O AFÍN")
			            ->setCellValue('F14', "EMPLEADO EN EMPRESA DE INFORMATICA O AFÍN")
			            ->setCellValue('G14', "DUEÑO DE PYME EN ISC")
			            ->setCellValue('H14', "EMPLEADO DE PYME EN ISC")
			            ->setCellValue('I14', "EMPLEADO EN INSTITUTOCIÓN EDUCATIVA LABORANDO EN EL CENTRO DE CÓMPUTO O AFÍN")
			            ->setCellValue('J14', "EMPLEADO EN INSTITUTOCIÓN EDUCATIVA LABORANDO COMO DOCENTE")
			            ->setCellValue('K14', "PREESCOLAR")
			            ->setCellValue('L14', "PRIMARIA")
			            ->setCellValue('M14', "SECUNDARIA")
			            ->setCellValue('N14', "NIVEL MEDIO SUPERIOR")
			            ->setCellValue('O14', "NIVEL SUPERIOR")
			            ->setCellValue('P14', "NIVEL POSGRADO")
			            ;

			        $pos_index = array('C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P');
			        // $ctn_hombres = array(5, 3, 2, 5, 9, 3, 4, 12, 3, 5, 5, 8, 4, 1); 
			        // $ctn_mujeres = array(15, 4, 2, 3, 9, 3, 9, 12, 3, 5, 3, 9, 4, 10); 
			        $x = 0;

			        $data_full = array( $data["ctn_dependencia_h"], $data["ctn_dependencia_m"] );
			        $row_num = '15';

			        foreach ($data_full as $key_a => $data_main) {
			        	foreach ($data_main as $key_b => $data_final) {

			        		if( $key_a > 0 ){
			        			$row_num = '16';
			        		}

			        		$concat_text = $pos_index[$key_b].$row_num;

			        		$this->objPHPExcel->setActiveSheetIndex(1)
								 ->setCellValue( $concat_text, $data_final);

			        	}
			        }

			       	// //Ajustar texto a la celda X

			        // foreach ($pos_index as $key => $value) {
			        // 	$this->objPHPExcel->getActiveSheet(1)
		        	// 			->getStyle($value.'14')
		        	// 			->getAlignment()
		        	// 			->setWrapText(true);
			        // }

		        //Operaciones
	        	foreach ($pos_index as $key_b => $data_final) {

	        		$celda_a = $data_final.'15';
	        		$celda_b = $data_final.'16';

    		    	$this->objPHPExcel->setActiveSheetIndex(1)
								 ->setCellValue(
								 	$data_final.'17', "=SUM($celda_a:$celda_b)"
								 );

		
	        	}

	        	 //Unir celdas
		         $this->objPHPExcel->getActiveSheet(1)
		            ->mergeCells('C13:P13'); 
		        
        			reporte_perfil::table_puesto_trabajo();

		}


		public function table_puesto_trabajo(){

			//get array data
			$data = $this->ubicacion_laboral->get_puesto_trabajo();

			$columns_letter = array("C", "D", "E", "F", "G");
			$rows = array("23", "24", "25");
			$data_columns = array("GERENTE", 
				                  "JEFE DE ÁREA", 
				                  "SUPERVISOR", 
				                  "ENCARGADO DE DEPTO.", 
				                  "OTRO");

			//main columns
			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B20', "¿CUÁL ES SU PUESTO DE TRABAJO?")
			     ->setCellValue('C21', $_SESSION["periodo"].' '.$_SESSION["ano"])
			     ->setCellValue('B22', "PUESTO")
			     ->setCellValue('B23', "HOMBRES")
			     ->setCellValue('B24', "MUJERES")
			     ->setCellValue('B25', "TOTAL")

			     //Unir celdas
            	 ->mergeCells('C21:G21');

			     foreach ($columns_letter as $key => $value_lett) {
			     	$this->objPHPExcel->setActiveSheetIndex(1)
			     	     ->setCellValue($value_lett.'22', $data_columns[$key]);
			     }

			$array_dat = array("ctn_puesto_h", "ctn_puesto_m");

			//asignacion de resultados
			foreach ($rows as $key_col => $value_col) {
				foreach ($columns_letter as $key_lett => $value_lett) {

					if($key_col != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($value_lett.$value_col, $data[$array_dat[$key_col]][$key_lett]);
					}else{

							$celda_a = $value_lett.$rows[0];
							$celda_b = $value_lett.$rows[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$value_lett.$value_col, "=SUM($celda_a:$celda_b)" 
							 );
					}

				}

			}

            	reporte_perfil::table_real_salary();

		}


		public function table_real_salary(){

			//get array data
			$data = $this->ubicacion_laboral->get_salario_actual();

			$columns_letter = array("C", "D", "E", "F");
			$rows = array("31", "32", "33");
			$data_columns = array("5000-10000", 
				                  "10000-15000", 
				                  "15000-20000", 
				                  "OTRA CANTIDAD");

			//main columns
			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B28', "¿CUÁL ES ES SU SALARIO ACTUAL?")
			     ->setCellValue('B30', "SALARIO")
			     ->setCellValue('B31', "HOMBRES")
			     ->setCellValue('B32', "MUJERES")
			     ->setCellValue('B33', "TOTAL")
			     ->setCellValue('C29', $_SESSION["periodo"].' '.$_SESSION["ano"])

			     //Unir celdas
			     ->mergeCells('C29:F29')

			     ;

			     foreach ($columns_letter as $key => $value_lett) {
			     	$this->objPHPExcel->setActiveSheetIndex(1)
			     	     ->setCellValue($value_lett.'30', $data_columns[$key]);
			     }
						
			$array_dat = array("salario_h", "salario_m");

			//asignacion de resultados
			foreach ($rows as $key_col => $value_col) {
				foreach ($columns_letter as $key_lett => $value_lett) {

					if($key_col != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($value_lett.$value_col, $data[$array_dat[$key_col]][$key_lett]);
					}

					else{

							$celda_a = $value_lett.$rows[0];
							$celda_b = $value_lett.$rows[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$value_lett.$value_col, "=SUM($celda_a:$celda_b)" 
							 );
					}
				}	
			}


    		reporte_perfil::table_contract();


		}


		public function table_contract(){

			//get array data
			$data = $this->ubicacion_laboral->get_tipo_contrato();

			$this->objPHPExcel->getActiveSheet(1)
			     ->setCellValue('B36', "¿CUÁL ES EL TIPO DE CONTRATO QUE TIENE CON LA EMPRESA?")
			     ->setCellValue('B38', "TIPO DE CONTRATO")
			     ->setCellValue('B39', "HOMBRES")
			     ->setCellValue('B40', "MUJERES")
			     ->setCellValue('B41', "TOTAL")
			     ->setCellValue('C37', $_SESSION["periodo"].' '.$_SESSION["ano"])
			     ->setCellValue('C38', "BASE")
			     ->setCellValue('D38', "EVENTUAL")
			     ->setCellValue('E38', "CONTRATO")

			     //Unir celdas
			     ->mergeCells('C37:D37')
			     ;

			$array_number = array(39, 40, 41);
			$array_letter = array("C", "D", "E");
			$array_dat = array("ctn_contrato_h", "ctn_contrato_m");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {

					if($key_num != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($letter.$number, $data[$array_dat[$key_num]][$key_lett]);
					}

					else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
					}
				}	
			}

			reporte_perfil::tabla_idioma_empresa();

		}


		public function tabla_idioma_empresa(){

			//get array data
			$data = $this->ubicacion_laboral->get_idioma();

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B44', '¿CUÁL ES EL IDIOMA QUE UTILIZA EN LA EMPRESA?')
 			  	 ->setCellValue('B46', 'IDIOMA')
			     ->setCellValue('B47', 'HOMBRES')
			     ->setCellValue('B48', 'MUJERES')
			     ->setCellValue('B49', 'TOTAL')
			     ->setCellValue('C45', $_SESSION["periodo"].' '.$_SESSION["ano"])
			     ->setCellValue('C46', 'INGLÉS')
			     ->setCellValue('D46', 'FRANCÉS')
			     ->setCellValue('E46', 'ALEMÁN')
			     ->setCellValue('F46', 'JAPONES')
 			     ->setCellValue('G46', 'OTRO')

 			     //Unir celdas
 			     ->mergeCells('C45:F45')
			     ;


			//resultados
	     	$array_number = array(47, 48, 49);
			$array_letter = array("C", "D", "E", "F", "G");
			$array_dat = array("ctn_idioma_h", "ctn_idioma_m");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {

					if($key_num != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($letter.$number, $data[$array_dat[$key_num]][$key_lett]);
					}

					else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
					}
				}	
			}

			//----------------------------

			reporte_perfil::tabla_antiguedad_empresa();

		}


		public function tabla_antiguedad_empresa(){

			//get array data
			$data = $this->ubicacion_laboral->get_antiguedad_empresa();

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B52', '¿CUÁL ES LA ANTIGÜEDAD QUE TIENE EN LA EMPRESA?')
 			  	 ->setCellValue('B54', 'ANTIGÜEDAD')
			     ->setCellValue('B55', 'HOMBRES')
			     ->setCellValue('B56', 'MUJERES')
			     ->setCellValue('B57', 'TOTAL')
			     ->setCellValue('C53', $_SESSION["periodo"].' '.$_SESSION["ano"])
			     ->setCellValue('C54', 'MENOS DE UN AÑO')
			     ->setCellValue('D54', 'UN AÑO')
			     ->setCellValue('E54', 'DOS AÑOS')
 			     ->setCellValue('F54', 'TRES AÑOS')
 			     ->setCellValue('G54', 'MAS DE TRES AÑOS')

 			     //Unir celdas
 			     ->mergeCells('C53:H53')
			     ;


			//resultados
	     	$array_number = array(55, 56, 57);
			$array_letter = array("C", "D", "E", "F", "G");
			$array_dat = array("ctn_antiguedad_h", "ctn_antiguedad_m");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {

					if($key_num != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($letter.$number, $data[$array_dat[$key_num]][$key_lett]);
					}

					else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
					}
				}	
			}


			reporte_perfil::tabla_timepo_transcurrido();

		}

		public function tabla_timepo_transcurrido(){

			//get array data
			$data = $this->ubicacion_laboral->get_timpo_primer_empleo();

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B60', '¿CUÁL FUE EL TIEMPO TRANSCURRIDO PARA OBTENER SU PRIMER EMPLEO?')
 			  	 ->setCellValue('B62', 'TIEMPO')
			     ->setCellValue('B63', 'HOMBRES')
			     ->setCellValue('B64', 'MUJERES')
			     ->setCellValue('B65', 'TOTAL')

			     ->setCellValue('C61', $_SESSION["periodo"].' '.$_SESSION["ano"])
			     ->setCellValue('C62', 'ANTES DE EGRESAR')
			     ->setCellValue('D62', 'MENOS DE SEIS MESES')
			     ->setCellValue('E62', 'ENTRE SEIS MESES Y UN AÑO')
 			     ->setCellValue('F62', 'MAS DE UN AÑOS')

 			     //Unir celdas
 			     ->mergeCells('C61:F61')
			     ;


			//resultados
	     	$array_number = array(63, 64, 65);
			$array_letter = array("C", "D", "E", "F");
			$array_dat = array("ctn_tiempo_obtener_h", "ctn_tiempo_obtener_m");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {

					if($key_num != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($letter.$number, $data[$array_dat[$key_num]][$key_lett]);
					}

					else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
					}

				}	
				
			}

			reporte_perfil::table_medio_trabajo();

		}


		public function table_medio_trabajo(){

			//get array data
			$data = $this->ubicacion_laboral->get_medio_usado_empleo();

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B68', '¿CUÁL FUE EL MEDIO USADO PARA OBTENER TU PRIMER EMPLEO?')
 			  	 ->setCellValue('B70', 'MEDIO USADO')
			     ->setCellValue('B71', 'HOMBRES')
			     ->setCellValue('B72', 'MUJERES')
			     ->setCellValue('B73', 'TOTAL')

			     ->setCellValue('C69', $_SESSION["periodo"].' '.$_SESSION["ano"])
			     ->setCellValue('C70', 'BOLSA DE TRABAJO DEL PLANTEL')
			     ->setCellValue('D70', 'CONTACTOS PERSONALES')
			     ->setCellValue('E70', 'RESIDENCIA PROFESIONAL')
 			     ->setCellValue('F70', 'OTRO')

 			     //Unir celdas
 			     ->mergeCells('C69:F69')
			     ;

			//resultados
	     	$array_number = array(71, 72, 73);
			$array_letter = array("C", "D", "E", "F");
			$array_dat = array("ctn_medio_usado_h", "ctn_medio_usado_m");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {

					if($key_num != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($letter.$number, $data[$array_dat[$key_num]][$key_lett]);
					}

					else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
					}
				}	
			}


			reporte_perfil::table_tamano_empresa();

		}


		public function table_tamano_empresa(){

			//get array data
			$data = $this->ubicacion_laboral->get_tamano_empresa_labora();

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B76', '¿DE QUE TAMAÑO ES LA EMPRESA DONDE LABORA?')
 			  	 ->setCellValue('B78', 'TAMAÑO')
			     ->setCellValue('B79', 'HOMBRES')
			     ->setCellValue('B80', 'MUJERES')
			     ->setCellValue('B81', 'TOTAL')

			     ->setCellValue('C77', $_SESSION["periodo"].' '.$_SESSION["ano"])
			     ->setCellValue('C78', 'MICROEMPRESA (1-30 PERSONAS)')
			     ->setCellValue('D78', 'PEQUEÑA (31-100 PERSONAS)')
			     ->setCellValue('E78', 'MEDIANA (101-500 PERSONAS)')
 			     ->setCellValue('F78', 'GRANDE (MÁS DE 500 PERSONAS)')

 			     //Unir celdas
 			     ->mergeCells('C77:F77')
			     ;

			 //resultados
	     	$array_number = array(79, 80, 81);
			$array_letter = array("C", "D", "E", "F");
			$array_dat = array("ctn_tamano_empresa_h", "ctn_tamano_empresa_m");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {

					if($key_num != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($letter.$number, $data[$array_dat[$key_num]][$key_lett]);
					}

					else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[1];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
					}
				}	
			}

			reporte_perfil::preguntas_extras();

		}

		//preguntas extra --> ubicación laboral
		public function preguntas_extras(){

				$data = $this->pertenencia->main();

					if( !$data ){
						$data_final = $this->pertenencia->return_data();
					}

					//Columnas y filas principales
					$this->objPHPExcel->setActiveSheetIndex(1)
		            ->setCellValue('B86', "1. ¿COMO ES SU EFICIENCIA PARA REALIZAR LAS ACTIVIDADES LABORALES EN RELACIÓN CON SU FORMACIÓN ACADÉMICA?")
		            ->setCellValue('B87', "2. ¿COMO CALIFICA SU FORMACIÓN ACADÉMICA CON RESPECTO A SU DESEMPEÑO LABORAL?")
		            ->setCellValue('B88', "3. ¿ QUE UTILIDAD TIENEN LAS RESIDENCIAS PROFESIONALES O PRÁCTICAS PROFESIONALES PARA SU DESARROLLO LABORAL Y PROFESIONAL?")
		            ->setCellValue('B89', "TOTAL")

					->setCellValue('C84', $_SESSION["periodo"].' '.$_SESSION["ano"])
					->setCellValue('C85', "MUY BUENA")
					->setCellValue('D85', "BUENA")
					->setCellValue('E85', "REGULAR")
					->setCellValue('F85', "MALA")
					->setCellValue('G85', "TOTAL");

	        //Unir celdas
            	$this->objPHPExcel->getActiveSheet(1)
            	->mergeCells('C84:G84'); 

	         //resultados
	     	$array_number = array(86,
	     						  87,
	     						  88,
	     						  89
	     						 );

	     	$new_index = array(6, 7, 8);


			$array_letter = array("C", "D", "E", "F", "G");
			$array_dat = array("data_final");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {


					if( $key_lett != 4){

						if($key_num != 3){
							$this->objPHPExcel->setActiveSheetIndex(1)
			     				->setCellValue($letter.$number,
			     					$data_final["data_final"][$new_index[$key_num]][2][$key_lett]
			     				);
						}else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[2];

							$this->objPHPExcel->setActiveSheetIndex(1)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
						}

					}
				}	
			}


				foreach ($array_number as $key_num => $number) {

					if($key_num != 3){

						$celda_a = $array_letter[0].$number;
						$celda_b = $array_letter[3].$number;

						$this->objPHPExcel->setActiveSheetIndex(1)
						 ->setCellValue( 
						 	$array_letter[4].$number, "=SUM($celda_a:$celda_b)" 
						 );

				 	}else{

				 		$celda_a = $array_letter[4].$array_number[0];
						$celda_b = $array_letter[4].$array_number[2];

				 		$this->objPHPExcel->setActiveSheetIndex(1)
						 ->setCellValue( 
						 	$array_letter[4].$number, "=SUM($celda_a:$celda_b)" 
						 );

				 	}

				}

		 		reporte_perfil::create_sheet( 'Pertinencia y disponibilidad' );
					reporte_perfil::sheet_pertinencia();

		}



		public function sheet_pertinencia(){

			//get array data
			reporte_perfil::header_sheet( 2 );
			reporte_perfil::preguntas();

		}


		public function preguntas(){

					$data = $this->pertenencia->main();

					if( !$data ){
						$data_final = $this->pertenencia->return_data();
					}

					//Columnas y filas principales
					$this->objPHPExcel->setActiveSheetIndex(2)
					->setCellValue('B4', "PERTINENCIA Y DISPONIBILIDAD DE MEDIOS Y RECURSOS PARA EL APRENDIZAJE")
					->setCellValue('B6', "ASPECTOS")
		            ->setCellValue('B7', "1. ¿COMO CONSIDERA LA CALIDAD DE LOS DOCENTES DEL ITLAC?")
		            ->setCellValue('B8', "2. ¿COMO CONSIDERA EL PLAN DE ESTUDIOS DEL ITLAC?")
		            ->setCellValue('B9', "3. ¿COMO SON LAS OPORTUNIDADES DE PARTICIPAR EN PROYECTOS DE INVESTIGACIÓN Y DESARROLLO?")
		            ->setCellValue('B10', "4. ¿ÉNFASIS QUE SE LE PRESTABA A LA INVESTIGACIÓN DENTRO DEL PROCESO DE ENSEÑANZA?")
		            ->setCellValue('B11', "5. ¿CUÁL FUE SU SATISFACCIÓN CON LAS CONDICIONES DE ESTUDIO (INFRAESTRUCTURA)?")
		            ->setCellValue('B12', "6. ¿COMO FUE SU EXPERIENCIA OBTENIDA A TRAVÉS DE LA RESIDENCIA PROFESIONAL?")
		            // ->setCellValue('B13', "7. ¿COMO ES SU EFICIENCIA PARA REALIZAR LAS ACTIVIDADES LABORALES EN RELACIÓN CON SU FORMACIÓN ACADÉMICA?")
		            // ->setCellValue('B14', "8. ¿COMO CALIFICA SU FORMACIÓN ACADÉMICA CON RESPECTO A SU DESEMPEÑO LABORAL?")
		            // ->setCellValue('B15', "9. ¿ QUE UTILIDAD TIENEN LAS RESIDENCIAS PROFESIONALES O PRÁCTICAS PROFESIONALES PARA SU DESARROLLO LABORAL Y PROFESIONAL?")
		            ->setCellValue('B13', "TOTAL")

					->setCellValue('C5', $_SESSION["periodo"].' '.$_SESSION["ano"])
					->setCellValue('C6', "MUY BUENA")
					->setCellValue('D6', "BUENA")
					->setCellValue('E6', "REGULAR")
					->setCellValue('F6', "MALA")
					->setCellValue('G6', "TOTAL");

	        //Unir celdas
            $this->objPHPExcel->getActiveSheet(2)
            	->mergeCells('C5:G5')
            	; 

	        //resultados
	     	$array_number = array(7, 
	     						  8, 
	     						  9,
	     						  10,
	     						  11,
	     						  12,
	     						  // 13,
	     						  // 14,
	     						  // 15,
	     						  13
	     						 );

			$array_letter = array("C", "D", "E", "F", "G");
			$array_dat = array("data_final");

	     	//asignacion de resultados
			foreach ($array_number as $key_num => $number) {
				foreach ($array_letter as $key_lett => $letter) {


					if( $key_lett != 4){

						if($key_num != 6){
							$this->objPHPExcel->setActiveSheetIndex(2)
			     				->setCellValue($letter.$number,
			     					$data_final["data_final"][$key_num][2][$key_lett]
			     				);
						}else{

							$celda_a = $letter.$array_number[0];
							$celda_b = $letter.$array_number[5];

							$this->objPHPExcel->setActiveSheetIndex(2)
							 ->setCellValue( 
							 	$letter.$number, "=SUM($celda_a:$celda_b)" 
							 );
						}

					}
				}	
			}

				foreach ($array_number as $key_num => $number) {

					if($key_num != 6){

						$celda_a = $array_letter[0].$number;
						$celda_b = $array_letter[3].$number;

						$this->objPHPExcel->setActiveSheetIndex(2)
						 ->setCellValue( 
						 	$array_letter[4].$number, "=SUM($celda_a:$celda_b)" 
						 );

				 	}else{

				 		$celda_a = $array_letter[4].$array_number[0];
						$celda_b = $array_letter[4].$array_number[5];

				 		$this->objPHPExcel->setActiveSheetIndex(2)
						 ->setCellValue( 
						 	$array_letter[4].$number, "=SUM($celda_a:$celda_b)" 
						 );

				 	}

				}


            reporte_perfil::generar_excel();


		}


	public function generar_excel(){

		$this->objPHPExcel->setActiveSheetIndex(0);

		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="reporte_perfil_egresado.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');

		$objWriter->save('php://output');
		exit;

	}

}

$reporte_perfil = new reporte_perfil();
$reporte_perfil->propiedades_excel();


