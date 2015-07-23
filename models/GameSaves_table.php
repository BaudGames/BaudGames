<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/TableAbstract.php';

/**
 * Description of GameSaves_table - maps the GameSaves table in DB that records
 * GameID and BLOB of serialised game objects.
 *
 * @author Tim
 */
class GameSaves_table extends TableAbstract {
    
    
    public function createGame($gameState){
        
        $sql = 'INSERT INTO GameState VALUES :GameID, :GameState';
        $params = array(
            ':GameID' => 0, // SET TO AUTO INCREMENT SOMEWHERE!!!
            ':GameState' => $gameState
        );        
        $result = $this->dbh->prepare($sql);
	$result->execute($params);        
        if ($result->errorCode()==0) {
            return TRUE;   
        }
        return FALSE;
    }
    
/**
 * For players joining a game session on their phone, using the code shown on 
 * the tablet. 
 * 
 * @param type $gameID Unique identifier of the hosted game to join.
 * @param type $player Email address of player
 * @return boolean Success of final SQL command to serialise game and update DB.
 */
    public function joinGame($gameID, $player){
        $sql1 = 'SELECT GameState FROM GameSaves WHERE GameID = :gameID';
        $params1 = array(':gameID' => $gameID);
        $result1 = $this->dbh->prepare($sql1);
        $gameBLOB = $result1->execute($params1);

        // DESERIALISE BLOB and add player to players array in game.
        //         
        // Trying to return the BLOB to a var, which can then be deserialised, 
        // opened and a 'addPlayer($player)' method run on it. LEAVE FOR THE gameHandler to manage?
        // Needs to return the modified game object back, to be serialised.
        
        // RE-SERIALSE BLOB AND UPDATE DB        
        $sql2 = 'UPDATE GameSaves SET :gameBLOB = $gameBLOB WHERE GameID = :gameID';
        $params2 = array(':gameBLOB' => $gameBLOB, ':gameID' => $gameID);
        $result2 = $this->dbh->prepare($sql2);
        $result2->execute($params2);
        
        if ($result2->errorCode > 0){ return TRUE;
        } return FALSE;       
    }
}
