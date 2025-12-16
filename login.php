<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background-color: #f5f5f5; }

.btn-login {
    background-color: #000;
    color:#fff;
    transition:0.3s;
    font-size:14px;
    padding:6px 0;
}
.btn-login:hover {
    background-color:#0d6efd;
    color:#fff;
}

.password-container {
    position: relative;
}
.toggle-password {
    position: absolute;
    top:50%;
    right:10px;
    transform:translateY(-50%);
    cursor:pointer;
    font-size:18px;
    color:#6c757d;
}

/* TOGGLE */
.toggle-pill {
    width:70px;
    height:28px;
    background-color:#000;
    border-radius:50px;
    margin:0 auto 10px;
    position: relative;
    display:block;
}

.toggle-pill .circle {
    width:24px;
    height:24px;
    background-color:#fff;
    border-radius:50%;
    position:absolute;
    top:2px;
    right:2px; /* FIX: ke kanan */
}

.toggle-labels {
    display:flex;
    justify-content:space-between;
    width:70px;
    margin:0 auto 15px;
    font-size:12px;
    font-weight:bold;
    color:#000;
}
</style>
</head>

<body>
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm" style="width:360px;">
        <div class="card-body">

            <h5 class="card-title text-center fw-bold mb-4">
                Sistem Informasi Rental Kendaraan<br>RPL Skanega
            </h5>

            <form method="post" action="login_process.php">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control form-control-sm mb-2" required>

                <label class="form-label">Password</label>
                <div class="password-container mb-3">
                    <input type="password" name="password" class="form-control form-control-sm" required>
                    <i class="bi bi-eye toggle-password"></i>
                </div>

                <!-- Toggle ke User -->
                <a href="login_user.php" class="toggle-pill">
                    <div class="circle"></div>
                </a>

                <div class="toggle-labels">
                    <span>User</span>
                    <span>Admin</span>
                </div>

                <button type="submit" class="btn btn-login w-100">
                    Login Admin
                </button>
            </form>

        </div>
    </div>
</div>

<script>
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', () => {
        const input = icon.previousElementSibling;
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
});
</script>
</body>
</html>