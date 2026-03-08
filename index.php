<?php
require_once __DIR__ . '/includes/mail.php';

$form_submitted = false;
$form_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eteam_contact'])) {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');
    $hp      = trim($_POST['website'] ?? '');

    if (!empty($hp)) {
        $form_error = 'Something went wrong. Please try again.';
    } elseif (empty($name) || empty($email) || empty($message)) {
        $form_error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $form_error = 'Please enter a valid email address.';
    } else {
        $body = "<h2>New Quote Request</h2>";
        $body .= "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
        $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        $body .= "<p><strong>Phone:</strong> " . htmlspecialchars($phone ?: 'Not provided') . "</p>";
        $body .= "<p><strong>Service:</strong> " . htmlspecialchars($service ?: 'Not specified') . "</p>";
        $body .= "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>";

        $result = eteam_send_mail("Quote Request: " . $name, $body, $email, $name);
        if ($result['success']) {
            $form_submitted = true;
        } else {
            $form_error = 'Could not send your message. Please call or email us directly.';
        }
    }
}

include 'includes/header.php';

// Collect hero slideshow images from all folders
$hero_images = [];
$hero_dirs = ['FHRBAP','UTA','HTICLD','SIMHWHF','IPLCCI','IPPM','AE','OGDROR','CLFSRP','TSRNL','CIMSP','FYSIL','OFSI'];
foreach ($hero_dirs as $hd) {
    $hdir = __DIR__ . '/photos/' . $hd;
    if (!is_dir($hdir)) continue;
    $himgs = glob($hdir . '/*.{jpg,jpeg,png}', GLOB_BRACE);
    foreach ($himgs as $hi) {
        $hero_images[] = 'photos/' . $hd . '/' . basename($hi);
    }
}
shuffle($hero_images);
$hero_images = array_slice($hero_images, 0, 20); // cap at 20 for performance
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-grid" aria-hidden="true"></div>
    <?php if (!empty($hero_images)): ?>
    <div class="hero-photo">
        <?php foreach ($hero_images as $hi => $hsrc): ?>
        <img class="hero-slide<?php echo $hi === 0 ? ' active' : ''; ?>"
             src="<?php echo htmlspecialchars($hsrc); ?>"
             alt="E Team project photo"
             loading="<?php echo $hi < 2 ? 'eager' : 'lazy'; ?>">
        <?php endforeach; ?>
        <div class="hero-slide-controls">
            <button class="hero-slide-btn" id="hero-prev" aria-label="Previous">&#8249;</button>
            <span class="hero-slide-counter"><span id="hero-cur">1</span> / <?php echo count($hero_images); ?></span>
            <button class="hero-slide-btn" id="hero-next" aria-label="Next">&#8250;</button>
            <button class="hero-slide-btn" id="hero-pause" aria-label="Pause">&#10074;&#10074;</button>
        </div>
    </div>
    <?php endif; ?>
    <div class="container hero-inner">
        <div class="hero-overline reveal">Master Electrician &bull; General Contractor</div>
        <h1 class="hero-title reveal reveal-delay-1">Built Right.<br><span class="stroke">Every Time.</span></h1>
        <p class="hero-lede reveal reveal-delay-2">Multi-trade contracting crew serving all of Colorado. Electrical, construction, concrete, demolition, plumbing, and handyman work, all under one call.</p>
        <div class="hero-actions reveal reveal-delay-3">
            <a class="btn btn-fill" href="#contact">Get a Quote</a>
            <a class="btn btn-inv" href="gallery.php">See Our Work</a>
        </div>
    </div>
    <div class="hero-ticker" aria-hidden="true">
        <div class="ticker-track">
            <span>Electrical &bull; Panel Upgrades &bull; Rewiring &bull; Construction &bull; Framing &bull; Concrete &bull; Foundations &bull; Demolition &bull; Handyman &bull; Plumbing &bull; Remodels &bull; Retaining Walls &bull; Driveways &bull; Code Corrections &bull; Serving All of Colorado &bull;&nbsp;</span>
            <span>Electrical &bull; Panel Upgrades &bull; Rewiring &bull; Construction &bull; Framing &bull; Concrete &bull; Foundations &bull; Demolition &bull; Handyman &bull; Plumbing &bull; Remodels &bull; Retaining Walls &bull; Driveways &bull; Code Corrections &bull; Serving All of Colorado &bull;&nbsp;</span>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="section section-slab">
    <div class="container">
        <div class="section-label reveal">What We Do</div>
        <h2 class="section-title reveal reveal-delay-1">Our Services</h2>
        <p class="section-desc reveal reveal-delay-2">One crew, every trade. No juggling subcontractors.</p>

        <div class="services-grid">
            <div class="service-card reveal">
                <div class="service-num">01</div>
                <div class="service-bar"></div>
                <h3>Electrical</h3>
                <p>Panel upgrades, new circuits, rewires, lighting installs, troubleshooting, and code corrections. Master electrician on every job.</p>
            </div>
            <div class="service-card reveal reveal-delay-1">
                <div class="service-num">02</div>
                <div class="service-bar"></div>
                <h3>General Construction</h3>
                <p>New builds, additions, framing, structural repairs, and full project management from permits through punch list.</p>
            </div>
            <div class="service-card reveal reveal-delay-2">
                <div class="service-num">03</div>
                <div class="service-bar"></div>
                <h3>Handyman</h3>
                <p>Small jobs, odd fixes, mounting, patching, door and window installs, drywall. No job too small.</p>
            </div>
            <div class="service-card reveal reveal-delay-3">
                <div class="service-num">04</div>
                <div class="service-bar"></div>
                <h3>Concrete</h3>
                <p>Foundations, slabs, sidewalks, driveways, retaining walls. Graded for drainage, finished clean.</p>
            </div>
            <div class="service-card reveal reveal-delay-4">
                <div class="service-num">05</div>
                <div class="service-bar"></div>
                <h3>Demolition &amp; Dirt Work</h3>
                <p>Controlled teardowns, interior gut jobs, site clearing, grading, trenching, and backfill.</p>
            </div>
            <div class="service-card reveal reveal-delay-5">
                <div class="service-num">06</div>
                <div class="service-bar"></div>
                <h3>Plumbing</h3>
                <p>Fixture installs, pipe repair, water heaters, drain work, rough-in for new construction and remodels.</p>
            </div>
        </div>
    </div>
