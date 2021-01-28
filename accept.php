<?php
include "dbconnect.php";
     $user_loggedin;
     session_start();
     if ($_SESSION["loggedin"]!=true&&!isset($_SESSION['username'])) {
         header("location:index.php?logtrue=false"); 
     }
     else {
         $user_loggedin=$_SESSION['username'];
     }

     if (isset($_GET["AnswerId"])&&isset($_GET["threadid"])) {

         $answerId=$_GET["AnswerId"];
         $thId=$_GET["threadid"];
         $sql="UPDATE `comments` SET `accepted` = 'yes' WHERE `comments`.`comment_id` = $answerId";
         $result=mysqli_query($conn,$sql);
         header("location:thread.php?threadid=".$thId."");
     }
?>