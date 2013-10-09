<?php
//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}

session_start();

if (isset($_SESSION['HTTP_USER_AGENT']))
{
    if ($_SESSION['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT'])//may create hash of user agent
    {
        session_destroy();
        exit();
    }
}
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    echo "Lets pay " . $user . ", shall we?<br>";

    //Connecting to database
    //connect();

    $sql_user="webmaster";
    $sql_password="TempPass123";
    $sql_database="webmaster";
    mysql_connect('localhost',$sql_user,$sql_password);
    @mysql_select_db($sql_database) or die( "Unable to select database");

    $sql_query = 'SELECT * FROM customers WHERE username=' . $user;//welcome.safeSQL($user);

    $result=mysql_query($sql_query);
    $complete = mysql_result($result,0,"completeInfo");//TODO: get this boolean
    if($complete){
        echo "completeInfo is true<br>" . $complete;
    }
    else{
        echo "completeInfo is false<br>" . $complete;
        displayForm();
    }
    mysql_close();

}
else{
    echo "Please log in before you make a purchase.<br>";
}

$nrOfDogs = htmlspecialchars($_POST["dog"]);
$nrOfCats = htmlspecialchars($_POST["cat"]);
$nrOfTurtles = htmlspecialchars($_POST["turtle"]);

echo "You are trying to purchase: <br> " ;
if(is_numeric($nrOfDogs) && $nrOfDogs > 0){
    echo "" . $nrOfDogs . " dog(s)<br>";
}
if(is_numeric($nrOfCats) && $nrOfCats > 0){
    echo "" . $nrOfCats . " cat(s)<br>";
}
if(is_numeric($nrOfTurtles) && $nrOfTurtles > 0){
    echo "" . $nrOfTurtles . " turtle(s)<br>";
}

//TODO: Check if all necessary info is already in DB, else display a form and ask for it (credit card, address etc).

//Displays a form with the necessary fields that are missing in the DB
function displayForm(){


}

?>

<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

</html>