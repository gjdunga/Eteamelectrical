<?php
$page_title = 'Payment';
include 'includes/header.php';
?>

<section class="section" style="padding-top:120px">
    <div class="container">
        <div class="text-center reveal" style="text-align:center">
            <div class="section-label" style="justify-content:center">Payments</div>
            <h1 class="section-title">Make a Payment</h1>
            <p class="section-desc" style="margin:12px auto 0;text-align:center;max-width:50ch">
                Use the button below to pay an invoice or make a deposit toward your project. PayPal and Venmo accepted.
            </p>
        </div>

        <div class="reveal reveal-delay-1" style="max-width:480px;margin:40px auto;background:var(--card);border:2px solid var(--line);padding:40px;text-align:center">
            <div id="paypal-container-YCDJ72M78L52Y"></div>
            <script>
                paypal.HostedButtons({
                    hostedButtonId: "YCDJ72M78L52Y",
                }).render("#paypal-container-YCDJ72M78L52Y");
            </script>
            <p style="margin-top:20px;font-family:var(--mono);font-size:.72rem;letter-spacing:1px;color:var(--text-light);text-transform:uppercase">Secure payment via PayPal</p>
        </div>

        <div class="reveal reveal-delay-2" style="max-width:480px;margin:0 auto;text-align:center">
            <p style="color:var(--text-light);font-size:.92rem;line-height:1.6">
                Questions about your invoice? <a href="index.php#contact" style="color:var(--orange);text-decoration:underline;font-weight:700">Contact us</a>
            </p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
