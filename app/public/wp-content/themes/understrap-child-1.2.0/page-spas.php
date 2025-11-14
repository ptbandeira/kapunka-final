<?php
/**
 * Template Name: Spas & Hoteles
 * Template Post Type: page
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero = array(
    'eyebrow'     => kapunka_get_meta( 'spas_hero_eyebrow', __( 'Spas & Hoteles', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'spas_hero_title', __( 'El nuevo estándar en lujo consciente.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'spas_hero_description', __( 'Eleve la experiencia de sus huéspedes con rituales sensoriales que justifican un posicionamiento premium.', 'understrap' ) ),
    'video_id'    => kapunka_get_meta( 'spas_hero_video', 0 ),
    'poster_id'   => kapunka_get_meta( 'spas_hero_poster', 0 ),
);
$video_src     = $hero['video_id'] ? wp_get_attachment_url( $hero['video_id'] ) : get_theme_file_uri( 'media/spa-ritual.mp4' );
$video_poster  = $hero['poster_id'] ? wp_get_attachment_url( $hero['poster_id'] ) : get_theme_file_uri( 'images/story-image.jpg' );

$rituals_intro = array(
    'eyebrow' => kapunka_get_meta( 'spas_rituals_eyebrow', __( 'Rituales disponibles', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'spas_rituals_title', __( 'El Método Kapunka se adapta a su carta en dos semanas.', 'understrap' ) ),
);
$rituals_items = kapunka_get_meta( 'spas_rituals_items', array() );
if ( empty( $rituals_items ) ) {
    $rituals_items = array(
        array(
            'title'       => __( 'Ritual Facial “Oro Líquido” (60 min)', 'understrap' ),
            'description' => __( 'Protocolo exclusivo de lifting manual con aceite puro y maniobras de remonte.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Masaje Corporal Bereber (80 min)', 'understrap' ),
            'description' => __( 'Secuencia drenante inspirada en el Atlas, ideal para suites dobles.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Experiencia Express en cabina', 'understrap' ),
            'description' => __( '15 minutos de glow inmediato para habitaciones o lounge de wellness.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Amenity nocturno', 'understrap' ),
            'description' => __( 'Mini gotero personalizado como parte del turn down service.', 'understrap' ),
        ),
    );
}

$rentabilidad_items = kapunka_get_meta( 'crb_spa_rentabilidad_grid', array() );
if ( empty( $rentabilidad_items ) ) {
    $rentabilidad_items = array(
        array(
            'item_title' => __( 'Storytelling Único', 'understrap' ),
            'item_body'  => __( "Diseñamos un 'Signature Ritual Kapunka' para su carta. No es solo un aceite; es una narrativa premium de origen marroquí, artesanía y pureza clínica que justifica un posicionamiento elevado y atrae al cliente de lujo.", 'understrap' ),
            'item_image' => 0,
        ),
        array(
            'item_title' => __( 'Rentabilidad Premium', 'understrap' ),
            'item_body'  => __( "Nuestra narrativa de 'Lujo Consciente' le permite posicionar este ritual con un margen de beneficio premium, atrayendo a clientes que valoran la autenticidad, la ética y la calidad por encima del precio.", 'understrap' ),
            'item_image' => 0,
        ),
        array(
            'item_title' => __( 'Amenity-to-Retail Loop', 'understrap' ),
            'item_body'  => __( "Implementamos el modelo de 'Amenity-to-Retail'. Una amenity de 10ml en la suite VIP se convierte en una venta de alto valor en la boutique de su spa, creando un nuevo y probado flujo de ingresos.", 'understrap' ),
            'item_image' => 0,
        ),
    );
}

$cta = array(
    'eyebrow' => kapunka_get_meta( 'crb_spa_cta_eyebrow', __( 'CO-CREACIÓN KAPUNKA', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'crb_spa_cta_title', __( 'Diseñamos su carta de tratamientos.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'crb_spa_cta_body', __( 'Coordinamos workshops con su equipo de cabina para adaptar narrativas, precios y rituales signature.', 'understrap' ) ),
    'button'  => array(
        'label' => kapunka_get_meta( 'crb_spa_cta_button_text', __( 'Agendar reunión', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'crb_spa_cta_button_link', home_url( '/contacto#profesionales' ) ),
    ),
);
$exclusivity_title = kapunka_get_meta( 'crb_spa_exclusivity_title', __( 'Una colaboración, no solo un producto.', 'understrap' ) );
$exclusivity_body  = kapunka_get_meta( 'crb_spa_exclusivity_body', __( 'No buscamos estar en todas partes. Nuestro modelo se basa en \'partners\' seleccionados. Ofrecemos beneficios estratégicos, como exclusividad geográfica, para proteger su posicionamiento y asegurar que el ritual Kapunka sea un verdadero diferenciador de lujo en su mercado.', 'understrap' ) );
?>

<main id="spas-page" class="site-main site-main--profesionales-detail pro-detail pro-detail--spas">
    <section class="hero-section spa-hero">
        <div class="hero-background" aria-hidden="true">
            <?php if ( $video_src ) : ?>
                <video autoplay muted loop playsinline poster="<?php echo esc_url( $video_poster ); ?>">
                    <source src="<?php echo esc_url( $video_src ); ?>" type="video/mp4">
                </video>
            <?php else : ?>
                <img src="<?php echo esc_url( $video_poster ); ?>" alt="" />
            <?php endif; ?>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="kapunka-clamp">
                <div class="hero-content__inner">
                    <?php if ( $hero['eyebrow'] ) : ?>
                        <p class="text-uppercase letter-spacing"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( $hero['title'] ) : ?>
                        <h1><?php echo esc_html( $hero['title'] ); ?></h1>
                    <?php endif; ?>
                    <?php if ( $hero['description'] ) : ?>
                        <p><?php echo esc_html( $hero['description'] ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator" aria-hidden="true">
            <span></span>
        </div>
    </section>

    <?php if ( $exclusivity_title || $exclusivity_body ) : ?>
        <section class="spa-exclusivity">
            <div class="kapunka-clamp">
                <?php if ( $exclusivity_title ) : ?>
                    <h2><?php echo esc_html( $exclusivity_title ); ?></h2>
                <?php endif; ?>
                <?php if ( $exclusivity_body ) : ?>
                    <p><?php echo esc_html( $exclusivity_body ); ?></p>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="spa-rituals">
        <div class="kapunka-clamp">
            <div class="section-heading">
                <?php if ( $rituals_intro['eyebrow'] ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $rituals_intro['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( $rituals_intro['title'] ) : ?>
                    <h2><?php echo esc_html( $rituals_intro['title'] ); ?></h2>
                <?php endif; ?>
            </div>
            <div class="spa-rituals__grid">
                <?php foreach ( $rituals_items as $item ) :
                    $ritual_title = isset( $item['title'] ) ? trim( (string) $item['title'] ) : '';
                    $ritual_desc  = isset( $item['description'] ) ? trim( (string) $item['description'] ) : '';

                    if ( '' === $ritual_title && '' === $ritual_desc ) {
                        continue;
                    }
                    ?>
                    <article class="spa-rituals__card">
                        <?php if ( $ritual_title ) : ?>
                            <h3><?php echo esc_html( $ritual_title ); ?></h3>
                        <?php endif; ?>
                        <?php if ( $ritual_desc ) : ?>
                            <p><?php echo esc_html( $ritual_desc ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $rentabilidad_items ) ) : ?>
        <section class="spa-rentabilidad valor-propuesta-grid" aria-label="<?php esc_attr_e( 'Propuesta de valor Kapunka para spas', 'understrap' ); ?>">
            <div class="valor-propuesta-grid__inner">
                <?php foreach ( $rentabilidad_items as $item ) :
                    $item_title = isset( $item['item_title'] ) ? trim( (string) $item['item_title'] ) : '';
                    $item_body  = isset( $item['item_body'] ) ? trim( (string) $item['item_body'] ) : '';
                    $item_image = ! empty( $item['item_image'] ) ? wp_get_attachment_image_url( $item['item_image'], 'large' ) : '';

                    if ( '' === $item_title && '' === $item_body ) {
                        continue;
                    }
                    ?>
                    <article class="valor-propuesta-grid__item"<?php echo $item_image ? ' style="background-image: url(' . esc_url( $item_image ) . ');"' : ''; ?>>
                        <div class="valor-propuesta-grid__overlay"></div>
                        <div class="valor-propuesta-grid__content">
                            <div class="kapunka-clamp valor-propuesta-grid__shell">
                                <div class="valor-propuesta-grid__content-inner">
                                    <?php if ( $item_title ) : ?>
                                        <h3><?php echo esc_html( $item_title ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( $item_body ) : ?>
                                        <p><?php echo esc_html( $item_body ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="spa-cta">
        <div class="kapunka-clamp spa-cta__wrap">
            <div>
                <?php if ( $cta['eyebrow'] ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $cta['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( $cta['title'] ) : ?>
                    <h2><?php echo esc_html( $cta['title'] ); ?></h2>
                <?php endif; ?>
                <?php if ( $cta['description'] ) : ?>
                    <p><?php echo esc_html( $cta['description'] ); ?></p>
                <?php endif; ?>
            </div>
            <?php if ( ! empty( $cta['button']['label'] ) && ! empty( $cta['button']['url'] ) ) : ?>
                <a class="btn btn-outline" href="<?php echo esc_url( $cta['button']['url'] ); ?>">
                    <?php echo esc_html( $cta['button']['label'] ); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
