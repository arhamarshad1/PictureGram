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
 <?php // Initialize the session
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

  <title>about</title>

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
<?php 

//connect to database
  require_once 'serverLogin.php';
  $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
    if ($conn->connect_error){
        die("Connection failed!" . mysqli_connect_error());
    }
          //get data
          $userid = $_SESSION["userid"];
          $authorName = $_GET['author'];
          $userAbout = $_GET['userid'];
          
          $myquery = $conn->prepare("SELECT * FROM Users WHERE UserID = ?");
          $myquery->bind_param("s",$userAbout);
          $myquery->execute();
          $query = $myquery->get_result();

          if ($query->num_rows > 0) { //query again using OO approach
          while ($row = $query->fetch_assoc()) {//result as assoc. array ?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?name=<?php echo $row["Name"];?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
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
    <header class="masthead" style="background-image: url('files/<?php echo ($row["AboutImage"]);?>')">

  <!-- Page Header -->
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1><?php echo $row["Name"];?></h1>
            <span class="subheading">This is what I do.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p><?php echo $row["About"]?></p>
        <?php 
          }
        }
          else {
          echo "Nothing here to display! Sorry!";
          }
          $conn->close();
?>
      </div>
    </div>
  </div>
  <hr>

  <!-- Footer -->
  <footer>
    <div class="container">
          <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
        </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>
</html>
