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
        //echo "Wrong User Agent.. <br>";
        //echo "<br>Session user agent: " . $_SESSION['HTTP_USER_AGENT'];
        //echo "<br>Server user agent: " . $_SERVER['HTTP_USER_AGENT'];
        session_destroy();
        exit();
    }
}


if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    echo "Welcome " . $user;
}
else{
    echo "Welcome guest";
}
/*
//For cookies:
if (isset($_COOKIE["user"]))
    echo "Welcome " . $_COOKIE["user"];
else
    echo "Welcome guest";
*/

echo ' to our pet store! Enter in the fields below how many pets you would like:<br>';
?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">
<form action="checkout.php" method="post">
    Dogs: <input type="text" name="dog"><br>
    Cats: <input type="text" name="cat"><br>
    Turtles: <input type="text" name="turtle"><br>
    <input type="submit">
</form>
</body>

</html>