    <?php
include '../../koneksi.php';


$nama = $_POST['nama'];
$jenis = $_POST['jenis'];
$bagian = $_POST['bagian'];
$olah = $_POST['diolah'];
$guna = $_POST['digunakan'];
$khasiat = $_POST['khasiat'];
$resep = $_POST['resep'];
$latin = $_POST['latin'];


//upload gambar 
$gambarnama = $_FILES['gambar']['name'];


$file_ext = explode('.', $gambarnama);
$flex = strtolower(end($file_ext));

$filenamenew = $gambarnama;
$simpan = '../../gambar/'.$filenamenew;
//

if ($tipe_file = "image/jpeg" || $tipe_file = "image/png") {
	if ($ukuran_file <= 2000000) {
		if(move_uploaded_file($tmp_file, $simpan)){
			$sql=mysqli_query($dbh,"INSERT INTO tumbuhan_obat (nama_tumbuhan, jenis_tumbuhan, cara_pengolahan, cara_penggunaan, bagian_tumbuhan, khasiat, resep, gambar, latin) VALUES ('$nama', '$jenis', '$olah', '$guna', '$bagian','$khasiat', '$resep', '$filenamenew', '$latin')"); 
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
?>