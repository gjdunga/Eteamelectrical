# E Team Electrical

Static PHP website for E Team Electrical: journeyman electrician, general contractor, and handyman serving all of Colorado.

## Structure

```
index.php              Homepage: hero, services, credentials, gallery preview, contact form
gallery.php            Full photo/video gallery with slideshow header, filters, lightbox
reviews.php            Customer reviews with star ratings (flat-file JSON storage)
includes/
  header.php           Shared header with sticky nav
  footer.php           Shared footer
  mail.php             Email sending helper (SMTP via PHPMailer or PHP mail() fallback)
assets/
  css/main.css         Full site stylesheet (dark industrial theme)
  js/main.js           Mobile nav toggle
  img/                 Trade images, headers, SVG logo
photos/                Project photos organized by category (13 folders)
mail-config.sample.php SMTP configuration template
.htaccess              Apache config (caching, security, config protection)
```

## Setup

1. Upload to any PHP 7.4+ Apache host
2. Set write permissions on the web root for reviews.json and quote-requests.log
3. For SMTP email: copy mail-config.sample.php to mail-config.php, fill in credentials, and install PHPMailer via composer

```bash
cp mail-config.sample.php mail-config.php
# Edit mail-config.php with your SMTP settings
composer require phpmailer/phpmailer
```

Without PHPMailer, the contact form falls back to PHP mail() if mail-config.php exists, or logs to a flat file if it does not.

## Adding Photos

Drop images or videos into any photos/ subdirectory. The gallery page scans the filesystem automatically.
