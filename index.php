<link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
<?php

ini_set("allow_url_fopen", 1);

$url='https://api.cittamobi.com.br/m3p/js/prediction/stop/5443184?fbclid=IwAR2V-YkrT_5XGH2hSaqxSn3t21cYdJk9xII4oPbfqyie0r5daOLnKrP_T6c';
$json = file_get_contents($url);
$dados=json_decode($json);

//var_dump($dados->services[0]); die($dados->services[0]->routeMnemonic);

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
    <ul>
        <?php foreach ($dados->services as $key=>$service):?>
            <?php if($service->serviceId==$codigo): ?>
                <?php // var_dump((array) $service);die; ?>
                <?php foreach ( (array) $service as $k=>$item): ?>
                    <?php if(is_array($item)): ?>
                        <?php  //var_dump($item);die; ?>
                        <li><?php echo $k ?>:</li>
                        <?php if(sizeof($item)>0): ?>
                            <ul>
                                <?php foreach ($item as $v): ?>
                                    <li><?php echo $v ?> </li>
                                <?php endforeach ?>
                            </ul>
                        <?php endif ?>
                    <?php else: ?>
                        <li><?php echo $k ?>: <?php echo $item ?> </li>
                    <?php endif ?>
                <?php endforeach ?>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
    <a href="javascript:history.back()  ">< voltar</a>

    <?php
}

?>
