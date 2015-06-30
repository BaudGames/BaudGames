<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Called by client to log in to server.

// Requires playerstable script for SQL queries.

// Requires Player class too?

require generic_functions;

    $db = new stdClass();
    $db->servername = "baud_games";
    $db->username = "Tim";
    $db->password = "tim";
    $db->name = "baud_games";

    echo "Oh hi there $this->clean_input($_POST[name])!";
    
    print "Logging you in to server now";
    // Retrieve form data using IDs...
    $name = $this->clean_input($_POST["name"]);
    $email = $this->clean_input($_POST["email"]);
    $password = crypt($this->clean_input($_POST["password"]));

    
    
    
    // Create connection
    $conn = new mysqli_connect($this->servername, $this->username, 
            $this->password, $this->dbname);
    // Check connection
    if (mysqli_connect_errno($conn)) {
        echo("Connection failed: " . mysqli_connect_error());        
    }
    
    // Check if user account exists based on email.
 
    // Login User on server - but where? In DB?
    else{
        echo "User found, logging in to Server";
        // TO DO
    }
    $conn->close();
        
    
    
    
    
if (isset($_POST['submit'])){
    echo "Oh Hi there!";
    // DO STUFF
    // Why check for submit, isn't it always the case that submit was pressed?
}