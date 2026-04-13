// services.js - Enhanced functionality for NR Intellitech Services page
document.addEventListener('DOMContentLoaded', function () {
    // Elements
    const servicesNav = document.querySelector('.services-nav');
    const serviceLinks = Array.from(document.querySelectorAll('.service-link'));
    const serviceSections = Array.from(document.querySelectorAll('.service-section'));
    const progressFill = document.querySelector('.progress-fill');
    const methodTabs = document.querySelectorAll('.method-tab');
    const methodPanels = document.querySelectorAll('.method-panel');
    
    // Cybersecurity visualization elements
    const serviceNodes = document.querySelectorAll('.service-node');
    const serviceDetails = document.querySelectorAll('.service-detail');
    const detailsPlaceholder = document.querySelector('.details-placeholder');
    const serviceDetailsPanel = document.querySelector('.service-details-panel');
    
    // Mobile navigation elements
    const mobileServiceIcons = document.querySelectorAll('.mobile-service-icon');
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const mobileActiveIndicator = document.querySelector('.mobile-active-indicator');
    
    // Track currently selected service
    let currentService = null;
    
    // Constants
    const HEADER_OFFSET = 100;
    const SCROLL_THRESHOLD = 100;
    const SECTION_OFFSET = 200;

    // Initialize the page
    initServicesPage();

    function initServicesPage() {
        // Return early if essential elements don't exist
        if (!serviceLinks.length || !serviceSections.length) return;

        // Set up scroll event listener
        window.addEventListener('scroll', handleScroll);
        
        // Set up IntersectionObserver for section detection
        setupSectionObserver();
        
        // Set up smooth scrolling for service links
        setupSmoothScrolling();
        
        // Set up method tabs functionality
        if (methodTabs.length && methodPanels.length) {
            setupMethodTabs();
        }
        
        // Set up cybersecurity service nodes
        if (serviceNodes.length && serviceDetails.length) {
            setupServiceNodes();
        }
        
        // Set up mobile navigation
        if (mobileServiceIcons.length) {
            setupMobileNavigation();
        }
        
        // Set initial active state based on URL hash or first section
        setInitialActiveState();
        
        // Additional enhancement: Add click handlers to service headers
        setupServiceHeaderClicks();
        
        console.log('Services page JavaScript loaded successfully');
    }

    /**
     * Handles scroll events for navigation and progress bar
     */
    function handleScroll() {
        if (servicesNav) {
            if (window.scrollY > SCROLL_THRESHOLD) {
                servicesNav.classList.add('scrolled');
            } else {
                servicesNav.classList.remove('scrolled');
            }
        }

        // Update progress bar
        updateProgressBar();
        
        // Update active section (fallback if IntersectionObserver fails)
        updateActiveSectionOnScroll();
    }

    /**
     * Updates the progress bar based on scroll position
     */
    function updateProgressBar() {
        if (progressFill) {
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight - windowHeight;
            const scrollTop = window.scrollY;
            const scrollPercentage = (scrollTop / documentHeight) * 100;
            progressFill.style.width = scrollPercentage + '%';
        }
    }

    /**
     * Sets up IntersectionObserver to detect when sections enter viewport
     */
    function setupSectionObserver() {
        const observerOptions = {
            root: null,
            rootMargin: `-${HEADER_OFFSET + SECTION_OFFSET}px 0px -${window.innerHeight - HEADER_OFFSET - SECTION_OFFSET}px 0px`,
            threshold: 0.2
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = '#' + entry.target.id;
                    
                    // Update active service link
                    updateActiveLink(id);
                    
                    // Update mobile navigation
                    updateMobileNavigation(id);
                    
                    // Update URL hash without scrolling
                    if (history.replaceState) {
                        history.replaceState(null, null, id);
                    }
                }
            });
        }, observerOptions);

        // Observe all service sections
        serviceSections.forEach(section => {
            observer.observe(section);
        });
    }

    /**
     * Fallback method to update active section on scroll
     */
    function updateActiveSectionOnScroll() {
        let currentSection = null;
        const scrollPosition = window.scrollY + HEADER_OFFSET;
        
        // Find the current section
        for (const section of serviceSections) {
            const sectionTop = section.offsetTop;
            const sectionBottom = sectionTop + section.offsetHeight;
            
            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                currentSection = section;
                break;
            }
        }
        
        // Update active link if a section is found
        if (currentSection) {
            updateActiveLink('#' + currentSection.id);
            updateMobileNavigation('#' + currentSection.id);
        }
    }

    /**
     * Updates the active link based on the section ID
     * @param {string} sectionId - The ID of the active section (e.g., "#data-destruction")
     */
    function updateActiveLink(sectionId) {
        serviceLinks.forEach(link => {
            const linkHash = getHashFromHref(link);
            if (linkHash === sectionId) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    /**
     * Updates the mobile navigation based on the section ID
     * @param {string} sectionId - The ID of the active section
     */
    function updateMobileNavigation(sectionId) {
        if (!mobileServiceIcons.length) return;
        
        const serviceName = sectionId.replace('#', '');
        mobileServiceIcons.forEach(icon => {
            if (icon.getAttribute('data-service') === serviceName) {
                icon.classList.add('active');
                
                // Update mobile active indicator position
                if (mobileActiveIndicator) {
                    const iconRect = icon.getBoundingClientRect();
                    const containerRect = icon.parentElement.getBoundingClientRect();
                    const position = iconRect.left - containerRect.left;
                    const width = iconRect.width;
                    
                    mobileActiveIndicator.style.left = `${position}px`;
                    mobileActiveIndicator.style.width = `${width}px`;
                }
            } else {
                icon.classList.remove('active');
            }
        });
    }

    /**
     * Sets up smooth scrolling for service navigation links
     */
    function setupSmoothScrolling() {
        serviceLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                
                if (targetSection) {
                    const targetPosition = targetSection.offsetTop - HEADER_OFFSET;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Update URL without adding to browser history
                    if (history.replaceState) {
                        history.replaceState(null, null, targetId);
                    }
                    
                    // Update active state
                    updateActiveLink(targetId);
                    updateMobileNavigation(targetId);
                }
            });
        });
    }

    /**
     * Sets up method tabs functionality for data destruction section
     */
    function setupMethodTabs() {
        methodTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const method = this.getAttribute('data-method');
                
                // Remove active class from all tabs and panels
                methodTabs.forEach(t => t.classList.remove('active'));
                methodPanels.forEach(p => p.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding panel
                const targetPanel = document.getElementById(method);
                if (targetPanel) {
                    targetPanel.classList.add('active');
                }
            });
        });
    }

    /**
     * Sets up cybersecurity service nodes interaction
     */
    function setupServiceNodes() {
        serviceNodes.forEach(node => {
            // Add hover effect for desktop
            node.addEventListener('mouseenter', function() {
                const serviceType = this.getAttribute('data-service');
                showServiceDetail(serviceType);
            });
            
            // Add click handler for persistent selection
            node.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent event bubbling
                const serviceType = this.getAttribute('data-service');
                
                // If clicking the same service again, do nothing
                if (currentService === serviceType) return;
                
                currentService = serviceType;
                showServiceDetail(serviceType);
                
                // Add active class to clicked node
                serviceNodes.forEach(n => n.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        // Click anywhere outside to clear selection
        document.addEventListener('click', function(e) {
            // Check if click is outside of service nodes and details panel
            const clickedNode = e.target.closest('.service-node');
            const clickedPanel = e.target.closest('.service-details-panel');
            
            if (!clickedNode && !clickedPanel) {
                // Clear selection if clicked outside
                serviceNodes.forEach(n => n.classList.remove('active'));
                currentService = null;
                hideServiceDetails();
            }
        });
        
        // Remove the mouseleave event that was hiding details
    }

    /**
     * Shows the service detail panel for the specified service
     * @param {string} serviceType - The service type to show
     */
    function showServiceDetail(serviceType) {
        // Hide all service details
        serviceDetails.forEach(detail => {
            detail.classList.remove('active');
        });
        
        // Hide placeholder
        if (detailsPlaceholder) {
            detailsPlaceholder.style.display = 'none';
        }
        
        // Show the selected service detail
        const targetDetail = document.querySelector(`.service-detail[data-service="${serviceType}"]`);
        if (targetDetail) {
            targetDetail.classList.add('active');
        }
    }

    /**
     * Hides all service details and shows the placeholder
     */
    function hideServiceDetails() {
        serviceDetails.forEach(detail => {
            detail.classList.remove('active');
        });
        
        if (detailsPlaceholder) {
            detailsPlaceholder.style.display = 'flex';
        }
    }

    /**
     * Sets up mobile navigation functionality
     */
    function setupMobileNavigation() {
        // Click handlers for mobile service icons
        mobileServiceIcons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-service');
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    // Scroll to section
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                    
                    // Update active state
                    mobileServiceIcons.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update URL without adding to browser history
                    if (history.replaceState) {
                        history.replaceState(null, null, '#' + targetId);
                    }
                }
            });
        });
        
        // Mobile nav toggle functionality
        if (mobileNavToggle) {
            mobileNavToggle.addEventListener('click', function() {
                const mobileNavContainer = this.closest('.mobile-nav-container');
                if (mobileNavContainer) {
                    mobileNavContainer.classList.toggle('expanded');
                }
            });
        }
    }

    /**
     * Sets the initial active state based on URL hash or first section
     */
    function setInitialActiveState() {
        if (window.location.hash) {
            const hash = window.location.hash;
            const initialActiveLink = document.querySelector(`.service-link[href="${hash}"]`);
            if (initialActiveLink) {
                updateActiveLink(hash);
                updateMobileNavigation(hash);
                
                // Scroll to section if it's not in view
                setTimeout(() => {
                    const targetSection = document.querySelector(hash);
                    if (targetSection) {
                        const rect = targetSection.getBoundingClientRect();
                        if (rect.top < 0 || rect.bottom > window.innerHeight) {
                            window.scrollTo({
                                top: targetSection.offsetTop - HEADER_OFFSET,
                                behavior: 'smooth'
                            });
                        }
                    }
                }, 100);
            }
        } else {
            // Set first link as active by default
            if (serviceLinks.length > 0) {
                const firstLinkHref = serviceLinks[0].getAttribute('href');
                updateActiveLink(firstLinkHref);
                updateMobileNavigation(firstLinkHref);
            }
        }
    }

    /**
     * Sets up click handlers for service headers
     */
    function setupServiceHeaderClicks() {
        const serviceHeaders = Array.from(document.querySelectorAll('.service-title'));
        serviceHeaders.forEach(header => {
            header.style.cursor = 'pointer';
            header.addEventListener('click', function() {
                const section = this.closest('.service-section');
                if (!section || !section.id) return;
                
                const y = section.getBoundingClientRect().top + window.pageYOffset - HEADER_OFFSET;
                window.scrollTo({ top: y, behavior: 'smooth' });
                
                // Update URL hash
                if (history.replaceState) {
                    history.replaceState(null, null, '#' + section.id);
                }
                
                // Update active link
                updateActiveLink('#' + section.id);
                updateMobileNavigation('#' + section.id);
            });
        });
    }

    /**
     * Extracts hash from href attribute, handling different URL formats
     * @param {Element} anchorEl - The anchor element
     * @returns {string} The hash value (e.g., "#data-destruction")
     */
    function getHashFromHref(anchorEl) {
        try {
            // Handle full URLs
            const url = new URL(anchorEl.href, window.location.origin);
            return url.hash;
        } catch (e) {
            // Handle relative URLs (just the hash)
            return anchorEl.getAttribute('href') || '';
        }
    }
});

