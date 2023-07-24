// Função para verificar a conexão com a internet antes do carregamento total da página
$(document).ready(function () {
	// Verifica se o usuário permitiu usar os dados
	var permiteDados = $("#aceitaDadosCheck");
	var permiteDadosValor = false;
	permiteDados.on("change", function () {
		permiteDadosValor = this.checked;
		console.log(permiteDadosValor);
	});

	//mascaras para o form
	$("#contato_vitima").mask("(00) 00000-0000");

	function verificarCamposVazios() {
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
			/*"#cidade",
			"#estado",*/
		];
		for (var i = 0; i < camposObrigatorios.length; i++) {
			var campo = camposObrigatorios[i];
			var valorCampo = $(campo).val();
			console.log(valorCampo);
			if (valorCampo.trim() === "") {
				$(campo).addClass("input-error"); // Adiciona a classe para a borda vermelha
			} else {
				$(campo).removeClass("input-error"); // Remove a classe, caso tenha sido preenchido
			}
		}
	}

	//faz registro das denuncias de forma assincrona
	$("#btnEnviarDenuncia").click(function () {
		//configurações de data e hora
		var dataHoraAtual = new Date(); // Obtém a data e hora atual
		var options = { timeZone: "America/Sao_Paulo" }; // Define o fuso horário do Brasil
		var dataHoraBrasil = dataHoraAtual.toLocaleString("pt-BR", options); // Formata a data e hora no formato local do Brasil

		var dataHoraFormatada = moment(
			dataHoraBrasil,
			"DD/MM/YYYY HH:mm:ss"
		).format("YYYY-MM-DD HH:mm:ss");

		console.log("Data e hora de envio no Brasil:", dataHoraFormatada);

		// Você também pode armazenar a hora em um campo oculto no formulário para enviá-la como parte dos dados do formulário, por exemplo:
		var campoDataHora = document.getElementById("data_hora_envio");
		campoDataHora.value = dataHoraFormatada;

		var id_denuncia = $("#id_denuncia").val();
		var data_hora_envio = $("#data_hora_envio").val();
		var nome_vitima = $("#nome_vitima").val();
		var idade_vitima = $("#idade_vitima").val();
		var contato_vitima = $("#contato_vitima").val();
		var email_vitima = $("#email_vitima").val();
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

		verificarCamposVazios(); // Chama a função para verificar campos vazios
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
		} else {
			$.ajax({
				url: "Boletim_controller/validar_email", // Path to your PHP script for sending email
				type: "POST",
				data: {
					email_vitima: email_vitima,
				},
				success: function (response) {
					var json = $.parseJSON(response);
					if (json.tipo === "email-invalido") {
						$("#emailDigitado").text(email_vitima);
						$("#modalEmailInvalido").modal("show");

						$("#btnEnviarEmail").click(function () {
							var email_atual_vitima = $("#email_atual_vitima").val();
							$.ajax({
								url: "Boletim_controller/registrar_denuncia", // Path to your PHP script for sending email
								type: "POST",
								data: {
									id_denuncia: id_denuncia,
									data_hora_envio: data_hora_envio,
									nome_vitima: nome_vitima,
									idade_vitima: idade_vitima,
									contato_vitima: contato_vitima,
									email_vitima: email_atual_vitima,
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
								},
								success: function (response) {
									var json = $.parseJSON(response);
									if (json.tipo === "email-invalido") {
										$("#emailDigitado").text(email_vitima);
										// Tratar o erro de e-mail inválido
										$("#msg_erro_modal").html(
											"O seu endereço de email não é válido!"
										);
										$("#erro-modal").show("slow");
										$("html, body").animate({ scrollTop: 0 }, "slow");
										window.setTimeout(function () {
											$("#erro-modal").hide(1000);
										}, 3000);
									} else if (json.tipo === "error") {
										// Tratar o erro de e-mail inválido
										$("#msg_erro_modal").html(
											"Ocorreu um erro do servidor ao enviar a denúncia para o seu email"
										);
										$("#erro-modal").show("slow");
										$("html, body").animate({ scrollTop: 0 }, "slow");
										window.setTimeout(function () {
											$("#erro-modal").hide(1000);
											$("#btn-close").click();
											$("#btn-limpar").click();
										}, 3000);
									} else {
										// O e-mail é válido, continuar com o restante do código de sucesso
										$("#msg_sucesso_modal").html(
											"Uma cópia da denuncia será enviada para seu email! Cheque seu email para mais informações"
										);
										$("#sucesso-modal").show("slow");
										$("html, body").animate({ scrollTop: 0 }, "slow");
										window.setTimeout(function () {
											$("#sucesso-modal").hide(1000);
											$("#btn-close").click();
											$("#btn-limpar").click();
										}, 3000);
									}
								},
								error: function (xhr, status, error) {
									console.log(error); // Optional: Log the error, if any
								},
							});
						});
					} else {
						// O e-mail é válido, continuar com o restante do código de sucesso
						$.ajax({
							url: "Boletim_controller/registrar_denuncia",
							type: "POST",
							data: {
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
							},
							beforeSend: function () {
								$("#loading").show();
							},
							complete: function () {
								$("#loading").hide();
							},
							success: function (data) {
								var json = $.parseJSON(data);
								if (json.tipo == "success") {
									$("#msg_sucesso").html(
										"Denuncia registrada com Sucesso! Em breve um orgão de segurança entrará em contato."
									);
									$("#sucesso").show("slow");
									$("html, body").animate({ scrollTop: 0 }, "slow");
									window.setTimeout(function () {
										$("#sucesso").hide(1000);
									}, 3000);
								} else {
									$("#msg_erro").html("Falha ao registrar a denuncia!");
									$("#erro").show("slow");
									$("html, body").animate({ scrollTop: 0 }, "slow");
									window.setTimeout(function () {
										$("#erro").hide(1000);
									}, 3000);
								}
								// manda dados pro email
								$.ajax({
									url: "Boletim_controller/enviar_email", // Path to your PHP script for sending email
									type: "POST",
									data: {
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
									},
									success: function (response) {
										var json = $.parseJSON(response);
										if (json.tipo === "email-invalido") {
											$("#emailDigitado").text(email_vitima);
											$("#modalEmailInvalido").modal("show");

											$("#btnEnviarEmail").click(function () {
												var email_atual_vitima = $("#email_atual_vitima").val();
												$.ajax({
													url: "Boletim_controller/enviar_email", // Path to your PHP script for sending email
													type: "POST",
													data: {
														data_hora_envio: data_hora_envio,
														nome_vitima: nome_vitima,
														idade_vitima: idade_vitima,
														contato_vitima: contato_vitima,
														email_vitima: email_atual_vitima,
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
													},
													success: function (response) {
														var json = $.parseJSON(response);
														if (json.tipo === "email-invalido") {
															$("#emailDigitado").text(email_vitima);
															// Tratar o erro de e-mail inválido
															$("#msg_erro_modal").html(
																"O seu endereço de email não é válido!"
															);
															$("#erro-modal").show("slow");
															$("html, body").animate({ scrollTop: 0 }, "slow");
															window.setTimeout(function () {
																$("#erro-modal").hide(1000);
															}, 3000);
														} else if (json.tipo === "error") {
															// Tratar o erro de e-mail inválido
															$("#msg_erro_modal").html(
																"Ocorreu um erro do servidor ao enviar a denúncia para o seu email"
															);
															$("#erro-modal").show("slow");
															$("html, body").animate({ scrollTop: 0 }, "slow");
															window.setTimeout(function () {
																$("#erro-modal").hide(1000);
																$("#btn-close").click();
																$("#btn-limpar").click();
															}, 3000);
														} else {
															// O e-mail é válido, continuar com o restante do código de sucesso
															$("#msg_sucesso_modal").html(
																"Uma cópia da denuncia será enviada para seu email! Cheque seu email para mais informações"
															);
															$("#sucesso-modal").show("slow");
															$("html, body").animate({ scrollTop: 0 }, "slow");
															window.setTimeout(function () {
																$("#sucesso-modal").hide(1000);
																$("#btn-close").click();
																$("#btn-limpar").click();
															}, 3000);
														}
													},
													error: function (xhr, status, error) {
														console.log(error); // Optional: Log the error, if any
													},
												});
											});
										} else if (json.tipo === "error") {
											// Tratar o erro de e-mail inválido
											$("#msg_erro").html(
												"Ocorreu um erro ao enviar a denúncia para o seu email"
											);
											$("#erro").show("slow");
											$("html, body").animate({ scrollTop: 0 }, "slow");
											window.setTimeout(function () {
												$("#erro").hide(1000);
											}, 3000);
										} else {
											// O e-mail é válido, continuar com o restante do código de sucesso
											$("#msg_sucesso").html(
												"Denuncia registrada com Sucesso! Cheque seu email para mais informações"
											);
											$("#sucesso").show("slow");
											$("html, body").animate({ scrollTop: 0 }, "slow");
											window.setTimeout(function () {
												$("#sucesso").hide(1000);
											}, 3000);
										}
									},
									error: function (xhr, status, error) {
										console.log(error); // Optional: Log the error, if any
									},
								});
							},
						});
					}
				},
				error: function (xhr, status, error) {
					console.log(error); // Optional: Log the error, if any
				},
			});
		}
	});
});
