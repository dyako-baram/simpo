<?php  session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Login</title>
</head>
<body>
<div class="login-page">
  <div class="form">
    <form class="register-form" action="models/signup.php" method="post">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <input type="email" name="email" placeholder="email address"/>
      <button type="submit" name="signup">create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
<?php
  if(@$_GET['logout']){
    unset($_SESSION['username']);
  }
  if(isset($_SESSION['username'])){
    header("Location: posts/");
  }
  if(isset($_GET['error'])){
      echo "<p class=\"text-danger\">".$_GET['error']."</p>";
  }
  if(isset($_GET['success'])){
      echo "<p class=\"text-primary\">".$_GET['success']."</p>";
  }
?>
  <p>Simpo</p>
    <form class="login-form" action="models/signin.php" method="post">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name="password" placeholder="password"/>
      <button type="submit" name="login">login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>










<script>
    $('.message a').click(function(){
    $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>
</body>
</html>