<?php

/**
 * Ubicación laboral
 */

require_once 'perfil_egresado.php';


class ubicacion_laboral extends reporte_perfil{

	public $reporte_perfil;
	public $objPHPExcel;

	function __construct(){

		$this->reporte_perfil = new reporte_perfil();
		$this->objPHPExcel = null;

	}

	/************Ubicación Laboral************/

		public function sheet_ubicacion_laboral( $objPHPExcel ){

			$this->objPHPExcel = $objPHPExcel;
				$this->reporte_perfil->create_sheet( 'Ubicación laboral' );
					$this->reporte_perfil->header_sheet( 1 );
							ubicacion_laboral::table_trabajando_tipo();

		}

		public function table_trabajando_tipo(){

			//Columnas y filas principales
			$this->objPHPExcel->setActiveSheetIndex(1)
					->setCellValue('B3', "UBICACIÓN LABORAL")
					->setCellValue('B5', "¿ESTÁ TRABAJANDO?")
					->setCellValue('B6', "AGO-DIC 2016")
		            ->setCellValue('B7', "HOMBRES")
		            ->setCellValue('B8', "MUJERES")
		            ->setCellValue('B9', "TOTAL")
		            ->setCellValue('C6', "SI")
		            ->setCellValue('D6', "NO")
		            ;

		        $this->objPHPExcel->setActiveSheetIndex(1)

		            //columna 2	

		            ->setCellValue('C7', "34")
		            ->setCellValue('C8', "25")
		            ->setCellValue('C9', "59")

		            //columna 2	

		            ->setCellValue('D7', "5")
		            ->setCellValue('D8', "5")
		            ->setCellValue('D9', "10");


		        //Unir celdas
	            $this->objPHPExcel->getActiveSheet(1)
	            	->mergeCells('B5:D5'); 

        	ubicacion_laboral::tabla_trabaja_area();

		}


