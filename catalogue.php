<?php
if (isset($_COOKIE["user"]))
    echo "Welcome " . $_COOKIE["user"];
else
    echo "Welcome guest";
echo '! Feel free to browse our inventory:<br>';
?>
<html>
<BODY  BGCOLOR="black"  TEXT="white"  VLINK="yellow" LINK="yellowgreen">
</html>