<?php
include('partial/menu.php');
?>
<div class="main-content" >
	<div class="wrapper">
		<h1>Add Admin</h1>
         
         <br><br>

		<form action="add.admin.php" method="post">
			<table class="third">
				<tr>
				<td>Full name</td>
				<td><input type="text" name="fullname" placeholder="Type your full name" required></td>
				</tr>

				<tr>
				<td>User name</td>
				<td><input type="text" name="username" placeholder="Type your user name" required></td>
				</tr>
				<tr>
				<td>Password</td>
				<td><input type="Password" name="password" placeholder="Type your password" required></td></tr>
				<tr>
					<td colspan="2">

						<input type="submit" name="submit" class="btn-secondary" 
						value="Add Admin"  >
           
					</td>
				</tr>

			</table>
		</form>
	</div>
</div>

<?php 
include('partial/footer.php');
?>



<?php
if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        }

if(isset($_POST['submit'])){
	$fullname=$_POST['fullname'];
	$username=$_POST['username'];
	$password=md5( $_POST['password']); 
	$sql = "INSERT INTO admin (fullname,username,password)
     VALUES ('$fullname','$username','$password')";
     $res=mysqli_query($conn, $sql);
     if ($res==true) {
         $_SESSION['add']="<div class='success'>Admin Added successfully.</div>";
	header('location:'.SITEURL.'admin/manage.admin.php');
     }
      
      else {
        $_SESSION['add']="<div class='error'>Failed to Add admin.</div>";
	header('location:'.SITEURL.'admin/manage.admin.php');
     }
     
     mysqli_close($conn);
}
?>
