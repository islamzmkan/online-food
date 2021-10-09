<?php include('partial/menu.php') ?>
<div class="main-content" >
	<div class="wrapper">
		<h1>Change Password</h1>
      <br><br>
    <?php
    
   if(isset($_GET['id'])){
   	$id=$_GET['id'];
   }
    ?>

      <form action="" method="POST">
      	<table class="third">
      		<tr>
      			<td>Current Password</td>
      			<td>
      				<input type="Password" name="current_password" placeholder="Type Current password">
      			</td>
      		</tr>

      		<tr>
      			<td>New Password</td>
      			<td>
      				<input type="Password" name="new_password" placeholder="Type new password">
      			</td>
      		</tr>
             
             <tr>
             	<td>Confirm Password</td>
             	<td>
             		<input type="Password" name="confirm_password" placeholder="Type confirm password">
             	</td>
             </tr>
             <tr>
             	<td colspan="2">
             		<input type="hidden" name="id" value="<?php echo $id;?>">
             		<input type="submit" name="submit" value="change password" class="btn-secondary">
             	</td>
             </tr>
      	</table>

      </form>

		</div>
	</div>
<?php
if(isset($_POST['submit'])){
	$id=$_POST['id'];
	$current_password=md5( $_POST['current_password']);
	$new_password=md5( $_POST['new_password']);
	$confirm_password=md5( $_POST['confirm_password']);
	$sql="SELECT * FROM admin WHERE id=$id AND password='$current_password'";
	$res=mysqli_query($conn,$sql);
	if($res==true){
		$count=mysqli_num_rows($res);
	
if($count==1){ 
    if($new_password==$confirm_password){
     $sql2="UPDATE admin SET password='$new_password' WHERE id=$id";
     $res2=mysqli_query($conn,$sql2);

     if($res2==true){
      $_SESSION['change-pass']="<div class='success'>Pass changed success.</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');
     }

     else{
      $_SESSION['change-pass']="<div class='error'>failed to change pass.</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');
     }
    }
    
    else{
     $_SESSION['pass-not-match']="<div class='error'>Pass not match.</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');
    }
	}

	else{
     $_SESSION['user-not-found']="<div class='error'>user-not-found.</div>";
    header('location:'.SITEURL.'admin/manage.admin.php');
	}
	
	}
}
?>


<?php include('partial/footer.php')?>