<?php
class PainelSolar{
    public $potencia;
    public $descricao;
    public $tamanho_painel;
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
        $this->tamanho_painel = "1.64";
        $this->preco = "690.00";
    }

    private function preparaPainelSolar270(){
        $this->potencia = "270";
        $this->descricao = "Painel solar de 270w";
        $this->tamanho_painel = "1.64";
        $this->preco = "690.00";
    }

    private function preparaPainelSolar325(){
        $this->potencia = "325";
        $this->descricao = "Painel solar de 325w";
        $this->tamanho_painel = "1.94";
        $this->preco = "928,75";
    }

    private function preparaPainelSolar330(){
        $this->potencia = "330";
        $this->descricao = "Painel solar de 330w";
        $this->tamanho_painel = "1.94";
        $this->preco = "928,75";
    }
} ?>