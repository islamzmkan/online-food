<?php
include('partial/menu.php');
?>
<div class="main-content">
	<div class="wrapper">
	<h1>Manage Food</h1>
	<br/><br/>
<a href="<?php echo SITEURL;?>admin/add.food.php" class="btn-primary">add food</a>
<br/><br/>
     
     <?php
       if(isset($_SESSION['add'])){
    	echo $_SESSION['add'];
    	unset ($_SESSION['add']);
    }

     if(isset($_SESSION['remove']))
        {
          echo $_SESSION['remove'];
          unset($_SESSION['remove']);
        }
       if(isset($_SESSION['delete'])){

         echo $_SESSION['delete'];
         unset($_SESSION['delete']);  
       }
       if(isset($_SESSION['no-category-found'])){
       	echo $_SESSION['no-category-found'];
       	unset($_SESSION['no-category-found']);
       }
       if(isset($_SESSION['update'])){
    	echo $_SESSION['update'];
    	unset($_SESSION['update']);
       }
        if(isset($_SESSION['upload'])){
        	echo $_SESSION['upload'];
        	unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove'])){
        	echo $_SESSION['failed-remove'];
        	unset($_SESSION['failed-remove']);
        }
     ?>

<br><br>


	<table class="full">
		<tr>
		    <th>S.N.</th>
			<th>Title</th>
			<th>price</th>
			<th>Image</th>
			<th>featured</th>
			<th>active</th>
			<th>Actions</th>
		</tr>
		<?php
        $sql="SELECT * FROM food";
        $res=mysqli_query($conn,$sql);
        $count=mysqli_num_rows($res);
        $sn=1;
        if($count>0){
          while ($rows=mysqli_fetch_assoc($res)) {
          	$id=$rows['id'];
          	$title=$rows['title'];
          	$price=$rows['price'];
          	$image_name=$rows['image_name'];
            $featured=$rows['featured'];
            $active=$rows['active'];
            ?>
                <tr>
			<td><?php echo $sn++;?></td>
			<td><?php echo $title;?></td>
			<td>$<?php echo $price;?></td>
			<td>
       <?php
         if($image_name!=""){
           ?>
           <img src="<?php echo SITEURL;?>images/food<?php echo $image_name;?>" width="60px">
           
           <?php
         }
          else{
          	echo "<div class='error'>Image not Added.</div>";
          }
				?>

			</td>
			<td><?php echo $featured;?></td>
			<td><?php echo $active?></td>
		  <td>
		  <a href="<?php echo SITEURL;?>admin/update.food.php?id=<?php echo $id;?>" class="btn-secondary"> Update Food</a>
           <a href="<?php echo SITEURL;?>admin/delete.food.php?id=<?php echo $id;?>& image_name=<?php echo $image_name;?>" class="btn-danger"> Delete Food </a>
            
  			</td>
		</tr>  

            <?php
          }
        }
        else{
        	echo "<tr><td colspan='7' class='error'>Food not added</td></tr>";
        }
		?>
		
		
	</table>
</div>
</div>
<?php
include('partial/footer.php');
?>