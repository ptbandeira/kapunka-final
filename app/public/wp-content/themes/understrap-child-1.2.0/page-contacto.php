<?php
/**
 * Template Name: Kapunka Contacto
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero_eyebrow     = kapunka_get_meta( 'contacto_hero_eyebrow', __( 'Contacto directo', 'understrap' ) );
$hero_title       = kapunka_get_meta( 'contacto_hero_title', __( 'Hablemos de tu ritual o de tu cabina.', 'understrap' ) );
$contact_intro    = kapunka_get_meta( 'contacto_intro', __( 'Responderemos en menos de 24h hábiles. Para soporte de pedidos indica tu número de orden.', 'understrap' ) );
$contact_details  = kapunka_get_meta( 'contacto_details', array() );
$form_shortcode   = kapunka_get_meta( 'contacto_form_shortcode' );
$cta_block        = kapunka_get_meta( 'contacto_cta', array() );
$cta_entry        = is_array( $cta_block ) && ! empty( $cta_block ) ? $cta_block[0] : array();
$shop_url         = function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' );
$final_cta        = array(
    'eyebrow'   => kapunka_get_meta( 'contacto_final_eyebrow', __( '¿Listo para el siguiente paso?', 'understrap' ) ),
    'title'     => kapunka_get_meta( 'contacto_final_title', __( 'Solicita tu onboarding clínico o descubre los rituales para casa.', 'understrap' ) ),
    'primary'   => array(
        'label' => kapunka_get_meta( 'contacto_final_primary_label', __( 'Acceso profesional', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'contacto_final_primary_url', home_url( '/profesionales' ) ),
    ),
    'secondary' => array(
        'label' => kapunka_get_meta( 'contacto_final_secondary_label', __( 'Rituales para casa', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'contacto_final_secondary_url', $shop_url ),
    ),
);
?>

<main id="contacto-page" class="site-main contacto-main">
    <section class="hero-section text-left">
        <div class="kapunka-clamp">
            <?php if ( ! empty( $hero_eyebrow ) ) : ?>
                <p class="text-uppercase letter-spacing"><?php echo esc_html( $hero_eyebrow ); ?></p>
            <?php endif; ?>
            <h1><?php echo esc_html( $hero_title ); ?></h1>
            <?php if ( ! empty( $contact_intro ) ) : ?>
                <p><?php echo esc_html( $contact_intro ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="kapunka-section contacto-grid">
        <div class="kapunka-clamp contacto-grid__layout">
            <div class="contacto-grid__blocks">
                <?php if ( ! empty( $contact_details ) ) : ?>
                    <?php foreach ( $contact_details as $item ) : ?>
                        <article>
                            <p class="kapunka-tech"><?php echo esc_html( $item['label'] ); ?></p>
                            <p><?php echo wp_kses_post( $item['entry_value'] ); ?></p>
                        </article>
                    <?php endforeach; ?>
                <?php else : ?>
                    <article>
                        <p class="kapunka-tech"><?php esc_html_e( 'Atención profesional', 'understrap' ); ?></p>
                        <p>pro@kapunka.com<br/><?php esc_html_e( 'WhatsApp +34 000 000', 'understrap' ); ?></p>
                    </article>
                    <article>
                        <p class="kapunka-tech"><?php esc_html_e( 'Clientes particulares', 'understrap' ); ?></p>
                        <p>soporte@kapunka.com<br/><?php esc_html_e( 'Incluye tu número de pedido', 'understrap' ); ?></p>
                    </article>
                    <article>
                        <p class="kapunka-tech"><?php esc_html_e( 'Prensa & colaboraciones', 'understrap' ); ?></p>
                        <p>press@kapunka.com</p>
                    </article>
                <?php endif; ?>

                <?php if ( ! empty( $cta_entry ) ) : ?>
                    <div class="contacto-cta">
                        <?php if ( ! empty( $cta_entry['eyebrow'] ) ) : ?>
                            <p class="kapunka-tech"><?php echo esc_html( $cta_entry['eyebrow'] ); ?></p>
                        <?php endif; ?>
                        <h3><?php echo esc_html( $cta_entry['title'] ?? '' ); ?></h3>
                        <p><?php echo esc_html( $cta_entry['description'] ?? '' ); ?></p>
                        <?php if ( ! empty( $cta_entry['primary_url'] ) ) : ?>
                            <a class="contacto-cta__link" href="<?php echo esc_url( $cta_entry['primary_url'] ); ?>"><?php esc_html_e( 'Saber más →', 'understrap' ); ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="contact-form">
                <?php
                $contact_form_markup = kapunka_render_form_shortcode(
                    $form_shortcode,
                    static function() {
                        ob_start();
                        ?>
                        <form class="wpcf7-form" method="post" action="<?php echo esc_url( home_url( '/contacto' ) ); ?>">
                            <p>
                                <label>
                                    <span class="screen-reader-text"><?php esc_html_e( 'Nombre', 'understrap' ); ?></span>
                                    <input type="text" name="nombre" class="wpcf7-form-control" placeholder="<?php esc_attr_e( 'Nombre', 'understrap' ); ?>" required>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <span class="screen-reader-text"><?php esc_html_e( 'Email', 'understrap' ); ?></span>
                                    <input type="email" name="email" class="wpcf7-form-control" placeholder="<?php esc_attr_e( 'Correo electrónico', 'understrap' ); ?>" required>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <span class="screen-reader-text"><?php esc_html_e( 'Asunto', 'understrap' ); ?></span>
                                    <input type="text" name="asunto" class="wpcf7-form-control" placeholder="<?php esc_attr_e( 'Asunto', 'understrap' ); ?>" required>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <span class="screen-reader-text"><?php esc_html_e( 'Mensaje', 'understrap' ); ?></span>
                                    <textarea name="mensaje" rows="6" class="wpcf7-form-control" placeholder="<?php esc_attr_e( 'Mensaje', 'understrap' ); ?>"></textarea>
                                </label>
                            </p>
                            <p>
                                <button type="submit" class="wpcf7-form-control wpcf7-submit">
                                    <?php esc_html_e( 'Enviar mensaje', 'understrap' ); ?>
                                </button>
                            </p>
                        </form>
                        <?php
                        return ob_get_clean();
                    }
                );

                echo $contact_form_markup;
                ?>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $final_cta['title'] ) || ! empty( $final_cta['primary']['label'] ) || ! empty( $final_cta['secondary']['label'] ) ) : ?>
        <section class="kapunka-section contacto-cta-final">
            <div class="kapunka-clamp contacto-cta-final__wrap">
                <div>
                    <?php if ( ! empty( $final_cta['eyebrow'] ) ) : ?>
                        <p class="kapunka-tech"><?php echo esc_html( $final_cta['eyebrow'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $final_cta['title'] ) ) : ?>
                        <h2><?php echo esc_html( $final_cta['title'] ); ?></h2>
                    <?php endif; ?>
                </div>
                <div class="contacto-cta-final__actions">
                    <?php if ( ! empty( $final_cta['primary']['label'] ) && ! empty( $final_cta['primary']['url'] ) ) : ?>
                        <a class="contacto-cta-final__link" href="<?php echo esc_url( $final_cta['primary']['url'] ); ?>"><?php echo esc_html( $final_cta['primary']['label'] ); ?></a>
                    <?php endif; ?>
                    <?php if ( ! empty( $final_cta['secondary']['label'] ) && ! empty( $final_cta['secondary']['url'] ) ) : ?>
                        <a class="contacto-cta-final__link" href="<?php echo esc_url( $final_cta['secondary']['url'] ); ?>"><?php echo esc_html( $final_cta['secondary']['label'] ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
