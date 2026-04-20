<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero -->
<section class="hero-section py-5">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-warning text-dark fw-semibold mb-3 px-3 py-2">IB Computer Science 2027</span>
                <h1 class="display-4 fw-bold lh-sm mb-3">
                    Your CS<br>Knowledge Base
                </h1>
                <p class="lead text-muted mb-4">
                    Structured learning resources for all IB Computer Science themes — from CPU architecture 
                    to machine learning. SL &amp; HL covered.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?= base_url('blog') ?>" class="btn btn-dark btn-lg px-4 fw-semibold">
                        Browse All Topics <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    <a href="<?= base_url('blog/category/internal-assessment') ?>" class="btn btn-outline-dark btn-lg px-4">
                        IA Resources
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <div class="hero-graphic">
                    <i class="bi bi-cpu hero-icon"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Themes Sidebar-style Topic List (like the screenshot) -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">

            <!-- Left Sidebar: Topics -->
            <div class="col-lg-3 mb-4">
                <div class="sidebar-card card border-0 shadow-sm rounded-3 sticky-top" style="top:80px;">
                    <div class="card-body p-0">
                        <div class="sidebar-header px-3 py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold small text-uppercase text-muted tracking-wide">Explore Topics</span>
                                <div class="d-flex gap-2">
                                    <a href="#" class="small text-muted text-decoration-none show-all-link">Show All</a>
                                    <span class="text-muted">|</span>
                                    <a href="#" class="small text-muted text-decoration-none">Close All</a>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-section-label px-3 py-2 bg-light border-bottom">
                            <span class="small fw-bold text-dark">Theme A: Concepts of computer science</span>
                        </div>
                        <div class="accordion accordion-flush" id="themeA">
                            <?php 
                            $themeA = [
                                ['A1','Computer Fundamentals','cpu','computer-fundamentals'],
                                ['A2','Networking','diagram-3','networking'],
                                ['A3','Databases','database','databases'],
                                ['A4','Machine Learning','robot','machine-learning'],
                            ];
                            foreach($themeA as $t): ?>
                            <div class="accordion-item border-0 border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 px-3 small" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $t[0] ?>">
                                        <i class="bi bi-<?= $t[2] ?> me-2 text-muted"></i>
                                        <span class="fw-medium"><?= $t[0] ?>: <?= $t[1] ?></span>
                                    </button>
                                </h2>
                                <div id="<?= $t[0] ?>" class="accordion-collapse collapse">
                                    <div class="accordion-body py-2 px-3 bg-light">
                                        <a href="<?= base_url('blog/category/'.$t[3]) ?>" class="d-block small text-primary text-decoration-none py-1">View all <?= $t[1] ?> posts →</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="sidebar-section-label px-3 py-2 bg-light border-bottom border-top mt-1">
                            <span class="small fw-bold text-dark">Theme B: Computational thinking</span>
                        </div>
                        <div class="accordion accordion-flush" id="themeB">
                            <?php 
                            $themeB = [
                                ['B1','Approaches to Computational Thinking','lightbulb','computational-thinking'],
                                ['B2','Programming','code-slash','programming'],
                                ['B3','OOP','boxes','oop'],
                                ['B4','Abstract Data Types','stack','abstract-data-types'],
                            ];
                            foreach($themeB as $t): ?>
                            <div class="accordion-item border-0 border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 px-3 small" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $t[0] ?>">
                                        <i class="bi bi-<?= $t[2] ?> me-2 text-muted"></i>
                                        <span class="fw-medium"><?= $t[0] ?>: <?= $t[1] ?></span>
                                    </button>
                                </h2>
                                <div id="<?= $t[0] ?>" class="accordion-collapse collapse">
                                    <div class="accordion-body py-2 px-3 bg-light">
                                        <a href="<?= base_url('blog/category/'.$t[3]) ?>" class="d-block small text-primary text-decoration-none py-1">View all <?= $t[1] ?> posts →</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="sidebar-section-label px-3 py-2 bg-light border-bottom border-top mt-1">
                            <span class="small fw-bold text-dark">Case Study, IA, Resources</span>
                        </div>
                        <div class="accordion accordion-flush" id="caseStudy">
                            <?php 
                            $extra = [
                                ['C1','Case Study','folder','case-study'],
                                ['C2','Internal Assessment (IA)','journal-bookmark','internal-assessment'],
                            ];
                            foreach($extra as $t): ?>
                            <div class="accordion-item border-0 border-bottom">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed py-2 px-3 small" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $t[0] ?>">
                                        <i class="bi bi-<?= $t[2] ?> me-2 text-muted"></i>
                                        <span class="fw-medium"><?= $t[1] ?></span>
                                    </button>
                                </h2>
                                <div id="<?= $t[0] ?>" class="accordion-collapse collapse">
                                    <div class="accordion-body py-2 px-3 bg-light">
                                        <a href="<?= base_url('blog/category/'.$t[3]) ?>" class="d-block small text-primary text-decoration-none py-1">View resources →</a>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-lg-9">
                <!-- Category Header -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h2 class="h3 fw-bold mb-1"><?= $active_category ?? 'Computer Fundamentals' ?></h2>
                        <p class="text-muted small mb-0">
                            All knowledge base resources related to <strong><?= $active_category ?? 'Computer Fundamentals' ?></strong>.
                        </p>
                    </div>
                </div>

                <!-- Category Description Box -->
                <div class="alert alert-info border-0 rounded-3 mb-4" style="background:#e8f4fd;">
                    <p class="mb-0 small">
                        <?= $category_description ?? 'This category provides a foundation in the essential components and operation of computer systems. Topics include hardware architecture, the function of the CPU, GPU, machine instruction cycles, and memory types. Students will also examine system software, including operating systems.' ?>
                    </p>
                </div>

                <!-- Learning Objectives List -->
                <div class="objectives-list">
                    <?php
                    $objectives = $objectives ?? [
                        ['code'=>'A1.1.1','title'=>'Describe the functions and interactions of the main CPU components.','hl'=>false,'slug'=>'a1-1-1-describe-the-functions-and-interactions-of-the-main-cpu-components'],
                        ['code'=>'A1.1.2','title'=>'Describe the role of a GPU.','hl'=>false,'slug'=>'a1-1-2-describe-the-role-of-a-gpu'],
                        ['code'=>'A1.1.3','title'=>'Explain the differences between the CPU and the GPU.','hl'=>true,'slug'=>'a1-1-3-explain-the-differences-between-the-cpu-and-the-gpu'],
                        ['code'=>'A1.1.4','title'=>'Explain the purposes of different types of primary memory.','hl'=>false,'slug'=>'a1-1-4-explain-the-purposes-of-different-types-of-primary-memory'],
                        ['code'=>'A1.1.5','title'=>'Describe the fetch, decode and execute cycle.','hl'=>false,'slug'=>'a1-1-5-describe-the-fetch-decode-and-execute-cycle'],
                        ['code'=>'A1.1.6','title'=>'Describe the process of pipelining in multi-core architectures.','hl'=>true,'slug'=>'a1-1-6-describe-the-process-of-pipelining-in-multi-core-architectures'],
                        ['code'=>'A1.1.7','title'=>'Describe internal and external types of secondary memory storage.','hl'=>false,'slug'=>'a1-1-7-describe-internal-and-external-types-of-secondary-memory-storage'],
                        ['code'=>'A1.1.8','title'=>'Describe the concept of compression.','hl'=>false,'slug'=>'a1-1-8-describe-the-concept-of-compression'],
                        ['code'=>'A1.1.9','title'=>'Describe the different types of services in cloud computing.','hl'=>false,'slug'=>'a1-1-9-describe-the-different-types-of-services-in-cloud-computing'],
                        ['code'=>'A1.2.1','title'=>'Describe the principal methods of representing data.','hl'=>false,'slug'=>'a1-2-1-describe-the-principal-methods-of-representing-data'],
                        ['code'=>'A1.2.2','title'=>'Explain how binary is used to store data.','hl'=>false,'slug'=>'a1-2-2-explain-how-binary-is-used-to-store-data'],
                        ['code'=>'A1.2.3','title'=>'Describe the purpose and use of logic gates.','hl'=>false,'slug'=>'a1-2-3-describe-the-purpose-and-use-of-logic-gates'],
                    ];
                    foreach($objectives as $obj): ?>
                    <a href="<?= base_url('blog/post/'.$obj['slug']) ?>"
                       class="objective-row <?= $obj['hl'] ? 'hl-row' : '' ?>">
                        <span class="obj-code"><?= esc($obj['code']) ?></span>
                        <span class="obj-text"><?= esc($obj['title']) ?></span>
                        <?php if($obj['hl']): ?>
                        <span class="badge bg-warning text-dark ms-2 small fw-semibold">HL</span>
                        <?php endif; ?>
                        <i class="bi bi-chevron-right ms-auto text-muted obj-arrow"></i>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
