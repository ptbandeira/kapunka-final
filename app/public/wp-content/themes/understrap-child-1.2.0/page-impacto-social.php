<?php
/**
 * Template Name: Impacto Social
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

global $post;

get_header();

$hero_image_id = kapunka_get_meta( 'crb_impacto_hero_image', 0 );
$hero_image    = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : get_theme_file_uri( 'images/hero-bg.jpg' );

$hero_headline    = kapunka_get_meta( 'crb_impacto_hero_headline', __( 'Belleza que empodera.', 'understrap' ) );
$hero_subheadline = kapunka_get_meta( 'crb_impacto_hero_subheadline', __( 'El origen ético de cada gota de Kapunka.', 'understrap' ) );

$intro_body = kapunka_get_meta( 'crb_impacto_intro_body', '' );
$intro_body = $intro_body ? $intro_body : '';

$default_pillars = array(
    array(
        'pillar_headline' => __( 'Comercio Justo', 'understrap' ),
        'pillar_body'     => __( "Garantizamos salarios justos y desarrollo comunitario, asegurando que el valor de este 'oro líquido' retorne a las manos que lo cultivan.", 'understrap' ),
    ),
    array(
        'pillar_headline' => __( 'Empoderamiento Femenino', 'understrap' ),
        'pillar_body'     => __( 'Nuestro modelo apoya directamente a las cooperativas de mujeres, fomentando su independencia económica y preservando su rol como guardianas de una tradición ancestral.', 'understrap' ),
    ),
    array(
        'pillar_headline' => __( 'Sostenibilidad UNESCO', 'understrap' ),
        'pillar_body'     => __( 'Nuestro proceso artesanal y sostenible protege el ecosistema único de la Reserva de la Biosfera de la UNESCO, asegurando el futuro del árbol de Argán.', 'understrap' ),
    ),
);

$pillars = kapunka_get_meta( 'crb_impacto_pillars', array() );
$pillars = ! empty( $pillars ) ? $pillars : $default_pillars;

$interlude_id  = kapunka_get_meta( 'crb_impacto_interlude_image', 0 );
$interlude_src = $interlude_id ? wp_get_attachment_image_url( $interlude_id, 'full' ) : get_theme_file_uri( 'images/story-image.jpg' );

$cta_headline = kapunka_get_meta( 'crb_impacto_cta_headline', __( 'La confluencia sanitaria.', 'understrap' ) );
$cta_body     = kapunka_get_meta( 'crb_impacto_cta_body', __( 'Nuestra fundadora, Mónica Ruiz, unió su exigencia sanitaria con esta sabiduría ancestral. El resultado es un producto con alma, eficacia clínica y un profundo impacto humano.', 'understrap' ) );
?>

<main id="impacto-page" class="impacto-main">
    <section class="impacto-hero"<?php echo $hero_image ? ' style="background-image: url(' . esc_url( $hero_image ) . ');"' : ''; ?>>
        <div class="impacto-hero__overlay"></div>
        <div class="kapunka-clamp impacto-hero__content">
            <?php if ( $hero_headline ) : ?>
                <h1 class="impacto-hero__headline"><?php echo esc_html( $hero_headline ); ?></h1>
            <?php endif; ?>
            <?php if ( $hero_subheadline ) : ?>
                <p class="impacto-hero__subheadline"><?php echo esc_html( $hero_subheadline ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <?php if ( $intro_body ) : ?>
        <section class="impacto-intro">
            <div class="kapunka-clamp impacto-intro__inner">
                <div class="impacto-intro__body">
                    <?php echo wp_kses_post( apply_filters( 'the_content', $intro_body ) ); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $pillars ) ) : ?>
        <section class="impacto-pillars">
            <div class="kapunka-clamp impacto-pillars__grid">
                <?php foreach ( $pillars as $pillar ) :
                    $headline = isset( $pillar['pillar_headline'] ) ? trim( (string) $pillar['pillar_headline'] ) : '';
                    $body     = isset( $pillar['pillar_body'] ) ? trim( (string) $pillar['pillar_body'] ) : '';

                    if ( '' === $headline && '' === $body ) {
                        continue;
                    }
                    ?>
                    <article class="impacto-pillars__card">
                        <?php if ( $headline ) : ?>
                            <h3><?php echo esc_html( $headline ); ?></h3>
                        <?php endif; ?>
                        <?php if ( $body ) : ?>
                            <p><?php echo esc_html( $body ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $interlude_src ) : ?>
        <section class="impacto-interlude">
            <figure class="impacto-interlude__figure">
                <img src="<?php echo esc_url( $interlude_src ); ?>" alt="" loading="lazy" />
            </figure>
        </section>
    <?php endif; ?>

    <section class="impacto-cta">
        <div class="kapunka-clamp impacto-cta__inner">
            <?php if ( $cta_headline ) : ?>
                <h2><?php echo esc_html( $cta_headline ); ?></h2>
            <?php endif; ?>
            <?php if ( $cta_body ) : ?>
                <p><?php echo esc_html( $cta_body ); ?></p>
            <?php endif; ?>
            <nav class="impacto-cta__links">
                <a href="<?php echo esc_url( home_url( '/el-origen' ) ); ?>"><?php esc_html_e( 'Conoce nuestra historia completa →', 'understrap' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/tienda' ) ); ?>"><?php esc_html_e( 'Descubre la colección →', 'understrap' ); ?></a>
            </nav>
        </div>
    </section>
</main>

<?php
get_footer();

