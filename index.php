<!-- CSCI 2170
Assignment 5
Arham Arshad 
B00768939
 This page dynaimcally displays content for each individual post and displays the comments on each post using a database this time.
 It also allows new users to comment and saves their comment along with a timestamp to a database called Post, 
 a copy of the database is located in the files folder in A5. Furthermore, sessions have been used in this assignment to keep user logged in or log out.
 Files for assignment 5 are all stored in the files folder.
 Lastly, a secure login and password check has been implemenetd along with the use of prepared statements on each page

 NOTE:
 The code to unset all session variables is included in logout.php. When user clicks on logout
 the session will then be destroyed.
 -->
 <?php // Initialize the session
session_start();
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
  header("Location: login.php"); //if not logged in -> go to this page
  exit;
}
require_once 'serverLogin.php';
          $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database); //connect to server
          if ($conn->connect_error){
            die("Connection failed!" . mysqli_connect_error());
          }
          $userid = $_SESSION["userid"]; 
          $username = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
          $username->bind_param("s",$userid);
          $username->execute();
          $query = $username->get_result();
          
          if ($query->num_rows > 0){
            while ($row = $query->fetch_assoc()) { 
              $_SESSION["currentUser"] = $row["Name"];
              $_SESSION["userID"] = $row["UserID"];
?>             
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>picturegram</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>
<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand" href="about.php?userid=<?php echo $_SESSION["userID"];?>"><?php echo $row["Name"];?></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <?php
       }   
  }
?>
      <!-- Links to navigation bar -->
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php?userid=<?php echo $_SESSION["userID"];?>">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addPost.php">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/logo.jpg')">
    <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
           <div class="site-heading">
            <h1>picturegram</h1>
            <span class="subheading">your life in pictures</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="post-preview">
          <?php
          $myquery = "SELECT * FROM Posts, Users  WHERE Posts.UserID = Users.UserID Order BY PostID DESC"; //create SQL query
          if ($result = $conn->query($myquery)) { //query again using OO approach
            while ($row = $result->fetch_assoc()) { //result as assoc. array //returns col number 
                $userid = $row["UserID"];
                $_SESSION["postauthor"] = $row["Name"];
                $_SESSION["postid"] = $row["PostID"];
              ?>
          <a href="post.php?image=<?php echo $row["PostImage"];?>&post=<?php echo($row["Post"]);?>&date=<?php echo $row["Date"];?>&name=<?php echo $row["Name"];?>&postid=<?php echo $row["PostID"];?>">
          <img src="files/<?php echo($row["PostImage"]);?>" style= "width: 720px; height: 380px;">
          <h3 class="post-subtitle"><b>
            <?php echo($row["Post"]); // displays the content stored in each text file?>
          </h3>
        </b> 
      </a>
        <p class="post-meta">Posted by
            <a href="about.php?userid=<?php echo $userid?>">
            <?php 
            echo ($row["Name"]);?></a> on <?php
            date_default_timezone_set('America/Halifax'); //setting the time zone
            echo date('F jS, Y - g:ia', strtotime($row["Date"]));?></p> <!-- Display date after formatting -->
            <?php 
          }
        }
        //display error otherwise
          else {
          echo "Nothing here to display! Sorry!";
          }
          $conn->close();
?>         
        <hr>
        <hr>
        <!-- Pager -->
        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>
      </div>
    </div>
   </div>
  <hr>
  <!-- Footer -->
  <footer>
      <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
    </div>
   </div>
  </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>
</html>