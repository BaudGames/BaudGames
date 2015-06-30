<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Filters user input for security...
function clean_input($data) {
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}    