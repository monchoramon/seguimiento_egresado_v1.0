$(document).ready(function(){
	const urlParams = new URLSearchParams(window.location.search);
	const numero_control = urlParams.get('numero_control');
	const id_encuesta = urlParams.get('id_encuesta');
	mandar_datos( null, "../", "consultar_cuestionario", "consultar.php?numero_control="+numero_control+"&id_encuesta="+id_encuesta, 3);
	//var data = mandar_datos( 1, "../", "datos_get", "datos_get.php", 4);
})