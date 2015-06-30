<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Called by client to log in to server.

// Requires playerstable script for SQL queries.

// Requires Player class too?

require_once 'models/generic_functions.php';
require_once 'Database.php';
require_once 'tables/Players_table.php';

    $db = new stdClass();
    $db->servername = "baud_games";
    $db->username = "Tim";
    $db->password = "tim";
    $db->name = "baud_games";

    
    
    // Retrieve form data using IDs...  
    //$name = $this->clean_input($_POST["name"]);
    $email = clean_input($_POST["email"]);
    $password = crypt(clean_input($_POST["password"]));

    
    // Instantiate Players_table class to access its methods.
    $players_table = new Players_table();

    
    echo "Oh hi there partner.<br>";// $name";    
    echo "Logging you in to server now.<br>";

 
    // Check and create connection
    try{
        $conn = Database::getInstance();
        echo "Connection to DB successfull.<br>";
    }
    catch (PDOException $e){
        $conn = null;
        echo "Connection to DB failed.<br>";
        echo($e->getMessage());
        echo "<br>";
    }
    
    if ($conn != null){
        try {
            $dbh = $conn->getDbh();
            $players_table->logIn($dbh, $email, $password);            
            //$players_table->logIn($conn, $name, $email, $password);                        
        } catch (PDOException $e){
            echo $e->getMessage();
            echo "Can't check the database<br>"; 
        }
    }
   
    $conn->__destruct();
        
    
    
    
    
if (isset($_POST['submit'])){
    echo "Oh Hi there!";
    // DO STUFF
    // Why check for submit, isn't it always the case that submit was pressed?
}