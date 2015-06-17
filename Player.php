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
    protected $hand;
    protected $total;
    protected $name;
    
    function __construct($name){
        $this->name=$name;
        $this->hand = array();
    }
    
    
    /////////////////
    //  ACCESSORS  //
    /////////////////
    
    function getHand(){
        return $this->hand;
    }
    function getTotal(){
        return $this->total;
    }
    function getDealer(){
        return $this->dealer;
    }
    function getName(){
        return $this->name;
    }
    
    function printDetails(){
        echo "<br>" . $this->name . ":: ";
        foreach($this->hand as &$card){
            echo $card->getDetails();
                echo ', ';
        }
        echo ' Total = ' . $this->total;
    }
    
    function calcTotal(){
        $ace = 0;
        // check for ace
        foreach ($this->hand as &$card){
         if ($card->getNumericValue() == 11) { $ace++ ;}
         
        }
        
        $total = 0;
        foreach ($this->hand as &$card){
            $total+=$card->getNumericValue();
        }
        $this->total = $total;
        
        //check total with ace as 1
        if ($ace > 0) { 
            $totalAce = $total - 10 ;
            if ($totalAce == 21) { $this->total = $totalAce;}
            if ($total > 21 && $totalAce <=21) { $this->total = $totalAce;}
            if ($totalAce == 11) { $this->total = $totalAce;}
        }
        
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
    
    ////////////////
    //  MUTATORS  //
    ////////////////
    
    function addCardToHand($card){
        array_push($this->hand, $card);
    }
    
   
}
