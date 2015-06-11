<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dealer
 *
 * @author Chris
 */
 include_once('Player.php');
class Dealer extends Player{
    public $deckOfCards;
    public $TARGETSCORE = 21;
    public $players ;
    public $playersAndDealer;
   
            
    function __construct( $numPlayers){
        $this->deckOfCards = new Deck(2);
        $this->players = array();
        $this->hand = array();
        $this->name = "D";
        $this->deckOfCards->shuffle();
        
        $p=1;
        while($p<=$numPlayers){
            $player = new Player($this,$p);
            array_push($this->players, $player);
            $p++;
        }
        $this->playersAndDealer=$this->players;
        array_push($this->playersAndDealer, $this);
     
    }
    
     
    function printPlayerDetails(){
        foreach($this->players as &$player){
            $player->printDetails();
        }
    }
    
    function printDealerHand(){
        echo "<br> D:: ";
        foreach($this->hand as &$card){
            $card->printDetails();
             echo ', ';
        }
        //echo "<br>" . '-------- ' . "<br>" ;
    }
    
    function dealCards(){
        foreach ($this->players as &$player){
            array_push($player->hand, array_pop($this->deckOfCards->cards));
            array_push($player->hand, array_pop($this->deckOfCards->cards));
            $player->calcTotal();
        }
        array_push($this->hand, array_pop($this->deckOfCards->cards));
        array_push($this->hand, array_pop($this->deckOfCards->cards));
        
    }
    
    function tableAction(){
        $count = 1;
        foreach ($this->playersAndDealer as &$player){
            $playing = true;
             echo "<br> >  Round " . $count;
            while ($playing == true){
            
                $playerAction = $player->action();
                if ($playerAction == "hit") {
                    array_push($player->hand, array_pop($this->deckOfCards->cards));
                    $player->calcTotal();
                    $lastCard = end(array_values($player->hand))->getDetails();
                    echo "<br> Player " . $player->name . " Hit - " . $lastCard ;
                } 
                elseif ($playerAction == "stick") {
                    $playing = false;
                    echo "<br> Player " . $player->name . " stuck";
                }
                elseif ($playerAction == "doubleDown"){
                    array_push($player->hand, array_pop($this->deckOfCards->cards));
                    $player->calcTotal();
                    $lastCard = end(array_values($player->hand))->getDetails();
                    echo "<br> Player " . $player->name . " Doubled Down - " . $lastCard ;
                    $playing = false;
                    
                }

                
                if ( $player->total > $this->TARGETSCORE) {
                    $playing = false;
                    echo "<br> Player" . $player->name . " BUST";
                }
            
            }
           
            $player->printDetails();
            echo "<br> > End round " . $count . "<br>";
            $count++;

                }
    }
    
    function declareWinners(){
        echo "<br><br>------- GAME OUTCOME ------";
        echo "<br> Dealer has " . $this->total;
        foreach ($this->players as &$player) {
            $winStatus = "Won!";
            if ($player->total < $this->total && $player->total <= $this->TARGETSCORE && $this->total <= $this->TARGETSCORE){
                $winStatus = "Lost!";
            }
            elseif ($player->total > $this->TARGETSCORE) {
            $winStatus = "Bust!";
            }
            echo "<br>Player " . $player->name . " " . $winStatus . " with " . $player->total;
        }
    }
}
