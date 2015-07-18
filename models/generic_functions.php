<?php

class ExtraStringFunctions {
    function clean_input($data) {
        $data = htmlspecialchars(stripslashes(trim($data)));
        return $data;
    }    
}