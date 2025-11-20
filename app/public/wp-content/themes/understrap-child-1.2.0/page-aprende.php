<?php
/**
 * Template Name: Kapunka Aprende
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero_background_enabled = kapunka_get_meta( 'aprende_hero_background_enabled', false );
$hero_background_image_id = $hero_background_enabled ? kapunka_get_meta( 'aprende_hero_background_image', 0 ) : 0;
$hero_background_image_url = $hero_background_image_id ? wp_get_attachment_image_url( $hero_background_image_id, 'full' ) : '';

$hero = array(
    'eyebrow'     => kapunka_get_meta( 'aprende_hero_eyebrow', __( 'Journal Kapunka', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'aprende_hero_title', __( 'Análisis clínicos, rituales guiados y casos de cabina.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'aprende_hero_description', __( 'Notas mensuales con protocolos descargables, playlists para cabina y noticias desde las cooperativas.', 'understrap' ) ),
    'primary'     => array(
        'label' => kapunka_get_meta( 'aprende_hero_primary_label', __( 'Suscribirme al Journal', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'aprende_hero_primary_url', '#journal-newsletter' ),
    ),
    'secondary'   => array(
        'label' => kapunka_get_meta( 'aprende_hero_secondary_label' ),
        'url'   => kapunka_get_meta( 'aprende_hero_secondary_url' ),
    ),
    'background_enabled' => $hero_background_enabled,
    'background_image'   => $hero_background_image_url,
);

$featured_ids   = kapunka_parse_association_ids( kapunka_get_meta( 'aprende_destacados', array() ) );
$featured_posts = array();
if ( ! empty( $featured_ids ) ) {
    $featured_posts = array_filter(
        array_map(
            'get_post',
            $featured_ids
        )
    );
}

$list_title       = kapunka_get_meta( 'aprende_listado_title', __( 'Últimos artículos', 'understrap' ) );
$list_description = kapunka_get_meta( 'aprende_listado_description' );

$collections = kapunka_get_meta( 'aprende_collections', array() );
if ( empty( $collections ) ) {
    $collections = array(
        array( 'title' => __( 'Guías de aplicación', 'understrap' ), 'description' => __( 'Paso a paso para rituales faciales y corporales.', 'understrap' ) ),
        array( 'title' => __( 'Ciencia del argán', 'understrap' ), 'description' => __( 'Estudios, análisis y datos técnicos explicados.', 'understrap' ) ),
        array( 'title' => __( 'Casos clínicos', 'understrap' ), 'description' => __( 'Resultados en cabinas y testimonios de especialistas.', 'understrap' ) ),
        array( 'title' => __( 'Noticias de cooperativa', 'understrap' ), 'description' => __( 'Impacto social y trazabilidad en origen.', 'understrap' ) ),
    );
}

$cta = array(
    'eyebrow' => kapunka_get_meta( 'aprende_cta_eyebrow', __( '¿Eres profesional?', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'aprende_cta_title', __( 'Recibe fichas técnicas exclusivas y acceso prioritario al programa.', 'understrap' ) ),
    'cta'     => array(
        'label' => kapunka_get_meta( 'aprende_cta_button_label', __( 'Unirme al programa', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'aprende_cta_button_url', home_url( '/profesionales' ) ),
    ),
);

$newsletter = array(
    'eyebrow'     => kapunka_get_meta( 'aprende_newsletter_eyebrow', __( 'Newsletter Journal', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'aprende_newsletter_title', __( 'Envío mensual con protocolos y playlists para cabina.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'aprende_newsletter_description', '' ),
    'placeholder' => kapunka_get_meta( 'aprende_newsletter_placeholder', 'hola@' ),
    'button'      => kapunka_get_meta( 'aprende_newsletter_button', __( 'Suscribirme', 'understrap' ) ),
    'shortcode'   => kapunka_get_meta( 'aprende_newsletter_shortcode', '' ),
);

$components = kapunka_get_meta( 'aprende_componentes', array() );
?>

<main id="aprende-page" class="site-main site-main--aprende">
    <section class="hero-section text-left aprende-hero<?php echo $hero['background_enabled'] && $hero['background_image'] ? ' aprende-hero--with-background' : ''; ?>">
        <?php if ( $hero['background_enabled'] && $hero['background_image'] ) : ?>
            <div class="aprende-hero__background" aria-hidden="true">
                <img src="<?php echo esc_url( $hero['background_image'] ); ?>" alt="" loading="lazy" decoding="async">
                <div class="aprende-hero__overlay"></div>
            </div>
        <?php endif; ?>
        <div class="kapunka-clamp aprende-hero__content">
            <?php if ( ! empty( $hero['eyebrow'] ) ) : ?>
                <p class="aprende-hero__eyebrow text-uppercase letter-spacing"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
            <?php endif; ?>
            <h1 class="aprende-hero__title"><?php echo esc_html( $hero['title'] ); ?></h1>
            <?php if ( ! empty( $hero['description'] ) ) : ?>
                <p class="aprende-hero__description"><?php echo esc_html( $hero['description'] ); ?></p>
            <?php endif; ?>
            <div class="hero-cta">
                <?php if ( ! empty( $hero['primary']['url'] ) && ! empty( $hero['primary']['label'] ) ) : ?>
                    <a class="btn btn-primary" href="<?php echo esc_url( $hero['primary']['url'] ); ?>"><?php echo esc_html( $hero['primary']['label'] ); ?></a>
                <?php endif; ?>
                <?php if ( ! empty( $hero['secondary']['url'] ) && ! empty( $hero['secondary']['label'] ) ) : ?>
                    <a class="btn btn-outline" href="<?php echo esc_url( $hero['secondary']['url'] ); ?>"><?php echo esc_html( $hero['secondary']['label'] ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $featured_posts ) ) : ?>
        <section class="aprende-section aprende-featured">
            <div class="kapunka-clamp aprende-featured__inner">
                <?php $first = array_shift( $featured_posts ); ?>
                <?php if ( $first ) : ?>
                    <article class="aprende-featured__main">
                        <?php kapunka_component( 'card-article', array( 'post' => $first, 'variant' => 'featured-main' ) ); ?>
                    </article>
                <?php endif; ?>
                <?php if ( ! empty( $featured_posts ) ) : ?>
                    <div class="aprende-featured__grid">
                        <?php foreach ( $featured_posts as $post ) : ?>
                            <?php kapunka_component( 'card-article', array( 'post' => $post ) ); ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="aprende-section aprende-latest">
        <div class="aprende-section__inner kapunka-clamp">
            <div class="section-heading aprende-latest__heading">
                <p class="aprende-latest__category-labels text-uppercase letter-spacing"><?php esc_html_e( 'Dermatología Natural · Casos de Éxito · Lifestyle Consciente', 'understrap' ); ?></p>
                <h2><?php echo esc_html( $list_title ); ?></h2>
                <?php if ( ! empty( $list_description ) ) : ?>
                    <p><?php echo esc_html( $list_description ); ?></p>
                <?php endif; ?>
            </div>
            <div class="aprende-latest__grid">
                <?php
            $latest_query = new WP_Query(
                array(
                    'post_type'           => 'post',
                    'posts_per_page'      => 6,
                    'post__not_in'        => $featured_ids,
                    'ignore_sticky_posts' => true,
                )
            );

            if ( $latest_query->have_posts() ) :
                while ( $latest_query->have_posts() ) :
                    $latest_query->the_post();
                    kapunka_component( 'card-article', array( 'post' => get_post() ) );
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                    <p><?php esc_html_e( 'No hay artículos disponibles por ahora.', 'understrap' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="kapunka-section journal-collections">
        <div class="kapunka-clamp journal-collections__grid">
            <?php foreach ( $collections as $item ) :
                $collection_title = isset( $item['title'] ) ? trim( (string) $item['title'] ) : '';
                $collection_desc  = isset( $item['description'] ) ? trim( (string) $item['description'] ) : '';

                if ( '' === $collection_title && '' === $collection_desc ) {
                    continue;
                }
                ?>
                <article class="journal-collection-card">
                    <?php if ( '' !== $collection_title ) : ?>
                        <h3><?php echo esc_html( $collection_title ); ?></h3>
                    <?php endif; ?>
                    <?php if ( '' !== $collection_desc ) : ?>
                        <p><?php echo esc_html( $collection_desc ); ?></p>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <?php if ( '' !== trim( (string) $cta['title'] ) || ( ! empty( $cta['cta']['label'] ) && ! empty( $cta['cta']['url'] ) ) ) : ?>
        <section class="kapunka-section journal-cta">
            <div class="kapunka-clamp journal-cta__wrap">
                <div>
                    <?php if ( '' !== trim( (string) $cta['eyebrow'] ) ) : ?>
                        <p class="kapunka-tech"><?php echo esc_html( $cta['eyebrow'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( '' !== trim( (string) $cta['title'] ) ) : ?>
                        <h2><?php echo esc_html( $cta['title'] ); ?></h2>
                    <?php endif; ?>
                </div>
                <?php if ( ! empty( $cta['cta']['label'] ) && ! empty( $cta['cta']['url'] ) ) : ?>
                    <a class="btn btn-primary" href="<?php echo esc_url( $cta['cta']['url'] ); ?>"><?php echo esc_html( $cta['cta']['label'] ); ?></a>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <section id="journal-newsletter" class="kapunka-section journal-newsletter">
        <div class="kapunka-clamp">
            <?php if ( '' !== trim( (string) $newsletter['eyebrow'] ) ) : ?>
                <p class="kapunka-tech"><?php echo esc_html( $newsletter['eyebrow'] ); ?></p>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $newsletter['title'] ) ) : ?>
                <h2><?php echo esc_html( $newsletter['title'] ); ?></h2>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $newsletter['description'] ) ) : ?>
                <p><?php echo esc_html( $newsletter['description'] ); ?></p>
            <?php endif; ?>
            <?php if ( ! empty( $newsletter['shortcode'] ) ) : ?>
                <div class="newsletter-form newsletter-form--shortcode">
                    <?php echo do_shortcode( $newsletter['shortcode'] ); ?>
                </div>
            <?php else : ?>
                <form class="newsletter-form">
                    <label class="screen-reader-text" for="journal-newsletter-email"><?php esc_html_e( 'Correo electrónico', 'understrap' ); ?></label>
                    <input id="journal-newsletter-email" type="email" placeholder="<?php echo esc_attr( $newsletter['placeholder'] ); ?>" required>
                    <button type="submit"><?php echo esc_html( $newsletter['button'] ); ?></button>
                </form>
            <?php endif; ?>
        </div>
    </section>

    <?php if ( ! empty( $components ) ) : ?>
        <?php foreach ( $components as $component ) : ?>
            <?php
            $layout = $component['_type'] ?? '';

            switch ( $layout ) {
                case 'cta':
                    kapunka_component(
                        'cta-section',
                        array(
                            'eyebrow'    => $component['eyebrow'] ?? '',
                            'title'      => $component['title'] ?? '',
                            'description'=> $component['description'] ?? '',
                            'primary'    => array(
                                'label' => $component['primary_label'] ?? '',
                                'url'   => $component['primary_url'] ?? '',
                            ),
                            'secondary'  => array(
                                'label' => $component['secondary_label'] ?? '',
                                'url'   => $component['secondary_url'] ?? '',
                            ),
                            'background_image' => $component['background_image'] ?? 0,
                        )
                    );
                    break;
                case 'newsletter':
                    kapunka_component(
                        'newsletter-form',
                        array(
                            'title'          => $component['title'] ?? '',
                            'description'    => $component['description'] ?? '',
                            'form_shortcode' => $component['form_shortcode'] ?? '',
                        )
                    );
                    break;
                case 'faq':
                    kapunka_component(
                        'faq-section',
                        array(
                            'title' => $component['title'] ?? '',
                            'items' => $component['items'] ?? array(),
                        )
                    );
                    break;
                default:
                    break;
            }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php
get_footer();
