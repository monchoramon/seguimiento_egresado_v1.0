

	$("input[id=btn_acceder]").on("click", function( e ){
		var form = $("#datos").serialize();
			mandar_datos( form, "../", "login", "login.php", 1);

	})

		$("#cerrar_sesion").click(function(){

			var form = {
				"tipo":1
			};

			mandar_datos( form, "../", "login", "login.php", 7);

		})


				// function notificacion( info ){
				// 	$("#notificacion")[0].textContent = info;
				// }