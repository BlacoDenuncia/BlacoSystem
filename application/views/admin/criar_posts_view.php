<div class="postsCreator container">
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
        <h1 class="page-title-header"> Criação de Posts </h1>
        <p class="page-title-text">Preencha para adicionar um novo conteudo na aba didática</p>
    </div>
    <div class="report-form">
        <div class="card" style="border-radius: 1rem;">
            <div class="card-body p-3">
                <form>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="post_title">Título do post (única palavra-chave)</label>
                            <input type="text" class="form-control" id="post_title" name="post_title"
                                placeholder="Digite uma palavra-chave">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="post_subtitle">Subtítulo do post (título completo porém tente
                                ser breve)</label>
                            <input type="text" class="form-control" id="post_subtitle" name="post_subtitle"
                                placeholder="Digite o título completo">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="post-content">Conteúdo do post:</label>
                            <textarea rows="5" class="form-control" name="post-content" id="post-content"
                                name="post-subtitle"
                                placeholder="Digite aqui o conteúdo informativo do post"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="image-upload">Envie a imagem de fundo:</label>
                            <input type="image" class="form-control" name="image-upload" id="image-upload"
                                name="post-subtitle"
                                placeholder="Enviar imagem"></textarea>
                        </div>
                    </div>

                    <div class="form-footer">
                        <div class="form-button">
                            <div class="form-group">
                                <button type="button" class="btn btn-success btnCriarPost" id="btnCriarPost">
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