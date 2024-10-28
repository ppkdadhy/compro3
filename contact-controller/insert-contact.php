<?php
require_once "../admin/koneksi.php";

if (isset($_POST['send-message'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $checkEmail = mysqli_query($koneksi, "SELECT email FROM contact WHERE email = '$email'");

  if (mysqli_num_rows($checkEmail) > 0) {
    header("Location: ../contact.php?status=email-duplikat");
    exit();
  }else {
    $queryInsert = mysqli_query($koneksi, "INSERT INTO contact (name, email, subject, message) VALUES ('$name','$email','$subject','$message')");

    if ($queryInsert) {
      header("Location: ../contact.php?status=berhasil");
      exit();
    }else{
      header("Location: ../contact.php?status=gagal");
      exit();
    }
  }
}
?>