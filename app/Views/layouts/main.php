<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($seo_title ?? $title ?? 'CS Knowledge Base') ?></title>
    <?php if (!empty($seo_description)): ?>
    <meta name="description" content="<?= esc($seo_description) ?>">
    <?php endif; ?>
    <?php if (!empty($seo_keywords)): ?>
    <meta name="keywords" content="<?= esc($seo_keywords) ?>">
    <?php endif; ?>
    <meta property="og:title" content="<?= esc($seo_title ?? $title ?? 'CS Knowledge Base') ?>">
    <?php if (!empty($seo_description)): ?>
    <meta property="og:description" content="<?= esc($seo_description) ?>">
    <?php endif; ?>
    <meta property="og:type" content="website">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<!-- ── Top bar ── -->
<header class="topbar">
    <button class="topbar-hamburger" id="sidebarToggle" aria-label="Open menu">
        <i class="bi bi-list"></i>
    </button>
    <a class="topbar-brand" href="<?= base_url('/') ?>">ComputerScienceKB</a>
    <div class="topbar-search">
        <span class="topbar-search-icon"><i class="bi bi-search"></i></span>
        <input type="search" placeholder="Search topics…" aria-label="Search">
    </div>
    <nav class="topbar-nav">
        <a href="<?= base_url('forum') ?>">Forum</a>
        <a href="<?= base_url('blog') ?>">All Topics</a>
        <a href="<?= base_url('about') ?>">About</a>
    </nav>
    <!-- User login state -->
    <?php if (session()->get('user_logged_in')): ?>
    <div class="topbar-user">
        <?php if (session()->get('user_avatar')): ?>
        <img src="<?= esc(session()->get('user_avatar')) ?>" alt="<?= esc(session()->get('user_name')) ?>">
        <?php endif; ?>
        <span><?= esc(session()->get('user_name')) ?></span>
        <a href="<?= base_url('auth/logout') ?>" style="color:var(--muted);">Sign out</a>
    </div>
    <?php endif; ?>
</header>

<!-- ── Shell (sidebar + content) ── -->
<div class="shell">

    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <?= $this->include('partials/sidebar') ?>

    <!-- Main area -->
    <div class="main-area">
        <main class="content">
            <?= $this->renderSection('content') ?>
        </main>
        <footer class="site-footer">
            <span>&copy; <?= date('Y') ?> ComputerScienceKB — IB Computer Science 2027 resources</span>
            <span>Built with <a href="https://codeigniter.com">CodeIgniter 4</a></span>
        </footer>
    </div>

</div>

<script>
(function () {
    var btn = document.getElementById('sidebarToggle');
    var sb  = document.getElementById('mainSidebar');
    var ov  = document.getElementById('sidebarOverlay');
    if (!btn || !sb) return;
    btn.addEventListener('click', function () {
        sb.classList.toggle('open');
        ov.classList.toggle('visible');
    });
    ov.addEventListener('click', function () {
        sb.classList.remove('open');
        ov.classList.remove('visible');
    });

    // Sidebar sub-section toggle
    document.querySelectorAll('[data-toggle-sub]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var target = document.getElementById(btn.dataset.toggleSub);
            var chev   = btn.querySelector('.sb-chevron');
            if (target) {
                target.classList.toggle('collapsed');
                if (chev) chev.classList.toggle('up');
            }
        });
    });
})();
</script>
</body>
</html>
