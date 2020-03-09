<?php
    session_start();
    setlocale(LC_MONETARY, 'en_US');
    require_once 'DataBaseConnection.php';
    include 'cartFunctions.php';
    if( $_POST[selection] == 'viewAll' ){
        $_SESSION[selection] = 'home';
        $_SESSION[searchVal] = '';
        $_SESSION[searchType] = '';
    }
    if(isset($_POST[addToCart]) &&  $_POST[addToCart] == true){
        addToCart($_POST[productID],$_POST[price],$_POST[quantity]);
    }
?>

<script src="inputValidation.js"></script>
<script type="text/javascript">
    function confirmQuantity(){
        if(document.getElementById("quantity").value > 0 ){
            alert("quantity above 0.");
            return true;
        } 
        else{ 
            alert("You must enter a quantity more than 1 in order to add to cart.");
            return false;
        }
    }
</script>

<html>
    <head>
        <title>Home</title>
        <!-- Link css file here-->
        <link rel="stylesheet" href="style.css" media="screen">
        <style>
        tableDATA {
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
        <a class="active" href="catalogue.php">Catalogue</a>
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
        <div align="center">
        <section class="mainBox">
            <?php
                //display search bar    
                echo '<form name="product_search" action="product-search.php" method="POST">
                    <input class=\"username\" type="text" name="searchVal" id=\"searchVal\" '; if(strlen($_SESSION[searchVal]) > 0){echo"value=\"$_SESSION[searchVal]\"";}
                            else {echo'placeholder="Search"';}echo'>
                    <select name="searchType" id="searchType">
                        
                        <option value="contains" '; if($_SESSION[searchType] == "contains")echo"selected";
                            echo'>Contains</option>
                        <option value="startsWith" '; if($_SESSION[searchType] == "startsWith")echo"selected";
                            echo'> Starts with</option>
                        
                    <input type="submit" value="search">
                </form>
                <form name="product_search" action="catalogue.php" method="POST">
                    <input type="hidden" name="selection" value="viewAll">
                    <input type="hidden" name="searchVal" value="">
                    <input type="submit" value="View All Products">
                </form><br><br>';
                if($_SESSION[selection] == 'returnSearch'){
                    echo '</p></p>items from search being displayed.';
                    echo "<table class=\"tableDATA\">";
                    echo "<tr><th>ProductID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th>add</th>";
                    
                    $count = 0;
                    echo '<tr>';
                    foreach($_SESSION[searchResults] as $item){
                        $count += 1;
                        if ($count == 1){ $productID = intval($item); echo"<tr>";}
                        if ($count <= 3){ echo "<th>$item</th>";}
                        if ($count == 4){ $price = intval($item);
                            $formatteditem = money_format("%.2n",intval($item));
                            echo "<th>".$formatteditem."</th>";
                        }
                        
                        if ($count == 5){ 
                            echo "<th><img src=\"$item\" width=\"100\" height=\"100\">";
                            echo '<th>qty:<form name="addToCart" id="addToCart" action="catalogue.php" method="POST">'
                                . '<input type="hidden" name="productID" value="'.$productID.'">'
                                . '<input type="hidden" name="price" value="'.$price.'">'
                                . '<input type="number" id ="quantity" name="quantity" min="1" max="5" value="1">'
                                . '<input type="hidden" name="addToCart" value="'.true.'">'
                                . '<input type="submit" value="Add To Cart"></form>';
                            echo "</tr>";
                            $count = 0;
                        }
                    }
                   echo '</table>';
                }
                elseif($_SESSION[selection] != 'returnSearch'){
                    ///////////////////////////////////////////////////////////
                    //display all items here
                    
                    echo '</p></p>All available items being displayed.';
                    $dbQuery =  "SELECT * FROM `db_name`.`ecommerce_products` ORDER BY ProductID";
                    $success = $con->query($dbQuery);

                    if (!$success){
                        $failmess = "Whole query " . $dbQuery . "<br>";
                        echo $failmess;
                        die('Invalid query: ' . mysqli_error($con));
                    }

                    echo "<table class=\"tableDATA\">";
                    echo "<tr><th>ProductID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th><th>add</th>";

                    while($returnArray = $success->fetch_assoc()){
                        $count = 0;
                        $productID = null;
                        echo '<tr>';
                        //print_r($returnArray);
                        foreach($returnArray as $item){
                            //keep track of count in order to skip the userID
                            $count += 1;
                            
                            if($count == 1){$productID = $item;}
                            if($count <= 3){echo "<th>".$item."</th>";}
                            if($count == 4){ $price = intval($item); $formatteditem = money_format("%.2n",intval($item)); echo "<th>$formatteditem</th>";}
                            if($count == 5){ echo "<th><img src=\"$item\" width=\"100\" height=\"100\">";}
                        }
                        echo '<th>qty:<form name="addToCart" id="addToCart" action="catalogue.php" method="POST">'
                                . '<input type="hidden" name="productID" value="'.$productID.'">'
                                . '<input type="hidden" name="price" value="'.$price.'">'
                                . '<input type="number" id ="quantity" name="quantity" min="1" max="5" value="1">'
                                . '<input type="hidden" name="addToCart" value="'.true.'">'
                                . '<input type="submit" value="Add To Cart"></form>';
                        echo "</tr>";
                   }
                   echo '</table>';
                }
                $con->close();
            ?>
        </section>
        </div>
</html>