<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Deck
 *
 * @author Chris
 */
class Deck {
    public $cards ;
    
    function __construct($numberOfDecks){
        $suites = array("H","D","S","C");
        $faceValues = array("2","3","4","5","6","7","8","9","10","J","Q","K","A");
        $numValues = array(2,3,4,5,6,7,8,9,10,10,10,10,11);
        $cardCount = 0;
        $this->cards = array();
        $decknumber = 1;
        while($decknumber <= $numberOfDecks){
            foreach ($suites as &$suite){
                $valCount = 0;
                foreach ($faceValues as &$value){
                    $tempCard = new Card($suite, $value, $numValues[$valCount]);
                    array_push($this->cards, $tempCard);
                    $cardCount++;
                    $valCount++;
                }
            }
            $decknumber++;
        }
    }
    function printDetails(){
        foreach($this->cards as &$card)  {
            $card->printDetails();
        }
    }
    
    function shuffle(){
         shuffle($this->cards);
    }
    
 
}
