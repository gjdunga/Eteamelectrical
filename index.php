<?php
require_once __DIR__ . '/includes/mail.php';

// Handle contact form
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
        $body = "<h2>New Quote Request from eteamelectrical.com</h2>";
        $body .= "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
        $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
        $body .= "<p><strong>Phone:</strong> " . htmlspecialchars($phone ?: 'Not provided') . "</p>";
        $body .= "<p><strong>Service:</strong> " . htmlspecialchars($service ?: 'Not specified') . "</p>";
        $body .= "<p><strong>Message:</strong><br>" . nl2br(htmlspecialchars($message)) . "</p>";
        $body .= "<hr><p style='color:#888;font-size:12px'>Sent from E Team Electrical website contact form</p>";

        $result = eteam_send_mail(
            "Quote Request: " . $name,
            $body,
            $email,
            $name
        );

        if ($result['success']) {
            $form_submitted = true;
        } else {
            $form_error = 'Could not send your message right now. Please call or email us directly.';
        }
    }
}

include 'includes/header.php';
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-bg" aria-hidden="true"></div>
    <div class="container hero-inner">
        <div class="hero-copy">
            <div class="hero-badge">Serving All of Colorado</div>
            <h1 class="hero-title">Built Right.<br><span class="highlight">Every Time.</span></h1>
            <p class="hero-lede">Journeyman electrician, general contractor, and skilled handyman. From panel upgrades to full remodels, one call gets the whole job done.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#contact">Get a Quote</a>
                <a class="btn btn-outline" href="gallery.php">See Our Work</a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="stat-card">
                <div class="stat-num">8+</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-card">
                <div class="stat-num">450+</div>
                <div class="stat-label">Jobs Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-num">CO</div>
                <div class="stat-label">Statewide</div>
            </div>
            <div class="stat-card">
                <div class="stat-num">100%</div>
                <div class="stat-label">Licensed &amp; Insured</div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header">
            <div class="section-label">What We Do</div>
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">Multi-trade capabilities under one crew. No juggling subcontractors, no finger-pointing between trades.</p>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">&#9889;</div>
                <h3>Electrical</h3>
                <p>Panel upgrades, new circuits, rewires, lighting, troubleshooting, and code corrections. Journeyman electrician on every job.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">&#9960;</div>
                <h3>General Construction</h3>
                <p>New builds, additions, framing, structural repairs, and full project management from permits to punch list.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">&#9874;</div>
                <h3>Handyman</h3>
                <p>Small jobs, odd fixes, mounting, patching, door and window installs, drywall, and everything in between. No job too small.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">&#9638;</div>
                <h3>Concrete</h3>
                <p>Foundations, slabs, sidewalks, driveways, retaining walls, and decorative pours. Graded for drainage, finished clean.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">&#9707;</div>
                <h3>Demolition &amp; Dirt Work</h3>
                <p>Controlled teardowns, interior gut jobs, site clearing, grading, trenching, and backfill with equipment on hand.</p>
            </div>
            <div class="service-card">
                <div class="service-icon">&#9883;</div>
                <h3>Plumbing</h3>
                <p>Fixture installs, pipe repair, water heaters, drain work, and rough-in for new construction and remodels.</p>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT / CREDENTIALS -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <div class="section-label">About</div>
            <h2 class="section-title">Why E Team</h2>
        </div>
        <div class="about-grid">
            <div class="about-copy">
                <p>E Team Electrical is a multi-trade contracting crew serving all of Colorado. We handle electrical, construction, concrete, demolition, plumbing, and handyman work, coordinated as one team so jobs move faster with fewer miscommunications.</p>
                <p>Every electrical job is led by a journeyman electrician. Every build is managed start to finish with clear estimates, photo documentation, and a clean site when we leave. We treat your property like our own.</p>
                <p>Whether it's a panel swap, a full home remodel, a concrete pour, or just a list of small fixes you've been putting off, one call gets it done.</p>
            </div>
            <div class="credential-list">
                <div class="credential">
                    <div class="credential-icon">&#9889;</div>
                    <div class="credential-text">Journeyman Electrician</div>
                </div>
                <div class="credential">
                    <div class="credential-icon">&#9874;</div>
                    <div class="credential-text">Licensed General Contractor</div>
                </div>
                <div class="credential">
                    <div class="credential-icon">&#128737;</div>
                    <div class="credential-text">Fully Insured</div>
                </div>
                <div class="credential">
                    <div class="credential-icon">&#127968;</div>
                    <div class="credential-text">Residential &amp; Light Commercial</div>
                </div>
                <div class="credential">
                    <div class="credential-icon">&#128247;</div>
                    <div class="credential-text">Photo-Documented Work</div>
                </div>
                <div class="credential">
                    <div class="credential-icon">&#127967;</div>
                    <div class="credential-text">Serving All of Colorado</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- GALLERY PREVIEW -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Portfolio</div>
            <h2 class="section-title">Recent Work</h2>
            <p class="section-subtitle">A sample of recent projects. <a href="gallery.php" class="accent" style="text-decoration:underline">View the full gallery &rarr;</a></p>
        </div>
        <div class="tiles">
            <?php
            $photo_dirs = ['FHRBAP', 'UTA', 'IPLCCI', 'IPPM', 'HTICLD', 'SIMHWHF', 'AE', 'CIMSP', 'CLFSRP', 'OGDROR', 'TSRNL', 'FYSIL', 'OFSI'];
            $preview_count = 0;
            $max_preview = 6;
            foreach ($photo_dirs as $dir) {
                $path = __DIR__ . '/photos/' . $dir;
                if (!is_dir($path)) continue;
                $files = array_diff(scandir($path), ['.', '..', '.notafile', '.NotaFile', '(1).NotaFile']);
                foreach ($files as $file) {
                    if ($preview_count >= $max_preview) break 2;
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (!in_array($ext, ['jpg','jpeg','png','gif','webp'])) continue;
                    $src = "photos/{$dir}/{$file}";
                    ?>
                    <a class="tile" href="gallery.php" style="background:var(--card)">
                        <img class="tile-media-img" src="<?php echo htmlspecialchars($src); ?>" alt="Project photo" loading="lazy">
                    </a>
                    <?php
                    $preview_count++;
                }
            }
            if ($preview_count === 0) {
                echo '<p class="muted">Photos coming soon.</p>';
            }
            ?>
        </div>
    </div>
