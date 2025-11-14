<?php
/*
Template Name: Kapunka Home
*/

defined( 'ABSPATH' ) || exit;

get_header();

$kapunka_shop_url = function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' );

$ritual_products = array();
if ( function_exists( 'wc_get_products' ) ) {
    $ritual_products = wc_get_products(
        array(
            'limit'   => 3,
            'orderby' => 'menu_order',
            'order'   => 'ASC',
            'status'  => 'publish',
        )
    );
}

$hero = array(
    'eyebrow'     => kapunka_get_meta( 'home_hero_eyebrow', __( 'CIENCIA Y NATURALEZA', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'home_hero_title', __( 'Agradece a tu piel', 'understrap' ) ),
    'description' => kapunka_get_meta( 'home_hero_description', __( 'El argán 100% BIO perfeccionado para la alta exigencia estética.', 'understrap' ) ),
    'primary'     => array(
        'label' => kapunka_get_meta( 'home_hero_primary_label', __( 'Explorar colección', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'home_hero_primary_url', $kapunka_shop_url ),
    ),
    'secondary'   => array(
        'label' => kapunka_get_meta( 'home_hero_secondary_label', __( 'Acceso Profesionales', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'home_hero_secondary_url', home_url( '/profesionales' ) ),
    ),
    'background_id' => (int) kapunka_get_meta( 'home_hero_background', 0 ),
);

$home_hook = array(
    'title'       => kapunka_get_meta( 'home_hook_title', __( 'Más que un aceite. Un método.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'home_hook_description', __( 'Kapunka no es solo un ingrediente; es la fusión de un abastecimiento ético en Marruecos y un protocolo clínico desarrollado durante 35 años. Diseñado para quienes exigen resultados visibles sin comprometer la pureza.', 'understrap' ) ),
);

$home_social_slides = kapunka_get_meta( 'home_social_slides', array() );
if ( empty( $home_social_slides ) || ! is_array( $home_social_slides ) ) {
    $home_social_slides = array(
        array(
            'quote'  => __( '“Imprescindible en nuestros protocolos de recuperación post-láser. La pureza que exigía mi clínica.”', 'understrap' ),
            'author' => __( '— Dra. Martínez, Dermatóloga', 'understrap' ),
        ),
        array(
            'quote'  => __( '“Nuestros clientes de spa notan la diferencia inmediata en textura y absorción.”', 'understrap' ),
            'author' => __( '— Sarah L., Directora de Wellness, Hotel Arts', 'understrap' ),
        ),
    );
}

$home_trinity_items = kapunka_get_meta( 'home_trinity_items', array() );
if ( empty( $home_trinity_items ) || ! is_array( $home_trinity_items ) ) {
    $home_trinity_items = array(
        array(
            'title'       => __( 'Origen.', 'understrap' ),
            'description' => __( 'Primera prensada en frío de cooperativas femeninas certificadas.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Ciencia.', 'understrap' ),
            'description' => __( '100% pureza validada. Rico en Vitamina E y ácidos grasos esenciales.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Método.', 'understrap' ),
            'description' => __( 'Protocolos de aplicación propios que maximizan la absorción.', 'understrap' ),
        ),
    );
}

$home_evidence = array(
    'eyebrow' => kapunka_get_meta( 'home_evidence_eyebrow', __( 'Evidencia clínica', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'home_evidence_title', __( 'Resultados que se sienten y se miden.', 'understrap' ) ),
    'cta'     => array(
        'label' => kapunka_get_meta( 'home_evidence_cta_label', __( 'Descargar fichas clínicas', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'home_evidence_cta_url', home_url( '/profesionales#recursos' ) ),
    ),
);

$home_evidence_stats = kapunka_get_meta( 'home_evidence_stats', array() );
if ( empty( $home_evidence_stats ) || ! is_array( $home_evidence_stats ) ) {
    $home_evidence_stats = array(
        array(
            'stat'       => '+32%',
            'description'=> __( 'Retención de hidratación en 72h tras láser fraccionado.', 'understrap' ),
        ),
        array(
            'stat'       => '90%',
            'description'=> __( 'De profesionales reportan mejor deslizamiento manual.', 'understrap' ),
        ),
        array(
            'stat'       => '-48%',
            'description'=> __( 'Sensación de ardor en protocolos post-peeling.', 'understrap' ),
        ),
    );
}

$home_program = array(
    'eyebrow'     => kapunka_get_meta( 'home_program_eyebrow', __( 'Programa profesional', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'home_program_title', __( 'Formaciones presenciales y soporte remoto para integrar Kapunka en tu menú.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'home_program_description', __( 'Diagnóstico táctil, protocolos faciales, retail inteligente y abastecimiento recurrente en un solo onboarding.', 'understrap' ) ),
    'cta'         => array(
        'label' => kapunka_get_meta( 'home_program_cta_label', __( 'Ver módulos', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'home_program_cta_url', home_url( '/profesionales' ) ),
    ),
);

$home_journal = array(
    'eyebrow' => kapunka_get_meta( 'home_journal_eyebrow', __( 'Journal', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'home_journal_title', __( 'Reflexiones clínicas, casos y rituales guiados.', 'understrap' ) ),
    'cta'     => array(
        'label' => kapunka_get_meta( 'home_journal_cta_label', __( 'Entrar al Journal', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'home_journal_cta_url', home_url( '/aprende' ) ),
    ),
);

$home_newsletter = array(
    'eyebrow'     => kapunka_get_meta( 'home_newsletter_eyebrow', __( 'Newsletter', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'home_newsletter_title', __( 'Notas clínicas y rituales nuevos, una vez al mes.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'home_newsletter_description', __( 'Sin ruido. Solo protocolos descargables y playlists para cabina.', 'understrap' ) ),
    'placeholder' => kapunka_get_meta( 'home_newsletter_placeholder', 'hola@' ),
    'button'      => kapunka_get_meta( 'home_newsletter_button', __( 'Suscribirme', 'understrap' ) ),
    'shortcode'   => kapunka_get_meta( 'home_newsletter_shortcode', '' ),
);

$journal_query = new WP_Query(
    array(
        'post_type'      => 'post',
        'posts_per_page' => 2,
        'ignore_sticky_posts' => true,
    )
);
?>

<section class="hero-section hero-section--home">
    <div class="hero-background">
        <?php
        if ( $hero['background_id'] ) {
            echo wp_get_attachment_image( $hero['background_id'], 'full', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) );
        } else {
            ?>
            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/hero-bg.jpg' ); ?>" alt="<?php esc_attr_e( 'Kapunka hero', 'understrap' ); ?>" />
            <?php
        }
        ?>
    </div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="kapunka-clamp">
            <div class="hero-content__inner">
                <?php if ( '' !== trim( (string) $hero['eyebrow'] ) ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $hero['title'] ) ) : ?>
                    <h1><?php echo esc_html( $hero['title'] ); ?></h1>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $hero['description'] ) ) : ?>
                    <p><?php echo esc_html( $hero['description'] ); ?></p>
                <?php endif; ?>
                <div class="hero-cta">
                    <?php if ( ! empty( $hero['primary']['label'] ) && ! empty( $hero['primary']['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $hero['primary']['url'] ); ?>" class="btn btn-primary btn-primary--invert"><?php echo esc_html( $hero['primary']['label'] ); ?></a>
                    <?php endif; ?>
                    <?php if ( ! empty( $hero['secondary']['label'] ) && ! empty( $hero['secondary']['url'] ) ) : ?>
                        <a href="<?php echo esc_url( $hero['secondary']['url'] ); ?>" class="hero-link"><?php echo esc_html( $hero['secondary']['label'] ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-scroll-indicator" aria-hidden="true">
        <span></span>
    </div>
</section>

<main id="home-page" class="site-main home-main">
    <section class="kapunka-section home-hook">
        <div class="kapunka-clamp">
            <?php if ( '' !== trim( (string) $home_hook['title'] ) ) : ?>
                <h2><?php echo esc_html( $home_hook['title'] ); ?></h2>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $home_hook['description'] ) ) : ?>
                <p><?php echo esc_html( $home_hook['description'] ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="kapunka-section home-social">
        <div class="kapunka-clamp">
            <div class="home-social__slider">
                <?php foreach ( $home_social_slides as $slide ) :
                    $quote  = isset( $slide['quote'] ) ? trim( (string) $slide['quote'] ) : '';
                    $author = isset( $slide['author'] ) ? trim( (string) $slide['author'] ) : '';

                    if ( '' === $quote ) {
                        continue;
                    }
                    ?>
                    <article class="home-social__slide">
                        <p class="home-social__quote"><?php echo esc_html( $quote ); ?></p>
                        <?php if ( '' !== $author ) : ?>
                            <p class="home-social__author"><?php echo esc_html( $author ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="kapunka-section home-trinity">
        <div class="kapunka-clamp">
            <div class="home-trinity__grid">
                <?php foreach ( $home_trinity_items as $item ) :
                    $title = isset( $item['title'] ) ? trim( (string) $item['title'] ) : '';
                    $desc  = isset( $item['description'] ) ? trim( (string) $item['description'] ) : '';

                    if ( '' === $title && '' === $desc ) {
                        continue;
                    }
                    ?>
                    <article>
                        <?php if ( '' !== $title ) : ?>
                            <h3><?php echo esc_html( $title ); ?></h3>
                        <?php endif; ?>
                        <?php if ( '' !== $desc ) : ?>
                            <p><?php echo esc_html( $desc ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="kapunka-section home-featured">
        <div class="kapunka-clamp home-featured__grid">
            <div class="home-featured__media">
                <?php if ( ! empty( $ritual_products ) && isset( $ritual_products[0] ) ) : ?>
                    <?php kapunka_component( 'card-product', array( 'product' => $ritual_products[0], 'context' => 'tienda', 'variant' => 'featured-large' ) ); ?>
                <?php endif; ?>
            </div>
            <div class="home-featured__stack">
                <?php if ( ! empty( $ritual_products ) ) : ?>
                    <?php foreach ( array_slice( $ritual_products, 1, 2 ) as $product ) : ?>
                        <div class="home-featured__item">
                            <?php kapunka_component( 'card-product', array( 'product' => $product, 'context' => 'tienda', 'variant' => 'featured-small' ) ); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <a class="home-featured__cta" href="<?php echo esc_url( $kapunka_shop_url ); ?>"><?php esc_html_e( 'Ver toda la tienda', 'understrap' ); ?></a>
            </div>
        </div>
    </section>

    <section class="kapunka-section home-evidence">
        <div class="kapunka-clamp">
            <?php if ( '' !== trim( (string) $home_evidence['eyebrow'] ) ) : ?>
                <p class="kapunka-tech"><?php echo esc_html( $home_evidence['eyebrow'] ); ?></p>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $home_evidence['title'] ) ) : ?>
                <h2><?php echo esc_html( $home_evidence['title'] ); ?></h2>
            <?php endif; ?>
            <div class="home-evidence__stats">
                <?php foreach ( $home_evidence_stats as $stat ) :
                    $stat_value = isset( $stat['stat'] ) ? trim( (string) $stat['stat'] ) : '';
                    $stat_desc  = isset( $stat['description'] ) ? trim( (string) $stat['description'] ) : '';

                    if ( '' === $stat_value ) {
                        continue;
                    }
                    ?>
                    <article>
                        <h3><?php echo esc_html( $stat_value ); ?></h3>
                        <?php if ( '' !== $stat_desc ) : ?>
                            <p><?php echo esc_html( $stat_desc ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if ( ! empty( $home_evidence['cta']['label'] ) && ! empty( $home_evidence['cta']['url'] ) ) : ?>
                <a class="btn btn-outline" href="<?php echo esc_url( $home_evidence['cta']['url'] ); ?>"><?php echo esc_html( $home_evidence['cta']['label'] ); ?></a>
            <?php endif; ?>
        </div>
    </section>

    <section class="kapunka-section home-program">
        <div class="kapunka-clamp home-program__wrap">
            <div>
                <?php if ( '' !== trim( (string) $home_program['eyebrow'] ) ) : ?>
                    <p class="kapunka-tech"><?php echo esc_html( $home_program['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $home_program['title'] ) ) : ?>
                    <h2><?php echo esc_html( $home_program['title'] ); ?></h2>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $home_program['description'] ) ) : ?>
                    <p><?php echo esc_html( $home_program['description'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php if ( ! empty( $home_program['cta']['label'] ) && ! empty( $home_program['cta']['url'] ) ) : ?>
                <a class="btn btn-primary" href="<?php echo esc_url( $home_program['cta']['url'] ); ?>"><?php echo esc_html( $home_program['cta']['label'] ); ?></a>
            <?php endif; ?>
        </div>
    </section>

    <?php if ( $journal_query->have_posts() ) : ?>
        <section class="kapunka-section home-journal">
            <div class="kapunka-clamp">
                <div class="section-heading">
                    <?php if ( '' !== trim( (string) $home_journal['eyebrow'] ) ) : ?>
                        <p class="kapunka-tech"><?php echo esc_html( $home_journal['eyebrow'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( '' !== trim( (string) $home_journal['title'] ) ) : ?>
                        <h2><?php echo esc_html( $home_journal['title'] ); ?></h2>
                    <?php endif; ?>
                </div>
                <div class="kapunka-grid kapunka-grid--articles">
                    <?php
                    while ( $journal_query->have_posts() ) {
                        $journal_query->the_post();
                        kapunka_component( 'card-article', array( 'post' => get_post() ) );
                    }
                    wp_reset_postdata();
                    ?>
                </div>
                <?php if ( ! empty( $home_journal['cta']['label'] ) && ! empty( $home_journal['cta']['url'] ) ) : ?>
                    <a class="btn btn-outline" href="<?php echo esc_url( $home_journal['cta']['url'] ); ?>"><?php echo esc_html( $home_journal['cta']['label'] ); ?></a>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="kapunka-section home-newsletter">
        <div class="kapunka-clamp">
            <?php if ( '' !== trim( (string) $home_newsletter['eyebrow'] ) ) : ?>
                <p class="kapunka-tech"><?php echo esc_html( $home_newsletter['eyebrow'] ); ?></p>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $home_newsletter['title'] ) ) : ?>
                <h2><?php echo esc_html( $home_newsletter['title'] ); ?></h2>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $home_newsletter['description'] ) ) : ?>
                <p><?php echo esc_html( $home_newsletter['description'] ); ?></p>
            <?php endif; ?>

            <?php if ( ! empty( $home_newsletter['shortcode'] ) ) : ?>
                <div class="newsletter-form newsletter-form--shortcode">
                    <?php echo do_shortcode( $home_newsletter['shortcode'] ); ?>
                </div>
            <?php else : ?>
                <form class="newsletter-form">
                    <label class="screen-reader-text" for="home-newsletter-email"><?php esc_html_e( 'Correo electrónico', 'understrap' ); ?></label>
                    <input id="home-newsletter-email" type="email" placeholder="<?php echo esc_attr( $home_newsletter['placeholder'] ); ?>" required>
                    <button type="submit"><?php echo esc_html( $home_newsletter['button'] ); ?></button>
                </form>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
