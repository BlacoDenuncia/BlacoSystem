$(document).ready(function () {
    $('#data_nascimento').datepicker({
        format: 'dd-mm-yyyy', // Set the desired date format
        autoclose: true, // Close the datepicker when a date is selected
        todayHighlight: true, // Highlight today's date
        // Add any other options you may need
    });
    $("#telefone").mask("(00) 00000-0000");
    
    function loginUser() {
        var email = $("#email").val();
        var senha = $("#senha").val();

        var data = {
            email: email,
            senha: senha
        };

        $.ajax({
            type: "POST",
            url: "login_controller/valida_login",
            data: data,
            success: function (response) {
                var json = $.parseJSON(response);
                var mensagem = json.mensagem;
                var tipo = json.tipo;


                if (tipo === "error") {
                    $("#msg_erro").html(
                        "Falha ao fazer login"
                    );
                    $("#erro").show("slow");
                } else {
                    console.log("Login realizado");
                }

                $("html, body").animate({ scrollTop: 0 }, "slow");
                window.setTimeout(function () {
                    $("#sucesso, #erro").hide(1000);
                }, 3000);
            },
            error: function () {

                alert("An error occurred while processing your request. Please try again later.");
            }
        });
    }


    $("#btnFazerLogin").on("click", function (event) {
        event.preventDefault();
        loginUser();
    });

    $("#btnCadastrarUsuario").click(function () {

        var nome = $("#nome").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();
        var data_nascimento = $("#data_nascimento").val();
        var senha = $("#senha").val();

        var data = {
            nome: nome,
            email: email,
            telefone: telefone,
            data_nascimento: data_nascimento,
            senha: senha
        };

        $.ajax({
            type: "POST",
            url: "cadastro_controller/cadastrar_usuario",
            data: data,
            success: function (response) {
                var json = $.parseJSON(response);
                var tipo = json.tipo;
                if (tipo === "error") {
                    $("#msg_erro").html(
                        "Ocorreu um erro ao cadastrar o usuario"
                    );
                    $("#erro").show("slow");


                } else {
                    $("#msg_sucesso").html(
                        "Novo usuario cadastrado!"
                    );
                    $("#sucesso").show("slow");
                    
                }
                $("html, body").animate({ scrollTop: 0 }, "slow");
                window.setTimeout(function () {
                    $("#sucesso, #erro").hide(1000);
                    $("#btn-close").click();
                }, 3000);
            },
            error: function () {
                alert("An error occurred while processing your request. Please try again later.");
            }
        });
    });
});