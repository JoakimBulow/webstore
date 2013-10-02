<?php
echo "You entered: " . $user = htmlspecialchars($_POST["user"]);

echo " as username<br>";

$password = htmlspecialchars($_POST["password"]);

//Check if a secure password was entered:
$passwordError = array();

if ( strlen( $password ) < 8 ) {
    $passwordError[] = "The password must contain at least eight characters.<br>";
}

if ( !preg_match( '/[0-9]/' , $password )) {
    $passwordError[] = "The password must contain at least one integer.<br>";
}
/*
if ( !preg_match( '/[A-Z]/', $password )) {
    $passwordError[] = "The password must contain at least one special character.<br>";
}
*/
$pswErrCount = count( $passwordError );

if ( $pswErrCount > 0 ) {

    echo '<p>Your password did not meet the following criteria:<br>';

    for ( $i = 0; $i < $pswErrCount; $i++ ) {
        echo $passwordError[$i];
    }
}


else{
    echo 'adding user..<br>';
//Password was secure

    //Connecting to database
    $sql_user="webmaster";
    $sql_password="TempPass123";
    $sql_database="webmaster";
    mysql_connect('localhost',$sql_user,$sql_password);
    @mysql_select_db($sql_database) or die( "Unable to select database");

    //Getting all user names in database
    $sql_query = 'SELECT username FROM customers';
    $result=mysql_query($sql_query);
    $num=mysql_numrows($result);


    $i=0;
    $exist = false;
    while ($i < $num) {
        $username=mysql_result($result,$i,"username");
        if($username == $user){
            $exist = true;
            break;
        }
        $i++;
    }
    if($exist == true){
        echo "That user name is already in use.<br>";
    }else{
        $salt = getSalt();
        $hashedPassword = sha1($salt . $password);
        $sql_query = "INSERT INTO customers VALUES ('','$user','$hashedPassword','$salt','','','','','','')";
        mysql_query($sql_query);
    }
    mysql_close();
}


//Returns a random string to use as salt in passwords
function getSalt() {
    $saltLength = 8;
    $saltCharacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $salt = '';
        for ($i = 0; $i < $saltLength; $i++) {
            $salt .= $saltCharacters[rand(0, strlen($saltCharacters) - 1)];
        }
        return $salt;
}

?>


<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

</body>
</html>