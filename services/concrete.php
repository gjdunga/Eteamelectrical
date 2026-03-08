<?php
$page_title = 'Concrete Services';
$base_path = '../';
include __DIR__ . '/../includes/header.php';
?>

<section class="section" style="padding-top:120px">
    <div class="container">
        <div class="section-label reveal">Services</div>
        <h1 class="section-title reveal reveal-delay-1">Concrete</h1>
        <p class="section-desc reveal reveal-delay-2">Foundations, flatwork, and retaining structures. Properly graded, correctly reinforced, and finished clean.</p>

        <div class="service-detail reveal reveal-delay-3" style="margin-top:40px">
            <div class="about-grid">
                <div class="about-copy">
                    <h2 style="font-family:var(--display);font-size:1.5rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:16px">What We Handle</h2>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Foundations</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Monolithic slabs, stem wall foundations, frost-protected shallow foundations, and garage slabs. We excavate to proper depth, compact the subgrade, install vapor barrier and rebar, and pour to spec. Colorado's expansive soils require careful attention to drainage and compaction, and we account for that on every pour.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Driveways &amp; Parking Areas</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">New pours and replacement of cracked, heaved, or spalling driveways. Proper subgrade prep with compacted road base, fiber mesh or rebar reinforcement, control joints at correct spacing, and broom or stamped finish. We also handle apron pours and curb cuts when needed.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Sidewalks &amp; Patios</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Residential and commercial sidewalks, walkways, patio slabs, and ADA-compliant ramps. Graded for proper drainage slope, scored with control joints, and finished to the texture you want. Stamped concrete and exposed aggregate available for decorative applications.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Retaining Walls</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Poured concrete retaining walls, block walls, and segmental retaining wall systems. Proper footing depth, drainage behind the wall with perforated pipe and gravel backfill, and weep holes to prevent hydrostatic pressure buildup. Engineered for the soil conditions and slope on your site.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Flatwork &amp; Slabs</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Shop floors, barn slabs, equipment pads, hot tub pads, and utility slabs. Sized and reinforced for the load they need to carry. We coordinate with electricians and plumbers (or handle it ourselves) for any conduit or plumbing that needs to be in the slab before the pour.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Concrete Repair</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Crack repair, spall patching, mudjacking, and partial slab replacement. Not every concrete problem requires a full tear-out. We assess the condition and recommend the most cost-effective repair that will last.</p>
                </div>

                <div class="credential-list" style="align-self:start;position:sticky;top:100px">
                    <div class="credential">
                        <div class="credential-icon">&#9638;</div>
                        <div class="credential-text">Foundations to Flatwork</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#128196;</div>
                        <div class="credential-text">Properly Reinforced</div>
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
        <div class="cta-text">Need concrete work?</div>
        <a class="btn btn-inv" href="<?php echo $base; ?>index.php#contact">Get an Estimate</a>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
