<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "crud_surat";
$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database");
}

// Ambil data surat berdasarkan ID
$id = $_GET['id'];
$sql = "SELECT * FROM surat WHERE id = '$id'";
$q = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        .content div {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .footer div {
            margin-bottom: 10px;
        }
        .footer .signature {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            SURAT KETERANGAN
            <hr>
        </div>
        <div class="content">
            <div><strong>Nomor:</strong> <?php echo htmlspecialchars($data['nomor_surat']); ?></div>
            <div>
                Yang bertanda tangan di bawah ini, Manager Shared Service & General Support Witel Jakarta Utara PT. Telkom Indonesia, menerangkan bahwa:
            </div>
            <div><strong>Nama:</strong> <?php echo htmlspecialchars($data['nama']); ?></div>
            <div><strong>NIM:</strong> <?php echo htmlspecialchars($data['nim']); ?></div>
            <div><strong>Fakultas:</strong> <?php echo htmlspecialchars($data['fakultas']); ?></div>
            <div><strong>Program Studi:</strong> <?php echo htmlspecialchars($data['program_studi']); ?></div>
            <div><strong>Asal Universitas:</strong> <?php echo htmlspecialchars($data['asal_universitas']); ?></div>
            <div>
                Telah melaksanakan On The Job Training / Praktek Kerja Lapangan di Unit FBB Access & Service Operation Witel Jakarta Utara terhitung mulai tanggal 
                <?php echo date("d F Y", strtotime($data['periode_mulai'])); ?> sampai dengan 
                <?php echo date("d F Y", strtotime($data['periode_selesai'])); ?>.
            </div>
            <div><strong>Dengan Hasil:</strong> <?php echo htmlspecialchars($data['hasil']); ?></div>
            <div>
                Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
            </div>
        </div>
        <div class="footer">
            <div class="signature">
                Jakarta, <?php echo date("d F Y", strtotime($data['tanggal'])); ?><br><br><br>
                Manager Shared Service & General Support<br><br><br>
                Aris Mei Nurrofiq<br>
                NIK. 740048
            </div>
        </div>
    </div>
</body>

</html>
