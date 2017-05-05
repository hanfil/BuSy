<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'logindb');
define('DB_USER','root');
define('DB_PASSWORD','');

$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);// or die("Failed to connect to MySQL: " . mysqli_error());
//$db=mysqli_select_db($con,DB_NAME) or die("Failed to connect to MySQL: " . mysqli_error($con));

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
/*
$ID = $_POST['user'];
$Password = $_POST['pass'];
*/
function SignIn()
{
  global $mysqli;
  session_start(); //starting the session for user profile page
  if(!empty($_POST['user'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text
  {
    $query="SELECT * FROM UserName where userName = '$_POST[user]' AND pass = '$_POST[pass]'";
    $result = $mysqli->query($query);
    $row = $result->fetch_array();
    if(!empty($row['userName']) AND !empty($row['pass']))
    {
      $_SESSION['userName'] = $row['pass'];
      echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
      $mysqli->close();
      file_put_contents('account', $_POST[user]);
      header('Location: '.$uri.'kontaktmodul.php');
    }
    else {
      echo "SORRY... YOU ENTERD WRONG ID AND PASSWORD... PLEASE RETRY...";
    }
  }
}
if (isset($_POST['submit']))
{
  SignIn();
}

$mysqli->close();
 ?>
