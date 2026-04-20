<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — CSKB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #1a1a2e; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { width: 100%; max-width: 380px; border-radius: 14px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,.4); }
        .login-logo { font-size: 2rem; }
    </style>
</head>
<body>
<div class="card login-card p-4">
    <div class="text-center mb-4">
        <div class="login-logo mb-2">
            <i class="bi bi-braces-asterisk text-warning"></i>
        </div>
        <h5 class="fw-bold mb-0">CSKB Admin</h5>
        <p class="text-muted small">Sign in to your admin panel</p>
    </div>

    <?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger small py-2">
        <i class="bi bi-exclamation-triangle me-1"></i><?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?= base_url('admin/login') ?>">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label small fw-semibold">Username or Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="username" class="form-control" required autofocus placeholder="admin">
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label small fw-semibold">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" required placeholder="••••••••">
            </div>
        </div>
        <button type="submit" class="btn btn-warning w-100 fw-semibold">
            Sign In <i class="bi bi-arrow-right ms-1"></i>
        </button>
    </form>

    <div class="text-center mt-3">
        <a href="<?= base_url('/') ?>" class="text-muted small text-decoration-none">
            <i class="bi bi-arrow-left me-1"></i>Back to site
        </a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
