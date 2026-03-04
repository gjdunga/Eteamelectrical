<?php
// E Team Electrical mail configuration
// Copy this file to mail-config.php: cp mail-config.sample.php mail-config.php
//
// SMTP fields are optional. If left empty, PHP mail() is used (works on most hosts).
// For SMTP (more reliable), install PHPMailer: composer require phpmailer/phpmailer

return [
    // Where contact form emails are sent
    'to_email'    => 'Djstatzz@gmail.com',
    'to_name'     => 'E Team Electrical',

    // From address (should match your domain for deliverability)
    'from_email'  => 'contacts@eteamelectrical.com',
    'from_name'   => 'E Team Electrical Website',

    // SMTP settings (leave empty to use PHP mail() instead)
    'smtp_host'   => '',        // e.g. 'smtp.gmail.com' or 'mail.eteamelectrical.com'
    'smtp_port'   => 587,       // 587 for TLS, 465 for SSL
    'smtp_user'   => '',        // SMTP login
    'smtp_pass'   => '',        // SMTP password or app password
    'smtp_secure' => 'tls',     // 'tls' or 'ssl'
];
