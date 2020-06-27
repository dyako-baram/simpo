<?php
session_start();

require "database.php";
if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    
    $result=mysqli_query($con,"SELECT * FROM accounts WHERE Username='$username'");
    if(mysqli_num_rows($result)>0){
        while($rows=mysqli_fetch_assoc($result)){
        $accountid=$rows['AccountId'];
        $usernamedb=$rows['Username'];
        $passworddb=$rows['Password'];
        $permission=$rows['Permission'];
        $email=$rows['email'];
        
            $passwordHashed=password_verify ($password ,  $passworddb );
            if($username==$usernamedb && $passwordHashed){
                $_SESSION['username']=$username;
                $_SESSION['accountId']=$accountid;
                $_SESSION['Permission']=$permission;
                header("Location: ../posts/");
            }else{
                echo "wrong";
                header("Location: ../index.php?error=Incorrect Login Detail");
            }
        }
    }else{
        header("Location: ../index.php?error=Incorrect Login Detail");
    }
}
?>