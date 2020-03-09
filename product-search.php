<?php
    session_start();
    require_once 'DataBaseConnection.php';
    
    $_SESSION[searchResults] = array();
    $_SESSION[searchVal] = $_POST[searchVal];
    $_SESSION[searchType] = $_POST[searchType];
    
    //create query string
    if($_POST[searchType] == 'contains'){
        $dbQueryData = "SELECT * FROM `db_name`.`ecommerce_products` WHERE (`Name` LIKE '%$_POST[searchVal]%' or `Description` LIKE '%$_POST[searchVal]%') ORDER BY ProductID";
    }
    elseif($_POST[searchType] == 'startsWith'){
        $dbQueryData = "SELECT * FROM `db_name`.`ecommerce_products` WHERE (`Name` LIKE '$_POST[searchVal]%' or `Description` LIKE '$_POST[searchVal]%') ORDER BY ProductID";
    }
    else $dbQueryData = "SELECT * FROM `db_name`.`ecommerce_products`";
    $successData = $con->query($dbQueryData);
    
    //print error if there is one (`Name` LIKE '%$_POST[searchVal]%' or `Description` LIKE '%$_SESSION[
    if (!$successData) {
        $failmess = "Whole query " . $dbQueryData . "<br>";
        echo $failmess;
        die('Invalid query: ' . mysqli_error($con));
    }
    
    //write contents of the returned query to a new array and add that to a session variable
    $returnArray = array();
    while($sqlResults = $successData->fetch_assoc()){
        foreach($sqlResults as $item) {
            array_push($returnArray, $item);
        }
    }
    
    $_SESSION[selection]= "returnSearch";
    $_SESSION[searchResults] = $returnArray;
    echo "<meta http-equiv=\"refresh\" content=\"0;url=catalogue.php\">";