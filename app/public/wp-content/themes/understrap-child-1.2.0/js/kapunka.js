// Header scroll effect and mega menu
document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('.site-header');
    const isHome = document.body.classList.contains('kapunka-home');

    const megaMenu = document.getElementById('kapunka-mega');
    const getScrollPosition = () =>
        window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

    const toggleHeaderState = () => {
        if (!header) {
            return;
        }

        if (isHome) {
            if (getScrollPosition() > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        } else {
            header.classList.add('scrolled');
        }
    };

    const desktopMediaQuery = window.matchMedia('(min-width: 993px)');
    const navContainer = document.querySelector('.kapunka-nav-container');
    const navToggle = document.querySelector('.kapunka-nav-toggle');
    const navPanel = document.getElementById('kapunka-nav-panel');
    const mobileNav = document.getElementById('kapunka-mobile-nav');
    const mobilePanels = mobileNav ? mobileNav.querySelectorAll('.kapunka-mobile-panel') : [];
    const mobilePanelButtons = mobileNav ? mobileNav.querySelectorAll('[data-mobile-target]') : [];
    const mobileBackButtons = mobileNav ? mobileNav.querySelectorAll('[data-mobile-panel-back]') : [];
    const mobileScrim = mobileNav ? mobileNav.querySelector('[data-mobile-nav-close]') : null;

    if (navContainer && navToggle && navPanel) {
        const closeMobilePanels = () => {
            mobilePanels.forEach((panel) => {
                panel.classList.remove('is-active');
                panel.setAttribute('aria-hidden', 'true');
            });
            if (mobileNav) {
                mobileNav.classList.remove('is-panel-open');
            }
        };

        const closeNav = () => {
            navContainer.classList.remove('is-open');
            navToggle.setAttribute('aria-expanded', 'false');
            if (mobileNav) {
                mobileNav.classList.remove('is-visible');
            }
            document.body.classList.remove('kapunka-mobile-nav-open');
            closeMobilePanels();
        };

        navToggle.addEventListener('click', () => {
            const isOpen = navContainer.classList.contains('is-open');
            if (isOpen) {
                closeNav();
            } else {
                navContainer.classList.add('is-open');
                navToggle.setAttribute('aria-expanded', 'true');
                if (mobileNav) {
                    mobileNav.classList.add('is-visible');
                }
                document.body.classList.add('kapunka-mobile-nav-open');
            }
        });

        window.addEventListener('resize', () => {
            if (desktopMediaQuery.matches) {
                closeNav();
            }
        });

        navPanel.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                if (!desktopMediaQuery.matches) {
                    closeNav();
                }
            });
        });

        if (mobileNav) {
            const openMobilePanel = (slug) => {
                mobileNav.classList.add('is-panel-open');
                mobilePanels.forEach((panel) => {
                    const isActive = panel.getAttribute('data-mobile-panel') === slug;
                    panel.classList.toggle('is-active', isActive);
                    panel.setAttribute('aria-hidden', isActive ? 'false' : 'true');
                });
            };

            mobilePanelButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const slug = button.getAttribute('data-mobile-target');
                    if (slug) {
                        openMobilePanel(slug);
                    }
                });
            });

            const handlePanelBack = () => {
                closeMobilePanels();
            };

            mobileBackButtons.forEach((button) => {
                button.addEventListener('click', handlePanelBack);
            });

            if (mobileScrim) {
                mobileScrim.addEventListener('click', closeNav);
            }

            mobileNav.querySelectorAll('a').forEach((anchor) => {
                anchor.addEventListener('click', () => {
                    closeNav();
                });
            });
        }
    }

    if (header) {
        // Simple scroll effect
        const scrollTargets = [window, document, document.documentElement, document.body];
        scrollTargets.forEach((target) => {
            if (target && target.addEventListener) {
                target.addEventListener('scroll', toggleHeaderState);
            }
        });

        // Mega menu hover effect (desktop only)
        if (megaMenu) {
            const triggers = document.querySelectorAll('#main-menu > li > a[data-mega-target]');
            const panels = megaMenu.querySelectorAll('[data-mega-panel]');
            const panelMap = {};
            let hideTimer = null;

            panels.forEach((panel) => {
                const slug = panel.getAttribute('data-mega-panel');
                if (slug) {
                    panelMap[slug] = panel;
                }
            });

            const hidePanel = () => {
                megaMenu.classList.remove('is-visible');
                panels.forEach((panel) => panel.classList.remove('is-active'));

                if (isHome && getScrollPosition() <= 50) {
                    header.classList.remove('scrolled');
                }
            };

            const showPanel = (slug) => {
                if (!desktopMediaQuery.matches) {
                    return;
                }

                const target = panelMap[slug];
                if (!target) {
                    hidePanel();
                    return;
                }

                header.classList.add('scrolled');
                megaMenu.classList.add('is-visible');

                panels.forEach((panel) => {
                    panel.classList.toggle('is-active', panel === target);
                });
            };

            const handleTriggerLeave = () => {
                if (!desktopMediaQuery.matches) {
                    return;
                }
                hideTimer = setTimeout(hidePanel, 150);
            };

            triggers.forEach((trigger) => {
                const slug = trigger.getAttribute('data-mega-target');
                if (!slug) {
                    return;
                }

                const parentItem = trigger.closest('li');

                const handleEnter = () => {
                    if (!desktopMediaQuery.matches) {
                        return;
                    }
                    clearTimeout(hideTimer);
                    showPanel(slug);
                };

                trigger.addEventListener('mouseenter', handleEnter);
                trigger.addEventListener('focus', handleEnter);

                if (parentItem) {
                    parentItem.addEventListener('mouseleave', handleTriggerLeave);
                }
            });

            megaMenu.addEventListener('mouseenter', () => {
                if (!desktopMediaQuery.matches) {
                    return;
                }
                clearTimeout(hideTimer);
            });

            megaMenu.addEventListener('mouseleave', () => {
                if (!desktopMediaQuery.matches) {
                    return;
                }
                hidePanel();
            });

            const handleViewportChange = (event) => {
                if (!event.matches) {
                    hidePanel();
                }
            };

            if (desktopMediaQuery.addEventListener) {
                desktopMediaQuery.addEventListener('change', handleViewportChange);
            } else if (desktopMediaQuery.addListener) {
                desktopMediaQuery.addListener(handleViewportChange);
            }
        }

        // Initial check
        toggleHeaderState();
    }

    // Testimonial slider
    document.querySelectorAll('[data-slider]').forEach((slider) => {
        const track = slider.querySelector('[data-slider-track]');
        const slides = track ? track.children : [];
        if (!track || !slides.length) return;

        let index = 0;
        const update = () => {
            track.style.transform = `translateX(-${index * 100}%)`;
        };

        slider.querySelectorAll('[data-slider-prev]').forEach((btn) =>
            btn.addEventListener('click', () => {
                index = index === 0 ? slides.length - 1 : index - 1;
                update();
            })
        );

        slider.querySelectorAll('[data-slider-next]').forEach((btn) =>
            btn.addEventListener('click', () => {
                index = index === slides.length - 1 ? 0 : index + 1;
                update();
            })
        );

        setInterval(() => {
            index = index === slides.length - 1 ? 0 : index + 1;
            update();
        }, 9000);
    });

    // Smooth scroll
    document.querySelectorAll('.js-scroll-to').forEach((link) => {
        link.addEventListener('click', (event) => {
            const targetId = link.getAttribute('href');
            if (targetId && targetId.startsWith('#')) {
                event.preventDefault();
                const target = document.querySelector(targetId);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // Simple lightbox for Woo gallery
    const galleryLinks = document.querySelectorAll('.woocommerce-product-gallery__image a');
    if (galleryLinks.length) {
        const overlay = document.createElement('div');
        overlay.className = 'kapunka-lightbox';
        overlay.innerHTML = '<button class=\"kapunka-lightbox__close\" aria-label=\"Cerrar\">×</button><img alt=\"\" />';
        document.body.appendChild(overlay);

        const overlayImg = overlay.querySelector('img');
        const close = () => overlay.classList.remove('is-visible');
        overlay.addEventListener('click', close);
        overlay.querySelector('button').addEventListener('click', close);

        galleryLinks.forEach((link) => {
            link.addEventListener('click', (event) => {
                event.preventDefault();
                overlayImg.src = link.href;
                overlay.classList.add('is-visible');
            });
        });
    }

    // Founder letter modal
    const letterModal = document.querySelector('[data-letter-modal]');
    if (letterModal) {
        const modalDialog = letterModal.querySelector('.origen-letter-modal__dialog');
        const letterOpeners = document.querySelectorAll('[data-letter-open]');
        const letterClosers = letterModal.querySelectorAll('[data-letter-close]');
        let activeTrigger = null;

        const closeModal = () => {
            letterModal.classList.remove('is-open');
            letterModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('kapunka-modal-open');
            if (activeTrigger && typeof activeTrigger.focus === 'function') {
                activeTrigger.focus();
            }
            activeTrigger = null;
        };

        const openModal = (trigger) => {
            activeTrigger = trigger || null;
            letterModal.classList.add('is-open');
            letterModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('kapunka-modal-open');
            window.setTimeout(() => {
                if (modalDialog) {
                    modalDialog.focus();
                }
            }, 10);
        };

        letterOpeners.forEach((opener) => {
            opener.addEventListener('click', () => openModal(opener));
        });

        letterClosers.forEach((closer) => {
            closer.addEventListener('click', closeModal);
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && letterModal.classList.contains('is-open')) {
                closeModal();
            }
        });
    }

    // Newsletter fallback validation
    document.querySelectorAll('.kapunka-newsletter form').forEach((form) => {
        form.addEventListener('submit', (event) => {
            const email = form.querySelector('input[type="email"]');
            if (email && !email.value) {
                event.preventDefault();
                email.focus();
            }
        });
    });
});
