(() => {
    'use strict';

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const selectors = [
        'main > section',
        '.page-hero .container-xl > *',
        '.page-section .home-section-heading',
        '.page-section .section-title',
        '.surface-card',
        '.product-card',
        '.collection-banner',
        '.home-benefit',
        '.home-collection-card',
        '.home-story-mark',
        '.home-story-copy',
        '.home-final-inner',
        '.auth-aside',
        '.auth-form',
        '.profile-hero .container-xl > *',
        '.cart-item',
        '.summary-card',
        '.admin-content > *',
        '.admin-panel',
        '.site-footer .row > *',
        '.site-footer .footer-bottom'
    ];

    const elements = [...new Set(document.querySelectorAll(selectors.join(',')))];
    const staggerGroups = [
        '.home-benefits .row',
        '.home-collections .row',
        '.home-featured .row',
        '.product-grid',
        '.admin-stat-band',
        '.admin-detail-grid',
        '.site-footer .row'
    ];

    elements.forEach((element, index) => {
        if (element.closest('.navbar, .admin-sidebar')) return;

        element.classList.add('reveal-on-scroll');
        if (!element.dataset.reveal) {
            if (element.matches('.home-story-mark, .auth-aside')) {
                element.dataset.reveal = 'left';
            } else if (element.matches('.home-story-copy, .auth-form, .summary-card')) {
                element.dataset.reveal = 'right';
            } else {
                element.dataset.reveal = 'up';
            }
        }

        if (!element.style.getPropertyValue('--reveal-delay')) {
            element.style.setProperty('--reveal-delay', `${Math.min((index % 4) * 45, 135)}ms`);
        }
    });

    staggerGroups.forEach((selector) => {
        document.querySelectorAll(selector).forEach((group) => {
            [...group.children].forEach((child, index) => {
                const target = child.matches('.reveal-on-scroll')
                    ? child
                    : child.querySelector('.reveal-on-scroll');
                target?.style.setProperty('--reveal-delay', `${Math.min(index * 85, 340)}ms`);
            });
        });
    });

    if (reducedMotion || !('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-revealed'));
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            entry.target.classList.add('is-revealed');
            observer.unobserve(entry.target);
        });
    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -7% 0px'
    });

    elements.forEach((element) => {
        const rect = element.getBoundingClientRect();
        if (rect.top < window.innerHeight * 0.94) {
            element.classList.add('is-revealed');
        } else {
            observer.observe(element);
        }
    });
})();
