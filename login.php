<html>

<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<?php
//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}
else{
    echo "USING HTTPS!<br>";
}
echo "Log in:";

?>

<form action="welcome.php" method="post">
    User name: <input type="text" name="user"><br>
    Password: <input type="text" name="password"><br>
    <input type="submit">
</body>
</html>