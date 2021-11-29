<?php
session_start();
require_once 'Admin.php';

$admin = new Admin;

// jika session id belum di set, maka kembalikan ke halaman login
if (!isset($_SESSION['id'])) {
    header('Location: ../../');
}

$id = $_SESSION['id'];

$data = $admin->getDataPetugas($id);
$row = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#a2d9ff" fill-opacity="1" d="M0,256L30,218.7C60,181,120,107,180,112C240,117,300,203,360,218.7C420,235,480,181,540,176C600,171,660,213,720,208C780,203,840,149,900,128C960,107,1020,117,1080,144C1140,171,1200,213,1260,213.3C1320,213,1380,171,1410,149.3L1440,128L1440,0L1410,0C1380,0,1320,0,1260,0C1200,0,1140,0,1080,0C1020,0,960,0,900,0C840,0,780,0,720,0C660,0,600,0,540,0C480,0,420,0,360,0C300,0,240,0,180,0C120,0,60,0,30,0L0,0Z"></path></svg>

<body>
    <div class="container text-center">
        <h1 href="#">Aplikasi Pembayaran SPP</h1>
        <br><nav class="navbar navbar-expand-lg navbar-light "></br>
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item px-2">
                            <a class="nav-link btn btn-info" href="?p=siswa">Data Siswa</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link btn btn-info" href="?p=petugas">Data Petugas</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link btn btn-info" href="?p=spp">Data SPP</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link btn btn-danger" href="?p=logout">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>