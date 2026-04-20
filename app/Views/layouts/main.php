<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($seo_title ?? $title ?? 'CS Knowledge Base') ?></title>
    <?php if(!empty($seo_description)): ?>
    <meta name="description" content="<?= esc($seo_description) ?>">
    <?php endif; ?>
    <?php if(!empty($seo_keywords)): ?>
    <meta name="keywords" content="<?= esc($seo_keywords) ?>">
    <?php endif; ?>
    <!-- Open Graph -->
    <meta property="og:title" content="<?= esc($seo_title ?? $title ?? 'CS Knowledge Base') ?>">
    <?php if(!empty($seo_description)): ?>
    <meta property="og:description" content="<?= esc($seo_description) ?>">
    <?php endif; ?>
    <meta property="og:type" content="article">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

<?= $this->include('partials/navbar') ?>

<?= $this->renderSection('content') ?>

<?= $this->include('partials/footer') ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
