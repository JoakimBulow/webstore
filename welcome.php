<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<?php
echo "Welcome ";
$user = htmlspecialchars($_POST["user"]);
echo $user;
echo ", you are now logged in. <br>";
?><br>

</body>
</html>