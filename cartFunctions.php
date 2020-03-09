<?php
    session_start();
    
    function modifyCart($productID, $itemPrice, $modifyType,$con){
            switch($modifyType){
            case 'add': addToCart($productID, $itemPrice, 1); break;
            case 'remove': removeFromCart($productID, $itemPrice); break;
            case 'clearCart': clearCart(); break;
            //case 'submitOrder': submitOrder($con); break;
            default: break;
        }
    }
    
    function addToCart($productID, $itemPrice, $quantity){
        if($_SESSION[cart][$productID][quantity] == 0){
        $_SESSION[cart][$productID][itemPrice] = $itemPrice;}
        
        $_SESSION[cart][$productID][quantity] += $quantity;
        $_SESSION[cart][totalItems] += $quantity;
        $_SESSION[cart][subTotal] += $itemPrice*$quantity;
    }
    
    function removeFromCart($productID, $itemPrice){
        $_SESSION[cart][$productID][quantity] --;
        $_SESSION[cart][totalItems] --;
        $_SESSION[cart][subTotal] -= $itemPrice;
        if($_SESSION[cart][totalItems]<=0){clearCart();}
    }
    
    function clearCart(){
        unset($_SESSION[cart]);
    }
    
    function submitOrder($con){
        $subTotal = $_SESSION[cart][subTotal];
        $date = date('Y-m-d H:i:s');
        $dbQuery = "INSERT INTO `db_name`.`ecommerce_orders` (`UserID`, `orderStatus`, `orderDate`, `Subtotal`) VALUES('$_SESSION[UserID]', '0', '$date', '$subTotal')";
        //$dbQuery = mysql_fix_string($con, $dbQuery);
        if ($con->query($dbQuery) === TRUE) {
            clearCart();
            return true;
        }
        else{
            echo "there was an error.";
            die('Invalid query: ' . mysqli_error($con));
        }
    }
    
    function getProductName($con, $productID) {
        
        $dbQuery = "SELECT Name FROM `db_name`.`ecommerce_products` WHERE `ProductID` = $productID";
        $dbQuery = mysql_fix_string($con, $dbQuery);
        $success = $con->query($dbQuery);

        if (!$success) {
            $failmess = "Whole query $dbQuery <br>";
            echo $failmess;
            die('Invalid query: ' . mysqli_error($con));
            return 'error with productID';
        }
        else {
            $retArray = array();
            while ($row = $success->fetch_assoc()) {
                array_push($retArray,$row);
            }
            echo $retArray[Name];
            return $retArray[0]["Name"];
        }    
    }