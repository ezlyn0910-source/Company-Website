document.addEventListener('DOMContentLoaded', function() {
    // Enhanced news filtering functionality
    const enhancedFilterButtons = document.querySelectorAll('.enhanced-filter-btn');
    const newsCards = document.querySelectorAll('.enhanced-news-card');
    const newsGrid = document.querySelector('.news-grid');
    const newsSection = document.querySelector('.all-news');
    
    // Count items per category for filter buttons
    const categoryCounts = {};
    newsCards.forEach(card => {
        const category = card.getAttribute('data-category');
        categoryCounts[category] = (categoryCounts[category] || 0) + 1;
    });
    
    // Update filter buttons with counts
    enhancedFilterButtons.forEach(button => {
        const filter = button.getAttribute('data-filter');
        if (filter !== 'all') {
            const count = categoryCounts[filter] || 0;
            const countElement = button.querySelector('.filter-count');
            if (countElement) {
                countElement.textContent = count;
            }
        } else {
            const totalCount = newsCards.length;
            const countElement = button.querySelector('.filter-count');
            if (countElement) {
                countElement.textContent = totalCount;
            }
        }
    });
    
    enhancedFilterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            enhancedFilterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get filter value
            const filterValue = this.getAttribute('data-filter');
            
            // Add loading state
            newsGrid.classList.add('loading');
            
            // Simulate loading for better UX
            setTimeout(() => {
                // Filter news cards
                newsCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    
                    if (filterValue === 'all' || filterValue === cardCategory) {
                        card.style.display = 'block';
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
                
                // Remove loading state
                newsGrid.classList.remove('loading');
                
                // Scroll to section if not in view
                if (!isElementInViewport(newsSection)) {
                    newsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 500);
        });
    });
    
    // View toggle functionality
    const viewToggleButtons = document.querySelectorAll('.view-toggle-btn');
    
    viewToggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            viewToggleButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Get view type
            const viewType = this.getAttribute('data-view');
            
            // Apply view type
            if (viewType === 'list') {
                newsGrid.classList.add('list-view');
            } else {
                newsGrid.classList.remove('list-view');
            }
        });
    });
    
    
    
    // Close dropdowns when clicking elsewhere
    document.addEventListener('click', function() {
        document.querySelectorAll('.share-dropdown.show').forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    });
    
    // Copy link functionality
    const copyLinkButtons = document.querySelectorAll('.share-option.link');
    
    copyLinkButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the article link (in a real implementation, this would be the actual article URL)
            const articleCard = this.closest('.enhanced-news-card');
            const articleTitle = articleCard.querySelector('h3').textContent;
            const fakeUrl = `https://nrintellitech.com/insights/${articleTitle.toLowerCase().replace(/\s+/g, '-')}`;
            
            // Copy to clipboard
            navigator.clipboard.writeText(fakeUrl).then(() => {
                showToast('Link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
                showToast('Failed to copy link');
            });
            
            // Close the dropdown
            this.closest('.share-dropdown').classList.remove('show');
        });
    });
    
    // Pagination functionality
    const paginationButtons = document.querySelectorAll('.enhanced-pagination-btn');
    
    paginationButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            paginationButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // In a real implementation, this would load the appropriate page of results
            showToast(`Loading page ${this.textContent}...`);
        });
    });
    
    // Back to top button
    const backToTopButton = document.createElement('button');
    backToTopButton.className = 'back-to-top';
    backToTopButton.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/></svg>';
    backToTopButton.setAttribute('aria-label', 'Back to top');
    document.body.appendChild(backToTopButton);
    
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Show/hide back to top button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });
    
    // Newsletter form validation
    const newsletterForm = document.querySelector('.newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value.trim();
            
            if (validateEmail(email)) {
                // In a real implementation, this would submit the form
                showToast('Thank you for subscribing!');
                emailInput.value = '';
            } else {
                showToast('Please enter a valid email address');
            }
        });
    }
    
    // Helper function to validate email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Helper function to show toast notifications
    function showToast(message) {
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.toast');
        existingToasts.forEach(toast => toast.remove());
        
        // Create new toast
        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.textContent = message;
        document.body.appendChild(toast);
        
        // Show toast
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);
        
        // Hide toast after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
    
    // Helper function to check if element is in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Initialize animations for cards
    function initCardAnimations() {
        const cards = document.querySelectorAll('.enhanced-news-card');
        
        cards.forEach((card, index) => {
            // Set initial state for animation
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            
            // Animate in with staggered delay
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 + (index * 100));
        });
    }
    
    // Initialize card animations
    initCardAnimations();
    
    // Reinitialize animations when filtering is done
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                initCardAnimations();
            }
        });
    });
    
    // Observe the news grid for changes
    observer.observe(newsGrid, { childList: true, subtree: true });
});
