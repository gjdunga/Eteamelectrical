<?php
$page_title = 'Reviews';

$reviews_file = __DIR__ . '/reviews.json';
$reviews = [];
if (file_exists($reviews_file)) {
    $reviews = json_decode(file_get_contents($reviews_file), true) ?: [];
}

$review_submitted = false;
$review_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eteam_review'])) {
    $rname  = trim($_POST['reviewer_name'] ?? '');
    $rtrade = trim($_POST['trade'] ?? '');
    $rtext  = trim($_POST['review_text'] ?? '');
    $rstars = intval($_POST['stars'] ?? 0);
    $hp     = trim($_POST['website'] ?? '');

    if (!empty($hp)) {
        $review_error = 'Something went wrong.';
    } elseif (empty($rname) || empty($rtext) || $rstars < 1 || $rstars > 5) {
        $review_error = 'Please fill in your name, review, and rating.';
    } else {
        $reviews[] = [
            'name'=>$rname, 'trade'=>$rtrade, 'text'=>$rtext,
            'stars'=>$rstars, 'date'=>date('Y-m-d'),
        ];
        @file_put_contents($reviews_file, json_encode($reviews, JSON_PRETTY_PRINT), LOCK_EX);
        $review_submitted = true;
    }
}

$display = array_reverse($reviews);
$avg = count($reviews) > 0 ? array_sum(array_column($reviews, 'stars')) / count($reviews) : 0;

include 'includes/header.php';
?>

<section class="section" style="padding-top:120px">
    <div class="container">
        <div class="text-center reveal" style="text-align:center">
            <div class="section-label" style="justify-content:center">Testimonials</div>
            <h1 class="section-title">Customer Reviews</h1>
            <?php if (count($reviews) > 0): ?>
                <p class="section-desc" style="margin:12px auto 0;text-align:center">
                    <?php echo count($reviews); ?> review<?php echo count($reviews)!==1?'s':''; ?>
                    &middot;
                    <span style="color:var(--orange);font-weight:700"><?php echo number_format($avg,1); ?> / 5</span>
                </p>
            <?php else: ?>
                <p class="section-desc" style="margin:12px auto 0;text-align:center">No reviews yet. Be the first to share your experience.</p>
            <?php endif; ?>
        </div>

        <!-- Leave a review -->
        <div class="reveal reveal-delay-1" style="max-width:700px;margin:40px auto;background:var(--card);border:2px solid var(--line);padding:32px">
            <h2 style="font-family:var(--display);font-size:1.3rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:16px">Leave a Review</h2>

            <?php if ($review_submitted): ?>
                <div class="notice notice-ok">Thanks for the review, <?php echo htmlspecialchars($rname); ?>!</div>
            <?php else: ?>
                <?php if ($review_error): ?>
                    <div class="notice notice-err"><?php echo htmlspecialchars($review_error); ?></div>
                <?php endif; ?>

                <form method="post" action="reviews.php">
                    <input type="hidden" name="eteam_review" value="1">
                    <div class="hp"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

                    <div class="form-grid">
                        <div>
                            <label class="form-label">Your Name <span class="form-req">*</span></label>
                            <input class="form-input" type="text" name="reviewer_name" placeholder="Your name" required>
                        </div>
                        <div>
                            <label class="form-label">Service Received</label>
                            <select class="form-select" name="trade">
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

                    <label class="form-label">Rating <span class="form-req">*</span></label>
                    <div class="rating-input">
                        <input type="radio" name="stars" id="s5" value="5"><label for="s5">&#9733;</label>
                        <input type="radio" name="stars" id="s4" value="4"><label for="s4">&#9733;</label>
                        <input type="radio" name="stars" id="s3" value="3"><label for="s3">&#9733;</label>
                        <input type="radio" name="stars" id="s2" value="2"><label for="s2">&#9733;</label>
                        <input type="radio" name="stars" id="s1" value="1"><label for="s1">&#9733;</label>
                    </div>

                    <label class="form-label">Your Review <span class="form-req">*</span></label>
                    <textarea class="form-textarea" name="review_text" rows="4" placeholder="Tell us about your experience..." required></textarea>

                    <div style="margin-top:20px">
                        <button type="submit" class="btn btn-fill">Submit Review</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <!-- Reviews list -->
        <?php if (!empty($display)): ?>
        <div class="review-grid reveal reveal-delay-2">
            <?php foreach ($display as $r): ?>
            <div class="review-card">
                <div class="review-meta">
                    <div>
                        <div class="review-name"><?php echo htmlspecialchars($r['name']); ?></div>
                        <?php if (!empty($r['trade'])): ?>
                            <div class="review-trade"><?php echo htmlspecialchars($r['trade']); ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="review-stars">
                        <?php echo str_repeat('&#9733;', $r['stars']); ?><?php echo str_repeat('&#9734;', 5 - $r['stars']); ?>
                    </div>
                </div>
                <p class="review-text"><?php echo nl2br(htmlspecialchars($r['text'])); ?></p>
                <div class="review-date"><?php echo htmlspecialchars($r['date']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="cta-band" style="margin-top:40px;border-radius:0">
            <div class="container cta-inner">
                <div class="cta-text">Need work done?</div>
                <a class="btn btn-inv" href="index.php#contact">Get an Estimate</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
