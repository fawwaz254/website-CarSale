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
  <head>
    <title>CarSale | Produk Mobil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <?php
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
    <h1 class="text-center font-80px margin-bottom50"> <b>Selamat datang <?php echo $_SESSION['name']; ?>! Mobil mana yang akan Anda pilih?</b></h1>

    <h2 class="text-center margin-bottom50">Mobil Tersedia</h2>

    <!-- Search and Filter Form -->
    <div class="row margin-bottom50">
      <div class="col-md-12">
        <div class="form-card">
          <form method="GET" class="form-inline justify-content-center">
            <div class="form-group margin-right20">
              <label for="search" class="margin-right10"><i class="fas fa-search"></i> Cari Mobil:</label>
              <input type="text" id="search" name="search" class="form-control" placeholder="Masukkan nama mobil..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            </div>
            <div class="form-group margin-right20">
              <label for="category" class="margin-right10"><i class="fas fa-filter"></i> Kategori:</label>
              <select id="category" name="category" class="form-control">
                <option value="">Semua Kategori</option>
                <option value="SUV" <?php echo (isset($_GET['category']) && $_GET['category']=='SUV') ? 'selected' : ''; ?>>SUV</option>
                <option value="Sedan" <?php echo (isset($_GET['category']) && $_GET['category']=='Sedan') ? 'selected' : ''; ?>>Sedan</option>
                <option value="Hatchback" <?php echo (isset($_GET['category']) && $_GET['category']=='Hatchback') ? 'selected' : ''; ?>>Hatchback</option>
                <option value="MPV" <?php echo (isset($_GET['category']) && $_GET['category']=='MPV') ? 'selected' : ''; ?>>MPV</option>
                <option value="Coupe" <?php echo (isset($_GET['category']) && $_GET['category']=='Coupe') ? 'selected' : ''; ?>>Coupe</option>
                <option value="Truck" <?php echo (isset($_GET['category']) && $_GET['category']=='Truck') ? 'selected' : ''; ?>>Truck</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Cari </button>
          </form>
        </div>
      </div>

    <!--All products with 3/12 parts each-->
    <div class="row">
      <?php
        $query="SELECT * FROM `products` WHERE 1";
        if (!empty($_GET['search'])) {
          $search = mysqli_real_escape_string($connection, $_GET['search']);
          $query .= " AND product_name LIKE '%$search%'";
        }
        if (!empty($_GET['category'])) {
          $category = mysqli_real_escape_string($connection, $_GET['category']);
          $query .= " AND product_category = '$category'";
        }
        $result=mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($result))
        {
          echo '<div class="col-md-3">
                  <div class="product-tab">
                    <img src="images/'.$row['product_image'].'" class="img-size curve-edge">
                    <h3 class="text-center"><b>'.$row['product_name'].'</b></h3>
                    <p class="justify"><b><i> &nbsp&nbsp&nbsp&nbsp '.$row['product_description'].'</i></b></p>
                    <p><b>Kategori: </b>'.$row['product_category'].'<br><b>Bahan Bakar: </b>'.$row['fuel_type'].'</p>
                    <a href="product_description.php?product_id='.$row['product_id'].'" class="btn btn-block btn-success"> <i class="fas fa-eye"></i> Lihat Detail </a>
                  </div>
                </div>';
        }
      ?>

    </div> <!--Products dispaly Ends-->

    <div class="row">

      <!--Bio-Section in 10/12 parts-->
      <div class="col-md-10">
        <div class="row">

          <div class="col-md-12 bio-tab">
            <div class="row">
              <div class="col-md-4">
                <img src="images/car1.jpg" class="img-size img-circle">
              </div>

              <div class="col-md-8">
                <h1 class="text-center"> <b>Tentang CarSale.com</b> </h1>
                <p>&nbsp&nbsp&nbsp&nbsp<b><i>Situs Jual Beli Mobil Online Terbaik di Indonesia. <b>CarSale</b> bertujuan menciptakan ekosistem perdagangan yang paling andal dan tanpa hambatan di Indonesia yang menciptakan pengalaman yang mengubah hidup bagi pembeli dan penjual. <b>CarSale.com</b> adalah marketplace jual beli mobil online terbesar di Indonesia. Tren belanja online menjadi nama rumah tangga dan begitu pula CarSale.</i></b></p>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <img src="images/car_wallpaper.jpg" class="img-size-lg">
          </div>

        </div>
      </div>

      <!--Popular Products in 2/12 parts-->
      <div class="col-md-2">
        <h2 class="text-center"><b>Mobil Populer</b></h2>
        <div class="row">
        <?php
          $query1="SELECT * FROM `products` ORDER BY product_id DESC LIMIT 5";
          $result1=mysqli_query($connection,$query1);
          while($row1=mysqli_fetch_assoc($result1))
          {
            echo '<div class="col-md-12">
                    <div class="list hover-pink text-center">
                      <a href="product_description.php?product_id='.$row1['product_id'].'">
                      <img src="images/'.$row1['product_image'].'" class="img-size-sm">
                      </a>
                      <b><i class="fas fa-star"></i> '.$row1['product_name'].'</b><br>
                      <span>Rp.'.$row1['product_price'].'</span>
                    </div>
                  </div>';
          }
        ?>
        </div>
      </div>
    </div>

    <?php include "includes/footer.php"; ?>

  </div>
</body>
</html>
