<?php
$page_title = "Contact - NR Intellitech";
$extra_css = '<link rel="stylesheet" href="/public/css/contact.css">';
include 'includes/header.php';
?>

<!-- Contact Hero Section -->
<section class="contact-hero full-bleed">
    <div class="hero-overlay"></div>

    <!-- Animated shapes background -->
    <div class="shape-container">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>

    <div class="hero-content">
        <h1>Stay Connected With Us</h1>
        <p class="subtitle">Our team of engineers will be pleased to find the optimal solution for your needs.</p>
        
        <div class="scroll-indicator">
            <span>Scroll to explore</span>
            <div class="arrow"></div>
        </div>
    </div>
</section>

<!-- Contact Main Section -->
<section class="contact-main full-bleed">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info Card -->
            <div class="contact-info">
                <div class="info-card">
                    <h2>Get in Touch</h2>
                    <p>Have questions about our services or want to discuss a project? Reach out to our team.</p>
                    
                    <div class="contact-method">
                        <div class="icon-circle">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Our Office</h3>
                            <p>Lot #5.34, 5th floor, Imbi plaza, 28 Jalan Imbi, 55100<br>Kuala Lumpur, Malaysia</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="icon-circle">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Phone</h3>
                            <p>(+60)3 2145 3006</p>
                            <p>(+60)12 316 2006</p>
                            <p>Mon-Fri: 11:00 AM - 6:00 PM </p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="icon-circle">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Email</h3>
                            <p>nrintellitect@gmail.com</p>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <a href="https://wa.me/60123162006" aria-label="Whatsapp">
                            <i class="fab fa-whatsapp"></i></a>

                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                <form id="contactForm" action="process_contact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name*</label>
                        <input type="text" id="name" name="name" required>
                        <span class="input-focus"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address*</label>
                        <input type="email" id="email" name="email" required>
                        <span class="input-focus"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone">
                        <span class="input-focus"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject*</label>
                        <div class="custom-select">
                            <select id="subject" name="subject" required>
                                <option value="" disabled selected>Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="sales">Sales Questions</option>
                                <option value="support">Technical Support</option>
                                <option value="partnership">Partnership Opportunities</option>
                                <option value="careers">Careers</option>
                            </select>
                            <span class="select-arrow"></span>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message*</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                        <span class="input-focus"></span>
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <span class="btn-text">Send Message</span>
                        <div class="btn-loader">
                            <div class="loader"></div>
                        </div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section full-bleed">
    <div class="container">
        <span class="section-eyebrow">Map</span>
        <h2 class="section-title">Our Location</h2>
        <p class="section-note">Find us at the heart of the city</p>

        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.0595413709083!2d101.7094625758513!3d3.143913596800193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc37d070fbfc19%3A0x4db3762c508d57f4!2sImbi%20Plaza!5e0!3m2!1sen!2smy!4v1691668457396!5m2!1sen!2smy" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<!-- Company Photos Section -->
<section class="gallery-section full-bleed">
    <div class="container">
        <span class="section-eyebrow">Place</span>
        <h2 class="section-title">Our Workplace</h2>
        <p class="section-note">A glimpse into our innovative work environment</p>
        
        <div class="gallery-grid">
            <div class="gallery-item">
                <img src="/public/images/plazaimbi.webp" alt="Office Building">
                <div class="overlay">
                    <p>Plaza Imbi</p>
                </div>
            </div>
            <div class="gallery-item">
                <img src="/public/images/nr.jpg" alt="Front Office">
                <div class="overlay">
                    <p>NR Intellitect Office</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Floating Action Button for Mobile -->
<div class="fab-container">
    <button class="fab-button">
        <i class="fas fa-comment-alt"></i>
    </button>
    <div class="fab-options">
        <a href="tel:+60321453006" class="fab-option" aria-label="Call">
            <i class="fas fa-phone"></i>
        </a>
        <a href="https://wa.me/60123162006" class="fab-option" aria-label="WhatsApp">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="mailto:nrintellitect@gmail.com" class="fab-option" aria-label="Email">
            <i class="fas fa-envelope"></i>
        </a>
    </div>
</div>

<?php
$extra_js = '<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="/public/js/contact.js"></script>';
include 'includes/footer.php';
?>