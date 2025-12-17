<?php
session_start();
include 'config/koneksi.php';

if($_SERVER['REQUEST_METHOD']!=='POST'){
    header("Location: login_user.php"); 
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT user_id, username, password, user_nama, user_alamat, user_phone FROM user WHERE username=?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user && $password === $user['password']){
    $_SESSION['user_id']   = $user['user_id'];
    $_SESSION['username']  = $user['username'];
    $_SESSION['user_nama'] = $user['user_nama'];
    $_SESSION['user_alamat'] = $user['user_alamat'];
    $_SESSION['user_phone'] = $user['user_phone'];
    $_SESSION['role']      = 'user';
    header("Location: index_user/index.php");
    exit;
} else {
    echo "<script>
            alert('Username atau password salah!');
            window.location.href='login_user.php';
          </script>";
}
?>
