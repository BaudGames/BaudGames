<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * 
 * Description of Deck
 *
 * @author Chris Dromey <chrisdromey@gmail.com>
 */
class Deck {
    private $cards;
    
    /**
     * Generates a deck of cards.
     * 
     * @param int $numberOfDecks (DEFAULT = 1) The number os standard 52 card deck to be used in this deck
     */
    function __construct($numberOfDecks = 1){
        $suits = array("H","D","S","C");
        $faceValues = array("2","3","4","5","6","7","8","9","10","J","Q","K","A");
        $numValues = array(2,3,4,5,6,7,8,9,10,10,10,10,1);
        $this->cards = array();
        $decknumber = 1; // counter for number of deck created
        
        // loop to create the amount of decks needed
        while($decknumber <= $numberOfDecks){
            // loop to cycle through each suite
            foreach ($suits as &$suit){
                $valCount = 0;// couter to ensure correct numerical value is assigned from the array
                // loop to cycle throguh each card in the suit
                foreach ($faceValues as &$value){
                    $tempCard = new Card($suit, $value, $numValues[$valCount]);
                    array_push($this->cards, $tempCard);
                    $valCount++;
                }
            }
            $decknumber++;
        }
    }
    
    
    
    /////////////////
    //  ACCESSORS  //
    /////////////////
    
    function getCards(){
        return $this->cards;
    }
    
    /**
     * Prints the details of all the cards in Deck
     */
    function printDetails(){
        foreach($this->cards as &$card)  {
            echo $card->getDetails();
        }
    }
    
    /////////////////
    //   MUTATORS  //
    /////////////////
    
    /**
     * Shuffels the array of cards to a random order
     */
    function shuffle(){
         shuffle($this->cards);
    }
    /**
     * Deals $numCards cards to $player Player
     * 
     * @param Player $player The player the cards are being delt to
     * @param int $numCards The number of cards to be delt
     */
    function dealCards($player, $numCards){
        $i=1;
        while($i <= $numCards){
            $player->addCardToHand(array_pop($this->cards));
            $i++;
        }
        
    }
 
}