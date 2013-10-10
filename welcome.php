<?php
//session_name("DASESSION");

//Check if HTTPS is used:
if (!isset($_SERVER['HTTPS']) || !$_SERVER['HTTPS']) {
    //If not, force HTTPS:
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    exit();
}


$user = htmlspecialchars($_POST["user"]);
$password = htmlspecialchars($_POST["password"]);

//Connecting to database
$sql_database="webmaster";
mysql_connect();
@mysql_select_db($sql_database) or die( "Unable to select database");

//Getting all user names in database
$sql_query = 'SELECT * FROM customers WHERE username=' . safeSQL($user);

$result=mysql_query($sql_query);


if(!empty($user) && $user == mysql_result($result,0,"username")){
    $trueHashedPass = mysql_result($result,0,"password");
    $salt = mysql_result($result,0,"salt");
    //echo 'password in db: ' . $trueHashedPass . '<br>';
    $hashedPass = hash('sha256', $salt . $password);
    //echo 'password entered: ' . $hashedPass . '<br>';
    if($trueHashedPass == $hashedPass){
        session_name("DASESSION");
        session_start();
        session_regenerate_id(true);
        $_SESSION = array();
        // store session data
        $_SESSION['user']=$user;
        $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
        echo "You are now logged in.<br>";
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