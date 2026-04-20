<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-3">
    <div class="text-muted small"><?= count($categories) ?> categor<?= count($categories) === 1 ? 'y' : 'ies' ?></div>
    <a href="<?= base_url('admin/categories/new') ?>" class="btn btn-success btn-sm">
        <i class="bi bi-plus-lg me-1"></i>New Category
    </a>
</div>

<div class="card shadow-sm border-0 rounded-3">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead><tr>
                <th class="ps-3">Name</th>
                <th>Slug</th>
                <th>Theme</th>
                <th>Icon</th>
                <th style="width:60px">Order</th>
                <th class="pe-3" style="width:130px">Actions</th>
            </tr></thead>
            <tbody>
            <?php foreach($categories as $cat): ?>
            <tr>
                <td class="ps-3 fw-medium"><?= esc($cat['name']) ?></td>
                <td class="font-monospace small text-muted"><?= esc($cat['slug']) ?></td>
                <td>
                    <span class="badge bg-<?= $cat['theme'] === 'A' ? 'primary' : ($cat['theme'] === 'B' ? 'success' : 'secondary') ?>">
                        <?= $cat['theme'] === 'other' ? 'Other' : 'Theme '.$cat['theme'] ?>
                    </span>
                </td>
                <td><?php if($cat['icon']): ?><i class="bi bi-<?= esc($cat['icon']) ?>"></i><?php endif; ?></td>
                <td class="text-muted small"><?= $cat['sort_order'] ?></td>
                <td class="pe-3">
                    <div class="d-flex gap-1">
                        <a href="<?= base_url('admin/categories/edit/'.$cat['id']) ?>"
                           class="btn btn-sm btn-outline-secondary py-0">Edit</a>
                        <form method="POST" action="<?= base_url('admin/categories/delete/'.$cat['id']) ?>"
                              onsubmit="return confirm('Delete this category and all its posts?')">
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
