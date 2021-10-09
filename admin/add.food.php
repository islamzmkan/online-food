<?php
include('partial/menu.php');
?>
<div class="main-content">
	<div class="wrapper">
		<h1>Add food</h1>
		<br><br>
        <?php
         if(isset($_SESSION['upload'])){
         	echo $_SESSION['upload'];
         	unset($_SESSION['upload']);
         }
        
        ?>

       <form method="POST" action="add.food.php" enctype="multipart/form-data">
       	<table class="third">
       		
       		<tr>
       			<td>Title</td>
       			<td>
       				<input type="text" name="title">
       			</td>
       		</tr>
       		
            <tr>
            	<td>Description</td>
            	<td>
            		<textarea name="description" cols="30" rows="5"></textarea>
            	</td>
            </tr>
            
            <tr>
            	<td>Price</td>
            	<td>
            		<input type="number" name="price">
            	</td>
            </tr>
            
            <tr>
            	<td>Image_name</td>
            	<td>
            		<input type="file" name="image_name">
            	</td>
            </tr>
            
            <tr>
            	<td>Category</td>
            	<td>
            		<select name="category">
            			<?php
                        $sql="SELECT * FROM cat WHERE active='Yes'";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);
                        if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id=$row['id'];
                            $title=$row['title'];
                            ?>
                            <option value="<?php echo $id;?>"><?php echo $title;?></option>
                            <?php
                        }
                        }
                        else{
                         ?>
                         <option value="0">No Category</option>
                         <?php
                        }
            			?>
            			
            		</select>
            	</td>
            </tr>
            
            <tr>
            	<td>Featured</td>
            	<td>
            		<input type="radio" name="featured" value="Yes">Yes
            		<input type="radio" name="featured" value="No">No
            	</td>
            </tr>
              
             <tr>
            	<td>Active</td>
            	<td>
            		<input type="radio" name="active" value="Yes">Yes
            		<input type="radio" name="active" value="No">No
            	</td>
            </tr> 
           
           <tr>
           <td colspan="2">

						<input type="submit" name="submit" class="btn-secondary" 
						value="Add Food"  >
         </td>
     </tr>
       	</table>
       </form>
      <?php
      if(isset($_POST['submit'])){
      	$title=$_POST['title'];
      	$description=$_POST['description'];
      	$price=$_POST['price'];
      	$category=$_POST['category'];
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
       $ext=explode('.', $image_name);
       $image_name="Food_Category_".rand(000,999).'.'.end($ext);
       $src=$_FILES['image_name']['tmp_name'];
       $dis="../images/food".$image_name;
       $upload=move_uploaded_file($src,$dis);
       if($upload==false){
        $_SESSION['upload']="<div class='error'>Failed to upload</div>";
        header('location:'.SITEURL.'admin/manage.food.php');
        die();
       }
       $remove_path="../images".$image_name;
       $remove=unlink($remove_path);
       
       }
        }
        else{
          $image_name="";
        }



      $sql2="INSERT INTO food (title,description,price,image_name,cat_id,featured,active)value('$title','$description','$price','$image_name','$category','$featured','$active')"; 
        $res2=mysqli_query($conn,$sql2);
       if($res2==true){
       $_SESSION['add']="<div class='success'>Food added success<div>";
       header('location:'.SITEURL.'admin/manage.food.php');
       }
       else{
       $_SESSION['add']="<div class='error'>Failed to add <div>";
       header('location:'.SITEURL.'admin/manage.food.php');
       
       }
      }
      ?>

	</div>
</div>
<?php
include('partial/footer.php');
?>