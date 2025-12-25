<?php
session_start();
if (!(isset($_SESSION['name']) && isset($_SESSION['email']))) {
  header('Location: register.php');
  exit;
}

include "includes/dbconnect.php";

// Cek ID wajib ada
if (!isset($_GET['product_id'])) {
  header("Location: admin_products.php?msg=3");
  exit;
}

$product_id = intval($_GET['product_id']);
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($connection, $query);

// Jika tidak ditemukan, kembali ke admin page
if (mysqli_num_rows($result) == 0) {
  header("Location: admin_products.php?msg=3");
  exit;
}

$product = mysqli_fetch_assoc($result);
?>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'price_min'): ?>
<div class="alert alert-danger" id="notification">
    Harga harus minimal 1
</div>
<?php endif; 
?>


<!DOCTYPE html>
<html>
<?php include "includes/css_header.php"; ?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="js/error_manager.js"></script>

<body class="admin-body" style="background-color: #f8f9fa;">
  <?php include "includes/header_admin.php"; ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center margin-bottom50">
        <h1 class="font-80px">Edit Produk</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-card">
          <h3 class="text-center margin-bottom50"> <i class="fas fa-edit"></i> Edit Produk</h3>

          <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars($_GET['error']); ?></div>
          <?php endif; ?>

          <form action="update_product.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

            <div class="form-group">
              <label><i class="fas fa-tag"></i> Nama Produk</label>
              <input type="text" name="product_name" class="form-control" 
                     value="<?php echo $product['product_name']; ?>" required minlength="2">
            </div>

            <div class="form-group">
              <label><i class="fas fa-dollar-sign"></i> Harga Produk</label>
              <input type="number" name="product_price" class="form-control"
                     value="<?php echo $product['product_price']; ?>"
                     step="0.01" min="1" required>
            </div>

            <div class="form-group">
              <label><i class="fas fa-align-left"></i> Deskripsi Produk</label>
              <textarea name="product_description" class="form-control" rows="3" 
                        maxlength="300" required><?php echo $product['product_description']; ?></textarea>
              <small>Maksimal 50 kata / 300 karakter</small>
            </div>

            <div class="form-group">
              <label><i class="fas fa-list"></i> Kategori Produk</label>
              <select name="product_category" class="form-control" required>
                <option value="">Pilih Kategori</option>
                <?php 
                  $categories = ["SUV","Sedan","Hatchback","MPV","Coupe","Truck"];
                  foreach($categories as $cat){
                    $sel = ($product['product_category']==$cat) ? 'selected' : '';
                    echo "<option value='$cat' $sel>$cat</option>";
                  }
                ?>
              </select>
            </div>

            <div class="form-group">
              <label><i class="fas fa-gas-pump"></i> Tipe Bahan Bakar</label><br>
              <?php 
                $fuels = ["Petrol"=>"Bensin","Diesel"=>"Solar","Electric"=>"Listrik","Hybrid"=>"Hybrid"];
                foreach($fuels as $key=>$label){
                  $checked = ($product['fuel_type']==$key) ? 'checked' : '';
                  echo "<input type='radio' name='fuel_type' value='$key' $checked required> $label<br>";
                }
              ?>
            </div>

            <div class="form-group">
              <label><i class="fas fa-image"></i> Gambar Produk</label><br>
              <img src="images/<?php echo $product['product_image']; ?>" width="150" class="mb-2"><br>
              <input type="file" name="image" class="form-control" accept="image/*">
              <small>Biarkan kosong jika tidak ingin mengganti gambar</small>
            </div>

            <div class="text-center">
              <input type="submit" value="Update Produk" class="btn btn-primary btn-lg">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</body>

<script>
  // untuk pesan otomatis
  document.addEventListener('DOMContentLoaded', function() {
    displayMessageFromURL();
  });
</script>

</html>
