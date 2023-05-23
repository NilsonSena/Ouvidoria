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
    <script>
        if(window.history.replaceState){
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <body>

        <?php 
            include('navbar.php');
        ?>

    <div class="container-fluid">
        <div class="col-md-6 col-md-offset-3 painel-login">
            <form action="menuADM" method="POST" >
                <h2 class="text-center"> Área de Login </h2>
                <div class="form-group col-md-12">
                    <label for="usuario">Usuário:</label>
                    <input name="usuario" class="form-control" type="text" required>
                </div>

                <div class="form-group col-md-12">
                    <label for="senha">Senha:</label>
                    <input name="senha" class="form-control" type="password" required>
                </div>

                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" value="Entrar"></button>
                </div>
                
                <div class="col-md-12 text-center">   
                    <?php
                        if(isset($_POST["erro"])) {
                            echo '<span class="alert alert-danger col-md-12">' . $_POST["erro"] . '</span>';
                        }
                    ?>
                </div>
            
            </form>
        </div>
    </div>

</body>

</html>