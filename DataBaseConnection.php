<?php
$host = "";
$user = "";
$password = '';
$dbname = "";

$con = new mysqli($host, $user, $password, $dbname)
        or die('Could not connect to the database server.  ' . mysqli_connect_error($con));

if($con->connect_errno > 0){echo "we've got an issue.";}

function mysql_fix_string($conn, $string)
{
    if (get_magic_quotes_gpc()){$string = stripslashes($string);}
    $string = htmlentities($string);
    return $conn->real_escape_string($string);
}
