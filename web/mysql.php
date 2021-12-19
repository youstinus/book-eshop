<?php

$con=mysqli_connect('localhost','root','','knygos');
mysqli_query($con, "SET NAMES 'utf8'");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
?>