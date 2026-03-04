<?php
$page_title = 'Gallery';
$body_class = 'page-gallery';

// Directory labels
$dir_labels = [
    'CIMSP' => 'Commercial / Industrial',
    'CLFSRP'=> 'Concrete, Landscape & Foundation',
    'FHRBAP'=> 'Framing, Handyman, Remodel & Build',
];

// Directories to skip (client does not offer these services)
$skip_dirs = ['AE'];

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
        if (in_array($dir, $skip_dirs)) continue;
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

<section class="storm-header">
    <div class="storm-bg" aria-hidden="true"></div>
    <div class="container storm-inner">
        <h1 class="storm-title">Our Work</h1>
        <p class="storm-subtitle">Photos and videos from recent projects. Click any image to view full size.</p>
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

<?php include 'includes/footer.php'; ?>
