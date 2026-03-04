<?php
$page_title = 'Reviews';

$reviews_file = __DIR__ . '/reviews.json';
$reviews = [];
if (file_exists($reviews_file)) {
    $raw = file_get_contents($reviews_file);
    $reviews = json_decode($raw, true) ?: [];
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
        $review_error = 'Something went wrong. Please try again.';
    } elseif (empty($rname) || empty($rtext) || $rstars < 1 || $rstars > 5) {
        $review_error = 'Please fill in your name, review, and rating.';
    } else {
        $reviews[] = [
            'name'  => $rname,
            'trade' => $rtrade,
            'text'  => $rtext,
            'stars' => $rstars,
            'date'  => date('Y-m-d'),
        ];
        @file_put_contents($reviews_file, json_encode($reviews, JSON_PRETTY_PRINT), LOCK_EX);
        $review_submitted = true;
    }
}

$display_reviews = array_reverse($reviews);
$avg = 0;
if (count($reviews) > 0) {
    $avg = array_sum(array_column($reviews, 'stars')) / count($reviews);
}

include 'includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="section-header text-center">
            <div class="section-label">Testimonials</div>
            <h1 class="section-title">Customer Reviews</h1>
            <?php if (count($reviews) > 0): ?>
                <p class="section-subtitle" style="margin-left:auto;margin-right:auto">
                    <?php echo count($reviews); ?> review<?php echo count($reviews) !== 1 ? 's' : ''; ?>
                    &middot;
                    <span class="accent"><?php echo number_format($avg, 1); ?> / 5</span> average
                    &middot;
                    <?php echo str_repeat('&#9733;', round($avg)); ?><?php echo str_repeat('&#9734;', 5 - round($avg)); ?>
                </p>
            <?php else: ?>
                <p class="section-subtitle" style="margin-left:auto;margin-right:auto">No reviews yet. Be the first to share your experience.</p>
            <?php endif; ?>
        </div>

        <!-- Leave a review -->
        <div style="max-width:680px;margin:0 auto 40px;background:var(--card);border:1px solid var(--line);border-radius:var(--radius);padding:28px">
            <h2 class="section-title" style="font-size:1.3rem;margin-bottom:16px">Leave a Review</h2>

            <?php if ($review_submitted): ?>
                <div class="eteam-notice success">Thanks for the review, <?php echo htmlspecialchars($rname); ?>!</div>
            <?php else: ?>
                <?php if ($review_error): ?>
                    <div class="eteam-notice error"><?php echo htmlspecialchars($review_error); ?></div>
                <?php endif; ?>

                <form class="eteam-form" method="post" action="reviews.php">
                    <input type="hidden" name="eteam_review" value="1">
                    <div class="hp"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

                    <div class="grid-2">
                        <div>
                            <label>Your Name <span class="req">*</span></label>
                            <input type="text" name="reviewer_name" placeholder="Your name" required>
                        </div>
                        <div>
                            <label>Service Received</label>
                            <select name="trade">
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

                    <label>Rating <span class="req">*</span></label>
                    <div class="eteam-rating">
                        <input type="radio" name="stars" id="s5" value="5"><label for="s5">&#9733;</label>
                        <input type="radio" name="stars" id="s4" value="4"><label for="s4">&#9733;</label>
                        <input type="radio" name="stars" id="s3" value="3"><label for="s3">&#9733;</label>
                        <input type="radio" name="stars" id="s2" value="2"><label for="s2">&#9733;</label>
                        <input type="radio" name="stars" id="s1" value="1"><label for="s1">&#9733;</label>
                    </div>

                    <label>Your Review <span class="req">*</span></label>
                    <textarea rows="4" name="review_text" placeholder="Tell us about your experience..." required></textarea>

                    <div style="margin-top:18px">
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </div>
                </form>
            <?php endif; ?>
        </div>

        <!-- Reviews list -->
        <?php if (!empty($display_reviews)): ?>
        <div class="review-cards">
            <?php foreach ($display_reviews as $r): ?>
            <div class="review-card">
                <div class="review-header">
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
                <div class="review-footer"><?php echo htmlspecialchars($r['date']); ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="cta-strip">
            <div>
                <h3>Need work done?</h3>
                <p>Get a free estimate for your project.</p>
            </div>
            <a class="btn btn-primary btn-sm" href="index.php#contact">Get a Quote</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
