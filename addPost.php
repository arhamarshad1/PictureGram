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
 //start session 
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

  <title>addPost</title>

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
      <a class="navbar-brand" href="about.php">Lorrem Nullam</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <!-- Links to Navigation bar -->
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
            <h2>ADD NEW POST</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container" style="width:800px; margin:0 auto;">
    <h5 class="card-header">Add a post:</h5>
          <div class="card-body">
            <form method="post" action="#">
              <div class="form-group">
                <label for="postname">Post:</label><br>
                <input class="form-control" type="text" name="postContent" style="width:650px; height:80px;"/>
                <label for="imagename">Image Filename:</label><br>
                <input class="form-control" type="text" name="imageName" style="width:650px; height:40px;"/><br> 
                <input type="submit" name="formSubmit" value="Submit">
              </div>
            </form>
  </div>
  <hr>
  <!-- Add a form for new post -->
<?php
        require_once 'serverLogin.php';
        $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database); //connect to server
        //query database
        if ($conn->connect_error){
            die("Connection failed!" . mysqli_connect_error());
          }
        //check if form is filled by user
        if (isset($_POST['formSubmit'])) {
          if($_POST['formSubmit'] == 'Submit'){
            //get form contents
            $content = $_POST['postContent'];
            $image = $_POST['imageName'];
            $userID = $_SESSION["userid"];
        
        //add data to table
        //$sql = "INSERT INTO Posts (UserID, PostImage, Post) VALUES ('$userID', '$image', '$content')";
        $sql = $conn->prepare("INSERT INTO Posts (UserID, PostImage, Post) VALUES (?, ?, ?)");
        $sql->bind_param("iss", $userID, $image, $content);
        echo "<br>";
        //check if data was succesfully added to the database
        if ($sql->execute() === TRUE) {
        echo "New post created successfully";
        } 
        else {
          echo "Error: ".$sql."<br>".$conn->error;
        }
        $conn->close();
      }
    }
?>

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