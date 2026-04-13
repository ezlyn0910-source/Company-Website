<?php
$page_title = "Home - NR Intellitech";
$extra_css = '
<link rel="stylesheet" href="/public/css/homepage.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/ScrollTrigger.min.js"></script>
';
include 'includes/header.php';
?>

<section class="hero full-bleed" id="home">
    <div class="particles" id="particles-js"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="hero-text">
            <h1>
                <span class="title-line">Secure Data <span class="highlight"></span>for a Safer</span>
                <span class="title-line">Greener <span class="highlight"></span>Future</span>
            </h1>
            <p class="subtitle">Empowering businesses through innovative digital transformation and cutting-edge technology consulting since 2006.</p>
            <div class="cta-container">
                <a href="/contact" class="cta-button primary">
                    <i class="fas fa-arrow-right"></i> Get Started
                </a>
                <a href="/services" class="cta-button secondary">
                    <i class="fas fa-search"></i> Explore Services
                </a>
            </div>
        </div>
    </div>

    <!-- Animated Scroll Indicator -->
    <div class="scroll-indicator">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
        <div class="arrow-down"></div>
    </div>
</section>

<section class="home-keyword full-bleed">
    <div class="container">
        <div class="keyword-track">
            <div class="keyword-marquee">
                <span class="highlight">Cybersecurity </span> that keeps your data safe &nbsp; • &nbsp;
                <span class="highlight">Data Management </span> that streamlines your business &nbsp; • &nbsp;
                <span class="highlight">IT Solutions </span> tailored for your growth &nbsp; • &nbsp;
                <span class="highlight">Innovation </span> that drives efficiency &nbsp; • &nbsp;
                <span class="highlight">Reliability </span> you can count on &nbsp; • &nbsp;
            </div>
            <div class="keyword-marquee" aria-hidden="true">
                <span class="highlight">Cybersecurity</span> that keeps your data safe &nbsp; • &nbsp;
                <span class="highlight">Data Management</span> that streamlines your business &nbsp; • &nbsp;
                <span class="highlight">IT Solutions</span> tailored for your growth &nbsp; • &nbsp;
                <span class="highlight">Innovation</span> that drives efficiency &nbsp; • &nbsp;
                <span class="highlight">Reliability</span> you can count on &nbsp; • &nbsp;
            </div>
        </div>
    </div>
</section>

<!-- Services Preview Section with 3D Cards -->
<section class="home-services full-bleed" id="services">
    <div class="container">
        <header class="home-section-header aesthetic">
            <span class="section-eyebrow">Our Expertise</span>
            <h2 class="section-title">Strategic Services</h2>
            <p class="section-note">Comprehensive technology solutions designed to drive your business forward in the digital age.</p>
        </header>

        <div class="home-services-grid">
            <!-- Card 1 -->
            <article class="home-service-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="home-service-icon">
                            <img src="/public/images/datadestruction.jpg" alt="Data Destruction" class="service-image" loading="lazy">
                        </div>
                        <div class="home-service-content">
                            <h3>Secure Data Destruction</h3>
                            <p>Complete, irreversible elimination of your sensitive information, aligned to international standards and compliance.</p>
                            <span class="flip-indicator">Hover to learn more</span>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="back-content">
                            <h4>Key Services</h4>
                            <ul>
                                <li>Data Erasure</li>
                                <li>Degaussing</li>
                                <li>Hard Drive Drilling</li>
                                <li>Hard Drive Shredding</li>
                            </ul>
                            <a href="/services#data-destruction" class="home-service-link">
                                Learn more <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            
            <!-- Card 2 -->
            <article class="home-service-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="home-service-icon">
                            <img src="/public/images/logistic.jpg" alt="IT Assets Handling & Logistics" class="service-image" loading="lazy">
                        </div>
                        <div class="home-service-content">
                            <h3>IT Assets Handling & Logistics</h3>
                            <p>From collection to final processing, we manage your IT assets with care, security, and operational efficiency.</p>
                            <span class="flip-indicator">Hover to learn more</span>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="back-content">
                            <h4>Key Services</h4>
                            <ul>
                                <li>Secure Logistics</li>
                                <li>Asset Decommissioning</li>
                            </ul>
                            <a href="/services#it-assets" class="home-service-link">
                                Learn more <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Card 3 -->
            <article class="home-service-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="home-service-icon">
                            <img src="/public/images/reporting.jpg" alt="Compliance & Reporting" class="service-image" loading="lazy">
                        </div>
                        <div class="home-service-content">
                            <h3>Compliance & Reporting</h3>
                            <p>Full transparency and documentation to support your regulatory needs and audits.</p>
                            <span class="flip-indicator">Hover to learn more</span>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="back-content">
                            <h4>Key Services</h4>
                            <ul>
                                <li>Certified Reporting</li>
                                <li>Premium Support</li>
                            </ul>
                            <a href="/services#compliance" class="home-service-link">
                                Learn more <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Card 4 -->
            <article class="home-service-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="home-service-icon">
                            <img src="/public/images/ecommerce.jpg" alt="E-Commerce" class="service-image" loading="lazy">
                        </div>
                        <div class="home-service-content">
                            <h3>E‑Commerce</h3>
                            <p>Browse, purchase, and arrange services at your convenience via our online channels.</p>
                            <span class="flip-indicator">Hover to learn more</span>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="back-content">
                            <h4>Key Services</h4>
                            <ul>
                                <li>Shopee</li>
                                <li>Lazada</li>
                                <li>Carousell</li>
                                <li>TikTok</li>
                                <li>NR IT Store</li>
                            </ul>
                            <a href="/services#ecommerce" class="home-service-link">
                                Learn more <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Card 5 -->
            <article class="home-service-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="home-service-icon">
                            <img src="/public/images/ecommercebid.jpeg" alt="E-Commercebid" class="service-image" loading="lazy">
                        </div>
                        <div class="home-service-content">
                            <h3>NR IT Store Website</h3>
                            <p>Purchase NR IT products easily through our official e-commerce website</p>
                            <span class="flip-indicator">Hover to learn more</span>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="back-content">
                            <h4>Key Services</h4>
                            <ul>
                                <li>store.nr-it.com</li>
                            </ul>
                            <a href="/services#ecommerce" class="home-service-link">
                                Learn more <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>


            <!-- Card 6 -->
            <article class="home-service-card">
                <div class="card-inner">
                    <div class="card-front">
                        <div class="home-service-icon">
                            <img src="/public/images/cybersecurity.jpg" alt="Cybersecurity" class="service-image" loading="lazy">
                        </div>
                        <div class="home-service-content">
                            <h3>Cybersecurity</h3>
                            <p>Proactive protection: detection, response, and compliance—built for your risk profile.</p>
                            <span class="flip-indicator">Hover to learn more</span>
                        </div>
                    </div>
                    <div class="card-back">
                        <div class="back-content">
                            <h4>Key Services</h4>
                            <ul>
                                <li>Managed Security Services (MSSP)</li>
                                <li>Cloud Security for SMEs</li>
                                <li>Phishing & Social Engineering Protection</li>
                                <li>Website & Application Protection</li>
                                <li>Penetration Testing & Red Teaming</li>
                                <li>Application & API Security</li>
                                <li>Data Security & Encryption Solutions</li>
                            </ul>
                            <a href="/services#cybersecurity" class="home-service-link">
                                Learn more <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- VstarSSD Banner Section -->
