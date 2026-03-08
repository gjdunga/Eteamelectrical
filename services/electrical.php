<?php
$page_title = 'Electrical Services';
$base_path = '../';
include __DIR__ . '/../includes/header.php';
?>

<section class="section" style="padding-top:120px">
    <div class="container">
        <div class="section-label reveal">Services</div>
        <h1 class="section-title reveal reveal-delay-1">Electrical</h1>
        <p class="section-desc reveal reveal-delay-2">Master electrician on every job. Residential, light commercial, and industrial electrical work across Colorado.</p>

        <div class="service-detail reveal reveal-delay-3" style="margin-top:40px">
            <div class="about-grid">
                <div class="about-copy">
                    <h2 style="font-family:var(--display);font-size:1.5rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:16px">What We Handle</h2>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Panel Upgrades &amp; Replacements</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Outdated electrical panels are a leading cause of house fires and insurance claim denials. We replace Federal Pacific, Zinsco, and undersized panels with modern breaker boxes rated for today's loads. Every upgrade includes a full load calculation to make sure the new panel handles your current draw plus room for future additions like EV chargers or shop circuits.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Whole-House Rewiring</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Homes built before the 1970s often run on aluminum wiring or undersized copper that can't safely support modern appliances. We do full rewires with minimal wall damage, pulling new Romex through existing routes where possible and opening up only where necessary. All work is inspected and permitted.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">New Circuits &amp; Dedicated Lines</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Adding a hot tub, workshop, or kitchen appliance that trips the breaker? We run dedicated circuits sized correctly for the equipment, with proper wire gauge, breaker rating, and grounding. GFCI and AFCI protection installed where code requires it.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Lighting &amp; Fixture Installation</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Interior and exterior lighting design and installation, including recessed cans, under-cabinet LEDs, landscape lighting, security floods, ceiling fans, and decorative fixtures. We also install smart switches, dimmers, and timer systems.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Troubleshooting &amp; Repairs</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Flickering lights, dead outlets, tripping breakers, buzzing sounds, and burnt smells are all signs of electrical issues that shouldn't wait. We diagnose the root cause, not just the symptom, and fix it to code.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Code Corrections &amp; Inspection Prep</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Buying or selling a home and the inspection turned up electrical issues? We correct code violations, replace ungrounded outlets, install missing junction box covers, and bring your system up to current NEC standards.</p>
                </div>

                <div class="credential-list" style="align-self:start;position:sticky;top:100px">
                    <div class="credential">
                        <div class="credential-icon">&#9889;</div>
                        <div class="credential-text">Master Electrician</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#128196;</div>
                        <div class="credential-text">Permitted &amp; Inspected</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#127968;</div>
                        <div class="credential-text">Residential &amp; Light Commercial</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#127967;</div>
                        <div class="credential-text">Serving All of Colorado</div>
                    </div>

                    <div style="margin-top:20px">
                        <a class="btn btn-fill" href="<?php echo $base; ?>index.php#contact">Get a Quote</a>
                    </div>
                    <div style="margin-top:8px">
                        <a class="btn btn-outline" href="<?php echo $base; ?>gallery.php">See Our Work</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-inner">
        <div class="cta-text">Need electrical work?</div>
        <a class="btn btn-inv" href="<?php echo $base; ?>index.php#contact">Get an Estimate</a>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
