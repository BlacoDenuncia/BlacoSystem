<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Load custom styles --> 
    <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/custom_style.scss">
    <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>utils/styles/bootstrap-icons.css">
    
    <!-- Load external JavaScript -->
    <script src="<?php echo base_url();?>utils/js/bootstrap.bundle.min.js"></script>
    
    <title>Blaco - Denuncie</title>
</head>
<body>
    <!--
        1 - classe responsiva principal
        2 - content
        3 - menu
        Fazer estrutura normal completa, depois separar e substituir por echo no local
    -->
    <div class="container-fluid">
        <?php 
            echo $content;    
        ?>
        <?php
            echo $menu;
        ?>
    </div>
    <script src="<?php echo base_url();?>utils/js/custom_script.js"></script>
</body>
</html>