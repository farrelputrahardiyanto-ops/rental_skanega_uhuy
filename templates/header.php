<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Informasi Rental Kendaraan</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .navbar-custom {
            background-color: #000;
        }
        .navbar-custom .nav-link {
            color: #fff;
            margin-right: 15px;
        }
        .navbar-custom .nav-link:hover {
            text-decoration: underline;
        }
        .brand-icon {
            font-size: 1.5rem;
            margin-right: 8px;
        }
        .title-center {
            text-align: center;
            font-weight: bold;
            margin: 15px 0;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="../index.php">
            <i class="bi bi-car-front-fill brand-icon"></i>
            RENTAL
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link" href="user.php"><i class="bi bi-people"></i> User</a></li>
                <li class="nav-item"><a class="nav-link" href="kendaraan.php"><i class="bi bi-bicycle"></i> Kendaraan</a></li>
                <li class="nav-item"><a class="nav-link" href="pinjam.php"><i class="bi bi-receipt"></i> Pinjam</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>

            <span class="navbar-text text-white">
                <i class="bi bi-person-circle"></i>
                <?= $_SESSION['user_nama']; ?>
            </span>
        </div>
    </div>
</nav>

<div class="title-center">
    Sistem Informasi Rental Kendaraan RPL Skanega
</div>

<!-- MAIN CONTENT (BUKA) -->
<main class="container mb-4">
