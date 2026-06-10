<div class="auth-container">
    <div class="auth-box">
        <h2>Đăng Ký Tài Khoản</h2>
        <form action="<?= BASEURL; ?>/auth/register" method="POST">
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control <?= (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['username']; ?>">
                <span class="invalid-feedback"><?= $data['username_err']; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['email']; ?>">
                <span class="invalid-feedback"><?= $data['email_err']; ?></span>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?= $data['password_err']; ?></span>
            </div>
            <div class="form-group">
                <label>Xác nhận mật khẩu</label>
                <input type="password" name="confirm_password" class="form-control <?= (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?= $data['confirm_password_err']; ?></span>
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-red btn-block">Đăng Ký</button>
            </div>
            <div class="auth-links-bottom">
                <p>Đã có tài khoản? <a href="<?= BASEURL; ?>/auth/login">Đăng nhập ngay</a></p>
            </div>
        </form>
    </div>
</div>
