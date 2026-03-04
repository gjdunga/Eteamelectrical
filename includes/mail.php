<?php
/**
 * Send an email using SMTP (PHPMailer) if available, or PHP mail() as fallback.
 *
 * To enable SMTP:
 *   1. Copy mail-config.sample.php to mail-config.php and fill in credentials
 *   2. Install PHPMailer: composer require phpmailer/phpmailer
 *      (or download and place in vendor/phpmailer/)
 *
 * Returns: ['success' => bool, 'message' => string]
 */
function eteam_send_mail(string $subject, string $body_html, string $reply_to_email = '', string $reply_to_name = ''): array
{
    $config_file = __DIR__ . '/../mail-config.php';

    // If no config, fall back to flat-file logging
    if (!file_exists($config_file)) {
        $entry = date('Y-m-d H:i:s') . " | " . strip_tags($body_html) . "\n";
        @file_put_contents(__DIR__ . '/../quote-requests.log', $entry, FILE_APPEND | LOCK_EX);
        return ['success' => true, 'message' => 'Logged (no mail config found).'];
    }

    $cfg = require $config_file;

    // Try PHPMailer first
    $phpmailer_paths = [
        __DIR__ . '/../vendor/autoload.php',
        __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php',
    ];

    $phpmailer_loaded = false;
    foreach ($phpmailer_paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            $phpmailer_loaded = true;
            break;
        }
    }

    if ($phpmailer_loaded && class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
        // SMTP via PHPMailer
        $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = $cfg['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $cfg['smtp_user'];
            $mail->Password   = $cfg['smtp_pass'];
            $mail->SMTPSecure = $cfg['smtp_secure'];
            $mail->Port       = $cfg['smtp_port'];

            $mail->setFrom($cfg['from_email'], $cfg['from_name']);
            $mail->addAddress($cfg['to_email'], $cfg['to_name'] ?? '');

            if ($reply_to_email) {
                $mail->addReplyTo($reply_to_email, $reply_to_name);
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body_html;
            $mail->AltBody = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $body_html));

            $mail->send();
            return ['success' => true, 'message' => 'Email sent.'];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => 'Mail error: ' . $mail->ErrorInfo];
        }
    }

    // Fallback: PHP mail()
    $headers  = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: " . $cfg['from_name'] . " <" . $cfg['from_email'] . ">\r\n";
    if ($reply_to_email) {
        $headers .= "Reply-To: " . $reply_to_name . " <" . $reply_to_email . ">\r\n";
    }

    $sent = @mail($cfg['to_email'], $subject, $body_html, $headers);
    if ($sent) {
        return ['success' => true, 'message' => 'Email sent via mail().'];
    }
    return ['success' => false, 'message' => 'PHP mail() failed. Check server config or install PHPMailer for SMTP.'];
}
