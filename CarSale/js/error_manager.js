function toggleNavbar() {
  var nav = document.getElementById('navbarNav');
  if (nav) {
    nav.classList.toggle('show');
  }
}

// error_manager.js - Manajemen Pesan Error dan Sukses untuk Fitur Login, Register, dan CRUD Produk

// Fungsi untuk menampilkan pesan error menggunakan notifikasi interaktif
function showError(message) {
    const notif = document.getElementById("notification");
    if (!notif) return;
    notif.className = "alert alert-danger";
    notif.innerText = message;
    notif.style.display = "block";
}

// Fungsi untuk menampilkan pesan sukses menggunakan notifikasi interaktif
function showSuccess(message) {
    const notif = document.getElementById("notification");
    if (!notif) return;
    notif.className = "alert alert-success";
    notif.innerText = message;
    notif.style.display = "block";
}

// Fungsi untuk menampilkan pesan peringatan menggunakan notifikasi interaktif
function showWarning(message) {
    showNotification('Warning: ' + message, 'warning');
}

// Fungsi helper untuk menampilkan notifikasi
function showNotification(message, type) {
    // Hapus notifikasi sebelumnya jika ada
    $('#notification').remove();

    // Tentukan warna berdasarkan tipe
    let bgColor = '#dc3545'; // error
    if (type === 'success') bgColor = '#28a745';
    else if (type === 'warning') bgColor = '#ffc107';

    // Buat elemen notifikasi
    $('body').append(`
        <div id="notification" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${bgColor};
            color: white;
            padding: 15px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            z-index: 10000;
            max-width: 300px;
            font-family: Arial, sans-serif;
            display: none;
        ">
            ${message}
            <button onclick="$('#notification').fadeOut();" style="
                background: none;
                border: none;
                color: white;
                float: right;
                font-size: 20px;
                cursor: pointer;
                margin-left: 10px;
            ">&times;</button>
        </div>
    `);

    // Tampilkan notifikasi dengan animasi
    $('#notification').fadeIn(300).delay(5000).fadeOut(300, function() {
        $(this).remove();
    });
}

// Fungsi untuk validasi form login
function validateLoginForm() {
    var email = document.getElementById('user_email').value.trim();
    var password = document.getElementById('user_password').value.trim();

    if (email === '') {
        showError('Email tidak boleh kosong.');
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showError('Format email tidak valid.');
        return false;
    }

    if (password === '') {
        showError('Kata sandi tidak boleh kosong.');
        return false;
    }

    return true;
}

// Fungsi untuk validasi form register
function validateRegisterForm() {
    var name = document.getElementById('user_name').value.trim();
    var email = document.getElementById('user_email').value.trim();
    var password = document.getElementById('user_password').value.trim();
    var confirmPassword = document.getElementById('user_confirm_password').value.trim();

    if (name === '') {
        showError('Nama tidak boleh kosong.');
        return false;
    }

    if (email === '') {
        showError('Email tidak boleh kosong.');
        return false;
    }

    var emailRegex = /^[^\s@]+@gmail\.com$/;
    if (!emailRegex.test(email)) {
        showError('Format email tidak valid. Harus menggunakan @gmail.com.');
        return false;
    }

    if (password.length < 8) {
        showError('Kata sandi harus minimal 8 karakter.');
        return false;
    }

    if (password !== confirmPassword) {
        showError('Konfirmasi kata sandi tidak cocok.');
        return false;
    }

    return true;
}

