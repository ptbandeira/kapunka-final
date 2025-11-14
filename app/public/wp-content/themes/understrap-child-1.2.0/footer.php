<?php
/**
 * Footer template for the Kapunka theme
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 $container = get_theme_mod( 'understrap_container_type' );
?>

<footer class="site-footer">
    <div class="kapunka-footer kapunka-clamp">
        <div class="kapunka-footer__grid">
            <div class="kapunka-footer__column kapunka-footer__brand">
                <a class="kapunka-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">Kapunka</a>
                <p class="kapunka-footer__tagline"><?php esc_html_e( 'Agradece a tu piel.', 'understrap' ); ?></p>
                <p class="kapunka-footer__address"><?php esc_html_e( 'Barcelona · Cooperativas del Atlas', 'understrap' ); ?></p>
            </div>
            <div class="kapunka-footer__column">
                <p class="kapunka-footer__eyebrow"><?php esc_html_e( 'Explora', 'understrap' ); ?></p>
                <ul>
                    <li><a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"><?php esc_html_e( 'Tienda', 'understrap' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/profesionales/metodo-kapunka' ) ); ?>"><?php esc_html_e( 'Método Kapunka', 'understrap' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/aprende' ) ); ?>"><?php esc_html_e( 'Journal', 'understrap' ); ?></a></li>
                </ul>
            </div>
            <div class="kapunka-footer__column">
                <p class="kapunka-footer__eyebrow"><?php esc_html_e( 'Empresa', 'understrap' ); ?></p>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/el-origen#fundadora' ) ); ?>"><?php esc_html_e( 'Sobre Mónica Ruiz', 'understrap' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/impacto-social' ) ); ?>"><?php esc_html_e( 'Impacto social', 'understrap' ); ?></a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contacto' ) ); ?>"><?php esc_html_e( 'Contacto', 'understrap' ); ?></a></li>
                </ul>
            </div>
            <div class="kapunka-footer__column kapunka-footer__newsletter">
                <p class="kapunka-footer__eyebrow"><?php esc_html_e( 'Legal & Social', 'understrap' ); ?></p>
                <form class="kapunka-footer__form">
                    <label for="footer-email" class="screen-reader-text"><?php esc_html_e( 'Correo electrónico', 'understrap' ); ?></label>
                    <input id="footer-email" type="email" name="email" placeholder="hola@" required>
                    <button type="submit"><?php esc_html_e( 'Suscribirme', 'understrap' ); ?></button>
                </form>
                <div class="kapunka-footer__social">
                    <a class="kapunka-footer__social-link" href="https://instagram.com" target="_blank" rel="noreferrer" aria-label="Instagram">
                        <span class="screen-reader-text"><?php esc_html_e( 'Instagram', 'understrap' ); ?></span>
                        <svg class="kapunka-footer__social-icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="currentColor" stroke-width="1.6" fill="none" />
                            <circle cx="12" cy="12" r="4.2" stroke="currentColor" stroke-width="1.6" fill="none" />
                            <circle cx="17.2" cy="6.8" r="1.1" fill="currentColor" />
                        </svg>
                    </a>
                    <a class="kapunka-footer__social-link" href="https://linkedin.com" target="_blank" rel="noreferrer" aria-label="LinkedIn">
                        <span class="screen-reader-text"><?php esc_html_e( 'LinkedIn', 'understrap' ); ?></span>
                        <svg class="kapunka-footer__social-icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <rect x="3" y="9" width="4" height="12" fill="currentColor" />
                            <circle cx="5" cy="5" r="2" fill="currentColor" />
                            <path d="M11 9h4.2c2.7 0 4.8 2.1 4.8 4.8V21h-4v-6.3c0-1.2-1-2.3-2.3-2.3H11V9Z" fill="currentColor" />
                        </svg>
                    </a>
                </div>
                <div class="kapunka-footer__legal-links">
                    <a href="<?php echo esc_url( home_url( '/aviso-legal' ) ); ?>"><?php esc_html_e( 'Aviso legal', 'understrap' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/privacidad' ) ); ?>"><?php esc_html_e( 'Privacidad', 'understrap' ); ?></a>
                    <a href="<?php echo esc_url( home_url( '/cookies' ) ); ?>"><?php esc_html_e( 'Cookies', 'understrap' ); ?></a>
                </div>
            </div>
        </div>
        <div class="kapunka-footer__bottom">
            <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> Kapunka</p>
            <p><?php esc_html_e( 'La herramienta esencial para profesionales estéticos.', 'understrap' ); ?></p>
        </div>
    </div>
</footer>

<!-- Close divs from header.php -->
</div><!-- #page we need this for proper footer behavior -->

<?php wp_footer(); ?>
