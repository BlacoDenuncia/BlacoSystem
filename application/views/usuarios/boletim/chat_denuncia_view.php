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
    <div id="report-chat" class="container-fluid no-padding">
        <div id="container">
            <div id="header">
                Denuncie agora!
            </div>
            <div id="body">
                <!-- This section will be dynamically inserted from JavaScript -->
                <div class="userSection">
                    <div class="messages user-message">

                    </div>
                    <div class="seperator"></div>
                </div>
                <div class="botSection">
                    <div class="messages bot-reply">

                    </div>
                    <div class="seperator"></div>
                </div>
            </div>

            <div id="inputArea">
                <input type="text" name="messages" id="userInput" placeholder="Please enter your message here" required>
                <input type="submit" id="send" value="Send">
            </div>
        </div>
    </div>
</div>