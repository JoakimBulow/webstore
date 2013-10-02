<?php
//To check local cookies in your browser go to chrome://settings/cookies and search for 'localhost'

//Setting the expiration date to one hour ago to delete the cookie
setcookie("user", "", time()-3600);
?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">
</html>