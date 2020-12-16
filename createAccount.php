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
require_once 'serverLogin.php';
$_SESSION["loggedin"] = false;
      $conn = new mysqli($db_hostname, $db_username, $db_password, $db_database);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
$message = "";

//check if form button is pressed
if(isset($_POST['formSubmit'])){
      //collect data from form
      $userName = $_POST['UserName'];
      $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
      $name = $_POST['Name'];
      $about = $_POST['About'];
      $image = $_POST['Image'];

      //query database
      //$sql = "SELECT * FROM Login WHERE Username = '$userName'";
      $sql = $conn->prepare("SELECT * FROM Login WHERE Username = ?");
      $sql->bind_param("s",$userName);
      $sql->execute();
      $myquery = $sql->get_result();
      $dbUsername;
      $dbPassword;

      if ($myquery->num_rows > 0){
        while ($row = $myquery->fetch_assoc()) {
            //get data from database to check whether same usernames are not created
            $dbUsername = $row["Username"]; 
            $dbPassword = $row["Password"];
            $dbUserid = $row["UserID"];
    }   
  }
  if($userName == $dbUsername){
        $message = "Username already exists.";    
      }
  //create regex expressions
  $noSpecial = "/\W/"; 
  $oneUpper = "/[A-Z]+/";
  $oneNum = "/[0-9]/";
  
  //check if input password is atleast 7 characters long
  if(strlen($_POST['Password']) < 7){
    $message = $message."ERROR! <br> Password must be at least 7 characters in length <br>";
  }
  //check if there are no special chaacters in the password
  if((!preg_match($noSpecial, $_POST['Password']))){
    $message = $message."ERROR! <br> Need atleast one special character in password <br>";
  }
  //check if there is atleast One upper case character
  if(!(preg_match($oneUpper, $_POST['Password']))){
    $message = $message."ERROR! <br> Need at least one Upper case character <br>";
  }
  //check if there is atleast One numeric character
  if(!(preg_match($oneNum, $_POST['Password']))){
    $message = $message."ERROR! <br> Need at least one numeric character <br>";
  }
  else{
        //otherwise create the new account and direct user to index.php
        $sql1 = $conn->prepare("INSERT INTO Users (Name, About, AboutImage) VALUES(?, ?, ?)");
        $sql1->bind_param("sss",$name, $about, $image);
        
        if ($sql1->execute() === TRUE) {
                  $userID = $conn->insert_id;
                  $sql2 = $conn->prepare("INSERT INTO Login (UserID, Username, Password) VALUES(?, ?, ?)");
                  $sql2->bind_param("sss",$userID, $userName, $password);
                  
                  if ($sql2->execute() === TRUE) {
                    //save sessions
                    $_SESSION["username"] = $userName;
                    $_SESSION['password'] = $password;
                    $_SESSION["name"] = $name;
                    $_SESSION["userid"] = $userID;
                    $_SESSION["loggedin"] = true;
                    //redirect to new page 
                    header("Location: index.php");
                    exit;
                  }
                  else {
                  echo "Error: " . $sql2 . "<br>" . $conn->error;
                }
                } 
                else {
                  echo "Error: " . $sql1 . "<br>" . $conn->error;
                }

      }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Create Account</title>

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
      <a class="navbar-brand" href="#">picturegram</a>
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
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addPost.php">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
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
          <div class="page-heading">
            <h1>picturegram</h1>
            <h2>CREATE ACCOUNT</h2>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form method="post" action="createAccount.php">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="Name" name="Name" required data-validation-required-message="Please enter your UserName.">
              <p class="help-block text-danger"></p>
              <label>Tell us about you</label>
              <input type="text" class="form-control" placeholder="Tell us about you" name="About" required data-validation-required-message="Please enter your UserName.">
              <p class="help-block text-danger"></p>
              <label>Image</label>
              <input type="text" class="form-control" placeholder="Image" name="Image" required data-validation-required-message="Please enter your UserName.">
              <p class="help-block text-danger"></p>
              <label>UserName</label>
              <input type="text" class="form-control" placeholder="User Name" name="UserName" required data-validation-required-message="Please enter your UserName.">
              <p class="help-block text-danger"></p>
              <label>Password</label>
              <input type="Password" class="form-control" placeholder="Password" name="Password" required data-validation-required-message="Please enter your UserName.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <br>
            <button type="submit" class="btn btn-primary" name="formSubmit" value="Submit">Create account</button>
            <?php echo "<br>".$message;?>
          </div>
          </div>
          </div>
          </form>
      </div>
    </div>
  </div>
  <hr>
  <!-- Footer -->
  <footer>
    <div class="container">
          <p class="copyright text-muted">Copyright &copy; Your Website 2020</p>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <script src="js/contact_me.js"></script>

  <!-- Custom scripts for this template -->
<script src="js/clean-blog.min.js"></script>
</body>
</html>
