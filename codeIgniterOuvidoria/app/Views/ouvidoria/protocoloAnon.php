<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <title>Ouvidoria</title>
    </head>

    <style type="text/css">
        html { text-align: center }
        p {font-size: 30px}
    </style>
    
    <body>

        <?php 
            include('navbar.php');

        ?>

        <div class="container">

            <table  class="table">
                
                <tr>
                    <p><b>Protocolo de manifestação:</b></p>
                </tr>
                
                <br>
                <br>
                
                <tr>
                    <p style="color: red"> <b><?=$protocolo; ?></b></p>
                </tr>
                
                <br>
                <tr>
                    <p><b>Senha de acesso:</b></p>
                </tr>
                <br>
                <br>
                <tr>
                    <p style="color: red"> <b><?=$senha; ?></b></p>
                </tr>
                
                <tr>
                    <td></td>
                    <th>Sua manifestação foi registrada na data e horário: <?=$horario; ?></th>
                </tr>
            
            </table>
            
            <?php
                print_r("Se deseja fazer outra manifestação clique <a href=./index.php>Aqui</a>");
            ?>
        
        </div>

    </body>

</html>