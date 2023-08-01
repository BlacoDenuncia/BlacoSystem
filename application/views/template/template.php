<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
   <!-- Load custom styles -->
   <!--<link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/app.css">-->
   <link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/bootstrap.min.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/font-awesome.min.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/bootstrap-icons.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/custom_style.css">
   <link rel="stylesheet" href="<?php echo base_url(); ?>utils/styles/bootstrap-datepicker.min.css">

   <!-- Load external JavaScript -->
   <script src="<?php echo base_url(); ?>utils/js/bootstrap.bundle.min.js"></script>
   <script src="<?php echo base_url(); ?>utils/js/jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>utils/js/moment.js"></script>
   <script src="<?php echo base_url(); ?>utils/js/jquery.mask.min.js"></script>
   <script src="<?php echo base_url(); ?>utils/js/bootstrap-datepicker.min.js"></script>
   <script>
      var base_url = "<?php echo base_url(); ?>";
   </script>
   <title>Blaco - Denuncie</title>
</head>

<body>
   <!--
         1 - classe responsiva principal
         2 - content
         3 - menu
         -->
   <div class="container-fluid no-padding no-overlap">
      <div class="content container-fluid">
         <?php
         echo $content;
         ?>
      </div>

      <?php
      echo $menu;
      ?>
      <!--modal de conxão com internet-->
      <div id="modalDesconectado" class="modal fade" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <i class="bi bi-wifi-off"></i>
                  <h5 class="modal-title">Sem conexão com a internet</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <p>Por favor verifique sua conexão com a internet e tente novamente.
                     Enquanto isso, que tal acessar a <a href="Conteudo_controller"> área didática?</a>
                  </p>
               </div>
               <div class="modal-footer">
                  <button id="btnChecaInternet" type="button" class="btn btn-secondary">TENTAR
                     NOVAMENTE</button>
               </div>
            </div>
         </div>
         <!--error modal-->
         <div class="modal" id="errorModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Error</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body"></div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--modal email invalido-->
      <div id="modalEmailInvalido" class="modal fade" tabindex="-1" role="dialog">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <i class="bi bi-wifi-off"></i>
                  <h5 class="modal-title">Email inválido</h5>
                  <button type="button" id="btn-close" class="btn-close" data-bs-dismiss="modal"
                     aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  <!-- mensagens de erro e sucesso do modal -->
                  <div class="alert alert-success" id="sucesso-modal" role="alert" style="display:none;">
                     <span id="msg_sucesso_modal">Sucesso!</span>
                  </div>
                  <div class="alert alert-danger" id="erro-modal" role="alert" style="display:none;">
                     <span id="msg_erro_modal">Erro!</span>
                  </div>
                  <p>Tivemos problemas ao enviar os dados da denúncia ao seu email. Verifique se o email abaixo é o
                     correto.</p>
                  <p id="emailDigitado"></p>
                  <form>
                     <div class="form-group col-md-12">
                        <label class="form-label" for="email_atual_vitima"> Digite o email correto abaixo, ou feche este
                           aviso caso não queira um registro </label>
                        <input type="email" class="form-control" id="email_atual_vitima" name="email_atual_vitima"
                           placeholder="Digite novamente seu email">
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
                  <button id="btnEnviarEmail" type="button" class="btn btn-danger">TENTAR
                     NOVAMENTE</button>
               </div>

            </div>
         </div>


         <!--error modal-->
         <div class="modal" id="errorModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Error</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body"></div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--importa scripts após carregamento da página-->
   <script src="<?php echo base_url(); ?>utils/js/app.js"></script>
   <script src="<?php echo base_url(); ?>utils/js/custom_script.js"></script>
   <script src="<?php echo base_url(); ?>utils/js/boletim.js"></script>
   <script src="<?php echo base_url(); ?>utils/js/login_user.js"></script>
</body>

</html>