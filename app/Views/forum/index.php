<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<nav class="breadcrumb"><a href="<?= base_url('/') ?>">Home</a><span class="sep">/</span><span>Forum</span></nav>

<div style="display:flex;align-items:baseline;justify-content:space-between;flex-wrap:wrap;gap:.5rem;margin-bottom:1.1rem;">
    <h1 class="page-title" style="margin:0;">Forum</h1>
    <?php if (session()->get('user_logged_in')): ?>
    <span style="font-size:.82rem;color:var(--muted);">
        Signed in as <strong><?= esc(session()->get('user_name')) ?></strong>
        · <a href="<?= base_url('auth/logout') ?>">Sign out</a>
    </span>
    <?php else: ?>
    <a href="<?= base_url('auth/google') ?>" class="btn-google">
        <svg width="16" height="16" viewBox="0 0 48 48" style="vertical-align:middle;margin-right:6px;"><path fill="#4285F4" d="M44.5 20H24v8.5h11.7C34.3 33.1 29.7 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.7 1.1 7.8 2.9l6.3-6.3C34.4 5.3 29.5 3 24 3 12.4 3 3 12.4 3 24s9.4 21 21 21c10.9 0 20-7.9 20-21 0-1.4-.1-2.7-.5-4z"/></svg>
        Sign in with Google
    </a>
    <?php endif; ?>
</div>

<div class="box-info">A place to discuss IB Computer Science topics, ask questions, and share ideas. Sign in with your Google account to participate.</div>

<?php if (session()->getFlashdata('forum_error')): ?>
<div class="box-note" style="border-color:#f87171;background:#fef2f2;">
    <div class="box-label" style="color:#dc2626;">Error</div>
    <p><?= esc(session()->getFlashdata('forum_error')) ?></p>
</div>
<?php endif; ?>

<?php if (empty($categories)): ?>
<p style="color:var(--muted);font-size:.9rem;">No forum categories yet.</p>
<?php else: ?>
<div class="forum-cat-list">
    <?php foreach ($categories as $cat): ?>
    <div class="forum-cat-row">
        <div class="forum-cat-icon">
            <i class="bi bi-chat-dots"></i>
        </div>
        <div class="forum-cat-info">
            <a class="forum-cat-name" href="<?= base_url('forum/' . $cat['slug']) ?>"><?= esc($cat['name']) ?></a>
            <?php if ($cat['description']): ?>
            <p class="forum-cat-desc"><?= esc($cat['description']) ?></p>
            <?php endif; ?>
        </div>
        <div class="forum-cat-stats">
            <span><strong><?= (int) $cat['thread_count'] ?></strong> threads</span>
            <span><strong><?= (int) $cat['post_count'] ?></strong> posts</span>
            <?php if ($cat['last_activity_at']): ?>
            <span class="forum-last">Last post <?= time_ago($cat['last_activity_at']) ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
