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
        function checkado(){
            
            var checkbox = document.getElementById("checkT");
            if(checkbox.checked == true){
                document.getElementById("botaoAnon").disabled = false;
            }else{
                document.getElementById("botaoAnon").disabled = true;
            }

        }
    </script>

    <body>

        <?php 
            include('navbar.php');
            include('termos.php')
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

        <!-- Abrir Reclamação Anônima -->
        <div class="container-fluid" id="anonimo">

            <div class="col-md-6 col-md-offset-3">
                <!-- Consultar codigo -->
                <h2 class="text-center"> Manifestação Anônima </h2>
    
                <form action="protocoloAnon" method="POST">

                    <div class="form-group col-md-12">
                        <label for="reclamacaoAnonima">Digite a manifestação abaixo:</label>
                        <textarea class="form-control is-invalid" name="reclamacaoAnonima" id="reclamacaoAnonima" maxlength="1000" placeholder="Digite aqui!" rows="8" required></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="checkbox" id="checkT" name="checkT" value="aceito" onclick="checkado()"/> Concordo com os <a data-toggle="modal" href="#myModal">termos</a><br />
                    </div>
                    
                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-large btn-block btn-success" id="botaoAnon" value="Enviar" disabled></button>
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