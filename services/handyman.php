<?php
$page_title = 'Handyman Services';
$base_path = '../';
include __DIR__ . '/../includes/header.php';
?>

<section class="section" style="padding-top:120px">
    <div class="container">
        <div class="section-label reveal">Services</div>
        <h1 class="section-title reveal reveal-delay-1">Handyman</h1>
        <p class="section-desc reveal reveal-delay-2">No job too small. From a single shelf to a full punch list, we handle the fixes and improvements that keep your home or business running.</p>

        <div class="service-detail reveal reveal-delay-3" style="margin-top:40px">
            <div class="about-grid">
                <div class="about-copy">
                    <h2 style="font-family:var(--display);font-size:1.5rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:16px">What We Handle</h2>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Door &amp; Window Installation</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Interior and exterior door hanging, storm doors, sliding doors, and window replacements. We handle the framing adjustments, shimming, weatherstripping, and trim work for a clean, plumb installation that operates smoothly and seals tight.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Drywall Repair &amp; Patching</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Holes, cracks, water damage, nail pops, and failed tape joints. We cut out the damaged section, patch with proper backing, tape, mud, and sand to a smooth finish. Texture matching for popcorn, knockdown, orange peel, and smooth walls. Ready for paint when we leave.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Mounting &amp; Assembly</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">TV mounts, shelving, curtain rods, towel bars, grab bars, garage storage systems, basketball hoops, and furniture assembly. We locate studs, use the right anchors for the wall type, and make sure everything is level and secure.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Trim &amp; Finish Carpentry</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Baseboards, crown molding, window casings, door trim, wainscoting, and chair rail. Miter cuts, coped joints, and filled nail holes for a clean, professional finish. We also repair or replace damaged trim, stair rails, and balusters.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">General Repairs &amp; Maintenance</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Squeaky floors, sticking doors, loose handrails, broken hinges, damaged siding, gutter cleaning, caulking, weatherproofing, and all the small jobs that pile up. Bring us your list and we will work through it efficiently.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Painting &amp; Staining</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Interior and exterior painting, deck staining, fence staining, cabinet refinishing, and touch-up work. Proper prep including sanding, priming, caulking, and masking. Clean lines, even coats, and no paint on your carpet.</p>
                </div>

                <div class="credential-list" style="align-self:start;position:sticky;top:100px">
                    <div class="credential">
                        <div class="credential-icon">&#9874;</div>
                        <div class="credential-text">No Job Too Small</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#128196;</div>
                        <div class="credential-text">Punch Lists Welcome</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#127968;</div>
                        <div class="credential-text">Residential &amp; Commercial</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#127967;</div>
                        <div class="credential-text">Serving All of Colorado</div>
                    </div>
                    <div style="margin-top:20px"><a class="btn btn-fill" href="<?php echo $base; ?>index.php#contact">Get a Quote</a></div>
                    <div style="margin-top:8px"><a class="btn btn-outline" href="<?php echo $base; ?>gallery.php">See Our Work</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <div class="cta-text">Got a list of fixes?</div>
        <a class="btn btn-inv" href="<?php echo $base; ?>index.php#contact">Get an Estimate</a>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
