<?php
require "database.php";
    if(isset($_POST['signup'])){
        $username=mysqli_real_escape_string($con,$_POST['username']);
        $password=mysqli_real_escape_string($con,$_POST['password']);
        $email=mysqli_real_escape_string($con,$_POST['email']);
        $password=password_hash($password, PASSWORD_DEFAULT);
        
        $result=mysqli_query($con,"SELECT * FROM accounts WHERE Username='$username'");
        if(mysqli_num_rows($result)>0){
            echo "already exist";
        }else{
            mysqli_query($con,"INSERT INTO accounts(`Username`,`Password`,`email`) VALUES('$username','$password','$email')");
            header("Location: ../index.php?success=Account Created Successfuly");
        }
    }
?>