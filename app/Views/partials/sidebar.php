<?php
// Fetch all categories and compute nav labels (A1, B2, etc.)
$_catModel  = new \App\Models\CategoryModel();
$_allCats   = $_catModel->orderBy('theme', 'ASC')->orderBy('sort_order', 'ASC')->findAll();
$_counters  = ['A' => 0, 'B' => 0];
foreach ($_allCats as &$_c) {
    if ($_c['theme'] === 'A' || $_c['theme'] === 'B') {
        $_counters[$_c['theme']]++;
        $_c['nav_label'] = $_c['theme'] . $_counters[$_c['theme']] . ' ' . $_c['name'];
    } else {
        $_c['nav_label'] = $_c['name'];
    }
}
unset($_c);

// Determine active category slug
$_active = $sidebar_active ?? null;
if (!$_active) {
    $_path = service('uri')->getPath();
    if (preg_match('#^blog/category/([^/]+)$#', $_path, $_m)) {
        $_active = $_m[1];
    }
}

// Check if any cs2027 category is active (keep section open)
$_cs2027Active = false;
foreach ($_allCats as $_c) {
    if ($_c['slug'] === $_active) { $_cs2027Active = true; break; }
}
?>
<nav class="sidebar" id="mainSidebar" aria-label="Site navigation">

    <a class="sb-link <?= (service('uri')->getPath() === '' || service('uri')->getPath() === '/') ? 'active' : '' ?>"
       href="<?= base_url('/') ?>">Home</a>

    <div class="sb-divider"></div>

    <!-- IB CS 2027 section -->
    <button class="sb-section" type="button"
            data-toggle-sub="cs2027Sub" aria-expanded="true">
        IB Computer Science 2027
        <span class="sb-chevron up">&#9650;</span>
    </button>

    <div class="sb-sub" id="cs2027Sub">
        <?php foreach ($_allCats as $_c): ?>
        <a class="sb-link sb-indent <?= $_c['slug'] === $_active ? 'active' : '' ?>"
           href="<?= base_url('blog/category/' . $_c['slug']) ?>">
            <?= esc($_c['nav_label']) ?>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="sb-divider"></div>

    <a class="sb-link <?= service('uri')->getPath() === 'blog' ? 'active' : '' ?>"
       href="<?= base_url('blog') ?>">All Topics</a>

    <a class="sb-link <?= service('uri')->getPath() === 'about' ? 'active' : '' ?>"
       href="<?= base_url('about') ?>">About</a>

    <div class="sb-divider"></div>

    <!-- Forum section -->
    <a class="sb-section-link <?= str_starts_with(service('uri')->getPath(), 'forum') ? '' : '' ?>"
       href="<?= base_url('forum') ?>">Forum</a>

    <?php
    $_forumCatModel = new \App\Models\ForumCategoryModel();
    $_forumCats     = $_forumCatModel->orderBy('sort_order', 'ASC')->findAll();
    $_forumPath     = service('uri')->getPath();
    foreach ($_forumCats as $_fc):
        $_fcActive = $_forumPath === 'forum/' . $_fc['slug'];
    ?>
    <a class="sb-link sb-indent <?= $_fcActive ? 'active' : '' ?>"
       href="<?= base_url('forum/' . $_fc['slug']) ?>">
        <?= esc($_fc['name']) ?>
    </a>
    <?php endforeach; ?>

</nav>
