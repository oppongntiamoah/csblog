<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<nav class="breadcrumb">
    <a href="<?= base_url('/') ?>">Home</a><span class="sep">/</span>
    <a href="<?= base_url('forum') ?>">Forum</a><span class="sep">/</span>
    <a href="<?= base_url('forum/' . $thread['category_slug']) ?>"><?= esc($thread['category_name']) ?></a>
    <span class="sep">/</span>
    <span><?= esc($thread['title']) ?></span>
</nav>

<h1 class="page-title"><?= esc($thread['title']) ?></h1>

<div style="font-size:.8rem;color:var(--muted);margin-bottom:1.5rem;">
    <?= (int) count($posts) ?> post<?= count($posts) !== 1 ? 's' : '' ?>
    · <?= (int) $thread['views'] ?> view<?= $thread['views'] !== 1 ? 's' : '' ?>
    <?php if ($thread['is_locked']): ?>
    · <span style="color:#dc2626;"><i class="bi bi-lock-fill"></i> Locked</span>
    <?php endif; ?>
</div>

<?php if (session()->getFlashdata('forum_error')): ?>
<div class="box-note" style="border-color:#f87171;background:#fef2f2;margin-bottom:1rem;">
    <div class="box-label" style="color:#dc2626;">Error</div>
    <p><?= esc(session()->getFlashdata('forum_error')) ?></p>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('forum_success')): ?>
<div class="box-note" style="border-color:#34d399;background:#f0fdf4;margin-bottom:1rem;">
    <div class="box-label" style="color:#059669;">Done</div>
    <p><?= esc(session()->getFlashdata('forum_success')) ?></p>
</div>
<?php endif; ?>

<!-- Posts -->
<div class="post-list">
<?php foreach ($posts as $i => $p): ?>
<div class="post-card <?= $i === 0 ? 'post-card--op' : '' ?>" id="post-<?= $p['id'] ?>">
    <!-- Author sidebar -->
    <div class="post-author">
        <?php if ($p['author_avatar']): ?>
        <img src="<?= esc($p['author_avatar']) ?>" alt="<?= esc($p['author_name']) ?>" class="user-avatar">
        <?php else: ?>
        <div class="user-avatar-placeholder"><?= mb_substr($p['author_name'], 0, 1) ?></div>
        <?php endif; ?>
        <div class="post-author-name"><?= esc($p['author_name']) ?></div>
        <?php if ($i === 0): ?><div class="post-author-badge">OP</div><?php endif; ?>
        <div class="post-author-joined">Joined <?= date('M Y', strtotime($p['user_joined'])) ?></div>
    </div>
    <!-- Post body -->
    <div class="post-body-wrap">
        <div class="post-body"><?= nl2br(esc($p['body'])) ?></div>
        <div class="post-footer">
            <span class="post-date"><?= date('j M Y, H:i', strtotime($p['created_at'])) ?></span>
            <?php if ((int) session()->get('user_id') === (int) $p['user_id']): ?>
            <form method="POST" action="<?= base_url('forum/post/' . $p['id'] . '/delete') ?>"
                  onsubmit="return confirm('Delete this post?');" style="display:inline;">
                <?= csrf_field() ?>
                <button type="submit" class="post-delete-btn">Delete</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
</div>

<!-- Reply form / sign-in prompt -->
<div id="latest" style="margin-top:2rem;">
<?php if ($thread['is_locked']): ?>
    <div class="box-note" style="border-color:#d1d5db;background:#f9fafb;">
        <div class="box-label" style="color:#6b7280;">Locked</div>
        <p>This thread is locked and no longer accepts new replies.</p>
    </div>
<?php elseif (session()->get('user_logged_in')): ?>
    <h3 style="font-size:.95rem;font-weight:700;margin-bottom:.75rem;">Post a reply</h3>
    <form method="POST" action="<?= base_url('forum/t/' . $thread['id'] . '/reply') ?>">
        <?= csrf_field() ?>
        <textarea name="body" class="reply-textarea" rows="5"
                  placeholder="Write your reply…" required></textarea>
        <div style="margin-top:.6rem;display:flex;align-items:center;gap:.75rem;">
            <button type="submit" class="btn-primary-sm">Post Reply</button>
            <span style="font-size:.78rem;color:var(--muted);">
                Replying as <strong><?= esc(session()->get('user_name')) ?></strong>
            </span>
        </div>
    </form>
<?php else: ?>
    <div class="box-note">
        <div class="box-label">Sign in to reply</div>
        <p>
            <a href="<?= base_url('auth/google') ?>" class="btn-google" style="margin-top:.5rem;display:inline-flex;">
                <svg width="15" height="15" viewBox="0 0 48 48" style="vertical-align:middle;margin-right:6px;"><path fill="#4285F4" d="M44.5 20H24v8.5h11.7C34.3 33.1 29.7 36 24 36c-6.6 0-12-5.4-12-12s5.4-12 12-12c3 0 5.7 1.1 7.8 2.9l6.3-6.3C34.4 5.3 29.5 3 24 3 12.4 3 3 12.4 3 24s9.4 21 21 21c10.9 0 20-7.9 20-21 0-1.4-.1-2.7-.5-4z"/></svg>
                Sign in with Google
            </a>
        </p>
    </div>
<?php endif; ?>
</div>

<?= $this->endSection() ?>
