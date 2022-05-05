<?php
require('../vendor/autoload.php');

use TronTool\TronKit;
use TronTool\TronApi;
use TronTool\Credential;

$api = TronApi::testNet();
$credential = Credential::fromPrivateKey('47e6adbcced1d0353597731b1b2f1c16533f0a2f85f796bb1e4128e50b332c18');
$kit = new TronKit($api,$credential);
$from = $credential->address()->base58();
echo 'from address => ' . $from . PHP_EOL;

echo 'load contract abi and bytecode...' . PHP_EOL;
$abi = file_get_contents('./contract/build2/JomagaloToken.abi');
$bytecode = file_get_contents('./contract/build2/JomagaloToken.bin');

echo 'deploy contract...' . PHP_EOL;
$inst = $kit->contract($abi)->bytecode($bytecode);
$ret = $inst->deploy(1000000,'DONTV COIN',0,'DTV');
echo 'txid => ' . $ret->tx->txID . PHP_EOL;
echo 'contract address => ' . $ret->tx->contract_address . PHP_EOL;
echo 'result => ' . $ret->result . PHP_EOL;

