<?php
/**
 * Luxury single product template.
 *
 * @package UnderstrapChild
 */

defined( 'ABSPATH' ) || exit;

remove_action( 'woocommerce_before_main_content', 'understrap_woocommerce_wrapper_start', 10 );
remove_action( 'woocommerce_after_main_content', 'understrap_woocommerce_wrapper_end', 10 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

if ( ! function_exists( 'kapunka_render_single_product_summary' ) ) {
    function kapunka_render_single_product_summary() : void {
        woocommerce_template_single_title();
        woocommerce_template_single_excerpt();
        woocommerce_template_single_price();
        woocommerce_template_single_add_to_cart();
    }
}
add_action( 'woocommerce_single_product_summary', 'kapunka_render_single_product_summary', 5 );

if ( ! function_exists( 'kapunka_related_products_heading' ) ) {
    function kapunka_related_products_heading() : string {
        return __( 'También te puede interesar', 'understrap' );
    }
}
add_filter( 'woocommerce_product_related_products_heading', 'kapunka_related_products_heading' );

get_header( 'shop' );

while ( have_posts() ) :
    the_post();

    /** @var WC_Product $product */
    global $product;

    $raw_description = get_the_content();
    $description     = $raw_description ? apply_filters( 'the_content', $raw_description ) : '';

    $key_benefits = trim( (string) kapunka_get_meta( 'product_key_benefits', '' ) );
    $ritual       = trim( (string) kapunka_get_meta( 'product_ritual', '' ) );
    $ingredients  = trim( (string) kapunka_get_meta( 'product_ingredients', '' ) );

    if ( '' === $key_benefits ) {
        $legacy_benefits = kapunka_get_meta( 'beneficios', array() );
        if ( ! empty( $legacy_benefits ) && is_array( $legacy_benefits ) ) {
            $legacy_benefits = array_map(
                static function ( $item ) {
                    if ( is_array( $item ) ) {
                        return trim( (string) ( $item['item'] ?? '' ) );
                    }
                    return trim( (string) $item );
                },
                $legacy_benefits
            );
            $key_benefits = trim( implode( "\n", array_filter( $legacy_benefits ) ) );
        }
    }

    if ( '' === $ritual ) {
        $legacy_ritual = kapunka_get_meta( 'instrucciones', '' );
        $ritual        = trim( (string) $legacy_ritual );
    }

    if ( '' === $ingredients ) {
        $legacy_ingredients = kapunka_get_meta( 'ingredientes', array() );
        if ( ! empty( $legacy_ingredients ) && is_array( $legacy_ingredients ) ) {
            $legacy_ingredients = array_map(
                static function ( $item ) {
                    if ( is_array( $item ) ) {
                        return trim( (string) ( $item['item'] ?? '' ) );
                    }
                    return trim( (string) $item );
                },
                $legacy_ingredients
            );
            $ingredients = trim( implode( "\n", array_filter( $legacy_ingredients ) ) );
        }
    }

    $accordion_items = array();

    if ( $description ) {
        $accordion_items[] = array(
            'title'   => __( 'Descripción', 'understrap' ),
            'content' => $description,
        );
    }

    if ( '' !== $key_benefits ) {
        $accordion_items[] = array(
            'title'   => __( 'Beneficios Clave', 'understrap' ),
            'content' => wp_kses_post( wpautop( $key_benefits ) ),
        );
    }

    if ( '' !== $ritual ) {
        $accordion_items[] = array(
            'title'   => __( 'Ritual de Uso', 'understrap' ),
            'content' => wp_kses_post( wpautop( $ritual ) ),
        );
    }

    if ( '' !== $ingredients ) {
        $accordion_items[] = array(
            'title'   => __( 'Ingredientes (INCI)', 'understrap' ),
            'content' => wp_kses_post( wpautop( $ingredients ) ),
        );
    }
    ?>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'kapunka-single-product', $product ); ?>>
        <?php do_action( 'woocommerce_before_single_product' ); ?>

        <section class="kapunka-product-fold">
            <div class="kapunka-product-fold__media" data-product-gallery>
                <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
            </div>

            <div class="kapunka-product-fold__summary summary entry-summary">
                <?php do_action( 'woocommerce_single_product_summary' ); ?>
            </div>
        </section>

        <?php do_action( 'woocommerce_after_single_product_summary' ); ?>

        <?php if ( ! empty( $accordion_items ) ) : ?>
            <section class="kapunka-product-accordion" id="kapunka-product-accordion">
                <?php foreach ( $accordion_items as $index => $item ) : ?>
                    <details class="kapunka-product-accordion__item"<?php echo 0 === $index ? ' open' : ''; ?>>
                        <summary>
                            <span><?php echo esc_html( $item['title'] ); ?></span>
                        </summary>
                        <div class="kapunka-product-accordion__content">
                            <?php echo wp_kses_post( $item['content'] ); ?>
                        </div>
                    </details>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>

        <section class="kapunka-related">
            <?php woocommerce_output_related_products(); ?>
        </section>

        <meta itemprop="url" content="<?php the_permalink(); ?>" />
    </div>

    <?php
endwhile;

get_footer( 'shop' );
