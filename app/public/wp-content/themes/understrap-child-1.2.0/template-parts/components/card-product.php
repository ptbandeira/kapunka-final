<?php
/**
 * Product card component.
 *
 * Expects:
 * - product: WC_Product instance
 * - badges: array of strings (optional)
 * - excerpt: string (optional)
 */

if ( ! class_exists( 'WC_Product' ) || ! isset( $args['product'] ) || ! $args['product'] instanceof WC_Product ) {
    return;
}

$product    = $args['product'];
$product_id = $product->get_id();
$permalink  = get_permalink( $product_id );
$image_id   = $product->get_image_id();
$image_html = $image_id ? wp_get_attachment_image( $image_id, 'kapunka-product-card', false, array( 'class' => 'kapunka-product-card__image' ) ) : '<div class="kapunka-product-card__image"></div>';
$badges     = $args['badges'] ?? array();
$context    = isset( $args['context'] ) ? sanitize_key( $args['context'] ) : '';
$card_class = 'kapunka-product-card';
if ( $context ) {
    $card_class .= ' kapunka-product-card--' . sanitize_html_class( $context );
}
$is_tienda_context = ( 'tienda' === $context );
$add_to_cart_button = sprintf(
    '<a class="kapunka-button" href="%1$s" data-product_id="%2$d">%3$s</a>',
    esc_url( $product->add_to_cart_url() ),
    esc_attr( $product_id ),
    esc_html__( 'Añadir al carrito', 'understrap' )
);

if ( empty( $badges ) ) {
    $badges = kapunka_get_meta( 'certificaciones', array(), $product_id );
}

$excerpt = $args['excerpt'] ?? ( $product->get_short_description() ?: wp_trim_words( strip_tags( $product->get_description() ), 20 ) );
?>

<article class="<?php echo esc_attr( $card_class ); ?>" data-product-id="<?php echo esc_attr( $product_id ); ?>">
    <div class="kapunka-product-card__media-wrap">
        <a href="<?php echo esc_url( $permalink ); ?>" class="kapunka-product-card__media">
            <?php echo wp_kses_post( $image_html ); ?>
        </a>
        <?php if ( $is_tienda_context ) : ?>
            <div class="kapunka-product-card__actions kapunka-product-card__actions--overlay">
                <?php echo wp_kses_post( $add_to_cart_button ); ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if ( ! empty( $badges ) && ! $is_tienda_context ) : ?>
        <div class="kapunka-product-card__badges">
            <?php foreach ( (array) $badges as $badge ) : ?>
                <span class="kapunka-product-card__badge"><?php echo esc_html( $badge ); ?></span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ( $is_tienda_context ) : ?>
        <div class="kapunka-product-card__row">
            <a class="kapunka-product-card__title" href="<?php echo esc_url( $permalink ); ?>">
                <?php echo esc_html( $product->get_name() ); ?>
            </a>
            <span class="kapunka-product-card__price">
                <?php echo wp_kses_post( $product->get_price_html() ); ?>
            </span>
        </div>
        <a class="kapunka-product-card__info-link" href="<?php echo esc_url( $permalink ); ?>">
            <?php esc_html_e( 'Más información', 'understrap' ); ?>
        </a>
    <?php else : ?>
        <h3 class="kapunka-product-card__title">
            <a href="<?php echo esc_url( $permalink ); ?>">
                <?php echo esc_html( $product->get_name() ); ?>
            </a>
        </h3>

        <?php if ( $excerpt ) : ?>
            <p class="kapunka-product-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
        <?php endif; ?>

        <div class="kapunka-product-card__price">
            <?php echo wp_kses_post( $product->get_price_html() ); ?>
        </div>
    <?php endif; ?>

    <?php if ( ! $is_tienda_context ) : ?>
        <div class="kapunka-product-card__actions">
            <?php echo wp_kses_post( $add_to_cart_button ); ?>
            <a class="kapunka-button is-outline" href="<?php echo esc_url( $permalink ); ?>">
                <?php esc_html_e( 'Ver detalles', 'understrap' ); ?>
            </a>
        </div>
    <?php endif; ?>
</article>
