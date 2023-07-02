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

		if (
			nome_vitima == "" ||
			idade_vitima == "" ||
			contato_vitima == "" ||
			email_vitima == "" ||
			tipo_violencia == "" ||
			descricao_agressor == "" ||
			descricao_caso == "" ||
			rua == "" ||
			numero_do_local == "" ||
			bairro == "" ||
			cidade == "" ||
			estado == ""
		) {
			$("#msg_erro").html(
				"Por favor preencha todos os campos com borda colorida pois são essenciais para te ajudar! Caso o botão de localização não tenha funcionado digite manualmente"
			);
			$("#erro").show("slow");
			$("html, body").animate({ scrollTop: 0 }, "slow");
			window.setTimeout(function () {
				$("#erro").hide(1000);
			}, 3000);

			//-------fazer função que deixa os campos obrigatórios com borda vermelha-------//
		} else {
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
								$("#modalEmailInvalido").modal("show");
								var emailDigitado = document.getElementById("emailDigitado");
								emailDigitado.value = email_vitima;
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
	});
});