<section class="vstar-banner full-bleed">
    <div class="container">
        <div class="vstar-content">
            <div class="vstar-text">
                <span class="vstar-subtitle">Our Premium Hardware</span>
                <h2 class="vstar-title">VstarSSD — Enterprise Grade Storage Solutions</h2>
                <p class="vstar-description">Discover our in‑house line of high‑performance, reliable SSD drives designed for enterprise environments and demanding workloads.</p>
                <div class="vstar-button-container">
                    <a href="https://vstarssd.com" target="_blank" class="vstar-cta-button" rel="noopener">
                        <span class="vstar-button-content">
                            <span class="vstar-button-icon"><i class="fas fa-external-link-alt"></i></span>
                            <span class="vstar-button-text">
                                <span class="vstar-button-main">Explore VstarSSD</span>
                                <span class="vstar-button-sub">Enterprise Storage Solutions</span>
                            </span>
                        </span>
                        <span class="vstar-button-hover-effect"></span>
                    </a>
                </div>
            </div>
            <div class="vstar-image">
                <img src="/public/images/vstar_harddrive.jpg" alt="VstarSSD Enterprise Drives" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- E-Commerce Bidding Platform Section -->
<section class="ecommerce-bidding full-bleed" id="ecommerce" style=" display: block; padding: 50px 0;">
    <div class="container">
        <div class="ecommerce-content">
            <div class="ecommerce-text">
                <span class="ecommerce-subtitle">Online Marketplace</span>
                <h2 class="ecommerce-title">Bid & Buy IT Equipment on Our E‑Commerce Platform</h2>
                <p class="ecommerce-description">Discover great deals on refurbished IT hardware, enterprise equipment, and more through our bidding system. Get quality products at competitive prices with transparent bidding process.</p>
                
                <div class="ecommerce-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Live Bidding System</h4>
                            <p>Real-time bidding on IT equipment with automatic bid increments and notifications.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Secure Transactions</h4>
                            <p>Protected payments and verified sellers ensure safe and reliable purchases.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Nationwide Delivery</h4>
                            <p>We handle logistics and delivery across Malaysia with tracking and insurance.</p>
                        </div>
                    </div>
                </div>
                
                <div class="ecommerce-button-container">
                    <a href="https://store.nr-it.com" target="_blank" class="ecommerce-cta-button" rel="noopener">
                        <span class="ecommerce-button-content">
                            <span class="ecommerce-button-icon"><i class="fas fa-store"></i></span>
                            <span class="ecommerce-button-text">
                                <span class="ecommerce-button-main">Visit Our Store</span>
                                <span class="ecommerce-button-sub">store.nr-it.com</span>
                            </span>
                        </span>
                        <span class="ecommerce-button-hover-effect"></span>
                    </a>
                </div>
            </div>
            <div class="ecommerce-image">
                <div class="image-frame">
                    <img src="/public/images/ecommerce-dashboard.jpeg" alt="NR-IT E-Commerce Bidding Platform" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section with Asymmetric Layout -->
