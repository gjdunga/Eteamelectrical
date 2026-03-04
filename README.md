# E Team Electrical

Static PHP website for E Team Electrical, a multi-trade remodel and construction crew.

## Structure

```
index.php          Home page with trade cards and quote form
gallery.php        Photo/video gallery with lightbox (reads from photos/)
reviews.php        Customer reviews with submission form (stores to reviews.json)
includes/
  header.php       Shared site header and nav
  footer.php       Shared site footer
assets/
  css/main.css     Full site stylesheet
  js/main.js       Mobile nav toggle
  img/             Trade images, headers, logo
photos/            Project photos organized by category
  AE/             Automotive & Equipment
  CIMSP/          Commercial / Industrial
  CLFSRP/         Concrete, Landscape & Foundation
  FHRBAP/         Framing, Handyman, Remodel & Build
.htaccess          Apache config (caching, security)
```

## Hosting Requirements

Any PHP 7.4+ host with Apache (mod_rewrite optional). No database required.
Reviews are stored as flat JSON. Quote requests are logged to a text file.

## Adding Photos

Drop images (jpg, png, webp) or videos (mp4, mov, webm) into the appropriate `photos/` subdirectory. The gallery page reads the filesystem automatically.
