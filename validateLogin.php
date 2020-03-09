<?php
    session_start();
    require_once 'DataBaseConnection.php';
    
    $username = $_POST[username];
    $password = $_POST[password];

    //return all for the username requested, check hashed pw below
    $dbQuery =  "SELECT * FROM `db_name`.`ecommerce_user_creds` "
            . "WHERE `UserName` = '$username'";
    $success = $con->query($dbQuery);

    if (!$success) {
        $failmess = "Whole query " . $dbQuery . "<br>";
        echo $failmess;
        die('Invalid query: ' . mysqli_error($con));
    } 

    $returnArray = $success->fetch_assoc();
    //if username is matched, then verify username and the hashed password.
    //then a successful login accomplished then redirect to the relationship.php page after setting a few variables.
    if(count($returnArray[UserName]) == 1 && $returnArray[UserName] == $username && password_verify($password, $returnArray[Password])){
        echo "successful match";
        $_SESSION[UserID]       = $returnArray[userID];
        $_SESSION[UserName]     = $returnArray[UserName];
        $_SESSION[validLogin]   = 'TRUE';
        $_SESSION[selection]    = 'HOME';
        unset($_POST);
        clearLogin();
        
        //echo "your userid is".$_SESSION[UserID].'</p>'."and post is ".$returnArray[UserID];
        echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
    }
    
    //OR
    // send back to login page with some post data
    else if($returnArray[UserName] == $username) {
        echo "Good username and bad pw";
        $_SESSION[validLogin] = 'badPWgoodUN';
        $_SESSION[userName] = $username;
        clearLogin();
        echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
    }
    
    else if(count($returnArray[UserName]) > 1){
        unset($_POST);
        clearLogin();
        echo 'There has been an internal server error, please contact support. error u5261';
    }
    
    //OR
    // Send back to login page and display no known user
    else{
        echo "both name and pw bad";
        $_SESSION[validLogin] = 'notFound';
        clearLogin();
        echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";
    }
    
    $con->close();
    
    function clearLogin(){
        $returnArray    = null;
        $username       = null;
        $password       = null;
        $_POST          = array();
    }
    