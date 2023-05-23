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
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
        </script>
        <!-- Consultar codigo de reclamação Ouvidoria -->
        <div class="container-fluid" id="consulta">

            <div class="col-md-6 col-md-offset-3">
                <!-- Consultar codigo -->
                <form action='' method="POST">
            
                    <h2 class="text-center"> Consulta para Resposta </h2>
                
                    <div class="form-group col-md-12" >
                        <label for="codigo">Protocolo:</label>
                        <input name="protocolo" class="form-control" placeholder="Código" id="protocolo">
                    </div>
                
                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-large btn-block btn-success" value="Consultar"></button>
                    </div>
                    
                    <div class="form-group col-md-12 table-responsive">
                        <div class="form-group col-md-6 table-responsive">          
                            <input type="checkbox" name="checkR" value="respondidos"/> Respondidos<br />
                            <input type="checkbox" name="checkN" value="naoRespondidos"/> Não respondidos<br />
                        </div> 
                        <div class="form-group col-md-3 table-responsive">
                            <label for="dataInicial">Data inicial :</label>
                            <br>
                            <input type="date" id="dataInicial" name="dataInicial" min="2022-04-01" max="2032-04-30">
                        </div>
                        <div class="form-group col-md-3 table-responsive">
                            <label for="dataFinal">Data final:</label>
                            <br>
                            <input type="date" id="dataFinal" name="dataFinal" min="2022-04-01" max="2032-04-30">
                        </div>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>PROTOCOLO</th>
                                <th>HORÁRIO</th>
                                <th>RESPOSTA</th>
                                <th>MANIFESTAÇÃO</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(isset($dadosPesquisa)){
                                        foreach($dadosPesquisa as $key=>$value):
                                ?>

                                    <tr>
                                        <?php
                                            $data = $value->dtHoraProtocolo;
                                            $gg = explode("-",$data);
                                            $ano = $gg[0];
                                            $mes=$gg[1];
                                            $dia=substr($gg[2],0,2);
                                            $horario = substr($gg[2],2);
                                            $dataConvertida = "$dia/$mes/$ano - $horario";
                                        ?>
                                        <td><?php echo $value->protocolo_id;?></td>
                                        <td><?php echo $dataConvertida;?></td>
                                        <td><?php
                                            try{
                                                    
                                                if(($value->resposta != '') || ($value->resposta != NULL)){
                                                    
                                                    echo "<a href='respostaADM?var=$value->protocolo_id'>Sim</a>";
                                                }else{
                                                    echo "<a href='respostaADM?var=$value->protocolo_id'>Não</a>";
                                                }        
                                            }catch(ErrorException $e){
                                                echo "<a href='respostaADM?var=$value->protocolo_id'>Não</a>";
                                            }
                                        ?></td>
                                        <?php
                                            $reclamacao = $value->reclamacao; 
                                        ?>
                                        <td title="<?php print $reclamacao;?>"><?php
                                          
                                                $tamanho = strlen($reclamacao);
                                                if($tamanho <= '30'){ 
                                                    echo $reclamacao;
                                                }else{
                                                    $cortada = substr($reclamacao, 0, 30);
                                                    echo $cortada."...";
                                                    
                                                }?></td>
                                    </tr>
                                            
                                <?php
                                        endforeach;        
                                    }
                                ?>    
                            </tbody>
                        </table>
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