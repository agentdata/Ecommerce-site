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
        <title>Brantly CSIS 2440 - ecommerce Home</title>
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
           
    </body>
</html>