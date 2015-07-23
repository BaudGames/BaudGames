<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/TableAbstract.php';

/**
 * Description of BlackJack_table
 *
 * @author Tim
 */
class BlackJack_table extends TableAbstract {
    //put your code here
    
    public function joinGame($gameID, $player){        
        $sql = "INSERT INTO BlackJack VALUES :gameID, :player";
        $params = array(
            ':gameID' => $gameID,
            ':player' => $player
        );
        $result = $this->dbh->prepare($sql);
        $result->execute($params);        
        if ( $result->errorCode > 0)    {return TRUE;}
        return FALSE;
    }    

    
    
}
