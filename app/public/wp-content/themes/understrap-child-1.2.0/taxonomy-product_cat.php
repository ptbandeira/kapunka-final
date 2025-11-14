<?php
/**
 * Product category archive template.
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$term = get_queried_object();
$hero_description = term_description( $term );
?>

<main id="product-category-page" class="site-main">
    <section class="hero-section text-left">
        <div class="container">
            <p class="text-uppercase letter-spacing"><?php esc_html_e( 'Colección', 'understrap' ); ?></p>
            <h1><?php echo esc_html( single_term_title( '', false ) ); ?></h1>
            <?php if ( $hero_description ) : ?>
                <div class="term-description"><?php echo wp_kses_post( wpautop( $hero_description ) ); ?></div>
            <?php endif; ?>
        </div>
    </section>

    <section class="container product-grid">
        <div class="kapunka-grid">
            <?php if ( have_posts() ) : ?>
                <?php
                while ( have_posts() ) :
                    the_post();
                    global $product;
                    if ( $product instanceof WC_Product ) {
                        kapunka_component(
                            'card-product',
                            array(
                                'product' => $product,
                            )
                        );
                    } else {
                        wc_get_template_part( 'content', 'product' );
                    }
                endwhile;
                ?>
            <?php else : ?>
                <p><?php esc_html_e( 'No se han encontrado productos en esta categoría.', 'understrap' ); ?></p>
            <?php endif; ?>
        </div>

        <?php woocommerce_pagination(); ?>
    </section>
</main>

<?php
get_footer();
