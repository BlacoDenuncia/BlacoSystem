//checa internet antes do carregamento total da página
function checkInternetConnection() {
    /*$.ajax({
      url: 'https://blaco-teste.000webhostapp.com/', // Replace with your own URL or API endpoint
      dataType: 'jsonp',
      timeout: 10000, // Adjust timeout value as needed
      success: function() {
        console.log('Connected to the internet');
        // Perform additional actions or enable online functionality
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log('Not connected to the internet');
        // Display the modal
        $('#myModal').modal('show');
      }
    });*/
    if (navigator.onLine) {
        console.log('Connected to the internet');
        // Perform additional actions or enable online functionality
      } else {
        console.log('Not connected to the internet');
        // Display the modal
        $('#modalDesconectado').modal('show');
    }
}


$(document).ready(function () {
    // Recebe a URL da página atual
    var currentPageUrl = window.location.href;

    // Define as URLs das páginas que não precisam de acesso à internet
    var offlinePages = [
    'https://blaco-teste.000webhostapp.com/Conteudo_controller'
  ];

  // Checa se a página atual é uma das páginas do array
  var isOfflinePage = offlinePages.includes(currentPageUrl);

  // Se a página não é offline checa a conexão com a internet
  if (!isOfflinePage) {
    checkInternetConnection();
  }

    // Listen for online and offline events
    $(window).on('online', function() {
        console.log('Connected to the internet');
    // Perform additional actions or enable online functionality
    });

    $(window).on('offline', function() {
        if (!isOfflinePage) {
            console.log('Not connected to the internet');
            // Display the modal
            $('#modalDesconectado').modal('show');
          }
        
    });

    $('#btnChecaInternet').click(function() {
        checkInternetConnection();
    });

//Função para expandir cards de conteudos
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