<?php
session_start(); require "../Models/database.php";
if($_SESSION['Permission']==0){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Admin Panel</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand text-uppercase" href="#">Welcome <?php echo $_SESSION['username'];?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="../posts/index.php">Posts
            </a>
          </li>
          <li class="nav-item">
          <a href="../index.php?logout=logout" class="nav-link text-danger">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
  <h2 class="my-2 text-center text-success">Posts</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col text-uppercase">Post Id</th>
      <th scope="col text-uppercase">Post Title</th>
      <th scope="col text-uppercase">Post Detail</th>
      <th scope="col text-uppercase">Username</th>
      <th scope="col text-uppercase">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        if(isset($_GET['del'])){
            $delId=$_GET['del'];
        mysqli_query($con,"DELETE FROM posts where PostId=$delId");
        }
        if(isset($_GET['delu'])){
            $delI=$_GET['delu'];
        mysqli_query($con,"DELETE FROM accounts where AccountId=$delI");
        }

      ?>
      <?php
        $result=mysqli_query($con,"SELECT * FROM posts INNER JOIN accounts ON posts.UserId = accounts.AccountId");
        while($row=mysqli_fetch_assoc($result)){
            $rowArr=[$row['PostTitle'],$row['PostDetail'],$row['Username'],$row['PostId']];
            echo "<tr>
      <th scope=\"row\">$rowArr[3]</th>
      <td>$rowArr[0]</td>
      <td>$rowArr[1]</td>
      <td>$rowArr[2]</td>
      <td><a href=\"index.php?del=$rowArr[3]\">Delete Post</a></td>
    </tr>";
        }
      ?>
    
  </tbody>
</table>
      <h2 class="my-2 text-center text-success">Users</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col text-uppercase">account id</th>
      <th scope="col text-uppercase">username</th>
      <th scope="col text-uppercase">permission</th>
      <th scope="col text-uppercase">email</th>
      <th scope="col text-uppercase">Action</th>
    </tr>
  </thead>
  <tbody>
      <?php
        $result=mysqli_query($con,"SELECT * FROM Accounts");
        while($row=mysqli_fetch_assoc($result)){
            $rowArr=[$row['AccountId'],$row['Username'],$row['Permission'],$row['email']];
            if($rowArr[2]==0){
                $rowArr[2]="User";
            }else if($rowArr[2]==1){
                $rowArr[2]="Admin";
            }
            echo "<tr>
                <th scope=\"row\">$rowArr[0]</th>
                <td>$rowArr[1]</td>
                <td>$rowArr[2]</td>
                <td>$rowArr[3]</td>
                <td><a href=\"index.php?delu=$rowArr[0]\">Delete Account</a></td>
                </tr>";
        }
      ?>
    
  </tbody>
</table>
</div>
</body>
</html>