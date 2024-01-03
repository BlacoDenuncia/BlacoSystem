$(document).ready(function () {
	var btnLocal;

	function preencherEnderecoComGeolocalizacao() {
		btnLocal = true;
		if (navigator.geolocation) {

			navigator.geolocation.getCurrentPosition(function (position) {
				const latlng = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				// Inicializa o serviço de geocodificação
				const geocoder = new google.maps.Geocoder();

				geocoder.geocode({
					'location': latlng
				}, function (results, status) {
					if (status === 'OK') {

						if (results[0]) {

							// Extrai os componentes do endereço
							const addressComponents = results[1].address_components;
							let rua = "";
							let bairro = "";
							let cidade = "";
							let estado = "";

							// Itera pelos componentes para preencher os campos
							$.each(addressComponents, function (index, component) {
								const types = component.types;

								if (types.includes('route')) {
									rua = component.long_name;
								} else if (types.includes('sublocality_level_1')) {
									bairro = component.long_name;
								} else if (types.includes('locality') || types.includes("administrative_area_level_2")) {
									cidade = component.long_name;
								} else if (types.includes('administrative_area_level_1')) {
									estado = component.short_name;
								}
							});

							// Preenche os campos do formulário com os valores obtidos
							$('#rua').val(rua);
							$('#bairro').val(bairro);
							$('#cidade').val(cidade);
							$('#estado').val(estado);

							$("#send").click();
						} else {
							console.error('Nenhum resultado encontrado para a geolocalização.');
						}
					} else {
						console.error('Geocodificação falhou devido a: ' + status);
					}
				});
			}, function (error) {
				console.error("Erro ao obter a localização do usuário:", error);
			});
		} else {
			console.error("Geolocalização não suportada pelo navegador.");
		}
	}

	// Adiciona um ouvinte de evento ao botão para receber a localização
	$('#btnRecebeLocalizacao').on('click', preencherEnderecoComGeolocalizacao);

	// Verifica se o usuário permitiu usar os dados
	var permiteDados = $("#aceitaDadosCheck");
	var permiteDadosValor = false;
	permiteDados.on("change", function () {
		permiteDadosValor = this.checked;
	});

	//mascaras para o form
	$("#contato_vitima").mask("(00) 00000-0000");

	$('#btnDismissFill').on('click', function () {
		$('#fillModal').modal('hide');
	});

	if (isLoggedIn) {
		$('#fillModal').modal('show');
	}

	$('#btnFillForm').on('click', function () {
		if (userData) {
			$('#id_usuario').val(userData.idusuario);
			$('#nome_vitima').val(userData.nome);
			var idade = calculateAge(userData.data_nascimento);
			$('#idade_vitima').val(idade);
			$('#contato_vitima').val(userData.telefone);
			$('#email_vitima').val(userData.email);
		}
		$('#fillModal').modal('hide');
	});

	function calculateAge(dateOfBirth) {
		var today = new Date();
		var birthDate = new Date(dateOfBirth);
		var age = today.getFullYear() - birthDate.getFullYear();
		var month = today.getMonth() - birthDate.getMonth();
		if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
			age--;
		}
		return age;
	}

	function verificarCamposVazios() {

		if (tipoDenuncia == "anonima") {
			var camposObrigatorios = [
				"#tipo_violencia",
				"#descricao_agressor",
				"#descricao_caso",
				"#rua",
				/*"#numero_do_local",*/
				"#bairro",
				"#cidade",
				"#estado",
			];
			camposObrigatorios.forEach(function (campo) {
				var valorCampo = $(campo).val().trim();
				$(campo).toggleClass("input-error", valorCampo === "");
			});
		} else {
			var camposObrigatorios = [
				"#nome_vitima",
				"#idade_vitima",
				"#contato_vitima",
				"#email_vitima",
				"#tipo_violencia",
				"#descricao_agressor",
				"#descricao_caso",
				"#rua",
				/*"#numero_do_local",*/
				"#bairro",
				"#cidade",
				"#estado",
			];
			camposObrigatorios.forEach(function (campo) {
				var valorCampo = $(campo).val().trim();
				$(campo).toggleClass("input-error", valorCampo === "");
			});
		}
	}
	function enviarEmail(data, retryCount = 3, retryDelay = 5000) {
		$.ajax({
			url: "Boletim_controller/enviar_email",
			type: "POST",
			data: data,
			success: function (response) {
				var json = $.parseJSON(response);
				if (json.tipo === "error" && retryCount > 0) {
					$("#msg_erro").html(
						"Ocorreu um erro do servidor ao enviar a denúncia para o seu email. Tentaremos de novo mais " + retryCount + " vezes "
					);
					$("#erro").show("slow");
					setTimeout(function () {
						enviarEmail(data, retryCount - 1, retryDelay);
					}, retryDelay);
				} else {
					if (retryCount == 0) {
						// show modal if the user typed a wrong email
						$("#emailDigitado").text(data.email_vitima);
						$("#modalEmailInvalido").modal("show");

						$("#btnEnviarEmail").click(function () {
							data.email_vitima = $("#email_atual_vitima").val();
							enviarEmail(data);
						});
					} else {
						$("#msg_sucesso").html(
							"Uma cópia da denuncia será enviada para seu email! Cheque seu email para mais informações"
						);
						$("#sucesso").show("slow");
					}

				}

				$("html, body").animate({ scrollTop: 0 }, "slow");
				window.setTimeout(function () {
					$("#sucesso, #erro").hide(1000);
					$("#btn-close, #btn-limpar").click();
				}, 5000);
			},
			error: function (xhr, status, error) {
				console.log(error); // Optional: Log the error, if any
			},
		});
	}
	function validarEmail(requestData) {
		if (tipoDenuncia !== "anonima") {
			$.ajax({
				url: "Boletim_controller/validar_email",
				type: "POST",
				data: { email_vitima: requestData.email_vitima },
				success: function (response) {
					var json = $.parseJSON(response);
					if (json.tipo === "email-invalido") {
						$("#emailDigitado").text(requestData.email_vitima);
						$("#modalEmailInvalido").modal("show");

						$("#btnEnviarEmail").click(function () {
							requestData.email_vitima = $("#email_atual_vitima").val();
							validarEmail(requestData); // Continue validating the updated email
						});
					} else {
						enviarDenuncia(requestData);
					}
				},
				error: function (xhr, status, error) {
					console.log(error); // Optional: Log the error, if any
				},
			});
		} else {
			enviarDenuncia(requestData);
		}

	}
	function registrarDenuncia() {
		var dataHoraAtual = new Date();
		var options = { timeZone: "America/Sao_Paulo" };
		var dataHoraBrasil = dataHoraAtual.toLocaleString("pt-BR", options);
		var dataHoraFormatada = moment(dataHoraBrasil, "DD/MM/YYYY HH:mm:ss").format(
			"YYYY-MM-DD HH:mm:ss"
		);

		// Armazena a hora em um campo oculto no formulário
		$("#data_hora_envio").val(dataHoraFormatada);

		verificarCamposVazios();
		var camposVazios = $(".input-error");
		if (camposVazios.length > 0) {
			$("#msg_erro").html(
				"Por favor, preencha todos os campos em vermelho, pois são essenciais para te ajudar! Caso o botão de localização não tenha funcionado, digite manualmente."
			);
			$("#erro").show("slow");
			$("html, body").animate({ scrollTop: 0 }, "slow");
			window.setTimeout(function () {
				$("#erro").hide(1000);
			}, 3000);
			return;
		}
		var id_usuario = $("#id_usuario").val();
		var id_denuncia = $("#id_denuncia").val();
		var data_hora_envio = $("#data_hora_envio").val();
		if (tipoDenuncia === "anonima") {
			var nome_vitima = "Anonimo";
		} else { var nome_vitima = $("#nome_vitima").val(); }
		var idade_vitima = $("#idade_vitima").val();
		var contato_vitima = $("#contato_vitima").val();
		if (tipoDenuncia === "anonima") {
			var email_vitima = "Anonimo";
		} else { var email_vitima = $("#email_vitima").val(); }
		var genero_vitima = $("#genero_vitima").val();
		var etnia_vitima = $("#etnia_vitima").val();
		var tipo_violencia = $("#tipo_violencia").val();
		var descricao_agressor = $("#descricao_agressor").val();
		var descricao_caso = $("#descricao_caso").val();
		var rua = $("#rua").val();
		var numero_do_local = $("#numero_do_local").val();
		var bairro = $("#bairro").val();
		var cidade = $("#cidade").val();
		var estado = $("#estado").val();
		var tipo_estabelecimento = $("#tipo_estabelecimento").val();
		var permiteDadosValor = $("#aceitaDadosCheck").prop("checked");

		var requestData = {
			id_usuario: id_usuario,
			id_denuncia: id_denuncia,
			data_hora_envio: data_hora_envio,
			nome_vitima: nome_vitima,
			idade_vitima: idade_vitima,
			contato_vitima: contato_vitima,
			email_vitima: email_vitima,
			genero_vitima: genero_vitima,
			etnia_vitima: etnia_vitima,
			tipo_violencia: tipo_violencia,
			descricao_agressor: descricao_agressor,
			descricao_caso: descricao_caso,
			rua: rua,
			bairro: bairro,
			cidade: cidade,
			estado: estado,
			tipo_estabelecimento: tipo_estabelecimento,
			permite_dados: permiteDadosValor,
		};
		validarEmail(requestData);
	}

	function enviarDenuncia(data) {
		$.ajax({
			url: "Boletim_controller/registrar_denuncia",
			type: "POST",
			data: data,
			beforeSend: function () {
				$("#loading").show();
			},
			complete: function () {
				$("#loading").hide();
			},
			success: function (response) {
				var json = $.parseJSON(response);
				var mensagem = json.mensagem;
				var tipo = json.tipo;


				if (tipo === "error") {
					$("#msg_erro").html(
						"Ocorreu um erro do servidor ao registrar sua denúncia"
					);
					$("#erro").show("slow");
				} else {
					$("#msg_sucesso").html(
						"Denuncia registrada com sucesso. Uma cópia da denuncia será enviada para seu email!"
					);
					$("#sucesso").show("slow");
					window.setTimeout(function () {
						$("btn-limpar").click();
					}, 3000);
					if (tipoDenuncia !== "anonima") {
						enviarEmail(data);
					}
				}

				$("html, body").animate({ scrollTop: 0 }, "slow");
				window.setTimeout(function () {
					$("#sucesso, #erro").hide(1000);
					$("#btn-close").click();
				}, 3000);
			},
			error: function (xhr, status, error) {
				console.log(error); // Optional: Log the error, if any
			},
		});
	}
	//faz registro das denuncias de forma assincrona
	$("#btnEnviarDenuncia").click(function () {
		$("#btnEnviarDenuncia").prop("disabled", true);
		verificarCamposVazios();
		registrarDenuncia();
		window.setTimeout(function () {
			$("#btnEnviarDenuncia").prop("disabled", false);
		}, 6000);
	});

	var chatContainer = $('#report-chat');
	var userInput = $('#userInput');
	var submitAnswersButton = $('#submitAnswers');
	var messageNumber = 1;
	var tipoDenuncia;


	// permitir pressionar a tecla Enter para enviar a mensagem
	userInput.keypress(function (event) {
		if (event.which === 13) {
			sendButton.click();
		}
	});

	$('.body').on('click', '#btnEnviarDenuncia', function () {
		$("#btnEnviarDenuncia").prop("disabled", true);
		verificarCamposVazios();
		registrarDenuncia();
		window.setTimeout(function () {
			$("#btnEnviarDenuncia").prop("disabled", false);
		}, 6000);
	});

	$('#send').on('click', function () {
		if (tipoDenuncia === "anonima") {
			if (messageNumber === 2) {
				var userMessage = $("#genero_vitima").val();
			} else if (messageNumber === 3) {
				var userMessage = $("#etnia_vitima").val();
			} else if (messageNumber === 4) {
				var userMessage = $("#tipo_violencia").val();
			} else if (messageNumber === 5) {
				var userMessage = $("#descricao_agressor").val();
			} else if (messageNumber === 6) {
				var userMessage = $("#descricao_caso").val();
			} else if (messageNumber === 7) {
				if (btnLocal == true) {
					var userMessage = "Use minha localização atual";
				} else {
					var userMessage = "Vou preencher manualmente";
				}
			} else if (messageNumber === 8) {
				var userMessage = $("#rua").val();
			} /*else if (messageNumber === 9) {
				var userMessage = $("#numero_do_local").val();
			}*/ else if (messageNumber === 9) {
				var userMessage = $("#bairro").val();
			} else if (messageNumber === 10) {
				var userMessage = $("#cidade").val();
			} else if (messageNumber === 11) {
				var userMessage = $("#estado").val();
			} else if (messageNumber === 12) {
				var userMessage = $("#tipo_estabelecimento").val();
			} else {
				var userMessage = "Entendi";
			}
			if (userMessage === 14) {
				$("#send").prop('disabled', true);
			}
			if (userMessage.trim() !== '') {
				sendMessageToChatbot(userMessage, tipoDenuncia);
			}
			else{
				$("#emptyPopup").toggleClass("show");
			}
		} else {
			if (messageNumber === 2) {
				var userMessage = $("#nome_vitima").val();
			} else if (messageNumber === 3) {
				var userMessage = $("#idade_vitima").val();
			} else if (messageNumber === 4) {
				var userMessage = $("#contato_vitima").val();
			} else if (messageNumber === 5) {
				var userMessage = $("#email_vitima").val();
			} else if (messageNumber === 6) {
				var userMessage = $("#genero_vitima").val();
			} else if (messageNumber === 7) {
				var userMessage = $("#etnia_vitima").val();
			} else if (messageNumber === 8) {
				var userMessage = $("#tipo_violencia").val();
			} else if (messageNumber === 9) {
				var userMessage = $("#descricao_agressor").val();
			} else if (messageNumber === 10) {
				var userMessage = $("#descricao_caso").val();
			} else if (messageNumber === 11) {
				if (btnLocal == true) {
					var userMessage = "Use minha localização atual";
				} else {
					var userMessage = "Vou preencher manualmente";
				}
			} else if (messageNumber === 12) {
				var userMessage = $("#rua").val();
			} /*else if (messageNumber === 13) {
				var userMessage = $("#numero_do_local").val();
			}*/ else if (messageNumber === 13) {
				var userMessage = $("#bairro").val();
			} else if (messageNumber === 14) {
				var userMessage = $("#cidade").val();
			} else if (messageNumber === 15) {
				var userMessage = $("#estado").val();
			} else if (messageNumber === 16) {
				var userMessage = $("#tipo_estabelecimento").val();
			} else {
				var userMessage = "Entendi";
			}
			if (userMessage === 18) {
				$("#send").prop('disabled', true);
			}
			if (userMessage.trim() !== '') {
				sendMessageToChatbot(userMessage, tipoDenuncia);
			}
			else{
				$("#emptyPopup").toggleClass("show");
			}
		}

	});

	function fetchAnonMessages(messageNumber, tipoDenuncia) {
		var numeroMensagemData = {
			messageNumber: messageNumber,
		};
		$.ajax({
			type: 'POST',
			url: 'Boletim_controller/buscar_mensagens_anonimas',
			data: numeroMensagemData,
			success: function (response) {
				var json = $.parseJSON(response);
				var mensagem = json.tipo;
				showBotReply(mensagem, tipoDenuncia);
			}
		});
	}

	function fetchComumMessages(messageNumber, tipoDenuncia) {
		var numeroMensagemData = {
			messageNumber: messageNumber,
		};
		$.ajax({
			type: 'POST',
			url: 'Boletim_controller/buscar_mensagens_comum',
			data: numeroMensagemData,
			success: function (response) {
				var json = $.parseJSON(response);
				var mensagem = json.tipo;
				showBotReply(mensagem, tipoDenuncia);
			}
		});
	}

	function showUserMessage(message) {
		if (userData != null)
		{
			var perfImgPath = base_url + userData.photo_path;
			if(perfImgPath == null)
			{
				perfImgPath = base_url + 'usersPhotos/default.jpg';
				
			}
		}
		else 
		{
			var perfImgPath = base_url + 'usersPhotos/default.jpg';
		}
		$('.body').append('<div class="userSection">' + '<div class="user-reply"> ' + '<div class="messages user-message">' + message + '</div>' + `<img class="user-perf-image" src="${perfImgPath}">`  + '</div>' + '<div class="seperator"></div>' + '</div>');
		$("html, body").animate({ scrollTop: $(document).height() }, 100);
	}

	function sendMessageToChatbot(userMessage, tipoDenuncia) {
		showUserMessage(userMessage);

		messageNumber++;
		// Limpar a caixa de entrada do usuário


		if (tipoDenuncia === "anonima") {
			if (messageNumber >= 8 && messageNumber <= 11) {
				fetchAnonMessages(messageNumber, tipoDenuncia);
			} else {
				userInput.val('');
				fetchAnonMessages(messageNumber, tipoDenuncia);
			}

		} else {
			if (messageNumber >= 12 && messageNumber <= 15) {
				fetchComumMessages(messageNumber, tipoDenuncia);
			} else {
				userInput.val('');
				fetchComumMessages(messageNumber, tipoDenuncia);
			}

		}

	}

	$('.body').on('click', '#btnDenunciaAnonima', function () {
		var userMessage = "Denúncia anônima";
		tipoDenuncia = "anonima";
		$('#btnDenunciaAnonima').addClass("disabled");
		$('#btnDenunciaAnonima').prop('disabled', true);
		$('#btnDenunciaComum').addClass("disabled");
		$('#btnDenunciaComum').prop('disabled', true);
		sendMessageToChatbot(userMessage, tipoDenuncia);
	});

	$('.body').on('click', '#btnDenunciaComum', function () {
		var userMessage = "Denúncia comum";
		tipoDenuncia = "comum";
		$('#btnDenunciaAnonima').addClass("disabled");
		$('#btnDenunciaAnonima').prop('disabled', true);
		$('#btnDenunciaComum').addClass("disabled");
		$('#btnDenunciaComum').prop('disabled', true);
		sendMessageToChatbot(userMessage, tipoDenuncia);
	});

	$('.body').on('click', '#btnRecebeLocalizacao', preencherEnderecoComGeolocalizacao);


	function exibirInput(tipoDenuncia) {
		// Oculta todos os inputs com uma animação de fadeOut
		$('.answerInput').prop('hidden', true)

		if (tipoDenuncia === "anonima") {
			if (messageNumber === 2) {
				$('#genero_vitima').prop('hidden', false);
			} else if (messageNumber === 3) {
				$('#etnia_vitima').prop('hidden', false);
			} else if (messageNumber === 4) {
				$('#tipo_violencia').prop('hidden', false);
			} else if (messageNumber === 5) {
				$('#descricao_agressor').prop('hidden', false);
			} else if (messageNumber === 6) {
				$('#descricao_caso').prop('hidden', false);
			} else if (messageNumber === 7) {
				$('#send').text('Não usar');
				$('#btnRecebeLocalizacao').prop('hidden', false);
			} else if (messageNumber === 8) {
				$('#send').text('Enviar');
				$('#rua').prop('hidden', false);
			} else if (messageNumber === 9) {
				$('#bairro').prop('hidden', false);
			} else if (messageNumber === 10) {
				$('#cidade').prop('hidden', false);
			} else if (messageNumber === 11) {
				$('#estado').prop('hidden', false);
			} else if (messageNumber === 12) {
				$('#tipo_estabelecimento').prop('hidden', false);
			} else {
				$('.answerInput').prop('hidden', true);
			}
		} else {
			if (messageNumber === 2) {
				$('#nome_vitima').prop('hidden', false);
			} else if (messageNumber === 3) {
				$('#idade_vitima').prop('hidden', false);
			} else if (messageNumber === 4) {
				$('#contato_vitima').prop('hidden', false);
			} else if (messageNumber === 5) {
				$('#email_vitima').prop('hidden', false);
			} else if (messageNumber === 6) {
				$('#genero_vitima').prop('hidden', false);
			} else if (messageNumber === 7) {
				$('#etnia_vitima').prop('hidden', false);
			} else if (messageNumber === 8) {
				$('#tipo_violencia').prop('hidden', false);
			} else if (messageNumber === 9) {
				$('#descricao_agressor').prop('hidden', false);
			} else if (messageNumber === 10) {
				$('#descricao_caso').prop('hidden', false);
			} else if (messageNumber === 11) {
				$('#send').text('Não usar');
				$('#btnRecebeLocalizacao').prop('hidden', false);
			} else if (messageNumber === 12) {
				$('#send').text('Enviar');
				$('#rua').prop('hidden', false);
			} else if (messageNumber === 13) {
				$('#bairro').prop('hidden', false);
			} else if (messageNumber === 14) {
				$('#cidade').prop('hidden', false);
			} else if (messageNumber === 15) {
				$('#estado').prop('hidden', false);
			} else if (messageNumber === 16) {
				$('#tipo_estabelecimento').prop('hidden', false);
			} else {
				$('.answerInput').prop('hidden', true);
			}
		}
		// Mostra o input apropriado com uma animação de fadeIn

	}

	function showBotReply(mensagem, tipoDenuncia) {
		$('.body').append('<div class="botSection">' + '<div class="bot-message">' + `<div class="bot-image"><img src="${base_url}/utils/img/logo-blaco-branca.svg"> </div>` + '<div class="messages bot-reply ">' + mensagem + '</div>' + '</div>' + '<div class="seperator"></div>' + '</div>');
		exibirInput(tipoDenuncia); 
		if (messageNumber !== 1) { $('#send').prop('disabled', false); }
		if (tipoDenuncia == 'comum' && messageNumber == 18) { $("#send").hide(); }
		else if (tipoDenuncia == 'anonima' && messageNumber == 14){ $("#send").hide(); }
	}

	function fetchFirstMessage(messageNumber) {
		var numeroMensagemData = {
			messageNumber: messageNumber,
		};
		$.ajax({
			type: 'POST',
			url: 'Boletim_controller/buscar_mensagem_inicial',
			data: numeroMensagemData,
			success: function (response) {
				var json = $.parseJSON(response);
				var mensagem = json.tipo;
				$('#send').prop('disabled', true);
				showBotReply(mensagem);
			}
		});
	}

	// Inicializar o chatbot
	fetchFirstMessage(messageNumber);

	$("#cancelReport").on('click', function (){
		$("#cancelModal").modal('show');
	});
	$("#cancelReportBtn").on('click', function (){
		window.location.reload(true);
	});

});