<?php
$page_title = 'Plumbing Services';
$base_path = '../';
include __DIR__ . '/../includes/header.php';
?>

<section class="section" style="padding-top:120px">
    <div class="container">
        <div class="section-label reveal">Services</div>
        <h1 class="section-title reveal reveal-delay-1">Plumbing</h1>
        <p class="section-desc reveal reveal-delay-2">Fixture installs, pipe repair, water heaters, and rough-in work for new construction and remodels.</p>

        <div class="service-detail reveal reveal-delay-3" style="margin-top:40px">
            <div class="about-grid">
                <div class="about-copy">
                    <h2 style="font-family:var(--display);font-size:1.5rem;letter-spacing:2px;text-transform:uppercase;margin-bottom:16px">What We Handle</h2>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Fixture Installation</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Sinks, faucets, toilets, showers, bathtubs, garbage disposals, dishwashers, and washing machine hookups. We handle the supply lines, drain connections, shut-off valves, and any modifications to the existing plumbing to accommodate the new fixture. Old fixtures removed and disposed of.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Water Heater Installation &amp; Repair</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Tank and tankless water heater installation, replacement, and repair. We size the unit correctly for your household demand, handle the plumbing connections, gas line or electrical hookup, venting, expansion tank, and T&P valve discharge. We also service and flush existing units to extend their lifespan.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Pipe Repair &amp; Replacement</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Leaking pipes, burst pipes, corroded galvanized lines, and polybutylene replacement. We repair or re-pipe with PEX, copper, or CPVC depending on the application and code requirements. We locate the leak, make the repair, test the system, and patch any drywall or flooring we opened up to access it.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Drain Cleaning &amp; Repair</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Slow drains, clogged drains, and sewer line issues. We snake drains, hydro-jet when needed, and repair or replace damaged drain lines. For recurring problems we investigate the root cause, whether it's tree roots, bellied pipe, or improper slope, and fix the underlying issue.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Rough-In Plumbing</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">New construction and remodel rough-in for kitchens, bathrooms, laundry rooms, wet bars, and utility sinks. We run supply lines, install drain/waste/vent piping, set toilet flanges, and stub out for fixtures. Coordinated with the framing and electrical so everything lands in the right place.</p>

                    <h3 style="font-family:var(--display);font-size:1.1rem;letter-spacing:1px;text-transform:uppercase;margin:20px 0 8px;color:var(--orange)">Gas Line Work</h3>
                    <p style="color:var(--text-light);margin-bottom:12px">Gas line installation and repair for ranges, dryers, fireplaces, outdoor grills, and garage heaters. We size the line for the BTU demand, run black iron or CSST as appropriate, pressure test the system, and verify no leaks before turning on the gas.</p>
                </div>

                <div class="credential-list" style="align-self:start;position:sticky;top:100px">
                    <div class="credential">
                        <div class="credential-icon">&#9883;</div>
                        <div class="credential-text">Full Plumbing Services</div>
                    </div>
                    <div class="credential">
                        <div class="credential-icon">&#128196;</div>
                        <div class="credential-text">Permitted &amp; Inspected</div>
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
        <div class="cta-text">Need plumbing work?</div>
        <a class="btn btn-inv" href="<?php echo $base; ?>index.php#contact">Get an Estimate</a>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
