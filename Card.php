<?php

/*
 * 
 */

/**
 * Card used in Deck class
 *
 * @author Chris Dromey <chrisdromey@gmail.com>
 * 
 * @param string $suite The suite of the card
 * @param string $faceValue The value displayed on the card
 * @param int $numericValue The the numeric value of the card 
 * @param bool $faceUp (default FALSE) Whether or not the card is displayed face up on the play board
 * @param bool $aceLow (default NULL) Wheter the ace is counted as 1 or 11. Default is NULL if card is not an ace and FALSE if card is an ace.
 * 
 */
class Card {
    private $suite;
    private $faceValue;
    private $numericValue;
    private $faceUp;
    private $aceLow;
    
    function __construct($suite , $faceValue, $numericValue, $faceUp = false, $aceLow = null) {
        $this->suite = $suite;
        $this->faceValue = $faceValue;
        $this->numericValue = $numericValue;
        $this->faceUp = $faceUp;
        $this->aceLow = null; //null if card is not an ace
       
        //If the card is an ace set the $aceLow variable to false to signify that the ace is counted as high(11)
        if ($this->numericValue == 11) {$this->aceLow=false;}
   }
   
   //
   //  ACCESSORS
   //
   
   function getSuite(){
       return $this->suite;
   }
   function getFaceValue(){
       return $this->faceValue;
   }
   function getNumericValue(){
       return $this->numericValue;
   }
   function getFaceUp(){
       return$this->faceUp;
   }
   function getAceLow(){
       return $this->aceLow;
   }
   /**Get the details used to commenly display the card
    * eg 10H or AD
    * 
    * @return String
    */
   function getDetails(){
        return  $this->faceValue . $this->suite;
   }
   
   
}
