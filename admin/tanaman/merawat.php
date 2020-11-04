<?php
include '../../koneksi.php';

$id = $_GET['pohon'];
$nama = $_POST['nama'];
$jenis = $_POST['jenis'];
$olahan = $_POST['diolah'];
$guna = $_POST['digunakan'];
$khasiat = $_POST['khasiat'];
$resep = $_POST['resep'];
$latin = $_POST['latin'];
//upload gambar 
$gambarnama = $_FILES['gambar']['name'];
$ukuran_file = $_FILES['gambar']['size'];
$tipe_file = $_FILES['gambar']['type'];
$tmp_file = $_FILES['gambar']['tmp_name'];

$file_ext = explode('.', $gambarnama);
$flex = strtolower(end($file_ext));

$filenamenew = $gambarnama;
$simpan = '../../gambar/'.$filenamenew;

if (empty($tmp_file)) {
	$sql=mysqli_query($dbh,"UPDATE tumbuhan_obat set nama_tumbuhan='$nama', jenis_tumbuhan = '$jenis', cara_pengolahan = '$olahan', cara_penggunaan = '$guna', khasiat = '$khasiat', resep = '$resep', latin = '$latin' WHERE id_tumbuhan = '$id'"); 
			if ($sql) {
    			echo "<script>alert('Data berhasil tersimpan');document.location='data-tanaman-admin.php' </script>";
			}else {
    			echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');document.location='data-tanaman-admin.php' </script>";
    		}
}
else{

if ($tipe_file = "image/jpeg" || $tipe_file = "image/png") {
	if ($ukuran_file <= 2000000) {
		if(move_uploaded_file($tmp_file, $simpan)){
			$sql=mysqli_query($dbh,"UPDATE tumbuhan_obat set nama_tumbuhan='$nama', jenis_tumbuhan = '$jenis', cara_pengolahan = '$olahan', cara_penggunaan = '$guna', khasiat = '$khasiat', gambar = '$filenamenew', resep = '$resep', latin = '$latin' WHERE id_tumbuhan = '$id'"); 
			if ($sql) {
    			echo "<script>alert('Data berhasil tersimpan');document.location='data-tanaman-admin.php' </script>";
			}else {
    			echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.');document.location='data-tanaman-admin.php' </script>";
    		}


	}else{
		echo "<script>alert('Maaf, Gambar gagal untuk diupload.');document.location='data-tanaman-admin.php' </script>";
	}
}else{
	echo "<script>alert('Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 2MB');document.location='data-tanaman-admin.php' </script>";
}

}else{
	echo "<script>alert('Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.');document.location='data-tanaman-admin.php' </script>";
}

}
?>