</section>

<!-- STATS -->
<section class="section-dark">
    <div class="container">
        <div class="stats-strip reveal">
            <div class="stat">
                <div class="stat-num">8+</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat">
                <div class="stat-num">450+</div>
                <div class="stat-label">Jobs Completed</div>
            </div>
            <div class="stat">
                <div class="stat-num">CO</div>
                <div class="stat-label">Statewide Service</div>
            </div>
            <div class="stat">
                <div class="stat-num">100%</div>
                <div class="stat-label">Licensed</div>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY PREVIEW -->
<section class="section">
    <div class="container">
        <div class="section-label reveal">Portfolio</div>
        <h2 class="section-title reveal reveal-delay-1">Recent Work</h2>
        <p class="section-desc reveal reveal-delay-2">A sample of recent projects. <a href="gallery.php" style="color:var(--orange);text-decoration:underline;font-weight:700">View the full gallery &rarr;</a></p>

        <?php
        $photo_dirs = ['FHRBAP','UTA','IPLCCI','IPPM','HTICLD','SIMHWHF','AE','CIMSP','CLFSRP','OGDROR','TSRNL','FYSIL','OFSI'];
        $all_preview = [];
        foreach ($photo_dirs as $dir) {
            $path = __DIR__ . '/photos/' . $dir;
            if (!is_dir($path)) continue;
            $files = array_diff(scandir($path), ['.','..', '.notafile', '.NotaFile', '(1).NotaFile']);
            foreach ($files as $file) {
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) continue;
                $all_preview[] = "photos/{$dir}/{$file}";
            }
        }
        $per_page = 6;
        $total_pages = max(1, ceil(count($all_preview) / $per_page));
        ?>

        <div class="tiles reveal reveal-delay-3" id="preview-grid">
            <?php for ($i = 0; $i < min($per_page, count($all_preview)); $i++): ?>
            <a class="tile" href="gallery.php">
                <img class="tile-media-img" src="<?php echo htmlspecialchars($all_preview[$i]); ?>" alt="Project photo" loading="lazy">
            </a>
            <?php endfor; ?>
        </div>

        <?php if (count($all_preview) > $per_page): ?>
        <div class="preview-pager" id="preview-pager">
            <button class="pager-btn" id="pager-prev" aria-label="Previous page" disabled>&#8249; Prev</button>
            <span class="pager-counter"><span id="pager-current">1</span> / <?php echo $total_pages; ?></span>
            <button class="pager-btn" id="pager-next" aria-label="Next page">Next &#8250;</button>
        </div>

        <script>
        (function() {
            var photos = <?php echo json_encode($all_preview); ?>;
            var perPage = <?php echo $per_page; ?>;
            var page = 0;
            var totalPages = Math.ceil(photos.length / perPage);
            var grid = document.getElementById('preview-grid');
            var counter = document.getElementById('pager-current');
            var btnPrev = document.getElementById('pager-prev');
            var btnNext = document.getElementById('pager-next');

            function render() {
                var start = page * perPage;
                var slice = photos.slice(start, start + perPage);
                var html = '';
                for (var i = 0; i < slice.length; i++) {
                    html += '<a class="tile" href="gallery.php">' +
                        '<img class="tile-media-img" src="' + slice[i] + '" alt="Project photo" loading="lazy">' +
                        '</a>';
                }
                grid.innerHTML = html;
                counter.textContent = page + 1;
                btnPrev.disabled = page === 0;
                btnNext.disabled = page >= totalPages - 1;
                grid.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }

            btnPrev.addEventListener('click', function() { if (page > 0) { page--; render(); } });
            btnNext.addEventListener('click', function() { if (page < totalPages - 1) { page++; render(); } });
        })();
        </script>
        <?php endif; ?>
    </div>
