<?php
/**
 * E Team Electrical -- Review Admin Panel
 *
 * Password-protected page for managing customer reviews.
 * Set the password in admin-config.php (copy from admin-config.sample.php).
 */
session_start();

// Load config
$config_file = __DIR__ . '/admin-config.php';
if (!file_exists($config_file)) {
    die('Admin not configured. Copy admin-config.sample.php to admin-config.php and set a password.');
}
$config = require $config_file;
$admin_pass = $config['password'] ?? '';
if (empty($admin_pass)) {
    die('No admin password set. Edit admin-config.php.');
}

// Auth
$auth_error = '';
if (isset($_POST['admin_logout'])) {
    unset($_SESSION['eteam_admin']);
    header('Location: admin.php');
    exit;
}
if (isset($_POST['admin_login'])) {
    if (password_verify($_POST['password'] ?? '', $admin_pass)) {
        $_SESSION['eteam_admin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $auth_error = 'Wrong password.';
    }
}
$logged_in = !empty($_SESSION['eteam_admin']);

// Reviews file
$reviews_file = __DIR__ . '/reviews.json';
function load_reviews($file) {
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true) ?: [];
}
function save_reviews($file, $reviews) {
    file_put_contents($file, json_encode(array_values($reviews), JSON_PRETTY_PRINT), LOCK_EX);
}

$notice = '';

// Handle actions (only if logged in)
if ($logged_in && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviews = load_reviews($reviews_file);

    // Delete
    if (isset($_POST['delete_index'])) {
        $i = intval($_POST['delete_index']);
        if (isset($reviews[$i])) {
            $deleted_name = $reviews[$i]['name'];
            array_splice($reviews, $i, 1);
            save_reviews($reviews_file, $reviews);
            $notice = "Deleted review by " . htmlspecialchars($deleted_name) . ".";
        }
    }

    // Edit
    if (isset($_POST['edit_index'])) {
        $i = intval($_POST['edit_index']);
        if (isset($reviews[$i])) {
            $reviews[$i]['name']  = trim($_POST['edit_name'] ?? $reviews[$i]['name']);
            $reviews[$i]['trade'] = trim($_POST['edit_trade'] ?? '');
            $reviews[$i]['text']  = trim($_POST['edit_text'] ?? $reviews[$i]['text']);
            $reviews[$i]['stars'] = max(1, min(5, intval($_POST['edit_stars'] ?? $reviews[$i]['stars'])));
            save_reviews($reviews_file, $reviews);
            $notice = "Updated review by " . htmlspecialchars($reviews[$i]['name']) . ".";
        }
    }
}

