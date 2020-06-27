<?php session_start(); require "../Models/database.php";?>
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
    <title>Posts</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Simpo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
            <?php
                if($_SESSION['Permission']==1){
                    echo "<li class=\"nav-item\">
            <a class=\"nav-link\" href=\"../cms/index.php\">Admin</a>
          </li>";
                }
            ?>
          <li class="nav-item">
          <a href="../index.php?logout=logout" class="nav-link text-danger">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <div class="container">
            <div class="display-4 d-inline-block mb-4 mt-3">Simpo Post</div>
    </div>
    <!-- Page Content -->
  <div class="container">
  <a class="btn btn-outline-info" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Create a Post</a>
        <hr>
        <form class="mb-5 collapse multi-collapse" id="multiCollapseExample1" action="../models/create.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlInput1" class="text-success">Create a Post:</label>
                <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="MY Post" required>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="text-success">Post Detail:</label>
                <textarea class="form-control" name="detail" id="exampleFormControlTextarea1 " rows="2" placeholder="Detail About The Post"></textarea>
            </div>
            <button  type="submit" name="insert" class="btn btn-outline-success">Create My Post</button>
        </form>
<div class="row">
  <!-- Blog Entries Column -->
  <div class="col-md-12">
    <!-- Blog Post -->
    <?php
    if(@$_GET['delete']){
        $delId=$_GET['delete'];
        mysqli_query($con,"DELETE FROM posts where PostId=$delId");
    }
    $PostResult=mysqli_query($con,"SELECT * FROM posts INNER JOIN accounts ON posts.UserId = accounts.AccountId order by PostId DESC");
    while($Rows=mysqli_fetch_assoc($PostResult)){
        $resultArr=[$Rows['Username'],$Rows['PostId'],$Rows['PostTitle'],$Rows['PostDetail']];
       
        echo "<div class=\"card mb-4\">
        <div class=\"card-body\">
          <h2 class=\"card-title\">$resultArr[2]</h2>
          <p class=\"card-text\">$resultArr[3]</p>
        </div>
        <div class=\"card-footer text-muted\">
        <div class=\"row\">
            <div class=\"col-11\ pl-2 text-primary\">By $resultArr[0]</div>
            
        ";
        if($resultArr[0]==$_SESSION['username']){
            echo "<div class=\"col\"><a href=\"index.php?delete=$resultArr[1]\">Detele</a></div>";
        }
         echo "</div>
        </div>
      </div>";
    }
    ?>
</body>
</html>