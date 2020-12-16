<!-- CSCI 2170
Assignment 5
Arham Arshad 
B00768939
 This page dynaimcally displays content for each individual post and displays the comments on each post using a database this time.
 It also allows new users to comment and saves their comment along with a timestamp to a database called Post, 
 a copy of the database is located in the files folder in A5. Furthermore, sessions have been used in this assignment to keep user logged in or log out.
 Files for assignment 5 are all stored in the files folder.
 Lastly, a secure login and password check has been implemenetd along with the use of prepared statements on each page
 -->
 <?php
session_start();
// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("Location: login.php"); //if not logged in -> go to this page
exit;
}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Post</title>

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
      <a class="navbar-brand" href="about.php"><?php echo $_SESSION["name"];?> </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
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
  <header class="masthead" style="background-image: url('files/<?php echo $_GET['image'];?>')"> 
    <!-- dynamically update background image-->
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <!-- Display date, time and author of the post using query strings -->
            <h1><?php echo $_GET['post'];?></h1>
            <span class="meta">Posted by
              <a href="about.php"><?php echo $_GET['name'];?></a>
              on <?php 
              $date = $_GET['date']; //use querystring to get the date from post
              echo date( 'F jS, Y - g:ia', strtotime($date)); ?></span> <!-- Display time after formatting -->
          </div>
        </div>
      </div>
    </div>
  </header>

 <!-- Post Content -->
  <!-- Template for comment section adpated from https://startbootstrap.com/templates/blog-post/
  on 2nd October 2020 -->
  <article>
    <div class="container" style="width:800px; margin:0 auto;">
      <div class="row">
        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <input class="form-control" type="text" name="comment" style="width:650px; height:80px;"/>
                <br> 
                <input type="submit" name="formSubmit" value="Submit">
              </div>
            </form>
            <?php
          //connect to database
          require_once 'serverLogin.php';
          $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
          if ($conn->connect_error){
            die("Connection failed!" . mysqli_connect_error());
          }
          //create a query string
          $myquery = "SELECT Name, Posts.PostID, Comments.Comment, Comments.Date, Posts.PostImage FROM Users, Comments, Posts WHERE Posts.PostID = Comments.PostID AND Users.UserID = Comments.UserID ORDER BY Comments.Date DESC"; 
          if ($result = $conn->query($myquery)) { //query again using OO approach
            while ($row = $result->fetch_assoc()) {//result as assoc. array //returns col number ?>
          </div>
        </div>

  <!-- Single Comment -->
<?php
        if ($row["PostID"] == $_GET['postid']) { ?>
          <div class="media mb-4" style="width:800px; margin:0 auto;">
          <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
          <div class="media-body">
            <h5 class="mt-0">Date:
          <?php date_default_timezone_set('America/Halifax');
              $authorName = $row["Name"];
              echo date( 'F jS, Y - g:ia', strtotime($row["Date"]))."\nAuthor: $authorName";?>
            </h5> 
              <?php 
                echo $row["Comment"]."<br>"; 
              }
            }
          ?>      
        </div>
        </div>   
        <!-- Dynamically update comment section when the form is filled -->         
            <?php 
            if (isset($_POST['comment'])) {
              if(empty($_POST['comment'])=='Submit'){
                $name = "(Not entered)";
                echo $name; //see if the textbox is filled by user
            }
            else {
              $comments = $_POST['comment'];?> <!-- if button is pressed, get the text from the input forms-->
            <div class="media mb-4" style="width:800px; margin:0 auto;">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
            <h5 class="mt-0">Date: 
        <!-- Display new comments -->
            <?php
            date_default_timezone_set('America/Halifax');
            echo date("F jS, Y - g:ia", time());?></h5><br>
            <?php 
                echo $comments; //display the comments
                $postID = $_GET['postid'];//use query string to get postid of new post
                $userID = $_SESSION["userID"];
                $sql = $conn->prepare("INSERT INTO Comments (UserID, PostID, Comment) VALUES (?, ?, ?)"); //add the new comment to database
                $sql->bind_param("iis", $userID, $postID, $comments);
                $sql->execute();
                echo "<br>";
                if ($conn->query($sql) === TRUE) {
                  echo "New comment added successfully";
                } 
                else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
            ?>
          </div>
        </div>
      </div>
      <?php
            }
        }
?>         
<?php 
        }
          else {
            echo "Nothing here to display! Sorry!";
          }
          $conn->close();
?>
        </div>
      </div>
    </div>
  </article>
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
