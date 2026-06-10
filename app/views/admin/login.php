<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($data['title']) ? $data['title'] : 'Đăng nhập Quản Trị' ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #0b0f19;
            --color-accent: #8b5cf6;
            --color-secondary: #06b6d4;
            --text-main: #f3f4f6;
            --text-muted: #9ca3af;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-primary);
            background-image: 
                radial-gradient(at 10% 20%, rgba(139, 92, 246, 0.25) 0px, transparent 50%),
                radial-gradient(at 90% 80%, rgba(6, 182, 212, 0.25) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        /* Floating particles effect (pure CSS) */
        .particles {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            pointer-events: none;
            z-index: 0;
        }
        .particle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            opacity: 0.3;
            animation: float 15s infinite ease-in-out alternate;
        }
        .p1 { width: 100px; height: 100px; top: 10%; left: 15%; animation-delay: 0s; }
        .p2 { width: 150px; height: 150px; bottom: 15%; right: 10%; animation-delay: -5s; }
        .p3 { width: 60px; height: 60px; top: 40%; right: 25%; animation-delay: -2s; opacity: 0.5; }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(-50px) rotate(180deg); }
        }

        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-box {
            background: rgba(17, 24, 39, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            text-align: center;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-logo {
            font-size: 40px;
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .login-box h2 {
            margin-top: 0;
            color: #fff;
            font-weight: 800;
            font-size: 26px;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        .login-box p.subtitle {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 24px;
            text-align: left;
            position: relative;
        }
        
        .form-group i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            transition: 0.3s;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 45px;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 12px;
            box-sizing: border-box;
            font-size: 15px;
            color: #fff;
            outline: none;
            transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
        }
        
        .form-control::placeholder {
            color: #6b7280;
        }

        .form-control:focus {
            border-color: var(--color-accent);
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.2);
        }
        
        .form-control:focus + i, .form-group:focus-within i {
            color: var(--color-accent);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--color-accent), var(--color-secondary));
            color: #fff;
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.6);
        }
        
        .btn-submit:active {
            transform: translateY(1px);
        }

        .error-msg {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid rgba(239, 68, 68, 0.2);
            animation: shake 0.5s;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }
        
        .back-link:hover {
            color: #fff;
        }
        
        .back-link i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    
    <div class="particles">
        <div class="particle p1"></div>
        <div class="particle p2"></div>
        <div class="particle p3"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-box">
            <div class="login-logo">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h2>ADMIN PORTAL</h2>
            <p class="subtitle">Đăng nhập để vào không gian quản trị hệ thống</p>
            
            <?php if(!empty($data['error'])): ?>
                <div class="error-msg"><i class="fa-solid fa-circle-exclamation"></i> <?= $data['error'] ?></div>
            <?php endif; ?>

            <form action="<?= BASEURL; ?>/admin/login" method="POST">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập" required autocomplete="off">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu bảo mật" required>
                    <i class="fa-solid fa-lock"></i>
                </div>
                <button type="submit" class="btn-submit">Bắt đầu <i class="fa-solid fa-arrow-right" style="margin-left:5px;"></i></button>
            </form>

            <a href="<?= BASEURL; ?>" class="back-link"><i class="fa-solid fa-arrow-left"></i> Trở về cửa hàng (Public)</a>
        </div>
    </div>

</body>
</html>
