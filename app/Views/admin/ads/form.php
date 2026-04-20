<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <a href="<?= base_url('admin/ads') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Ads
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card form-card">
            <div class="card-body p-4">
                <form method="POST" action="<?= $ad ? base_url('admin/ads/update/'.$ad['id']) : base_url('admin/ads/store') ?>">
                    <?= csrf_field() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-7">
                            <label class="form-label small fw-semibold">Ad Unit Name <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control"
                                   value="<?= esc($ad['title'] ?? '') ?>"
                                   placeholder="e.g. Google AdSense Sidebar" required>
                        </div>
                        <div class="col-sm-3">
                            <label class="form-label small fw-semibold">Placement</label>
                            <select name="placement" class="form-select">
                                <?php foreach(['header','sidebar','inline','footer'] as $p): ?>
                                <option value="<?= $p ?>" <?= ($ad['placement'] ?? 'sidebar') === $p ? 'selected' : '' ?>>
                                    <?= ucfirst($p) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label class="form-label small fw-semibold">Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="<?= $ad['sort_order'] ?? 0 ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Ad Code <span class="text-muted fw-normal">(HTML / JavaScript)</span></label>
                        <textarea name="code" class="form-control font-monospace" rows="10"
                                  placeholder="Paste your AdSense code, banner HTML, or any embed snippet here…"><?= esc($ad['code'] ?? '') ?></textarea>
                        <div class="form-text">Paste raw HTML/JS. This will be rendered as-is on the site.</div>
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input type="checkbox" name="active" id="ad_active" class="form-check-input" value="1"
                               <?= ($ad['active'] ?? 1) ? 'checked' : '' ?>>
                        <label class="form-check-label small fw-semibold" for="ad_active">Active (visible on site)</label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning fw-semibold">
                            <i class="bi bi-check2 me-1"></i><?= $ad ? 'Update Ad' : 'Save Ad Unit' ?>
                        </button>
                        <a href="<?= base_url('admin/ads') ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Placement guide -->
        <div class="card border-0 shadow-sm rounded-3 mt-3">
            <div class="card-body p-3">
                <h6 class="fw-bold small mb-2"><i class="bi bi-info-circle me-1 text-primary"></i>Placement Guide</h6>
                <ul class="small text-muted mb-0">
                    <li><strong>Header</strong> — Displayed at the top of every page, above the navbar.</li>
                    <li><strong>Sidebar</strong> — Displayed in the right sidebar of post pages.</li>
                    <li><strong>Inline</strong> — Injected within post content (after the article body).</li>
                    <li><strong>Footer</strong> — Displayed at the bottom of every page, before the footer.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
