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
if(!isset($_SESSION['user'])){
    echo "Please log in before you make a purchase.<br>";
}

else{
    $user = $_SESSION['user'];
    echo "Lets pay " . $user . ", shall we?<br>";

    //Connecting to database
    $sql_database="webmaster";
    $sql_user="webmaster";
    $sql_password="TempPass123";
    mysql_connect('localhost',$sql_user,$sql_password);

    //mysql_connect();
    @mysql_select_db($sql_database) or die( "Unable to select database");

    $sql_query = 'SELECT * FROM customers WHERE username=' . safeSQL($user);
    $result=mysql_query($sql_query);
    $complete = mysql_result($result,0,"completeInfo");

    //Do we have all the complete info about to user?
    if($complete == 1){
        echo "<form action=\"checkout2.php\">
        <input type=\"submit\" value=\"Commit to buy\">
        </form>";
    }
    else{
        displayForm();
    }

    mysql_close();

    $nrOfDogs = htmlspecialchars($_POST["dog"]);
    $nrOfCats = htmlspecialchars($_POST["cat"]);
    $nrOfTurtles = htmlspecialchars($_POST["turtle"]);

    echo "You are trying to purchase: <br> " ;

    if(is_numeric($nrOfDogs) && $nrOfDogs > 0){
        $_SESSION['dogs']=$nrOfDogs;
    }elseif(is_numeric($_SESSION['dogs'])){
        //User can go to checkout directly from index.php and might have added to cart before.
        $nrOfDogs = $_SESSION['dogs'];
    }else{
        $nrOfDogs = 0;
    }


    if(is_numeric($nrOfCats) && $nrOfCats > 0){
        $_SESSION['cats']=$nrOfCats;

    }elseif(is_numeric($_SESSION['cats'])){
        $nrOfCats = $_SESSION['cats'];
    }else{
        $nrOfCats = 0;
    }

    if(is_numeric($nrOfTurtles) && $nrOfTurtles > 0){
        $_SESSION['turtles']=$nrOfTurtles;
    }elseif(is_numeric($_SESSION['turtles'])){
        $nrOfTurtles = $_SESSION['turtles'];
    }else{
        $nrOfTurtles = 0;
    }
    echo "" . $nrOfDogs . " dog(s)<br>";
    echo "" . $nrOfCats . " cat(s)<br>";
    echo "" . $nrOfTurtles . " turtle(s)<br>";

}

function displayForm(){
//TODO: Display a form with the necessary fields that are missing in the DB

    echo "<br><br>
    <form action=\"checkout2.php\" method=\"post\">
    Surname: <input type=\"text\" name=\"surname\"><br>
    Last name: <input type=\"text\" name=\"lastname\"><br>
    Address: <input type=\"text\" name=\"address\"><br>
    Postal Code: <input type=\"text\" name=\"postal\"><br>
    Country: <input type=\"text\" name=\"country\"><br>
    Credit Card number: <input type=\"text\" name=\"creditcard\"><br>
    <input type=\"submit\" value=\"Commit to buy\">
    <br><br>
    </body>
    </html>";

}

function safeSQL( $value ) {
    return '"' . mysql_real_escape_string( $value ) . '"';
}

?>

<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

</html>