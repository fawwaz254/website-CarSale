<nav class="sidebar" id="sidebar" aria-label="Navigasi Admin">
  <div class="sidebar-header">
    <a href="products.php"
       class="sidebar-brand text-white"
       aria-label="Beranda Admin CarSale">
      CarSale
    </a>

    <button id="sidebar-toggle"
            class="sidebar-toggle"
            aria-label="Tampilkan atau sembunyikan menu"
            aria-expanded="true"
            aria-controls="sidebar">
      <i class="fas fa-bars" aria-hidden="true"></i>
    </button>
  </div>

  <ul class="sidebar-nav">
    <li>
      <a href="admin.php"
         class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : ''; ?>"
         <?php if (basename($_SERVER['PHP_SELF']) == 'admin.php') echo 'aria-current="page"'; ?>>
        <i class="fas fa-tachometer-alt" aria-hidden="true"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li>
      <a href="admin_products.php"
         class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin_products.php' ? 'active' : ''; ?>"
         <?php if (basename($_SERVER['PHP_SELF']) == 'admin_products.php') echo 'aria-current="page"'; ?>>
        <i class="fas fa-cogs" aria-hidden="true"></i>
        <span>Kelola Produk</span>
      </a>
    </li>

    <li>
      <a href="products.php"
         class="<?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : ''; ?>"
         <?php if (basename($_SERVER['PHP_SELF']) == 'products.php') echo 'aria-current="page"'; ?>>
        <i class="fas fa-car" aria-hidden="true"></i>
        <span>Lihat Produk</span>
      </a>
    </li>

    <li>
      <a href="admin_requests.php"
         class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin_requests.php' ? 'active' : ''; ?>"
         <?php if (basename($_SERVER['PHP_SELF']) == 'admin_requests.php') echo 'aria-current="page"'; ?>>
        <i class="fas fa-list" aria-hidden="true"></i>
        <span>Kelola Request</span>
      </a>
    </li>

    <li>
      <a href="logout.php">
        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
        <span>Logout</span>
      </a>
    </li>
  </ul>

  <footer class="sidebar-footer">
    <small>Version 1.0</small>
  </footer>
</nav>

<script>
const toggleBtn = document.getElementById('sidebar-toggle');
const sidebar = document.getElementById('sidebar');
const body = document.body;

toggleBtn.addEventListener('click', function() {
  const isCollapsed = sidebar.classList.toggle('collapsed');
  toggleBtn.setAttribute('aria-expanded', !isCollapsed);
  body.style.paddingLeft = isCollapsed ? '80px' : '280px';
});
</script>