// Fungsi untuk validasi form produk
function validateProductForm() {
    var productName = document.querySelector('input[name="product_name"]').value.trim();
    var productPrice = document.querySelector('input[name="product_price"]').value;
    var productDescription = document.querySelector('textarea[name="product_description"]').value.trim();
    var productCategory = document.querySelector('select[name="product_category"]').value;
    var fuelType = document.querySelector('input[name="fuel_type"]:checked');
    var image = document.querySelector('input[name="image"]').files[0];

    if (productName === '') {
        showError('Nama produk tidak boleh kosong.');
        return false;
    }

    if (productPrice === '' || isNaN(productPrice) || parseFloat(productPrice) <= 0) {
        showError('Harga produk harus berupa angka positif.');
        return false;
    }

    if (productDescription === '') {
        showError('Deskripsi produk tidak boleh kosong.');
        return false;
    }

    var wordCount = productDescription.split(/\s+/).filter(word => word.length > 0).length;
    var charLength = productDescription.length;
    if (wordCount > 50 || charLength > 300) {
        showError('Deskripsi produk tidak boleh lebih dari 50 kata atau 300 karakter.');
        return false;
    }

    if (productCategory === '') {
        showError('Kategori produk harus dipilih.');
        return false;
    }

    if (!fuelType) {
        showError('Tipe bahan bakar harus dipilih.');
        return false;
    }

    if (!image) {
        showError('Gambar produk harus diunggah.');
        return false;
    }

    // Validasi tipe file gambar
    var allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!allowedTypes.includes(image.type)) {
        showError('Format gambar tidak valid. Gunakan JPEG, PNG, GIF, atau WebP.');
        return false;
    }

    // Validasi ukuran file (misal max 5MB)
    if (image.size > 5 * 1024 * 1024) {
        showError('Ukuran gambar terlalu besar. Maksimal 5MB.');
        return false;
    }

    return true;
}

// Fungsi untuk menampilkan pesan dari URL parameter (untuk kompatibilitas dengan redirect server-side)
function displayMessageFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get("msg");

    if (!msg) return;

    // ============================
    // MAPPING FINAL (SESUAI PHP)
    // ============================
    const messageMap = {
        "1": "Produk berhasil ditambahkan.",
        "2": "Gagal mengunggah gambar produk. Silakan coba lagi.",
        "3": "Data produk tidak valid. Mohon periksa kembali kolom isian.",
        "4": "Produk berhasil diperbarui.",
        "11": "Produk telah dihapus.",
        "22": "Produk tidak dapat dihapus."
    };

    // Tampilkan pesan dari mapping
    if (messageMap[msg]) {
        // Kode sukses → hijau
        if (msg === "1" || msg === "4" || msg === "11") {
            showSuccess(messageMap[msg]);
        }
        // Kode gagal → merah
        else {
            showError(messageMap[msg]);
        }
    }

    // Hapus "?msg=x" dari URL supaya tidak tampil dua kali
    const newUrl = window.location.pathname + window.location.search.replace(/[?&]msg=[^&]*/, "");
    window.history.replaceState({}, document.title, newUrl);
}
// Jalankan otomatis
document.addEventListener("DOMContentLoaded", displayMessageFromURL);


// Fungsi untuk membatasi input deskripsi produk hingga 50 kata dan 300 karakter
function limitDescription() {
    var textarea = document.getElementById('product_description');
    var wordCountElement = document.getElementById('word_count');
    var text = textarea.value;
    var words = text.trim().split(/\s+/).filter(word => word.length > 0);
    var wordCount = words.length;
    var charLength = text.length;

    // Update counter
    wordCountElement.textContent = wordCount + ' kata / 50, ' + charLength + ' karakter / 300';

    // Jika melebihi 50 kata atau 300 karakter, potong teks
    if (wordCount > 50 || charLength > 300) {
        if (wordCount > 50) {
            // Potong kata-kata hingga 50
            var truncatedWords = words.slice(0, 50);
            textarea.value = truncatedWords.join(' ');
        } else if (charLength > 300) {
            // Potong karakter hingga 300
            textarea.value = text.substring(0, 300);
        }
        // Update counter setelah potong
        var newText = textarea.value;
        var newWords = newText.trim().split(/\s+/).filter(word => word.length > 0);
        var newWordCount = newWords.length;
        var newCharLength = newText.length;
        wordCountElement.textContent = newWordCount + ' kata / 50, ' + newCharLength + ' karakter / 300';
        showWarning('Deskripsi produk dibatasi hingga 50 kata dan 300 karakter.');
    }
}

// Inisialisasi otomatis saat DOM siap
document.addEventListener('DOMContentLoaded', function() {
    displayMessageFromURL();
    // Jika ada textarea deskripsi, inisialisasi counter
    var textarea = document.getElementById('product_description');
    if (textarea) {
        limitDescription(); // Update counter awal
    }
});
