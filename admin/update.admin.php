<?php
include('partial/menu.php');
?>

<div class="main-content">
	<div class="wrapper">
		<h1>Update Admin</h1>
		<br><br>
      
      <?php
      $id=$_GET['id'];
      $sql="SELECT * FROM admin WHERE id=$id";
      $res=mysqli_query($conn,$sql);
      
      if($res==true){
      	$count=mysqli_num_rows($res);

      	if($count==1){
          $row=mysqli_fetch_assoc($res);
          $fullname=$row['fullname'];
          $username=$row['username'];

      	}
      	else{
      		header('localhost:'.SITEURL.'admin/manage.admin.php');
      }
      	}
      
      ?>


		<form action="" method="post">
			<table class="third">
				<tr>
				<td>Full name</td>
				<td><input type="text" name="fullname" value="<?php echo $fullname;?>">
				</td>
			</tr>
			<tr>
					<td>User name</td>
				<td><input type="text" name="username" value="<?php echo $username;?>" >
				</td>
			</tr>
			<tr>
				<td colspan="2">
                  <input type="hidden" name="id" value="<?php echo $id;?>">
				  <input type="submit" name="submit" value="Update Admin" class="btn-secondary" ></td>
				
             </tr>
			</table>
		</form>
	</div>
</div>

<?php
if(isset($_POST['submit']) ){
	echo  $id=$_POST['id'];
	echo $fullname=$_POST['fullname'];
	echo  $username=$_POST['username'];
	$sql="UPDATE admin SET
    fullname='$fullname',
    username='$username'
	WHERE id='$id'
	";
	$res=mysqli_query($conn,$sql);
	if($res==true){
      $_SESSION['update']="<div class='success'>Admin Updated successfully.</div>";
      header('location:'.SITEURL.'admin/manage.admin.php');
	}
	else{
        $_SESSION['update']="<div class='error'>Failed to Updated </div>";
      header('location:'.SITEURL.'admin/manage.admin.php');
	}
}
?>

<?php
include('partial/footer.php');
?>