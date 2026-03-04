<?php
// SMTP Configuration for E Team Electrical contact form
// Copy this file to mail-config.php and fill in your SMTP credentials.
// Do NOT commit mail-config.php to git (it contains passwords).

return [
    'smtp_host'   => 'smtp.example.com',     // e.g. 'smtp.gmail.com', 'mail.yourdomain.com'
    'smtp_port'   => 587,                     // 587 for TLS, 465 for SSL
    'smtp_user'   => 'you@example.com',       // SMTP login username
    'smtp_pass'   => 'your-app-password',     // SMTP password or app-specific password
    'smtp_secure' => 'tls',                   // 'tls' or 'ssl'
    'from_email'  => 'noreply@eteamelectrical.com',
    'from_name'   => 'E Team Electrical Website',
    'to_email'    => 'your-email@example.com', // Where contact form submissions go
    'to_name'     => 'E Team Electrical',
];
