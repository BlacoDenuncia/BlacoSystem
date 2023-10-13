// Função para verificar a conexão com a internet antes do carregamento total da página
function checkInternetConnection() {
  /*$.ajax({
    url: 'https://blaco-teste.000webhostapp.com/', // Substitua pela sua própria URL ou endpoint da API
    dataType: 'jsonp',
    timeout: 10000, // Ajuste o valor de tempo limite conforme necessário
    success: function() {
      console.log('Conectado à internet');
      // Realize ações adicionais ou habilite funcionalidades online
    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.log('Não conectado à internet');
      // Exiba o modal
      $('#myModal').modal('show');
    }
  });*/

  // Verifica se o navegador está online
  if (navigator.onLine) {
    console.log('Conectado à internet');
    $('#modalDesconectado').modal('hide');
    // Realize ações adicionais ou habilite funcionalidades online
  } else {
    console.log('Não conectado à internet');
    // Exiba o modal
    $('#modalDesconectado').modal('show');
  }
}

$(document).ready(function () {
  $('#myTabs a[data-toggle="tab"]').on('click', function (e) {
    e.preventDefault();
    
    $('#myTabs li.nav-item').removeClass('active');
    
    $(this).parent().addClass('active');
    
    $(this).tab('show');
});
  // Recebe a URL da página atual
  var currentPageUrl = window.location.href;
  if (currentPageUrl === 'http://localhost/blaco/Index_controller' || 'https://blaco.com.br/Index_controller') {
    window.addEventListener('beforeinstallprompt', (event) => {

      $('#installModal').modal('show');
      let deferredPrompt = event;

      $('#installButton').click(() => {

        deferredPrompt.prompt();

        deferredPrompt.userChoice.then((choiceResult) => {
          if (choiceResult.outcome === 'accepted') {
            console.log('A instalação foi aceita.');
          } else {
            console.log('A instalação foi recusada.');
          }
          $('#installModal').modal('hide');
        });
      });
    });

/*    // Verifique se o aplicativo já foi instalado
    if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
      $('#installModal').modal('hide');
    }*/
  }


  if ('serviceWorker' in navigator) {
    window.addEventListener('load', () =>
      navigator.serviceWorker.register('/blaco/sw.js')
        .then(registration => console.log('Service Worker registered'))
        .catch(err => 'SW registration failed'));
  }

  /*$('#link-offline-conteudos').click(function() {
    console.log("aqui estou")
    window.location.href = '/conteudos_view.html';
  });*/

  // Define as URLs das páginas que não precisam de acesso à internet
  var offlinePages = [
    'https://blaco.com.br/Conteudo_controller'
  ];

  // Verifica se a página atual está na lista de páginas offline
  var isOfflinePage = offlinePages.includes(currentPageUrl);

  // Se a página não é offline, verifica a conexão com a internet
  if (!isOfflinePage) {
    checkInternetConnection();
  }

  // Ouve eventos de online e offline
  $(window).on('online', function () {
    console.log('Conectado à internet');
    // Realize ações adicionais ou habilite funcionalidades online
  });

  $(window).on('offline', function () {
    if (!isOfflinePage) {
      console.log('Não conectado à internet');
      // Exiba o modal
      $('#modalDesconectado').modal('show');
    }
  });

  // Ouve o clique no botão de verificar conexão com a internet
  $('#btnChecaInternet').click(function () {
    checkInternetConnection();
  });

  // Função para expandir os cards de conteúdo
  $(".conteudos-title").click(function (e) {
    // Recebe o valor do atributo data-tab do elemento clicado
    var conteudositem = $(this).attr("data-tab");

    // Alterna o conteúdo do elemento associado ao valor data-tab e faz um "slide"
    $("#" + conteudositem)
      .slideToggle()
      .parent()
      .siblings()
      .find(".conteudos-content")
      .slideUp();

    // Adiciona a classe active-title ao elemento clicado
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