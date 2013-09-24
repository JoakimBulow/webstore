<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<?php
echo "You entered: ";
$user = htmlspecialchars($_POST["user"]);
echo $user;
echo " as username<br>";

//TODO: hash password
$password = htmlspecialchars($_POST["password"]);

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
    $sql_query = "INSERT INTO customers VALUES ('','$user','$password','','','','','','')";
    mysql_query($sql_query);
}
mysql_close();

?>
</body>
</html>