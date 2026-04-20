<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
// Compute category code (A1, A2… B1, B2…)
$_code = $cat_code ?? '';
$_pageTitle = $_code ? $_code . ' ' . ($category['name'] ?? $active_category ?? '') : ($category['name'] ?? $active_category ?? 'IB Computer Science');
$_desc = $category['description'] ?? $category_description ?? null;
?>

<!-- Breadcrumb -->
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="<?= base_url('/') ?>">Home</a>
    <span class="sep">/</span>
    <span><?= esc($_pageTitle) ?></span>
</nav>

<!-- Page title -->
<h1 class="page-title"><?= esc($_pageTitle) ?></h1>

<!-- Description box -->
<?php if ($_desc): ?>
<div class="box-info"><?= esc($_desc) ?></div>
<?php endif; ?>

<!-- IMPORTANT note (shown if any HL objectives exist) -->
<?php
$_hasHl = false;
foreach ($objectives ?? [] as $_o) { if ($_o['hl']) { $_hasHl = true; break; } }
?>
<?php if ($_hasHl): ?>
<div class="box-note">
    <div class="box-label">Note</div>
    <p>Items marked <strong>HL</strong> are Higher Level only and are not required for Standard Level students.</p>
</div>
<?php endif; ?>

<!-- Objectives list -->
<?php if (!empty($objectives)): ?>
<ul class="topics-list">
    <?php foreach ($objectives as $obj): ?>
    <li>
        <a href="<?= base_url('blog/post/' . $obj['slug']) ?>">
            <?= esc($obj['code']) ?>: <?= esc($obj['title']) ?>
        </a>
        <?php if ($obj['hl']): ?>
        <span class="hl-tag">HL</span>
        <?php endif; ?>
    </li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
<p style="color:var(--muted); font-size:.9rem;">No objectives published yet for this category. Check back soon.</p>
<?php endif; ?>

<?= $this->endSection() ?>
