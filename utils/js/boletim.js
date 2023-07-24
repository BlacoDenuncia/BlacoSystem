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
		camposObrigatorios.forEach(function (campo) {
			var valorCampo = $(campo).val().trim();
			console.log(valorCampo);
			$(campo).toggleClass("input-error", valorCampo === "");
		});
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
						$("#msg_erro").html(
							"Ocorreu um erro da nossa parte ao enviar a denúncia para o seu email. Porém a sua denúncia FOI REGISTRADA"
						);
						$("#erro").show("slow");
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
	}
	function registrarDenuncia() {
		var dataHoraAtual = new Date();
		var options = { timeZone: "America/Sao_Paulo" };
		var dataHoraBrasil = dataHoraAtual.toLocaleString("pt-BR", options);
		var dataHoraFormatada = moment(dataHoraBrasil, "DD/MM/YYYY HH:mm:ss").format(
			"YYYY-MM-DD HH:mm:ss"
		);
		console.log("Data e hora de envio no Brasil:", dataHoraFormatada);

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
		var permiteDadosValor = $("#aceitaDadosCheck").prop("checked");

		var requestData = {
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
					("#msg_erro").html(
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
					enviarEmail(data);
				}

				$("html, body").animate({ scrollTop: 0 }, "slow");
				window.setTimeout(function () {
					$("#sucesso-modal, #erro-modal").hide(1000);
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

});