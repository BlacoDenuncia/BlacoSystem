//Função para expandir cards de conteudos
$(document).ready(function () {
    $(".conteudos-title").click(function (e) {
        // Recebe o valor do atributo data-tab do elemento clicado
        var conteudositem = $(this).attr("data-tab");
        
        // Alterna o conteudo do elemento associado ao valor data-tab e faz um "slide"
        $("#" + conteudositem)
            .slideToggle()
            .parent()
            .siblings()
            .find(".conteudos-content")
            .slideUp();
  
        // Adicionar, no elemento clicado, a classe active-title
        $(this).toggleClass("active-title");
        
        // Remove a classe active-title de outros elementos .conteudos-title
        $("#" + conteudositem)
            .parent()
            .siblings()
            .find(".conteudos-title")
            .removeClass("active-title");
  
        // Adiciona a classe chevron-top no elemento <i> no item que foi clicado
        $("i.bi-chevron-down", this).toggleClass("chevron-top");
        
        // Remove a classe chevron-top dos elementos com a classe .conteudos-title
        $("#" + conteudositem)
            .parent()
            .siblings()
            .find(".conteudos-title i.bi-chevron-down")
            .removeClass("chevron-top");
    });
});