// Handle window resize events for responsive behavior
window.addEventListener('resize', function() {
    // Update mobile active indicator position on resize
    const activeMobileIcon = document.querySelector('.mobile-service-icon.active');
    const mobileActiveIndicator = document.querySelector('.mobile-active-indicator');
    
    if (activeMobileIcon && mobileActiveIndicator) {
        const iconRect = activeMobileIcon.getBoundingClientRect();
        const containerRect = activeMobileIcon.parentElement.getBoundingClientRect();
        const position = iconRect.left - containerRect.left;
        const width = iconRect.width;
        
        mobileActiveIndicator.style.left = `${position}px`;
        mobileActiveIndicator.style.width = `${width}px`;
    }
});


// Set up mobile accordion functionality
function setupMobileAccordion() {
    const accordionItems = document.querySelectorAll('.accordion-item');
    const accordionHeaders = document.querySelectorAll('.accordion-header');
    
    if (!accordionItems.length || !accordionHeaders.length) return;
    
    accordionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const item = this.parentElement;
            const isActive = item.classList.contains('active');
            
            // Close all accordion items
            accordionItems.forEach(accItem => {
                accItem.classList.remove('active');
            });
            
            // Open clicked item if it wasn't already active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
}

// Set up mobile accordion functionality
setupMobileAccordion();

