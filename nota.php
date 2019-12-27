<?php 
session_start();
include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Nota Pembelian</title>
	<link rel="stylesheet" href="yunabutik/assets/admin.css">
</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container">
	
	
	
		<!--nota disini copas saja dari nota admin -->
	<h2>Detail Pembelian</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>


<!-- jk pelanggan yg beli tdk sama dengan pelanggan yg login, maka dilarikan ke riwayat.php
karna dia tdk berhak melihat nota orang lain-->
<!-- pelanggan yg beli harus pelanggan yg login-->
<?php
//mendapatkan id_pelanggan yg beli
$idpelangganyangbeli = $detail["id_pelanggan"];

//mendapatkan id_pelanggan yang lohin
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli=$idpelangganyanglogin)
{
	echo"<script>alert('jangan nakal');</script>";
	echo"<script>location='riwayat.php';</script>";
	exit();
}
?>

<div class="row">
	<div class="col-md-4">
<strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
<p>
	<?php echo $detail['telpon_pelanggan']; ?> <br>
	<?php echo $detail['email_pelanggan']; ?>
</p>
	
<p>
	Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
	Total: <?php echo $detail['total_pembelian']; ?>
</p>

<table class="table table-bordered">
	<thead> 
		<tr>	
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<th>Jumlah</th>
			<th>Subberat</th>
			<th>Subtotal</th>
		</tr>
	</thead>
	<tbody>  
		<?php  $nomor=1; ?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['berat']; ?> Gr.</td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td><?php echo $pecah['subberat']; ?> Gr.</td>
			<td>Rp. <?php echo number_format($pecah['subharga']) ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php } ?>
	</tbody>
</table>
			
<div class="row">
	<div class="col-md-7">
		<div class="alert alert-info">
			<p>
				Silahkan melakukan pembayaran Rp. <?php echo ($detail['total_pembelian']); ?>  ke <br>
				<strong> BANK BRI 137-001088-3276 AN. Fitria Ayu</strong> 
			</p>
		</div>
	</div>
</div>
</body>
</html>
