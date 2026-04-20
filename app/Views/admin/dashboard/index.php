<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<!-- Stat cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-file-earmark-text"></i>
                </div>
                <div>
                    <div class="h3 fw-bold mb-0"><?= $total_posts ?></div>
                    <div class="text-muted small">Total Posts</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-folder2-open"></i>
                </div>
                <div>
                    <div class="h3 fw-bold mb-0"><?= $total_cats ?></div>
                    <div class="text-muted small">Categories</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card stat-card shadow-sm p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-megaphone"></i>
                </div>
                <div>
                    <div class="h3 fw-bold mb-0"><?= $total_ads ?></div>
                    <div class="text-muted small">Ad Units</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick actions + Recent posts -->
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 rounded-3 h-100">
            <div class="card-header bg-transparent border-0 pt-3 pb-0 px-3">
                <h6 class="fw-bold mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= base_url('admin/posts/new') ?>" class="btn btn-outline-primary btn-sm text-start">
                        <i class="bi bi-plus-circle me-2"></i>New Post
                    </a>
                    <a href="<?= base_url('admin/categories/new') ?>" class="btn btn-outline-success btn-sm text-start">
                        <i class="bi bi-plus-circle me-2"></i>New Category
                    </a>
                    <a href="<?= base_url('admin/ads/new') ?>" class="btn btn-outline-warning btn-sm text-start">
                        <i class="bi bi-plus-circle me-2"></i>New Ad Unit
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-transparent border-0 pt-3 pb-0 px-3 d-flex align-items-center justify-content-between">
                <h6 class="fw-bold mb-0">Recent Posts</h6>
                <a href="<?= base_url('admin/posts') ?>" class="btn btn-sm btn-link text-decoration-none p-0">View all</a>
            </div>
            <div class="card-body p-0">
                <table class="table admin-table mb-0">
                    <thead><tr>
                        <th class="ps-3">Code</th>
                        <th>Title</th>
                        <th class="pe-3">Action</th>
                    </tr></thead>
                    <tbody>
                    <?php foreach($recent_posts as $p): ?>
                    <tr>
                        <td class="ps-3"><span class="badge bg-primary"><?= esc($p['code']) ?></span></td>
                        <td class="text-truncate" style="max-width:260px"><?= esc($p['title']) ?></td>
                        <td class="pe-3">
                            <a href="<?= base_url('admin/posts/edit/'.$p['id']) ?>" class="btn btn-sm btn-outline-secondary py-0">Edit</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
