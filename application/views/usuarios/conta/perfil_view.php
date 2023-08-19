<script src="<?php echo base_url(); ?>utils/js/moment.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/bootstrap-datepicker.min.css">
<script src="<?php echo base_url(); ?>utils/js/bootstrap-datepicker.min.js"></script>

<div class="container-fluid">
    <div class="alert alert-success" id="sucesso" role="alert" style="display:none;">
        <span id="msg_sucesso">Sucesso!</span>
    </div>
    <div class="alert alert-danger" id="erro" role="alert" style="display:none;">
        <span id="msg_erro">Erro!</span>
    </div>
    <div class="row justify-content-center">
        <div class="" id="profile-manage">
            <!-- Profile Photo -->
            <div class="profile-photo-wrapper">
                <?php if ($this->session->userdata('logged_in') && $this->session->userdata('logged_in')['photo_path']): ?>
                    <div class="profile-photo">
                        <img src="<?php echo base_url($this->session->userdata('logged_in')['photo_path']); ?>"
                            alt="Foto de usuario">
                    </div>
                <?php else: ?>
                    <div class="profile-photo">
                        <!-- Default user photo -->
                        <img src="https://img.freepik.com/free-icon/user_318-159711.jpg" alt="Foto de usuario">
                    </div>
                <?php endif; ?>
                <div class="upload-btn" id="upload-btn" data-toggle="modal" data-target="#uploadModal">
                    <i class="bi bi-camera"></i>
                </div>
            </div>

            <h4 class=" mt-4 username" id="username">Olá,
                <?php echo $nome; ?>
            </h4>
            <div class="container">
                <p class="text-center" id="text-info">Veja todas as denúncias registradas ou edite os seus dados para
                    facilitar o
                    preenchimento de
                    denúncias</p>
            </div>
            <div class="profile-buttons container-sm">
                <div class="row full-vw">
                    <div class="container user-data-container">
                        <div class="user-info">

                            <span>Nome:</span>
                            <span>
                                <?php echo $nome; ?>
                            </span>
                            <hr class="solid">
                        </div>

                        <div class="user-info">
                            <span>Data de Nascimento:</span>
                            <span>
                                <?php echo $data_nascimento; ?>
                            </span>
                            <hr class="solid">
                        </div>

                        <div class="user-info">
                            <span>Email:</span>
                            <span>
                                <?php echo $email; ?>
                            </span>
                            <hr class="solid">
                        </div>

                        <div class="user-info">
                            <span>Telefone:</span>
                            <span>
                                <?php echo $telefone; ?>
                            </span>
                            <hr class="solid">
                        </div>

                        <div class="user-info">
                            <span>Observações:</span>
                            <span>
                                <?php echo $observacoes; ?>
                            </span>
                            <hr class="solid">
                        </div>
                        <a href="#" class="btn btn-orange full-vw " id="editarDados"><i class="bi bi-pencil-fill"></i>
                            Editar meus
                            dados</a>
                    </div>

                    <div class="container">
                        <div class="row conta-links">
                            <a class="disabled btn btn-secondary btn-warning ">
                                <i class="bi bi-clock-history"></i> Ver minhas denúncias anteriores
                            </a>
                            <a id="fazerLogout" class=" btn btn-secondary btn-danger">
                                <i class="bi bi-box-arrow-right"></i> Sair da conta
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>


        <!-- Modal for Photo Upload -->
        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Atualizar foto de perfil</h5>
                        <button type="button" class="close" id="btnCloseUpModal" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadForm" enctype="multipart/form-data">
                            <input type="file" name="user_photo" id="PhotoInput" accept="image/*">
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="uploadBtn">Atualizar foto</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Editar Dados Modal -->
        <div class="modal fade" id="editarDadosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Meus Dados</h5>
                        <button type="button" class="close" id="btnCloseEdModal" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- mensagens de erro e sucesso -->
                        <div class="alert alert-success" id="sucesso" role="alert" style="display:none;">
                            <span id="msg_sucesso">Sucesso!</span>
                        </div>
                        <div class="alert alert-danger" id="erro" role="alert" style="display:none;">
                            <span id="msg_erro">Erro!</span>
                        </div>
                        <form id="editarDadosForm">
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    value="<?php echo $nome; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="data_nascimento">Data de Nascimento</label>
                                <div class="input-group date">
                                    <input placeholder="Selecione a data" type="text" id="data_nascimento"
                                        class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    value="<?php echo $email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" name="telefone"
                                    value="<?php echo $telefone; ?>">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnSalvarDados">Salvar Mudanças</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>