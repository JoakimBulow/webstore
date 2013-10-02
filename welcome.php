<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<?php
$user = htmlspecialchars($_POST["user"]);
$password = htmlspecialchars($_POST["password"]);
echo "I can see you are trying to log in " . $user . "...";

//Connecting to database
$sql_user="webmaster";
$sql_password="TempPass123";
$sql_database="webmaster";
mysql_connect('localhost',$sql_user,$sql_password);
@mysql_select_db($sql_database) or die( "Unable to select database");

//Getting all user names in database
$sql_query = 'SELECT * FROM customers WHERE username=' . safeSQL($user);

echo "<br>" . $sql_query . "<br>";
$result=mysql_query($sql_query);


if($user == mysql_result($result,0,"username")){
    echo 'yes that user exists<br>';

    $trueHashedPass = mysql_result($result,0,"password");
    $salt = mysql_result($result,0,"salt");
    echo 'password in db: ' . $trueHashedPass . '<br>';
    $hashedPass = sha1($salt . $password);
    echo 'password entered: ' . $hashedPass . '<br>';
    if($trueHashedPass == $hashedPass){
        echo 'you are authenticated<br>';
    }
}

mysql_close();

function safeSQL( $value ) {
    return '"' . mysql_real_escape_string( $value ) . '"';
}
?>



</body>
</html>