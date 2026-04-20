<footer class="footer bg-dark text-white mt-5 pt-5 pb-4">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">
                    <i class="bi bi-braces-asterisk text-warning me-2"></i>ComputerScienceKB
                </h5>
                <p class="text-muted small">
                    A knowledge base for IB Computer Science students and teachers. 
                    Covering all themes from the 2027 curriculum.
                </p>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="text-uppercase text-muted small fw-bold mb-3">Theme A</h6>
                <ul class="list-unstyled small">
                    <li><a href="<?= base_url('blog/category/computer-fundamentals') ?>" class="text-muted text-decoration-none link-footer">Computer Fundamentals</a></li>
                    <li><a href="<?= base_url('blog/category/networking') ?>" class="text-muted text-decoration-none link-footer">Networking</a></li>
                    <li><a href="<?= base_url('blog/category/databases') ?>" class="text-muted text-decoration-none link-footer">Databases</a></li>
                    <li><a href="<?= base_url('blog/category/machine-learning') ?>" class="text-muted text-decoration-none link-footer">Machine Learning</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="text-uppercase text-muted small fw-bold mb-3">Theme B</h6>
                <ul class="list-unstyled small">
                    <li><a href="<?= base_url('blog/category/programming') ?>" class="text-muted text-decoration-none link-footer">Programming</a></li>
                    <li><a href="<?= base_url('blog/category/oop') ?>" class="text-muted text-decoration-none link-footer">OOP</a></li>
                    <li><a href="<?= base_url('blog/category/abstract-data-types') ?>" class="text-muted text-decoration-none link-footer">Abstract Data Types</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="text-uppercase text-muted small fw-bold mb-3">Stay Updated</h6>
                <p class="text-muted small">Get notified when new articles are published.</p>
                <div class="input-group input-group-sm">
                    <input type="email" class="form-control bg-secondary border-0 text-white" placeholder="your@email.com">
                    <button class="btn btn-warning fw-semibold" type="button">Subscribe</button>
                </div>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <p class="text-muted small mb-0">&copy; <?= date('Y') ?> ComputerScienceKB. Built for IB CS students.</p>
            <p class="text-muted small mb-0">Built with CodeIgniter 4 &amp; Bootstrap 5</p>
        </div>
    </div>
</footer>
