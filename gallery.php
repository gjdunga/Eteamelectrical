<?php
$page_title = 'Gallery';

$dir_labels = [
    'AE'=>'AE','CIMSP'=>'CIMSP','CLFSRP'=>'CLFSRP','FHRBAP'=>'FHRBAP',
    'FYSIL'=>'FYSIL','HTICLD'=>'HTICLD','IPLCCI'=>'IPLCCI','IPPM'=>'IPPM',
    'OFSI'=>'OFSI','OGDROR'=>'OGDROR','SIMHWHF'=>'SIMHWHF','TSRNL'=>'TSRNL','UTA'=>'UTA',
];

$image_exts = ['jpg','jpeg','png','gif','webp'];
$video_exts = ['mp4','mov','webm','avi','mkv'];
$all_exts = array_merge($image_exts, $video_exts);

$galleries = [];
$photos_root = __DIR__ . '/photos';
if (is_dir($photos_root)) {
    $dirs = array_diff(scandir($photos_root), ['.','..']);
    foreach ($dirs as $dir) {
        $full = $photos_root . '/' . $dir;
        if (!is_dir($full)) continue;
        $files = array_diff(scandir($full), ['.','..', '.notafile', '.NotaFile', '(1).NotaFile']);
        $media = [];
        foreach ($files as $f) {
            $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
            if (!in_array($ext, $all_exts)) continue;
            $media[] = [
                'file' => $f,
                'path' => "photos/{$dir}/{$f}",
                'type' => in_array($ext, $video_exts) ? 'video' : 'image',
            ];
        }
        if (!empty($media)) {
            $galleries[$dir] = ['label' => $dir_labels[$dir] ?? $dir, 'media' => $media];
        }
    }
}

$slideshow_images = [];
foreach ($galleries as $g) {
    foreach ($g['media'] as $m) {
        if ($m['type'] === 'image') $slideshow_images[] = $m['path'];
    }
}

include 'includes/header.php';
?>

<!-- Slideshow Header -->
<section class="slideshow-header">
    <div class="slideshow-bg" aria-hidden="true">
        <?php foreach ($slideshow_images as $i => $src): ?>
        <img class="slideshow-img<?php echo $i === 0 ? ' active' : ''; ?>"
             src="<?php echo htmlspecialchars($src); ?>" alt=""
             loading="<?php echo $i < 2 ? 'eager' : 'lazy'; ?>">
        <?php endforeach; ?>
        <div class="slideshow-overlay"></div>
    </div>
    <div class="container inner">
        <div class="section-label" style="color:var(--orange)">Portfolio</div>
        <h1 class="section-title" style="font-size:clamp(2.2rem,5vw,3.6rem);color:#fff">Our Work</h1>
        <p style="color:rgba(255,255,255,.6);margin-top:8px;max-width:50ch">Photos and videos from projects across Colorado. Click any image for full size.</p>
        <?php if (count($slideshow_images) > 1): ?>
        <div class="slideshow-controls">
            <button class="slideshow-btn" id="ss-prev" aria-label="Previous">&#8249;</button>
            <span class="slideshow-counter"><span id="ss-cur">1</span> / <?php echo count($slideshow_images); ?></span>
            <button class="slideshow-btn" id="ss-next" aria-label="Next">&#8250;</button>
            <button class="slideshow-btn" id="ss-pause" aria-label="Pause">&#10074;&#10074;</button>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section">
    <div class="container">
        <?php if (empty($galleries)): ?>
            <p style="color:var(--text-light)">No project photos found yet.</p>
        <?php else: ?>

        <nav class="filter-bar">
            <a class="chip active" href="#" data-filter="all">All (<?php echo array_sum(array_map(function($g){return count($g['media']);}, $galleries)); ?>)</a>
            <?php foreach ($galleries as $key => $g): ?>
                <a class="chip" href="#sec-<?php echo htmlspecialchars($key); ?>" data-filter="<?php echo htmlspecialchars($key); ?>"><?php echo htmlspecialchars($g['label']); ?> (<?php echo count($g['media']); ?>)</a>
            <?php endforeach; ?>
        </nav>

        <?php
        $idx = 0;
        foreach ($galleries as $key => $g):
        ?>
        <section id="sec-<?php echo htmlspecialchars($key); ?>" class="gallery-section" data-gallery="<?php echo htmlspecialchars($key); ?>" style="margin-bottom:36px">
            <h2 style="font-family:var(--display);font-size:1.4rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:14px;border-bottom:2px solid var(--line);padding-bottom:8px"><?php echo htmlspecialchars($g['label']); ?></h2>
            <div class="tiles">
                <?php foreach ($g['media'] as $m): ?>
                    <?php if ($m['type'] === 'video'): ?>
                        <div class="tile" data-lb="<?php echo $idx; ?>" data-type="video" data-src="<?php echo htmlspecialchars($m['path']); ?>">
                            <video class="tile-media-video" muted loop playsinline preload="metadata" data-autoscroll>
                                <source src="<?php echo htmlspecialchars($m['path']); ?>#t=0.5">
                            </video>
                            <div class="tile-play"><span>&#9654;</span></div>
                        </div>
                    <?php else: ?>
                        <div class="tile" data-lb="<?php echo $idx; ?>" data-type="image" data-src="<?php echo htmlspecialchars($m['path']); ?>">
                            <img class="tile-media-img" src="<?php echo htmlspecialchars($m['path']); ?>" alt="Project photo" loading="lazy">
                        </div>
                    <?php endif; ?>
                    <?php $idx++; ?>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endforeach; ?>
        <?php endif; ?>

        <div class="cta-band" style="margin-top:32px;border-radius:0">
            <div class="container cta-inner">
                <div class="cta-text">Like what you see?</div>
                <a class="btn btn-inv" href="index.php#contact">Get an Estimate</a>
            </div>
        </div>
    </div>
