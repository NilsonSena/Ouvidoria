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
    <script type="text/javascript">

        function disableTextArea(){
            
            document.getElementById("resposta").disabled = true;
            document.getElementById("sei").disabled = true;
        }   
        
    </script>
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
                textarea#resposta{
                    disabled:disabled;
                }
                div.disabled {
                    
                }
                .disabled:after {
                    width: 100%;
                    height: 100%;
                    position: absolute; 
                }
            
        </style>
        <script>
            if(window.history.replaceState){
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <!-- Responder Reclamação -->
        <div class="container-fluid" id="respondeReclamacao">

            <div class="col-md-6 col-md-offset-3">
                <!-- Visualiza Reclamação -->
                <h2 class="text-center"> Resposta de Manifestação </h2>
    
               

                <div class="form-group col-md-12">
                    <label for="reclamacao">Manifestação abaixo:</label>
                    <textarea class="form-control is-invalid" name="reclamacao" id="reclamacao" maxlength="1000" rows="8" disabled><?php 
                        if(!isset($dadosPesquisa)){
                            echo '<tr>No data found</tr>';
                        }else{
                            foreach($dadosPesquisa as $key=>$value):
                                    echo $value->reclamacao;        
                                
                            endforeach;        
                        }
                    ?></textarea>
                </div>
                <form action="respostaADM" method="POST">
                    <div style='display: none;'>
                        <textarea class="form-control is-invalid" name="protocolo" id="protocolo" maxlength="50"><?php echo $_SESSION['protocolo']?></textarea>
                    </div>
                    
                    <div class="form-group col-md-12">
                    
                        <label for="reclamacao">Digite a resposta no campo abaixo:</label>        
                        
                        <textarea class="form-control is-invalid" name="resposta" id="resposta" maxlength="1000" rows="8" required><?php 
                            if(!isset($dadosPesquisa)){
                                echo '<tr>No data found</tr>';
                            }else{
                                foreach($dadosPesquisa as $key=>$value):
                                        echo $value->resposta;        
                                    
                                endforeach;        
                            }
                        ?></textarea>
                                       
                        <label for="sei">SEI:</label>
                        <textarea class="form-control is-invalid" name="sei" id="sei" maxlength="1000" ><?php 
                            if(!isset($dadosPesquisa)){
                                echo '<tr>No data found</tr>';
                            }else{

                                foreach($dadosPesquisa as $key=>$value):
                                    echo $value->sei;        
                                    
                                endforeach;

                                foreach($dadosResposta as $key=>$value):
                                    
                                    $data = $value->dtHoraResposta;
                                    $gg = explode("-",$data);
                                    $ano = $gg[0];
                                    $mes=$gg[1];
                                    $dia=substr($gg[2],0,2);
                                    $horario = substr($gg[2],2);
                                    $dataConvertida = "$dia/$mes/$ano - $horario";
                                
                                endforeach;        
                            }
                        ?></textarea>
                        
                        
                        <?php
                            if(isset($dataConvertida)){
                                echo 'Respondido no dia e horário: '.$dataConvertida;
                            }        
                        ?>

                        <br>
                        <br>
                        <div class="form-group col-md-12">
                            <input type="submit" class="btn btn-large btn-block btn-success" id="respondeBotao" value="Responder"></button>
                        </div>
                        
                    </div>    
                
                </form>

                <div class="col-md-12 text-center">   
                    <?php
                        if(isset($_POST["erro"])) {
                            echo '<span class="alert alert-danger col-md-12">' . $_POST["erro"] . '</span>';
                        }
                    ?>
                </div>

            </div>
    
        </div>
    
    </body>

</html>