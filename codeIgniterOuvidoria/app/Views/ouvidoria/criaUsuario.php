
<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <title>Ouvidoria</title>
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
        <style>
                /* retira a rolagem para o input="numbers" */
                /* Chrome, Opera, Safari, EDGE */
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }

                /* Firefox */
                input[type=number] {
                    -moz-appearance: textfield;
                }
                /* Não permite aumentar ou diminuir a area de texto */
                textarea {
                    resize: none;
                }
                
        </style>
        <script type="text/javascript">

            function verificaForm(){
                if(document.getElementById("").value == ''){
                    alert("debug");
                    document.getElementById("field").style.display ="none";
                }
            }

        </script> 

        <!-- Pagina abrir Reclamacao -->
        <div class="container-fluid" id="cadastro">
                
            <div class="col-md-6 col-md-offset-3">
                    
                <!-- Formulário de abrir reclamação Ouvidoria  -->
                <form action="" method="POST">
                
                    <h2 class="text-center"> Criar usuário </h2>

                    <div class="form-group col-md-12" >
                        <label for="nome">Nome:</label>
                        <input name="login" class="form-control" type="text" placeholder="Login" required>
                    </div>

                    <div class="form-group col-md-12" >
                        <label for="senha">Senha:</label>
                        <input name="senha" class="form-control" type="password" placeholder="Senha" required>
                    </div>

                    <div class="form-group col-md-12" >
                        <input type="checkbox" name="check" value="1"/> Admin<br />
                    </div>

                    <div class="form-group col-md-12">
                        <input id="botaoCriarUser" type="submit" class="btn btn-large btn-block btn-success"></button>
                    </div>
                    
                    <br></br>

                    <?php
                    if(isset($dados)){
                        if($dados == "vazio"){
                        
                            ?>
                                <div class="form-group col-md-12">
                                    <p style="color: red; text-align: center">Usuário criado com sucesso!</p>
                                </div>
                            <?php
                            
                        }
                        if($dados == "existe"){
                            ?>
                            <div class="form-group col-md-12">
                                <p style="color: red; text-align: center">Já existe um usuário com esse nome!</p>
                            </div>
                            <?php
                        }
                    }        
                    ?>
                    
                </form>

            </div>
                
        </div>

    </body>

</html>