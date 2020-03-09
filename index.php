<?php
        session_start();
        setlocale(LC_MONETARY, 'en_US');
?>
<html>
    <script type="text/javascript">
        if('@Session["validLogin"]' == false){
            window.onload = function() {document.getElementById("username").focus();};
        }
    </script>
    <head>
        <title>ecommerce Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Link css file here-->
        <link rel="stylesheet" href="/style.css" media="screen">
    </head>
    <div class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="cart.php">Cart: <?php if(isset($_SESSION[cart])){echo "(".$_SESSION[cart][totalItems]." item(s): $".$_SESSION[cart][subTotal]." Total)";}?></a>
        
        <?php
            if($_SESSION["validLogin"] == 'TRUE') {
                echo '<a href="my-account.php">Account</a>';
                echo '<a href="logout.php">Logout</a>';
                // cart icon
            }
            else echo '<a href="registerNewUser.php">Register Now</a>';
        ?>
    </div>
    
    <body>
        <div align="center">
        <section class="mainBox">
        <?php
            if($_SESSION[validLogin] != 'TRUE') {
                if($_SESSION[validLogin] == 'notFound'){echo "User not found, register new account below";}
                elseif($_SESSION[validLogin] == 'badPWgoodUN'){echo"PASSWORD not valid, please try again!";}

                echo "<form id=\"login\" class=\"login\" action=\"validateLogin.php\" method=\"POST\"><table><tr><th colspan=\"2\">"
                . "<input required class=\"username\" id=\"username\" type=\"text\" name=\"username\" placeholder='User Name'";

                if($_SESSION[validLogin] == 'newUser' || 'badPWgoodUN'){echo $_SESSION[userName];} 
                echo "\"></th></tr>";
                echo '<tr><th colspan="2"> '
                . '<input required class="password" type="password" name="password" placeholder="Password"></th></tr>'
                . '</table></form>';
                //log on button
                echo '<button type="submit" form="login" value="Submit" class="loginNow">Login</button>';

                //dynamic register now button that appears if the user account doesn't exist
                if($_SESSION["validLogin"] == 'notFound') {
                    echo'<button class="registerNow" action="/registerNewUser.php" >Register Now.</button>';
                }
            }

            elseif($_SESSION[validLogin] == 'TRUE') {
                echo 'Thank you '.$_SESSION[UserName].' for being a valued customer';
            }
        ?>
        </section>
        </div>    
    </body>
</html>