<?php
$return = array(
    'return' => 999
);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'models/Generic_functions.php';
require_once 'models/Database.php';
require_once 'models/GameSaves_table.php';
require_once 'models/BlackJack_table.php';

// Extract arguments from JSON object.
$args = json_decode($_POST['args']);
$action = $args['action'];
$gameType = $args['gameType'];

$gamesaves_table = new Gamesaves_table();

// Instantiate relevant table object for chosen game type.
$game_table;
switch ($gameType){
    case 'blackjack':
        $game_table = new BlackJack_table();
        break;
    default:
        $game_table = null;
        break;
}

if ( $action === 'create'){

    // Instantiate relevant game handler for chosen game type.    
    $gameHandler;
    switch ($gameType){
        case 'blackjack':
            // $gameHandler = new BlackJack_Handler();
            break;
        default:
            // $gameHandler = null;
            break;
    }
    
    // NOT SURE WHAT GOES WHERE HERE.
    // NEED TO: 
    //      Setup a game object and store it in GameStates
    //      Assign a UID for new game and return it to players
    // So should this bit just call the game Handler to go off and call the 
    // GameState table methods from within the handler?  e.g.
    //    $gameHandler->createGame();
    
    
    // Record record in GameSaves DB    
    // CALLED BY game Handler? $gamesaves_table->createGame($gameState)
}

if ( $action === 'join'){
    if ($gameType === 'blackjack'){
        if ( $game_table->joinGame($gameID, $player) ){
            $return['return'] = 0;
            $return['msg'] = 'You have joined the BlackJack game, waiting for start...';            
            echo json_encode($return);
            exit(0);
        }
        else{
            $return['return'] = 1;
            $return['errmsg'] = "Sorry, not able to join game.";
            echo json_encode($return);
            exit(0);            
        }     
    }
}



    