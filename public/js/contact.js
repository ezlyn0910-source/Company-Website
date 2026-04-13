// Enhanced Contact Page JavaScript
class ContactPage {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.setupAnimations();
        this.setupFormValidation();
        this.setupIntersectionObserver();
        this.setupGallery();
        this.setupFAQ();
    }

    setupEventListeners() {
        // Scroll to contact form
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            scrollIndicator.addEventListener('click', () => {
                this.scrollToSection('contact-form-section');
            });
        }

        // Form submission
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }

        // Input focus effects
        this.setupInputEffects();

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', (e) => this.formatPhoneNumber(e));
        }
    }

    setupAnimations() {
        // Animate elements on scroll
        this.animateOnScroll();

        // Floating shapes animation
        this.animateFloatingShapes();

        // Gradient orbs animation
        this.animateGradientOrbs();
    }

    setupFormValidation() {
        const form = document.getElementById('contactForm');
        const inputs = form.querySelectorAll('input, textarea, select');

        inputs.forEach(input => {
            input.addEventListener('blur', () => this.validateField(input));
            input.addEventListener('input', () => this.clearFieldError(input));
        });
    }

    setupIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        const animateElements = document.querySelectorAll('.contact-method, .form-group, .gallery-item, .faq-item');
        animateElements.forEach(el => observer.observe(el));
    }

    setupInputEffects() {
        const inputs = document.querySelectorAll('.input-container input, .textarea-container textarea, .select-container select');
        
        inputs.forEach(input => {
            // Add focus class
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('focused');
            });

            input.addEventListener('blur', () => {
                if (!input.value) {
                    input.parentElement.classList.remove('focused');
                }
            });

            // Check initial value
            if (input.value) {
                input.parentElement.classList.add('focused');
            }
        });
    }

    setupGallery() {
        const viewButtons = document.querySelectorAll('.view-btn');
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = lightbox.querySelector('.lightbox-image');
        const lightboxCaption = lightbox.querySelector('.lightbox-caption');
        const lightboxClose = lightbox.querySelector('.lightbox-close');

        viewButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const card = button.closest('.gallery-card');
                const image = card.querySelector('img');
                
                if (image && image.src) {
                    lightboxImage.src = image.src;
                    lightboxImage.alt = image.alt;
                    lightboxCaption.textContent = card.querySelector('h3').textContent;
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            });
        });

        // Close lightbox
        lightboxClose.addEventListener('click', () => this.closeLightbox());
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                this.closeLightbox();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                this.closeLightbox();
            }
        });
    }

    setupFAQ() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                // Close other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });

                // Toggle current item
                item.classList.toggle('active');

                // Update ARIA attributes
                const isExpanded = item.classList.contains('active');
                question.setAttribute('aria-expanded', isExpanded);
                
                // Animate toggle icon
                const toggleIcon = question.querySelector('.faq-toggle i');
                if (isExpanded) {
                    toggleIcon.classList.remove('fa-plus');
                    toggleIcon.classList.add('fa-minus');
                } else {
                    toggleIcon.classList.remove('fa-minus');
                    toggleIcon.classList.add('fa-plus');
                }
            });

            // Keyboard support
            question.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    question.click();
                }
            });
        });
    }

    scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section) {
            section.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    }

    async handleFormSubmit(e) {
        e.preventDefault();
        
        const form = e.target;
        const submitBtn = form.querySelector('.submit-btn');
        const formData = new FormData(form);

        // Validate all fields
        const isValid = this.validateForm(form);
        if (!isValid) return;

        // Show loading state
        this.setFormLoading(submitBtn, true);

        try {
            // Simulate API call - replace with actual endpoint
            await this.submitFormData(formData);
            
            // Show success message
            this.showFeedback('Message sent successfully! We\'ll get back to you soon.', 'success');
            form.reset();
            this.resetFormLabels(form);
            
        } catch (error) {
            this.showFeedback('Sorry, there was an error sending your message. Please try again.', 'error');
            console.error('Form submission error:', error);
        } finally {
            this.setFormLoading(submitBtn, false);
        }
    }

    validateForm(form) {
        let isValid = true;
        const requiredFields = form.querySelectorAll('[required]');

        requiredFields.forEach(field => {
            if (!this.validateField(field)) {
                isValid = false;
            }
        });

        return isValid;
    }

    validateField(field) {
        const value = field.value.trim();
        const errorElement = document.getElementById(`${field.id}-error`);
        
        // Clear previous error
        if (errorElement) {
            errorElement.textContent = '';
        }

        let isValid = true;
        let errorMessage = '';

        switch (field.type) {
            case 'email':
                if (!value) {
                    errorMessage = 'Email is required';
                    isValid = false;
                } else if (!this.isValidEmail(value)) {
                    errorMessage = 'Please enter a valid email address';
                    isValid = false;
                }
                break;

            case 'tel':
                if (value && !this.isValidPhone(value)) {
                    errorMessage = 'Please enter a valid phone number';
                    isValid = false;
                }
                break;

            default:
                if (field.required && !value) {
                    errorMessage = `${field.previousElementSibling.textContent} is required`;
                    isValid = false;
                }
        }

        // Special validation for select
        if (field.tagName === 'SELECT' && field.required && !value) {
            errorMessage = 'Please select a subject';
            isValid = false;
        }

        // Update field state
        if (isValid) {
            field.classList.remove('error');
            field.classList.add('valid');
        } else {
            field.classList.remove('valid');
            field.classList.add('error');
            if (errorElement) {
                errorElement.textContent = errorMessage;
            }
        }

        return isValid;
    }

    clearFieldError(field) {
        const errorElement = document.getElementById(`${field.id}-error`);
        if (errorElement) {
            errorElement.textContent = '';
        }
        field.classList.remove('error');
    }

    isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    isValidPhone(phone) {
        // Basic international phone validation
        const phoneRegex = /^[+]?[0-9\s\-\(\)]{10,}$/;
        return phoneRegex.test(phone);
    }

    formatPhoneNumber(e) {
        const input = e.target;
        let value = input.value.replace(/\D/g, '');
        
        if (value.startsWith('60')) {
            value = value.replace(/^60/, '+60 ');
        } else if (value.startsWith('0')) {
            value = value.replace(/^0/, '+60 ');
        }
        
        // Format: +60 12 345 6789
        if (value.length > 4) {
            value = value.replace(/(\+\d{2})(\d{2})(\d{3})(\d{0,4})/, '$1 $2 $3 $4');
        }
        
        input.value = value.trim();
    }

    setFormLoading(button, isLoading) {
        if (isLoading) {
            button.classList.add('loading');
            button.disabled = true;
        } else {
            button.classList.remove('loading');
            button.disabled = false;
        }
    }

    async submitFormData(formData) {
        // Simulate API call delay
        await new Promise(resolve => setTimeout(resolve, 2000));
        
        // Replace this with actual form submission
        // Example using fetch:
        /*
        const response = await fetch('/process_contact.php', {
            method: 'POST',
            body: formData
        });
        
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        return await response.json();
        */
        
        return { success: true, message: 'Form submitted successfully' };
    }

    showFeedback(message, type) {
        const feedback = document.getElementById('form-feedback');
        if (!feedback) return;

        feedback.textContent = message;
        feedback.className = type;
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            feedback.style.transform = 'translateX(150%)';
        }, 5000);
    }

    resetFormLabels(form) {
        const labels = form.querySelectorAll('label');
        labels.forEach(label => {
            const input = document.getElementById(label.htmlFor);
            if (input && !input.value) {
                input.parentElement.classList.remove('focused');
            }
        });
    }

    animateOnScroll() {
        const animatedElements = document.querySelectorAll('.contact-method, .form-group, .gallery-item');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.6s ease-out forwards';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        animatedElements.forEach(el => observer.observe(el));
    }

    animateFloatingShapes() {
        const shapes = document.querySelectorAll('.shape');
        
        shapes.forEach((shape, index) => {
            const duration = 20 + (index * 2);
            const delay = index * 2;
            
            shape.style.animation = `float ${duration}s infinite linear ${delay}s`;
        });
    }

    animateGradientOrbs() {
        const orbs = document.querySelectorAll('.orb');
        
        orbs.forEach((orb, index) => {
            const duration = 8 + (index * 2);
            const delay = index * 2;
            
            orb.style.animation = `pulse ${duration}s ease-in-out infinite ${delay}s`;
        });
    }

    closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
        
        // Reset lightbox content after transition
        setTimeout(() => {
            const lightboxImage = lightbox.querySelector('.lightbox-image');
            const lightboxCaption = lightbox.querySelector('.lightbox-caption');
            lightboxImage.src = '';
            lightboxImage.alt = '';
            lightboxCaption.textContent = '';
        }, 300);
    }

    // Utility method for smooth scrolling
    smoothScrollTo(element, duration = 1000) {
        const targetPosition = element.getBoundingClientRect().top + window.pageYOffset;
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        let startTime = null;

        function animation(currentTime) {
            if (startTime === null) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const run = this.easeInOutQuad(timeElapsed, startPosition, distance, duration);
            window.scrollTo(0, run);
            if (timeElapsed < duration) requestAnimationFrame(animation);
        }

        this.easeInOutQuad = function (t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        };

        requestAnimationFrame(animation);
    }
}

