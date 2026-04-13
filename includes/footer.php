    </main>
    
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-main">
                <div class="footer-column footer-brand">
                    <div class="footer-logo">
                        <img src="/public/images/nrlogo.png" class="company-logo">
                        <div class="footer-logo-text">
                            <span class="logo-text-primary">NR</span>
                            <span class="logo-text-secondary">Intellitech Sdn Bhd</span>
                        </div>
                    </div>
                    <p class="footer-about">Driving digital transformation through innovative technology solutions since 2006.</p>
                    <div class="social-links">
                        <a href="https://wa.me/60123162006" 
                            aria-label="WhatsApp" 
                            class="social-link" 
                            target="_blank" 
                            rel="noopener noreferrer">
                            <i class="fab fa-whatsapp"></i>
                            <span class="social-tooltip">WhatsApp</span>
                        </a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3 class="footer-heading">
                        <span class="heading-icon"><i class="fas fa-cog"></i></span>
                        <span>Our Services</span>
                    </h3>
                    <ul class="footer-links">
                        <li><a href="services.php#data" class="footer-link"><span class="link-icon"><i class="fas fa-shield-alt"></i></span> Secure Data Destruction</a></li>
                        <li><a href="services.php#logistic" class="footer-link"><span class="link-icon"><i class="fas fa-globe"></i></span> IT Assets Handling & Logistics</a></li>
                        <li><a href="services.php#reporting" class="footer-link"><span class="link-icon"><i class="fas fa-phone-alt"></i></span> Compliance & Reporting</a></li>
                        <li><a href="services.php#ecommerce" class="footer-link"><span class="link-icon"><i class="fas fa-bullseye"></i></span>E-Commerce</a></li>
                    </ul>
                </div>
                
                <div class="footer-column footer-contact">
                    <h3 class="footer-heading">
                        <span class="heading-icon"><i class="fas fa-envelope"></i></span>
                        <span>Contact Us</span>
                    </h3>
                    <ul class="contact-info">
                        <li>
                            <i class="fas fa-map-marker-alt contact-icon"></i>
                            <address>Lot #5.34, 5th floor, Imbi plaza, 28 Jalan Imbi, 55100 Kuala Lumpur, Malaysia</address>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt contact-icon"></i>
                            <a href="tel:+60321453006" class="contact-link">(+60)3 2145 3006</a><br>
                            <a href="tel:+60123162006" class="contact-link">(+60)12 316 2006</a>
                        </li>
                        <li>
                            <i class="fas fa-envelope contact-icon"></i>
                            <a href="mailto:nrintellitech@gmail.com" class="contact-link">nrintellitech@gmail.com</a>
                        </li>
                        <li>
                            <i class="fas fa-clock contact-icon"></i>
                            <span>Mon-Fri: 11:00 AM - 6:00 PM</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; <span id="current-year">2025</span> NR Intellitech. All rights reserved.</p>
                </div>
                <div class="back-to-top">
                    <a href="#main-header" class="back-to-top-link" aria-label="Back to top">
                        <i class="fas fa-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update current year in footer
        document.getElementById('current-year').textContent = new Date().getFullYear();
        
        // Back to top button functionality
        const backToTopBtn = document.querySelector('.back-to-top-link');
        if (backToTopBtn) {
            backToTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
        
        // Mobile menu toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mainNav = document.querySelector('.main-nav');
        
        if (mobileMenuToggle && mainNav) {
            mobileMenuToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                mainNav.classList.toggle('active');
                document.body.classList.toggle('no-scroll');
            });
        }
        
        // Close mobile menu when clicking on a link
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    mobileMenuToggle.classList.remove('active');
                    mainNav.classList.remove('active');
                    document.body.classList.remove('no-scroll');
                }
            });
        });
        
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    });
    </script>
    
    <?php if (isset($extra_js)) { echo $extra_js; } ?>
</body>
</html>