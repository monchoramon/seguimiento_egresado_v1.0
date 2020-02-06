$("#btn_consultar").click(function(){
	var form = $("#encuesta_egresados").serialize();
		mandar_datos( form, "../", "consultar_cuestionario", "consultar.php", 4);
})