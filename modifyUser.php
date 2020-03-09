<?php
    session_start();
    require_once 'DataBaseConnection.php';
    
    //Update any piece user information other than username or password
    if($_POST[updateType] == 'UserData'){
        $FirstName = $_POST[FirstName];
        $LastName = $_POST[LastName];
        $PhoneNumber = $_POST[PhoneNumber];
        $Address = $_POST[Address];
        $City = $_POST[City];
        $State = $_POST[State];
        $Zip = $_POST[Zip];
        $BirthDate = $_POST[BirthDate];
        $Sex = $_POST[Sex];

        //create query string
        $dbQueryData =  "UPDATE `db_name`.`ecommerce_user_data`"
                ." SET `FirstName`='$FirstName',`LastName`='$LastName',`PhoneNumber`='$PhoneNumber',`Address`='$Address',`City`='$City',`State`='$State',`Zip`='$Zip',`BirthDate`='$BirthDate',`Sex`='$Sex'"
                ." WHERE `UserID` = '$_SESSION[UserID]'";
            // display user and pass coming to this page echo "$username and $password </p>";

        $successData = $con->query($dbQueryData);
        //echo "$dbQueryData";
        if (!$successData) {
            $failmess = "Whole query " . $dbQueryData . "<br>";
            echo $failmess;
            die('Invalid query: ' . mysqli_error($con));
        }

        //set session variable to show self after loadin
        $_POST[selection] = "VIEW_SELF";
    }
    
    //only update the username or password
    elseif($_POST[updateType] == 'UserName-PW'){
        //create query string
        $pw = password_hash($_POST[Password], PASSWORD_DEFAULT);
        $dbQueryData =  "UPDATE `db_name`.`ecommerce_user_creds`"
                ." SET `UserName`='$_POST[UserName]'";
        if(strlen($_POST[Password])>= 1){$dbQueryData .=",`Password`='$pw'";}
        $dbQueryData .= " WHERE `UserID` = '$_SESSION[UserID]'";
            // display user and pass coming to this page echo "$username and $password </p>";

        $successData = $con->query($dbQueryData);
        //echo "$dbQueryData";
        if (!$successData) {
            $failmess = "Whole query " . $dbQueryData . "<br>";
            echo $failmess;
            die('Invalid query: ' . mysqli_error($con));
        }

        //set session variable to show self after loadin
        $_POST[selection] = "VIEW_SELF";
        $_SESSION[UserName] = $_POST[UserName];
    }
    echo "<meta http-equiv=\"refresh\" content=\"0;url=my-account.php\">";