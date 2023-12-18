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
                            <textarea class="form-control" name="post-content" id="post-content"
                                name="post-subtitle"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="form-label" for="img-dropzone">Envie a imagem de fundo:</label>
                            <div id="img-dropzone" class="img-upload"><p style="text-align: center;">Arraste e jogue a imagem aqui</p></div>
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
<?php
    $tinyKey = $_ENV["TINY_KEY"];
?>
<script src="https://cdn.tiny.cloud/1/<?php echo $tinyKey;?>/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>vendor/enyo/dropzone/dist/min/dropzone.min.css">
<script src="<?php echo base_url();?>vendor/enyo/dropzone/dist/min/dropzone.min.js"></script>
