<?php

$server = 'localhost';                   // MySql server
$username = 'ciao';                      // MySql Username
$password = 'ciao' ;                         // MySql Password
$database = 'my_cpm';                  // MySql Database
//e0fdxiJn
// The following should not be edited
  $con = mysql_connect("$server","$username","$password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("$database", $con); 
?>