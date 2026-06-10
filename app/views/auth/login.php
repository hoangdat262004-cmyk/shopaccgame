<div class="auth-container">
    <div class="auth-box">
        <h2>Đăng Nhập</h2>
        <form action="<?= BASEURL; ?>/auth/login" method="POST">
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control <?= (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['username']; ?>">
                <span class="invalid-feedback"><?= $data['username_err']; ?></span>
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?= $data['password_err']; ?></span>
            </div>
            <div class="form-row">
                <button type="submit" class="btn btn-red btn-block">Đăng Nhập</button>
            </div>
            <div class="auth-links-bottom">
                <p>Chưa có tài khoản? <a href="<?= BASEURL; ?>/auth/register">Đăng ký ngay</a></p>
            </div>
        </form>
    </div>
</div>
