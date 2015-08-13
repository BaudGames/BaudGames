<?php

require_once 'autoload.php';

session_start();
if (!isset($_SESSION['view'])){
    if (!isset($_POST['email'])){
        require_once './views/header.phtml';
        exit('<b>Please enter your email address next time.<b>'); 
        session_destroy();
    }    
    $view = new stdClass();
    $view->SID = $_POST['email'];
    $view->pageTitle = "New Blackjack Game";
    $view->playerCards = array();
    $view->dealerCards = array();    
} else {
    $game = unserialize($_SESSION['game']);
    $view = unserialize($_SESSION['view']);
}
if (isset($_POST['play'])){
    $view->stick = false;
    $game = new Game();
    $view->playerCards = $game->getPlayerCards();
    $view->dealerCards = $game->getDealerCards();
    $view->playerScore = $game->getScore($view->playerCards);
    $view->dealerScore = $game->getScore($view->dealerCards);    
}
if (isset($_POST['hit'])){
    // Calls function amd checks if score 21 or higher.
    if ($game->playerHit()){
        $view->dealerScore = $game->dealerHit();
        $view->stick = true;
    }
}
if (isset($_POST['stick'])){
    $view->dealerScore = $game->dealerHit();
    $view->stick = true;  
}
$view->playerCards = $game->getPlayerCards();
$view->dealerCards = $game->getDealerCards();
$view->playerScore = $game->getScore($view->playerCards);

$_SESSION['game'] = serialize($game);
$_SESSION['view'] = serialize($view);

require_once('./views/game.phtml');