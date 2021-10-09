<?php
include('partial/menu.php');
?>
<div class="main-content">
	<div class="wrapper">
	<h1>Manage Order</h1>
	

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
			<th>food</th>
			<th>price</th>
			<th>Quantity</th>
			<th>Total</th>
			<th>order_date</th>
			<th>status</th>
			<th>customer_name</th>
			<th>customer_contact</th>
			<th>Email</th>
			<th>Address</th>
			<th>Actions</th>

		</tr>
         <?php
     $sql="SELECT * FROM orders ORDER BY id DESC";
     $res=mysqli_query($conn,$sql);
     $count=mysqli_num_rows($res);
     $sn=1;
     if($count>0)
      {
          while($row=mysqli_fetch_assoc($res)){
           $id=$row['id'];
           $food=$row['food'];
           $price=$row['price'];
           $qty=$row['qty'];
           $total=$row['total'];
           $order_date=$row['order_date'];
           $status=$row['status'];
           $customer_name=$row['customer_name'];
           $customer_contact=$row['customer_contact'];
           $customer_email=$row['customer_email'];
           $customer_address=$row['customer_address'];
         ?>

		<tr>
			<td> <?php echo $sn++;?> </td>
			<td> <?php echo $food;?> </td>
			<td> <?php echo $price;?>$ </td>
			<td> <?php echo $qty;?> </td>
			<td> <?php echo $total;?>$ </td>
			<td> <?php echo $order_date;?> </td>

			<td> 
				<?php 
				if($status=="Ordered"){
					echo "<label style='color: blue;'>$status</label>";
				}
				else if($status=="on deliver"){
					echo "<label style='color: orange;'>$status</label>";
				}
				else if($status=="Delivered"){
					echo "<label style='color: green;'>$status</label>";
				}
				else if($status=="Cancelled"){
					echo "<label style='color: red;'>$status</label>";
				}
				?>
			 </td>

			<td> <?php echo $customer_name;?> </td>
			<td> <?php echo $customer_contact;?> </td>
			<td> <?php echo $customer_email;?> </td>
			<td> <?php echo $customer_address;?></td>
			
		
				<td>

					<a href="<?php echo SITEURL;?>admin/update.order.php?id=<?php echo $id;?>" class="btn-secondary"> Update Order</a>
			</td>
            
		</tr>
		
         <?php

          }
       }
       else{
       	echo "<tr><td colspan='12' class='error'>Order not available</td></tr>";
       }


         ?>

	</table>
</div>
</div>
<?php
include('partial/footer.php');
?>