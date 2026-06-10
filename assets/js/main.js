/**
 * Local Presence Engine Theme JavaScript
 */

(function() {
  'use strict';

  // FAQ Accordion
  const initFAQ = () => {
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
      const question = item.querySelector('.faq-question');
      if (question) {
        question.addEventListener('click', () => {
          item.classList.toggle('active');
        });
      }
    });
  };

  // Smooth scroll to sections
  const initSmoothScroll = () => {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#') {
          e.preventDefault();
          const target = document.querySelector(href);
          if (target) {
            target.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        }
      });
    });
  };

  // Contact form handler
  const initContactForm = () => {
    const form = document.querySelector('form[data-contact]');
    if (!form) return;

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      
      const formData = new FormData(form);
      formData.append('action', 'lpe_contact_form');
      formData.append('nonce', lpeAjax.nonce);

      fetch(lpeAjax.ajaxUrl, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          form.reset();
          alert(data.data.message);
        } else {
          alert('There was an error. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
      });
    });
  };

  // Intersection Observer for animations
  const initAnimations = () => {
    const observerOptions = {
      threshold: 0.1,
      rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('animate-in');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    document.querySelectorAll('.card, .step, .testimonial').forEach(el => {
      observer.observe(el);
    });
  };

  // Mobile menu toggle
  const initMobileMenu = () => {
    const aside = document.querySelector('aside');
    const main = document.querySelector('main');
    
    // Add toggle button for mobile
    if (window.innerWidth < 1024 && aside) {
      const toggleBtn = document.createElement('button');
      toggleBtn.className = 'mobile-menu-toggle';
      toggleBtn.innerHTML = '☰';
      toggleBtn.setAttribute('aria-label', 'Toggle navigation');
      
      // Close menu when clicking a link
      document.querySelectorAll('aside a').forEach(link => {
        link.addEventListener('click', () => {
          aside.classList.remove('active');
        });
      });
      
      // Close menu when clicking outside
      document.addEventListener('click', (e) => {
        if (!aside.contains(e.target) && !toggleBtn.contains(e.target)) {
          aside.classList.remove('active');
        }
      });
    }
  };

  // Initialize on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      initFAQ();
      initSmoothScroll();
      initContactForm();
      initAnimations();
      initMobileMenu();
    });
  } else {
    initFAQ();
    initSmoothScroll();
    initContactForm();
    initAnimations();
    initMobileMenu();
  }
})();
