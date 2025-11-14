<?php
/*
Template Name: Kapunka Home
*/

defined( 'ABSPATH' ) || exit;

get_header();

$kapunka_shop_url = function_exists( 'wc_get_page_id' ) ? get_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/tienda' );

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
    'title' => kapunka_get_meta( 'crb_home_hook_title', __( 'Más que un aceite. Un método.', 'understrap' ) ),
    'body'  => kapunka_get_meta(
        'crb_home_hook_body',
        __( 'Kapunka no es solo un ingrediente; es la fusión de un abastecimiento ético en Marruecos y un protocolo clínico desarrollado durante 35 años. Diseñado para quienes exigen resultados visibles sin comprometer la pureza.', 'understrap' )
    ),
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

$home_trinity = kapunka_get_meta( 'crb_home_trinity', array() );
if ( empty( $home_trinity ) || ! is_array( $home_trinity ) ) {
    $home_trinity = array(
        array(
            'crb_home_trinity_title' => __( 'Origen', 'understrap' ),
            'crb_home_trinity_body'  => __( 'Primera prensada en frío de cooperativas femeninas certificadas.', 'understrap' ),
            'crb_home_trinity_image' => 0,
        ),
        array(
            'crb_home_trinity_title' => __( 'Ciencia', 'understrap' ),
            'crb_home_trinity_body'  => __( '100% pureza validada. Rico en Vitamina E y ácidos grasos esenciales.', 'understrap' ),
            'crb_home_trinity_image' => 0,
        ),
        array(
            'crb_home_trinity_title' => __( 'Método', 'understrap' ),
            'crb_home_trinity_body'  => __( 'Protocolos de aplicación propios que maximizan la absorción.', 'understrap' ),
            'crb_home_trinity_image' => 0,
        ),
    );
}

$home_testimonials = kapunka_get_meta( 'crb_home_testimonials', array() );
if ( empty( $home_testimonials ) || ! is_array( $home_testimonials ) ) {
    $home_testimonials = array(
        array(
            'crb_home_testimonial_quote'  => __( '“Kapunka elevó la experiencia post-láser: la piel queda flexible y sin ardor en minutos.”', 'understrap' ),
            'crb_home_testimonial_author' => __( '— Dra. Martínez, Clínica Regeneris', 'understrap' ),
        ),
        array(
            'crb_home_testimonial_quote'  => __( '“Nuestros rituales corporales ganaron textura y olor firma sin sacrificar resultados clínicos.”', 'understrap' ),
            'crb_home_testimonial_author' => __( '— Sarah L., Directora Wellness, Hotel Arts', 'understrap' ),
        ),
    );
}

$home_featured = array(
    'title' => kapunka_get_meta( 'crb_home_featured_title', __( 'Esenciales Kapunka', 'understrap' ) ),
);

$home_featured_ids = kapunka_parse_association_ids( kapunka_get_meta( 'crb_home_featured_products', array() ) );
$home_featured_products = array();

