<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">

<?php
echo "Welcome";
$user = htmlspecialchars($_POST["user"]);
echo $user;
echo ". You are now registered. Please purchase something expensive.";
?>
</body>
</html>