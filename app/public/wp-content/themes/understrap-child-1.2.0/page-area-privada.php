<?php
/**
 * Template Name: Área Privada
 * Template Post Type: page
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$account_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
$has_woo_shortcode = shortcode_exists( 'woocommerce_my_account' );
?>

<main id="area-privada-page" class="site-main site-main--profesionales-detail area-privada-page">
    <section class="area-privada">
        <div class="kapunka-clamp area-privada__inner">
            <div class="area-privada__copy">
                <p class="text-uppercase letter-spacing"><?php esc_html_e( 'Área privada Kapunka', 'understrap' ); ?></p>
                <h1><?php esc_html_e( 'Bienvenido de nuevo.', 'understrap' ); ?></h1>
                <p><?php esc_html_e( 'Acceda a sus tarifas exclusivas, pedidos rápidos y materiales de formación.', 'understrap' ); ?></p>
            </div>
            <div class="area-privada__form">
                <?php if ( $has_woo_shortcode ) : ?>
                    <?php echo do_shortcode( '[woocommerce_my_account]' ); ?>
                <?php else : ?>
                    <form method="post" action="<?php echo esc_url( wp_login_url() ); ?>" class="area-privada__fallback-form">
                        <label>
                            <span><?php esc_html_e( 'Correo electrónico', 'understrap' ); ?></span>
                            <input type="email" name="log" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Contraseña', 'understrap' ); ?></span>
                            <input type="password" name="pwd" required>
                        </label>
                        <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Acceder', 'understrap' ); ?></button>
                    </form>
                    <p class="area-privada__help">
                        <a href="<?php echo esc_url( wp_lostpassword_url( $account_url ) ); ?>">
                            <?php esc_html_e( '¿Olvidaste tu contraseña?', 'understrap' ); ?>
                        </a>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
