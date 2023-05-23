<!DOCTYPE html>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
        
        <link href="/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/favicon.ico'); ?>">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        
        <title>Ouvidoria</title>
        
    </head>
    

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
        
        <!-- Define opção -->
        <div class="container-fluid" id="div_botao">
            
            <div class="col-md-6 col-md-offset-3">

                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" id="abrirReclamacaoBotao" value="Abrir manifestação" onclick="window.location.href = 'cadReclamacao'"></button>
                </div>
                
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" id="abrirAnonimoBotao" value="Abrir manifestação anônima" onclick="window.location.href = 'anonReclamacao'"></button>
                </div>         
                
                <div class="form-group col-md-12">
                    <input type="submit" class="btn btn-large btn-block btn-success" id="consultarBotao" value="Consultar manifestação" onclick="window.location.href = 'consultar'"></button>
                </div>
            
            </div>
        
        </div>        
        
    </body>

</html>