// Enhanced utility functions
class ContactUtils {
    static debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    static throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new ContactPage();
});

// Add some interactive effects
document.addEventListener('DOMContentLoaded', () => {
    // Add parallax effect to hero section
    window.addEventListener('scroll', ContactUtils.throttle(() => {
        const scrolled = window.pageYOffset;
        const parallax = document.querySelector('.contact-hero');
        if (parallax) {
            parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    }, 16));

    // Add cursor follower effect
    const cursorFollower = document.createElement('div');
    cursorFollower.className = 'cursor-follower';
    document.body.appendChild(cursorFollower);

    document.addEventListener('mousemove', ContactUtils.throttle((e) => {
        cursorFollower.style.left = e.clientX + 'px';
        cursorFollower.style.top = e.clientY + 'px';
    }, 16));

    // Add styles for cursor follower
    const cursorStyles = `
        .cursor-follower {
            position: fixed;
            width: 20px;
            height: 20px;
            background: radial-gradient(circle, var(--accent-gold) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.3;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
            mix-blend-mode: screen;
        }
        
        .cursor-follower.hover {
            width: 40px;
            height: 40px;
            opacity: 0.5;
        }
    `;

    const styleSheet = document.createElement('style');
    styleSheet.textContent = cursorStyles;
    document.head.appendChild(styleSheet);

    // Add hover effect to interactive elements
    const interactiveElements = document.querySelectorAll('button, a, input, textarea, select');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursorFollower.classList.add('hover');
        });
        
        el.addEventListener('mouseleave', () => {
            cursorFollower.classList.remove('hover');
        });
    });
});

// Export for potential module usage
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { ContactPage, ContactUtils };
}