$reviews = $logged_in ? load_reviews($reviews_file) : [];
$page_title = 'Admin';
?>
<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>Review Admin | E Team Electrical</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@400;500;700&family=Space+Mono:wght@400;700&display=swap');
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:'DM Sans',sans-serif;background:#f5f0eb;color:#1a1a1a;line-height:1.6}
.wrap{max-width:900px;margin:0 auto;padding:40px 20px}
h1{font-family:'Bebas Neue',sans-serif;font-size:2rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:8px}
h2{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;letter-spacing:1px;text-transform:uppercase;margin-bottom:12px}
.sub{font-family:'Space Mono',monospace;font-size:.72rem;letter-spacing:2px;text-transform:uppercase;color:#ff5e1a;margin-bottom:20px}
a{color:#ff5e1a}

/* Login */
.login-box{max-width:360px;margin:80px auto;background:#fff;border:2px solid #d4cdc4;padding:40px}
.login-box h1{margin-bottom:4px}
.login-box input{width:100%;padding:12px;border:2px solid #d4cdc4;font-size:1rem;margin:12px 0;font-family:'DM Sans',sans-serif}
.login-box input:focus{outline:none;border-color:#ff5e1a}
.login-box button{width:100%;padding:12px;background:#ff5e1a;color:#fff;border:none;font-family:'Bebas Neue',sans-serif;font-size:1.1rem;letter-spacing:2px;text-transform:uppercase;cursor:pointer}
.login-box button:hover{background:#e04d0f}
.err{color:#e03131;font-weight:700;font-size:.9rem}

/* Admin */
.topbar{display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;padding-bottom:16px;border-bottom:3px solid #1a1a1a}
.topbar form button{background:none;border:2px solid #d4cdc4;padding:8px 16px;font-family:'Bebas Neue',sans-serif;font-size:.9rem;letter-spacing:1px;cursor:pointer;text-transform:uppercase}
.topbar form button:hover{border-color:#e03131;color:#e03131}

.notice{padding:14px 18px;margin-bottom:20px;font-weight:700;border-left:4px solid #ff5e1a;background:rgba(255,94,26,.06)}

.review{background:#fff;border:2px solid #d4cdc4;padding:24px;margin-bottom:16px;position:relative}
.review:hover{border-color:#ff5e1a}
.review-head{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:8px}
.review-name{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:1px}
.review-trade{font-family:'Space Mono',monospace;font-size:.7rem;letter-spacing:1px;color:#5a5a5a;text-transform:uppercase}
.review-stars{color:#ff5e1a;font-size:1.1rem;letter-spacing:2px}
.review-text{color:#5a5a5a;margin:8px 0}
.review-date{font-family:'Space Mono',monospace;font-size:.72rem;color:#999;letter-spacing:1px}

.actions{display:flex;gap:8px;margin-top:12px}
.actions button{padding:8px 16px;font-family:'Bebas Neue',sans-serif;font-size:.85rem;letter-spacing:1px;text-transform:uppercase;cursor:pointer;border:2px solid}
.btn-edit{background:none;border-color:#1a1a1a;color:#1a1a1a}
.btn-edit:hover{border-color:#ff5e1a;color:#ff5e1a}
.btn-del{background:none;border-color:#e03131;color:#e03131}
.btn-del:hover{background:#e03131;color:#fff}

/* Edit form */
.edit-form{display:none;background:#faf8f5;border:2px solid #ff5e1a;padding:20px;margin-top:12px}
.edit-form.open{display:block}
.edit-form label{display:block;margin:10px 0 4px;font-family:'Bebas Neue',sans-serif;font-size:.85rem;letter-spacing:1px;text-transform:uppercase}
.edit-form input,.edit-form select,.edit-form textarea{width:100%;padding:10px;border:2px solid #d4cdc4;font-family:'DM Sans',sans-serif;font-size:.92rem}
.edit-form textarea{min-height:80px;resize:vertical}
.edit-form input:focus,.edit-form select:focus,.edit-form textarea:focus{outline:none;border-color:#ff5e1a}
.edit-actions{display:flex;gap:8px;margin-top:14px}
.edit-actions button{padding:10px 24px;font-family:'Bebas Neue',sans-serif;font-size:.95rem;letter-spacing:1px;text-transform:uppercase;cursor:pointer;border:2px solid}
.btn-save{background:#ff5e1a;color:#fff;border-color:#ff5e1a}
.btn-save:hover{background:#e04d0f}
.btn-cancel{background:none;border-color:#d4cdc4;color:#5a5a5a}
.btn-cancel:hover{border-color:#1a1a1a;color:#1a1a1a}
.empty{text-align:center;padding:60px 20px;color:#999}

.confirm-delete{display:none;background:rgba(224,49,49,.04);border:2px solid #e03131;padding:16px;margin-top:12px;text-align:center}
.confirm-delete.open{display:block}
.confirm-delete p{margin-bottom:12px;font-weight:700;color:#e03131}
</style>
</head>
<body>

<?php if (!$logged_in): ?>
<!-- Login -->
<div class="login-box">
    <h1>Review Admin</h1>
    <div class="sub">E Team Electrical</div>
    <?php if ($auth_error): ?><p class="err"><?php echo htmlspecialchars($auth_error); ?></p><?php endif; ?>
    <form method="post">
        <input type="password" name="password" placeholder="Admin password" required autofocus>
        <button type="submit" name="admin_login" value="1">Log In</button>
    </form>
</div>

<?php else: ?>
<!-- Admin Panel -->
<div class="wrap">
    <div class="topbar">
        <div>
            <h1>Review Admin</h1>
            <div class="sub"><?php echo count($reviews); ?> review<?php echo count($reviews)!==1?'s':''; ?></div>
        </div>
        <div style="display:flex;gap:12px;align-items:center">
            <a href="reviews.php" style="font-family:'Space Mono',monospace;font-size:.75rem;letter-spacing:1px;text-transform:uppercase">View Public Page</a>
            <form method="post"><button type="submit" name="admin_logout" value="1">Log Out</button></form>
        </div>
    </div>

    <?php if ($notice): ?><div class="notice"><?php echo $notice; ?></div><?php endif; ?>

    <?php if (empty($reviews)): ?>
        <div class="empty">
            <h2>No reviews yet</h2>
            <p>Reviews submitted through the public page will appear here.</p>
        </div>
    <?php else: ?>
        <?php foreach ($reviews as $i => $r): ?>
        <div class="review" id="review-<?php echo $i; ?>">
            <div class="review-head">
                <div>
                    <div class="review-name"><?php echo htmlspecialchars($r['name']); ?></div>
                    <?php if (!empty($r['trade'])): ?>
                        <div class="review-trade"><?php echo htmlspecialchars($r['trade']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="review-stars"><?php echo str_repeat('&#9733;', $r['stars']); ?><?php echo str_repeat('&#9734;', 5 - $r['stars']); ?></div>
            </div>
            <p class="review-text"><?php echo nl2br(htmlspecialchars($r['text'])); ?></p>
            <div class="review-date"><?php echo htmlspecialchars($r['date'] ?? 'Unknown'); ?></div>

            <div class="actions">
                <button class="btn-edit" type="button" onclick="toggleEdit(<?php echo $i; ?>)">Edit</button>
                <button class="btn-del" type="button" onclick="toggleDelete(<?php echo $i; ?>)">Delete</button>
            </div>

            <!-- Edit form -->
            <div class="edit-form" id="edit-<?php echo $i; ?>">
                <form method="post">
                    <input type="hidden" name="edit_index" value="<?php echo $i; ?>">
                    <label>Name</label>
                    <input type="text" name="edit_name" value="<?php echo htmlspecialchars($r['name']); ?>" required>
                    <label>Service</label>
                    <select name="edit_trade">
                        <option value="">None</option>
                        <?php foreach (['Electrical','General Construction','Handyman','Concrete','Demolition / Dirt Work','Plumbing','Full Remodel','Other'] as $opt): ?>
                            <option<?php echo ($r['trade'] ?? '')===$opt ? ' selected' : ''; ?>><?php echo $opt; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Stars</label>
                    <select name="edit_stars">
                        <?php for ($s = 5; $s >= 1; $s--): ?>
                            <option value="<?php echo $s; ?>"<?php echo $r['stars']===$s ? ' selected' : ''; ?>><?php echo $s; ?> star<?php echo $s!==1?'s':''; ?></option>
                        <?php endfor; ?>
                    </select>
                    <label>Review Text</label>
                    <textarea name="edit_text" required><?php echo htmlspecialchars($r['text']); ?></textarea>
                    <div class="edit-actions">
                        <button type="submit" class="btn-save">Save Changes</button>
                        <button type="button" class="btn-cancel" onclick="toggleEdit(<?php echo $i; ?>)">Cancel</button>
                    </div>
                </form>
            </div>

            <!-- Delete confirmation -->
            <div class="confirm-delete" id="del-<?php echo $i; ?>">
                <p>Delete this review by <?php echo htmlspecialchars($r['name']); ?>? This cannot be undone.</p>
                <form method="post" style="display:inline">
                    <input type="hidden" name="delete_index" value="<?php echo $i; ?>">
                    <button type="submit" class="btn-del" style="background:#e03131;color:#fff">Yes, Delete</button>
                </form>
                <button type="button" class="btn-cancel" onclick="toggleDelete(<?php echo $i; ?>)" style="margin-left:8px">Cancel</button>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
function toggleEdit(i) {
    var el = document.getElementById('edit-' + i);
    el.classList.toggle('open');
    // Close delete if open
    var del = document.getElementById('del-' + i);
    if (del) del.classList.remove('open');
}
function toggleDelete(i) {
    var el = document.getElementById('del-' + i);
    el.classList.toggle('open');
    // Close edit if open
    var edit = document.getElementById('edit-' + i);
    if (edit) edit.classList.remove('open');
}
</script>

<?php endif; ?>

</body>
</html>
