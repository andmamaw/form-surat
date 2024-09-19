<?php
// koneksi.php
$host = "localhost";
$user = "root";
$pass = "";
$db = "crud_surat";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}
?>

<?php
// index.php
include 'koneksi.php';

$nomor_surat = "";
$tanggal = "";
$nama = "";
$nim = "";
$fakultas = "";
$program_studi = "";
$asal_universitas = "";
$periode_mulai = "";
$periode_selesai = "";
$hasil = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

// Hapus data
if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM surat WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

// Edit data
if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM surat WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nomor_surat = $r1['nomor_surat'];
    $tanggal = $r1['tanggal'];
    $nama = $r1['nama'];
    $nim = $r1['nim'];
    $fakultas = $r1['fakultas'];
    $program_studi = $r1['program_studi'];
    $asal_universitas = $r1['asal_universitas'];
    $periode_mulai = $r1['periode_mulai'];
    $periode_selesai = $r1['periode_selesai'];
    $hasil = $r1['hasil'];

    if (!$r1) {
        $error = "Data tidak ditemukan";
    }
}

// Simpan data
if (isset($_POST['simpan'])) {
    $nomor_surat = $_POST['nomor_surat'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $fakultas = $_POST['fakultas'];
    $program_studi = $_POST['program_studi'];
    $asal_universitas = $_POST['asal_universitas'];
    $periode_mulai = $_POST['periode_mulai'];
    $periode_selesai = $_POST['periode_selesai'];
    $hasil = $_POST['hasil'];

    if ($nomor_surat && $tanggal && $nama && $nim && $fakultas && $program_studi && $asal_universitas && $periode_mulai && $periode_selesai && $hasil) {
        if ($op == 'edit') {
            $sql1 = "UPDATE surat SET nomor_surat = '$nomor_surat', tanggal = '$tanggal', nama = '$nama', nim = '$nim', fakultas = '$fakultas', program_studi = '$program_studi', asal_universitas = '$asal_universitas', periode_mulai = '$periode_mulai', periode_selesai = '$periode_selesai', hasil = '$hasil' WHERE id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "INSERT INTO surat (nomor_surat, tanggal, nama, nim, fakultas, program_studi, asal_universitas, periode_mulai, periode_selesai, hasil) VALUES ('$nomor_surat', '$tanggal', '$nama', '$nim', '$fakultas', '$program_studi', '$asal_universitas', '$periode_mulai', '$periode_selesai', '$hasil')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Create / Edit Surat</h2>
        <?php if ($error) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
        <?php } ?>
        <?php if ($sukses) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $sukses ?>
            </div>
        <?php } ?>

        <form action="" method="POST">
    <div class="mb-3">
        <label for="judul_surat" class="form-label">Judul Surat</label>
        <input type="text" class="form-control" id="judul_surat" name="judul_surat" value="<?php echo htmlspecialchars($judul_surat) ?>">
    </div>
    <div class="mb-3">
        <label for="nomor_surat" class="form-label">Nomor Surat</label>
        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo htmlspecialchars($nomor_surat) ?>">
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($tanggal) ?>">
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($nama) ?>">
    </div>
    <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input type="text" class="form-control" id="nim" name="nim" value="<?php echo htmlspecialchars($nim) ?>">
    </div>
    <div class="mb-3">
        <label for="fakultas" class="form-label">Fakultas</label>
        <input type="text" class="form-control" id="fakultas" name="fakultas" value="<?php echo htmlspecialchars($fakultas) ?>">
    </div>
    <div class="mb-3">
        <label for="program_studi" class="form-label">Program Studi</label>
        <input type="text" class="form-control" id="program_studi" name="program_studi" value="<?php echo htmlspecialchars($program_studi) ?>">
    </div>
    <div class="mb-3">
        <label for="asal_universitas" class="form-label">Asal Universitas</label>
        <input type="text" class="form-control" id="asal_universitas" name="asal_universitas" value="<?php echo htmlspecialchars($asal_universitas) ?>">
    </div>
    <div class="mb-3">
        <label for="periode_mulai" class="form-label">Periode Mulai</label>
        <input type="date" class="form-control" id="periode_mulai" name="periode_mulai" value="<?php echo htmlspecialchars($periode_mulai) ?>">
    </div>
    <div class="mb-3">
        <label for="periode_selesai" class="form-label">Periode Selesai</label>
        <input type="date" class="form-control" id="periode_selesai" name="periode_selesai" value="<?php echo htmlspecialchars($periode_selesai) ?>">
    </div>
    <div class="mb-3">
        <label for="hasil" class="form-label">Hasil</label>
        <input type="text" class="form-control" id="hasil" name="hasil" value="<?php echo htmlspecialchars($hasil) ?>">
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
</form>


        <h2 class="mt-4">Data Surat</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nomor Surat</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Fakultas</th>
                    <th scope="col">Program Studi</th
                    <th scope="col">Asal Universitas</th>
                    <th scope="col">Periode Mulai</th>
                    <th scope="col">Periode Selesai</th>
                    <th scope="col">Hasil</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql2 = "SELECT * FROM surat ORDER BY tanggal DESC";
                $q2 = mysqli_query($koneksi, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $id = $r2['id'];
                    $nomor_surat = $r2['nomor_surat'];
                    $tanggal = $r2['tanggal'];
                    $nama = $r2['nama'];
                    $nim = $r2['nim'];
                    $fakultas = $r2['fakultas'];
                    $program_studi = $r2['program_studi'];
                    $asal_universitas = $r2['asal_universitas'];
                    $periode_mulai = $r2['periode_mulai'];
                    $periode_selesai = $r2['periode_selesai'];
                    $hasil = $r2['hasil'];
                ?>
                    <tr>
                        <th scope="row"><?php echo $urut++ ?></th>
                        <td><?php echo htmlspecialchars($nomor_surat) ?></td>
                        <td><?php echo htmlspecialchars($tanggal) ?></td>
                        <td><?php echo htmlspecialchars($nama) ?></td>
                        <td><?php echo htmlspecialchars($nim) ?></td>
                        <td><?php echo htmlspecialchars($fakultas) ?></td>
                        <td><?php echo htmlspecialchars($program_studi) ?></td>
                        <td><?php echo htmlspecialchars($asal_universitas) ?></td>
                        <td><?php echo htmlspecialchars($periode_mulai) ?></td>
                        <td><?php echo htmlspecialchars($periode_selesai) ?></td>
                        <td><?php echo htmlspecialchars($hasil) ?></td>
                        <td>
                            <a href="?op=edit&id=<?php echo $id ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau delete data?')" class="btn btn-danger btn-sm">Delete</a>
                            <a href="print.php?id=<?php echo $id ?>" class="btn btn-info btn-sm">Print</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>
