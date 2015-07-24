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
    public function __construct($numberOfDecks = 1) {
        $suits = array("H", "D", "S", "C");
        $values = ["2" => 2, "3" => 3, "4" => 4, "5" => 5, "6" => 6, "7" => 7,
            "8" => 8, "9" => 9, "10" => 10, "J" => 10, "Q" => 10, "K" => 10,
            "A" => 1];
        $this->cards = [];

        // Loop to create the amount of decks needed
        for($decknumber = 0; $decknumber < $numberOfDecks; $decknumber++) {
            // Loop to cycle through each suite
            foreach ($suits as $suit) {
                // Loop to cycle throguh each card in the suit
                foreach ($values as $face => $num) {
                    array_push($this->cards, new Card($suit, $face, $num));
                }
            }
        }
    }

    /////////////////
    //  ACCESSORS  //
    /////////////////

    public function getCards() {
        return $this->cards;
    }

    /**
     * Prints the details of all the cards in Deck
     */
    public function printDetails() {
        foreach ($this->cards as $card) {
            echo $card->getDetails();
        }
    }

    /////////////////
    //   MUTATORS  //
    /////////////////

    /**
     * Shuffles the array of cards to a random order
     */
    public function shuffle() {
        shuffle($this->cards);
    }

    /**
     * Deals $numCards cards to $player Player
     * 
     * @param Player $player The player the cards are being delt to
     * @param int $numCards The number of cards to be delt
     */
    public function dealCards($player, $numCards) {
        for ($i = 1; $i <= $numCards; $i++) {
            $player->addCardToHand(array_pop($this->cards));
        }
    }
}