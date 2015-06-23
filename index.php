<!DOCTYPE html>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include_once('Deck.php');
        include_once('Card.php');
        include_once('Dealer.php');
        include_once('Player.php');
                
       $de = new Dealer(7);
       $de->dealCards();
       echo "<br> > starting hand";
       $de->printPlayerDetails();
       $de->printDealerHand();
       echo "<br> > end of starting hand <br>";// --------------";
       $de->tableAction();
    
        $de->printPlayerDetails();
       $de->declareWinners();



        ?>
    </body>
</html>
