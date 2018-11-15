<?php
class Inversor{
    public $potencia;
    public $descricao;
    public $preco;

    function Inversor($escolha){
        switch ($escolha) {
            case '1000':
                $this->preparaInversonUm();
                break;
                
            case '1500':
                $this->preparaInversonUmEMeio();
                break;
            
            case '2000':
                $this->preparaInversonDois();
                break;
                
            case '2500':
                $this->preparaInversonDoisEMeio();
                break;     
                
            case '3000':
                $this->preparaInversonTres();
                break;     
                
            case '4000':
                $this->preparaInversonQuatro();
                break;     
                
            case '5000':
                $this->preparaInversonCinco();
                break;     

            case '6000':
                $this->preparaInversonSeis();
                break;     

            case '8000':
                $this->preparaInversonOito();
                break;     

            case '12500':
                $this->preparaInversonDozeEMeio();
                break;     

            case '15000':
                $this->preparaInversonQuinze();
                break;     

            case '20000':
                $this->preparaInversonVinte();
                break;     

            case '100000':
                $this->preparaInversonCem();
                break;     

            case '1000000':
                $this->preparaInversonMil();
                break;     
            
            default:
                $this->ppreparaInversonUm();
                break;
        }
    }

    private function ppreparaInversonUm(){
        $this->potencia = "1";
        $this->descricao = "Inversor de 1kWp";
        $this->preco = "3000";
    }

    private function preparaInversonUmEMeio(){
        $this->potencia = "1.5";
        $this->descricao = "Inversor de 1.5kWp";
        $this->preco = "4500";
    }

    private function preparaInversonDois(){
        $this->potencia = "2";
        $this->descricao = "Inversor de 2kWp";
        $this->preco = "5000";
    }

    private function preparaInversonDoisEMeio(){
        $this->potencia = "2.5";
        $this->descricao = "Inversor de 2.5kWp";
        $this->preco = "7000";
    }

    private function preparaInversonTres(){
        $this->potencia = "3";
        $this->descricao = "Inversor de 3kWp";
        $this->preco = "7500";
    }

    private function preparaInversonQuatro(){
        $this->potencia = "4";
        $this->descricao = "Inversor de 4kWp";
        $this->preco = "8500";
    }

    private function preparaInversonCinco(){
        $this->potencia = "5";
        $this->descricao = "Inversor de 5kWp";
        $this->preco = "10000";
    }

    private function preparaInversonSeis(){
        $this->potencia = "6";
        $this->descricao = "Inversor de 6kWp";
        $this->preco = "11000";
    }

    private function preparaInversonOito(){
        $this->potencia = "8";
        $this->descricao = "Inversor de 8kWp";
        $this->preco = "12000";
    }

    private function preparaInversonDozeEMeio(){
        $this->potencia = "12.5";
        $this->descricao = "Inversor de 12.5kWp";
        $this->preco = "18000";
    }

    private function preparaInversonQuinze(){
        $this->potencia = "15";
        $this->descricao = "Inversor de 15kWp";
        $this->preco = "20000";
    }

    private function preparaInversonVinte(){
        $this->potencia = "20";
        $this->descricao = "Inversor de 20kWp";
        $this->preco = "22000";
    }

    private function preparaInversonCem(){
        $this->potencia = "100";
        $this->descricao = "Inversor de 100kWp";
        $this->preco = "100000";
    }

    private function preparaInversonMil(){
        $this->potencia = "1000";
        $this->descricao = "Inversor de 1000kWp";
        $this->preco = "600000";
    }

    // https://www.portalsolar.com.br/o-inversor-solar.html
    // Inversor solar de 1KWp aproximadamente R$ 2.500,00 - R$ 3.000,00
    // Inversor solar de 1.5KWp aproximadamente R$ 3.500,00 – R$4.500,00
    // Inversor solar de 2 KWp aproximadamente R$ 4.000,00 - R$ 5.000,00
    // Inversor solar de 2.5kWp de R$6.000,00 – R$7.000,00
    // Inversor solar de 3.0kWp de R$6.500,00 – R$7.500,00
    // Inversor solar de 4.0kWp de R$7.000,00 – R$8.500,00
    // Inversor solar de 5.0kWp de R$8.500,00 – R$10.000,00
    // Inversor solar de 6.0kWp de R$9.000,00 – R$11.000,00
    // Inversor solar de 8.0kWp de R$10.500,00 – R$12.000,00
    // Inversor solar de 12.5kWP de R$ 15.000,00 – R$18.000,00
    // Inversor solar de 15.0kWP de R$ 17.000,00 – R$20.000,00
    // Inversor solar de 20.0kWP de R$ 15.000,00 – R$22.000,00
    // Inversor solar Central 100kWp de R$ 50.000,00 até 100.000,00
    // Inversor solar Central 1000kWp de R$ 300.000,00 até R$600.000,00
} ?>