<?php
session_start();
// mendapatkan  id dari url
$id_produk = $_GET['id'];


// jika sudah ada produk itu dikerajang, maka produk itu jumlahnya di +1
if(isset($_SESSION['keranjang'][$id_produk]))
{
	$_SESSION['keranjang'][$id_produk]+=1;
}
//selainitu (belum ada dikeranjang), maka produkmitu dianggap beli 1
else
{
	$_SESSION['keranjang'][$id_produk] = 1;
}



//echo "<pre>";
//print_r($_SESSION);
//echo "</pre>";

//larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang belanja');</script>";
echo "<script>location='keranjang.php';</script>";
?>