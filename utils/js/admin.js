$(document).ready(function () {
    tinymce.init({
        selector: 'textarea#post-content',
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image',
    });

    Dropzone.autoDiscover = false;
    var upload_error = 0;
    var image_path;


    var meuDropzone = new Dropzone("#img-dropzone", {
        url: base_url + "posts_controller/upload_image",
        autoProcessQueue: false,
        paramName: "file",
        maxFilesize: 5, // Tamanho máximo do arquivo em MB
        maxFiles: 1,    // Número máximo de arquivos
        acceptedFiles: 'image/*',
        renameFile: function (file) {
            var post_id = $("#post_title").val();
            var novoNome = `${post_id}.${file.name.split(".").pop()}`;
            return novoNome;
        },
        previewTemplate: `
        <div id="img-upload-preview" class="dz-preview dz-file-preview">
            <div class="dz-details">
                <div class="dz-filename"><span data-dz-name></span></div>
                <div class="dz-size" data-dz-size></div>
                <img data-dz-thumbnail />
            </div>
            <div class="dz-progress"> <span class="dz-upload" data-dz-uploadprogress></span></div >
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
            <div class="dz-remove-button">
                <button class="btn btn-danger btn-remove" data-dz-remove>
                    Remover
                </button>
            </div>
        </div>`,
        init: function () {
            this.on("success", function (file, response) {
                var json = $.parseJSON(response);
                // Aqui você pode fazer o que for necessário com a resposta JSON
                if (json.success) {
                    image_path = json.image_path;

                    $("#msg_sucesso").html(
                        "Imagem salva com sucesso."
                    );
                    $("#sucesso").show("slow");
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    window.setTimeout(function () {
                        $("#sucesso").hide(1000);
                        post_status = criarPost();
                        if (post_status == "error") {
                            if (image_path) {
                                excluirImagem(image_path);
                            }
                            upload_error = 1;
                        }
                    }, 3000);
                } else {
                    upload_error = 1;
                    error_message = json.message;

                    $("#msg_erro").html(
                        `Ocorreu um erro ao salvar imagem<br> ${error_message}`
                    );
                    $("#erro").show("slow");
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    window.setTimeout(function () {
                        $("#erro").hide(1000);
                    }, 3000);
                }
            });
            this.on("error", function (file, errorMessage) {
                upload_error = 1;
                console.error(errorMessage); // Log da mensagem de erro
                $("#msg_erro").html(
                    `${errorMessage}`
                );
                $("#erro").show("slow");
                $("html, body").animate({ scrollTop: 0 }, "slow");
                window.setTimeout(function () {
                    $("#erro").hide(1000);
                }, 3000);
            });
        }
    });
    $("#btn-limpar").click(function () {
        meuDropzone.removeAllFiles();
    });

    function verificarCamposVazios() {
        var camposObrigatorios = [
            "#post_title",
            "#post_subtitle",
        ];
        camposObrigatorios.forEach(function (campo) {
            var valorCampo = $(campo).val().trim();
            $(campo).toggleClass("input-error", valorCampo === "");
        });
    }
    function excluirImagem(imagePath) {
        $.ajax({
            url: base_url + "posts_controller/excluirImagem",
            type: "POST",
            data: { image_path: imagePath },
            success: function (response) {
                $("#msg_sucesso").html(
                    "Imagem excluída com sucesso"
                );
                $("#sucesso").show("slow");
                $("html, body").animate({ scrollTop: 0 }, "slow");
                window.setTimeout(function () {
                    $("#sucesso").hide(1000);
                }, 3000);
            },
            error: function (xhr, status, error) {
                console.error("", error);
                $("#msg_erro").html(
                    "Erro ao excluir imagem:"
                );
                $("#erro").show("slow");
                $("html, body").animate({ scrollTop: 0 }, "slow");
                window.setTimeout(function () {
                    $("#erro").hide(1000);
                }, 3000);
            }
        });
    }

    function fazerUploadImagem() {
        if (meuDropzone.files.length > 0) {

            meuDropzone.processQueue();
            if (upload_error) {
                return "error";
            } else {
                return "sucess";
            }

        } else {
            $("#msg_erro").html(
                "Nenhum arquivo para enviar."
            );
            $("#erro").show("slow");
            $("html, body").animate({ scrollTop: 0 }, "slow");
            window.setTimeout(function () {
                $("#erro").hide(1000);
            }, 3000);
            return "error";
        }
    }
    function criarPost() {
        var post_title = $("#post_title").val();
        var post_subtitle = $("#post_subtitle").val();
        var post_type = $("#post_type").val();

        var editor = tinymce.get('post-content');

        // Verifica se o editor está inicializado
        if (editor) {

            var conteudo = editor.getContent();
            if (conteudo == "") {
                $("#msg_erro").html("O conteudo do post está vazio, por favor preencha corretamente!");
                $("#erro").show("slow");
                $("html, body").animate({ scrollTop: 0 }, "slow");
                window.setTimeout(function () {
                    $("#erro").hide(1000);
                    return "error";
                }, 3000);
            }

        } else {
            $("#msg_erro").html(
                "O editor de texto não está inicializado ou não foi encontrado."
            );
            $("#erro").show("slow");
            $("html, body").animate({ scrollTop: 0 }, "slow");
            window.setTimeout(function () {
                $("#erro").hide(1000);
            }, 3000);
            return "error";
        }
        var post_data = {
            post_title_data: post_title,
            post_subtitle_data: post_subtitle,
            post_type_data: post_type,
            conteudo_data: conteudo,
            image_path_data: image_path
        }
        $.ajax({
            url: "Posts_controller/criarPost",
            type: "POST",
            data: post_data,
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
                        "Ocorreu um erro ao criar o post"
                    );
                    $("#erro").show("slow");
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    window.setTimeout(function () {
                        return "error";
                    }, 3000);
                } else {
                    $("#msg_sucesso").html(
                        "Post criado com sucesso!"
                    );
                    $("#sucesso").show("slow");
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    window.setTimeout(function () {
                        $("btn-limpar").click();
                        return "sucess";
                    }, 3000);
                }

                $("html, body").animate({ scrollTop: 0 }, "slow");
                window.setTimeout(function () {
                    $("#sucesso, #erro").hide(1000);
                    $("#btn-close").click();
                }, 3000);
            },
            error: function (xhr, status, error) {
                console.log("Erro ao criar post:", error);
                // Remover imagem se ocorrer um erro
                if (image_path) {
                    excluirImagem(image_path);
                }
            }

        });
    }

    $("#btnCriarPost").click(function () {
        verificarCamposVazios();
        var camposVazios = $(".input-error");
        if (camposVazios.length > 0) {
            $("#msg_erro").html(
                "Por favor, preencha todos os campos, não se esqueça de adicionar uma imagem válida."
            );
            $("#erro").show("slow");
            $("html, body").animate({ scrollTop: 0 }, "slow");
            window.setTimeout(function () {
                $("#erro").hide(1000);
            }, 3000);
            return;
        }

        var post_status = fazerUploadImagem();

        if (post_status == "sucess") {
            $("#msg_sucesso").html("Postagem feita com sucesso, confira a ba de conteudos");
            $("#sucesso").show("slow");
            $("html, body").animate({ scrollTop: 0 }, "slow");
            window.setTimeout(function () {
                $("#sucesso").hide(1000);
            }, 3000);
        }
        else { //this is error
            $("#msg_erro").html(
                "Erro ao postar"
            );
            $("#erro").show("slow");
            $("html, body").animate({ scrollTop: 0 }, "slow");
            window.setTimeout(function () {
                $("#erro").hide(1000);
            }, 3000);
        }

    })
    // Ajax request when the button is clicked
    $("#btnGerarPlanilhaGeral").click(function () {
        var downloadLink = $("<a style='display: none;'/>");
        $("body").append(downloadLink);


        $.ajax({
            url: base_url + "planilhas_controller/generate_geral_excel",
            type: "POST",

            success: function () {
                downloadLink.attr("href", base_url + "planilhas_controller/generate_geral_excel");
                downloadLink.attr("download", "boletim_data.xlsx");

                downloadLink[0].click();
                downloadLink.remove();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert("Ocorreu um erro e não foi possivel gerar seu download. Tente novamente mais tarde");
            },
        });
    });
    $("#btnGerarPlanilhaPerm").click(function () {
        var downloadLink = $("<a style='display: none;'/>");
        $("body").append(downloadLink);


        $.ajax({
            url: base_url + "planilhas_controller/generate_excel_with_permission",
            type: "POST",

            success: function () {
                downloadLink.attr("href", base_url + "planilhas_controller/generate_excel_with_permission");
                downloadLink.attr("download", "boletim_data.xlsx");

                downloadLink[0].click();
                downloadLink.remove();
            },
            error: function (xhr, status, error) {
                console.error(error);
                alert("Ocorreu um erro e não foi possivel gerar seu download. Tente novamente mais tarde");
            },
        });
    });

    $("#acessarApp").click(function () {
        window.location.href = base_url + "index_controller";
    });
});