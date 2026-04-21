<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<nav class="breadcrumb">
    <a href="<?= base_url('/') ?>">Home</a><span class="sep">/</span>
    <a href="<?= base_url('forum') ?>">Forum</a><span class="sep">/</span>
    <span><?= esc($category['name']) ?></span>
</nav>

<div style="display:flex;align-items:baseline;justify-content:space-between;flex-wrap:wrap;gap:.5rem;margin-bottom:.75rem;">
    <h1 class="page-title" style="margin:0;"><?= esc($category['name']) ?></h1>
    <?php if (session()->get('user_logged_in')): ?>
    <a href="<?= base_url('forum/' . $category['slug'] . '/new') ?>" class="btn-primary-sm">
        <i class="bi bi-plus-lg"></i> New Thread
    </a>
    <?php else: ?>
    <a href="<?= base_url('auth/google') ?>" class="btn-google btn-google-sm">
        <svg width="13" height="13" viewBox="0 0 48 48" style="vertical-align:middle;margin-right:5px;"><path fill="#4285F4" d="M44.5 20H24v8.5h11.7C34.3 33.1 29.7 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.7 1.1 7.8 2.9l6.3-6.3C34.4 5.3 29.5 3 24 3 12.4 3 3 12.4 3 24s9.4 21 21 21c10.9 0 20-7.9 20-21 0-1.4-.1-2.7-.5-4z"/></svg>
        Sign in to post
    </a>
    <?php endif; ?>
</div>

<?php if ($category['description']): ?>
<p style="color:var(--muted);font-size:.875rem;margin-bottom:1rem;"><?= esc($category['description']) ?></p>
<?php endif; ?>

<?php if (session()->getFlashdata('forum_error')): ?>
<div class="box-note" style="border-color:#f87171;background:#fef2f2;margin-bottom:.75rem;">
    <div class="box-label" style="color:#dc2626;">Error</div>
    <p><?= esc(session()->getFlashdata('forum_error')) ?></p>
</div>
<?php endif; ?>

<?php if (empty($threads)): ?>
<div style="padding:2.5rem 0;text-align:center;color:var(--muted);">
    <i class="bi bi-chat-square" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
    No threads yet.
    <?php if (session()->get('user_logged_in')): ?>
    <a href="<?= base_url('forum/' . $category['slug'] . '/new') ?>">Be the first to start one.</a>
    <?php endif; ?>
</div>
<?php else: ?>
<div class="thread-list">
    <?php foreach ($threads as $t): ?>
    <div class="thread-row <?= $t['is_pinned'] ? 'thread-pinned' : '' ?>">
        <div class="thread-main">
            <?php if ($t['is_pinned']): ?>
            <span class="thread-badge pin"><i class="bi bi-pin-fill"></i> Pinned</span>
            <?php endif; ?>
            <?php if ($t['is_locked']): ?>
            <span class="thread-badge lock"><i class="bi bi-lock-fill"></i> Locked</span>
            <?php endif; ?>
            <a class="thread-title" href="<?= base_url('forum/t/' . $t['id']) ?>"><?= esc($t['title']) ?></a>
            <span class="thread-meta">
                by <strong><?= esc($t['author_name']) ?></strong>
                · <?= time_ago($t['created_at']) ?>
            </span>
        </div>
        <div class="thread-stats">
            <span title="Replies"><i class="bi bi-chat"></i> <?= (int) $t['reply_count'] - 1 ?></span>
            <span title="Views"><i class="bi bi-eye"></i> <?= (int) $t['views'] ?></span>
            <?php if ($t['last_reply_at'] && $t['last_reply_at'] !== $t['created_at']): ?>
            <span class="thread-last"><?= time_ago($t['last_reply_at']) ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
