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
    <style>
        options {
            background-color: linen;
            float: left;
        }
    </style>        
    </head>
    <body>
        <header>
            <img src="images/Facebook-Banner.jpg"
            width="851"
            height="315"
            alt="You know who we are."
            >
        <p>Welcome to Baud Games.</p>
        <p>"Don't get BORED, get <b>BAUD</b>"</p>            
        </header>
        

        <section class="options">
            <p>Want to play Blackjack?</p>
            <form action="games/Blackjack/game.php"
                method="post"
                <p> Email: <input type="text" name="email"/></p>
                <p><input type="submit" name="play" value="PLAY!"/></p>           
            </form>
        </section>
        
        <section class="options">
            <p>Login to BaudGames server</p>
            <form action="user.php" method="post">
                <p> Email: <input type="text" name="email"/></p>
                <p> Password: <input type="text" name="password"/></p> 
                <p><input type="submit" name="login" value="Log In"/></p>
            </form>
        </section>
        
        <section class="options">
            <p>Create New Account</p>
            <form action="user.php" method="post">
                <p> Name: <input type="text" name="name"/></p>
                <p> Email: <input type="text" name="email"/></p>
                <p> Password: <input type="text" name="password"/></p> 
                <p><input type="submit" name="create" value="Create Account"/></p>
            </form>  
        </section>
        <?php
        // put your code here
        ?>
    </body>
</html>
