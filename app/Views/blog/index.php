<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="<?= base_url('/') ?>">Home</a>
    <span class="sep">/</span>
    <span>All Topics</span>
</nav>

<h1 class="page-title">All Topics</h1>

<div class="box-info">
    All IB Computer Science 2027 learning objectives, organised by theme and category.
</div>

<?php
// Group posts by category
$postsByCategory = [];
foreach ($posts as $p) {
    $postsByCategory[$p['category_id']][] = $p;
}
?>

<?php foreach ($categories as $cat): ?>
<?php if (empty($postsByCategory[$cat['id']])) continue; ?>
<h2 style="font-size:1.1rem; font-weight:700; margin: 1.75rem 0 .4rem; color:#111;">
    <a href="<?= base_url('blog/category/' . $cat['slug']) ?>" style="color:inherit; text-decoration:none;">
        <?= esc($cat['name']) ?>
    </a>
</h2>
<?php if ($cat['description']): ?>
<p style="font-size:.85rem; color:var(--muted); margin-bottom:.5rem;"><?= esc($cat['description']) ?></p>
<?php endif; ?>
<ul class="topics-list">
    <?php foreach ($postsByCategory[$cat['id']] as $post): ?>
    <li>
        <a href="<?= base_url('blog/post/' . $post['slug']) ?>">
            <?= esc($post['code']) ?>: <?= esc($post['title']) ?>
        </a>
        <?php if ($post['hl']): ?>
        <span class="hl-tag">HL</span>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php endforeach; ?>

<?= $this->endSection() ?>
