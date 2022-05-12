<?php
    session_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        <title>Ouvidoria</title>
    </head>

    <body>

        <?php 
            include('navbar.php');
            include('destroy.php');
        ?>
        <style>
                div#cadastro{
                    display: none;
                }
                div#consulta{
                    display: none;
                }
                div#anonimo{
                    display: none;
                }
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

        function displaySwap(botao){

                if(botao == 'consultarBotao'){
                    document.getElementById('div_botao').style.display = 'none';
                    document.getElementById('anonimo').style.display = 'none';
                    document.getElementById('consulta').style.display = 'block';
                }else if(botao == 'abrirReclamacaoBotao'){
                    document.getElementById('div_botao').style.display = 'none';
                    document.getElementById('anonimo').style.display = 'none';
                    document.getElementById('cadastro').style.display = 'block';
                }else{
                    document.getElementById('div_botao').style.display = 'none';
                    document.getElementById('consulta').style.display = 'none';
                    document.getElementById('anonimo').style.display = 'block';
                }

        }

        function verificaForm(){
            if(document.getElementById("").value == ''){
                alert("debug");
                document.getElementById("field").style.display ="none";
            }
        }
    /*
        function trocatela(url){
            window.location = url;
        }
    */    
        // Função para mudar o tipo do display
        /*
        function displaySwapBotao(){ 
                document.getElementById('botao_seletor').style.display = 'none';
            document.getElementById('cadastro').style.display = 'block';      
        }
        */


        // Função para desabilitar campos por nome
        /*
        function disableForm(){
            if(document.getElementById('check_anon').checked){
                document.getElementsByName('caduser').forEach(e => {e.disabled = true;});
            }else{
                document.getElementsByName('caduser').forEach(e => {e.disabled = false;});
            }
        }
        */
        </script>
        <!--Define opção-->
        <div class="container-fluid" id="div_botao">
            
            <div class="col-md-6 col-md-offset-3">
            
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" id="abrirReclamacaoBotao" value="Abrir Reclamação" onclick="displaySwap('abrirReclamacaoBotao');"></button>
                </div>
                
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" id="abrirAnonimoBotao" value="Abrir reclamação anônimo" onclick="displaySwap('abrirAnonimoBotao')"></button>
                </div>         
                
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" id="consultarBotao" value="Consultar Reclamação" onclick="displaySwap('consultarBotao');"></button>
                </div>
            
            </div>
        
        </div>
        


        <!-- Pagina abrir Reclamacao -->
        <div class="container-fluid" id="cadastro">
            
            <div class="col-md-6 col-md-offset-3">
                
                <!-- Formulário de abrir reclamação Ouvidoria  -->
                <form method="POST">
                
                    <h2 class="text-center"> Cadastro de Reclamação </h2>

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

                    <!-- <input type="checkbox" id="check_anon" name="opcao" onchange="disableForm()"> Reclamação anônima
                    <br></br> -->

                    <div class="form-group col-md-12">
                        <label for="validationTextarea">Digite a reclamação abaixo:</label>
                        <textarea class="form-control is-invalid" id="validationTextarea" maxlength="1000" placeholder="Digite aqui!" rows="8" required></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-large btn-block btn-success" value="Enviar"></button>
                    </div>
                        
                </form>

            </div>
            
        </div>
        
        <!-- Abrir Reclamação Anônima -->
        <div class="container-fluid" id="anonimo">

            <div class="col-md-6 col-md-offset-3">
                <!-- Consultar codigo -->
                <h2 class="text-center"> Reclamação Anônima </h2>
    
                <form class="was-validated">

                    <div class="form-group col-md-12">
                        <label for="reclamacaoAnonima">Digite a reclamação abaixo:</label>
                        <textarea class="form-control is-invalid" id="reclamacaoAnonima" maxlength="1000" placeholder="Digite aqui!" rows="8" required></textarea>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-large btn-block btn-success" id="botaoAnon" value="Enviar"></button>
                    </div>

                </form>
    
            </div>
    
        </div>

        
        <!-- Consultar codigo de reclamação Ouvidoria -->
        <div class="container-fluid" id="consulta">

            <div class="col-md-6 col-md-offset-3">
                <!-- Consultar codigo -->
                <form method="POST">
            
                    <h2 class="text-center"> Consulta de Reclamação </h2>
                
                    <div class="form-group col-md-12" >
                        <label for="codigo">Código:</label>
                        <input name="codigo" class="form-control" type="number" placeholder="Codigo" pattern="[0-9]{12}"required id="dadosForm">
                    </div>
                
                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-large btn-block btn-success" value="Consultar"></button>
                    </div>
                
                </form>
            
            </div>
        
        </div>
    </body>

</html>