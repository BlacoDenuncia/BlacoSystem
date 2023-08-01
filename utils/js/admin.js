$(document).ready(function () {
    // Ajax request when the button is clicked
    $("#btnGerarPlanilha").click(function () {
        var downloadLink = $("<a style='display: none;'/>");
        $("body").append(downloadLink);


        $.ajax({
            url: base_url + "planilhas_controller/generate_excel",
            type: "POST",

            success: function () {
                downloadLink.attr("href", base_url + "planilhas_controller/generate_excel");
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
});