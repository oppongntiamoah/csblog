<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="<?= base_url('/') ?>">Home</a>
    <span class="sep">/</span>
    <span>About</span>
</nav>

<h1 class="page-title">About CS Knowledge Base</h1>

<div class="box-info">
    A free, curriculum-aligned resource for IB Computer Science students and teachers, covering the 2027 syllabus.
</div>

<p style="margin-bottom:1rem; color:#374151;">CS Knowledge Base provides structured learning objectives for the IB Computer Science 2027 curriculum. Each objective is written to match the syllabus exactly, with explanations, examples, and links to related topics.</p>

<h2 style="font-size:1.1rem; font-weight:700; margin:1.5rem 0 .5rem;">Coverage</h2>

<ul class="topics-list">
    <li><a href="<?= base_url('blog/category/computer-fundamentals') ?>">A1 Computer Fundamentals</a> — CPU, memory, storage, compression, cloud</li>
    <li><a href="<?= base_url('blog/category/networking') ?>">A2 Networking</a> — protocols, architecture, security</li>
    <li><a href="<?= base_url('blog/category/databases') ?>">A3 Databases</a> — relational models, SQL, data modelling</li>
    <li><a href="<?= base_url('blog/category/machine-learning') ?>">A4 Machine Learning</a> — algorithms and applications</li>
    <li><a href="<?= base_url('blog/category/computational-thinking') ?>">B1 Computational Thinking</a> — decomposition, abstraction, algorithms</li>
    <li><a href="<?= base_url('blog/category/programming') ?>">B2 Programming</a> — constructs, pseudocode, logic</li>
    <li><a href="<?= base_url('blog/category/oop') ?>">B3 Object-Oriented Programming</a> — classes, inheritance, polymorphism</li>
    <li><a href="<?= base_url('blog/category/abstract-data-types') ?>">B4 Abstract Data Types</a> — stacks, queues, trees, graphs</li>
</ul>

<h2 style="font-size:1.1rem; font-weight:700; margin:1.5rem 0 .5rem;">HL and SL content</h2>

<p style="color:#374151;">All Standard Level content is covered. Higher Level-only objectives are clearly marked with an <span class="hl-tag">HL</span> label.</p>

<?= $this->endSection() ?>
