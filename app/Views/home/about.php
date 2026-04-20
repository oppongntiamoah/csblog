<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="fw-bold mb-2">About CS Knowledge Base</h1>
            <p class="text-muted mb-5">A free resource for IB Computer Science students and teachers.</p>

            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-info-circle text-primary me-2"></i>What is this?</h5>
                    <p class="mb-0">CS Knowledge Base is a structured, curriculum-aligned resource covering all learning objectives for the IB Computer Science 2027 syllabus. It covers both Standard Level (SL) and Higher Level (HL) content across Theme A (Concepts of Computer Science) and Theme B (Computational Thinking).</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-people text-success me-2"></i>Who is it for?</h5>
                    <ul class="mb-0">
                        <li class="mb-2">IB Computer Science students preparing for exams</li>
                        <li class="mb-2">Teachers looking for curriculum-aligned reference material</li>
                        <li>Anyone interested in structured computer science learning</li>
                    </ul>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3"><i class="bi bi-book text-warning me-2"></i>Curriculum Coverage</h5>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <div class="fw-semibold small text-uppercase text-muted mb-2">Theme A</div>
                                <ul class="list-unstyled mb-0 small">
                                    <li>A1: Computer Fundamentals</li>
                                    <li>A2: Networking</li>
                                    <li>A3: Databases</li>
                                    <li>A4: Machine Learning</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-3">
                                <div class="fw-semibold small text-uppercase text-muted mb-2">Theme B</div>
                                <ul class="list-unstyled mb-0 small">
                                    <li>B1: Computational Thinking</li>
                                    <li>B2: Programming</li>
                                    <li>B3: Object-Oriented Programming</li>
                                    <li>B4: Abstract Data Types</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="<?= base_url('blog') ?>" class="btn btn-dark px-4 fw-semibold">
                    Browse All Topics <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
