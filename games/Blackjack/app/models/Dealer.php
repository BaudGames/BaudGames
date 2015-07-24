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

class Dealer extends Player {

    private $deckOfCards;
    private $TARGETSCORE = 21;
    private $players;

    public function __construct($numPlayers=1) {
        $this->deckOfCards = new Deck(2);
        $this->players = array();
        $this->hand = array();
        $this->name = 'Dealer';
        $this->deckOfCards->shuffle();


        for ($p = 1; $p <= $numPlayers; $p++) {
            $player = new Player($p);
            array_push($this->players, $player);
        }
        
        array_push($this->players, $this);
    }

   public function printPlayerDetails() {
        foreach ($this->players as &$player) {
            $player->printDetails();
        }
    }

    /*function printDealerHand() {
        echo '<br> D:: ';
        foreach ($this->hand as &$card) {
            echo $card->getDetails(),', ';
        }
        //echo '<br>', '-------- ', '<br>' ;
    }*/

   public function dealCards() {
        foreach ($this->players as &$player) {
            $this->deckOfCards->dealCards($player, 2);
            $player->updateTotal();
        }
    }

   public function tableAction() {
        $count = 1;
        foreach ($this->players as &$player) {
            $playing = true;
            echo '<br> >  Round ', $count;
            while ($playing) {
                switch($player->action()) {
                    case 'hit':
                        $this->deckOfCards->dealCards($player, 1);
                        $player->updateTotal();
                        $lastCard = end(array_values($player->hand))->getDetails();
                        echo '<br> Player ', $player->name, ' Hit - ', $lastCard;
                        break;
                    case 'stick':
                        echo '<br> Player ', $player->name, ' stuck';
                        $playing = false;
                        break;
                    case 'doubleDown':
                        $this->deckOfCards->dealCards($player, 1);
                        $player->updateTotal();
                        $lastCard = end(array_values($player->hand))->getDetails();
                        echo '<br> Player ', $player->name, ' Doubled Down - ', $lastCard;
                        $playing = false;
                        break;
                }
                if ($player->total > $this->TARGETSCORE) {
                    $playing = false;
                    echo '<br> Player ', $player->name, ' BUST';
                }
            }

            $player->printDetails();
            echo '<br> > End round ', $count, '<br>';
            $count++;
        }
    }

   public function declareWinners() {
        echo '<br><br>------- GAME OUTCOME ------';
        echo '<br> Dealer has ', $this->total;
        foreach ($this->players as &$player) {
            if($player->name != 'Dealer') {
                $winStatus = 'Won!';
                //   player total < than dealer     player total <= 21                          dealer total <= 21
                if (($player->total < $this->total) && $player->total <= $this->TARGETSCORE && $this->total <= $this->TARGETSCORE) {
                    $winStatus = 'Lost!';
                }
                elseif ($player->total > $this->TARGETSCORE) {
                    $winStatus = 'Bust!';
                }
                echo '<br>Player ', $player->name, ' ', $winStatus, ' with ', $player->total;
            }
        }
        echo '<br>';
    }

}
