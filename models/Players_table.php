<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once __DIR__ . '/TableAbstract.php';

class Players_table extends TableAbstract{

    //
    // DEFAULT CONSTRUCTOR
    //
    
    /**
     * Takes the account details from client app when user logs in for first 
     * time and enters new player to the Players table in the DB..
     * @param type $name The user's name.
     * @param type $email The user's email address.
     * @param type $password The user's encrypted password (using std PHP crypt()).
     */
    public function createUser($name, $email, $password){
        
        
        $sql = "INSERT INTO players(Name, Email, Password) VALUES (:name, :email, :password)";
        $params = array(
            ':name' => $name,
            ':email' => $email,
            ':password' => $password
        );
        $result = $this->dbh->prepare($sql);
	$result->execute($params);
        
        if ($result->errorCode()==0) {
            return TRUE;             
        }
        return FALSE;
        
/*        
        $search_SQL = mysqli_query($conn, "SELECT * FROM 'players' WHERE email = $email");
         if ($search_SQL->num_rows < 1){ // If not create new user.
             $insert_SQL = "INSERT INTO 'players' VALUES ($name, $email, $password)";                    
             if ($conn->query($insert_SQL) === TRUE) {
                 echo "New user created successfully";
                 return 1;
             }
             else {
                 echo "Error: " . $insert_SQL . "<br>" . $conn->error;
                 return 0;
             }
        }  
 */
    }

    /**
     * Query the DB for user details and if correct then log user in.
     * @param type $email The email address to search for.
     * @param type $password The password to search for, encrypted using std PHP crypt().
     * @return int Returns 1 is successful, 0 if failed.
     */
    public function logIn($email, $password){
        // Check if user account exists based on email.
        
        
        $sql = "SELECT * FROM players WHERE Email = :email AND Password = :password";
        $params = array(
		':email' => $email,
                ':password' => $password
        );
	$result = $this->dbh->prepare($sql);
	$result->execute($params);
        if ($result->rowCount()>0) { return TRUE; }
        return FALSE;

        /*
        $sql = "SELECT * FROM 'players' WHERE email = $email";
        $conn->beginTransaction();
        $search_email_SQL = $conn->prepare($sql);
        if ($search_email_SQL->execute()){
            echo "search_email_SQL query returned OK.<br>";            
            if ($search_email_SQL->num_rows < 1){ 
                echo "User not found, please try again or Create Account<br>";
                return 0;
            } else {
                $sql = "SELECT * FROM 'players' WHERE password = $password";
                $search_password_SQL = $conn->prepare($sql);
                if ($search_password_SQL->execute()){
                    if ($search_email_SQL->num_rows < 1){ 
                        echo "User not found, please try again or Create Account<br>";
                        return 0;
                    } else {
                        echo "User and Password found, user is now logged in.<br>";
                        // DO STUFF - store in DB?
                        // ARE YOUSERS EVEN LOGGING IN, OR JUST JOINING SESSION?
                        // ASSUME APP AUTO LOGS IN, BUT DOES THE SERVER CARE? 
                        // DO LOCAL?
                        return 1;            
                        
                    }
                }
            
                }
            $conn->commit();
        } else { echo "search_email_SQL query failed to return PDO object.<br>";
        }*/
    }    
}