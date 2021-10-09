<?php 
include('partial/menu.php');
?>    
<div class="main-content">
	<div class="wrapper">
	<h1>Mange Admin</h1>
<br/>
<?php
if(isset($_SESSION['add'])){
	echo $_SESSION['add'];
	unset($_SESSION['add']);
}

if(isset($_SESSION['delete'])){
	echo $_SESSION['delete'];
	unset($_SESSION['delete']);
}
if(isset($_SESSION['update'])){
	echo $_SESSION['update'];
	unset($_SESSION['update']);
}

 if(isset($_SESSION['change-pass'])){
 echo $_SESSION['change-pass'];
 unset($_SESSION['change-pass']);
}

if(isset($_SESSION['pass-not-match'])){
	echo $_SESSION['pass-not-match'];
	unset($_SESSION['pass-not-match']);
}
if(isset($_SESSION['user-not-found'])){
	echo $_SESSION['user-not-found'];
    unset($_SESSION['user-not-found']);
}
 
?>

<br/><br/><br/>
 
<a href="add.admin.php" class="btn-primary">add admin</a>
<br/><br/>
	<table class="full">
		
		<tr>
		    <th>S.N.</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Actions</th>
		</tr>
<?php
        $sql="SELECT * FROM admin";
        $res=mysqli_query($conn, $sql);
        
     if ($res==true) {
      $count=mysqli_num_rows($res);
      $sn=1;
      if($count>0){
          while($rows=mysqli_fetch_assoc($res)){
          $id=$rows['id'];
          $fullname=$rows['fullname'];
          $username=$rows['username'];
          $password=$rows['password'];
?>
       
<tr>
			<td><?php echo $sn++; ?>.</td>
			<td><?php echo $fullname; ?></td>
			<td><?php echo $username;?></td>
			
			<td>
               <a href="<?php echo SITEURL;?>admin/update.pass.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
			   <a href="<?php echo SITEURL;?>admin/update.admin.php?id=<?php echo $id;?>" class="btn-secondary"> Update admin</a>
               <a href="<?php echo SITEURL;?>admin/delete.admin.php?id=<?php echo $id;?>" class="btn-danger"> Delete admin </a> 
  			</td>
		</tr>




<?php
      }
  }
  else{

}
  }
       ?>


	</table>
	</div>
</div>

<?php
include('partial/footer.php');
?>