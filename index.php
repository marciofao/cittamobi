<?php

ini_set("allow_url_fopen", 1);

$url='https://api.cittamobi.com.br/m3p/js/prediction/stop/5443184?fbclid=IwAR2V-YkrT_5XGH2hSaqxSn3t21cYdJk9xII4oPbfqyie0r5daOLnKrP_T6c';
$json = file_get_contents($url);
$dados=json_decode($json);

//var_dump($dados->services[0]->routeMnemonic);
die($dados->services[0]->routeMnemonic);