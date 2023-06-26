// Função para verificar a conexão com a internet antes do carregamento total da página
$(document).ready(function () {
    //Recebe data e hora do cadastro do form
    var campoDataHora = document.getElementById('data_hora_caso');
    var dataHoraAtual = new Date().toISOString(); // Get the current date and time in ISO format
    campoDataHora.value = dataHoraAtual;

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
     
      if((nome_vitima=="") || (idade_vitima=="") || (contato_vitima=="") || (email_vitima=="") || (tipo_violencia=="") || (descricao_agressor=="") || (descricao_caso=="") || (rua=="") || (numero_do_local=="") || (bairro=="") || (cidade=="") || (estado=="") ){
          $("#msg_erro").html("Por favor preencha todos os campos com borda colorida pois são essenciais para te ajudar! Caso o botão de localização não tenha funcionado digite manualmente");
          $('#erro').show('slow');
          $('html, body').animate({scrollTop: 0}, 'slow');
          window.setTimeout(function(){
              $('#erro').hide(1000);
          },3000);  
          
          //-------fazer função que deixa os campos obrigatórios com borda vermelha-------//


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
            bairro: bairro,
            cidade: cidade,
            estado: estado,
            tipo_estabelecimento: tipo_estabelecimento
    
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
                  $("#msg_sucesso").html("Denuncia registrada com Sucesso! Em breve um orgão de segurança entrará em contato.");
                  $('#sucesso').show('slow');
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
