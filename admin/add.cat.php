<?php
include('partial/menu.php')
?>
<div class="main-content">
	<div class="wrapper">
		<h1>add Category</h1>
		<br><br>
      <?php
    if(isset($_SESSION['add'])){
    	echo $_SESSION['add'];
    	unset ($_SESSION['add']);

    }
if(isset($_SESSION['upload'])){
    	echo $_SESSION['upload'];
    	unset ($_SESSION['upload']);
    	
    }
    ?>
 <br><br>

		<form action="add.cat.php" method="POST" enctype="multipart/form-data">
			<table class="third">
				<tr>
					<td>title</td>
					<td>
					<input type="text" name="title" placeholder="Type your title">
				</td>
				</tr>
                
               <tr>
               	<td>Select image:</td>
               	<td>
               		<input type="file" name="image_name">
               	</td>
               </tr>

				<tr>
					<td>Featured:</td>
					<td>
						<input type="radio" name="featured" value="Yes" >Yes
						<input type="radio" name="featured" value="No">No
					</td>
				</tr>

				<tr>
					<td>Active</td>
					<td>
						<input type="radio" name="active" value="Yes" >Yes
						<input type="radio" name="active" value="No">No
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" name="submit" value="add Category" class="btn-secondary">
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
     if(isset($_POST['submit'])){
     	
     	$title=$_POST['title'];
     if(isset($_POST['featured'])){
     	$featured=$_POST['featured'];
     	}
     	else{
     	$featured="No";
     	}
      if(isset($_POST['active'])){
     	$active=$_POST['active'];
     	}
     	else{
     	$active="No";
     	}



       if(isset($_FILES['image_name']['name'])){
      
       $image_name=$_FILES['image_name']['name'];
      if($image_name!=""){

       $ext=end(explode('.', $image_name));
       $image_name="Food_Category_".rand(000,999).'.'.$ext;

       $source_path=$_FILES['image_name']['tmp_name'];
       $distination_path="../images".$image_name;
       $upload=move_uploaded_file($source_path,$distination_path);

       if($upload==false){
        $_SESSION['upload']="<div class='error'>Failed to upload</div>";
        header('location:'.SITEURL.'admin/manage.category.php');
        die();
       }
       $remove_path="../images".$current_image;
       $remove=unlink($remove_path);
       
       }
       
}

       else
       {
       	$image_name="";
       }


      // print_r($_FILES['image_name']);
       //die();        

       $sql="INSERT INTO cat (title,image_name,featured,active)value('$title','$image_name','$featured','$active')"; 
       $res=mysqli_query($conn,$sql);
       if ($res==true) {
         $_SESSION['add']="<div class='success'>Category Added successfully.</div>";
	header('location:'.SITEURL.'admin/manage.category.php');
     }
      
      else {
        $_SESSION['add']="<div class='error'>Failed to Add admin.</div>";
	header('location:'.SITEURL.'admin/add.cat.php');
     }
     }
     ?>