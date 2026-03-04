<?php
$body_class = 'home';

// Trade definitions
$trades = [
    ['slug' => 'concrete',           'name' => 'Concrete',           'img' => 'concrete.png',
     'desc' => 'Foundations, slabs, sidewalks, and decorative concrete. Poured right, finished clean, built to code.'],
    ['slug' => 'construction',       'name' => 'Construction',       'img' => 'construction.png',
     'desc' => 'New builds, additions, framing, and structural work. Full scope residential and light commercial.'],
    ['slug' => 'demolition',         'name' => 'Demolition',         'img' => 'demolition.png',
     'desc' => 'Controlled teardowns, interior gut jobs, and site clearing. Safe, permitted, debris hauled.'],
    ['slug' => 'dirt-work',          'name' => 'Dirt Work',          'img' => 'dirt-work.png',
     'desc' => 'Grading, trenching, backfill, and site prep. Equipment on hand for jobs of all sizes.'],
    ['slug' => 'driveways',          'name' => 'Driveways',          'img' => 'driveways.png',
     'desc' => 'Concrete, gravel, and asphalt driveways. Graded for drainage, built for traffic.'],
    ['slug' => 'electrical',         'name' => 'Electrical',         'img' => 'electrical.png',
     'desc' => 'Panel upgrades, new circuits, lighting, troubleshooting, and full rewires. Licensed and insured.'],
    ['slug' => 'handyman',           'name' => 'Handyman',           'img' => 'handyman.png',
     'desc' => 'Small fixes, odd jobs, mounting, patching, and general repairs. No job too small.'],
    ['slug' => 'plumbing',           'name' => 'Plumbing',           'img' => 'plumbing.png',
     'desc' => 'Fixture installs, pipe repair, water heaters, and drain work. Residential and light commercial.'],
    ['slug' => 'project-management', 'name' => 'Project Management', 'img' => 'project-management.png',
     'desc' => 'Multi-trade coordination, scheduling, permitting, and owner communication. One point of contact.'],
    ['slug' => 'retaining-walls',    'name' => 'Retaining Walls',    'img' => 'retaining-wall.png',
     'desc' => 'Block, timber, and poured walls. Engineered for drainage and load, finished for curb appeal.'],
];

include 'includes/header.php';
?>

