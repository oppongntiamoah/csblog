<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row">
        <!-- Main Post Content -->
        <div class="col-lg-8">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item"><a href="<?= base_url('/') ?>" class="text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('blog/category/'.$post['category_slug']) ?>" class="text-decoration-none"><?= esc($post['category']) ?></a></li>
                    <li class="breadcrumb-item active"><?= esc($post['code']) ?></li>
                </ol>
            </nav>

            <!-- Post Header -->
            <div class="mb-4">
                <?php if($post['hl']): ?>
                <span class="badge bg-warning text-dark fw-semibold mb-2">HL Only</span>
                <?php endif; ?>
                <span class="badge bg-primary fw-semibold mb-2 ms-1"><?= esc($post['code']) ?></span>
                <h1 class="post-title fw-bold lh-sm"><?= esc($post['title']) ?></h1>
                <div class="d-flex align-items-center gap-3 mt-3 text-muted small">
                    <span><i class="bi bi-tag me-1"></i><?= esc($post['category']) ?></span>
                    <span><i class="bi bi-clock me-1"></i>5 min read</span>
                    <span><i class="bi bi-calendar3 me-1"></i><?= date('M j, Y') ?></span>
                </div>
            </div>

            <!-- Post Body -->
            <article class="post-content">
                <?= $post['content'] ?? '<p>Content for this objective is being written. Check back soon!</p>' ?>
            </article>

            <!-- Navigation between objectives -->
            <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                <?php if(!empty($prev_post)): ?>
                <a href="<?= base_url('blog/post/'.$prev_post['slug']) ?>" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i><?= esc($prev_post['code']) ?>
                </a>
                <?php else: ?>
                <div></div>
                <?php endif; ?>
                <?php if(!empty($next_post)): ?>
                <a href="<?= base_url('blog/post/'.$next_post['slug']) ?>" class="btn btn-outline-primary btn-sm">
                    <?= esc($next_post['code']) ?><i class="bi bi-arrow-right ms-1"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body">
                    <h6 class="fw-bold text-uppercase text-muted small mb-3">More in this section</h6>
                    <ul class="list-unstyled mb-0">
                        <?php foreach($related ?? [] as $r): ?>
                        <li class="border-bottom py-2">
                            <a href="<?= base_url('blog/post/'.$r['slug']) ?>" class="text-decoration-none text-dark small d-flex align-items-start gap-2">
                                <span class="badge bg-light text-muted border mt-1 flex-shrink-0"><?= esc($r['code']) ?></span>
                                <span><?= esc($r['title']) ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
