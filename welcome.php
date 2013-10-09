<?php
//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
}


$user = htmlspecialchars($_POST["user"]);
$password = htmlspecialchars($_POST["password"]);
echo "You are trying to log in with the user name: " . $user . "...<br>";

//Connecting to database
$sql_database="webmaster";
//mysql_connect();
$sql_user="webmaster";
$sql_password="TempPass123";
mysql_connect('localhost',$sql_user,$sql_password);

@mysql_select_db($sql_database) or die( "Unable to select database");

//Getting all user names in database
$sql_query = 'SELECT * FROM customers WHERE username=' . safeSQL($user);

$result=mysql_query($sql_query);


if(!empty($user) && $user == mysql_result($result,0,"username")){
    echo 'yes that user exists<br>';

    $trueHashedPass = mysql_result($result,0,"password");
    $salt = mysql_result($result,0,"salt");
    echo 'password in db: ' . $trueHashedPass . '<br>';
    $hashedPass = sha1($salt . $password);
    echo 'password entered: ' . $hashedPass . '<br>';
    if($trueHashedPass == $hashedPass){
        echo 'you are authenticated<br>';

        session_start();
        session_regenerate_id(true);
        // store session data
        $_SESSION['user']=$user;
        $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];

    }
}
else{
    echo "Incorrect user name and/or password. <br>";
}

mysql_close();

function safeSQL( $value ) {
    return '"' . mysql_real_escape_string( $value ) . '"';
}
?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">


</body>
</html>