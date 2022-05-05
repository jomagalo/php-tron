<?php
require('../vendor/autoload.php');

// Para crear una dirección nueva, se utiliza la clave privada de la wallet tether en linea 20
// La wallet tether creada sirve para recibir cualquir token posteriormente

use TronTool\Credential;

echo 'create a new address...' . PHP_EOL;
echo "</br>";
$credential = Credential::create();
echo 'private key => ' . $credential->privateKey() . PHP_EOL;
echo "</br>";
echo 'public key => ' . $credential->publicKey() . PHP_EOL;
echo "</br>";
echo 'address => ' . $credential->address() . PHP_EOL;
echo "</br>";
echo 'import an existing private key...' . PHP_EOL;
echo "</br>";
$credential = Credential::fromPrivateKey('47e6adbcced1d0353597731b1b2f1c16533f0a2f85f796bb1e4128e50b332c18'); // clave privada
echo 'private key => ' . $credential->privateKey() . PHP_EOL;
echo "</br>";
echo 'public key => ' . $credential->publicKey() . PHP_EOL;
echo "</br>";
echo 'address => ' . $credential->address() . PHP_EOL;
echo "</br>";
