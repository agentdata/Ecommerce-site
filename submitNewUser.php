<?php
    session_start();
    require_once 'DataBaseConnection.php';
    
    $username = $_POST[username];
    $password = password_hash($_POST[password], PASSWORD_DEFAULT);
    $FirstName = $_POST[FirstName];
    $LastName = $_POST[LastName];
    $PhoneNumber = $_POST[PhoneNumber];
    $Address = $_POST[Address];
    $City = $_POST[City];
    $State = $_POST[State];
    $Zip = $_POST[Zip];
    $BirthDate = $_POST[BirthDate];
    $Sex = $_POST[Sex];

    //create query string for user creds
    $dbQueryCreds =  "INSERT INTO `db_name`.`ecommerce_user_creds` (`UserName`,`Password`) VALUES('$username','$password')";
        // display user and pass coming to this page echo "$username and $password </p>";
    $successCreds = $con->query($dbQueryCreds);

    if (!$successCreds) {
        $failmess = "Whole query " . $dbQueryCreds . "<br>";
        echo $failmess;
        die('Invalid query: ' . mysqli_error($con));
    }
    
    //create query string
    $dbQueryData =  "INSERT INTO `db_name`.`ecommerce_user_data` (`FirstName`,`LastName`,`PhoneNumber`,`Address`,`City`,`State`,`Zip`,`BirthDate`,`Sex`) "
                                                                . "VALUES('$FirstName','$LastName','$PhoneNumber','$Address','$City','$State','$Zip','$BirthDate','$Sex')";
        // display user and pass coming to this page echo "$username and $password </p>";
    $successData = $con->query($dbQueryData);

    if (!$successData) {
        $failmess = "Whole query " . $dbQueryData . "<br>";
        echo $failmess;
        die('Invalid query: ' . mysqli_error($con));
    } 

    $_SESSION[validLogin] = 'newUser';
    $_SESSION[userName] = "$username";
    
    echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";