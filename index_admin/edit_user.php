<?php
include '../config/koneksi.php';
include '../templates/header.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM user WHERE user_id=?");
$stmt->execute([$id]);
$u = $stmt->fetch();
?>

<h4 class="mb-3">Edit User</h4>

<form action="update_user.php" method="post">
    <input type="hidden" name="user_id" value="<?= $u['user_id']; ?>">

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="user_nama" class="form-control"
               value="<?= $u['user_nama']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control"
               value="<?= $u['username']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="user_alamat" class="form-control" required><?= $u['user_alamat']; ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">No. Telepon</label>
        <input type="text" name="user_phone" class="form-control"
               value="<?= $u['user_phone']; ?>" required>
    </div>

    <!-- PASSWORD (OPSIONAL) -->
    <div class="mb-3">
        <label class="form-label">
            Password <small class="text-muted">(kosongkan jika tidak diubah)</small>
        </label>
        <div class="input-group">
            <input type="password" name="password" id="password" class="form-control">
            <span class="input-group-text" onclick="togglePassword()" style="cursor:pointer">
                <i class="bi bi-eye" id="eyeIcon"></i>
            </span>
        </div>
    </div>

    <button class="btn btn-primary">
        <i class="bi bi-save"></i> Update
    </button>
    <a href="user.php" class="btn btn-secondary">Kembali</a>
</form>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    const icon = document.getElementById("eyeIcon");

    if (pass.type === "password") {
        pass.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        pass.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    }
}
</script>

<?php include '../templates/footer.php'; ?>
