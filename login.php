<html>

<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<?php
//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();
}

echo 'Log in:<br><br>';

?>

<form action="welcome.php" method="post">
    <div style="width:200px;">
        User name: <input type="text" size="25" name="user"><br>
        Password: <input type="password" size="25" name="password"><br><br>
        <input type="submit" size="25" value="Log in">
    </div>
</body>
</html>