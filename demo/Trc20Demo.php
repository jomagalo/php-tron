<?php
require('../vendor/autoload.php');

// Transfiere Token EURT, DTV, etc indicando la dirección del contrato del token en linea 19 y la clave privada de la dirección tether que posee los tokens
// Ojo los toquen que usan decimales para enviar 1 token seria la cantidad de token y el numero de decimales en ceros. Ejem 6 decimales: 1 = 1000000. En linea 52
// Linea 49 la dirección de destino

use TronTool\TronKit;
use TronTool\TronApi;
use TronTool\Credential;

$fromKey = '47e6adbcced1d0353597731b1b2f1c16533f0a2f85f796bb1e4128e50b332c18'; // clave privada de la wallet que creó los tokens
$credential = Credential::fromPrivateKey($fromKey);
$from = $credential->address()->base58();
echo 'from address => ' . $from . PHP_EOL;

$kit = new TronKit(TronApi::testNet(),$credential); // testNet o mainNet

$contractAddress = 'TDiWSFL8S9v5Lc1YrkR5SUJtPahKULbWZg'; // dirección de contrato del token
echo 'contract address => ' . $contractAddress . PHP_EOL;
$inst = $kit->trc20($contractAddress);

function query(){
  global $inst,$from;
  
  echo 'query trc20 token info...' . PHP_EOL;
  
  $balance = $inst->balanceOf($from);
  echo 'balance => ' . $balance . PHP_EOL;
  
  $supply = $inst->totalSupply();
  echo 'total supply => ' . $supply . PHP_EOL;
  
  $name = $inst->name();
  echo 'name => ' . $name . PHP_EOL;
  
  $symbol = $inst->symbol();
  echo 'symbol => ' . $symbol . PHP_EOL;
  
  $decimals = $inst->decimals();
  echo 'decimals => ' . $decimals .PHP_EOL;
}

function transfer(){
  global $inst;
  
  echo 'transfer trc20 token...' . PHP_EOL;
  
  $to = 'TZAwPJSw2Wdrh4Pe8BzKjCyYumqRJgPnzX'; // wallet destino
  echo  'to addres => ' . $to . PHP_EOL;
  
  $ret = $inst->transfer($to,1000000); // ojo si el token tiene decimaes ejem con 6 decimales 1 token = 1000000
  echo 'txid => ' . $ret->tx->txID . PHP_EOL;
  echo 'result => ' . $ret->result . PHP_EOL;
}

function events(){
  global $inst;
  
  echo 'fetch trc20 token events...' . PHP_EOL;
  $since = 0;
  $events = $inst->events($since);
  foreach($events as $event){
    echo 'event name => ' . $event->event_name . ' | timestamp => ' . $event->block_timestamp . PHP_EOL;
    foreach($event->result_type as $key=>$_){
      echo '  ' . $key . ' => ' . $event->result->$key . PHP_EOL;
    }
  }
}

query();
transfer();
events();
