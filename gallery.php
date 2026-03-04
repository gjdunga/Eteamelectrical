<?php
$page_title = 'Gallery';
$body_class = 'page-gallery';

// Directory labels
$dir_labels = [
    'AE'    => 'General Work',
    'CIMSP' => 'Commercial / Industrial',
    'CLFSRP'=> 'Concrete, Landscape & Foundation',
    'FHRBAP'=> 'Framing, Handyman, Remodel & Build',
];

// Supported file extensions
$image_exts = ['jpg','jpeg','png','gif','webp'];
$video_exts = ['mp4','mov','webm','avi','mkv'];
$all_exts   = array_merge($image_exts, $video_exts);

// Scan photo directories
$galleries = [];
$photos_root = __DIR__ . '/photos';
if (is_dir($photos_root)) {
    $dirs = array_diff(scandir($photos_root), ['.', '..']);
    foreach ($dirs as $dir) {
        $full = $photos_root . '/' . $dir;
        if (!is_dir($full)) continue;
        $files = array_diff(scandir($full), ['.', '..', '.notafile', '.NotaFile']);
        $media = [];
        foreach ($files as $f) {
            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
            if (!in_array($ext, $all_exts)) continue;
            $media[] = [
                'file'  => $f,
                'path'  => "photos/{$dir}/{$f}",
                'type'  => in_array($ext, $video_exts) ? 'video' : 'image',
                'ext'   => $ext,
            ];
        }
        if (!empty($media)) {
            $galleries[$dir] = [
                'label' => $dir_labels[$dir] ?? $dir,
                'media' => $media,
            ];
        }
    }
}

include 'includes/header.php';
?>

<?php
// Collect all image paths for the header slideshow
$slideshow_images = [];
foreach ($galleries as $key => $g) {
    foreach ($g['media'] as $m) {
        if ($m['type'] === 'image') {
            $slideshow_images[] = $m['path'];
        }
    }
}
?>

<section class="storm-header slideshow-header">
    <div class="slideshow-bg" aria-hidden="true">
        <?php foreach ($slideshow_images as $i => $src): ?>
        <img class="slideshow-img<?php echo $i === 0 ? ' active' : ''; ?>"
             src="<?php echo htmlspecialchars($src); ?>"
             alt="" loading="<?php echo $i < 2 ? 'eager' : 'lazy'; ?>">
        <?php endforeach; ?>
        <div class="slideshow-overlay"></div>
    </div>
    <div class="container storm-inner">
        <h1 class="storm-title">Our Work</h1>
        <p class="storm-subtitle">Photos and videos from recent projects. Click any image to view full size.</p>
        <?php if (count($slideshow_images) > 1): ?>
        <div class="slideshow-controls">
            <button class="slideshow-btn" id="slideshow-prev" aria-label="Previous">&#8249;</button>
            <span class="slideshow-counter"><span id="slideshow-current">1</span> / <?php echo count($slideshow_images); ?></span>
            <button class="slideshow-btn" id="slideshow-next" aria-label="Next">&#8250;</button>
            <button class="slideshow-btn" id="slideshow-pause" aria-label="Pause slideshow">&#10074;&#10074;</button>
        </div>
        <?php endif; ?>
    </div>
</section>

<div class="container section-stack">

    <?php if (empty($galleries)): ?>
        <p class="muted">No project photos found yet. Check back soon.</p>
    <?php else: ?>

        <nav class="trade-filters">
            <a class="chip" href="#" data-filter="all" style="border-color:var(--accent);color:var(--accent)">All Projects</a>
            <?php foreach ($galleries as $key => $g): ?>
                <a class="chip" href="#section-<?php echo htmlspecialchars($key); ?>" data-filter="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($g['label']); ?> (<?php echo count($g['media']); ?>)</a>
            <?php endforeach; ?>
        </nav>

        <?php
        $global_index = 0;
        foreach ($galleries as $key => $g):
        ?>
        <section id="section-<?php echo htmlspecialchars($key); ?>" class="gallery-section" data-gallery="<?php echo htmlspecialchars($key); ?>" style="margin-bottom:28px">
            <h2><?php echo htmlspecialchars($g['label']); ?></h2>
            <div class="tiles">
                <?php foreach ($g['media'] as $m): ?>
                    <?php if ($m['type'] === 'video'): ?>
                        <div class="tile" data-lightbox="<?php echo $global_index; ?>" data-type="video" data-src="<?php echo htmlspecialchars($m['path']); ?>" style="cursor:pointer">
                            <video class="tile-media-video" muted preload="metadata" playsinline>
                                <source src="<?php echo htmlspecialchars($m['path']); ?>#t=0.5">
                            </video>
                            <div class="tile-play"><span>&#9654;</span></div>
                        </div>
                    <?php else: ?>
                        <div class="tile" data-lightbox="<?php echo $global_index; ?>" data-type="image" data-src="<?php echo htmlspecialchars($m['path']); ?>" style="cursor:pointer">
                            <img class="tile-media-img" src="<?php echo htmlspecialchars($m['path']); ?>" alt="Project photo" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <?php $global_index++; ?>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>

    <?php endif; ?>

