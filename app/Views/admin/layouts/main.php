<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin') ?> — CSKB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --sb-width: 230px;
            --sb-bg: #1a1a2e;
            --sb-hover: #16213e;
            --sb-active: #0f3460;
            --topbar-h: 56px;
        }
        body { background: #f1f3f8; font-family: 'Segoe UI', system-ui, sans-serif; }

        /* ── Sidebar ── */
        .admin-sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sb-width);
            background: var(--sb-bg);
            display: flex; flex-direction: column;
            z-index: 1040;
            overflow-y: auto;
        }
        .sb-brand {
            padding: 1rem 1.1rem;
            border-bottom: 1px solid rgba(255,255,255,.07);
            text-decoration: none;
            display: flex; align-items: center; gap: .6rem;
        }
        .sb-brand span { color: #fff; font-weight: 700; font-size: .95rem; }
        .sb-section {
            padding: .75rem 1.1rem .2rem;
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: rgba(255,255,255,.28);
        }
        .sb-link {
            display: flex; align-items: center; gap: .6rem;
            padding: .5rem 1rem;
            margin: 1px .5rem;
            border-radius: 7px;
            color: rgba(255,255,255,.62);
            text-decoration: none;
            font-size: .875rem;
            transition: background .15s, color .15s;
        }
        .sb-link:hover { background: var(--sb-hover); color: #fff; }
        .sb-link.active { background: var(--sb-active); color: #fff; font-weight: 500; }
        .sb-link i { font-size: 1rem; flex-shrink: 0; }
        .sb-footer {
            padding: .75rem 1rem;
            border-top: 1px solid rgba(255,255,255,.07);
            margin-top: auto;
        }

        /* ── Main ── */
        .admin-main {
            margin-left: var(--sb-width);
            display: flex; flex-direction: column; min-height: 100vh;
        }
        .admin-topbar {
            position: sticky; top: 0; z-index: 100;
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #e3e6ed;
            display: flex; align-items: center;
            padding: 0 1.5rem;
            gap: 1rem;
        }
        .admin-topbar .page-title { font-weight: 600; font-size: 1rem; margin: 0; }
        .admin-body { padding: 1.5rem; flex: 1; }

        /* ── Cards ── */
        .stat-card { border-radius: 12px; border: none; }
        .stat-card .stat-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
        }

        /* ── Tables ── */
        .admin-table th { font-size: .75rem; text-transform: uppercase; letter-spacing: .05em; color: #6c757d; font-weight: 600; }
        .admin-table td { vertical-align: middle; }

        /* ── Forms ── */
        .form-card { border-radius: 12px; border: none; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .seo-panel { background: #f8f9ff; border: 1px solid #d0d9ff; border-radius: 10px; padding: 1.25rem; }
        .seo-panel .seo-badge { background: #5c6bc0; color: #fff; border-radius: 4px; padding: 2px 8px; font-size: .7rem; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; }
        .char-count { font-size: .75rem; color: #6c757d; }
        .char-count.warn { color: #dc3545; }

        /* ── Misc ── */
        .badge-placement { font-size: .7rem; }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="admin-sidebar">
    <a class="sb-brand" href="<?= base_url('admin/dashboard') ?>">
        <i class="bi bi-braces-asterisk text-warning fs-5"></i>
        <span>CS<span class="text-warning">KB</span> Admin</span>
    </a>

    <nav class="py-2 flex-grow-1">
        <div class="sb-section">Main</div>
        <a class="sb-link <?= uri_string() === 'admin/dashboard' ? 'active' : '' ?>"
           href="<?= base_url('admin/dashboard') ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="sb-section">Content</div>
        <a class="sb-link <?= str_starts_with(uri_string(), 'admin/posts') ? 'active' : '' ?>"
           href="<?= base_url('admin/posts') ?>">
            <i class="bi bi-file-earmark-text"></i> Posts
        </a>
        <a class="sb-link <?= str_starts_with(uri_string(), 'admin/categories') ? 'active' : '' ?>"
           href="<?= base_url('admin/categories') ?>">
            <i class="bi bi-folder2-open"></i> Categories
        </a>

        <div class="sb-section">Monetization</div>
        <a class="sb-link <?= str_starts_with(uri_string(), 'admin/ads') ? 'active' : '' ?>"
           href="<?= base_url('admin/ads') ?>">
            <i class="bi bi-megaphone"></i> Ads
        </a>
    </nav>

    <div class="sb-footer">
        <a class="sb-link mb-1" href="<?= base_url('/') ?>" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> View Site
        </a>
        <a class="sb-link" href="<?= base_url('admin/logout') ?>" style="color:rgba(255,100,100,.75);">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
</aside>

<!-- Main -->
<div class="admin-main">
    <div class="admin-topbar">
        <h1 class="page-title"><?= esc($title ?? 'Admin') ?></h1>
        <div class="ms-auto d-flex align-items-center gap-2 text-muted small">
            <i class="bi bi-person-circle"></i>
            <?= esc(session()->get('admin_username') ?? 'Admin') ?>
        </div>
    </div>

    <div class="admin-body">
        <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Character counters for SEO fields
document.querySelectorAll('[data-char-target]').forEach(function(el) {
    var target = document.getElementById(el.dataset.charTarget);
    var max    = parseInt(el.dataset.charMax, 10);
    if (!target) return;
    function update() {
        var len = target.value.length;
        el.textContent = len + ' / ' + max;
        el.classList.toggle('warn', len > max);
    }
    target.addEventListener('input', update);
    update();
});
// Auto-generate slug from title
var titleEl = document.getElementById('post_title');
var slugEl  = document.getElementById('post_slug');
if (titleEl && slugEl) {
    titleEl.addEventListener('input', function() {
        if (!slugEl.dataset.manual) {
            slugEl.value = titleEl.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
        }
    });
    slugEl.addEventListener('input', function() {
        slugEl.dataset.manual = '1';
    });
}
</script>
</body>
</html>
