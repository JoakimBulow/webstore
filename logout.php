<?php
//Destroy session:
session_start();
$_SESSION = array();
session_unset();
session_destroy();

?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">
</html>