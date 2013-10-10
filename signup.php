<?php

echo "Sign up:<br><br>";

//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();
   }

?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">
<form action="newuser.php" method="post">
    <div style="width:200px;">
    User name: <input type="text" name="user" size="25"><br>
    Password: <input type="password" size="25" name="password" size="25"><br><br>
    <input type="submit" value="Sign up">
        </div>
</form>
</body>
</html> 