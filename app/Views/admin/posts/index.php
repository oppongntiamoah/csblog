<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-3">
    <div class="text-muted small"><?= count($posts) ?> post(s)</div>
    <a href="<?= base_url('admin/posts/new') ?>" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>New Post
    </a>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead><tr>
                <th class="ps-3" style="width:80px">Code</th>
                <th>Title</th>
                <th>Category</th>
                <th style="width:60px">HL</th>
                <th style="width:60px">Order</th>
                <th class="pe-3" style="width:120px">Actions</th>
            </tr></thead>
            <tbody>
            <?php foreach($posts as $post): ?>
            <tr>
                <td class="ps-3"><span class="badge bg-primary"><?= esc($post['code']) ?></span></td>
                <td>
                    <?= esc($post['title']) ?>
                    <?php if($post['seo_title'] ?? null): ?>
                    <i class="bi bi-search text-success ms-1" title="SEO data set" style="font-size:.75rem"></i>
                    <?php endif; ?>
                </td>
                <td class="text-muted small"><?= esc($post['category_name'] ?? '—') ?></td>
                <td><?= $post['hl'] ? '<span class="badge bg-warning text-dark">HL</span>' : '' ?></td>
                <td class="text-muted small"><?= $post['sort_order'] ?></td>
                <td class="pe-3">
                    <div class="d-flex gap-1">
                        <a href="<?= base_url('admin/posts/edit/'.$post['id']) ?>"
                           class="btn btn-sm btn-outline-secondary py-0">Edit</a>
                        <form method="POST" action="<?= base_url('admin/posts/delete/'.$post['id']) ?>"
                              onsubmit="return confirm('Delete this post?')">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger py-0">Del</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
