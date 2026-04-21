<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<nav class="breadcrumb"><a href="<?= base_url('/') ?>">Home</a><span class="sep">/</span><a href="<?= base_url('forum') ?>">Forum</a><span class="sep">/</span><span>Sign In</span></nav>

<h1 class="page-title">Google Sign-In Not Configured</h1>

<div class="box-note">
    <div class="box-label">Setup Required</div>
    <p>Google OAuth credentials have not been added to the <code>.env</code> file yet. Follow the steps below to enable Google sign-in.</p>
</div>

<h2 style="font-size:1.05rem;font-weight:700;margin:1.25rem 0 .5rem;">Steps to configure Google OAuth</h2>
<ol style="padding-left:1.4rem;line-height:2;font-size:.93rem;color:#374151;">
    <li>Go to <a href="https://console.cloud.google.com/" target="_blank">Google Cloud Console</a> and create a project.</li>
    <li>Navigate to <strong>APIs &amp; Services → Credentials</strong> and click <strong>Create Credentials → OAuth 2.0 Client ID</strong>.</li>
    <li>Set application type to <strong>Web application</strong>.</li>
    <li>Add an <strong>Authorised redirect URI</strong>:<br>
        <code style="background:#f1f3f5;padding:2px 7px;border-radius:3px;"><?= base_url('auth/google/callback') ?></code></li>
    <li>Copy the <strong>Client ID</strong> and <strong>Client Secret</strong>.</li>
    <li>Open (or create) the <code>.env</code> file in the project root and add:<br>
        <pre style="background:#1e1e2e;color:#cdd6f4;padding:.75rem 1rem;border-radius:6px;font-size:.84rem;margin:.5rem 0;">GOOGLE_CLIENT_ID     = your-client-id-here
GOOGLE_CLIENT_SECRET = your-client-secret-here</pre></li>
    <li>Restart the server — the Sign In button will work immediately.</li>
</ol>

<?= $this->endSection() ?>
