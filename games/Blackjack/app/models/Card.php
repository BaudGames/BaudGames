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
 * @param bool $aceLow (default NULL) Wheter the ace is counted as 1 or 11. Default is NULL if card is not an ace and TRUE if card is an ace.
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
       
        //If the card is an ace set the $aceLow variable to true.
        //This is because only the first ace in any hand could be couted as 11.
        if ($this->numericValue == 1) {$this->aceLow=true;}
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
   
   ////////////////
   //  MUTATORS  //
   ////////////////
   
   /** Allows you to change the value of an ace from high to low.
    * 
    * Does nothing if the $aceLow field is set to null (i.e ths card is not an ace).
    * If a perameter is passed the value of the boolean field $aceLow willl be set to that.
    * Otherwise the field will be toggled.
    * 
    * @param bool $lowBool (default null) the value to set the $aceLow field to
    */
   function setAceValue($lowBool = null){
       if (!is_null($this->aceLow) ){ //if it is null the card is not an ace as aces are constructed with the field to FALSE
           if (is_null($lowBool)){ // If no parameter is passed the toggle the value
               $this->aceLow = !$this->aceLow;
              // echo ' value changed ' . $this->aceLow;
           }
           else { $this->aceLow = $lowBool;} //Use the passed value
            }
            //set the numerc value of ace
           if ($this->aceLow == true) { $this->numericValue = 1;}
           else { $this->numericValue = 11;}
       }
   }