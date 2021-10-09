<?php
include('partial/menu.php');
?>
<div class="main-content">
	<div class="wrapper">
		<h1>update Food</h1>
		<br><br>
 
           <?php
           if(isset($_GET['id'])){
          $id =$_GET['id'];
          $sql2="SELECT * FROM food WHERE id=$id";
          $res2=mysqli_query($conn,$sql2);
          
          $row2=mysqli_fetch_assoc($res2);
          $title=$row2['title'];
          $description=$row2['description'];
          $price=$row2['price'];
          $current_image=$row2['image_name'];
          $current_cat=$row2['cat_id'];
          $featured=$row2['featured'];
          $active=$row2['active'];
          }
          
           
           else{
           	header('location'.SITEURL.'admin/manage.food.php');
           }
           ?>

		<form method="POST" enctype="multipart/form-data">
    <table class="third">
    	
    	        <tr>
    		      <td>Title: </td>
    		      <td>
    			    <input type="text" name="title" value="<?php echo $title;?>" >
    		      </td>
    	        </tr>
            
              <tr>
              <td>Description</td>
              <td>
              <textarea name="description" cols="30" rows="5" ><?php echo  $description;?></textarea>
              </td>
              </tr>
            
            
              <tr>
              <td>Price</td>
              <td>
              <input type="number" name="price" value="<?php echo $price;?>">
              
              </td>
              </tr>
            
           
              <tr>
           	  <td>Current Image: </td>
           	  <td>
           		<?php
              if($current_image==""){
                echo "<div class='error'>Image not avilable</div>";
              }
              else{
                ?>
                <img src="<?php echo SITEURL;?>images/food<?php echo $current_image;?>" width="60px">
                <?php
              }
              ?>
           	  </td>
              </tr>
             
           <tr>
           	<td>New Image: </td>
           	<td>
           	<input type="file" name="image_name" >
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
               while ($row=mysqli_fetch_assoc($res)) {
                 $cat_title=$row['title'];
                 $cat_id=$row['id'];
                 ?>
                 <option <?php if($current_cat==$cat_id){echo "selected";}?> value="<?php echo $cat_id;?>"><?php echo $cat_title;?></option>
                 <?php
               }
              }
              else{
                echo "<option value='0'>category not available</option>";
              }
             ?>

           </select>
         </td>
       </tr>
              

           <tr>
           	<td>Featured: </td>
           	<td>
           		<input <?php if($featured=="Yes"){echo "checked";}?>  type="radio" name="featured" value="Yes">Yes
           		<input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
           	</td>
           </tr>
          
          <tr>
          	<td>Active: </td>
          	<td>
          	<input <?php if($active=="Yes"){echo "checked";}?>  type="radio" name="active" value="Yes">Yes
          	<input <?php if($active=="No"){echo "checked";}?>  type="radio" name="active" value="No">No
          	</td>
          </tr>
             
             <tr>
             	<td colspan="2">
             		<input type="hidden" name="current_image" value="<?php echo $current_image;?>">
             		<input type="hidden" name="id" value="<?php echo $id;?>">
             		<input type="submit" name="submit" value="Update Category" class="btn-secondary">
             	</td>
             </tr>

    </table>
</form>
<?php
if(isset($_POST['submit'])){
$id=$_POST['id'];	
$title=$_POST['title'];
$description=$_POST['description'];
$price=$_POST['price'];
$current_image=$_POST['current_image'];
$category=$_POST['category'];
$featured=$_POST['featured'];
$active=$_POST['active'];

if(isset($_FILES['image_name']['name'])){
$image_name=$_FILES['image_name']['name'];
if($image_name!=""){

       $ext=end(explode('.', $image_name));
       $image_name="Food_Category_".rand(000,999).'.'.$ext;
       $source_path=$_FILES['image_name']['tmp_name'];
       $distination_path="../images/food".$image_name;
       $upload=move_uploaded_file($source_path,$distination_path);

       if($upload==false){
       	$_SESSION['upload']="<div class='error'>Failed to upload</div>";
       	header('location:'.SITEURL.'admin/manage.food.php');
       	die();
       }
       if($current_image!=""){
       $remove_path="../images/food".$current_image;
       $remove=unlink($remove_path);
       if($remove==false){
       $_SESSION['failed-remove']="<div class='error'>Failed to remove current image</div>";
       header('location:'.SITEURL.'admin/manage.food.php');
       die();  
        }
       }
}
else{
  $image_name=$current_image;
}

}
else{
	$image_name=$current_image;
}

$sql3="UPDATE food SET 
title='$title',
description='$description',
price='$price',
cat_id='$category',
featured='$featured',
active='$active'
WHERE id=$id
";

$res3=mysqli_query($conn,$sql3);
if($res3==true){
	$_SESSION['update']="<div class='success'>food updated success</div>";
	header('location:'.SITEURL.'admin/manage.food.php');
}
else{
$_SESSION['update']="<div class='error'> failed to updated </div>";
	header('location:'.SITEURL.'admin/manage.food.php');
}
}

?>

	</div>
</div>
<?php
include('partial/footer.php');
?>