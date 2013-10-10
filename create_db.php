<?php
/*
 * This file is for debug purposes only.
 */
$sql_database="webmaster";

mysql_connect();

@mysql_select_db($sql_database) or die( "Unable to select database");

$sql_query="CREATE TABLE customers (id int(6) NOT NULL auto_increment,username varchar(25),password varchar(64),salt varchar(8),surname varchar(20) ,lastname varchar(20),
address varchar(40), postal varchar(30), country varchar(25), creditcard varchar(25), completeInfo BOOLEAN, PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";

mysql_query($sql_query);
$salt = 'saltsalt';
$pw = 'monkey123';
$hashedpassword = hash('sha256', $salt . $pw);
$sql_query = "INSERT INTO customers VALUES ('','JeNoZ','$hashedpassword','saltsalt','John','Smith','2nd Street','22220','Iceland','01234 567891', true)";
mysql_query($sql_query);
mysql_close();

?>
