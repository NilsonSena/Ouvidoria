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
                document.getElementById("botaoReclamacao").disabled = false;
            }else{
                document.getElementById("botaoReclamacao").disabled = true;
            }

        }
    </script>

    <body>

        <?php 
            include('navbar.php');
            include('termos.php');
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

        <!-- Pagina abrir Reclamacao -->
        <div class="container-fluid" id="cadastro">
                
            <div class="col-md-6 col-md-offset-3">
                    
                <!-- Formulário de abrir reclamação Ouvidoria  -->
                <form action="exibeProtocolo" method="POST">
                
                    <h2 class="text-center"> Cadastro de Manifestação Identificada </h2>

                    <div class="form-group col-md-12" >
                        <label for="nome">Nome:</label>
                        <input name="cadNome" class="form-control" type="text" placeholder="Nome" required>
                    </div>

                    <div class="form-group col-md-12" >
                        <label for="email">E-mail:</label>
                        <input name="cadEmail" class="form-control" type="email" placeholder="teste@teste.com" required>
                    </div>

                    <div class="form-group col-md-12" >
                        <label for="telefone">Telefone (ddd+numero):</label>
                        <input name="cadTel" class="form-control" type="tel" pattern="[0-9]{12}" placeholder="Ex:031987654321" required>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="cadReclamacao">Digite a manifestação abaixo:</label>
                        <textarea name="cadReclamacao" class="form-control is-invalid" id="cadReclamacao" maxlength="1000" placeholder="Digite aqui!" rows="8" required></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <input type="checkbox" id="checkT" name="checkT" value="aceito" onclick="checkado()"/> Concordo com os <a data-toggle="modal" href="#myModal">termos</a><br />
                    </div>
                    <div class="form-group col-md-12">
                        <input id="botaoReclamacao" type="submit" class="btn btn-large btn-block btn-success" value="Abrir manifestação Identificada" disabled></button>
                    </div>
                            
                </form>

            </div>
                
        </div>

    </body>

</html>