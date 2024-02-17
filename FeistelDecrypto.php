<?php

namespace Cryp;
use Exception;
use Cryp\CryptoFeistel;

class FeistelDecrypto{
    
    private string $L0;
    private string $R0;   
    private string $L1;
    private string $R1;
    private string $REncrypto;
    private string $decryptoBits;

    public function __construct(
        private string $cryptoBits
    ) {
        $this->divide($cryptoBits);
    }

    public function divide(string $cryptoBits)
    {
        if (strlen($cryptoBits) != 8)
        {
            throw new Exception("Necessário 8 bits");
        }
        
        $this->L1 = $this->R0 = substr($cryptoBits,0,4);
        $this->L0 = $this->R1 = substr($cryptoBits,4,7);
    }

    public function encryptR0()
    {
        $result = substr($this->R0,-2,1).substr($this->R0,-4,1).substr($this->R0,-1,1).substr($this->R0,-3,1);
        $this->REncrypto = $result;
        $this->L0 = (CryptoFeistel::xorStrings($this->R1,$this->REncrypto));
        $this->decryptoBits = $this->L0.$this->R0;
    }

    public function getDecryptoBits(){
        return $this->decryptoBits;
    }


}