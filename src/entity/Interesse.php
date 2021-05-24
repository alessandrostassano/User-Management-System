<?php
namespace sarassoroberto\usm\entity; 


class Interesse {

    private $interesseId;
    private $nome;

    public function __construct($interesseId, $nome) {
        $this->interesseId = $interesseId;
        $this->nome = $nome;

    }

    public function getInteresseId()
    {
        return $this->interesseId;
    }

    

    public function setInteresseId($interesseId)
    {
        $this->interesseId = $interesseId;

        return $this;
    }


    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
    }
 