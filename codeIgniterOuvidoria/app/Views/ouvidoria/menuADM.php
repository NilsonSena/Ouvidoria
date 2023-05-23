
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <title>Menu ADM</title>
    </head>
    <script>
        if(window.history.replaceState){
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
    <body>

        <?php 
            include('navbar.php');
        ?>
             
    <!--Define opção-->
        <div class="container-fluid" id="div_botao">
            
            <div class="col-md-6 col-md-offset-3">

                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" id="respostaADM" value="Responder Manifestação" onclick="window.location.href = 'responderADM'"></button>
                </div>

                <?php
                    if(isset($dadosPesquisa)){
                        
                      ?>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-large btn-block btn-success" id="criarUsuario" value="Cria usuário" onclick="window.location.href = 'criaUsuario'"></button>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-large btn-block btn-success" id="redefineSenha" value="Redefinir Senha" onclick="window.location.href = 'redefineSenha'"></button>
                        </div>
                <?php
                      
                    }
                    
                ?>
                         
            </div>
        
        </div>

    </body>

</html>