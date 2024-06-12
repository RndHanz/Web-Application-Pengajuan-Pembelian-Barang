<?php
session_start();
include('../function/koneksi.php');

// Cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['role'] == "") {
    header("location:../index.php?pesan=gagal");
    exit();
}

// Fungsi logout
if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location:../index.php");
    exit();
}

if ($_SESSION['role'] != "finance") {
    header("location:../index.php?pesan=gagal");
    exit(); 
}

if (isset($_POST["upload"])) {
    $file = $_FILES["file"];
    $id = $_POST['id'];

    // Check if file is an image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        echo "<script>
        alert('File yang diupload bukan file gambar!');
        window.location.href = '../page/db_finance.php';
        </script>";
        exit();
    }

    // Check file size
    if ($file["size"] > 500000) {
        echo "<script>
        alert('File terlalu besar!');
        window.location.href = '../page/db_finance.php';
        </script>";
        exit();
    }

    // Move uploaded file to desired directory
    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($file["name"]);
    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "<script>
        alert('File tidak berhasil diupload!');
        window.location.href = '../page/db_finance.php';
        </script>";
        exit();
    }

    // Save image information to database
    $filename = basename($file["name"]);
    $sql = "UPDATE db_officer SET image='$filename' WHERE id='$id'";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
        alert('File berhasil diupload!');
        window.location.href = '../page/db_finance.php';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>


<!-- Your HTML code continues here -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href='assets/css/style_officer.css'>
</head>
<body>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

::after,
::before {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

a {
  text-decoration: none;
}

li {
  list-style: none;
}

body {
  font-family: "Poppins", sans-serif;
}

.wrapper {
  display: flex;
}

.main {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  width: 100%;
  overflow: hidden;
  transition: all 0.35s ease-in-out;
  background-color: #fff;
  min-width: 0;
}

#sidebar {
  width: 70px;
  min-width: 70px;
  z-index: 1000;
  transition: all 0.25s ease-in-out;
  background-color: #1E90FF;
  display: flex;
  flex-direction: column;
}

#sidebar.expand {
  width: 260px;
  min-width: 260px;
}

.toggle-btn {
  background-color: transparent;
  cursor: pointer;
  border: 0;
  padding: 1rem 1.5rem;
}

.toggle-btn i {
  font-size: 1.5rem;
  color: #fff;
}

#sidebar:not(.expand) .sidebar-logo,
#sidebar:not(.expand) a.sidebar-link span {
  display: none;
}

#sidebar.expand .sidebar-logo,
#sidebar.expand a.sidebar-link span {
  animation: fadeIn 0.25s ease;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

a.sidebar-link {
  padding: 0.625rem 1.625rem;
  color: #fff;
  display: block;
  font-size: 18px;
  white-space: nowrap;
  border-left: 3px solid transparent;
}

.sidebar-link i,
.dropdown-item i {
  font-size: 20px;
  margin-right: 0.75rem;
}

a.sidebar-link:hover {
  background-color: rgba(255, 255, 255, 0.075);
  border-left: 3px solid #3b7ddd;
}

.sidebar-item {
  position: relative;
}

#sidebar:not(.expand) .sidebar-item:hover .has-dropdown + .sidebar-dropdown {
  display: block;
  max-height: 15em;
  width: 100%;
  opacity: 1;
}

.navbar {
  background-color: #f5f5f5;
  box-shadow: 0 0 2rem 0 rgba(33, 37, 41, 0.1);
}

.navbar-expand .navbar-collapse {
  min-width: 200px;
}

.avatar {
  height: 40px;
  width: 40px;
}

@media (min-width: 768px) {
}

.sidebar-footer {
    position: absolute ;
    bottom: 0 ;
    width: 100%;
}
</style>

<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo">
                <a href="#"></a>
            </div>
        </div>
        <br>
        <a href="../page/db_manager.php" class="sidebar-link">
            <i class="lni lni-layout"></i>
            <span>Manager</span>
        </a>
        <a href="../page/db_officer.php" class="sidebar-link">
            <i class="lni lni-layout"></i>
            <span>Officer</span>
        </a>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link" onclick="document.getElementById('logout-form').submit(); return false;">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
            <form id="logout-form" method="POST" style="display: none;">
                <input type="hidden" name="logout" value="LOGOUT">
            </form>
        </div>
    </aside>
    <div class="main">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <p class="navbar-brand">DASHBOARD <b><?php echo $_SESSION['username']; ?></b></p>
                <img src="../assets/img/account.png" style="width: 50px">
            </div>
</nav>
        
        <div class="card mt-4 ms-4 me-4 large">
    <div class="card-header bg-primary text-white">
        Data Pengajuan Pembelian Barang
    </div>
    <div class="card-body ms-3">
        <table class="table table-bordered table-striped table-hover ">
            <tr>
                <th>No</th>
                <th>Bukti Transfer</th>
                <th>Nama barang</th>
                <th>Harga satuan</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Uplod Bukti Transfer</th>
            </tr>
            <?php 
            $no = 1;
            $tampil = mysqli_query($koneksi, "SELECT * FROM db_officer ORDER BY id DESC");
            while ($data = mysqli_fetch_array($tampil)) :
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?php if (!empty($data['image'])): ?>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal<?= $data['id'] ?>">
                            <img src="../assets/img/<?= htmlspecialchars($data['image']) ?>" alt="Bukti Transfer" style="width:100px;">
                        </a>
                    <?php else: ?>
                        <img src="../assets/img/default.png" alt="No Image" style="width:100px;">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($data['nama_barang']) ?></td>
                <td><?= htmlspecialchars($data['harga_satuan']) ?></td>
                <td><?= htmlspecialchars($data['jumlah']) ?></td>
                <td 
            <?php 
            if ($data['status'] == 'Disetujui') echo 'style="color: green;"';
            elseif ($data['status'] == 'Ditolak') echo 'style="color: red;"';
            ?>>
            <?= $data['status'] ?>
            <?php if ($data['status'] == 'Ditolak') : ?>
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalKeterangan<?= $data['id'] ?>">
                <i class="bi bi-info-circle"></i>
                </button>
            <?php endif; ?>
        </td>
                <td>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUpload<?= $data['id'] ?>">Upload File</button>
                </td>
            </tr>
            


            <!-- Modal View Image -->
            <div class="modal fade" id="imageModal<?= $data['id'] ?>" tabindex="-1" aria-labelledby="imageModalLabel<?= $data['id'] ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel<?= $data['id'] ?>">Bukti Transfer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="../assets/img/<?= htmlspecialchars($data['image']) ?>" alt="Bukti Transfer" class="img-fluid">
                        </div>
                        <div class="modal-footer justify-content-center">
                            <a href="../assets/img/<?= htmlspecialchars($data['image']) ?>" download class="btn btn-primary">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Upload -->
            <div class="modal fade" id="modalUpload<?= $data['id'] ?>" tabindex="-1" aria-labelledby="modalUploadLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalUploadLabel">Upload File PNG</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="../page/db_finance.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Pilih file PNG</label>
                                    <input type="file" class="form-control" name="file" id="file" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="upload">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade " id="modalKeterangan<?= $data['id'] ?>" tabindex="-1" aria-labelledby="modalKeteranganLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKeteranganLabel">Keterangan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><?= $data['keterangan'] ?></p>
            </div>
           
        </div>
    </div>
</div>

            <?php endwhile; ?>
        </table>
    </div>
</div>
               
                    


    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

<script>
const hamBurger = document.querySelector(".toggle-btn");
hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});
</script>
</body>
</html>
