<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Load custom styles --> 
      <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/font-awesome.min.css">
      <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/bootstrap-icons.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
      <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/custom_style.css">
      <!-- Load external JavaScript -->
      <script src="<?php echo base_url();?>utils/js/bootstrap.bundle.min.js"></script>
      <title>Blaco - Denuncie</title>
   </head>
   <body>
      <!--
         1 - classe responsiva principal
         2 - content
         3 - menu
         -->
      <div class="container-fluid no-padding no-overlap">
         <?php 
            echo $content;    
            ?>
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
                     <button id="btnChecaInternet"type="button" class="btn btn-secondary" data-bs-dismiss="modal">TENTAR NOVAMENTE</button>
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
      <script src="<?php echo base_url();?>utils/js/jquery.min.js"></script>
      <script src="<?php echo base_url();?>utils/js/custom_script.js"></script>
   </body>
</html>