<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="mb-5">
        <h1 class="fw-bold">All Topics</h1>
        <p class="text-muted">Browse all IB Computer Science learning objectives, organised by theme and category.</p>
    </div>

    <?php foreach($categories as $cat): ?>
    <?php
        $catPosts = array_filter($posts, fn($p) => $p['category_id'] === $cat['id']);
        if(empty($catPosts)) continue;
    ?>
    <div class="mb-5">
        <div class="d-flex align-items-center gap-2 mb-3">
            <?php if($cat['icon']): ?>
            <i class="bi bi-<?= esc($cat['icon']) ?> fs-5 text-primary"></i>
            <?php endif; ?>
            <h2 class="h4 fw-bold mb-0"><?= esc($cat['name']) ?></h2>
            <span class="badge bg-secondary ms-1"><?= count($catPosts) ?></span>
            <a href="<?= base_url('blog/category/'.$cat['slug']) ?>" class="ms-auto btn btn-outline-primary btn-sm">View all</a>
        </div>
        <?php if($cat['description']): ?>
        <p class="text-muted small mb-3"><?= esc($cat['description']) ?></p>
        <?php endif; ?>
        <div class="objectives-list">
            <?php foreach($catPosts as $post): ?>
            <a href="<?= base_url('blog/post/'.$post['slug']) ?>"
               class="objective-row <?= $post['hl'] ? 'hl-row' : '' ?>">
                <span class="obj-code"><?= esc($post['code']) ?></span>
                <span class="obj-text"><?= esc($post['title']) ?></span>
                <?php if($post['hl']): ?>
                <span class="badge bg-warning text-dark ms-2 small fw-semibold">HL</span>
                <?php endif; ?>
                <i class="bi bi-chevron-right ms-auto text-muted obj-arrow"></i>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
