<?php

namespace Cryp;
use Exception;

Class CryptoFeistel{

    private string $L0;
    private string $R0;   
    private string $L1;
    private string $R1;
    private string $E;
    private string $cryptoBits;

    public function __construct(
        private string $bits
    ) {
        $this->divide($bits);
    }

    public function divide(string $bits):void
    {
        if (strlen($bits) != 8)
        {
            throw new Exception("Necessário 8 bits");
        }
        
        $this->L0 = substr($bits,0,4);
        $this->L1 = $this->R0 = substr($bits,4,7);
    }

  /* 1º -> 2º
     2º -> 4º
     3º -> 1º
     4º -> 3º */
    public function functionCryp():string
    {
        $result = substr($this->R0,-2,1).substr($this->R0,-4,1).substr($this->R0,-1,1).substr($this->R0,-3,1);
        $this->E = $result;
        $this->R1 = $this->xorStrings($this->L0,$result);
        $this->cryptoBits = $this->L1.$this->R1;
        return $result;
    }
    
    static public function xorStrings(string $L0, string $E):string
    {
     $xor = '';
        for ($i=0; $i < strlen($L0); $i++) { 
            $xor .= intval($L0[$i]) ^ intval($E[$i]);  
        }
        return $xor;
    }


    public function getCryptoText():string
    {
        return $this->cryptoBits;
    }
    public function getL0()
    {
        return $this->L0;
    }

    public function getR0()
    {
        return $this->R0;
    }

    public function getL1()
    {
        return $this->L1;
    }

    public function getR1()
    {
        return $this->R1;
    }

    public function getE()
    {
        return $this->E;
    }
    public function getBits()
    {
        return $this->bits;
    }


}
