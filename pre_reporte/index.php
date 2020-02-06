
<?php include_once '../scripts/http/include.php'; ?>

<?php include_once '../scripts/http/include_script_js.php'; ?>

<script>
	$(document).ready(function(){
		const urlParams = new URLSearchParams(window.location.search);
		const periodo = urlParams.get('periodo');
		const ano = urlParams.get('ano');
		mandar_datos( null, "../", "reportes", "reporte_encuesta.php?periodo="+periodo+"&ano="+ano, null);

		window.open("../reportes/reporte_encuesta.php?periodo="+periodo+"&ano="+ano, '_target');

	})
</script>

