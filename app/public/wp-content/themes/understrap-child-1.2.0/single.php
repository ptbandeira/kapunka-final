<?php
/**
 * Single article template.
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

?>

<main id="primary" class="site-main article-single">
    <?php
    while ( have_posts() ) :
        the_post();

        $reading_time = kapunka_get_meta( 'tiempo_de_lectura' );
        $author_info  = array(
            'nombre' => kapunka_get_meta( 'autor_nombre' ),
            'rol'    => kapunka_get_meta( 'autor_rol' ),
            'notas'  => kapunka_get_meta( 'autor_notas' ),
        );
        $toc        = kapunka_get_meta( 'tabla_contenidos', array() );
        $references = kapunka_get_meta( 'referencias_cientificas', array() );
        $related_product_ids = kapunka_parse_association_ids( kapunka_get_meta( 'productos_relacionados', array() ) );
        $related_article_ids = kapunka_parse_association_ids( kapunka_get_meta( 'articulos_relacionados', array() ) );
        ?>

        <article <?php post_class(); ?>>
            <header class="article-hero">
                <div class="kapunka-clamp article-hero__inner">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="article-hero__media">
                            <?php the_post_thumbnail( 'kapunka-article-card', array( 'loading' => 'lazy' ) ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="article-hero__content">
                        <p class="text-uppercase letter-spacing"><?php echo wp_kses_post( get_the_category_list( ', ' ) ); ?></p>
                        <h1><?php the_title(); ?></h1>
                        <div class="article-meta">
                            <span><?php echo esc_html( get_the_date() ); ?></span>
                            <?php if ( $reading_time ) : ?>
                                <span>· <?php echo esc_html( $reading_time ); ?></span>
                            <?php endif; ?>
                            <?php if ( ! empty( $author_info['nombre'] ) ) : ?>
                                <span>· <?php echo esc_html( $author_info['nombre'] ); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </header>

            <?php if ( ! empty( $toc ) ) : ?>
                <nav class="article-toc kapunka-clamp">
                    <p><?php esc_html_e( 'Contenido', 'understrap' ); ?></p>
                    <ul>
                        <?php foreach ( $toc as $item ) : ?>
                            <li><a href="<?php echo esc_url( $item['anchor'] ?? '#' ); ?>" class="js-scroll-to"><?php echo esc_html( $item['label'] ); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>

            <div class="article-content kapunka-clamp">
                <?php the_content(); ?>
            </div>

            <?php if ( ! empty( $references ) ) : ?>
                <section class="article-references kapunka-clamp">
                    <h2><?php esc_html_e( 'Referencias científicas', 'understrap' ); ?></h2>
                    <ol>
                        <?php foreach ( $references as $reference ) : ?>
                            <li>
                                <?php echo esc_html( $reference['title'] ?? '' ); ?>
                                <?php if ( ! empty( $reference['journal'] ) ) : ?>
                                    <em><?php echo esc_html( $reference['journal'] ); ?></em>
                                <?php endif; ?>
                                <?php if ( ! empty( $reference['year'] ) ) : ?>
                                    (<?php echo esc_html( $reference['year'] ); ?>)
                                <?php endif; ?>
                                <?php if ( ! empty( $reference['link'] ) ) : ?>
                                    <a href="<?php echo esc_url( $reference['link'] ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Ver estudio', 'understrap' ); ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </section>
            <?php endif; ?>

            <?php if ( ! empty( $related_product_ids ) && function_exists( 'wc_get_product' ) ) : ?>
                <section class="article-related-products kapunka-clamp">
                    <h2><?php esc_html_e( 'Productos relacionados', 'understrap' ); ?></h2>
                    <div class="kapunka-grid">
                        <?php
                        foreach ( $related_product_ids as $product_id ) {
                            $product = wc_get_product( $product_id );
                            if ( ! $product ) {
                                continue;
                            }
                            kapunka_component(
                                'card-product',
                                array(
                                    'product' => $product,
                                )
                            );
                        }
                        ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php
            if ( ! empty( $related_article_ids ) ) :
                $related_posts = array_filter(
                    array_map(
                        static function( $post_id ) {
                            return get_post( $post_id );
                        },
                        $related_article_ids
                    )
                );
                if ( ! empty( $related_posts ) ) :
                    ?>
                <section class="article-related-posts kapunka-clamp">
                    <h2><?php esc_html_e( 'Lecturas recomendadas', 'understrap' ); ?></h2>
                    <div class="article-related-posts__grid">
                        <?php foreach ( $related_posts as $related_post ) : ?>
                            <?php
                            kapunka_component(
                                'card-article',
                                array(
                                    'post' => $related_post,
                                )
                            );
                            ?>
                        <?php endforeach; ?>
                    </div>
                </section>
                    <?php endif; ?>
            <?php endif; ?>

            <?php
            kapunka_component(
                'newsletter-form',
                array(
                    'title'          => __( 'Únete a nuestra biblioteca clínica', 'understrap' ),
                    'description'    => __( 'Notas mensuales sobre piel, ciencia y rituales.', 'understrap' ),
                    'form_shortcode' => kapunka_get_option( 'newsletter_shortcode' ),
                )
            );
            ?>
        </article>

        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