</section>

<!-- CTA BAND -->
<section class="cta-band">
    <div class="container cta-inner">
        <div class="cta-text">Ready to start your project?</div>
        <a class="btn btn-inv" href="#contact">Get an Estimate</a>
    </div>
</section>

<!-- CONTACT -->
<section class="section" id="contact">
    <div class="container">
        <div class="section-label reveal">Get In Touch</div>
        <h2 class="section-title reveal reveal-delay-1">Request a Quote</h2>

        <div class="contact-split reveal reveal-delay-2">
            <div class="contact-info-panel">
                <div class="contact-detail">
                    <div class="contact-label">Email</div>
                    <div class="contact-value"><a href="mailto:Djstatzz@gmail.com">Djstatzz@gmail.com</a></div>
                </div>
                <div class="contact-detail">
                    <div class="contact-label">Service Area</div>
                    <div class="contact-value">Statewide Colorado</div>
                </div>
                <div class="contact-detail">
                    <div class="contact-label">Response Time</div>
                    <div class="contact-value">Usually within 24 hours</div>
                </div>
                <div class="contact-detail">
                    <div class="contact-label">Estimates</div>
                    <div class="contact-value">Available upon appointment</div>
                </div>
            </div>
            <div class="contact-form-panel">
                <?php if ($form_submitted): ?>
                    <div class="notice notice-ok">Thanks, <?php echo htmlspecialchars($name); ?>! We got your message and will be in touch soon.</div>
                <?php else: ?>
                    <?php if ($form_error): ?>
                        <div class="notice notice-err"><?php echo htmlspecialchars($form_error); ?></div>
                    <?php endif; ?>

                    <form method="post" action="index.php#contact">
                        <input type="hidden" name="eteam_contact" value="1">
                        <div class="hp"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

                        <div class="form-grid">
                            <div>
                                <label class="form-label">Name <span class="form-req">*</span></label>
                                <input class="form-input" type="text" name="name" placeholder="Your name" required>
                            </div>
                            <div>
                                <label class="form-label">Email <span class="form-req">*</span></label>
                                <input class="form-input" type="email" name="email" placeholder="you@email.com" required>
                            </div>
                        </div>
                        <div class="form-grid">
                            <div>
                                <label class="form-label">Phone</label>
                                <input class="form-input" type="tel" name="phone" placeholder="(555) 555-5555">
                            </div>
                            <div>
                                <label class="form-label">Service Needed</label>
                                <select class="form-select" name="service">
                                    <option value="">Select a service</option>
                                    <option>Electrical</option>
                                    <option>General Construction</option>
                                    <option>Handyman</option>
                                    <option>Concrete</option>
                                    <option>Demolition / Dirt Work</option>
                                    <option>Plumbing</option>
                                    <option>Full Remodel</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <label class="form-label">Tell Us About the Job <span class="form-req">*</span></label>
                        <textarea class="form-textarea" name="message" placeholder="Describe the project, location, and any details..." required></textarea>
                        <div style="margin-top:20px">
                            <button type="submit" class="btn btn-fill">Send Message</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($hero_images) && count($hero_images) > 1): ?>
<script>
(function() {
    var slides = document.querySelectorAll('.hero-slide');
    var counter = document.getElementById('hero-cur');
    var total = slides.length, cur = 0, paused = false, timer = null;

    function go(i) {
        if (i < 0) i = total - 1;
        if (i >= total) i = 0;
        slides[cur].classList.remove('active');
        cur = i;
        slides[cur].classList.add('active');
        if (counter) counter.textContent = cur + 1;
    }
    function start() { stop(); timer = setInterval(function() { go(cur + 1); }, 4000); }
    function stop() { if (timer) clearInterval(timer); timer = null; }

    var bp = document.getElementById('hero-prev');
    var bn = document.getElementById('hero-next');
    var bx = document.getElementById('hero-pause');

    if (bp) bp.addEventListener('click', function() { go(cur - 1); if (!paused) start(); });
    if (bn) bn.addEventListener('click', function() { go(cur + 1); if (!paused) start(); });
    if (bx) bx.addEventListener('click', function() {
        paused = !paused;
        bx.innerHTML = paused ? '&#9654;' : '&#10074;&#10074;';
        if (paused) stop(); else start();
    });
    start();
})();
</script>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
