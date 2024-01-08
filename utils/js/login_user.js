$(document).ready(function () {
    $('#data_nascimento').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
    });
    $("#telefone").mask("(00) 00000-0000");

    $('#upload-btn').click(function () {
        $('#uploadModal').modal('show');
    });
    $('#btnCloseUpModal').click(function () {
        $('#uploadModal').modal('hide');
    });
    $('#btnCloseEdModal').click(function () {
        $('#editarDadosModal').modal('hide');
    });
    $('#editarDados').on('click', function () {
        $('#editarDadosModal').modal('show');
    });
    $('#fazerLogout').on('click', function () {
        logoutUser();
    });

    function logoutUser() {
        $.ajax({
            url: "conta_controller/logout", // Replace with the correct URL of your logout PHP controller
            type: "POST",
            success: function (response) {
                var json = $.parseJSON(response);
                var tipo = json.tipo;
                if (tipo === "error") {
                    exibirMensagem("erro", "Ocorreu um erro ao sair da conta");
                } else {
                    exibirMensagem("sucesso", "Logout Realizado com sucesso");

                    window.location.href = base_url + "login_controller";
                }
            },
            error: function (xhr, status, error) {
                exibirMensagem("erro", "An error occurred while processing the logout request. Please try again later.");
            }
        });
    }

    $('#btnSalvarDados').on('click', function () {

        var nome = $("#nome").val();
        var data_nascimento = $("#data_nascimento").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();

        var data = {
            nome: nome,
            data_nascimento: data_nascimento,
            email: email,
            telefone: telefone
        };

        $.ajax({
            url: "conta_controller/update_user_data",
            type: "POST",
            data: data,
            success: function (response) {
                var json = $.parseJSON(response);
                var tipo = json.tipo;
                if (tipo === "error") {
                    exibirMensagem("erro", "Ocorreu um erro ao atualizar os dados");
                } else {
                    exibirMensagem("sucesso", "Dados atualizados com sucesso");
                    
                    window.location.href = base_url + "conta_controller";
                }
            },
            error: function (xhr, status, error) {
                exibirMensagem("erro", "An error occurred while updating the data. Please try again later.");
            }
        });
    });

    $("#uploadBtn").on("click", function () {
        uploadPhoto();
    });

    function uploadPhoto() {
        var formData = new FormData($("#uploadForm")[0]);

        $.ajax({
            url: "conta_controller/upload_photo",
            type: "POST",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.success) {
                    exibirMensagem("sucesso", response.message);
                    
                    window.location.reload();
                } else {
                    exibirMensagem("erro", response.message);
                }
            },
            error: function (xhr, status, error) {
                exibirMensagem("erro", "An error occurred while uploading the photo. Please try again later.");
            }
        });
    }

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
                    exibirMensagem("erro", "Falha ao fazer login")
                } else {
                    window.location.href = base_url + "conta_controller";
                }
            },
            error: function () {

                exibirMensagem("erro", "An error occurred while processing your request. Please try again later.");
            }
        });
    }


    $("#btnFazerLogin").on("click", function (event) {
        event.preventDefault();
        loginUser();
    });

    function buscarCadastro(emailUsuario) {
        $.ajax({
            type: "POST",
            url: "cadastro_controller/buscar_cadastro",
            data: emailUsuario,
            success: function (response) {
                var json = $.parseJSON(response);
                var usuExiste = json.tipo;
                return usuExiste;
            },
            error: function () {
                exibirMensagem("erro", "Ocorreu um erro ao processar o cadastro. Por favor tente novamente.");
            }
        })
    }

    $("#btnCadastrarUsuario").click(function () {

        var nome = $("#nome").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();
        var data_nascimento = $("#data_nascimento").val();
        var senha = $("#senha").val();

        var usuExiste = buscarCadastro(email);

        if (!usuExiste) {
            // validar cadastro
        } else {
            exibirMensagem("erro", "O email digitado já está cadastrado! Tente fazer login.");
            window.location.href = `${base_url}login_controller`;
        }

        /* Impedir cadastro até implementação da verificação
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
                    exibirMensagem("erro", "Ocorreu um erro ao cadastrar o usuario");
                } else {
                    exibirMensagem("sucesso", "Novo usuario cadastrado!");
                }
                $("#btn-close").click();
            },
            error: function () {
               exibirMensagem("erro", "An error occurred while processing your request. Please try again later.");
            }
        });*/
    });
});