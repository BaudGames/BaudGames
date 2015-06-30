<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Players_table{

    // Check if user exists and if not create user and save to database.
    public function createUser($name, $email, $password){

        $search_SQL = mysqli_query($conn, "SELECT * FROM 'players' WHERE email = $email");
         if ($search_SQL->num_rows < 1){ // If not create new user.
             $insert_SQL = "INSERT INTO 'players' VALUES ($name, $email, $password)";                    
             if ($conn->query($insert_SQL) === TRUE) {
                 echo "New user created successfully";
             }
             else {
                 echo "Error: " . $insert_SQL . "<br>" . $conn->error;
             }
        }  
    }
}