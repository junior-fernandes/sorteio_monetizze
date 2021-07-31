<?php

namespace Source\App;
use Exception;

class Sorteio{

    private $qtdDezenas;
    private $resultado;
    private $totalJogos;
    private $jogos;

    public function __construct($qtdDezenas, $totalJogos)
    {

        try {

            if(!in_array($qtdDezenas, CONF_DEZENAS_PERMITIDAS)){
                throw new Exception("Dezena informada inválida!", 1);            
            }

            $this->qtdDezenas = $qtdDezenas;
            $this->totalJogos = $totalJogos;

        } catch(Exception $e) {
            echo $e->getMessage();
        }        

    }

    public function __get($name)
    {
        return ($this->$name ?? null);
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }    

    private function gerarDezenas($qtdDezenas)
    {

        $arrDezenas = array();

        for($i = 1; $i <= $qtdDezenas; $i++){

            $dezena = rand(1,60);

            while(in_array($dezena, $arrDezenas)){
                $dezena = rand(1,60);                
            }

            $arrDezenas[$i] = $dezena;

        }

        asort($arrDezenas);
        return $arrDezenas;

    }

    public function gerarJogos()
    {

        $arrJogos = array();

        for($i = 1; $i <= $this->totalJogos; $i++){
            $arrJogos[$i] = $this->gerarDezenas($this->qtdDezenas);
        }

        $this->jogos = $arrJogos;

    }

    public function sortear()
    {
        
        $arrSorteio = array();

        for($i=1; $i <= 6; $i++){

            $dezena = rand(1,60);

            while(in_array($dezena, $arrSorteio)){
                $dezena = rand(1,60);
            }

            $arrSorteio[$i] = $dezena;
        }

        asort($arrSorteio);        
        $this->resultado = $arrSorteio;

    }

    public function confereResultado()
    {

        foreach($this->jogos as $id_jogo => $jogo){  
            $qtdAcertos = count(array_intersect($jogo, $this->resultado));                  
            $arrConferencia[$id_jogo] = $qtdAcertos;           
        }

        $html = "<table class='table table-bordered'>
                    <thead>
                        <tr>
                            <td class='text-center' colspan='{$this->totalJogos}'>RESULTADO <br> ".implode(" - ", $this->resultado)." </td>
                        </tr>
                    </thead
                    <tboby>
                        <tr>";

                            for($i = 1; $i <= $this->totalJogos; $i++) {
                                $html .= "<td class='text-center'>Jogo {$i} | ".implode(" - ", $this->jogos[$i])."</td>";
                            }

                        $html .= "</tr>
                        <tr>";

                            for($i = 1; $i <= $this->totalJogos; $i++) {
                                $html .= "<td class='text-center'>{$arrConferencia[$i]} Acerto(s)</td>";
                            }

                        $html .= "</tr>
                    </tboby>
                </table>";

        return $html;

    }
}

?>