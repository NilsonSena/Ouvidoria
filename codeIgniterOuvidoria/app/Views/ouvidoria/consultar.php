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
       

        
        <!-- Consultar codigo de reclamação Ouvidoria -->
        <div class="container-fluid" id="consulta">

            <div class="col-md-6 col-md-offset-3">
                <!-- Consultar codigo -->
                <form action='' method="POST">
            
                    <h2 class="text-center"> Consulta de Manifestação </h2>
                
                    <div class="form-group col-md-12" >
                        <label for="codigo">Protocolo:</label>
                        <input name="protocolo" class="form-control" placeholder="Código" required id="protocolo">
                        <label for="senha">Senha:</label>
                        <input name="senhaProtocolo" class="form-control" placeholder="Senha do Protocolo" required id="senhaProtocolo" type="password">
                    </div>
                
                    <div class="form-group col-md-12">
                        <input type="submit" class="btn btn-large btn-block btn-success" value="Consultar"></button>
                    </div>
                    
                    <?php
                            if(isset($dadosPesquisa)){?>
                        <div class="form-group col-md-12 table-responsive">          
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
                                        if(!isset($dadosPesquisa)){
                                            echo '<tr>No data found</tr>';
                                        }else{
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
                                                            //echo "<a onclick>Sim</a>";
                                                            echo "<a href='resposta?var=$value->protocolo_id'>Sim</a>";
                                                        }else{
                                                            echo "<a href='resposta?var=$value->protocolo_id'>Não</a>";
                                                        }        
                                                    }catch(ErrorException $e){
                                                        echo "<a href='resposta?var=$value->protocolo_id'>Não</a>";
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
                    <?php
                        }
                    ?>    
                    
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