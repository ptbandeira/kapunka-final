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

    // Home testimonials slider
    document.querySelectorAll('.home-testimonials__slider').forEach((slider) => {
        const slides = slider.querySelectorAll('.home-testimonials__slide');
        const dots = slider.querySelectorAll('.home-testimonials__dot');
        if (!slides.length) {
            return;
        }

        let index = 0;
        let autoplay = null;

        const setActive = (nextIndex) => {
            index = nextIndex;
            slides.forEach((slide, idx) => {
                slide.classList.toggle('is-active', idx === index);
            });
            dots.forEach((dot, idx) => {
                const isActive = idx === index;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });
        };

        const stopAutoplay = () => {
            if (autoplay) {
                window.clearInterval(autoplay);
                autoplay = null;
            }
        };

        const startAutoplay = () => {
            if (slides.length < 2) {
                return;
            }
            stopAutoplay();
            autoplay = window.setInterval(() => {
                const nextIndex = (index + 1) % slides.length;
                setActive(nextIndex);
            }, 9000);
        };

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const targetIndex = Number(dot.getAttribute('data-target'));
                if (!Number.isNaN(targetIndex)) {
                    setActive(targetIndex);
                    startAutoplay();
                }
            });
        });

        slider.addEventListener('mouseenter', stopAutoplay);
        slider.addEventListener('mouseleave', startAutoplay);

        setActive(0);
        startAutoplay();
    });

    // Generic fade slider (Interlude, Highlights)
    document.querySelectorAll('[data-fade-slider]').forEach((slider) => {
        const slides = slider.querySelectorAll('.kapunka-fade-slide');
        if (slides.length <= 1) {
            slides.forEach((slide) => {
                slide.classList.add('is-active');
                slide.setAttribute('aria-hidden', 'false');
            });
            return;
        }

        const sliderId = slider.getAttribute('data-fade-slider') || 'fade-slider';
        const dots = document.querySelectorAll(`[data-fade-dot="${sliderId}"]`);
        let index = 0;
        let timer = null;

        const setActive = (nextIndex) => {
            index = nextIndex;
            slides.forEach((slide, idx) => {
                const isActive = idx === index;
                slide.classList.toggle('is-active', isActive);
                slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
            });
            dots.forEach((dot, idx) => {
                const isActive = idx === index;
                dot.classList.toggle('is-active', isActive);
                dot.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });
        };

        const stop = () => {
            if (timer) {
                window.clearInterval(timer);
                timer = null;
            }
        };

        const start = () => {
            if (slides.length < 2) {
                return;
            }
            stop();
            timer = window.setInterval(() => {
                const next = (index + 1) % slides.length;
                setActive(next);
            }, 6000);
        };

        dots.forEach((dot) => {
            dot.addEventListener('click', () => {
                const target = Number(dot.getAttribute('data-fade-target'));
                if (!Number.isNaN(target)) {
                    setActive(target);
                    start();
                }
            });
        });

        const section = slider.closest('[data-fade-section]');
        if (section) {
            section.addEventListener('mouseenter', stop);
            section.addEventListener('mouseleave', start);
        }

        setActive(0);
        start();
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

    // Generic mini case modals
    const caseOpeners = document.querySelectorAll('[data-case-open]');
    const caseModals = document.querySelectorAll('[data-case-modal]');
    if (caseOpeners.length && caseModals.length) {
        let activeCaseModal = null;
        let caseTrigger = null;

        const findModal = (id) => document.querySelector(`[data-case-modal="${id}"]`);

        const closeCaseModal = () => {
            if (!activeCaseModal) {
                return;
            }
            activeCaseModal.classList.remove('is-open');
            activeCaseModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('kapunka-modal-open');
            if (caseTrigger && typeof caseTrigger.focus === 'function') {
                caseTrigger.focus();
            }
            activeCaseModal = null;
            caseTrigger = null;
        };

        caseOpeners.forEach((opener) => {
            opener.addEventListener('click', () => {
                const target = opener.getAttribute('data-case-open');
                const modal = findModal(target);
                if (!modal) {
                    return;
                }
                activeCaseModal = modal;
                caseTrigger = opener;
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.classList.add('kapunka-modal-open');
                const dialog = modal.querySelector('.spa-case-modal__dialog');
                window.setTimeout(() => {
                    if (dialog) {
                        dialog.focus();
                    }
                }, 10);
            });
        });

        caseModals.forEach((modal) => {
            modal.querySelectorAll('[data-case-close]').forEach((closer) => {
                closer.addEventListener('click', closeCaseModal);
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && activeCaseModal) {
                closeCaseModal();
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

    const downloadModal = document.querySelector('[data-download-modal]');
    if (downloadModal) {
        const openers = document.querySelectorAll('[data-download-open]');
        const closeButtons = downloadModal.querySelectorAll('[data-download-close]');
        const resourceInput = downloadModal.querySelector('input[name="resource_key"]');
        const pageInput = downloadModal.querySelector('input[name="page_id"]');
        const defaultPageId = pageInput ? pageInput.value : '';
        const resourceLabel = downloadModal.querySelector('[data-download-resource-label]');
        const form = downloadModal.querySelector('[data-download-form]');
        const statusEl = downloadModal.querySelector('[data-download-status]');
        const successEl = downloadModal.querySelector('[data-download-success]');
        const dialog = downloadModal.querySelector('.spa-download-modal__dialog');
        let activeTrigger = null;

        const closeDownload = () => {
            downloadModal.classList.remove('is-open');
            downloadModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('kapunka-modal-open');
            if (activeTrigger && typeof activeTrigger.focus === 'function') {
                activeTrigger.focus();
            }
            activeTrigger = null;
        };

        const openDownload = (trigger) => {
            activeTrigger = trigger;
            downloadModal.classList.add('is-open');
            downloadModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('kapunka-modal-open');
            window.setTimeout(() => {
                if (dialog) {
                    dialog.focus();
                }
            }, 10);
        };

        openers.forEach((opener) => {
            opener.addEventListener('click', () => {
                const key = opener.getAttribute('data-resource');
                const label = opener.getAttribute('data-resource-label');
                if (resourceInput) {
                    resourceInput.value = key || '';
                }
                if (resourceLabel && label) {
                    resourceLabel.textContent = label;
                }
                if (statusEl) {
                    statusEl.textContent = '';
                }
                if (successEl) {
                    successEl.textContent = '';
                }
                if (form) {
                    form.reset();
                    if (resourceInput) {
                        resourceInput.value = key || '';
                    }
                    if (pageInput) {
                        pageInput.value = defaultPageId;
                    }
                }
                openDownload(opener);
            });
        });

        closeButtons.forEach((btn) => btn.addEventListener('click', closeDownload));
        downloadModal.addEventListener('click', (event) => {
            if (event.target === downloadModal) {
                closeDownload();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && downloadModal.classList.contains('is-open')) {
                closeDownload();
            }
        });

        if (form) {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                if (statusEl) {
                    statusEl.textContent = '';
                }
                if (successEl) {
                    successEl.textContent = '';
                }

                const formData = new FormData(form);
                formData.append('action', 'kapunka_download_resource');
                formData.append('nonce', (window.kapunkaAjax && window.kapunkaAjax.nonce) || '');

                const fetchUrl = (window.kapunkaAjax && window.kapunkaAjax.ajaxUrl) || (window.ajaxurl || '');

                fetch(fetchUrl, {
                    method: 'POST',
                    body: formData,
                })
                    .then((response) => response.json())
                    .then((payload) => {
                        if (payload.success) {
                            if (successEl) {
                                successEl.textContent = payload.data && payload.data.message ? payload.data.message : (window.kapunkaAjax && window.kapunkaAjax.successCommon) || '';
                            }
                            form.reset();
                            if (resourceInput) {
                                resourceInput.value = '';
                            }
                        } else if (statusEl) {
                            statusEl.textContent = (payload.data && payload.data.message) || (window.kapunkaAjax && window.kapunkaAjax.genericError) || '';
                        }
                    })
                    .catch(() => {
                        if (statusEl) {
                            statusEl.textContent = (window.kapunkaAjax && window.kapunkaAjax.genericError) || '';
                        }
                    });
            });
        }
    }

    // Método Kapunka form handler
    const metodoForm = document.getElementById('metodo-training-form');
    if (metodoForm) {
        const submitBtn = metodoForm.querySelector('.metodo-form__submit');
        const statusEl = metodoForm.querySelector('.metodo-form__status');
        
        metodoForm.addEventListener('submit', (event) => {
            event.preventDefault();
            
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Enviando...';
            }
            
            if (statusEl) {
                statusEl.textContent = '';
                statusEl.className = 'metodo-form__status';
            }
            
            // Clear previous errors
            metodoForm.querySelectorAll('.metodo-form__error').forEach((errorEl) => {
                errorEl.textContent = '';
            });
            metodoForm.querySelectorAll('.metodo-form__input, .metodo-form__textarea').forEach((input) => {
                input.classList.remove('has-error');
            });
            
            const formData = new FormData(metodoForm);
            // Ensure nonce is included
            if (window.kapunkaAjax && window.kapunkaAjax.metodoNonce) {
                const nonceInput = metodoForm.querySelector('input[name="kapunka_metodo_nonce"]');
                if (!nonceInput) {
                    formData.append('kapunka_metodo_nonce', window.kapunkaAjax.metodoNonce);
                }
            }
            const fetchUrl = (window.kapunkaAjax && window.kapunkaAjax.ajaxUrl) || (window.ajaxurl || '');
            
            fetch(fetchUrl, {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((payload) => {
                    if (payload.success) {
                        if (statusEl) {
                            statusEl.textContent = payload.data && payload.data.message ? payload.data.message : 'Gracias. Recibimos su solicitud. Le contactaremos en 48 h hábiles.';
                            statusEl.className = 'metodo-form__status has-success';
                        }
                        metodoForm.reset();
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = metodoForm.dataset.submitText || 'Solicitar información';
                        }
                    } else {
                        const errorMessage = (payload.data && payload.data.message) || 'Hubo un error. Intente nuevamente.';
                        const errorField = payload.data && payload.data.field;
                        
                        if (errorField) {
                            const fieldInput = metodoForm.querySelector(`[name="${errorField}"]`);
                            if (fieldInput) {
                                fieldInput.classList.add('has-error');
                                const errorEl = fieldInput.closest('.metodo-form__field').querySelector('.metodo-form__error');
                                if (errorEl) {
                                    errorEl.textContent = errorMessage;
                                }
                            }
                        }
                        
                        if (statusEl) {
                            statusEl.textContent = errorMessage;
                            statusEl.className = 'metodo-form__status has-error';
                        }
                        
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = metodoForm.dataset.submitText || 'Solicitar información';
                        }
                    }
                })
                .catch((error) => {
                    console.error('Form submission error:', error);
                    if (statusEl) {
                        statusEl.textContent = 'Hubo un error al enviar. Intente nuevamente.';
                        statusEl.className = 'metodo-form__status has-error';
                    }
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = metodoForm.dataset.submitText || 'Solicitar información';
                    }
                });
        });
    }
});