if ( function_exists( 'wc_get_product' ) ) {
    foreach ( $home_featured_ids as $product_id ) {
        $product = wc_get_product( $product_id );

        if ( $product && 'publish' === $product->get_status() ) {
            $home_featured_products[] = $product;
        }
    }

    if ( empty( $home_featured_products ) && function_exists( 'wc_get_products' ) ) {
        $home_featured_products = wc_get_products(
            array(
                'limit'   => 4,
                'orderby' => 'menu_order',
                'order'   => 'ASC',
                'status'  => 'publish',
            )
        );
    }
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

$home_b2b_cta = array(
    'title' => kapunka_get_meta(
        'crb_home_b2b_cta_title',
        $home_program['title']
    ),
    'button' => array(
        'label' => kapunka_get_meta( 'crb_home_b2b_cta_button_text', __( 'Ver detalles', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'crb_home_b2b_cta_button_link', $home_program['cta']['url'] ),
    ),
);

$home_journal = array(
    'eyebrow' => kapunka_get_meta( 'home_journal_eyebrow', __( 'Journal', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'crb_home_journal_title', kapunka_get_meta( 'home_journal_title', __( 'Reflexiones clínicas, casos y rituales guiados.', 'understrap' ) ) ),
    'cta'     => array(
        'label' => kapunka_get_meta( 'home_journal_cta_label', __( 'Entrar al Journal', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'home_journal_cta_url', home_url( '/aprende' ) ),
    ),
);

$home_journal_featured_ids = kapunka_parse_association_ids( kapunka_get_meta( 'crb_home_featured_posts', array() ) );
$home_journal_posts        = array();

if ( ! empty( $home_journal_featured_ids ) ) {
    $home_journal_posts = get_posts(
        array(
            'post_type'      => 'post',
            'post__in'       => $home_journal_featured_ids,
            'orderby'        => 'post__in',
            'posts_per_page' => 3,
        )
    );
}

if ( empty( $home_journal_posts ) ) {
    $home_journal_posts = get_posts(
        array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'ignore_sticky_posts' => true,
        )
    );
}

$home_newsletter = array(
    'eyebrow'     => kapunka_get_meta( 'home_newsletter_eyebrow', __( 'Newsletter', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'home_newsletter_title', __( 'Notas clínicas y rituales nuevos, una vez al mes.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'home_newsletter_description', __( 'Sin ruido. Solo protocolos descargables y playlists para cabina.', 'understrap' ) ),
    'placeholder' => kapunka_get_meta( 'home_newsletter_placeholder', 'hola@' ),
    'button'      => kapunka_get_meta( 'home_newsletter_button', __( 'Suscribirme', 'understrap' ) ),
    'shortcode'   => kapunka_get_meta( 'home_newsletter_shortcode', '' ),
);

$journal_query = null;
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
            <div class="home-hook__inner">
                <?php if ( '' !== trim( (string) $home_hook['title'] ) ) : ?>
                    <h2 class="home-hook__title"><?php echo esc_html( $home_hook['title'] ); ?></h2>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $home_hook['body'] ) ) : ?>
                    <div class="home-hook__body">
                        <?php echo wp_kses_post( wpautop( $home_hook['body'] ) ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $home_trinity ) ) : ?>
        <section class="kapunka-section home-trinity">
            <div class="kapunka-clamp">
                <div class="home-trinity__grid">
                    <?php foreach ( $home_trinity as $item ) :
                        $title    = isset( $item['crb_home_trinity_title'] ) ? trim( (string) $item['crb_home_trinity_title'] ) : '';
                        $body     = isset( $item['crb_home_trinity_body'] ) ? trim( (string) $item['crb_home_trinity_body'] ) : '';
                        $image_id = isset( $item['crb_home_trinity_image'] ) ? (int) $item['crb_home_trinity_image'] : 0;

                        if ( '' === $title && '' === $body && 0 === $image_id ) {
                            continue;
                        }
                        ?>
                        <article class="home-trinity__item">
                            <?php if ( $image_id ) : ?>
                                <div class="home-trinity__image">
                                    <?php echo wp_get_attachment_image( $image_id, 'medium', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( '' !== $title ) : ?>
                                <h3 class="home-trinity__title"><?php echo esc_html( $title ); ?></h3>
                            <?php endif; ?>
                            <?php if ( '' !== $body ) : ?>
                                <div class="home-trinity__body">
                                    <?php echo wp_kses_post( wpautop( $body ) ); ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $home_featured_products ) ) : ?>
        <section class="kapunka-section home-featured">
            <div class="kapunka-clamp">
                <?php if ( '' !== trim( (string) $home_featured['title'] ) ) : ?>
                    <h2 class="home-featured__title"><?php echo esc_html( $home_featured['title'] ); ?></h2>
                <?php endif; ?>
                <div class="home-featured__grid">
                    <?php foreach ( $home_featured_products as $product ) : ?>
                        <div class="home-featured__card">
                            <?php kapunka_component( 'card-product', array( 'product' => $product, 'context' => 'tienda' ) ); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $home_testimonials ) ) : ?>
        <section class="kapunka-section home-testimonials">
            <div class="kapunka-clamp">
                <div class="home-testimonials__slider">
                    <?php foreach ( $home_testimonials as $index => $testimonial ) :
                        $quote  = isset( $testimonial['crb_home_testimonial_quote'] ) ? trim( (string) $testimonial['crb_home_testimonial_quote'] ) : '';
                        $author = isset( $testimonial['crb_home_testimonial_author'] ) ? trim( (string) $testimonial['crb_home_testimonial_author'] ) : '';

                        if ( '' === $quote ) {
                            continue;
                        }
                        $is_active = 0 === $index;
                        ?>
                        <article class="home-testimonials__slide<?php echo $is_active ? ' is-active' : ''; ?>" data-index="<?php echo esc_attr( $index ); ?>">
                            <p class="home-testimonials__quote"><?php echo esc_html( $quote ); ?></p>
                            <?php if ( '' !== $author ) : ?>
                                <p class="home-testimonials__author"><?php echo esc_html( $author ); ?></p>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                    <div class="home-testimonials__dots" role="tablist">
                        <?php foreach ( $home_testimonials as $dot_index => $testimonial ) :
                            $is_active = 0 === $dot_index;
                            ?>
                            <button
                                class="home-testimonials__dot<?php echo $is_active ? ' is-active' : ''; ?>"
                                type="button"
                                data-target="<?php echo esc_attr( $dot_index ); ?>"
                                aria-label="<?php printf( esc_attr__( 'Testimonio %d', 'understrap' ), $dot_index + 1 ); ?>"
                                aria-pressed="<?php echo $is_active ? 'true' : 'false'; ?>"
                            ></button>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="kapunka-section home-program">
        <div class="kapunka-clamp home-program__wrap">
            <div>
                <?php if ( '' !== trim( (string) $home_program['eyebrow'] ) ) : ?>
                    <p class="kapunka-tech"><?php echo esc_html( $home_program['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $home_b2b_cta['title'] ) ) : ?>
                    <h2><?php echo esc_html( $home_b2b_cta['title'] ); ?></h2>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $home_program['description'] ) ) : ?>
                    <p><?php echo esc_html( $home_program['description'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php if ( ! empty( $home_b2b_cta['button']['label'] ) && ! empty( $home_b2b_cta['button']['url'] ) ) : ?>
                <a class="btn home-program__button" href="<?php echo esc_url( $home_b2b_cta['button']['url'] ); ?>"><?php echo esc_html( $home_b2b_cta['button']['label'] ); ?></a>
            <?php endif; ?>
        </div>
    </section>

    <?php if ( ! empty( $home_journal_posts ) ) : ?>
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
                <div class="home-journal__grid">
                    <?php foreach ( $home_journal_posts as $post ) : ?>
                        <?php
                        $permalink = get_permalink( $post );
                        $title     = get_the_title( $post );
                        $excerpt   = wp_trim_words( get_the_excerpt( $post ), 25, '…' );
                        $thumbnail = get_the_post_thumbnail( $post, 'large', array( 'loading' => 'lazy', 'decoding' => 'async' ) );
                        ?>
                        <article class="home-journal__card">
                            <a href="<?php echo esc_url( $permalink ); ?>" class="home-journal__link">
                                <div class="home-journal__media">
                                    <?php if ( $thumbnail ) : ?>
                                        <?php echo $thumbnail; ?>
                                    <?php else : ?>
                                        <div class="home-journal__placeholder"></div>
                                    <?php endif; ?>
                                </div>
                                <div class="home-journal__content">
                                    <?php if ( '' !== trim( (string) $title ) ) : ?>
                                        <h3><?php echo esc_html( $title ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( '' !== trim( (string) $excerpt ) ) : ?>
                                        <p><?php echo esc_html( $excerpt ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
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
