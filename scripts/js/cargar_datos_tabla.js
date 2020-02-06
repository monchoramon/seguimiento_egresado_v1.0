
	$(document).ready(function(){

		var data_table = cargar_tabla();

		 	$("#tabla_egresados").on("click", "#btn_consultar", function(){
			 	var catn = $(this);
	 				get_data( catn, data_table, 1 );
			});


				$("#tabla_egresados").on("click", "#btn_eliminar", function(){

					mostrar_modal("#verificacion", "show");

					var catn = $(this);
						var data = get_id_elemento( catn, data_table ); 
							$("input[type=hidden]")[1].value = data["id_cuestionario"];
							$("input[type=hidden]")[2].value = data["numero_control"];
				});

					$("#btn_eliminar_conf").click(function(){

						var form = {
							"tipo":1,
							"id_cuestionario":$("input[type=hidden]")[1].value,
							"numero_control":$("input[type=hidden]")[2].value
						};

						mandar_datos( form, "../", "eliminar_encuesta", "eliminar_encuesta.php", 10);
					
					});


			function get_data( catn, data_table ){
				
	 			var data = get_id_elemento( catn, data_table ); 

 					  	var numero_control = data["numero_control"];
							var id_encuesta = data["id_cuestionario"];
 								var data_final = {
					 								"numero_control":numero_control,
					 								"id_encuesta":id_encuesta
			 								 	 };

			 	window.open("../consulta/index.php?numero_control="+numero_control+"&id_encuesta="+id_encuesta, '_blank');

			}


			function get_id_elemento( catn, data_table ){
				var data = data_table.row( $(catn).parents("tr") ).data();
					return data;
			}

		consultar_data_docente();

	})

	function cargar_tabla(){

		$.fn.dataTable.ext.errMode = 'none';

		var data_table = $('#tabla_egresados').DataTable({

			"responsive": true,
				"lengthMenu": [3],
				"language": {
			         "info": "Mostrando de _START_ a _END_ encuestas de un total de _TOTAL_",
			         "search":"Buscar",
			         "infoEmpty": "Mostrando 0 a 0 de 0 encuestas",
			         "emptyTable": "No se ha registrado ninguna encuesta",
			         "lengthMenu": "Mostrar _MENU_ datos",
			         "zeroRecords": "No se encontró ninguna encuesta con este número de control",
			         "sInfoFiltered": "",
			         "sLoadingRecords": "No se ha encontrado ninguna encuesta para mostrar",
			         "destroy": "true",
			         // (de un total de _MAX_ materias)
				     "processing": true,
				     "serverSide": true,
			         "paginate": {
				        "first":      "Primero",
				        "last":       "Después",
				        "next":       "Siguiente",
				        "previous":   "Anterior"
				   	}
			    }, 

			    "ajax": {
						 url: "../scripts/http/cargar_datos_tabla/encuestas.php",
					  	},

					  	 "columns": [
					  	    { "data": "id_cuestionario" },
					  		{ "data": "numero_control" },
				           	// { "data": "nombre_alumno" },
				            // { "data": "fecha_graduacion" },
			         		{ "defaultContent": "<button id='btn_eliminar'type='button' class='btn btn-danger'>Eliminar</button>"},
				            { "defaultContent": "<button id='btn_consultar' type='button' class='btn btn-success'>Consultar</button>"},
				        ],



		});	


			return data_table;

	}

	function consultar_data_docente(){
		mandar_datos( {"tipo":1}, "../", "docentes_registro", "docentes_registro.php", 11);
	}


	$("#registro_docente").click(function(){
		$("#registro_usuario input[name=tipe]").val(2);
		$("#usuario_profesor").removeAttr("disabled");
		mostrar_modal("#registro_usuario", "show");
	})

		$("#btn_registrar").click(function(){
			var form = $("#data_prof").serialize();
		 		mandar_datos( form, "../", "registro_cuestionario", "registrar.php", 4);
		})

			$("#verificacion").click(function(){
				info_eliminar({display:"none"}, "", 2);
			})

				$("#verificacion .close").click(function(){
					info_eliminar({display:"none"}, "", 2);
					mostrar_modal("#verificacion", "hide");
				})


	
