<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAILX5C4EmC9jNJrQfi-UhqkudL_TtHVW8&libraries=places"></script>
<script>
    var isLoggedIn = <?php echo $this->session->userdata('logged_in') ? 'true' : 'false'; ?>;
    var userData = <?php echo json_encode($this->session->userdata('logged_in')); ?>;
</script>

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
    <div id="report-chat" class="container no-padding">
        <div id="container">
            <div id="header">
                Denuncie agora!
            </div>
            <div class="body" id="body">
                <!-- This section will be dynamically inserted from JavaScript -->
            </div>

            <div id="inputArea">
                <input type="hidden" name="data_hora_envio" id="data_hora_envio" value="">
                <input type="hidden" name="id_usuario" id="id_usuario" value="">
                <input type="text" class="form-control answerInput" id="nome_vitima" name="nome_vitima"
                    placeholder="Digite seu nome">
                <input type="number" class="form-control answerInput" id="idade_vitima" name="idade_vitima">
                <input type="text" class="form-control answerInput" id="contato_vitima" name="contato_vitima"
                    placeholder="Digite o seu número">
                <input type="email" class="form-control answerInput" id="email_vitima" name="email_vitima"
                    placeholder="Digite seu melhor email">
                <select class="form-control answerInput" id="genero_vitima" name="genero_vitima">
                    <option value="Masculino">Masculino</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Outro">Outro</option>
                </select>
                <select class="form-control answerInput" id="etnia_vitima" name="etnia_vitima">
                    <option value="Negro">Negro</option>
                    <option value="Branco">Branco</option>
                    <option value="Pardo">Pardo</option>
                    <option value="Indígena">Indígena</option>
                    <option value="Asiático">Asiático</option>
                </select>
                <select class="form-control answerInput" id="tipo_violencia" name="tipo_violencia">
                    <option value="Xingamentos Ofensivos">Xingamentos Ofensivos</option>
                    <option value="Violência Física">Violência Física</option>
                    <option value="Discriminação">Discriminação</option>
                    <option value="Privação de direitos">Privação de direitos</option>
                </select>
                <input type="text" class="form-control answerInput" id="descricao_agressor" name="descricao_agressor"
                    placeholder="Descreva com detalhes o agressor"></input>
                <input type="text" class="form-control answerInput" id="descricao_caso" name="descricao_caso"
                    placeholder="Descreva o que aconteceu"></input>
                <button type="button" class=" answerInput btn btn-danger btn-sm btnRecebeLocalizacao" id="btnRecebeLocalizacao"><i
                        class="bi bi-geo-alt-fill"></i>Localização atual</button>
                <input type="text" class="form-control answerInput" id="rua" name="rua" value=" " placeholder="Em que rua você estava?">
                <input type="text" class="form-control answerInput" id="bairro" name="bairro" value=" " placeholder="Qual bairro?">
                <input type="text" class="form-control answerInput" id="cidade" name="cidade" value=" " placeholder="Cidade em que ocorreu"
                    required>
                <input type="text" class="form-control answerInput" id="estado" name="estado" value=" " placeholder="Estado em que ocorreu"
                    required>
                <select class="form-control answerInput" id="tipo_estabelecimento" name="tipo_estabelecimento">
                    <option value="Local público">Local Público</option>
                    <option value="Empresa privada">Empresa privada</option>
                    <option value="Shopping">Shopping</option>
                    <option value="Casa">Em casa</option>
                    <option value="Estádio de futebol">Estádio de futebol</option>
                    <option value="Escola">Escola</option>
                    <option value="Trabalho">Trabalho</option>
                </select>





                <button id="send" class=" btn " value="Send" disabled>Enviar</button>
            </div>
        </div>
    </div>
</div>