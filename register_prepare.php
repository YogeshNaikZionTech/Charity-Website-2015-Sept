<?php 

 
 
 
 //$con=mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) or die("Failed to connect to MySQL: " . mysql_error());
 //$db=mysql_select_db(DB_NAME,$con) or die("Failed to connect to MySQL: " . mysql_error());

 function Registration() {
	 
define('DB_HOST', 'localhost');
 define('DB_NAME', 'login');
 define('DB_USER','root');
 define('DB_PASSWORD',''); 
 
 session_start(); 
 
	 $mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD, DB_NAME);
	 
	 if($mysqli->connect_errno > 0) {
    die('Unable to connect to database [' . $mysqli->connect_error . ']');
}
 
 if (isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']))
 {
	 $user = $_POST['user'];
	 $pass = $_POST['pass'];
	 $fname = $_POST['fname'];
	 $lname = $_POST['lname'];
	 $email = $_POST['email'];
	 $password_hash = password_hash($pass, PASSWORD_DEFAULT);
	
	$stmt = $mysqli->prepare("INSERT INTO `username`(`userName`, `First_Name`, `Last_Name`, `pass`, `email`) VALUES (?, ?, ?, ?, ?)");
	if(!($stmt = $mysqli->prepare("INSERT INTO `username`(`userName`, `First_Name`, `Last_Name`, `pass`, `email`) VALUES (?, ?, ?, ?, ?)"))){
        echo "Prepare failed";
    }
	
	$stmt->bind_param('sssss', $user, $fname, $lname, $password_hash, $email);
    if(!$stmt->bind_param('sssss', $user, $fname, $lname, $password_hash, $email)){
     echo "Binding paramaters failed";
    }

	if($stmt->execute()) {
		echo "Registration success";
	}
	else {
     echo "Registration failed";
    }

	
 }
 $mysqli->close();
	 //$sql = "INSERT INTO `username`(`userName`, `First_Name`, `Last_Name`, `pass`, `email`) VALUES ('$user','$fname','$lname','$pass', '$email')";
	//$sql = "INSERT INTO `username`( `userName`, `pass`) VALUES ('$user',$pass)";
	//$sql = "INSERT INTO 'username' ('UserNameID', 'userName', 'pass') VALUES (NULL, '$user', '$pass')";
 }
	
	//$result = mysql_query($query);
		
		if(isset($_POST['submit']))

			{ Registration(); } 
 
 ?>
 