<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
            <span class="brand-icon"><i class="bi bi-braces-asterisk"></i></span>
            <span>ComputerScience<span class="text-warning">KB</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link <?= uri_string() === '' ? 'active' : '' ?>" href="<?= base_url('/') ?>">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Themes</a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><span class="dropdown-header">Theme A</span></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/computer-fundamentals') ?>"><i class="bi bi-cpu me-2 text-warning"></i>Computer Fundamentals</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/networking') ?>"><i class="bi bi-diagram-3 me-2 text-info"></i>Networking</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/databases') ?>"><i class="bi bi-database me-2 text-success"></i>Databases</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/machine-learning') ?>"><i class="bi bi-robot me-2 text-danger"></i>Machine Learning</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><span class="dropdown-header">Theme B</span></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/computational-thinking') ?>"><i class="bi bi-lightbulb me-2 text-warning"></i>Computational Thinking</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/programming') ?>"><i class="bi bi-code-slash me-2 text-primary"></i>Programming</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/oop') ?>"><i class="bi bi-boxes me-2 text-info"></i>OOP</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('blog/category/abstract-data-types') ?>"><i class="bi bi-stack me-2 text-success"></i>Abstract Data Types</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('blog') ?>">All Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('about') ?>">About</a>
                </li>
                <li class="nav-item ms-lg-2">
                    <a class="btn btn-warning btn-sm px-3 fw-semibold" href="<?= base_url('blog/category/internal-assessment') ?>">
                        <i class="bi bi-journal-bookmark me-1"></i>IA Resources
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
