<?php
/**
 * Template Name: Kapunka Sobre Nosotros
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero = array(
    'eyebrow'     => kapunka_get_meta( 'sobre_hero_eyebrow', __( 'Historia', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'sobre_hero_title', __( 'De la tierra al tacto.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'sobre_hero_description', __( 'La búsqueda de Mónica Ruiz por el argán más puro del mundo.', 'understrap' ) ),
    'background'  => kapunka_get_meta( 'sobre_hero_background' ),
);
$story_blocks_all = kapunka_get_meta( 'sobre_story', array() );
$sticky_panels     = array_slice( $story_blocks_all, 0, min( 3, count( $story_blocks_all ) ) );
$story_blocks      = array_slice( $story_blocks_all, count( $sticky_panels ) );
$editorial = array(
    'eyebrow' => kapunka_get_meta( 'sobre_editorial_eyebrow', __( 'La confluencia sanitaria', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'sobre_editorial_title', __( 'La confluencia sanitaria.', 'understrap' ) ),
    'intro'   => kapunka_get_meta( 'sobre_editorial_intro', __( 'Como auxiliar de enfermería y quiromasajista, entendí temprano que la piel dañada no solo necesita química, necesita nutrición fundamental.', 'understrap' ) ),
    'body'    => kapunka_get_meta( 'sobre_editorial_body', __( 'Kapunka nació de un viaje que unió mi exigencia sanitaria con una sabiduría ancestral que no podía dejarse perder.', 'understrap' ) ),
    'image'   => kapunka_get_meta( 'sobre_editorial_image' ),
);
$founder      = array(
    'title' => kapunka_get_meta( 'sobre_founder_title', __( 'La fundadora', 'understrap' ) ),
    'bio'   => kapunka_get_meta( 'sobre_founder_bio' ),
    'image' => kapunka_get_meta( 'sobre_founder_image' ),
);
$letter = array(
    'title' => kapunka_get_meta( 'sobre_carta_titulo', __( 'Carta de la fundadora', 'understrap' ) ),
    'text'  => kapunka_get_meta( 'sobre_carta_texto', __( 'Soy Mónica, enfermera clínica durante más de una década. Acompañé a cientos de pacientes en momentos de vulnerabilidad y comprendí que la piel responde mejor cuando recibe gratitud, tacto y pureza. Kapunka nace de esa certeza: agradecer a la piel con el mejor aceite posible.', 'understrap' ) ),
    'image' => kapunka_get_meta( 'sobre_carta_imagen' ),
);
$mission_heading    = kapunka_get_meta( 'sobre_mision_heading', __( 'Misión', 'understrap' ) );
$mission_subheading = kapunka_get_meta( 'sobre_mision_subheading', __( 'Proporcionar el mejor aceite de argán', 'understrap' ) );
$mission            = kapunka_get_meta( 'sobre_mision', __( 'Proporcionar el mejor aceite de argán para piel, cabello y uñas de toda la familia, de forma natural, segura y efectiva.', 'understrap' ) );
$vision_heading     = kapunka_get_meta( 'sobre_vision_heading', __( 'Visión', 'understrap' ) );
$vision_subheading  = kapunka_get_meta( 'sobre_vision_subheading', __( 'Cuidado accesible para todo el mundo', 'understrap' ) );
$vision             = kapunka_get_meta( 'sobre_vision', __( 'Hacer accesible este cuidado agradecido a personas en cualquier lugar del mundo.', 'understrap' ) );
$impact  = array(
    'eyebrow' => kapunka_get_meta( 'sobre_impacto_eyebrow', __( 'Belleza que empodera', 'understrap' ) ),
    'title'   => kapunka_get_meta( 'sobre_impacto_title', __( 'Cada gota proviene de cooperativas de mujeres bereberes. Garantizamos salarios justos y desarrollo comunitario.', 'understrap' ) ),
    'body'    => kapunka_get_meta( 'sobre_impacto', __( 'Al trabajar con cooperativas de mujeres marroquíes garantizamos un comercio justo, apoyamos programas educativos locales y reinvertimos en bienestar comunitario.', 'understrap' ) ),
    'stats'   => kapunka_get_meta( 'sobre_impact_stats', array() ),
);
if ( empty( $impact['stats'] ) || ! is_array( $impact['stats'] ) ) {
    $impact['stats'] = array(
        array( 'value' => '100%', 'label' => __( 'Trazabilidad', 'understrap' ) ),
        array( 'value' => '35+', 'label' => __( 'Años de investigación', 'understrap' ) ),
        array( 'value' => '0%', 'label' => __( 'Aditivos sintéticos', 'understrap' ) ),
    );
}
$values_title = kapunka_get_meta( 'sobre_values_title', __( 'Valores', 'understrap' ) );
$values_items = kapunka_get_meta( 'sobre_values_items', array() );
$default_values = array(
    array( 'title' => __( 'Confianza', 'understrap' ), 'description' => __( 'Trazabilidad y análisis clínicos en cada lote.', 'understrap' ) ),
    array( 'title' => __( 'Esfuerzo', 'understrap' ), 'description' => __( 'Investigación continua para mejorar nuestros protocolos.', 'understrap' ) ),
    array( 'title' => __( 'Compromiso', 'understrap' ), 'description' => __( 'Acompañamos a pacientes y profesionales en cada fase.', 'understrap' ) ),
    array( 'title' => __( 'Gratitud', 'understrap' ), 'description' => __( 'Honramos a la piel, a las cooperativas y a cada persona que confía en Kapunka.', 'understrap' ) ),
);
if ( empty( $values_items ) ) {
    $values_items = $default_values;
}
$cooperatives_title = kapunka_get_meta( 'sobre_cooperativas_title', __( 'Cooperativas de mujeres', 'understrap' ) );
$cooperatives_description = kapunka_get_meta( 'sobre_cooperativas_description' );
$cooperatives_items = kapunka_get_meta( 'sobre_cooperativas_items', array() );
$extra_components = kapunka_get_meta( 'sobre_componentes', array() );
$hero_background = $hero['background'] ? wp_get_attachment_image( $hero['background'], 'full', false, array( 'loading' => 'eager' ) ) : '';
$hero_fallback   = get_stylesheet_directory_uri() . '/images/hero-bg.jpg';
$hero_background_url = $hero['background'] ? wp_get_attachment_image_url( $hero['background'], 'full' ) : $hero_fallback;
?>

<section class="hero-section hero-section--sobre hero-section--parallax">
    <div class="hero-parallax" style="background-image: url('<?php echo esc_url( $hero_background_url ); ?>');"></div>
    <div class="hero-content">
        <div class="kapunka-clamp">
            <div class="hero-content__inner">
                <?php if ( '' !== trim( (string) $hero['eyebrow'] ) ) : ?>
                    <p class="kapunka-tech"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $hero['title'] ) ) : ?>
                    <h1><?php echo esc_html( $hero['title'] ); ?></h1>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $hero['description'] ) ) : ?>
                    <p><?php echo esc_html( $hero['description'] ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$sobre_section_counter    = 0;
$kapunka_sobre_section_class = static function( $base_class ) use ( &$sobre_section_counter ) {
    $sobre_section_counter++;
    $tone_class = ( $sobre_section_counter % 2 === 0 ) ? 'sobre-block--muted' : 'sobre-block--light';
    return trim( $base_class . ' sobre-block ' . $tone_class );
};
?>

<main id="sobre-nosotros-page" class="site-main site-main--sobre">

    <?php if ( ! empty( $sticky_panels ) && ! empty( $hero_background_url ) ) : ?>
        <section class="sobre-sticky-panels">
            <div class="sobre-sticky-panels__media" style="background-image: url('<?php echo esc_url( $hero_background_url ); ?>');"></div>
            <div class="sobre-sticky-panels__copy">
                <?php foreach ( $sticky_panels as $index => $panel ) : ?>
                    <article class="sobre-sticky-panel">
                        <div class="sobre-sticky-panel__inner">
                            <p class="sobre-sticky-panel__index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></p>
                            <?php if ( ! empty( $panel['title'] ) ) : ?>
                                <h2><?php echo esc_html( $panel['title'] ); ?></h2>
                            <?php endif; ?>
                            <?php if ( ! empty( $panel['description'] ) ) : ?>
                                <p><?php echo esc_html( $panel['description'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="sobre-founder-editorial">
        <div class="kapunka-clamp sobre-founder-editorial__grid">
            <div class="sobre-founder-editorial__text">
                <?php if ( '' !== trim( (string) $editorial['eyebrow'] ) ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $editorial['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $editorial['title'] ) ) : ?>
                    <h2><?php echo esc_html( $editorial['title'] ); ?></h2>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $editorial['intro'] ) ) : ?>
                    <p class="sobre-dropcap"><?php echo esc_html( $editorial['intro'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $editorial['body'] ) ) : ?>
                    <p><?php echo esc_html( $editorial['body'] ); ?></p>
                <?php endif; ?>
            </div>
            <div class="sobre-founder-editorial__media">
                <?php
                $editorial_image_id = $editorial['image'] ?: $founder['image'];
                if ( $editorial_image_id ) {
                    echo wp_get_attachment_image( $editorial_image_id, 'large', false, array( 'loading' => 'lazy' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                }
                ?>
            </div>
        </div>
    </section>

    <?php if ( $mission || $vision ) : ?>
        <section class="<?php echo esc_attr( $kapunka_sobre_section_class( 'aprende-section sobre-mision' ) ); ?>">
            <div class="aprende-section__inner kapunka-clamp">
                <div class="sobre-mision__grid">
                    <?php if ( $mission ) : ?>
                        <article>
                            <p class="text-uppercase letter-spacing"><?php echo esc_html( $mission_heading ); ?></p>
                            <?php if ( '' !== trim( (string) $mission_subheading ) ) : ?>
                                <h3><?php echo esc_html( $mission_subheading ); ?></h3>
                            <?php endif; ?>
                            <p><?php echo esc_html( $mission ); ?></p>
                        </article>
                    <?php endif; ?>
                    <?php if ( $vision ) : ?>
                        <article>
                            <p class="text-uppercase letter-spacing"><?php echo esc_html( $vision_heading ); ?></p>
                            <?php if ( '' !== trim( (string) $vision_subheading ) ) : ?>
                                <h3><?php echo esc_html( $vision_subheading ); ?></h3>
                            <?php endif; ?>
                            <p><?php echo esc_html( $vision ); ?></p>
                        </article>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="sobre-impacto-dark">
        <div class="kapunka-clamp">
            <?php if ( '' !== trim( (string) $impact['eyebrow'] ) ) : ?>
                <p class="text-uppercase letter-spacing"><?php echo esc_html( $impact['eyebrow'] ); ?></p>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $impact['title'] ) ) : ?>
                <h2><?php echo esc_html( $impact['title'] ); ?></h2>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $impact['body'] ) ) : ?>
                <p><?php echo esc_html( $impact['body'] ); ?></p>
            <?php endif; ?>
            <div class="sobre-impacto-dark__stats">
                <?php foreach ( $impact['stats'] as $stat ) :
                    $value = isset( $stat['value'] ) ? trim( (string) $stat['value'] ) : '';
                    $label = isset( $stat['label'] ) ? trim( (string) $stat['label'] ) : '';

                    if ( '' === $value ) {
                        continue;
                    }
                    ?>
                    <article>
                        <h3><?php echo esc_html( $value ); ?></h3>
                        <?php if ( '' !== $label ) : ?>
                            <p><?php echo esc_html( $label ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $story_blocks ) ) : ?>
        <section class="<?php echo esc_attr( $kapunka_sobre_section_class( 'story-section' ) ); ?>">
            <div class="kapunka-clamp">
            <?php foreach ( $story_blocks as $block ) : ?>
                <article class="story-block">
                    <div class="story-text">
                        <h2><?php echo esc_html( $block['title'] ); ?></h2>
                        <p><?php echo esc_html( $block['description'] ); ?></p>
                    </div>
                    <?php if ( ! empty( $block['image'] ) ) : ?>
                        <div class="story-image">
                            <?php echo wp_get_attachment_image( $block['image'], 'large', false, array( 'loading' => 'lazy' ) ); ?>
                        </div>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $founder['title'] ) || ! empty( $founder['bio'] ) || ! empty( $founder['image'] ) ) : ?>
        <section class="<?php echo esc_attr( $kapunka_sobre_section_class( 'founder-section' ) ); ?>" id="fundadora">
            <div class="kapunka-clamp">
            <div class="founder-grid">
                <div>
                    <h2><?php echo esc_html( $founder['title'] ); ?></h2>
                    <p><?php echo esc_html( $founder['bio'] ); ?></p>
                </div>
                <?php if ( ! empty( $founder['image'] ) ) : ?>
                    <div class="founder-image">
                        <?php echo wp_get_attachment_image( $founder['image'], 'large', false, array( 'loading' => 'lazy' ) ); ?>
                    </div>
                <?php endif; ?>
            </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $values_items ) ) : ?>
        <section class="<?php echo esc_attr( $kapunka_sobre_section_class( 'values-section' ) ); ?>" id="valores">
            <div class="kapunka-clamp">
            <h2><?php echo esc_html( $values_title ); ?></h2>
            <div class="values-grid">
                <?php foreach ( $values_items as $item ) : ?>
                    <article class="value-card">
                        <h3><?php echo esc_html( $item['title'] ); ?></h3>
                        <p><?php echo esc_html( $item['description'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $cooperatives_items ) ) : ?>
        <section class="<?php echo esc_attr( $kapunka_sobre_section_class( 'cooperatives-section' ) ); ?>" id="cooperativas">
            <div class="kapunka-clamp">
            <div class="section-heading">
                <h2><?php echo esc_html( $cooperatives_title ); ?></h2>
                <p><?php echo esc_html( $cooperatives_description ); ?></p>
            </div>
            <div class="cooperatives-grid">
                <?php foreach ( $cooperatives_items as $item ) : ?>
                    <article class="cooperative-card">
                        <h3><?php echo esc_html( $item['title'] ); ?></h3>
                        <p><?php echo esc_html( $item['description'] ); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $extra_components ) ) : ?>
        <?php foreach ( $extra_components as $component ) : ?>
            <?php
            $layout = $component['_type'] ?? '';
            if ( 'cta' === $layout ) {
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
            } elseif ( 'newsletter' === $layout ) {
                kapunka_component(
                    'newsletter-form',
                    array(
                        'title'          => $component['title'] ?? '',
                        'description'    => $component['description'] ?? '',
                        'form_shortcode' => $component['form_shortcode'] ?? '',
                    )
                );
            }
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php
get_footer();
