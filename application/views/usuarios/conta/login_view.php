<!-- mensagens de erro e sucesso -->
<div class="alert alert-success" id="sucesso" role="alert" style="display:none;">
    <span id="msg_sucesso">Sucesso!</span>
</div>
<div class="alert alert-danger" id="erro" role="alert" style="display:none;">
    <span id="msg_erro">Erro!</span>
</div>
<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Faça seu login</h1>
                        <p class="lead">
                            Entre na sua conta para ver denúncias antigas e atualizar seus dados
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form class="register-form">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control form-control" type="email" id="email" name="email"
                                            placeholder="Digite seu email" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Senha</label>
                                        <input class="form-control form-control" type="password" id="senha"
                                            name="senha" placeholder="Digite sua senha" />
                                    </div>
                                    <!--<div>
                                        <div class="form-check align-items-center">
                                            <input id="customControlInline" type="checkbox" class="form-check-input"
                                                value="remember-me" name="remember-me" checked>
                                            <label class="form-check-label text-small"
                                                for="customControlInline">Remember me</label>
                                        </div>
                                    </div>-->
                                    <div class="d-grid gap-2 mt-3">
                                        <a id="btnFazerLogin" class="btn btn-primary ">Entrar</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        Não tem uma conta? <a href="cadastro_controller">Fazer cadastro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>