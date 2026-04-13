// Enhanced Journey Page Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initTimeline();
    initStatsCounter();
    initCertHoverEffects();
    initParallaxEffect();
    initMissionVisionAnimations();
    setupCounterAnimation();
    createParticles();
});

// Timeline Functionality
function initTimeline() {
    const timelineItems = document.querySelectorAll('.timeline-item');
    const timelineLine = document.querySelector('.timeline-line');
    
    if (!timelineItems.length || !timelineLine) return;
    
    // Create Intersection Observer for timeline items
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { 
        threshold: 0.2,
        rootMargin: '0px 0px -100px 0px'
    });
    
    // Observe each timeline item
    timelineItems.forEach(item => {
        observer.observe(item);
    });

    // Add hover effects
    timelineItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            const dot = item.querySelector('.timeline-dot');
            const content = item.querySelector('.timeline-content');
            if (dot) dot.style.transform = 'translate(-50%, -50%) scale(1.2)';
            if (content) content.style.transform = 'translateY(-8px)';
        });
        
        item.addEventListener('mouseleave', () => {
            const dot = item.querySelector('.timeline-dot');
            const content = item.querySelector('.timeline-content');
            if (dot) dot.style.transform = 'translate(-50%, -50%) scale(1)';
            if (content) content.style.transform = 'translateY(0)';
        });
    });

    // Add click functionality for mobile devices
    timelineItems.forEach(item => {
        item.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                // Toggle active state on mobile
                if (item.classList.contains('active')) {
                    item.classList.remove('active');
                } else {
                    // Remove active class from all items
                    timelineItems.forEach(i => i.classList.remove('active'));
                    // Add active class to clicked item
                    item.classList.add('active');
                    
                    // Smooth scroll to the item
                    item.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center',
                        inline: 'center'
                    });
                }
            }
        });
    });

    // Add keyboard navigation support
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();
            
            const activeItem = document.querySelector('.timeline-item.active');
            let nextItem;
            
            if (activeItem) {
                if (e.key === 'ArrowDown') {
                    nextItem = activeItem.nextElementSibling;
                } else {
                    nextItem = activeItem.previousElementSibling;
                }
                
                if (nextItem) {
                    activeItem.classList.remove('active');
                    nextItem.classList.add('active');
                    nextItem.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center',
                        inline: 'center'
                    });
                }
            } else if (timelineItems.length > 0) {
                // If no active item, select the first one
                timelineItems[0].classList.add('active');
                timelineItems[0].scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'center',
                    inline: 'center'
                });
            }
        }
    });
    
    // Animate timeline line progress
    animateTimelineLine();
}

// Animate timeline line progress on scroll
function animateTimelineLine() {
    const timelineLine = document.querySelector('.timeline-line');
    if (!timelineLine) return;
    
    const timelineSection = document.querySelector('.timeline-section');
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    // Create an observer to watch for timeline items entering viewport
    const lineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Calculate progress based on visible items
                const visibleItems = Array.from(timelineItems).filter(item => {
                    const rect = item.getBoundingClientRect();
                    return rect.top < window.innerHeight && rect.bottom > 0;
                }).length;
                
                const progress = (visibleItems / timelineItems.length) * 100;
                timelineLine.style.background = `linear-gradient(to bottom, var(--accent-gold) 0%, var(--sagegreen) ${progress}%, rgba(218, 161, 18, 0.3) ${progress}%, rgba(218, 161, 18, 0.3) 100%)`;
            }
        });
    }, { threshold: 0.1 });
    
    if (timelineSection) {
        lineObserver.observe(timelineSection);
    }
}

// Statistics Counter Animation
function initStatsCounter() {
    const statElements = document.querySelectorAll('.stat-number');
    if (statElements.length === 0) return;
    
    let hasAnimated = false;
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasAnimated) {
                hasAnimated = true;
                animateStats();
            }
        });
    }, { threshold: 0.5 });
    
    // Observe the stats container
    const statsContainer = document.querySelector('.at-glance');
    if (statsContainer) {
        observer.observe(statsContainer);
    }
}