		public function tabla_trabaja_area(){

				//Columnas y filas principales
				$this->objPHPExcel->setActiveSheetIndex(1)
						->setCellValue('B12', "¿EN QUÉ TRABAJA?")
						->setCellValue('B13', "AGO-DIC 2016")
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
			        $ctn_hombres = array(5, 3, 2, 5, 9, 3, 4, 12, 3, 5, 5, 8, 4, 1); 
			        $ctn_mujeres = array(15, 4, 2, 3, 9, 3, 9, 12, 3, 5, 3, 9, 4, 10); 
			        $x = 0;

			        $data_full = array( $ctn_hombres, $ctn_mujeres );
			        $row_num = '15';

			        foreach ($data_full as $key_a => $data_main) {
			        	foreach ($data_main as $key_b => $data_final) {

			        		if( $key_a > 0){
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

	        		$celda_a = $this->objPHPExcel->getActiveSheet()
	        			 ->getCell($data_final.'15')
	        			 ->getValue();

	        		$celda_b = $this->objPHPExcel->getActiveSheet()
	        		     ->getCell($data_final.'16')
	        		     ->getValue();

    		    	$this->objPHPExcel->setActiveSheetIndex(1)
								 ->setCellValue($data_final.'17', ($celda_a+$celda_b) );

					// $this->objPHPExcel->getActiveSheet()
					// 	 ->getCell($data_final.'17')
					// 	 ->getCalculatedValue("=SUM($data_final.'16'+$data_final.'15')");

	        	}

	        	 //Unir celdas
		            $this->objPHPExcel->getActiveSheet(1)
		            	->mergeCells('C13:P13'); 
		        
        			ubicacion_laboral::table_puesto_trabajo();
		}


		public function table_puesto_trabajo(){


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
			     ->setCellValue('C21', "AGO-DIC 2016")
			     ->setCellValue('B22', "PUESTO")
			     ->setCellValue('B23', "HOMBRES")
			     ->setCellValue('B24', "MUJERES")
			     ->setCellValue('B25', "TOTAL")

			     //Unir celdas
            	 ->mergeCells('C21:G21')

			     ;

			     foreach ($columns_letter as $key => $value_lett) {
			     	$this->objPHPExcel->setActiveSheetIndex(1)
			     	     ->setCellValue($value_lett.'22', $data_columns[$key]);
			     }

			//asignacion de resultados
			foreach ($rows as $key_col => $value_col) {
				foreach ($columns_letter as $key_lett => $value_lett) {

					if($key_col != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($value_lett.$value_col, $key_lett);
					}

				}
			}

            	ubicacion_laboral::table_real_salary();

		}


		public function table_real_salary(){

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
			     ->setCellValue('C29', "AGO-DIC 2016")

			     //Unir celdas
			     ->mergeCells('C29:F29')

			     ;

			     foreach ($columns_letter as $key => $value_lett) {
			     	$this->objPHPExcel->setActiveSheetIndex(1)
			     	     ->setCellValue($value_lett.'30', $data_columns[$key]);
			     }

			//asignacion de resultados
			foreach ($rows as $key_col => $value_col) {
				foreach ($columns_letter as $key_lett => $value_lett) {

					if($key_col != 2){
						$this->objPHPExcel->setActiveSheetIndex(1)
		     				->setCellValue($value_lett.$value_col, $key_lett);
					}

				}
			}


    		ubicacion_laboral::table_contract();


		}


		public function table_contract(){

			$this->objPHPExcel->getActiveSheet(1)
			     ->setCellValue('B36', "¿CUÁL ES EL TIPO DE CONTRATO QUE TIENE CON LA EMPRESA?")
			     ->setCellValue('B38', "TIPO DE CONTRATO")
			     ->setCellValue('B39', "HOMBRES")
			     ->setCellValue('B40', "MUJERES")
			     ->setCellValue('B41', "TOTAL")
			     ->setCellValue('C37', "AGO-DIC 2016")
			     ->setCellValue('C38', "BASE")
			     ->setCellValue('D38', "EVENTUAL")

			     //Unir celdas
			     ->mergeCells('C37:D37')

			     ;


			ubicacion_laboral::tabla_idioma_empresa();

		}


		public function tabla_idioma_empresa(){

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B44', '¿CUÁL ES EL IDIOMA QUE UTILIZA EN LA EMPRESA?')
 			  	 ->setCellValue('B46', 'IDIOMA')
			     ->setCellValue('B47', 'HOMBRES')
			     ->setCellValue('B48', 'MUJERES')
			     ->setCellValue('B49', 'TOTAL')
			     ->setCellValue('C45', 'AGO-DIC 2016')
			     ->setCellValue('C46', 'INGLÉS')
			     ->setCellValue('D46', 'FRANCÉS')
			     ->setCellValue('E46', 'ALEMÁN')
 			     ->setCellValue('F46', 'OTRO')

 			     //Unir celdas
 			     ->mergeCells('C45:F45')
			     ;


			//resultados

			//----------------------------

			ubicacion_laboral::tabla_antiguedad_empresa();

		}


		public function tabla_antiguedad_empresa(){


			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B52', '¿CUÁL ES LA ANTIGÜEDAD QUE TIENE EN LA EMPRESA?')
 			  	 ->setCellValue('B54', 'ANTIGÜEDAD')
			     ->setCellValue('B55', 'HOMBRES')
			     ->setCellValue('B56', 'MUJERES')
			     ->setCellValue('B57', 'TOTAL')
			     ->setCellValue('C53', 'AGO-DIC 2016')
			     ->setCellValue('C54', 'MENOS DE UN AÑO')
			     ->setCellValue('D54', 'UN AÑO')
			     ->setCellValue('E54', 'DOS AÑOS')
 			     ->setCellValue('F54', 'TRES AÑOS')
 			     ->setCellValue('G54', 'MAS DE TRES AÑOS')

 			     //Unir celdas
 			     ->mergeCells('C53:H53')
			     ;

			ubicacion_laboral::tabla_timepo_transcurrido();

		}

		public function tabla_timepo_transcurrido(){


			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B60', '¿CUÁL FUE EL TIEMPO TRANSCURRIDO PARA OBTENER SU PRIMER EMPLEO?')
 			  	 ->setCellValue('B62', 'TIEMPO')
			     ->setCellValue('B63', 'HOMBRES')
			     ->setCellValue('B64', 'MUJERES')
			     ->setCellValue('B65', 'TOTAL')

			     ->setCellValue('C61', 'AGO-DIC 2016')
			     ->setCellValue('C62', 'ANTES DE EGRESAR')
			     ->setCellValue('D62', 'MENOS DE SEIS MESES')
			     ->setCellValue('E62', 'ENTRE SEIS MESES Y UN AÑO')
 			     ->setCellValue('F62', 'MAS DE UN AÑOS')

 			     //Unir celdas
 			     ->mergeCells('C61:F61')
			     ;

			ubicacion_laboral::table_medio_trabajo();

		}


		public function table_medio_trabajo(){

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B68', '¿CUÁL FUE EL MEDIO USADO PARA OBTENER TU PRIMER EMPLEO?')
 			  	 ->setCellValue('B70', 'MEDIO USADO')
			     ->setCellValue('B71', 'HOMBRES')
			     ->setCellValue('B72', 'MUJERES')
			     ->setCellValue('B73', 'TOTAL')

			     ->setCellValue('C69', 'AGO-DIC 2016')
			     ->setCellValue('C70', 'BOLSA DE TRABAJO DEL PLANTEL')
			     ->setCellValue('D70', 'CONTACTOS PERSONALES')
			     ->setCellValue('E70', 'RESIDENCIA PROFESIONAL')
 			     ->setCellValue('F70', 'OTRO')

 			     //Unir celdas
 			     ->mergeCells('C69:F69')
			     ;


			ubicacion_laboral::table_tamano_empresa();

		}


		public function table_tamano_empresa(){

			$this->objPHPExcel->setActiveSheetIndex(1)
			     ->setCellValue('B76', '¿DE QUE TAMAÑO ES LA EMPRESA DONDE LABORA?')
 			  	 ->setCellValue('B78', 'TAMAÑO')
			     ->setCellValue('B79', 'HOMBRES')
			     ->setCellValue('B80', 'MUJERES')
			     ->setCellValue('B81', 'TOTAL')

			     ->setCellValue('C77', 'AGO-DIC 2016')
			     ->setCellValue('C78', 'MICROEMPRESA (1-30 PERSONAS)')
			     ->setCellValue('D78', 'CPEQUEÑA (31-100 PERSONAS)')
			     ->setCellValue('E78', 'MEDIANA (101-500 PERSONAS)')
 			     ->setCellValue('F78', 'GRANDE (MÁS DE 500 PERSONAS)')

 			     //Unir celdas
 			     ->mergeCells('C77:F77')
			     ;


				$this->reporte_perfil->generar_excel();

		}

}

?>