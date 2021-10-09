<?php
include('../config/constant.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login-Food Order System</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
<div class="login">
	<h1 class="text-center">Login</h1>
	<br>
<?php
 if(isset($_SESSION['login'])){
 	echo $_SESSION['login'];
 	unset($_SESSION['login']);
 }
if(isset($_SESSION['no-login-message'])){
	echo $_SESSION['no-login-message'];
	unset($_SESSION['no-login-message']);
}
?>
	<form action="" method="POST" class="text-center">
		Username:<br>
		<input type="text" name="username" placeholder="Type your username">
		<br><br>
		Password:<br>
		<input type="password" name="password" placeholder="Type your Password">
		<br><br>
		<input type="submit" name="submit" value="Login" class="btn-primary">
	</form>
     <br><br>
 <p class="text-center">Created By-<a href="https://www.facebook.com/profile.php?id=100027084735056">islam zamkan</a></p>
</div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
	 $username=$_POST['username'];
	 $password=md5( $_POST['password']);
	$sql="SELECT * FROM admin WHERE username='$username' AND password='$password'";
   $res=mysqli_query($conn,$sql);
   $count=mysqli_num_rows($res);
if($count==1){
$_SESSION['login']="<div class='success'>Login Successful</div>";
$_SESSION['user']=$username;

header('location:'.SITEURL.'admin/');
}
else{
$_SESSION['login']="<div class='error text-center'>Failed to login</div>";
header('location'.SITEURL.'admin/login.php');
}
}
?>
