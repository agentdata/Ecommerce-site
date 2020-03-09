<html>
    <script src="inputValidation.js">
               
    </script>
    <head>
        <title>User Registration</title>
        
        <!-- Link css file here-->
        <link rel="stylesheet" href="/style.css" media="screen">
    </head>
    <div class="topnav">
        <a href="index.php">Home</a>
        <a href="catalogue.php">Catalogue</a>
        <a href="cart.php">Cart</a>
        <?php
            if($_SESSION["validLogin"] == 'TRUE') {
                echo '<a href="my-account.php">Account</a>';
                echo '<a href="Logout.php">Logout</a>';
                // cart icon
            }
            else echo '<a class="active" href="registerNewUser.php">Register Now</a>';
        ?>
    </div>
    
    <body>
        <div align="center">
        <section class="mainBox">
            <form name="user_registration" action="submitNewUser.php" method="POST">
                <table width="700p">
                    <tr> <th>Username :</th><th> <input type="text" id="username" name="username"></th></tr>
                    <tr> <th>Password :</th><th> <input type="password" id="password" name="password"></th></tr>
                    <tr> <th colspan="2"><hr noshade></th></tr>
                    <tr> <th>First Name :</th><th> <input type="text" id="FirstName" name="FirstName"></th></tr>
                    <tr> <th>Last Name :</th><th> <input type="text" id="LastName" name="LastName"></th></tr>
                    <tr> <th>Phone Number :</th><th> <input type="text" id="PhoneNumber" name="PhoneNumber"></th></tr>
                    <tr> <th>Address :</th><th> <input type="text" id="Address" name="Address"></th></tr>
                    <tr> <th>Zip :</th><th> <input type="text" id="Zip" name="Zip"></th></tr>
                    <tr> <th>City :</th><th> <input type="text" id="City" name="City"></th></tr>
                    <tr> <th>State :</th><th>
                        <select name="State" id="State">
                            <option>--</option>
                            <option value="AL">AL - Alabama</option>
                            <option value="AK">AK - Alaska</option>
                            <option value="AZ">AZ - Arizona</option>
                            <option value="AR">AR - Arkansas</option>
                            <option value="CA">CA - California</option>
                            <option value="CO">CO - Colorado</option>
                            <option value="CT">CT - Connecticut</option>
                            <option value="DE">DE - Delaware</option>
                            <option value="DC">DC - District Of Columbia</option>
                            <option value="FL">FL - Florida</option>
                            <option value="GA">GA - Georgia</option>
                            <option value="HI">HI - Hawaii</option>
                            <option value="ID">ID - Idaho</option>
                            <option value="IL">IL - Illinois</option>
                            <option value="IN">IN - Indiana</option>
                            <option value="IA">IA - Iowa</option>
                            <option value="KS">KS - Kansas</option>
                            <option value="KY">KY - Kentucky</option>
                            <option value="LA">LA - Louisiana</option>
                            <option value="ME">ME - Maine</option>
                            <option value="MD">MD - Maryland</option>
                            <option value="MA">MA - Massachusetts</option>
                            <option value="MI">MI - Michigan</option>
                            <option value="MN">MN - Minnesota</option>
                            <option value="MS">MS - Mississippi</option>
                            <option value="MO">MO - Missouri</option>
                            <option value="MT">MT - Montana</option>
                            <option value="NE">NE - Nebraska</option>
                            <option value="NV">NV - Nevada</option>
                            <option value="NH">NH - New Hampshire</option>
                            <option value="NJ">NJ - New Jersey</option>
                            <option value="NM">NM - New Mexico</option>
                            <option value="NY">NY - New York</option>
                            <option value="NC">NC - North Carolina</option>
                            <option value="ND">ND - North Dakota</option>
                            <option value="OH">OH - Ohio</option>
                            <option value="OK">OK - Oklahoma</option>
                            <option value="OR">OR - Oregon</option>
                            <option value="PA">PA - Pennsylvania</option>
                            <option value="RI">RI - Rhode Island</option>
                            <option value="SC">SC - South Carolina</option>
                            <option value="SD">SD - South Dakota</option>
                            <option value="TN">TN - Tennessee</option>
                            <option value="TX">TX - Texas</option>
                            <option value="UT" selected>UT - Utah</option>
                            <option value="VT">VT - Vermont</option>
                            <option value="VA">VA - Virginia</option>
                            <option value="WA">WA - Washington</option>
                            <option value="WV">WV - West Virginia</option>
                            <option value="WI">WI - Wisconsin</option>
                            <option value="WY">WY - Wyoming</option>
                        </select></p></th></tr>
                    <tr> <th>Birth Date :</th><th> <input type="date" id="BirthDate" name="BirthDate" value="1985-01-01"></th></tr>
                    <tr colspan="2"> <th>Sex :</th><th> <input type="radio" id="Sex" name="Sex" value="Male">Male
                                            <input type="radio" id="Sex" name="Sex" value="Female">Female<br></th></tr>
                            
                    <tr> <th colspan="2"><hr noshade></th></tr>
                    <tr> <th> <button><a href="index.php">Go back to Login page.</a></button></th><th><input type="submit" onclick="return(validateForm());"value="Register"></th>
                </table>
            </form>
            <div id="errorlog">

        </div>
        </section>
        </div>
   </body>
</html>