</section>

<!-- CONTACT -->
<section class="section" id="contact">
    <div class="container">
        <div class="section-header">
            <div class="section-label">Get In Touch</div>
            <h2 class="section-title">Request a Quote</h2>
            <p class="section-subtitle">Tell us about your project. We will get back to you to schedule a walk-through and provide a clear estimate.</p>
        </div>

        <div class="contact-grid">
            <div>
                <?php if ($form_submitted): ?>
                    <div class="eteam-notice success">Thanks, <?php echo htmlspecialchars($name); ?>! We got your message and will be in touch soon.</div>
                <?php else: ?>
                    <?php if ($form_error): ?>
                        <div class="eteam-notice error"><?php echo htmlspecialchars($form_error); ?></div>
                    <?php endif; ?>

                    <form class="eteam-form" method="post" action="index.php#contact">
                        <input type="hidden" name="eteam_contact" value="1">
                        <div class="hp"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

                        <div class="grid-2">
                            <div>
                                <label>Name <span class="req">*</span></label>
                                <input type="text" name="name" placeholder="Your name" required>
                            </div>
                            <div>
                                <label>Email <span class="req">*</span></label>
                                <input type="email" name="email" placeholder="your@email.com" required>
                            </div>
                        </div>
                        <div class="grid-2">
                            <div>
                                <label>Phone</label>
                                <input type="tel" name="phone" placeholder="(555) 555-5555">
                            </div>
                            <div>
                                <label>Service Needed</label>
                                <select name="service">
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
                        <label>Tell Us About the Job <span class="req">*</span></label>
                        <textarea name="message" placeholder="Describe the project, location, and any details that would help us give you an accurate estimate..." required></textarea>
                        <div style="margin-top:18px">
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-item-icon">&#128205;</div>
                    <div>
                        <div class="contact-item-label">Service Area</div>
                        <div class="contact-item-value">Statewide Colorado</div>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">&#128231;</div>
                    <div>
                        <div class="contact-item-label">Email</div>
                        <div class="contact-item-value"><a href="mailto:Djstatzz@gmail.com">Djstatzz@gmail.com</a></div>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">&#128336;</div>
                    <div>
                        <div class="contact-item-label">Response Time</div>
                        <div class="contact-item-value">Usually within 24 hours</div>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-item-icon">&#128196;</div>
                    <div>
                        <div class="contact-item-label">Estimates</div>
                        <div class="contact-item-value">Free, no obligation</div>
                    </div>
                </div>

                <div class="cta-strip" style="margin-top:8px">
                    <div>
                        <h3>See our work first?</h3>
                        <p>Browse hundreds of project photos.</p>
                    </div>
                    <a class="btn btn-outline btn-sm" href="gallery.php">View Gallery</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
