<?php
require('../vendor/autoload.php');

// Transfiere TRX
// Ojo los tokens que usan decimales para enviar 1 token seria 1000000. En linea 23
// Linea 21 la dirección de destino

use TronTool\TronKit;
use TronTool\TronApi;
use TronTool\Credential;

$api = TronApi::testNet(); // testNet o mainNet
$credential = Credential::fromPrivateKey('47e6adbcced1d0353597731b1b2f1c16533f0a2f85f796bb1e4128e50b332c18'); // clave privada de la wallet que envia TRX
$kit = new TronKit($api,$credential);

$from = $credential->address()->base58();
echo 'from address => ' . $from . PHP_EOL;
$balance = $kit->getTrxBalance($from);
echo 'from adress balance(trx) => ' . $balance . PHP_EOL;

$to = 'TZAwPJSw2Wdrh4Pe8BzKjCyYumqRJgPnzX'; // wallet de destino
echo 'send trx to ' . $to . '...' . PHP_EOL;
$ret = $kit->sendTrx($to,1000000,$from); // ojo si el token tiene decimaes ejem con 6 decimales 1 token = 1000000
echo 'txid => ' . $ret->txid . PHP_EOL;
echo 'result => ' . $ret->result . PHP_EOL;

$balance = $kit->getTrxBalance($from);
echo 'from adress balance(trx) => ' . $balance . PHP_EOL;
