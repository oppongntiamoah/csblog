<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <a href="<?= base_url('admin/categories') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Categories
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card form-card">
            <div class="card-body p-4">
                <form method="POST" action="<?= $category ? base_url('admin/categories/update/'.$category['id']) : base_url('admin/categories/store') ?>">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="cat_name" class="form-control"
                               value="<?= esc($category['name'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Slug</label>
                        <input type="text" name="slug" id="cat_slug" class="form-control font-monospace"
                               value="<?= esc($category['slug'] ?? '') ?>"
                               placeholder="auto-generated">
                        <div class="form-text">URL-friendly identifier. Leave blank to auto-generate.</div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm-4">
                            <label class="form-label small fw-semibold">Theme</label>
                            <select name="theme" class="form-select" required>
                                <?php foreach(['A','B','other'] as $t): ?>
                                <option value="<?= $t ?>" <?= ($category['theme'] ?? 'A') === $t ? 'selected' : '' ?>>
                                    <?= $t === 'other' ? 'Other' : 'Theme '.$t ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label small fw-semibold">Bootstrap Icon</label>
                            <input type="text" name="icon" class="form-control"
                                   value="<?= esc($category['icon'] ?? '') ?>"
                                   placeholder="cpu">
                            <div class="form-text">
                                <a href="https://icons.getbootstrap.com" target="_blank" class="text-decoration-none">Browse icons</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label small fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                   value="<?= $category['sort_order'] ?? 0 ?>">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-semibold">Description</label>
                        <textarea name="description" class="form-control" rows="4"
                                  placeholder="Brief description shown on the category page…"><?= esc($category['description'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success fw-semibold">
                            <i class="bi bi-check2 me-1"></i><?= $category ? 'Update Category' : 'Create Category' ?>
                        </button>
                        <a href="<?= base_url('admin/categories') ?>" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
var nameEl = document.getElementById('cat_name');
var slugEl = document.getElementById('cat_slug');
nameEl.addEventListener('input', function() {
    if (!slugEl.dataset.manual) {
        slugEl.value = nameEl.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    }
});
slugEl.addEventListener('input', function() { slugEl.dataset.manual = '1'; });
</script>

<?= $this->endSection() ?>
