<?php

function limitarTexto($string, $words = '150')
    {
        $string = strip_tags($string);
        $cont = strlen($string);
        if ($cont <= $words) {
            return $string;
        } else {
            $strpos = strrpos(substr($string, 0, $words), ' ');
            return substr($string, 0, $strpos) . '...';
        }
    }

    ?>