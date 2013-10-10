<?php
//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}

session_start();
session_regenerate_id(true);

if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT'])//may create hash of user agent
    {
        //The session now comes from another user agent. Seems fishy so why not just destroy the entire session..?
        session_destroy();
        exit();
    }
}


if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    echo "Now you pay... (" . $user . ")";
}
else{
    echo "WTF, guest?";
}
$dataOK = false;

if(is_null($_POST["surname"])){
    //No form from POST, all user info already in DB?
}
else{
    //Get data from form
    $surname = htmlspecialchars($_POST["surname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);
    $address = htmlspecialchars($_POST["address"]);
    $postal = htmlspecialchars($_POST["postal"]);
    $country = htmlspecialchars($_POST["country"]);
    $creditcard = htmlspecialchars($_POST["creditcard"]);

    if(checkValidity($creditcard)){
        echo "Your credit card is valid<br>";
        if(strlen($surname) > 2 && strlen($surname) < 25 &&
            strlen($lastname) > 2 && strlen($lastname) < 25 &&
            strlen($address) > 2 && strlen($address) < 25 &&
            strlen($country) > 2 && strlen($country) < 25 &&
            strlen($postal) > 2 && strlen($postal) < 25)
        {
            echo "all data ok<br>";
            $dataOK = true;
        }
    }
    if(!$dataOK){
        echo "data was not OK, please enter valid data<br>";
        exit();
    }
}

//Connecting to database
$sql_database="webmaster";
//mysql_connect();
$sql_user="webmaster";
$sql_password="TempPass123";
mysql_connect('localhost',$sql_user,$sql_password);
@mysql_select_db($sql_database) or die( "Unable to select database");

$sql_query = 'SELECT * FROM customers WHERE username=' . safeSQL($user);
$result=mysql_query($sql_query);
$complete = mysql_result($result,0,"completeInfo");



if(!$complete && $dataOK){

    $sql_query = "UPDATE customers SET first = '$surname', last = '$lastname', address = '$address', postal = '$postal',
                    country = '$country', creditcard = '$creditcard', completeInfo = true WHERE username = '$user'";

    mysql_query($sql_query);

}
mysql_close();
function checkValidity($creditcard){
    if(is_numeric($creditcard) && strlen($creditcard) == 8)
        return true;
    else
        return false;
}

function safeSQL( $value ) {
    return '"' . mysql_real_escape_string( $value ) . '"';
}

?>

<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

</html>