<?php
//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();
}
session_name("DASESSION");
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
    echo "Welcome " . $user;
}
else{
    echo "Welcome guest";
}

echo ' to our pet store! Enter in the fields below how many pets you would like:<br><br>';
?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">
<form action="checkout.php" method="post">
    <div style="width:200px;">
    Dogs (300:-)    <input type="text" size="5" name="dog"><br>
    Cats (200:-)    <input type="text" size="5" name="cat"><br>
    Turtles (100:-) <input type="text" size="5" name="turtle"><br><br>
    <input type="submit" value="Add to cart">
    </div>
</form>
</body>

</html>