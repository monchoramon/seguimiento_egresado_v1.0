	
	function mandar_datos( form, ubicacion, directorio, script, tipe ){

			var method = data_send( tipe );

			$.ajax({

				url: ubicacion+'/scripts/http/'+directorio+'/'+script,
				data: form,
				method: method,

				success:function( data ){

					var request = JSON.parse( data );

				if( tipe == 1 ){

					// notificacion( request.title );

					switch( request.tipe ){

						case true:
							window.location = "../panel_admin/panel_admin.php";
						break;

						case false:
							alert(request.title);
						break;

					}


				}else{

					switch( tipe ){

						//registrar información
						case 2:
							console.log( request );
							$("#nota_modal")[0].innerHTML=request.txt;
							mostrar_modal("#notificacion", "show");
						break;

						//consultar información
						case 3:

							switch( request.tipo ){

								case 1:
									alert(request.txt);
									cerrar_ventana();
								break;

								case 2:
									alert(request.txt);
									cerrar_ventana();
								break;

								default:
									pintar_info_encuesta( request );
								break;

							}

						break;

						case 4:

							alert(request.info);

							if( request.tipo ){
								limpiar_campos();
								mostrar_modal("#registro_usuario", "hide");
							}

						break;

						case 5:

							var select = $("#ano_egreso");

								for(var x = 0; x < request[0].length; x++){
									var opt = $("<option>", {value:request[0][x]}).text(request[0][x]);
									select.append( opt );
								}

									return request;

						break;

						case 6:

							if(request["tipe"]){
								var 
								periodo = $("select")[1].value,
								ano = $("select")[2].value;
								open_windows( "../reportes/reporte_encuesta.php?periodo="+periodo+"&ano="+ano, '_blank' );
							}else{
								alert("No se encontraron encuestas contestadas para este perido y año");
							}

						break;

						case 7:
							if(request.tipo){
								open_windows( "../../seguimiento_egresados/acceso", '_self' );
							}
						break;	

						case 8:
							if(!request.tipo){
								open_windows( "../../seguimiento_egresados/acceso", '_self' );
							}	
						break;	

						case 9:
							if(request.tipo){
								open_windows( "../panel_admin/panel_admin.php", '_self' );
							}	
						break;

						case 10:

							switch( request.tipo ){
								
								case 1:
									info_eliminar({display:"block"}, request.txt, 1);
									var data_table = cargar_tabla();
									data_table.ajax.reload();
								break;

								case 2:
									alert(request.txt);
								break;

								case 3:
									alert(request.txt);
								break;

								default:
									alert(request.txt);
								break;

							}

						break;

						case 11:

							var notificacion = $("#docentes .alert-danger");
							$("#docentes select option").remove();

							switch(request.tipo){

								case false:
									notificacion.css({display:"block"});
									notificacion[0].innerText = request.txt;
								break;

								case true:

									notificacion.css({display:"none"});
									notificacion[0].innerText = "";

									var select = $("#docentes select");
									
									for(var x = 0; x < request.data.length; x++){

										var index_element = request.data[x];

										var opt = $("<option>", {
														         value: index_element.usuario_profesor
													            }).text(
													            	index_element.nombre_completo
													            );
								        select.append( opt );
									}
								break;
							}

						break;

						case 12:

							if( request.tipo ){

								$("#usuario_profesor").val(request.data.usuario_profesor).attr({disabled:"disabled"});
								$("#nombre_completo").val(request.data.nombre_completo);
								$("#password").val(request.data.contrasena);

								var index_checkbox = $("#registro_usuario input[type=checkbox]");

								if( request.data.root == 1 && request.data.tipo == 1 ){

									console.log(
											request.data.root,
											request.data.tipo
										);
									
									index_checkbox[0].checked = true;
									index_checkbox[1].checked = true;

								}else{
									if( request.data.root == 1 ){

										console.log(
											request.data.root
										);

										index_checkbox[1].checked = true;

									}else{
										if( request.data.tipo == 1 ){

											console.log(
												request.data.tipo
											);

											index_checkbox[0].checked = true;

										}
									}
								}

								mostrar_modal("#info_docente", "hide")
								mostrar_modal("#registro_usuario", "show");

							}

						break;

					}

				} //success

			}

		})

	}


		function pintar_info_encuesta( request ){

			//mover todo el else al script consulta.js
				// $("#sugerencia").css({background:"red"});

			var id = null, tipo_input = null, info = null;

			for (var i = 0; i < request.length; i++) {

				id = request[i].id_tag;

				if( id != "" ){

					tipo_input = $("#"+request[i].id_tag)[0].type;
					info  = request[i].respuesta;

					switch( tipo_input ){

						case 'text':
							checked_input("text", id, info);
						break;

						case 'date':
							checked_input("date", id, info);
						break;

						case 'email':
							checked_input("email", id, info);
						break;

						case 'radio':
							checked_input("radio", id, info);
						break;

						case 'checkbox':
							checked_input("checkbox", id, info);
						break;

						case 'textarea':
							checked_input("textarea", id, info);
						break;

					}

					// console.log( tipo_input, id, info );

				}

			}

		}


		function checked_input(tipe, id, info){

			if( tipe == "checkbox" || tipe == "radio" ){
				$("#"+id)[0].checked = true;
			}else{
				if( tipe == "text" || tipe == "email" || tipe == "date" || tipe == "textarea"){
					$("#"+id).val(info);
				}
			}

		}


			function data_send( tipe ){

				var method = null;

				switch( tipe ){

					case 1:
						method = "POST";
					break;

					case 2:
						method = "POST";
					break;

					case 3:
						method = "GET";
					break;

					case 4:
						method = "POST";
					break;

					case 6:
						method = "POST";
					break;

					case 7:
						method = "POST";
					break;

					case 8:
						method = "POST";
					break;

					case 9:
						method = "POST";	
					break;

					case 10:
						method = "POST";	
					break;

					case 11:
						method = "POST";	
					break;

					case 12:
						method = "POST";	
					break;

				}


				return method;

			}


	function open_windows(url, tipo){
		window.open(url, tipo);
	}

		function info_eliminar(display_tipe, info, tipo){

			var div_info = $("#info"), 
			    btn_eliminar_conf = $("#btn_eliminar_conf");

			switch(tipo){

				case 1:
					btn_eliminar_conf.attr({disabled:"disabled"});
				break;

				case 2:
					btn_eliminar_conf.removeAttr("disabled");
				break;
			}

			div_info.css(display_tipe);
			div_info[0].innerText = info;

		}

			function limpiar_campos(){

				var long_input = $("#data_prof input").length;
				
				for(var x = 0; x < (long_input-1); x++){

					input = $("#data_prof input")[x];

					if( input.type != "checkbox"){
						input.value = "";
					}else{
						input.checked = false;
					}

				}

			}

				function cerrar_ventana(){
					window.close();
				}