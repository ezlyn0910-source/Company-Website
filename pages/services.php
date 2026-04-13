<?php
$page_title = "Our Services - NR Intellitech";
$extra_css = '
<link rel="stylesheet" href="/public/css/homepage.css">
<link rel="stylesheet" href="/public/css/services.css">
';
include 'includes/header.php';
?>

<!-- Services Hero Section -->
<section class="services-hero full-bleed">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Our Comprehensive Services</h1>
        <p class="subtitle">End-to-end solutions for secure data management and IT asset lifecycle</p>
        <div class="scroll-indicator">
            <span>Explore our services</span>
            <div class="arrow"></div>
        </div>
    </div>
</section>

<!-- Mobile Service Navigation - Updated -->
<div class="mobile-services-nav full-bleed">
    <div class="mobile-nav-container">
        <button class="mobile-nav-toggle" aria-label="Toggle services navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <div class="mobile-service-icons">
            <a href="#data-destruction" class="mobile-service-icon" data-service="data-destruction" aria-label="Data Destruction">
                <i class="fas fa-shield-alt"></i>
            </a>
            <a href="#cybersecurity" class="mobile-service-icon" data-service="cybersecurity" aria-label="Cybersecurity">
                <i class="fas fa-cloud"></i>
            </a>
            <a href="#it-assets" class="mobile-service-icon" data-service="it-assets" aria-label="IT Assets">
                <i class="fas fa-server"></i>
            </a>
            <a href="#compliance" class="mobile-service-icon" data-service="compliance" aria-label="Compliance">
                <i class="fas fa-file"></i>
            </a>
            <a href="#ecommerce" class="mobile-service-icon" data-service="ecommerce" aria-label="E-Commerce">
                <i class="fas fa-shopping-cart"></i>
            </a>
        </div>
        
        <div class="mobile-active-indicator"></div>
    </div>
</div>

<!-- Service Progress Indicator -->
<div class="service-progress full-bleed">
    <div class="progress-bar">
        <div class="progress-fill"></div>
    </div>
</div>

<!-- Services Navigation -->
<section class="services-nav full-bleed">
    <div class="container">
        <div class="service-links">
            <a href="#data-destruction" class="service-link" data-service="data-destruction">
                <i class="fas fa-shield-alt"></i> Data Destruction
            </a>
            <a href="#cybersecurity" class="service-link" data-service="cybersecurity">
                <i class="fas fa-cloud"></i> Cybersecurity
            </a>
            <a href="#it-assets" class="service-link" data-service="it-assets">
                <i class="fas fa-server"></i> IT Assets Handling
            </a>
            <a href="#compliance" class="service-link" data-service="compliance">
                <i class="fas fa-file"></i> Compliance
            </a>
            <a href="#ecommerce" class="service-link" data-service="ecommerce">
                <i class="fas fa-shopping-cart"></i> E-Commerce
            </a>
        </div>
    </div>
</section>

