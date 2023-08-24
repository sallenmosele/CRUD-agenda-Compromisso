<?php
class maiuscula{

function maiusculaFont($string) {
        $string = mb_strtolower(trim(preg_replace("/\s+/", " ", $string)));//transformo em minuscula toda a sentença
        $palavras = explode(" ", $string);//explodo a sentença em um array
        $t =  count($palavras);//conto a quantidade de elementos do array
        for ($i=0; $i <$t; $i++){ //entro em um for limitando pela quantidade de elementos do array
            $retorno[$i] = ucfirst($palavras[$i]);//altero a primeira letra de cada palavra para maiuscula
                if($retorno[$i] == "Dos" || $retorno[$i] == "De" || $retorno[$i] == "Do" || $retorno[$i] == "Da" || $retorno[$i] == "E" || $retorno[$i] == "Das"):
                    $retorno[$i] = mb_strtolower($retorno[$i]);//converto em minuscula o elemento do array que contenha preposição de nome próprio
                endif;  
        }
        return implode(" ", $retorno);
  }
}