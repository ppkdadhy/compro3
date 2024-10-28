<?php
session_start();
include 'koneksi.php';

if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $profesi = $_POST['profesi'];
  $testimony = $_POST['testimony'];

  if (!empty($_FILES['foto']['name'])) {
    $nama_foto = $_FILES['foto']['name'];
    $ukuran_foto = $_FILES['foto']['size'];


    $ext = array('png', 'jpg', 'jpeg');
    $extFoto = pathinfo($nama_foto, PATHINFO_EXTENSION);

    if (!in_array($extFoto, $ext)) {
        echo "Ext tidak ditemukan";
        die;
    }else{
        move_uploaded_file($_FILES['foto']['tmp_name'], 'upload/'.$nama_foto);
        $queryInsert = mysqli_query($koneksi, "INSERT INTO testimonial (nama, profesi, testimony, foto) VALUES ('$nama','$profesi','$testimony','$nama_foto')");
    }
  }else {
    $queryInsert = mysqli_query($koneksi, "INSERT INTO testimonial (nama, profesi, testimony) VALUES ('$nama','$profesi','$testimony')");
  }

  if ($queryInsert) {
    header("Location: testimonial.php?status=success");
    exit();
  }

}

$edit = isset($_GET['edit']) ? $_GET['edit'] : '';
    $select = mysqli_query($koneksi, "SELECT * FROM testimonial WHERE id = '$edit'");
    $rowTestimon = mysqli_fetch_assoc($select);



if (isset($_POST['update']) && isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];
    $nama = $_POST['nama'];
    $profesi = $_POST['profesi'];
    $testimony = $_POST['testimony'];

     // Tentukan lokasi penyimpanan
   $targetDir = "upload/";
   $fileName = basename($_FILES['foto']['name']);
   $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

   $tanggal = date("d");
   $detik = date('s');

   $newFileName = pathinfo($fileName, PATHINFO_FILENAME) . "-" . $tanggal . "-" . $detik . "-" .str_pad($edit, 5, '0', STR_PAD_LEFT) . "." . $fileExtension;
   $fileDestination = $targetDir . $newFileName;

   if (!empty($fileName)) {
    if (pathinfo($fileDestination, PATHINFO_EXTENSION) === 'png' || pathinfo($fileDestination, PATHINFO_EXTENSION) === 'jpg' || pathinfo($fileDestination, PATHINFO_EXTENSION) === 'jpeg') {
        //Hapus file foto lama jika ada
        if (!empty($rowTestimon['foto']) && file_exists($targetDir . $rowTestimon['foto'])) {
            unlink($targetDir . $rowTestimon['foto']);
        }

        //Pindahkan file ke folder upload
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $fileDestination)) {
            $qEdit = "UPDATE testimonial SET nama='$nama ', profesi ='$profesi', testimony='$testimony', foto='$newFileName' WHERE id = $idEdit";
        }else {
            header("Location: tambah-testimonial.php?edit=$idEdit&status=gagal-upload");
            exit();
        }
    }else {
        header("Location: tambah-testimonial.php?edit=$idEdit&status=gagal-format");
        exit();
    }
   }else{
        //Jika tidak ada file upload
        $qEdit = "UPDATE testimonial SET nama='$nama ', profesi ='$profesi', testimony='$testimony' WHERE id = $idEdit";
   }
   if (mysqli_query($koneksi, $qEdit)) {
        header("Location: testimonial.php?ubah=berhasil");
        exit();
   }else{
    header("Location: tambah-testimonial.php?edit=$idEdit&status=gagal-update");
    exit();
   }


    $queryUpdate = mysqli_query($koneksi, "UPDATE testimonial SET nama='$nama ', profesi ='$profesi', testimony='$testimony' WHERE id = $idEdit");

    if ($queryUpdate) {
        header("Location: testimonial.php?status=success-update");
        exit();
    }
}
?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <?php include 'inc/head.php' ?>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include 'inc/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'inc/nav.php'; ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header"><?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Testimony</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-success" role="alert">
                                                Data berhasil dihapus
                                            </div>
                                        <?php endif ?>

                                        <form action="" method="post" enctype="multipart/form-data">
                                          <div>
                                            <label class="form-label" for="">Nama</label>
                                            <input class="form-control" name="nama" id="nama" value="<?php echo isset($_GET['edit']) ? $rowTestimon['nama'] : ''?>" required type="text">
                                          </div>
                                          <div class="mt-3">
                                            <label for="">Profesi</label>
                                            <input type="text" name="profesi" id="profesi" value="<?php echo isset($_GET['edit']) ? $rowTestimon['profesi'] : ''?>" required class="form-control">
                                          </div>
                                          <div class="mt-3">
                                            <label class="form-label" for="testimony">Testimony</label>
                                            <textarea required class="form-control" name="testimony" id="testimony" cols="30" rows="10"><?php echo isset($_GET['edit']) ? $rowTestimon['testimony'] : ''?></textarea>
                                          </div>
                                          <div class="mt-3">
                                            <label class="form-label" for="">Foto</label>
                                            <input type="file" name="foto" id="foto" class="form-control" accept=".png, .jpg, .jpeg, .gif">
                                          </div>
                                          <div class="mt-3">
                                            <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'update' : 'simpan'?>"><?php echo isset($_GET['edit']) ? 'Update' : 'ADD' ?></button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                            </div>
                            <div>
                                <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                                <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                                <a
                                    href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                                    target="_blank"
                                    class="footer-link me-4">Documentation</a>

                                <a
                                    href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                    target="_blank"
                                    class="footer-link me-4">Support</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>