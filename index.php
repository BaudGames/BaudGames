<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Baud Games</title>
    </head>
    <body>
        <header>
            <img src="images/Facebook-Banner.jpg"
            width="851"
            height="315"
            alt="You know who we are."
            >
        </header>
        
        <p>Welcome to Baud Games.</p>
        <p>Don't get BORED, get <b>BAUD</b>.</p>
        
        <p>Want to play Blackjack?</p>
        <form action="http://localhost/BaudGames/games/Blackjack/index.php"
            method="post"
            <p><input type="submit" name="play" value="PLAY!"/></p>           
        </form>
                
        <form action="http://localhost/BaudGames/controllers/user_login.php" method="post">
            <p> Name: <input type="text" name="name"/></p>
            <p> Email: <input type="text" name="email"/></p>
            <p> Password: <input type="text" name="password"/></p> 
            <p><input type="submit" /></p>
        </form>
        <?php
        // put your code here
        ?>
    </body>
</html>
