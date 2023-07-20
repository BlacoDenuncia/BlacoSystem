<div class="racismReport container">
   <!-- Loading -->
   <div id="loading" style="display: none;">
      <img id="imagemLoader" alt="Processando" src="<?php echo base_url(); ?>utils/img/carregando.gif" style="
         width: 100px;
         height: 100px;
         margin-top: 10px; ">
      <!--<p id="fraseLoader">Processando, aguarde...</p>-->
   </div>
   <!-- mensagens de erro e sucesso -->
   <div class="alert alert-success" id="sucesso" role="alert" style="display:none;">
      <span id="msg_sucesso">Sucesso!</span>
   </div>
   <div class="alert alert-danger" id="erro" role="alert" style="display:none;">
      <span id="msg_erro">Erro!</span>
   </div>
   <div class="page-title container">
      <h1 class="page-title-header"> Formulário de Denúncia </h1>
      <p class="page-title-text">Texto aqui Texto aqui Texto aqui</p>
   </div>
   <div class="report-form">
      <div class="card" style="border-radius: 1rem;">
         <div class="card-body p-3">
            <form>
               <input type="hidden" name="data_hora_envio" id="data_hora_envio" value="">
               <div class="row">
                  <div class="form-group col-md-10">
                     <label class="form-label" for="nome_vitima">Nome</label>
                     <input type="text" class="form-control" id="nome_vitima" name="nome_vitima"
                        placeholder="Digite seu nome">
                  </div>
                  <div class="form-group col-md-2">
                     <label class="form-label" for="idade_vitima">Idade</label>
                     <input type="number" class="form-control" id="idade_vitima" name="idade_vitima">
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label class="form-label" for="contato_vitima">Telefone de contato</label>
                     <input type="text" class="form-control" id="contato_vitima" name="contato_vitima"
                        placeholder="Digite o seu número">
                  </div>
                  <div class="form-group col-md-6">
                     <label class="form-label" for="email_vitima">Email de contato</label>
                     <input type="email" class="form-control" id="email_vitima" name="email_vitima"
                        placeholder="Digite seu melhor email">
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label class="form-label" for="genero_vitima">Selecione seu gênero</label>
                     <select class="form-control" id="genero_vitima" name="genero_vitima">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <label class="form-label" for="etnia_vitima">Etnia/Raça</label>
                     <select class="form-control" id="etnia_vitima" name="etnia_vitima">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                     </select>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="form-group col-md-12">
                     <label class="form-label" for="tipo_violencia">Tipo de violência</label>
                     <select class="form-control" id="tipo_violencia" name="tipo_violencia">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                     </select>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="form-group col-md-6">
                     <label class="form-label" for="descricao_agressor">Descreva o agressor</label>
                     <textarea class="form-control" id="descricao_agressor" name="descricao_agressor" rows="5"
                        placeholder="Descreva com detalhes o agressor"></textarea>
                  </div>
                  <div class="form-group col-md-6">
                     <label class="form-label" for="descricao_caso">Descreva o que ocorreu</label>
                     <textarea class="form-control" id="descricao_caso" name="descricao_caso" rows="5"
                        placeholder="Descreva o que aconteceu"></textarea>
                  </div>
               </div>
               <br>
               <div class="row">
                  <div class="form-group form-button col-md-2">
                     <button type="button" class="btn btn-danger btn-sm btnRecebeLocalizacao"
                        id="btnRecebeLocalizacao"><i class="bi bi-geo-alt-fill"></i>Localização atual</button>
                  </div>
                  <div class="form-group col-md-5">
                     <label class="form-label" for="rua">Rua</label>
                     <input type="text" class="form-control" id="rua" name="rua" placeholder="Em que rua você estava?">
                  </div>
                  <div class="form-group col-md-5">
                     <label class="form-label" for="bairro">Bairro</label>
                     <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Qual bairro?">
                  </div>


                  <!--<div class="form-group col-md-2">
            <label class="form-label" for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade em que ocorreu"
               required>
         </div>
         <div class="form-group col-md-2">
            <label class="form-label" for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado em que ocorreu"
               required>
         </div>-->


               </div>
               <br>
               <div class="row">

                  <div class="form-group col-md-12">
                     <label class="form-label" for="tipo_estabelecimento">Tipo do estabelecimento</label>
                     <select class="form-control" id="tipo_estabelecimento" name="tipo_estabelecimento">
                        <option value="Local público">Local Público</option>
                        <option value="Empresa privada">Empresa privada</option>
                        <option value="Shopping">Shopping</option>
                        <option value="Shopping">Em casa</option>
                        <option value="Shopping">Estádio de futebol</option>
                        <option value="Shopping">Escola</option>
                        <option value="Shopping">Trabalho</option>
                     </select>
                  </div>
               </div>
               <!---->
               <div class="form-footer">
               <label class="form-label" style="text-align: justify; color: red;"> Informações enviadas serão enviadas para um orgão de segurança e, dados não pessoais, utilizadas para fins estatísticos e de pesquisa. Elas não serão compartilhadas publicamente</label>
                  <div class="form-group form-check">
                     <input type="checkbox" class="form-check-input" id="aceitaDadosCheck">
                     <label class="form-check-label" for="aceitaDadosCheck">Eu aceito a utilização dos dados da minha denúncia</label>
                  </div>
                  <div class="form-button">
                     <div class="form-group">
                        <button type="button" class="btn btn-success btnEnviarDenuncia" id="btnEnviarDenuncia">
                           <span class="bi bi-check" aria-hidden="true"></span> Enviar
                        </button>
                     </div>
                     <div class="form-group">
                        <button type="reset" class="btn btn-dark btn-limpar" id="btn-limpar">
                           <span class="bi bi-eraser" aria-hidden="true"></span> Limpar
                        </button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>