<?php
    session_start();
    setlocale(LC_MONETARY, 'en_US');
    require_once 'DataBaseConnection.php';
    if(strlen($_POST[profileSelection])>1) {
    $_SESSION[profileSelection] = $_POST[profileSelection];
    }
?>
<script src="inputValidation.js"></script>
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
        <a href="catalogue.php">Catalogue</a>
        <a href="cart.php">Cart: <?php if(isset($_SESSION[cart])){echo "(".$_SESSION[cart][totalItems]." item(s): $".$_SESSION[cart][subTotal]." Total)";}?></a>
        <?php
            if($_SESSION["validLogin"] == 'TRUE') {
                echo '<a class="active" href="my-account.php">Account</a>';
                echo '<a href="logout.php">Logout</a>';
                // cart icon
            }
            else echo '<a href="registerNewUser.php">Register Now</a>';
        ?>
    </div>
    <div align="center">
        <section class="mainBox">
        <?php
            if($_SESSION[validLogin] == 'TRUE') {
                
                //forms for the my account buttons----------------------------------
                echo '<form id="my-account" name="my-account" action="my-account.php" method="POST"><input type="hidden" name="profileSelection" value="home"></input></form>'                            
                . '<form id="modifyUserInfo" name="modifyUserInfo" action="my-account.php" method="POST"><input type="hidden" name="profileSelection" value="modifyUserInfo"></input></form>'
                . '<form id="orders" name="orders" action="my-account.php" method="POST"><input type="hidden" name="profileSelection" value="orders"></input></form>'
                .'<button type="submit" form="my-account" value="Submit" class="myaccount-btns">Home</button>'
                .'<button type="submit" form="orders" value="Submit" class="myaccount-btns">My Orders</button>'
                .'<button type="submit" form="modifyUserInfo" value="Submit" class="myaccount-btns">My Info</button>';

                echo "<hr noshade> </p> ";
                //------------------------------------------------------------------
                
                
                if($_SESSION[profileSelection] != ("modifyUserInfo" or "orders") || $_SESSION[profileSelection] == 'home') {echo"this is the home page for my account";}
                
                
                elseif($_SESSION[profileSelection] == 'modifyUserInfo') {
                    //echo "your userid is".$_SESSION[UserID].'</p>';
                    echo "Your own data, enter modifications in the right column</br>";
                    $dbQuery = "SELECT * FROM `db_name`.`ecommerce_user_data` "
                            . "WHERE `userID` ='$_SESSION[UserID]'";
                    $success = $con->query($dbQuery);

                    if (!$success) {
                        $failmess = "Whole query " . $dbQuery . "<br>";
                        echo $failmess;
                        die('Invalid query: ' . mysqli_error($con));
                    }
                    // arrays for easy table creation
                    $dataHeaders = ['FirstName','LastName','PhoneNumber','Address','City','State','Zip','BirthDate','Sex'];
                    $displayHeaders = ['First Name','Last Name','Phone Number','Address','City','State','Zip','Birth Date','Sex'];

                    echo '<table class="tableDATA">';
                    echo '<form id="modifyUser" action="modifyUser.php" method="POST">';
                    echo '<tr><th colspan="3" text-align: center>User information</th></tr>';

                    while($returnArray = $success->fetch_assoc()) {
                        $count = 0;
                        foreach($returnArray as $item){
                            //keep track of count in order to skip the userID

                            if ($count < count($dataHeaders)){
                                //display row title
                                echo "<tr><th>$displayHeaders[$count]</th>";
                                //display current user data data
                                if($dataHeaders[$count] == 'BirthDate'){
                                    echo "<th><input type=\"date\" name=\"$dataHeaders[$count]\" id=\"$dataHeaders[$count]\" value=\"$item\"></tr>";
                                }
                                elseif($dataHeaders[$count] == 'Sex'){
                                    echo "<th><input type=\"radio\" name=\"$dataHeaders[$count]\" id=\"$dataHeaders[$count]\" value=\"Male\"";
                                        if($item == "Male"){echo "checked=\"checked\"";}
                                        echo ">Male
                                        <input type=\"radio\" name=\"Sex\" id=\"$dataHeaders[$count]\" value=\"Female\"";
                                        if($item == "Female"){echo "checked=\"checked\"";}
                                        echo ">Female<br></th></tr>";
                                }
                                elseif($dataHeaders[$count] == 'RelationshipToBrantly'){
                                    $relationships = ["Parent","Sibling","Spouse","Child","Aunt/Uncle","Cousin","Grandparent","Friend","Teacher","Colleague"];
                                    echo "<th><select name=\"RelationshipToBrantly\" id=\"$dataHeaders[$count]\">";
                                    foreach($relationships as $type){
                                        if($type == $item)
                                            echo "<option value=\"$type\" selected>$type</option>";
                                        else
                                            echo "<option value=\"$type\">$type</option>";
                                    }
                                    echo "</select></th>";
                                }
                                elseif ($dataHeaders[$count] == 'State'){
                                    echo "<th><select name=\"$dataHeaders[$count]\" id=\"$dataHeaders[$count]\">";
                                    echo '<option></option>';
                                    echo'<option value="AL"'; if($item == 'AL'){echo 'selected';}echo'>AL - Alabama</option>';
                                    echo'<option value="AK"'; if($item == 'AK'){echo 'selected';}echo'>AK - Alaska</option>';
                                    echo'<option value="AZ"'; if($item == 'AZ'){echo 'selected';}echo'>AZ - Arizona</option>';
                                    echo'<option value="AR"'; if($item == 'AR'){echo 'selected';}echo'>AR - Arkansas</option>';
                                    echo'<option value="CA"'; if($item == 'CA'){echo 'selected';}echo'>CA - California</option>';
                                    echo'<option value="CO"'; if($item == 'CO'){echo 'selected';}echo'>CO - Colorado</option>';
                                    echo'<option value="CT"'; if($item == 'CT'){echo 'selected';}echo'>CT - Connecticut</option>';
                                    echo'<option value="DE"'; if($item == 'DE'){echo 'selected';}echo'>DE - Delaware</option>';
                                    echo'<option value="DC"'; if($item == 'DC'){echo 'selected';}echo'>DC - District Of Columbia</option>';
                                    echo'<option value="FL"'; if($item == 'FL'){echo 'selected';}echo'>FL - Florida</option>';
                                    echo'<option value="GA"'; if($item == 'GA'){echo 'selected';}echo'>GA - Georgia</option>';
                                    echo'<option value="HI"'; if($item == 'HI'){echo 'selected';}echo'>HI - Hawaii</option>';
                                    echo'<option value="ID"'; if($item == 'ID'){echo 'selected';}echo'>ID - Idaho</option>';
                                    echo'<option value="IL"'; if($item == 'IL'){echo 'selected';}echo'>IL - Illinois</option>';
                                    echo'<option value="IN"'; if($item == 'IN'){echo 'selected';}echo'>IN - Indiana</option>';
                                    echo'<option value="IA"'; if($item == 'IA'){echo 'selected';}echo'>IA - Iowa</option>';
                                    echo'<option value="KS"'; if($item == 'KS'){echo 'selected';}echo'>KS - Kansas</option>';
                                    echo'<option value="KY"'; if($item == 'KY'){echo 'selected';}echo'>KY - Kentucky</option>';
                                    echo'<option value="LA"'; if($item == 'LA'){echo 'selected';}echo'>LA - Louisiana</option>';
                                    echo'<option value="ME"'; if($item == 'ME'){echo 'selected';}echo'>ME - Maine</option>';
                                    echo'<option value="MD"'; if($item == 'MD'){echo 'selected';}echo'>MD - Maryland</option>';
                                    echo'<option value="MA"'; if($item == 'MA'){echo 'selected';}echo'>MA - Massachusetts</option>';
                                    echo'<option value="MI"'; if($item == 'MI'){echo 'selected';}echo'>MI - Michigan</option>';
                                    echo'<option value="MN"'; if($item == 'MN'){echo 'selected';}echo'>MN - Minnesota</option>';
                                    echo'<option value="MS"'; if($item == 'MS'){echo 'selected';}echo'>MS - Mississippi</option>';
                                    echo'<option value="MO"'; if($item == 'MO'){echo 'selected';}echo'>MO - Missouri</option>';
                                    echo'<option value="MT"'; if($item == 'MT'){echo 'selected';}echo'>MT - Montana</option>';
                                    echo'<option value="NE"'; if($item == 'NE'){echo 'selected';}echo'>NE - Nebraska</option>';
                                    echo'<option value="NV"'; if($item == 'NV'){echo 'selected';}echo'>NV - Nevada</option>';
                                    echo'<option value="NH"'; if($item == 'NH'){echo 'selected';}echo'>NH - New Hampshire</option>';
                                    echo'<option value="NJ"'; if($item == 'NJ'){echo 'selected';}echo'>NJ - New Jersey</option>';
                                    echo'<option value="NM"'; if($item == 'NM'){echo 'selected';}echo'>NM - New Mexico</option>';
                                    echo'<option value="NY"'; if($item == 'NY'){echo 'selected';}echo'>NY - New York</option>';
                                    echo'<option value="NC"'; if($item == 'NC'){echo 'selected';}echo'>NC - North Carolina</option>';
                                    echo'<option value="ND"'; if($item == 'ND'){echo 'selected';}echo'>ND - North Dakota</option>';
                                    echo'<option value="OH"'; if($item == 'OH'){echo 'selected';}echo'>OH - Ohio</option>';
                                    echo'<option value="OK"'; if($item == 'OK'){echo 'selected';}echo'>OK - Oklahoma</option>';
                                    echo'<option value="OR"'; if($item == 'OR'){echo 'selected';}echo'>OR - Oregon</option>';
                                    echo'<option value="PA"'; if($item == 'PA'){echo 'selected';}echo'>PA - Pennsylvania</option>';
                                    echo'<option value="RI"'; if($item == 'RI'){echo 'selected';}echo'>RI - Rhode Island</option>';
                                    echo'<option value="SC"'; if($item == 'SC'){echo 'selected';}echo'>SC - South Carolina</option>';
                                    echo'<option value="SD"'; if($item == 'SD'){echo 'selected';}echo'>SD - South Dakota</option>';
                                    echo'<option value="TN"'; if($item == 'IN'){echo 'selected';}echo'>TN - Tennessee</option>';
                                    echo'<option value="TX"'; if($item == 'TX'){echo 'selected';}echo'>TX - Texas</option>';
                                    echo'<option value="UT"'; if($item == 'UT'){echo 'selected';}echo'>UT - Utah</option>';
                                    echo'<option value="VT"'; if($item == 'VT'){echo 'selected';}echo'>VT - Vermont</option>';
                                    echo'<option value="VA"'; if($item == 'VA'){echo 'selected';}echo'>VA - Virginia</option>';
                                    echo'<option value="WA"'; if($item == 'WA'){echo 'selected';}echo'>WA - Washington</option>';
                                    echo'<option value="WV"'; if($item == 'WV'){echo 'selected';}echo'>WV - West Virginia</option>';
                                    echo'<option value="WI"'; if($item == 'WI'){echo 'selected';}echo'>WI - Wisconsin</option>';
                                    echo'<option value="WY"'; if($item == 'WY'){echo 'selected';}echo'>WY - Wyoming</option>';
                                    echo '</select></p></th></tr>';
                                }
                                else{
                                    echo "<th><input type=\"hidden\" name=\"updateType\" value=\"UserData\"><input type=\"text\" name=\"$dataHeaders[$count]\" id=\"$dataHeaders[$count]\" value=\"$item\"></tr>";
                                }
                            }
                            $count += 1;
                        }
                    }
                    echo '</form></table>';
                    //submit button
                    echo "<button type=\"submit\" form=\"modifyUser\" onclick=\"return(validateModifyUser());\" value=\"Submit\">Update User Credentials</button></p>";
                    //echo "<tr align=\"right\"><th colspan=\"3\"><input type=\"submit\" onclick=\"return(validateModifyUser());\" value=\"Update User Data\"></th></tr>";
                   
                   
                   
                   echo '<table><form id="modifyUserCreds" name="modifyUserCreds" action="modifyUser.php" method="POST">';
                   echo "<tr><th colspan=\"4\">User Credentials</th></tr>";
                   echo "<tr><th>User Name</th><th><input type=\"text\" name=\"UserName\" id=\"username\" value=\"$_SESSION[UserName]\"></th></tr>";
                   echo "<tr><th>Password</th><th><input type=\"hidden\" name=\"updateType\" value='UserName-PW'><input type=\"password\" name=\"Password\" id=\"password\"></th></tr></form></table>";
                   echo '<button type="submit" form="modifyUserCreds" value="Submit">Update User Credentials</button>';
                   //echo "<tr align=\"right\"><th colspan=\"3\"><input type=\"submit\" onclick=\"return(validateModifyUserCreds());\" value=\"Update User Name/Password\"></th></tr></form></table>";
                }
                elseif($_SESSION[profileSelection] == 'orders') {

                    //show the order history
                    echo "Your basic order information will be shown here<hr noshade>";

                    ///////////////////////////////////////////////////////////
                    //display all items here

                    echo '</p></p>All available items being displayed.';
                    $dbQuery =  "SELECT * FROM `db_name`.`ecommerce_orders` WHERE $_SESSION[UserID] = userID ORDER BY orderDate";
                    $success = $con->query($dbQuery);

                    if (!$success) {
                        $failmess = "Whole query " . $dbQuery . "<br>";
                        echo $failmess;
                        die('Invalid query: ' . mysqli_error($con));
                    }

                    echo "<table class=\"tableDATA\">";
                    echo "<tr><th>Order ID</th><th>Order Status</th><th>Order Date</th><th>Order Total $$</th><th>btn to view</th>";

                    while($returnArray = $success->fetch_assoc()){
                        $count = 0;
                        $productID = null;
                        echo '<tr>';
                        foreach($returnArray as $item){
                            //keep track of count in order to skip the userID
                            $count += 1;
                            if($count == 2){ 
                                //skip because this is the USer ID
                            }
                            elseif($count == 3){
                                $x = intval($item);
                                switch($x){
                                    case 0:echo "<th>Processing</th>"; break;
                                    case 1:echo "<th>Shipped</th>"; break;
                                    case 2:echo "<th>Complete<t/h>"; break;
                                }           
                            }
                            elseif($count == 5){
                                echo "<th>".money_format("%.2n", intval($item))."</th>";
                            }
                            else{
                                echo "<th>".$item."</th>";   
                            }
                        }
                        echo "<th>Button</th>";
                        echo "</tr>";
                    }
                    echo '</table>';
                }
            }
            else{echo "invalid login, redirect to home page."; echo "<meta http-equiv=\"refresh\" content=\"0;url=index.php\">";}
            $con->close();
        ?>    
        </section>
    </div>
</html>