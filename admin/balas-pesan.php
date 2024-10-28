<?php
session_start();
require_once "koneksi.php";

if (isset($_GET['idPesan'])) {
  $idPesan = $_GET['idPesan'];

  $selectContact = mysqli_query($koneksi, "SELECT * FROM contact WHERE id = $idPesan");
  $row = mysqli_fetch_assoc($selectContact);
}

if (isset($_POST['kirim-bosssss']) && isset($_GET['idPesan'])) {
  $id = $_GET['idPesan'];
  // Mengambil data dari form
  $email = $_POST['email'];          // Email penerima
  $subject = $_POST['subject'];      // Subjek email
  $balaspesan = $_POST['balaspesan']; // Isi pesan yang akan dikirim
  
  // Mengatur header email
  $headers = "From: triadhyy@gmail.com" . "\r\n" .  // Ganti dengan email Anda
             "Reply-To: triadhyy@gmail.com" . "\r\n" .
             "Content-Type: text/plain; charset=UTF-8" . "\r\n" .
             "MIME-Version: 1.0" . "\r\n";
  
  // Mengirim email
  if (mail($email, $subject, $balaspesan, $headers)) {
      // echo "Pesan sudah dibalas";
      $hapus = mysqli_query($koneksi, "DELETE FROM contact WHERE id = $id");

      if ($hapus) {
        header("Location: contact.php?status=berhasil-kirim");
        exit();
      }
  } else {
      // echo "Gagal mengirim pesan. Coba lagi nanti.";
      header("Location: balas-pesan.php?status=gagal-kirim");
      exit();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
                                    <div class="card-header">Balas Pesan</div>
                                    <div class="card-body">
                                      <ul style="list-style-type: '-';">
                                        <li><pre> Name    : <?php echo $row['name']?></pre></li>
                                        <li><pre> Email   : <?php echo $row['email']?></pre></li>
                                        <li><pre> Subject : <?php echo $row['subject']?></pre></li>
                                        <li><pre> Message : <?php echo $row['message']?></pre></li>
                                      </ul>
                                    <form action="" method="POST">
                                      <div>
                                        <input type="hidden" name="email" value="<?php echo $row['email']?>">
                                      </div>
                                      <div class="mt-3">
                                        <label class="form-label" for="">Subject</label>
                                        <input class="form-control" type="text" name="subject" required>
                                      </div>
                                      <div class="mt-3">
                                        <label class="form-label" for="">Balas Pesan</label>
                                        <textarea class="form-control" name="balaspesan" id="" cols="30" required rows="10"></textarea>
                                      </div>
                                      <div class="mt-3">
                                        <button class="btn btn-primary" name="kirim-bosssss">Kirim Pesan</button>
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