</div>

<!-- Lightbox -->
<div class="lightbox-overlay" id="lightbox">
    <button class="lightbox-close" aria-label="Close">&times;</button>
    <button class="lightbox-nav prev" aria-label="Previous">&#8249;</button>
    <button class="lightbox-nav next" aria-label="Next">&#8250;</button>
    <div class="lightbox-content" id="lightbox-content"></div>
</div>

<script>
(function() {
    var items = document.querySelectorAll('[data-lightbox]');
    var overlay = document.getElementById('lightbox');
    var content = document.getElementById('lightbox-content');
    var current = 0;
    var total = items.length;

    function stopMedia() {
        var vids = content.querySelectorAll('video');
        vids.forEach(function(v) { v.pause(); v.src = ''; });
        content.innerHTML = '';
    }

    function show(idx) {
        if (total === 0) return;
        if (idx < 0) idx = total - 1;
        if (idx >= total) idx = 0;
        current = idx;
        stopMedia();
        var el = items[idx];
        var type = el.getAttribute('data-type');
        var src  = el.getAttribute('data-src');
        if (type === 'video') {
            var v = document.createElement('video');
            v.src = src;
            v.controls = true;
            v.autoplay = true;
            v.playsInline = true;
            v.style.maxWidth = '92vw';
            v.style.maxHeight = '90vh';
            v.style.borderRadius = '16px';
            v.style.background = '#000';
            content.appendChild(v);
        } else {
            var img = document.createElement('img');
            img.src = src;
            img.alt = 'Project photo';
            content.appendChild(img);
        }
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function hide() {
        stopMedia();
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    items.forEach(function(el) {
        el.addEventListener('click', function() {
            show(parseInt(el.getAttribute('data-lightbox')));
        });
    });

    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) hide();
    });
    document.querySelector('.lightbox-close').addEventListener('click', hide);
    document.querySelector('.lightbox-nav.prev').addEventListener('click', function(e) { e.stopPropagation(); show(current - 1); });
    document.querySelector('.lightbox-nav.next').addEventListener('click', function(e) { e.stopPropagation(); show(current + 1); });

    document.addEventListener('keydown', function(e) {
        if (!overlay.classList.contains('active')) return;
        if (e.key === 'Escape') hide();
        if (e.key === 'ArrowLeft') show(current - 1);
        if (e.key === 'ArrowRight') show(current + 1);
    });

    // Filter chips
    var chips = document.querySelectorAll('.chip[data-filter]');
    var sections = document.querySelectorAll('.gallery-section');
    chips.forEach(function(chip) {
        chip.addEventListener('click', function(e) {
            e.preventDefault();
            var f = chip.getAttribute('data-filter');
            chips.forEach(function(c) { c.style.borderColor = ''; c.style.color = ''; });
            chip.style.borderColor = 'var(--accent)';
            chip.style.color = 'var(--accent)';
            sections.forEach(function(s) {
                s.style.display = (f === 'all' || s.getAttribute('data-gallery') === f) ? '' : 'none';
            });
        });
    });
})();
</script>

<?php if (count($slideshow_images) > 1): ?>
<script>
(function() {
    var imgs = document.querySelectorAll('.slideshow-img');
    var counter = document.getElementById('slideshow-current');
    var total = imgs.length;
    var current = 0;
    var paused = false;
    var interval = null;
    var DELAY = 5000;

    function showSlide(idx) {
        if (idx < 0) idx = total - 1;
        if (idx >= total) idx = 0;
        imgs[current].classList.remove('active');
        current = idx;
        imgs[current].classList.add('active');
        if (counter) counter.textContent = current + 1;
    }

    function next() { showSlide(current + 1); }
    function prev() { showSlide(current - 1); }

    function startTimer() {
        stopTimer();
        interval = setInterval(next, DELAY);
    }
    function stopTimer() {
        if (interval) { clearInterval(interval); interval = null; }
    }

    var btnPrev = document.getElementById('slideshow-prev');
    var btnNext = document.getElementById('slideshow-next');
    var btnPause = document.getElementById('slideshow-pause');

    if (btnPrev) btnPrev.addEventListener('click', function() { prev(); if (!paused) startTimer(); });
    if (btnNext) btnNext.addEventListener('click', function() { next(); if (!paused) startTimer(); });
    if (btnPause) btnPause.addEventListener('click', function() {
        paused = !paused;
        btnPause.innerHTML = paused ? '&#9654;' : '&#10074;&#10074;';
        btnPause.setAttribute('aria-label', paused ? 'Play slideshow' : 'Pause slideshow');
        if (paused) stopTimer(); else startTimer();
    });

    startTimer();
})();
</script>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
