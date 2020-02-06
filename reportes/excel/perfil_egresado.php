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

require_once 'ubicacion_laboral.php';
require_once '../../scripts/PHPExcel/Classes/PHPExcel.php';

/**
 * generar Excel
 */

class reporte_perfil {

	public $objPHPExcel;
	public $periodo;
	public $ano;

	function __construct(){

		// Create new PHPExcel object
		$this->objPHPExcel = new PHPExcel();

		//DATA GET
		$this->periodo = @$_GET["periodo"];
		$this->ano = @$_GET["ano"];


	}


	public function create_sheet( $title ){

		$sheet = $this->objPHPExcel->createSheet();
		$sheet->setTitle( $title );

	}


	public function propiedades_excel(){

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

		reporte_perfil::tabla_sexo();

	}


	public function header_sheet( $sheet_index ){
		$this->objPHPExcel->setActiveSheetIndex( $sheet_index )
			 ->setCellValue('B2', "INSTITUTO TECNOLÓGICO DE LÁZARO CÁRDENAS");
	}

	public function tabla_sexo(){

				/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas

				reporte_perfil::header_sheet( 0 );

				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B4', "I.PERFIL DEL EGRESADO")
					->setCellValue('B5', "AGO-DIC 2016") // A
		            ->setCellValue('B6', "SEXO") // B
		            ->setCellValue('D6', "NÚMERO DE ALUMNOS") // C
		            ->setCellValue('G6', "%"); // D


		        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1

					->setCellValue('B7', "MASCULINO")
		            ->setCellValue('B8', "FEMENINO")
		            ->setCellValue('B9', "TOTAL")

		            //columna 2	

		            ->setCellValue('D7', "61")
		            ->setCellValue('D8', "65")
		            ->setCellValue('D9', "126")

		            //columna 2	

		            ->setCellValue('G7', "48.6")
		            ->setCellValue('G8', "51.4")
		            ->setCellValue('G9', "100");


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

			/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B12', "TABLA DE EGRESADOS")
					->setCellValue('B13', "AGO-DIC 2016")
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

		            ->setCellValue('D15', "61")
		            ->setCellValue('D16', "65")
		            ->setCellValue('D17', "126")

		            //columna 2	

		            ->setCellValue('H15', "48.6")
		            ->setCellValue('H16', "51.4")
		            ->setCellValue('H17', "100");


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



			/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B20', "TABLA DE TITULADOS")
					->setCellValue('B21', "AGO-DIC 2016")
		            ->setCellValue('B22', "ALUMNOS TITULADOS")
		            ->setCellValue('D22', "SI")
		            ->setCellValue('F22', "NO")
		            ;


		        //Contenido
		        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1

					->setCellValue('B23', "HOMBRES")
		            ->setCellValue('B24', "MUJERES")
		            ->setCellValue('B25', "TOTAL")

		            //columna 2	

		            ->setCellValue('D23', "54")
		            ->setCellValue('D24', "49")
		            ->setCellValue('D25', "103")

		            //columna 2	

		            ->setCellValue('F23', "7")
		            ->setCellValue('F24', "16")
		            ->setCellValue('F25', "23");


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


				/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B28', "TABLA DE POSGRADO")
					->setCellValue('B29', "AGO-DIC 2016")
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

		            ->setCellValue('D31', "61")
		            ->setCellValue('D32', "65")
		            ->setCellValue('D33', "126")

		            //columna 3

		            ->setCellValue('H31', "48.6")
		            ->setCellValue('H32', "51.4")
		            ->setCellValue('H33', "100")

		             //columna 4 *

		            ->setCellValue('I31', "0")
		            ->setCellValue('K31', "0")
		            ->setCellValue('M31', "0")

		             //columna 5
		            ->setCellValue('I32', "0")
		            ->setCellValue('K32', "0")
		            ->setCellValue('M32', "0")

		             //columna 6

		            ->setCellValue('I33', "0")
		            ->setCellValue('K33', "0")
		            ->setCellValue('M33', "0");


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

    		reporte_perfil::residencia_actual();

		}


		public function residencia_actual(){


				/*******************Hoja 1********************/
				
				// Add some data // Encabezado columnas
				$this->objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('B36', "TABLA DE RESIDENCIA ACTUAL")
					->setCellValue('B37', "AGO-DIC 2016")
		            ->setCellValue('B38', "CIUDAD")
		            ->setCellValue('D38', "ESTADO")
		            ->setCellValue('F38', "M")
		            ->setCellValue('G38', "F")
		            ->setCellValue('H38', "TOTAL")
		            ;

		        //Contenido
		        $this->objPHPExcel->setActiveSheetIndex(0)

		        	//columna 1

					->setCellValue('B39', "LÁZARO CÁRDENAS")
		            ->setCellValue('B40', "LA HUACANA")
		            ->setCellValue('B33', "CHILPANCINGO")
		            ->setCellValue('B33', "PAPANO")

		            //columna 2	

		            ->setCellValue('D31', "61")
		            ->setCellValue('D32', "65")
		            ->setCellValue('D33', "126")

		            //columna 3

		            ->setCellValue('H31', "48.6")
		            ->setCellValue('H32', "51.4")
		            ->setCellValue('H33', "100")

		             //columna 4 *

		            ->setCellValue('I31', "0")
		            ->setCellValue('K31', "0")
		            ->setCellValue('M31', "0")

		             //columna 5
		            ->setCellValue('I32', "0")
		            ->setCellValue('K32', "0")
		            ->setCellValue('M32', "0")

		             //columna 6

		            ->setCellValue('I33', "0")
		            ->setCellValue('K33', "0")
		            ->setCellValue('M33', "0");


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

	        	// Rename worksheet // Nombre de la hoja de trabajo
				$this->objPHPExcel->getActiveSheet(0)->setTitle('Perfil del egresado');

				// Set active sheet index to the first sheet, so Excel opens this as the first sheet // Indice de la hoja donde se creara la tabla
				$this->objPHPExcel->setActiveSheetIndex(0);

				$ubicacion_laboral = new ubicacion_laboral();
				$ubicacion_laboral->sheet_ubicacion_laboral( $this->objPHPExcel );

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

