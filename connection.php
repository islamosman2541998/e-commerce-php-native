<?php  
  session_start();
   $host="sql7.freesqldatabase.com";
   $dbName="sql7723064";
   $dbType="mysql";
   $userName="sql7723064";
   $password="p6VXsXdAEg";

   $connection=new PDO("$dbType:host=$host;dbname=$dbName",$userName,$password);
?>