</section>

<!-- Lightbox -->
<div class="lightbox-overlay" id="lightbox">
    <button class="lb-btn lb-close" aria-label="Close">&times;</button>
    <button class="lb-btn lb-prev" aria-label="Previous">&#8249;</button>
    <button class="lb-btn lb-next" aria-label="Next">&#8250;</button>
    <div id="lb-content"></div>
</div>

<script>
(function() {
    var items = document.querySelectorAll('[data-lb]');
    var overlay = document.getElementById('lightbox');
    var content = document.getElementById('lb-content');
    var cur = 0, total = items.length;

    function clear() {
        content.querySelectorAll('video').forEach(function(v){v.pause();v.src=''});
        content.innerHTML = '';
    }
    function show(i) {
        if (!total) return;
        if (i < 0) i = total - 1;
        if (i >= total) i = 0;
        cur = i; clear();
        var el = items[i], type = el.getAttribute('data-type'), src = el.getAttribute('data-src');
        if (type === 'video') {
            var v = document.createElement('video');
            v.src = src; v.controls = true; v.autoplay = true; v.playsInline = true;
            v.style.maxWidth='92vw'; v.style.maxHeight='90vh'; v.style.background='#000';
            content.appendChild(v);
        } else {
            var img = document.createElement('img');
            img.src = src; img.alt = 'Project photo';
            content.appendChild(img);
        }
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function hide() { clear(); overlay.classList.remove('active'); document.body.style.overflow = ''; }

    items.forEach(function(el) { el.addEventListener('click', function() { show(+el.getAttribute('data-lb')); }); });
    overlay.addEventListener('click', function(e) { if (e.target === overlay) hide(); });
    document.querySelector('.lb-close').addEventListener('click', hide);
    document.querySelector('.lb-prev').addEventListener('click', function(e) { e.stopPropagation(); show(cur - 1); });
    document.querySelector('.lb-next').addEventListener('click', function(e) { e.stopPropagation(); show(cur + 1); });
    document.addEventListener('keydown', function(e) {
        if (!overlay.classList.contains('active')) return;
        if (e.key === 'Escape') hide();
        if (e.key === 'ArrowLeft') show(cur - 1);
        if (e.key === 'ArrowRight') show(cur + 1);
    });

    // Filters
    document.querySelectorAll('.chip[data-filter]').forEach(function(chip) {
        chip.addEventListener('click', function(e) {
            e.preventDefault();
            var f = chip.getAttribute('data-filter');
            document.querySelectorAll('.chip[data-filter]').forEach(function(c){c.classList.remove('active')});
            chip.classList.add('active');
            document.querySelectorAll('.gallery-section').forEach(function(s) {
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
    var counter = document.getElementById('ss-cur');
    var total = imgs.length, cur = 0, paused = false, timer = null;

    function go(i) {
        if (i < 0) i = total - 1; if (i >= total) i = 0;
        imgs[cur].classList.remove('active'); cur = i;
        imgs[cur].classList.add('active');
        if (counter) counter.textContent = cur + 1;
    }
    function start() { stop(); timer = setInterval(function(){go(cur+1)}, 5000); }
    function stop() { if (timer) clearInterval(timer); timer = null; }

    var bp = document.getElementById('ss-prev');
    var bn = document.getElementById('ss-next');
    var bx = document.getElementById('ss-pause');
    if(bp) bp.addEventListener('click', function(){go(cur-1);if(!paused)start()});
    if(bn) bn.addEventListener('click', function(){go(cur+1);if(!paused)start()});
    if(bx) bx.addEventListener('click', function(){
        paused=!paused;
        bx.innerHTML=paused?'&#9654;':'&#10074;&#10074;';
        if(paused) stop(); else start();
    });
    start();
})();
</script>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