<!-- Data Destruction Section -->
<section id="data-destruction" class="service-section full-bleed" data-service="data-destruction">
    <div class="container">
        <div class="service-header">
            <span class="service-tag">Secure Data Management</span>
            <h2 class="service-title">Secure Data Destruction Services</h2>
            <p class="service-intro">Complete, certified destruction of your sensitive data across all media types with full chain-of-custody documentation.</p>
        </div>

        <div class="service-features">
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-hdd"></i>
                </div>
                <div class="feature-text">
                    <h3>Media Types We Handle</h3>
                    <p>Hard drives, SSDs, tapes, mobile devices, optical media, and all other data storage devices.</p>
                </div>
            </div>
            
            <div class="feature">
                <div class="feature-icon">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="feature-text">
                    <h3>Certified Methods</h3>
                    <p>All methods meet or exceed NIST 800-88, DoD 5220.22-M, and other international standards.</p>
                </div>
            </div>
        </div>
        
        <div class="service-details">
            <div class="service-image">
                <img src="/public/images/DDservice.jpg" alt="Secure data destruction process" loading="lazy">
            </div>
            
            <div class="service-content">
                <div class="service-methods">
                    <h3>Our Destruction Methods</h3>
                    <div class="methods-grid">
                        <div class="method-tabs">
                            <button class="method-tab active" data-method="erasure">
                                <span class="tab-number">1</span>
                                Data Erasure
                            </button>
                            <button class="method-tab" data-method="degaussing">
                                <span class="tab-number">2</span>
                                Degaussing
                            </button>
                            <button class="method-tab" data-method="drilling">
                                <span class="tab-number">3</span>
                                Hard Drive Drilling
                            </button>
                            <button class="method-tab" data-method="shredding">
                                <span class="tab-number">4</span>
                                Hard Drive Shredding
                            </button>
                        </div>
                        
                        <div class="method-content">
                            <div class="method-panel active" id="erasure">
                                <h4>Data Erasure</h4>
                                <p>Software-based overwriting that renders data unrecoverable while preserving hardware for reuse.</p>
                                <ul>
                                    <li>Supports all interface types (SATA, SAS, NVMe, etc.)</li>
                                    <li>Multiple pass options available</li>
                                    <li>Detailed reporting included</li>
                                </ul>
                            </div>
                            
                            <div class="method-panel" id="degaussing">
                                <h4>Degaussing</h4>
                                <p>Powerful magnetic field disruption that permanently destroys data on magnetic media.</p>
                                <ul>
                                    <li>Ideal for high-security requirements</li>
                                    <li>Renders drives inoperable</li>
                                    <li>Fast processing time</li>
                                </ul>
                            </div>
                            
                            <div class="method-panel" id="drilling">
                                <h4>Hard Drive Drilling</h4>
                                <p>Complete physical destruction through precise drilling of drive platters.</p>
                                <ul>
                                    <li>Visual verification of destruction</li>
                                    <li>Handles all media types</li>
                                    <li>Environmentally responsible recycling</li>
                                </ul>
                            </div>
                            
                            <div class="method-panel" id="shredding">
                                <h4>Hard Drive Shredding</h4>
                                <p>Industrial shredding that reduces drives to confetti-sized pieces for maximum security.</p>
                                <ul>
                                    <li>Ideal for high-security requirements</li>
                                    <li>Renders drives completely unrecoverable</li>
                                    <li>Fast processing time</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="service-benefits">
                    <h3>Key Benefits</h3>
                    <div class="benefits-list">
                        <div class="benefit">
                            <i class="fas fa-check-circle"></i>
                            <span>100% data destruction guarantee</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check-circle"></i>
                            <span>Compliance with global regulations (GDPR, HIPAA, etc.)</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check-circle"></i>
                            <span>Secure chain-of-custody tracking</span>
                        </div>
                        <div class="benefit">
                            <i class="fas fa-check-circle"></i>
                            <span>Environmentally responsible disposal</span>
                        </div>
                    </div>
                    
                    <a href="/contact" class="cta-button primary">
                        <i class="fas fa-envelope"></i> Request Data Destruction Quote
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cybersecurity Section -->
 <section id="cybersecurity" class=" service-section current-services full-bleed" data-service="cybersecurity">
    <div class="services-container">
        <div class="service-header">
            <span class="service-tag">Secure</span>
            <h2 class="service-title">Cybersecurity Services</h2>
            <p class="service-intro">Comprehensive cybersecurity solutions for the modern enterprise</p>
        </div>
        
        <!-- Interactive Service Visualization -->
        <div class="services-visualization">
            <div class="service-orbits">
                <div class="core-circle">
                    <div class="core-content">
                        <i class="fas fa-shield-alt"></i>
                        <h3>Cybersecurity<br>Solutions</h3>
                    </div>
                </div>
                
                <!-- Service Orbit 1 -->
                <div class="orbit orbit-1">
                    <div class="service-node" data-service="penetration">
                        <div class="node-icon">
                            <i class="fas fa-bug"></i>
                        </div>
                        <div class="node-tooltip">
                            <h4>Penetration Testing (Red Team Exercises)</h4>
                            <p>Simulating cyber attacks to identify vulnerabilities</p>
                        </div>
                    </div>
                </div>
                
                <!-- Service Orbit 2 -->
                <div class="orbit orbit-2">
                    <div class="service-node" data-service="sql">
                        <div class="node-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="node-tooltip">
                            <h4>SQL Injection & Web Application Security</h4>
                            <p>Preventing database vulnerabilities</p>
                        </div>
                    </div>
                    
                    <div class="service-node" data-service="api">
                        <div class="node-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <div class="node-tooltip">
                            <h4>Application & API Security</h4>
                            <p>Securing application interfaces</p>
                        </div>
                    </div>
                </div>
                
                <!-- Service Orbit 3 -->
                <div class="orbit orbit-3">
                    <div class="service-node" data-service="cloud">
                        <div class="node-icon">
                            <i class="fas fa-cloud"></i>
                        </div>
                        <div class="node-tooltip">
                            <h4>Cloud Security</h4>
                            <p>Protecting cloud infrastructure</p>
                        </div>
                    </div>
                    
                    <div class="service-node" data-service="data">
                        <div class="node-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="node-tooltip">
                            <h4>Data Protection & Compliance</h4>
                            <p>Ensuring regulatory compliance</p>
                        </div>
                    </div>
                    
                    <div class="service-node" data-service="training">
                        <div class="node-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="node-tooltip">
                            <h4>Security Awareness Training</h4>
                            <p>Employee awareness programs</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Service Details Panel -->
            <div class="service-details-panel">
                <div class="details-placeholder">
                    <i class="fas fa-mouse-pointer"></i>
                    <p>Select a service to learn more</p>
                </div>
                
                <div class="service-detail" data-service="penetration">
                    <h3>Penetration Testing (Red Team Exercises)</h3>
                    <p>Our red team exercises simulate real-world attacks to identify vulnerabilities in your systems before malicious actors can exploit them.</p>
                    <ul>
                        <li>Network penetration testing</li>
                        <li>Web application testing</li>
                        <li>Social engineering simulations</li>
                        <li>Physical security assessments</li>
                    </ul>
                </div>
                
                <div class="service-detail" data-service="sql">
                    <h3>SQL Injection & Web Application Security</h3>
                    <p>We identify and remediate SQL injection vulnerabilities that could expose your sensitive data to attackers.</p>
                    <ul>
                        <li>Vulnerability scanning</li>
                        <li>Code review and remediation</li>
                        <li>Web application firewalls</li>
                        <li>Continuous monitoring</li>
                    </ul>
                </div>
                
                <div class="service-detail" data-service="api">
                    <h3>Application & API Security</h3>
                    <p>Protect your applications and APIs from modern threats with our comprehensive security solutions.</p>
                    <ul>
                        <li>API security testing</li>
                        <li>Authentication mechanisms</li>
                        <li>Rate limiting implementation</li>
                        <li>Data encryption</li>
                    </ul>
                </div>
                
                <div class="service-detail" data-service="cloud">
                    <h3>Cloud Security</h3>
                    <p>Secure your cloud infrastructure across multiple platforms with our expert guidance and tools.</p>
                    <ul>
                        <li>Cloud configuration review</li>
                        <li>Identity and access management</li>
                        <li>Data encryption at rest and in transit</li>
                        <li>Compliance auditing</li>
                    </ul>
                </div>
                
                <div class="service-detail" data-service="data">
                    <h3>Data Protection & Compliance</h3>
                    <p>Ensure your data handling practices meet regulatory requirements and industry best practices.</p>
                    <ul>
                        <li>GDPR compliance</li>
                        <li>Data classification</li>
                        <li>Encryption strategies</li>
                        <li>Incident response planning</li>
                    </ul>
                </div>
                
                <div class="service-detail" data-service="training">
                    <h3>Security Awareness Training</h3>
                    <p>Educate your employees to recognize and respond to security threats effectively.</p>
                    <ul>
                        <li>Phishing simulation</li>
                        <li>Interactive training modules</li>
                        <li>Policy development</li>
                        <li>Progress tracking</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Mobile Services List (for smaller screens) -->
        <div class="mobile-services">
            <div class="service-accordion">
                <div class="accordion-item">
                    <button class="accordion-header">
                        <i class="fas fa-bug"></i>
                        <span>Penetration Testing</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <p>Our red team exercises simulate real-world attacks to identify vulnerabilities in your systems.</p>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <button class="accordion-header">
                        <i class="fas fa-database"></i>
                        <span>SQL Injection Protection</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <p>We identify and remediate SQL injection vulnerabilities that could expose your sensitive data.</p>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <button class="accordion-header">
                        <i class="fas fa-code"></i>
                        <span>Application & API Security</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <p>Protect your applications and APIs from modern threats with our comprehensive security solutions.</p>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <button class="accordion-header">
                        <i class="fas fa-cloud"></i>
                        <span>Cloud Security</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <p>Secure your cloud infrastructure across multiple platforms with our expert guidance.</p>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <button class="accordion-header">
                        <i class="fas fa-lock"></i>
                        <span>Data Protection & Compliance</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <p>Ensure your data handling practices meet regulatory requirements and industry best practices.</p>
                    </div>
                </div>
                
                <div class="accordion-item">
                    <button class="accordion-header">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Security Awareness Training</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content">
                        <p>Educate your employees to recognize and respond to security threats effectively.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- IT Assets Handling Section -->
