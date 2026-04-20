<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="<?= base_url('/') ?>">Home</a>
    <span class="sep">/</span>
    <?php if (!empty($post['category_slug'])): ?>
    <a href="<?= base_url('blog/category/' . $post['category_slug']) ?>"><?= esc($post['category'] ?? 'Category') ?></a>
    <span class="sep">/</span>
    <?php endif; ?>
    <span><?= esc($post['code']) ?></span>
</nav>

<!-- Badges -->
<div class="post-meta">
    <span class="badge-code"><?= esc($post['code']) ?></span>
    <?php if ($post['hl']): ?>
    <span class="badge-hl">HL Only</span>
    <?php endif; ?>
</div>

<!-- Title -->
<h1 class="page-title"><?= esc($post['title']) ?></h1>

<!-- Content -->
<div class="post-body">
    <?= $post['content'] ?? '<p style="color:var(--muted)">Content for this objective is being written. Check back soon.</p>' ?>
</div>

<!-- Prev / Next navigation -->
<?php if (!empty($prev_post) || !empty($next_post)): ?>
<div class="post-nav">
    <?php if (!empty($prev_post)): ?>
    <a href="<?= base_url('blog/post/' . $prev_post['slug']) ?>">
        <i class="bi bi-arrow-left"></i>
        <span><?= esc($prev_post['code']) ?> <?= esc($prev_post['title']) ?></span>
    </a>
    <?php else: ?>
    <span></span>
    <?php endif; ?>

    <?php if (!empty($next_post)): ?>
    <a href="<?= base_url('blog/post/' . $next_post['slug']) ?>" style="text-align:right">
        <span><?= esc($next_post['code']) ?> <?= esc($next_post['title']) ?></span>
        <i class="bi bi-arrow-right"></i>
    </a>
    <?php endif; ?>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
