$(document).ready(function () {
    tinymce.init({
        selector: 'textarea#post-content',
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image',
    });

    Dropzone.autoDiscover = false;

    var meuDropzone = new Dropzone("#img-dropzone", {
        url: base_url + "posts_controller/upload-image",
        autoProcessQueue: false,
        paramName: "file",
        maxFilesize: 5, // Tamanho máximo do arquivo em MB
        maxFiles: 1,    // Número máximo de arquivos
        acceptedFiles: 'image/*',
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
    });
    $("#btn-limpar").click(function() {
        meuDropzone.removeAllFiles();
    });

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