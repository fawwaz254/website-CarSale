<?php
  session_start();

  if(!(isset($_SESSION['name'])&&isset($_SESSION['email'])))
  {
    header('Location: ../views/register.php');
  }
  include "includes/dbconnect.php";
  $user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
  <?php include "includes/css_header.php";
        if(($_SESSION['email']=="admin@carsale.com"))
        {
          include "includes/header_admin.php";
        }
        else
        {
        include "includes/header_postlogin.php";
        }
   ?>
<body style="background-color: #f8f9fa !important;">

  <div class="container ">
    <h1 class="text-center font-80px margin-bottom50"> <b>Wishlist Anda</b></h1>

    <?php
    if(isset($_GET['msg'])) {
        if ($_GET['msg'] == 'removed') {
            echo "<div class='alert alert-success text-center'>Item berhasil dihapus dari wishlist.</div>";
        } elseif ($_GET['msg'] == 'error') {
            echo "<div class='alert alert-danger text-center'>Gagal menghapus item dari wishlist.</div>";
        }
    }
    ?>

    <div class="row">
      <?php
        $query="SELECT w.*, p.product_name, p.product_price, p.product_description, p.product_image, p.product_category, p.fuel_type FROM `wishlist` w JOIN `products` p ON w.product_id = p.product_id WHERE w.user_id = '$user_id'";
        $result=mysqli_query($connection,$query);
        if(mysqli_num_rows($result) == 0) {
          echo '<div class="col-md-12 text-center"><h3>Wishlist Anda kosong.</h3></div>';
        } else {
          while($row=mysqli_fetch_assoc($result))
          {
            echo '<div class="col-md-3">
                    <div class="product-tab">
                      <img src="images/'.$row['product_image'].'" class="img-size curve-edge">
                      <h3 class="text-center"><b>'.$row['product_name'].'</b></h3>
                      <p class="justify"><b><i> &nbsp&nbsp&nbsp&nbsp '.$row['product_description'].'</i></b></p>
                      <p><b>Kategori: </b>'.$row['product_category'].'<br><b>Bahan Bakar: </b>'.$row['fuel_type'].'</p>
                      <a href="product_description.php?product_id='.$row['product_id'].'" class="btn btn-block btn-success"> <i class="fas fa-eye"></i> Lihat Detail </a>
                      <a href="actions/remove_from_wishlist.php?wishlist_id='.$row['wishlist_id'].'" class="btn btn-block btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus dari wishlist?\')"> <i class="fas fa-trash"></i> Hapus dari Wishlist </a>
                    </div>
                  </div>';
          }
        }
      ?>
    </div>

    <?php include "includes/footer.php"; ?>

  </div>
</body>
</html>
