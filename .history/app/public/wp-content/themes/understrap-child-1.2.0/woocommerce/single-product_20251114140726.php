<?php
/**
 * Kapunka single product template.
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

    do_action( 'woocommerce_before_single_product' );

    if ( post_password_required() ) {
        echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        continue;
    }

    $accordion_meta   = kapunka_get_meta( 'crb_product_accordion', array() );
    $accordion_items  = array();
    $default_fallback = array();
    $legacy_sections  = array();

    $legacy_description = get_the_content();
    $legacy_benefits    = kapunka_get_meta( 'product_key_benefits', '' );
    $legacy_ritual      = kapunka_get_meta( 'product_ritual', '' );
    $legacy_ingredients = kapunka_get_meta( 'product_ingredients', '' );

    if ( '' === trim( (string) $legacy_benefits ) ) {
        $benefits_list = kapunka_get_meta( 'beneficios', array() );
        if ( ! empty( $benefits_list ) && is_array( $benefits_list ) ) {
            $benefits_list    = array_map(
                static function ( $item ) {
                    return is_array( $item ) ? trim( (string) ( $item['item'] ?? '' ) ) : trim( (string) $item );
                },
                $benefits_list
            );
            $legacy_benefits = implode( "\n", array_filter( $benefits_list ) );
        }
    }

    if ( '' === trim( (string) $legacy_ritual ) ) {
        $legacy_ritual = kapunka_get_meta( 'instrucciones', '' );
    }

    if ( '' === trim( (string) $legacy_ingredients ) ) {
        $ingredients_list = kapunka_get_meta( 'ingredientes', array() );
        if ( ! empty( $ingredients_list ) && is_array( $ingredients_list ) ) {
            $ingredients_list  = array_map(
                static function ( $item ) {
                    return is_array( $item ) ? trim( (string) ( $item['item'] ?? '' ) ) : trim( (string) $item );
                },
                $ingredients_list
            );
            $legacy_ingredients = implode( "\n", array_filter( $ingredients_list ) );
        }
    }

    if ( ! empty( $accordion_meta ) && is_array( $accordion_meta ) ) {
        foreach ( $accordion_meta as $item ) {
            $title   = isset( $item['crb_product_accordion_title'] ) ? trim( (string) $item['crb_product_accordion_title'] ) : '';
            $content = isset( $item['crb_product_accordion_content'] ) ? (string) $item['crb_product_accordion_content'] : '';

            if ( '' === $title && '' === trim( wp_strip_all_tags( $content ) ) ) {
                continue;
            }

            $accordion_items[] = array(
                'title'   => $title,
                'content' => apply_filters( 'the_content', $content ),
            );
        }
    }

    if ( empty( $accordion_items ) ) {
        $raw_description = get_the_content();

        if ( $raw_description ) {
            $default_fallback[] = array(
                'title'   => __( 'Descripción', 'understrap' ),
                'content' => apply_filters( 'the_content', $raw_description ),
            );
        }

        $raw_excerpt = $product->get_short_description();
        if ( $raw_excerpt ) {
            $default_fallback[] = array(
                'title'   => __( 'Beneficios Clínicos', 'understrap' ),
                'content' => apply_filters( 'the_content', $raw_excerpt ),
            );
        }

        $accordion_items = $default_fallback;
    }
    ?>

    <div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'kapunka-single-product', $product ); ?>>
        <section class="kapunka-product-fold">
            <div class="kapunka-product-fold__media" data-product-gallery>
                <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
            </div>

            <div class="kapunka-product-fold__summary entry-summary">
                <h1 class="product_title entry-title"><?php the_title(); ?></h1>

                <?php
                $short_description = apply_filters( 'woocommerce_short_description', $product->get_short_description() );
                if ( $short_description ) :
                    ?>
                    <div class="woocommerce-product-details__short-description">
                        <?php echo wp_kses_post( $short_description ); ?>
                    </div>
                <?php endif; ?>

                <?php woocommerce_template_single_price(); ?>
                <?php woocommerce_template_single_add_to_cart(); ?>
            </div>
        </section>

        <?php if ( ! empty( $accordion_items ) ) : ?>
            <section class="kapunka-product-accordion" id="kapunka-product-accordion">
                <?php foreach ( $accordion_items as $index => $item ) :
                    $is_open = 0 === $index ? ' open' : '';
                    ?>
                    <details class="kapunka-product-accordion__item"<?php echo $is_open; ?>>
                        <summary>
                            <span><?php echo esc_html( $item['title'] ); ?></span>
                            <span class="kapunka-product-accordion__icon" aria-hidden="true"></span>
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

        <?php do_action( 'woocommerce_after_single_product' ); ?>
    </div>

    <?php
endwhile;

get_footer( 'shop' );
