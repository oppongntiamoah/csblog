<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <a href="<?= base_url('admin/posts') ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Posts
    </a>
</div>

<form method="POST" action="<?= $post ? base_url('admin/posts/update/'.$post['id']) : base_url('admin/posts/store') ?>">
    <?= csrf_field() ?>

    <div class="row g-3">
        <!-- Left: main fields -->
        <div class="col-lg-8">

            <!-- Post details -->
            <div class="card form-card mb-3">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-3">
                            <label class="form-label small fw-semibold">Objective Code</label>
                            <input type="text" name="code" class="form-control"
                                   value="<?= esc($post['code'] ?? '') ?>" placeholder="A1.1.1" required>
                        </div>
                        <div class="col-sm-9">
                            <label class="form-label small fw-semibold">Title</label>
                            <input type="text" name="title" id="post_title" class="form-control"
                                   value="<?= esc($post['title'] ?? '') ?>"
                                   placeholder="Describe the functions of…" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Slug</label>
                            <input type="text" name="slug" id="post_slug" class="form-control font-monospace"
                                   value="<?= esc($post['slug'] ?? '') ?>"
                                   placeholder="auto-generated-from-title">
                            <div class="form-text">Leave blank to auto-generate from code + title.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="card form-card mb-3">
                <div class="card-body">
                    <label class="form-label small fw-semibold">Content</label>
                    <textarea name="content" id="post_content" class="form-control font-monospace"
                              rows="18" placeholder="HTML or plain text content…"><?= esc($post['content'] ?? '') ?></textarea>
                    <div class="form-text">Supports full HTML.</div>
                </div>
            </div>

            <!-- SEO Panel -->
            <div class="seo-panel mb-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="seo-badge">SEO</span>
                    <span class="fw-semibold small">Search Engine Optimisation</span>
                </div>

                <!-- Preview snippet -->
                <div class="border rounded-3 p-3 mb-3 bg-white" id="seo-preview">
                    <div class="small text-success mb-1" id="preview-url"><?= base_url('blog/post/'.($post['slug'] ?? 'your-slug')) ?></div>
                    <div class="fw-semibold text-primary mb-1" id="preview-title" style="font-size:.95rem"><?= esc($post['seo_title'] ?? $post['title'] ?? 'SEO Title Preview') ?></div>
                    <div class="small text-muted" id="preview-desc"><?= esc($post['seo_description'] ?? 'Meta description preview will appear here…') ?></div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label small fw-semibold mb-1">SEO Title</label>
                        <span class="char-count" data-char-target="seo_title_input" data-char-max="60">0 / 60</span>
                    </div>
                    <input type="text" name="seo_title" id="seo_title_input" class="form-control"
                           value="<?= esc($post['seo_title'] ?? '') ?>"
                           placeholder="Leave blank to use the post title"
                           maxlength="255">
                    <div class="form-text">Ideal: 50–60 characters.</div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <label class="form-label small fw-semibold mb-1">Meta Description</label>
                        <span class="char-count" data-char-target="seo_desc_input" data-char-max="160">0 / 160</span>
                    </div>
                    <textarea name="seo_description" id="seo_desc_input" class="form-control" rows="3"
                              placeholder="Brief summary shown in search results…"
                              maxlength="320"><?= esc($post['seo_description'] ?? '') ?></textarea>
                    <div class="form-text">Ideal: 120–160 characters.</div>
                </div>

                <div>
                    <label class="form-label small fw-semibold mb-1">Focus Keywords</label>
                    <input type="text" name="seo_keywords" class="form-control"
                           value="<?= esc($post['seo_keywords'] ?? '') ?>"
                           placeholder="cpu, fetch decode execute, ib computer science">
                    <div class="form-text">Comma-separated keywords.</div>
                </div>
            </div>

        </div>

        <!-- Right: sidebar options -->
        <div class="col-lg-4">
            <!-- Publish -->
            <div class="card form-card mb-3">
                <div class="card-header bg-transparent border-0 pb-0 pt-3 px-3">
                    <h6 class="fw-bold small mb-0">Publish</h6>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-check2 me-1"></i><?= $post ? 'Update Post' : 'Publish Post' ?>
                    </button>
                    <?php if($post): ?>
                    <a href="<?= base_url('blog/post/'.$post['slug']) ?>" target="_blank"
                       class="btn btn-outline-secondary w-100 mt-2 btn-sm">
                        <i class="bi bi-eye me-1"></i>View Post
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Category & settings -->
            <div class="card form-card mb-3">
                <div class="card-header bg-transparent border-0 pb-0 pt-3 px-3">
                    <h6 class="fw-bold small mb-0">Details</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">— Select —</option>
                            <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>"
                                <?= ($post['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                                <?= esc($cat['name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Sort Order</label>
                        <input type="number" name="sort_order" class="form-control"
                               value="<?= $post['sort_order'] ?? 0 ?>">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="hl" id="hl_check" class="form-check-input" value="1"
                               <?= ($post['hl'] ?? 0) ? 'checked' : '' ?>>
                        <label class="form-check-label small" for="hl_check">Higher Level (HL) only</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
// Live SEO preview
(function() {
    var titleInput = document.getElementById('seo_title_input');
    var descInput  = document.getElementById('seo_desc_input');
    var postTitle  = document.getElementById('post_title');
    var prevTitle  = document.getElementById('preview-title');
    var prevDesc   = document.getElementById('preview-desc');

    function updateTitle() {
        prevTitle.textContent = titleInput.value || postTitle.value || 'SEO Title Preview';
    }
    function updateDesc() {
        prevDesc.textContent = descInput.value || 'Meta description preview will appear here…';
    }
    titleInput.addEventListener('input', updateTitle);
    postTitle.addEventListener('input', updateTitle);
    descInput.addEventListener('input', updateDesc);
})();
</script>

<?= $this->endSection() ?>