function animateStats() {
    const statElements = document.querySelectorAll('.stat-number');
    const duration = 2000; // Animation duration in ms
    const frameRate = 30; // Frames per second
    const frameDuration = 1000 / frameRate;
    const totalFrames = Math.round(duration / frameDuration);
    
    statElements.forEach((stat) => {
        const target = parseInt(stat.getAttribute('data-count'));
        const count = parseInt(stat.innerText) || 0;
        const increment = (target - count) / totalFrames;
        let currentCount = count;
        let frame = 0;
        
        const counter = setInterval(() => {
            frame++;
            currentCount += increment;
            
            if (frame >= totalFrames) {
                stat.innerText = target;
                stat.classList.add('animated');
                clearInterval(counter);
            } else {
                // Format numbers with commas if they're large
                if (target > 1000) {
                    stat.innerText = Math.round(currentCount).toLocaleString();
                } else {
                    stat.innerText = Math.round(currentCount);
                }
            }
        }, frameDuration);
    });
}

// Certification Hover Effects
function initCertHoverEffects() {
    const certCards = document.querySelectorAll('.cert-card');
    certCards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            const img = card.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1.05)';
                img.style.filter = 'grayscale(0%) brightness(1.2)';
            }
        });
        
        card.addEventListener('mouseleave', () => {
            const img = card.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1)';
                img.style.filter = 'grayscale(20%) brightness(1.1)';
            }
        });
    });
}

// Parallax Effect for Hero Section
function initParallaxEffect() {
    const hero = document.querySelector('.journey-hero');
    if (!hero) return;
    
    window.addEventListener('scroll', function() {
        const scrollPosition = window.pageYOffset;
        hero.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
    });
}

// Mission & Vision Animations
function initMissionVisionAnimations() {
    const mvCards = document.querySelectorAll('.mv-card');
    const valuesItems = document.querySelectorAll('.values li');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('mv-card')) {
                    entry.target.style.animation = `fadeInUp 0.8s ease-out forwards`;
                    entry.target.style.opacity = 1;
                }
                
                if (entry.target.classList.contains('values')) {
                    valuesItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.style.animation = `fadeInRight 0.6s ease-out ${index * 0.1}s forwards`;
                            item.style.opacity = 1;
                        }, 0);
                    });
                }
                
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });
    
    // Observe mission vision section
    const missionVisionSection = document.querySelector('.mission-vision');
    if (missionVisionSection) {
        observer.observe(missionVisionSection);
        
        // Observe each card
        mvCards.forEach(card => {
            card.style.opacity = 0;
            observer.observe(card);
        });
        
        // Observe values list
        const valuesList = document.querySelector('.values');
        if (valuesList) {
            valuesItems.forEach(item => {
                item.style.opacity = 0;
            });
            observer.observe(valuesList);
        }
    }
}

// Add CSS animation for values list items
(function addKeyframes() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
})();

// Handle window resize events
window.addEventListener('resize', function() {
    // Reinitialize timeline if needed
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach(item => {
        if (window.innerWidth > 768) {
            item.classList.remove('active');
        }
    });
});

// Enhanced Mission & Vision Section
function enhanceMissionVision() {
    const mvCards = document.querySelectorAll('.mv-card');
    
    mvCards.forEach(card => {
        // Add hover effect
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.boxShadow = '0 25px 50px rgba(10, 37, 64, 0.15)';
            this.style.background = 'rgba(255, 255, 255, 0.95)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 15px 40px rgba(10, 37, 64, 0.08)';
            this.style.background = 'rgba(255, 255, 255, 0.85)';
        });
        
        // Add click effect for mobile
        card.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                this.classList.toggle('active');
            }
        });
    });
    
    // Add animation to values list items
    const valuesItems = document.querySelectorAll('.values li');
    valuesItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.background = 'rgba(31, 122, 106, 0.05)';
            this.style.transform = 'translateX(5px)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.background = 'rgba(10, 37, 64, 0.03)';
            this.style.transform = 'translateX(0)';
        });
    });
}

// Initialize mission vision enhancements
document.addEventListener('DOMContentLoaded', function() {
    enhanceMissionVision();
});