<section class="home-why-choose-us full-bleed">
    <div class="container">
        <header class="home-section-header aesthetic">
            <span class="section-eyebrow">Credibility</span>
            <h2 class="section-title">Why Choose Us</h2>
            <p class="section-note">Genuine products, transparent pricing, and engineers who show up when you need them.</p>
        </header>

        <div class="home-why-choose-us-grid">
            <article class="home-why-choose-us-card">
                <div class="home-why-choose-us-quote" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M6 17h3l2-4V7H5v6h3z"/></svg>
                </div>
                <p class="home-why-choose-us-title">Secure & User‑Friendly Solutions</p>
                <p class="home-why-choose-us-content">Industry‑leading security measures integrated with streamlined processes. Protect data without slowing your teams.</p>
            </article>

            <article class="home-why-choose-us-card">
                <div class="home-why-choose-us-quote" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M6 17h3l2-4V7H5v6h3z"/></svg>
                </div>
                <p class="home-why-choose-us-title">Consistent Quality</p>
                <p class="home-why-choose-us-content">Stringent QA, skilled personnel, and proven methods—so you get dependable, repeatable outcomes.</p>
            </article>

            <article class="home-why-choose-us-card">
                <div class="home-why-choose-us-quote" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M6 17h3l2-4V7H5v6h3z"/></svg>
                </div>
                <p class="home-why-choose-us-title">Tailored to Your Business</p>
                <p class="home-why-choose-us-content">Services adaptable to your operational, regulatory, and strategic context—not one‑size‑fits‑all.</p>
            </article>
        </div>
    </div>
</section>

<!-- Partners Section with Logo Carousel -->
<section class="home-partners full-bleed">
    <div class="container">
        <header class="home-section-header aesthetic">
            <span class="section-eyebrow">Highlight</span>
            <h2 class="section-title">Our Partners</h2>
            <p class="section-note">Backed by trusted global partners, we provide genuine products, competitive pricing, and responsive Malaysian support.</p>
        </header>

        <div class="home-client-logos full-bleed">
            <div class="home-logo-slide">
                <!-- First set of logos -->
                <div class="logo-item"><img src="/public/images/ziperaselogo.png" alt="Ziperase" loading="lazy"><div class="logo-overlay"><span>Ziperase</span></div></div>
                <div class="logo-item"><img src="/public/images/WDlogo.png" alt="Western Digital" loading="lazy"><div class="logo-overlay"><span>Western Digital</span></div></div>
                <div class="logo-item"><img src="/public/images/blanccologo.jpg" alt="Blancco" loading="lazy"><div class="logo-overlay"><span>Blancco</span></div></div>
                <div class="logo-item"><img src="/public/images/mdtlogo.jpg" alt="MDT" loading="lazy"><div class="logo-overlay"><span>MDT</span></div></div>
                <div class="logo-item"><img src="/public/images/AClogo.png" alt="Alibaba Cloud" loading="lazy"><div class="logo-overlay"><span>Alibaba Cloud</span></div></div>
                <div class="logo-item"><img src="/public/images/adobelogo.webp" alt="Adobe" loading="lazy"><div class="logo-overlay"><span>Adobe</span></div></div>

                <!-- Duplicate set for seamless looping -->
                <div class="logo-item"><img src="/public/images/ziperaselogo.png" alt="Ziperase" loading="lazy"><div class="logo-overlay"><span>Ziperase</span></div></div>
                <div class="logo-item"><img src="/public/images/WDlogo.png" alt="Western Digital" loading="lazy"><div class="logo-overlay"><span>Western Digital</span></div></div>
                <div class="logo-item"><img src="/public/images/blanccologo.jpg" alt="Blancco" loading="lazy"><div class="logo-overlay"><span>Blancco</span></div></div>
                <div class="logo-item"><img src="/public/images/mdtlogo.jpg" alt="MDT" loading="lazy"><div class="logo-overlay"><span>MDT</span></div></div>
                <div class="logo-item"><img src="/public/images/AClogo.png" alt="Alibaba Cloud" loading="lazy"><div class="logo-overlay"><span>Alibaba Cloud</span></div></div>
                <div class="logo-item"><img src="/public/images/adobelogo.webp" alt="Adobe" loading="lazy"><div class="logo-overlay"><span>Adobe</span></div></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section with Parallax Background -->
<section class="home-cta-section full-bleed">
    <div class="home-parallax-overlay" aria-hidden="true"></div>
    <div class="container">
        <div class="home-cta-content">
            <h2>Ready to Innovate With Us?</h2>
            <p>Schedule a meeting with our experts to discuss your technology needs and discover how we can help you achieve your goals.</p>
            <a href="/contact" class="cta-button primary">
                <i class="fas fa-calendar-check"></i> Get In Touch
            </a>
        </div>
    </div>
</section>

<?php
$extra_js = '
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="/public/js/homepage.js"></script>
';
include 'includes/footer.php';
?>