<div class="racismReport">
   <div class="page-title container">
      <h1 class="page-title-header"> Formulário de Denúncia </h1>
      <p class="page-title-text">Texto aqui Texto aqui Texto aqui</p>
   </div>
   <form>
      <div class="row">
         <div class="form-group col-md-5">
            <label class="form-label" for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
         </div>
         <div class="form-group col-md-3">
            <label class="form-label" for="idade">Idade</label>
            <input type="number" class="form-control" id="idade" name="idade" required>
         </div>
         <div class="form-group col-md-4">
            <label class="form-label" for="numContato">Telefone de contato</label>
            <input type="text" class="form-control" id="numContato" name="numContato" placeholder="Digite o seu número" required>
         </div>
      </div>
      <div class="row">
         <div class="form-group col-md-6">
            <label class="form-label" for="email">Email de contato</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu melhor email" required>
         </div>
         <div class="form-group col-md-6">
            <label class="form-label" for="tipoViolencia">Tipo de violência</label>
            <select class="form-control" id="tipoViolencia" name="tipoViolencia">
               <option value="1º Ano">A</option>
               <option value="2º Ano">B</option>
               <option value="3º Ano">C</option>
            </select>
         </div>
      </div>
      <div class="row">
         <div class="form-group">
            <label class="form-label" for="descricao">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" rows="5" placeholder="Descreva com detalhes o agressor e o que aconteceu" required></textarea>
         </div>
      </div>
      <div class="row">
         <div class="form-group form-button col-md-2">
            <button type="button" class="btn btn-danger btn-sm" id="btnRecebeLocalizacao"><i class="bi bi-geo-alt-fill"></i>Localização atual</button>
         </div>
         <div class="form-group col-md-2">
            <label class="form-label" for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Qual bairro?" required>
         </div>
         <div class="form-group col-md-3">
            <label class="form-label" for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade em que ocorreu" required>
         </div>
         <div class="form-group col-md-2">
            <label class="form-label" for="estado">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado em que ocorreu" required>
         </div>
         <div class="form-group col-md-3">
            <label class="form-label" for="rua">Rua</label>
            <input type="text" class="form-control" id="rua" name="rua" placeholder="Em que rua você estava?" required>
         </div>
      </div>
      <div class="row">
         <div class="form-group col-md-2">
            <label class="form-label" for="numeroDoLocal">Número do local</label>
            <input type="text" class="form-control" id="numeroDoLocal" name="numeroDoLocal" placeholder="Número do estabelecimento" required>
         </div>
         <div class="form-group col-md-4">
            <label class="form-label" for="tipoEstabelecimento">Tipo do estabelecimento</label>
            <select class="form-control" id="tipoEstabelecimento" name="tipoEstabelecimento">
               <option value="Local público">Local Público</option>
               <option value="Empresa privada">Empresa privada</option>
               <option value="Shopping">Shopping</option>
               <option value="Shopping">Em casa</option>
               <option value="Shopping">Estádio de futebol</option>
               <option value="Shopping">Escola</option>
               <option value="Shopping">Trabalho</option>
            </select>
         </div>
         <div class="form-group col-md-4">
            <label class="form-label" for="temTestemunhas">Houveram testemunhas?</label>
            <div class="form-check">
               <input type="checkbox" class="form-check-input" id="temTestemunhas" name="temTestemunhas">
               <label class="form-check-label" for="temTestemunhas">Yes</label>
            </div>
         </div>
      </div>
      <div class="row" id="camposTestemunhas">
         <div class="form-group col-md-3">
            <label class="form-label" for="nomeTestemunha">Witness Name</label>
            <input type="text" class="form-control" id="nomeTestemunha" name="nomeTestemunha">
         </div>
         <div class="form-group col-md-3">
            <label class="form-label" for="numeroTestemunha">Contato da testemunha</label>
            <input type="text" class="form-control" id="numeroTestemunha" name="numeroTestemunha">
         </div>
         <div class="form-group col-md-3">
            <label class="form-label" for="emailTestemunha">Email da testemunha</label>
            <input type="email" class="form-control" id="emailTestemunha" name="emailTestemunha">
         </div>
      </div>
      <div class="row">
         <div class="form-group col-md-6">
            <label class="form-label" for="acoesTomadas">Ações tomadas</label>
            <textarea class="form-control" id="acoesTomadas" name="acoesTomadas" placeholder="O que você fez logo após o ocorrido?" rows="5"></textarea>
         </div>
         <div class="form-group col-md-6">
            <label class="form-label" for="impactoEmocional">Como se sente?</label>
            <textarea class="form-control" id="impactoEmocional" name="impactoEmocional" placeholder="Tente encontrar uma única palavra, se possível." rows="5"></textarea>
         </div>
      </div>
      <div class="modal-footer">
         <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="aceitaDadosCheck" required>
            <label class="form-check-label" for="aceitaDadosCheck">Eu aceito a utilização dos meus dados para fins de estatística ( Não divulgaremos seus dados pessoais )</label>
         </div>
         <div class="form-button">
            <div class="form-group">
               <button type="button" class="btn btn-success btn-enviar" id="btn-enviar">
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