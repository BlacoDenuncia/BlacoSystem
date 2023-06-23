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
    // Realize ações adicionais ou habilite funcionalidades online
  } else {
    console.log('Não conectado à internet');
    // Exiba o modal
    $('#modalDesconectado').modal('show');
  }
}

$(document).ready(function () {
  //Recebe data e hora do cadastro do form
  var campoDataHora = document.getElementById('data_hora_caso');
  var dataHoraAtual = new Date().toISOString(); // Get the current date and time in ISO format
  campoDataHora.value = dataHoraAtual;
  
  // Recebe a URL da página atual
  var currentPageUrl = window.location.href;

  // Define as URLs das páginas que não precisam de acesso à internet
  var offlinePages = [
    'https://blaco-teste.000webhostapp.com/Conteudo_controller'
  ];

  // Verifica se a página atual está na lista de páginas offline
  var isOfflinePage = offlinePages.includes(currentPageUrl);

  // Se a página não é offline, verifica a conexão com a internet
  if (!isOfflinePage) {
    checkInternetConnection();
  }

  // Ouve eventos de online e offline
  $(window).on('online', function() {
    console.log('Conectado à internet');
    // Realize ações adicionais ou habilite funcionalidades online
  });

  $(window).on('offline', function() {
    if (!isOfflinePage) {
      console.log('Não conectado à internet');
      // Exiba o modal
      $('#modalDesconectado').modal('show');
    }
  });

  // Ouve o clique no botão de verificar conexão com a internet
  $('#btnChecaInternet').click(function() {
    checkInternetConnection();
  });

  // Inicialmente, oculta os campos de testemunhas
  $("#camposTestemunhas").hide();

  // Alterna a exibição dos campos de testemunhas com base no estado da caixa de seleção
  $("#temTestemunhas").change(function() {
    if (this.checked) {
      $("#camposTestemunhas").show("slow");
      // Habilita os campos de testemunhas
      $("#nomeTestemunha, #numeroTestemunha, #emailTestemunha").prop("disabled", false);
    } else {
      $("#camposTestemunhas").hide(2000);
      // Desabilita os campos de testemunhas e limpa seus valores
      $("#nomeTestemunha, #numeroTestemunha, #emailTestemunha").prop("disabled", true).val("");
    }
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

//faz registro das denuncias de forma assincrona
  $("#btnEnviarDenuncia").click(function () {

        
    var id_denuncia = $('#id_denuncia').val();
var data_hora_caso = $('#data_hora_caso').val();
var nome_vitima = $('#nome_vitima').val();
var idade_vitima = $('#idade_vitima').val();
var contato_vitima = $('#contato_vitima').val();
var email_vitima = $('#email_vitima').val();
var genero_vitima = $('#genero_vitima').val();
var etnia_vitima = $('#etnia_vitima').val();
var tipo_violencia = $('#tipo_violencia').val();
var descricao_agressor = $('#descricao_agressor').val();
var descricao_caso = $('#descricao_caso').val();
var rua = $('#rua').val();
var numero_do_local = $('#numero_do_local').val();
var bairro = $('#bairro').val();
var cidade = $('#cidade').val();
var estado = $('#estado').val();
var tipo_estabelecimento = $('#tipo_estabelecimento').val();
var nome_estabelecimento = $('#nome_estabelecimento').val();
var nome_testemunha = $('#nome_testemunha').val();
var contato_testemunha = $('#contato_testemunha').val();
var email_testemunha = $('#email_testemunha').val();
var acoes_tomadas = $('#acoes_tomadas').val();
var impacto_emocional = $('#impacto_emocional').val();
   
    if((nome_vitima=="") || (idade_vitima=="") || (contato_vitima=="") || (email_vitima=="") || (tipo_violencia=="") || (descricao_agressor=="") || (descricao_caso=="") || (rua=="") || (numero_do_local=="") || (bairro=="") || (cidade=="") || (estado=="") ){
        $("#msg_erro").html("Por favor preencha todos os campos com borda colorida pois são essenciais para te ajudar! Caso o botão de localização não tenha funcionado digite manualmente");
        $('#erro').show('slow');
        $('html, body').animate({scrollTop: 0}, 'slow');
        window.setTimeout(function(){
            $('#erro').hide(1000);
        },3000);                                                            
    }else{
       
            $.ajax({
        url: "Boletim_controller/registrar_denuncia",
        type: "POST",
        data: {
          id_denuncia: id_denuncia,
          data_hora_caso: data_hora_caso,
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
          numero_do_local: numero_do_local,
          bairro: bairro,
          cidade: cidade,
          estado: estado,
          tipo_estabelecimento: tipo_estabelecimento,
          nome_estabelecimento: nome_estabelecimento,
          nome_testemunha: nome_testemunha,
          contato_testemunha: contato_testemunha,
          email_testemunha: email_testemunha,
          acoes_tomadas: acoes_tomadas,
          impacto_emocional: impacto_emocional
  
        },
        beforeSend : function() {
            $('#loading').show();
},
complete : function() {
            $('#loading').hide();
    },
        success: function (data) {
            var json = $.parseJSON(data);
            if (json.tipo == 'success') {
                $("#msg_acerto").html("Denuncia registrada com Sucesso! Em breve um orgão de segurança entrará em contato.");
                $('#sucesso').show('slow');
                tableTurmas.ajax.reload();
                $('html, body').animate({scrollTop: 0}, 'slow');
                window.setTimeout(function(){
                    $('#sucesso').hide(1000);
                },3000);
                
            } else {            
                
                $("#msg_erro").html("Falha ao registrar a denuncia!");
                $('#erro').show('slow');
                $('html, body').animate({scrollTop: 0}, 'slow');
                window.setTimeout(function(){
                    $('#erro').hide(1000);
                },3000);                                                            
                }                 
                
        }          
    });
    }  

});
});