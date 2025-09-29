<html>
	<?php 
		session_start();
		
		if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  		{
    		header('Location: register.php');
  		}
  		include "includes/css_header.php";
		include "includes/dbconnect.php";
	?>
	<body style="background-color: #EEEEEE;">
		<?php include "includes/header_postlogin.php"; 				
      	$product_id=$_GET['product_id'];
      	$query="SELECT * FROM `products` WHERE `product_id` LIKE '$product_id'";
      	$results=mysqli_query($connection,$query);
      	$row=mysqli_fetch_assoc($results);

      	// Calculate average rating and count
      	$rating_query = "SELECT AVG(rating) as avg_rating, COUNT(*) as review_count FROM reviews WHERE product_id = '$product_id'";
      	$rating_result = mysqli_query($connection, $rating_query);
      	$rating_row = mysqli_fetch_assoc($rating_result);
      	$avg_rating = $rating_row['avg_rating'] ? round($rating_row['avg_rating'], 1) : 0;
      	$review_count = $rating_row['review_count'];

      	// Check if user has ordered this product
      	$user_id = $_SESSION['user_id'];
      	$order_check = "SELECT * FROM orders WHERE user_id = '$user_id' AND product_id = '$product_id'";
      	$order_result = mysqli_query($connection, $order_check);
      	$has_ordered = mysqli_num_rows($order_result) > 0;
      	
      	if(isset($_GET['msg']))
	    {	
	    	if ($_GET['msg']==1)
		    {
		    echo "<h4 class='text-center text-red'><i>Ditambahkan ke keranjang</i></h4><br>";
		    }
		    elseif($_GET['msg']==2)
		     {
		     	echo "<h4 class='text-center text-red'><i>Anda sudah menambahkan ini ke keranjang</i></h4><br>";
		     }
		   	elseif($_GET['msg']==11)
		   	{
				echo "<h4 class='text-center text-red'><i>Ditambahkan ke wishlist</i></h4><br>";
		  	}
		    elseif($_GET['msg']==22)
		    {
		    	echo "<h4 class='text-center text-red'><i>Anda sudah menambahkan ini ke wishlist</i></h4><br>";
		    }
		    else
		    {
		    	echo "<h4 class='text-center text-red'><i>Terjadi kesalahan!</i></h4>";
		    }
		}
				echo '<div class="container">
			        	<div class="row padding30">  
			          		<div class="col-md-6">
			                	<div class="product-tab">
				           	  		<img src="images/'.$row['product_image'].'" class="img-size-lg">
				            	</div>
					    	</div>
				      	   	<div class="col-md-6">
				      	   		<div class="product-tab">
					                <h1 class="text-center"> '.$row['product_name'].'</h1>
					                <p> &nbsp&nbsp&nbsp&nbsp '.$row['product_description'].'<br>
					                <br> <b>Kategori: </b>'.$row['product_category'].'<br>
					                <br> <b>Harga: Rp '.$row['product_price'].'/Unit</b><br>
					                <br> <b>Rating Rata-rata: </b>';
					                if($review_count > 0){
					                	for($i=1; $i<=5; $i++){
					                		if($i <= $avg_rating){
					                			echo '★';
					                		} else {
					                			echo '☆';
					                		}
					                	}
					                	echo ' ('.$avg_rating.'/5)<br><br></p>';
					                } else {
					                	echo 'Belum ada ulasan<br><br></p>';
					                }
					                if($has_ordered){
					                	echo '<a href="review_form.php?product_id='.$product_id.'" class="btn btn-lg btn-primary"> Tambah Ulasan </a>';
					                }
					                echo '<a href="add_to_cart.php?product_id='.$product_id.'" class="btn btn-lg btn-danger"> Tambah ke Keranjang </a>
					                <a href="add_to_wishlist.php?product_id='.$product_id.'" class="btn btn-lg btn-danger"> Tambah ke Wishlist </a>
				                </div>
				           	</div>
				        </div>
				    </div>';				
      	?>
      	<div class="row">
      		<div class="col-md-12">
      			<h1 class="text-center"> ULASAN TERBAIK</h1>
      		</div>
      	</div>
      	<div class="row">
      		
      			<?php
      				$query1="SELECT * FROM `reviews` r JOIN `users` u ON r.`user_id`=u.`user_id` WHERE r.`product_id` LIKE '$product_id'";
      				$result1=(mysqli_query($connection,$query1));
      				while($row1=mysqli_fetch_assoc($result1))
      				{
      					echo '<div class="col-md-6">
      							<div class="product-tab margin-left20">
      								<h4><b>'.$row1['review_heading'].'</b><br>
      								<small>Oleh: '.$row1['name'].'</small><br>
      								<small>Rating: ';
      								for($i=1; $i<=5; $i++){
      									if($i <= $row1['rating']){
      										echo '★';
      									} else {
      										echo '☆';
      									}
      								}
      								echo '</small><br><br>
      								'.$row1['review_text'].' </h4>
      							</div>
      						  </div>';
      				}
      			?>
      		
      	</div>	
	</body>
</html>
