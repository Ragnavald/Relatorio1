<?php

use Cryp\{CryptoFeistel, FeistelDecrypto};

require 'FeistelCrypto.php';
require 'FeistelDecrypto.php';

$opt = readline("Digite C para Criptografar ou D para Descriptografar: ");

$bits = readline("Digite os 8 bits: ");

if(strtolower($opt) == "c"){
    $Feistel = new CryptoFeistel($bits);
    
    echo("bits original = ".$Feistel->getBits().PHP_EOL);
    
    echo("R0 = ".$Feistel->getR0().PHP_EOL);
    echo("L0 = ".$Feistel->getL0().PHP_EOL);
    
    $Feistel->functionCryp().PHP_EOL;
    
    echo("E = ".$Feistel->getE().PHP_EOL);
    
    echo("R1 = ".$Feistel->getR1().PHP_EOL);
    echo("L1 = ".$Feistel->getL1().PHP_EOL);
    echo("bits criptografados = ".$Feistel->getCryptoText().PHP_EOL);

}elseif (strtolower($opt) == "d") {

    $Feistel = new FeistelDecrypto($bits);
        
    $Feistel->encryptR0().PHP_EOL;
    
    echo("bits Descriptografados = ".$Feistel->getDecryptoBits().PHP_EOL);


}


