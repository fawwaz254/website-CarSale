<?php
  session_start();  
  if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  {
    header('Location: register.php');
  }
  include "includes/dbconnect.php";
?>

<!DOCTYPE html>
<html>
  <?php include "includes/css_header.php";
        include "includes/header_postlogin.php";
   ?>
<body style="background-color: #EEEEEE">
  

  <div class="container ">
        <!--All products with 3/12 parts each-->
    <div class="row">
      <?php 
        //$product_id=$_GET['product_id'];
        $user_id=$_SESSION['user_id'];

        $query="SELECT * FROM `cart` c JOIN `products` p ON c.`product_id`=p.`product_id` WHERE c.`user_id`=$user_id";
        $result=mysqli_query($connection,$query);
        
        if(isset($_GET['msg']))   //if page returned from delete_item_from_cart
        { 
          if ($_GET['msg']==1)
          {
            echo "<h3 class='text-center text-red'><i>Item telah dihapus</i></h3><br>";
          }
          elseif($_GET['msg']==2)
          {
            echo "<h3 class='text-center text-red'><i>Item tidak dapat dihapus</i></h3><br>";
          }
          elseif($_GET['msg']==11)  //for receiving from order
          {
            echo "<h3 class='text-center text-red'><i>Item telah dipesan</i></h3><br>";
          }
          elseif($_GET['msg']==22)
          {
            echo "<h3 class='text-center text-red'><i>Item sudah dipesan sebelumnya</i></h3><br>";
          }
          elseif($_GET['msg']==33)
          {
            echo "<h3 class='text-center text-red'><i>Ulasan tidak dapat ditambahkan! Maaf!</i></h3><br>";
          }
          else
          {
            echo "<h3 class='text-center text-red'><i>Kesalahan! Coba lagi.</i></h3><br>";
          }
        }
        
        while($row=mysqli_fetch_assoc($result))
        {
          echo '<div class="col-md-3">
                  <div class="product-tab">
                    <img src="images/'.$row['product_image'].'" class="img-size curve-edge">
                    <h3 class="text-center"><b>'.$row['product_name'].'</b></h3>
                    <p class="justify"><b><i> &nbsp&nbsp&nbsp&nbsp '.$row['product_description'].'</i></b></p>
                    <a href="product_description.php?product_id='.$row['product_id'].'" class="btn btn-block btn-success" >Lihat Detail </a>
                    <a href="add_to_order.php?product_id='.$row['product_id'].'" class="btn btn-block btn-success" >Pesan Sekarang </a>
                    <a href="delete_from_cart.php?product_id='.$row['product_id'].'" class="btn btn-block btn-danger" >Hapus dari Keranjang </a>
                    
                  </div>
                </div>';
        }
      ?>    
    </div> <!--Products dispaly Ends-->
  </div>
</body>
</html>
