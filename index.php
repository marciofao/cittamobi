<?php session_start()  ?>
<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
<?php

ini_set("allow_url_fopen", 1);

$url='https://api.cittamobi.com.br/m3p/js/prediction/stop/5443184?fbclid=IwAR2V-YkrT_5XGH2hSaqxSn3t21cYdJk9xII4oPbfqyie0r5daOLnKrP_T6c';

//valida se dados estão na sessão e se ja faz mais de 10 minutos que foi buscado os dados
if(isset($_SESSION['cittamobi_data'])&&$_SESSION['cittamobi_timestamp']>(time()-600)){
    //restaura dados armazenados em sessão
    $dados = $_SESSION['cittamobi_data'];
}else{
    //busca dados na api
    $json = file_get_contents($url);
    $dados=json_decode($json);
    //armazena dados na sessao como cache
    $_SESSION['cittamobi_data'] = $dados;
    $_SESSION['cittamobi_timestamp'] = time();
}



if(isset($_GET['c'])){
    detalha_servico($_GET['c'], $dados);
    die;
}
?>

<h1>Selecione um Serviço</h1>
<ul>
<?php foreach ($dados->services as $service):?>
    <li><a href="?c=<?php echo( $service->serviceId) ?>"><?php echo $service->serviceMnemonic ?></a></li>
<?php endforeach ?>
</ul> 

<?php 

function detalha_servico($codigo, $dados=null){
    ?>
 <a href="javascript:history.back()">< voltar</a>
    <h1>Detalhes do Serviço</h1>
    
        <?php foreach ($dados->services as $service):?>
            <?php if($service->serviceId==$codigo): ?>
                <?php lista_itens($service) ?>
                
            <?php endif ?>
        <?php endforeach ?>
   
    <a href="javascript:history.back()  ">< voltar</a>

    <?php
}

function lista_itens($service){
    echo '<ul>';
    foreach ( (array) $service as $k=>$item){
        if(is_array($item) || is_object($item)){
            if(sizeof((array)$item)>0){
                lista_itens($item);
            } 
        }else{
            echo '<li>'.$k.': '.$item.'</li>';
        }
    }
    echo '</ul>';
}
?>
