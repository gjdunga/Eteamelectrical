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

// Grab a hero image from FHRBAP if available
$hero_img = '';
$hero_dir = __DIR__ . '/photos/FHRBAP';
if (is_dir($hero_dir)) {
    $imgs = glob($hero_dir . '/*.{jpg,jpeg,png}', GLOB_BRACE);
    if (!empty($imgs)) $hero_img = 'photos/FHRBAP/' . basename($imgs[array_rand($imgs)]);
}
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-grid" aria-hidden="true"></div>
    <?php if ($hero_img): ?>
    <div class="hero-photo"><img src="<?php echo htmlspecialchars($hero_img); ?>" alt="E Team project photo"></div>
    <?php endif; ?>
    <div class="container hero-inner">
        <div class="hero-overline reveal">Journeyman Electrician &bull; General Contractor</div>
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
        <p class="section-desc reveal reveal-delay-2">One crew, every trade. No juggling subcontractors or finger-pointing between teams.</p>

        <div class="services-grid">
            <div class="service-card reveal">
                <div class="service-num">01</div>
                <div class="service-bar"></div>
                <h3>Electrical</h3>
                <p>Panel upgrades, new circuits, rewires, lighting installs, troubleshooting, and code corrections. Journeyman electrician on every job.</p>
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
                <div class="stat-label">Licensed &amp; Insured</div>
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

        <div class="tiles reveal reveal-delay-3">
            <?php
            $photo_dirs = ['FHRBAP','UTA','IPLCCI','IPPM','HTICLD','SIMHWHF','AE','CIMSP','CLFSRP','OGDROR','TSRNL','FYSIL','OFSI'];
            $preview_count = 0;
            $max_preview = 6;
            foreach ($photo_dirs as $dir) {
                $path = __DIR__ . '/photos/' . $dir;
                if (!is_dir($path)) continue;
                $files = array_diff(scandir($path), ['.','..', '.notafile', '.NotaFile', '(1).NotaFile']);
                foreach ($files as $file) {
                    if ($preview_count >= $max_preview) break 2;
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) continue;
                    ?>
                    <a class="tile" href="gallery.php">
                        <img class="tile-media-img" src="photos/<?php echo htmlspecialchars("$dir/$file"); ?>" alt="Project photo" loading="lazy">
                    </a>
                    <?php
                    $preview_count++;
                }
            }
            ?>
        </div>
    </div>
</section>

<!-- CTA BAND -->
<section class="cta-band">
    <div class="container cta-inner">
        <div class="cta-text">Ready to start your project?</div>
        <a class="btn btn-inv" href="#contact">Get a Free Estimate</a>
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
                    <div class="contact-value">Free, no obligation</div>
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

<?php include 'includes/footer.php'; ?>
