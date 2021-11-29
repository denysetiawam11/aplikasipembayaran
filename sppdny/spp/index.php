<?php
if (!session_id()) session_start();
require_once 'Proses.php';

// buat object
$proses = new Proses;

// cek session, apabila sudah ada maka akan diarahkan ke halaman beranda
if (isset($_SESSION['id'])) {
    if ($_SESSION['level'] == "Admin") {
        header('Location: includes/admin/');
    } else {
        // kita belum buat
        header('Location: petugas/');
    }
}

// ketika tombol masuk diklik maka jalankan kode berikut
if (isset($_POST['masuk'])) {
    // menghindari sql injection
    $username = $proses->konek->real_escape_string($_POST['username']);
    $password = $proses->konek->real_escape_string(sha1($_POST['password']));

    $masuk = $proses->loginPetugas($username, $password);

    if ($masuk->num_rows > 0) {
        $data = mysqli_fetch_assoc($masuk);

        if ($data['level'] == "Admin") {
            header('Location: includes/admin');
            $_SESSION['id'] = $data['id_petugas'];
            $_SESSION['level'] = $data['level'];
        } else {
            header('Location: petugas');
            $_SESSION['id'] = $data['id_petugas'];
            $_SESSION['level'] = $data['level'];
        }
    } else {
        $_SESSION['error'] = "Username atau password tidak valid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pembayaran SPP</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#a2d9ff" fill-opacity="1" d="M0,256L49.7,160L99.3,96L149,32L198.6,0L248.3,160L297.9,64L347.6,192L397.2,320L446.9,192L496.6,32L546.2,192L595.9,32L645.5,32L695.2,128L744.8,288L794.5,160L844.1,256L893.8,96L943.4,64L993.1,128L1042.8,96L1092.4,288L1142.1,256L1191.7,32L1241.4,320L1291,288L1340.7,32L1390.3,224L1440,288L1440,0L1390.3,0L1340.7,0L1291,0L1241.4,0L1191.7,0L1142.1,0L1092.4,0L1042.8,0L993.1,0L943.4,0L893.8,0L844.1,0L794.5,0L744.8,0L695.2,0L645.5,0L595.9,0L546.2,0L496.6,0L446.9,0L397.2,0L347.6,0L297.9,0L248.3,0L198.6,0L149,0L99.3,0L49.7,0L0,0Z"></path></svg>
    <div class="row">
        <div class="col-8">
            <div class="row py-5 px-5">
                <div class="col-4 ">
                   <h1 class="text-end">Aplikasi Pembayaran SPP</h1>
                </div>
                <div class="gambarne col-4">
                    <img src="assets/2021.svg" alt="" class="" style="width:400px;  ">
                </div>
            </div>
        </div>
        <div class="col-4 py-5 px-5">
            <b><h2>Silahkan Masuk</h2>
            <?php
            if (isset($_SESSION['error'])) {
                echo '<span style="color:red;">' . $_SESSION['error'] . '</span>';
            }
            ?>
            <form method="post" action="" 5complete="off">
                <div class="username py-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username" class="border border-primary form-control" style="width:300px; border-radius:100px">
                </div>
                <div class="password py-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="border border-primary form-control" style="width:300px; border-radius:100px">
                </div>
                <input type="submit" name="masuk" value="Masuk" class="btn btn-success mt-3" style="border-radius: 40px;">
            </form>
        </div>
    </div>

</body>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#a2d9ff" fill-opacity="1" d="M0,256L49.7,160L99.3,96L149,32L198.6,0L248.3,160L297.9,64L347.6,192L397.2,320L446.9,192L496.6,32L546.2,192L595.9,32L645.5,32L695.2,128L744.8,288L794.5,160L844.1,256L893.8,96L943.4,64L993.1,128L1042.8,96L1092.4,288L1142.1,256L1191.7,32L1241.4,320L1291,288L1340.7,32L1390.3,224L1440,288L1440,320L1390.3,320L1340.7,320L1291,320L1241.4,320L1191.7,320L1142.1,320L1092.4,320L1042.8,320L993.1,320L943.4,320L893.8,320L844.1,320L794.5,320L744.8,320L695.2,320L645.5,320L595.9,320L546.2,320L496.6,320L446.9,320L397.2,320L347.6,320L297.9,320L248.3,320L198.6,320L149,320L99.3,320L49.7,320L0,320Z"></path></svg><!-- link js bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>