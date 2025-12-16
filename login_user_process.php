<?php
session_start();
include 'config/koneksi.php';

if($_SERVER['REQUEST_METHOD']!=='POST'){
    header("Location: login_user.php"); 
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT id, username, password FROM user WHERE username=?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user && $password === $user['password']){
    $_SESSION['user_id']   = $user['id'];
    $_SESSION['username']  = $user['username'];
    $_SESSION['role']      = 'user';
    header("Location: index.php");
    exit;
} else {
    echo "<script>
            alert('Username atau password salah!');
            window.location.href='login_user.php';
          </script>";
}
?>
