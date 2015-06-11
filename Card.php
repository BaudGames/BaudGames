<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Card
 *
 * @author Chris
 */
class Card {
    public $suite;
    public $faceValue;
    public $numValue;
    public $faceUp;
    
    function __construct($s , $fv, $nv, $fu = false) {
        $this->suite = $s;
        $this->faceValue = $fv;
        $this->numValue =$nv;
        $this->faceUp = $fu;
       
   }
   
   function printDetails(){
       echo  $this->faceValue . $this->suite  ;
   }
   
   function getDetails(){
        return  $this->faceValue . $this->suite;
   }
}
