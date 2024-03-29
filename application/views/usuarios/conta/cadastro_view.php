<script src="<?php echo base_url(); ?>utils/js/moment.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/bootstrap-datepicker.min.css">
<script src="<?php echo base_url(); ?>utils/js/bootstrap-datepicker.min.js"></script>

<main class="d-flex">
    <div class="container d-flex flex-column">
        <!-- mensagens de erro e sucesso -->
        <div class="alert alert-success" id="sucesso" role="alert" style="display:none;">
            <span id="msg_sucesso">Sucesso!</span>
        </div>
        <div class="alert alert-danger" id="erro" role="alert" style="display:none;">
            <span id="msg_erro">Erro!</span>
        </div>
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Vamos começar!</h1>
                        <p class="lead">
                            Crie uma conta para preencher denúncias mais rápido e ver as anteriores
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form class="register-form">
                                    <div class="mb-3">
                                        <label class="form-label"> Nome completo </label>
                                        <input class="form-control form-control" type="text" name="nome" id="nome"
                                            placeholder="Digite seu nome" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control" type="email" name="email" id="email"
                                            placeholder="Digite seu email" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="telefone_user">Telefone de contato</label>
                                        <input type="text" class="form-control" id="telefone" name="telefone"
                                            placeholder="Digite o seu número">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="data_nascimento">Data de Nascimento</label>
                                        <div class="input-group date">
                                            <input placeholder="Selecione a data" type="text" id="data_nascimento"
                                                class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Senha</label>
                                        <input class="form-control form-control" type="password" name="senha" id="senha"
                                            placeholder="Crie uma senha" />
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <a class="btn btn-primary " id="btnCadastrarUsuario">Cadastrar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        Já tem uma conta? <a href="login_controller">Entrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="verificationModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="bi bi-patch-check-fill"></i>
                <h5 class="modal-title">Verifique seu email</h5>
            </div>
            <div class="modal-body">
                <div class="alert alert-success" id="sucesso" role="alert" style="display:none;">
                    <span id="msg_sucesso">Sucesso!</span>
                </div>
                <div class="alert alert-danger" id="erro" role="alert" style="display:none;">
                    <span id="msg_erro">Erro!</span>
                </div>
                <p> Enviamos um código no seu email. Por favor digite corretamente abaixo para finalizar seu cadastro. O
                    código será válido por 10 minutos
                </p>
                <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="codigo_verificar" name="email_atual_vitima"
                        placeholder="Digite o código enviado no email">
                </div>
            </div>
            <div class="modal-footer">
                <button id="verifyBtn" type="button" class="btn btn-success">Verificar código</button>
            </div>
        </div>
    </div>
</div>