<section id="it-assets" class="service-section full-bleed alt-bg" data-service="it-assets">
    <div class="container">
        <div class="service-header">
            <span class="service-tag">End-to-End Management</span>
            <h2 class="service-title">IT Assets Handling & Logistics</h2>
            <p class="service-intro">Comprehensive logistics solutions for the secure transport, processing, and disposition of your IT equipment.</p>
        </div>
        
        <div class="process-flow">
            <div class="flow-step">
                <div class="step-visual">
                    <div class="step-icon">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <div class="step-connector"></div>
                </div>
                <div class="step-content">
                    <h3>Secure Collection</h3>
                    <p>Secure pickup and transport using GPS-tracked vehicles with tamper-evident seals.</p>
                    <ul>
                        <li>Nationwide collection network</li>
                        <li>Flexible scheduling</li>
                        <li>Real-time tracking</li>
                    </ul>
                </div>
            </div>
            
            <div class="flow-step">
                <div class="step-visual">
                    <div class="step-icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="step-connector"></div>
                </div>
                <div class="step-content">
                    <h3>Inventory Management</h3>
                    <p>Detailed inventory management with barcode/RFID tracking and condition reporting.</p>
                    <ul>
                        <li>Serial number capture</li>
                        <li>Functional testing</li>
                        <li>Data-bearing identification</li>
                    </ul>
                </div>
            </div>
            
            <div class="flow-step">
                <div class="step-visual">
                    <div class="step-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="step-connector"></div>
                </div>
                <div class="step-content">
                    <h3>Processing & Evaluation</h3>
                    <p>Thorough assessment and processing of all assets for optimal disposition.</p>
                    <ul>
                        <li>Data sanitization verification</li>
                        <li>Asset grading and valuation</li>
                        <li>Remarketing potential assessment</li>
                    </ul>
                </div>
            </div>
            
            <div class="flow-step">
                <div class="step-visual">
                    <div class="step-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="step-connector"></div>
                </div>
                <div class="step-content">
                    <h3>Final Disposition</h3>
                    <p>Environmentally responsible recycling or value recovery through remarketing.</p>
                    <ul>
                        <li>Certified data destruction</li>
                        <li>Maximized ROI on residual value</li>
                        <li>Comprehensive reporting</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="service-specializations">
            <h3>Specialized Handling For:</h3>
            <div class="specialization-cards">
                <div class="specialization-card">
                    <div class="card-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h4>Data Center Decommissioning</h4>
                    <p>Full-service solutions for retiring data center equipment with minimal downtime.</p>
                </div>
                
                <div class="specialization-card">
                    <div class="card-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <h4>Employee Device Returns</h4>
                    <p>Secure collection and processing of end-of-lease or terminated employee devices.</p>
                </div>
                
                <div class="specialization-card">
                    <div class="card-icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <h4>Bulk IT Asset Disposition</h4>
                    <p>High-volume processing for corporate refresh cycles and facility closures.</p>
                </div>
            </div>
            
            <div class="cta-container">
                <a href="#compliance" class="cta-button secondary">
                    <i class="fas fa-file-alt"></i> View Compliance Details
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Compliance & Reporting Section -->
<section id="compliance" class="service-section compliance-section full-bleed" data-service="compliance">
    <div class="container">
        <div class="service-header">
            <span class="service-tag">Regulatory Assurance</span>
            <h2 class="service-title">Compliance & Reporting</h2>
            <p class="service-intro">Comprehensive documentation and audit support to meet your regulatory and internal compliance requirements.</p>
        </div>

        <div class="compliance-grid">
            <div class="compliance-standards">
                <h3>Standards We Meet</h3>
                <div class="standards-list">
                    <div class="standard">
                        <div class="standard-logo">
                            <img src="/public/images/nist.jpg" alt="NIST Logo" loading="lazy">
                        </div>
                        <div class="standard-details">
                            <h4>NIST 800-88</h4>
                            <p>Guidelines for Media Sanitization from the National Institute of Standards and Technology.</p>
                        </div>
                    </div>
                    
                    <div class="standard">
                        <div class="standard-logo">
                            <img src="/public/images/gdpr.jpg" alt="GDPR Logo" loading="lazy">
                        </div>
                        <div class="standard-details">
                            <h4>GDPR Compliance</h4>
                            <p>Meeting EU General Data Protection Regulation requirements for data erasure.</p>
                        </div>
                    </div>
                    
                    <div class="standard">
                        <div class="standard-logo">
                            <img src="/public/images/hipaa.png" alt="HIPAA Logo" loading="lazy">
                        </div>
                        <div class="standard-details">
                            <h4>HIPAA</h4>
                            <p>Health Insurance Portability and Accountability Act requirements for PHI destruction.</p>
                        </div>
                    </div>
                    
                    <div class="standard">
                        <div class="standard-logo">
                            <img src="/public/images/r2v3.png" alt="R2 Logo" loading="lazy">
                        </div>
                        <div class="standard-details">
                            <h4>R2v3 Certified</h4>
                            <p>Responsible Recycling practices for electronics with data security components.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="reporting-features">
                <h3>Our Reporting Capabilities</h3>
                <div class="reporting-cards">
                    <div class="reporting-card">
                        <div class="reporting-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h4>Certificates of Destruction</h4>
                        <p>Individually serialized certificates for each device processed, including method used and date/time of destruction.</p>
                    </div>
                    
                    <div class="reporting-card">
                        <div class="reporting-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h4>Chain of Custody</h4>
                        <p>Detailed tracking from collection through final disposition with personnel verification at each step.</p>
                    </div>
                    
                    <div class="reporting-card">
                        <div class="reporting-icon">
                            <i class="fas fa-recycle"></i>
                        </div>
                        <h4>Environmental Reporting</h4>
                        <p>Documentation of responsible recycling practices and waste stream management.</p>
                    </div>
                    
                    <div class="reporting-card">
                        <div class="reporting-icon">
                            <i class="fas fa-file-invoice-dollar"></i>
                        </div>
                        <h4>Remarketing Reports</h4>
                        <p>For assets selected for resale, complete accounting of sale proceeds and asset details.</p>
                    </div>
                </div>
                
            </div>
        </div>
        
       
    </div>
