
<?php

$sql_user="webmaster";
$sql_password="TempPass123";
$sql_database="webmaster";
mysql_connect('localhost',$sql_user,$sql_password);
@mysql_select_db($sql_database) or die( "Unable to select database");

$sql_query="CREATE TABLE customers (id int(6) NOT NULL auto_increment,username varchar(20),password varchar(30),first varchar(15) NOT NULL,last varchar(15) NOT NULL,
address varchar(40) NOT NULL,postal varchar(30) NOT NULL,country varchar(25) NOT NULL,creditcard varchar(25) NOT NULL,PRIMARY KEY (id),UNIQUE id (id),KEY id_2 (id))";

mysql_query($sql_query);

$sql_query = "INSERT INTO customers VALUES ('','JeNoZ','monkey123','John','Smith','2nd Street','22220','Iceland','01234 567891')";
mysql_query($sql_query);
mysql_close();

?>