<section class="hero">
    <div class="hero-bg" aria-hidden="true"></div>
    <div class="container hero-inner">
        <div class="hero-copy">
            <div class="badge">Multi-Trade Remodel &amp; Construction Crew</div>
            <h1 class="hero-title">The crew you call when the job needs to be done right.</h1>
            <p class="hero-lede">Electrical, plumbing, concrete, dirt work, demolition, handyman work, and full project management, coordinated as one team.</p>
            <div class="hero-actions">
                <a class="btn btn-primary" href="#quote">Request a Quote</a>
                <a class="btn btn-ghost" href="gallery.php">See the Work</a>
            </div>
        </div>
        <div class="hero-panel">
            <div class="panel-title">Fast intake</div>
            <div class="panel-body">
                <ul class="checklist">
                    <li>Licensed &amp; insured</li>
                    <li>Clear estimates</li>
                    <li>Photo updates</li>
                    <li>Clean finish</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="container section-stack">
    <article class="page-content">

        <section class="eteam-trade-grid">
            <h2>Our Trades</h2>
            <div class="cards">
                <?php foreach ($trades as $t): ?>
                <div class="card">
                    <div class="card-media" style="background-image:url(assets/img/trades/<?php echo $t['img']; ?>)"></div>
                    <div class="card-body">
                        <h3><?php echo htmlspecialchars($t['name']); ?></h3>
                        <p><?php echo htmlspecialchars($t['desc']); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <h2 style="margin-top:28px;">Recent Projects</h2>
        <section class="eteam-gallery-grid">
            <div class="tiles">
                <?php
                // Show a preview of gallery photos (first 6)
                $photo_dirs = ['AE', 'CIMSP', 'CLFSRP'];
                $preview_count = 0;
                $max_preview = 6;
                foreach ($photo_dirs as $dir) {
                    $path = __DIR__ . '/photos/' . $dir;
                    if (!is_dir($path)) continue;
                    $files = array_diff(scandir($path), ['.', '..', '.notafile', '.NotaFile']);
                    foreach ($files as $file) {
                        if ($preview_count >= $max_preview) break 2;
                        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if (!in_array($ext, ['jpg','jpeg','png','gif','webp','mp4','mov','webm'])) continue;
                        $src = "photos/{$dir}/{$file}";
                        if (in_array($ext, ['mp4','mov','webm'])) {
                            ?>
                            <a class="tile" href="gallery.php">
                                <video class="tile-media" muted preload="metadata" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover">
                                    <source src="<?php echo htmlspecialchars($src); ?>">
                                </video>
                                <div class="tile-play"><span>&#9654;</span></div>
                            </a>
                            <?php
                        } else {
                            ?>
                            <a class="tile" href="gallery.php" style="background:var(--card)">
                                <div class="tile-media" style="background-image:url(<?php echo htmlspecialchars($src); ?>)"></div>
                            </a>
                            <?php
                        }
                        $preview_count++;
                    }
                }
                if ($preview_count === 0) {
                    echo '<p class="muted">Photos coming soon.</p>';
                } elseif ($preview_count >= $max_preview) {
                    echo '<a class="tile" href="gallery.php" style="display:flex;align-items:center;justify-content:center;font-weight:900;font-size:1.2rem;color:var(--accent)">View All &rarr;</a>';
                }
                ?>
            </div>
        </section>

    </article>

    <section id="quote" class="quote-block">
        <h2>Request a Quote</h2>
        <p class="muted">Drop your details and what you need. We will follow up to schedule a walk-through.</p>

        <?php
        $form_submitted = false;
        $form_error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eteam_quote'])) {
            $name  = trim($_POST['name'] ?? '');
            $contact = trim($_POST['contact'] ?? '');
            $job   = trim($_POST['job'] ?? '');
            $hp    = trim($_POST['website'] ?? '');

            // Honeypot check
            if (!empty($hp)) {
                $form_error = 'Something went wrong. Please try again.';
            } elseif (empty($name) || empty($contact) || empty($job)) {
                $form_error = 'Please fill in all required fields.';
            } else {
                // Write to a simple log file (replace with email or DB as needed)
                $entry = date('Y-m-d H:i:s') . " | " . $name . " | " . $contact . " | " . str_replace("\n", " ", $job) . "\n";
                @file_put_contents(__DIR__ . '/quote-requests.log', $entry, FILE_APPEND | LOCK_EX);
                $form_submitted = true;
            }
        }
        ?>

        <?php if ($form_submitted): ?>
            <div class="eteam-notice success">Thanks, <?php echo htmlspecialchars($name); ?>! We will be in touch soon.</div>
        <?php elseif ($form_error): ?>
            <div class="eteam-notice error"><?php echo htmlspecialchars($form_error); ?></div>
        <?php endif; ?>

        <form class="eteam-form" method="post" action="index.php#quote">
            <input type="hidden" name="eteam_quote" value="1">
            <div class="hp"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
            <div class="grid-2">
                <div>
                    <label>Name <span class="req">*</span></label>
                    <input type="text" name="name" placeholder="Name" required>
                </div>
                <div>
                    <label>Phone / Email <span class="req">*</span></label>
                    <input type="text" name="contact" placeholder="Phone or Email" required>
                </div>
            </div>
            <label>What are we building/fixing? <span class="req">*</span></label>
            <textarea rows="4" name="job" placeholder="Describe the job..." required></textarea>
            <div style="margin-top:14px">
                <button type="submit" class="btn btn-primary">Send Request</button>
            </div>
        </form>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
