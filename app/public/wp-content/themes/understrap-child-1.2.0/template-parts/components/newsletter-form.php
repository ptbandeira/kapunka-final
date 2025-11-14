<?php
/**
 * Newsletter signup component.
 *
 * Args:
 * - title
 * - description
 * - form_shortcode
 */

$title = $args['title'] ?? __( 'Únete a Kapunka', 'understrap' );
$description = $args['description'] ?? '';
$form_shortcode = $args['form_shortcode'] ?? '';
?>

<section class="kapunka-cta kapunka-newsletter">
    <div>
        <h2><?php echo esc_html( $title ); ?></h2>
        <?php if ( $description ) : ?>
            <p><?php echo esc_html( $description ); ?></p>
        <?php endif; ?>
    </div>

    <div class="kapunka-newsletter__form">
        <?php
        $newsletter_markup = kapunka_render_form_shortcode(
            $form_shortcode,
            static function() {
                ob_start();
                ?>
                <form class="kapunka-newsletter" action="#" method="post">
                    <input type="email" name="newsletter_email" placeholder="<?php esc_attr_e( 'Tu correo electrónico', 'understrap' ); ?>" required>
                    <button type="submit" class="kapunka-button"><?php esc_html_e( 'Suscribirme', 'understrap' ); ?></button>
                </form>
                <?php
                return ob_get_clean();
            }
        );

        echo $newsletter_markup;
        ?>
    </div>
</section>
