<?php
class PainelSolar{
    public $potencia;
    public $descricao;
    public $altura;
    public $largura;
    public $expessura;
    public $preco;

    function PainelSolar($escolha){
        switch ($escolha) {
            case '250':
                $this->preparaPainelSolar250();
                break;
                
            case '270':
                $this->preparaPainelSolar270();
                break;
            
            case '325':
                $this->preparaPainelSolar325();
                break;
                
            case '330':
                $this->preparaPainelSolar330();
                break;     
            
            default:
                $this->preparaPainelSolar250();
                break;
        }
    }

    private function preparaPainelSolar250(){
        $this->potencia = "250";
        $this->descricao = "Painel solar de 250w";
        $this->altura =  "1650" ;
        $this->largura = "990";
        $this->expessura = "35";
        $this->preco = "690.00";
    }

    private function preparaPainelSolar270(){
        $this->potencia = "270";
        $this->descricao = "Painel solar de 270w";
        $this->altura =  "1650" ;
        $this->largura = "992";
        $this->expessura = "40";
        $this->preco = "690.00";
    }

    private function preparaPainelSolar325(){
        $this->potencia = "325";
        $this->descricao = "Painel solar de 325w";
        $this->altura =  "1956" ;
        $this->largura = "992";
        $this->expessura = "40";
        $this->preco = "928,75";
    }

    private function preparaPainelSolar330(){
        $this->potencia = "330";
        $this->descricao = "Painel solar de 330w";
        $this->altura =  "1956" ;
        $this->largura = "992";
        $this->expessura = "40";
        $this->preco = "928,75";
    }

    // private function preparaPainelSolar($potencia, $descricao, $altura, $largura, $expessura, $preco){
    //     $this->potencia = $potencia;
    //     $this->descricao = $descricao;
    //     $this->altura = $altura ;
    //     $this->largura = $largura;
    //     $this->expessura = $expessura;
    //     $this->preco = $preco;
    // }

} ?>