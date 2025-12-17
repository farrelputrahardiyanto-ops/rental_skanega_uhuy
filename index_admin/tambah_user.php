<?php
include '../templates/header.php';
?>

<h4 class="mb-3">Tambah User</h4>

<form action="simpan_user.php" method="post">
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="user_nama" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="user_alamat" class="form-control" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="user_phone" class="form-control" required>
    </div>

    <!-- PASSWORD -->
    <div class="mb-3">
        <label class="form-label">Password</label>
        <div class="input-group">
            <input type="password" name="password" id="password"
                   class="form-control" required>
            <span class="input-group-text" style="cursor:pointer"
                  onclick="togglePassword()">
                <i class="bi bi-eye" id="eyeIcon"></i>
            </span>
        </div>
    </div>

    <div class="mt-4">
        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
        </button>
        <a href="user.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</form>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (pass.type === "password") {
        pass.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        pass.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>

<?php include '../templates/footer.php'; ?>
