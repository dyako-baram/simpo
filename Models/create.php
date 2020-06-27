<?php
session_start();
require "database.php";
if(isset($_POST['insert'])){
    $title=$_POST['title'];
    $detail=$_POST['detail'];
    $id=$_SESSION['accountId'];
    mysqli_query($con,"INSERT INTO `posts`(`UserId`, `PostTitle`, `PostDetail`) VALUES ($id,'$title','$detail')");
    
    header("Location: ../posts/");
}

?>