// Create background particles
function createParticles() {
    const particlesContainer = document.createElement('div');
    particlesContainer.className = 'stats-bg-particles';
    
    for (let i = 0; i < 20; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random properties
        const size = Math.random() * 8 + 2;
        const posX = Math.random() * 100;
        const posY = Math.random() * 100;
        const delay = Math.random() * 15;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${posX}%`;
        particle.style.top = `${posY}%`;
        particle.style.animationDelay = `${delay}s`;
        
        particlesContainer.appendChild(particle);
    }
    
    const statsSection = document.querySelector('.at-glance');
    if (statsSection) {
        statsSection.appendChild(particlesContainer);
    }
}

// Single counter animation implementation
function setupCounterAnimation() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = document.querySelectorAll('.stat-number');
                const duration = 2000;
                
                counters.forEach(counter => {
                    const target = +counter.getAttribute('data-count');
                    const start = 0;
                    const increment = target / (duration / 16); // 60fps
                    let current = start;
                    
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            counter.textContent = target;
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.round(current);
                        }
                    }, 16);
                });
                
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    const statsSection = document.querySelector('.at-glance');
    if (statsSection) {
        observer.observe(statsSection);
    }
}

// Certifications Section Interactivity
document.addEventListener('DOMContentLoaded', function() {
    // Tab filtering
    const certTabs = document.querySelectorAll('.cert-tab');
    const certCards = document.querySelectorAll('.cert-card');
    
    certTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            certTabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
            
            const category = this.getAttribute('data-category');
            
            // Filter cards
            certCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category').includes(category)) {
                    card.style.display = 'flex';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
    
    // Toggle certificate details
    const detailToggles = document.querySelectorAll('.cert-details-toggle');
    
    detailToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const details = this.nextElementSibling;
            const icon = this.querySelector('i');
            
            details.classList.toggle('active');
            
            if (details.classList.contains('active')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                this.querySelector('span').textContent = 'Hide Details';
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                this.querySelector('span').textContent = 'See Details';
            }
        });
    });
    
    // Certification counter animation
    const counterItems = document.querySelectorAll('.counter-number');
    
    function animateCounter() {
        counterItems.forEach(item => {
            const target = parseInt(item.getAttribute('data-count'));
            const duration = 2000;
            const increment = target / (duration / 16);
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    item.textContent = target;
                    clearInterval(timer);
                } else {
                    item.textContent = Math.floor(current);
                }
            }, 16);
        });
    }
    
    // Initialize counter animation when in viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter();
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    observer.observe(document.querySelector('.cert-counter'));
});

// Current Services Interactivity
document.addEventListener('DOMContentLoaded', function() {
    // Service nodes interaction
    const serviceNodes = document.querySelectorAll('.service-node');
    const serviceDetails = document.querySelectorAll('.service-detail');
    const detailsPlaceholder = document.querySelector('.details-placeholder');
    
    serviceNodes.forEach(node => {
        node.addEventListener('click', function() {
            const serviceType = this.getAttribute('data-service');
            
            // Hide placeholder
            detailsPlaceholder.style.display = 'none';
            
            // Remove active class from all details
            serviceDetails.forEach(detail => {
                detail.classList.remove('active');
            });
            
            // Add active class to corresponding detail
            const targetDetail = document.querySelector(`.service-detail[data-service="${serviceType}"]`);
            if (targetDetail) {
                targetDetail.classList.add('active');
            }
        });
    });
    
    // Mobile accordion functionality
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    
    accordionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const accordionItem = this.parentElement;
            accordionItem.classList.toggle('active');
        });
    });
    
    // Animate service nodes with staggered delay
    const orbits = document.querySelectorAll('.orbit');
    
    orbits.forEach((orbit, index) => {
        const nodes = orbit.querySelectorAll('.service-node');
        nodes.forEach((node, nodeIndex) => {
            node.style.transitionDelay = `${(index * 0.2) + (nodeIndex * 0.1)}s`;
            node.style.opacity = '0';
            node.style.transform = 'scale(0.5)';
            
            setTimeout(() => {
                node.style.opacity = '1';
                node.style.transform = 'scale(1)';
            }, 500 + (index * 200) + (nodeIndex * 100));
        });
    });
});