</section>

<!-- E-Commerce Section -->
<section id="ecommerce" class="service-section full-bleed alt-bg" data-service="ecommerce">
    <div class="containerecommerce">
        <div class="service-header">
            <span class="service-tag">Online Convenience</span>
            <h2 class="service-title">E-Commerce Platform</h2>
            <p class="service-intro">Our user-friendly online stores and bidding platform make it simple to purchase services, bid on IT equipment, and schedule pickups at your convenience.</p>
        </div>
        
        <div class="ecommerce-features">
            <div class="ecommerce-image">
                <img src="/public/images/ECservice.jpg" alt="E-Commerce Platform" loading="lazy">
                <div class="platform-badges">
                    <div class="badge">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Mobile Friendly</span>
                    </div>
                    <div class="badge">
                        <i class="fas fa-lock"></i>
                        <span>Secure Payments</span>
                    </div>
                </div>
            </div>
            
            <div class="ecommerce-details">
                <h3>Platform Features</h3>

                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <div class="feature-text">
                        <h4>NRIT Store</h4>
                        <p>Participate in live auctions for refurbished IT equipment and enterprise hardware at competitive prices.</p>
                    </div>
                </div>
                
                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Service Selection</h4>
                            <p>Choose from our full range of services including data destruction, equipment recycling, and certified reporting.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Scheduling</h4>
                            <p>Book pickup dates and times that work for your operations with real-time availability.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Instant Quotes</h4>
                            <p>Get real-time pricing based on your specific requirements and volume.</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Order Tracking</h4>
                            <p>Monitor your service requests from confirmation through completion.</p>
                        </div>
                    </div>
                </div>
                
                <div class="account-benefits">
                    <h4>Registered Account Benefits</h4>
                    <ul>
                        <li>Save frequently used service configurations</li>
                        <li>Access to order history and documentation</li>
                        <li>Volume pricing discounts</li>
                        <li>Dedicated account management</li>
                    </ul>
                </div>
                
                <!-- CTA Buttons -->
                <div class="ecommerce-cta">
                
                <a href="https://store.nr-it.com" target="_blank" class="cta-button bidding-website" aria-label="Open E-Commerce Bidding Website">
                    <span class="cta-icon"><i class="fas fa-gavel"></i></span>
                    <span class="cta-label">NRIT Store</span>
                </a>

                <a href="https://www.lazada.com.my/shop/nr-intellitech-sdn-bhd" target="_blank" class="cta-button lazada" aria-label="Open Lazada">
                    <span class="cta-icon"><img src="/public/images/lazada.png" alt="" loading="lazy"></span>
                    <span class="cta-label">Lazada</span>
                </a>

                <a href="https://shopee.com.my/nr_intellitech_sdn_bhd" target="_blank" class="cta-button shopee" aria-label="Open Shopee">
                    <span class="cta-icon"><img src="/public/images/shopee.png" alt="" loading="lazy"></span>
                    <span class="cta-label">Shopee</span>
                </a>

                <a href="https://www.carousell.com.my/" target="_blank" class="cta-button carousell" aria-label="Open Carousell">
                    <span class="cta-icon"><img src="/public/images/carousell.png" alt="" loading="lazy"></span>
                    <span class="cta-label">Carousell</span>
                </a>

                <a href="https://www.tiktok.com/@nr.intellitech?_r=1&_t=ZS-92rc6Cxoq4i" target="_blank" class="cta-button tiktok" aria-label="Open TikTok Shop">
                    <span class="cta-icon"><img src="/public/images/tiktok.jpg" alt="" loading="lazy"></span>
                    <span class="cta-label">TikTok</span>
                </a>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Service CTA Section -->
<section class="service1-cta-section full-bleed">
    <div class="containercta">
        <div class="home-cta-content">
            <h2>Not Sure Which Service You Need?</h2>
            <p>Our technology consultants can assess your requirements and recommend the optimal solution.</p>
            <div class="cta-buttons-primary">
                <a href="/contact" class="cta-button-primary">
                    <i class="fas fa-phone-alt"></i> Contact Our Team
                </a>
                <a href="/journey" class="cta-button secondary">
                    <i class="fas fa-building"></i> Learn About Our Company
                </a>
            </div>
        </div>
    </div>
</section>

<?php
$extra_js = '<script src="/public/js/services.js"></script>';
include 'includes/footer.php';
?>

