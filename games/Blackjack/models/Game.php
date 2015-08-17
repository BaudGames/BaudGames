<?php
/**
 * Description of Game class
 *
 * @author Chris
 */
include_once('autoload.php');

class Game extends Player {

    private $deckOfCards;
    private $playerCards;
    private $dealerCards;

    public function __construct() {
        $this->deckOfCards = new Deck(1);
        $this->deckOfCards->shuffle();
        $this->playerCards = array(
           $this->deckOfCards->newCard(),
           $this->deckOfCards->newCard()
        );
        $this->dealerCards = array(
           $this->deckOfCards->newCard(),
           $this->deckOfCards->newCard()
        );
    }

    /**
     * Returns the array of dealers cards.
     * @return type array<card> The dealers hand of cards.
     */   
    public function getDealerCards(){
        return $this->dealerCards;
    } 
    
    /**
     * Returns the array of players cards.
     * @return type array<card> The players hand of cards.
     */
    public function getPlayerCards(){
        return $this->playerCards;
    }
    

   
   /**
    * Calculate score of any given hand of cards (player or dealers).
    * @param type $hand The hand of cards to count.
    * @return type
    */
   public function getScore($hand){
       $score = 0;
       foreach ($hand as $card){
           $score = $score + $card->getNumericValue();           
       }
       return $score;
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

    /**
     * Prompts the dealer to draw cards until their total score is at least 16,
     * which may exceed 21 - in which case the dealer is bust.
     * @return $score The Dealer's final score.
     */
    public function dealerHit(){
        $score = $this->getScore($this->dealerCards);
        while ($score < 17){
            $card = $this->deckOfCards->newCard();
            array_push($this->dealerCards, $card);
            // Tot up and return score.
            $score = $this->getScore($this->dealerCards);
        }                    
        return $score;
    }
    
    /**
     * Player action for 'Hit', adds a nes card to players hand.
     * @return type bool If players score above 21 return true.
     */
    public function playerHit(){
        // Take a new card from deck.
        $card = $this->deckOfCards->newCard();
        array_push($this->playerCards, $card);
        // Tot up and return score.
        $score = $this->getScore($this->playerCards);
        $bust = $score > 21;
        return $bust;
                
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
