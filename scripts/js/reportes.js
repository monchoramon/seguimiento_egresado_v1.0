
$("#generar_reportes").click(function(){
	mostrar_modal("#reporte", "show");
})

	$("#btn_generar_reporte").click(function(){
		var form = $("#data_reporte").serialize();
			mandar_datos( form, "../", "verificar_cuestionarios", "cuestionarios.php", 6);
	})

		$(document).ready(function(){
			mandar_datos( null, "../", "cargar_data_reporte", "data_reporte.php", 5);
				// mandar_datos( null, "../", "reportes", "reporte_encuesta.php", 5);
		})
