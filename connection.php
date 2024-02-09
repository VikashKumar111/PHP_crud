<?php
   
   $con= mysqli_connect("localhost","root","","stu_crud");
   if(mysqli_connect_errno()){
    die("can not connected to database".mysqli_connect_errno());
   }

   define("UPLOAD_SRC",$_SERVER['DOCUMENT_ROOT']."/students/uploads/");
   define("FETCH_SRC","http://127.0.0.1/students/uploads/");
?>