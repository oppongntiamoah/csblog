<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-3">
    <div class="text-muted small"><?= count($ads) ?> ad unit(s)</div>
    <a href="<?= base_url('admin/ads/new') ?>" class="btn btn-warning btn-sm">
        <i class="bi bi-plus-lg me-1"></i>New Ad Unit
    </a>
</div>

<?php if(empty($ads)): ?>
<div class="text-center py-5 text-muted">
    <i class="bi bi-megaphone fs-1 d-block mb-2"></i>
    No ad units yet. Create one to get started.
</div>
<?php else: ?>
<div class="card shadow-sm border-0 rounded-3">
    <div class="table-responsive">
        <table class="table admin-table mb-0">
            <thead><tr>
                <th class="ps-3">Title</th>
                <th>Placement</th>
                <th>Status</th>
                <th style="width:60px">Order</th>
                <th class="pe-3" style="width:130px">Actions</th>
            </tr></thead>
            <tbody>
            <?php foreach($ads as $ad): ?>
            <tr>
                <td class="ps-3 fw-medium"><?= esc($ad['title']) ?></td>
                <td>
                    <?php
                    $colors = ['header'=>'danger','sidebar'=>'info','footer'=>'secondary','inline'=>'primary'];
                    $c = $colors[$ad['placement']] ?? 'secondary';
                    ?>
                    <span class="badge bg-<?= $c ?> badge-placement"><?= ucfirst($ad['placement']) ?></span>
                </td>
                <td>
                    <?php if($ad['active']): ?>
                    <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                    <?php else: ?>
                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Inactive</span>
                    <?php endif; ?>
                </td>
                <td class="text-muted small"><?= $ad['sort_order'] ?></td>
                <td class="pe-3">
                    <div class="d-flex gap-1">
                        <a href="<?= base_url('admin/ads/edit/'.$ad['id']) ?>"
                           class="btn btn-sm btn-outline-secondary py-0">Edit</a>
                        <form method="POST" action="<?= base_url('admin/ads/delete/'.$ad['id']) ?>"
                              onsubmit="return confirm('Delete this ad unit?')">
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
<?php endif; ?>

<?= $this->endSection() ?>
