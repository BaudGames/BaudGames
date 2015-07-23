<?php
$return = array(
    'return' => 999
);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Called by client to log in to server.

require_once 'models/Generic_functions.php';
require_once 'models/Database.php';
require_once 'models/Players_table.php';
   
if (isset($_POST['create'])){
    $name = ExtraStringFunctions::clean_input($_POST["name"]);
    $email = ExtraStringFunctions::clean_input($_POST["email"]);
    $password = crypt(ExtraStringFunctions::clean_input($_POST["password"]), $email);

    $players_table = new Players_table();

    if (($players_table->createUser($name, $email, $password))){
        session_start();
        $return['return'] = 0;
        $return['sid'] = session_id();
        echo json_encode($return);
        exit(0);
    } else {
        $return['return'] = 1;
        $return['errmsg'] = "Sorry, user not created.";
        echo json_encode($return);
        exit(0);
    }
    echo json_encode($return);
}


if (isset($_POST['login'])){
    $email = ExtraStringFunctions::clean_input($_POST["email"]);
    $password = crypt(ExtraStringFunctions::clean_input($_POST["password"]), $email);

    $players_table = new Players_table();

    if (($players_table->logIn($email, $password))){
        session_start();
        $return['return'] = 0;
        $return['sid'] = session_id();
        echo json_encode($return);
        exit(0);
    } else {
        $return['return'] = 1;
        $return['errmsg'] = "Wrong credentials.";
        echo json_encode($return);
        exit(0);
    }
    echo json_encode($return);
}

$return['return'] = 900;
$return['errmsg'] = "Illegal access attempt.";
echo json_encode($return);