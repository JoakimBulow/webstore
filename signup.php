<?php

echo "Sign up:<br>";

//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    //exit();
   }
else{
    echo "USING HTTPS!<br>";
}

?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">
<form action="newuser.php" method="post">
    User name: <input type="text" name="user"><br>
    Password: <input type="text" name="password"><br>
    Address: <input type="text" name="address"><br>
    <input type="submit">
</form>
</body>
</html> 