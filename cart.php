<?php
    session_start();
    setlocale(LC_MONETARY, 'en_US');
    require_once 'DataBaseConnection.php';
    require_once 'cartFunctions.php';
        
    if(isset($_POST[modifyCart]) &&  $_POST[modifyCart] == true) {
        if($_POST[modifyType]== 'submitOrder'){
            if(submitOrder($con)){
                $_SESSION[submitted] = true;
                $_POST = array();
                echo "<meta http-equiv=\"refresh\" content=\"0;url=cart.php\">";
            }
        }
        else{modifyCart($_POST[productID],$_POST[price],$_POST[modifyType]);}
    }
?>

<html>
    <head>
        <title>Home</title>
        <!-- Link css file here-->
        <link rel="stylesheet" href="style.css" media="screen">
        <style>
        cart-Table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
        tr:nth-child(odd) {
            background-color: #4CAF50;
        }
    </style>
    </head>
        <!-- This is the menu bar -->
        <div class="topnav">
        <a href="index.php">Home</a>
        <a href="catalogue.php">Catalogue</a>
        <a class="active" href="cart.php">Cart: <?php if(isset($_SESSION[cart])){echo "(".$_SESSION[cart][totalItems]." item(s): $".$_SESSION[cart][subTotal]." Total)";}?></a>
        
        <?php
            if($_SESSION["validLogin"] == 'TRUE') {
                echo '<a href="my-account.php">Account</a>';
                echo '<a href="logout.php">Logout</a>';
                // cart icon
            }
            else echo '<a href="registerNewUser.php">Register Now</a>';
        ?>
    </div>
    <div align="center">
        <section class="mainBox">
            <?php 
                if($_SESSION[cart][totalItems]>0) {
                    echo '<table class="cart-Table">';
                    echo '<tr><th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Unit price</th><th>Add/Remove</th><th>Subtotal</th></tr>';
                    //list each of the items in the cart with details
                    foreach($_SESSION[cart] as $key => $value) {
                            $quantity = $_SESSION[cart][$key][quantity];
                            $itemPrice = $_SESSION[cart][$key][itemPrice];
                            if($quantity >0) {
                                echo "<tr>";
                                echo "<th>$key</th>";
                                echo "<th>".getProductName($con,$key)."</th>";
                                echo "<th>$quantity</th>";
                                echo "<th>$$itemPrice</th>";
                                echo '<th>' //increase quantity in cart
                                        . '<form action="cart.php" method="POST">'
                                        . '<input type="hidden" name="modifyCart" value="'.true.'">'
                                        . '<input type="hidden" name="productID" value="'.$key.'">'
                                        . '<input type="hidden" name="price" value="'.$itemPrice.'">'
                                        . '<input type="hidden" name="modifyType" value="add">'
                                        . '<input type="submit" value="+"></form>'
                                            // decrease quantity in cart
                                        . '<form action="cart.php" method="POST">'
                                        . '<input type="hidden" name="modifyCart" value="'.true.'">'
                                        . '<input type="hidden" name="productID" value="'.$key.'">'
                                        . '<input type="hidden" name="price" value="'.$itemPrice.'">'
                                        . '<input type="hidden" name="modifyType" value="remove">'
                                        . '<input type="submit" value="-"></form>'
                                        . '</th>';
                                echo "<th>$".$itemPrice*$quantity."</th>";
                                echo "</tr>";
                            }
                    }
                    //list the totals of the cart and show submit order button
                    echo '<tr><th colspan="6"></th></tr><tr><th colspan="6"></th></tr>'
                    . '<tr><th colspan="3">Total Items: '.$toPrint = $_SESSION[cart][totalItems].'</th><th colspan="2">Subtotal</th><th>$'.$toPrint = round($_SESSION[cart][subTotal],2).'</th></tr>'
                    . '<tr><th colspan="3"></th><th colspan="2">Tax(6.7855)</th><th>$'.$toPrint = round((($_SESSION[cart][subTotal]*1.06785)-$_SESSION[cart][subTotal]),2).'</th></tr>'
                    . '<tr><th colspan="3"></th><th colspan="2">Total with Tax(6.7855)</th><th>$'.$toPrint = round(($_SESSION[cart][subTotal]*1.06785),2).'</th></tr>'
                    . '<tr><th colspan="5"></th><th>';
                    
                    //Check if user is logged in, display either a submit order button or a button to first register.
                    if($_SESSION[validLogin] == true){
                        echo '<form action="cart.php" method="POST"><input type="hidden" name="modifyCart" value="'.true.'">'
                           . '<input type="hidden" name="modifyType" value="submitOrder"><input type="submit" value="Submit Order"></form>';
                    }
                    
                    else{
                        echo '<form action="registerNewUser.php">'
                           . '<input type="submit" value="Register To Order"></form>';
                        echo '<form action="index.php">'
                           . '<input type="submit" value="Sign In To Order"></form>';
                    }
                    //////////////////////////////////////////////////////////////////
                    
                    echo
                      '</th></tr>'
                    . '<tr><th colspan="5"></th><th>'
                            . '<form action="cart.php" method="POST"><input type="hidden" name="modifyCart" value="'.true.'">'
                            . '<input type="hidden" name="modifyType" value="clearCart"><input type="submit" value="Clear Cart"></form>'
                    . '</th></tr>';
                    echo '</table>';
                }
                else if($_SESSION[submitted]== true){
                    echo "your order has been successfully submitted.</br>"
                    . "please check your account page for order details.";
                    $_SESSION[submitted] = false;
                    
                }
                    
                else{
                    echo'there are no items in your cart.';
                }
                $con->close();
            ?>
        </section>
    </div>
</html>