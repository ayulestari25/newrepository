 <?php
session_start();
 
 //menghakcurna $_SESSION["pelanggan"]
 session_destroy();
 
 echo "<script>alert('anda telah logout');</script>";
 echo "<script>location='index.php';</script>";
 ?>
 