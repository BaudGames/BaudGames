<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Player
 *
 * @author Chris
 */
class Player {
    public $hand;
    public $total;
    public $dealer;
    public $name;
    
    function __construct($dealer, $name){
        $this->dealer=$dealer;
        $this->name=$name;
        $this->hand = array();
    }
    
    function printDetails(){
        echo "<br>" . $this->name . ":: ";
        foreach($this->hand as &$card){
            $card->printDetails();
                echo ', ';
        }
        echo ' Total = ' . $this->total;
       // echo "<br>" . '-------- '  ;
    }
    
    function calcTotal(){
        $total = 0;
        foreach ($this->hand as &$card){
            $total+=$card->numValue;
        }
        $this->total = $total;
        
    }
    
    function action(){
        if ($this->total == 11){
            return "doubleDown";
        }
        
        if ($this->total < 16){
            return "hit";
        }
        
        return "stick";
    }
}
