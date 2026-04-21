<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<nav class="breadcrumb">
    <a href="<?= base_url('/') ?>">Home</a><span class="sep">/</span>
    <a href="<?= base_url('forum') ?>">Forum</a><span class="sep">/</span>
    <a href="<?= base_url('forum/' . $category['slug']) ?>"><?= esc($category['name']) ?></a>
    <span class="sep">/</span>
    <span>New Thread</span>
</nav>

<h1 class="page-title">New Thread</h1>
<p style="font-size:.875rem;color:var(--muted);margin-bottom:1.25rem;">
    Posting in <strong><?= esc($category['name']) ?></strong>
    · Signed in as <strong><?= esc(session()->get('user_name')) ?></strong>
    · <a href="<?= base_url('auth/logout') ?>">Sign out</a>
</p>

<?php if (session()->getFlashdata('forum_error')): ?>
<div class="box-note" style="border-color:#f87171;background:#fef2f2;margin-bottom:1rem;">
    <div class="box-label" style="color:#dc2626;">Error</div>
    <p><?= esc(session()->getFlashdata('forum_error')) ?></p>
</div>
<?php endif; ?>

<form method="POST" action="<?= base_url('forum/' . $category['slug'] . '/new') ?>" style="max-width:680px;">
    <?= csrf_field() ?>

    <div style="margin-bottom:1rem;">
        <label style="display:block;font-size:.85rem;font-weight:600;margin-bottom:.3rem;">Thread Title</label>
        <input type="text" name="title" class="new-thread-input"
               value="<?= esc(old('title')) ?>"
               placeholder="What's your question or topic?"
               maxlength="255" required autofocus>
    </div>

    <div style="margin-bottom:1rem;">
        <label style="display:block;font-size:.85rem;font-weight:600;margin-bottom:.3rem;">Message</label>
        <textarea name="body" class="reply-textarea" rows="8"
                  placeholder="Share your question, thoughts, or resources…"
                  required><?= esc(old('body')) ?></textarea>
    </div>

    <div style="display:flex;gap:.75rem;align-items:center;">
        <button type="submit" class="btn-primary-sm">Post Thread</button>
        <a href="<?= base_url('forum/' . $category['slug']) ?>"
           style="font-size:.85rem;color:var(--muted);">Cancel</a>
    </div>
</form>

<?= $this->endSection() ?>
