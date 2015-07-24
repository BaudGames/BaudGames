<?php
//Default controller
class Home extends Controller {
    
    // Default method
    public function index() {
        require_once '../app/models/Deck.php';
        require_once'../app/models/Card.php';
        require_once '../app/models/Dealer.php';
        require_once '../app/models/Player.php';

        $de = new Dealer(7);
        $de->dealCards();
        echo "<br> > starting hand";
        $de->printPlayerDetails();
        //$de->printDealerHand();
        echo "<br> > end of starting hand <br>";// --------------";
        $de->tableAction();

        $de->printPlayerDetails();
        $de->declareWinners();
    }
}