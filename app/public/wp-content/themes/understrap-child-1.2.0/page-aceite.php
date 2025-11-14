<?php
/**
 * Template Name: Kapunka Aceite de Argán
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero = array(
    'eyebrow'     => kapunka_get_meta( 'aceite_hero_eyebrow', __( 'Aceite clínico', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'aceite_hero_title', __( 'Nuestro Aceite de Argán', 'understrap' ) ),
    'description' => kapunka_get_meta( 'aceite_hero_description' ),
    'background'  => kapunka_get_meta( 'aceite_hero_background' ),
);
$hero_background = $hero['background'] ? wp_get_attachment_image( $hero['background'], 'full', false, array( 'loading' => 'eager' ) ) : '';
$hero_fallback   = get_stylesheet_directory_uri() . '/images/hero-bg.jpg';

$sections = kapunka_get_meta( 'aceite_sections', array() );
if ( empty( $sections ) ) {
    $sections = array(
        array(
            'title' => __( '¿Qué es Kapunka?', 'understrap' ),
            'copy'  => __( 'Aceite de argán 100% puro, primera prensada en frío y de categoría cosmética premium. Procede exclusivamente de cooperativas marroquíes con las que trabajamos desde hace más de diez años. No agregamos conservantes, perfumes ni otras mezclas. Cada lote es trazable y está registrado en la normativa europea (CPNP, PIF) para garantizar seguridad y eficacia.', 'understrap' ),
            'image' => 0,
        ),
        array(
            'title' => __( 'Propiedades y beneficios', 'understrap' ),
            'copy'  => __( "<ul><li><strong>Vitamina E natural:</strong> tocoferoles antioxidantes que favorecen la regeneración celular y mantienen la piel luminosa.</li><li><strong>Ácidos grasos esenciales Omega 6 y 9:</strong> nutren en profundidad, refuerzan la barrera cutánea y aportan elasticidad.</li><li><strong>Escualeno y esteroles:</strong> hidratan, calman y poseen un efecto antiinflamatorio natural que reduce rojeces.</li><li><strong>Sin conservantes ni perfumes:</strong> seguro para pieles sensibles, bebés y zonas delicadas.</li></ul>", 'understrap' ),
            'image' => 0,
        ),
        array(
            'title' => __( 'Usos y aplicaciones', 'understrap' ),
            'copy'  => __( "<ul><li><strong>Cuidado facial diario:</strong> hidrata, ilumina y suaviza líneas finas incluso en pieles reactivas.</li><li><strong>Post-tratamientos dermatológicos:</strong> se aplica antes y después de láser o cirugía para calmar, reducir inflamación y apoyar la cicatrización.</li><li><strong>Estrías y cicatrices:</strong> aporta elasticidad y ayuda a difuminar marcas recientes.</li><li><strong>Cuidado corporal y masaje:</strong> alivia eccemas, calma picor y relaja músculos.</li><li><strong>Cabello y uñas:</strong> refuerza uñas quebradizas y aporta brillo al cabello seco o con cuero cabelludo sensible.</li><li><strong>Bebés:</strong> ideal para costra láctea e irritaciones del pañal por su pureza.</li></ul>", 'understrap' ),
            'image' => 0,
        ),
        array(
            'title' => __( 'Calidad y certificaciones', 'understrap' ),
            'copy'  => __( 'Producción orgánica certificada en origen, vegano y cruelty-free. Cada lote es analizado en laboratorio, dermatológicamente testado y utilizado en clínicas dermatológicas de Barcelona y Madrid. Trabajamos junto a especialistas que recomiendan Kapunka en protocolos post-procedimiento.', 'understrap' ),
            'image' => 0,
        ),
        array(
            'title' => __( 'Formatos disponibles', 'understrap' ),
            'copy'  => __( 'Roll-on de 10 ml para llevar, frascos de 30 ml y 60 ml con cuentagotas para uso diario, formatos de 100 ml, 250 ml y 500 ml para gabinetes profesionales. Packaging de vidrio reciclable y acabado premium.', 'understrap' ),
            'image' => 0,
        ),
        array(
            'title' => __( 'Instrucciones de uso / Ritual', 'understrap' ),
            'copy'  => __( 'Aplica 3 gotas en la palma, frótalas para activarlas y masajea rostro y cuello con movimientos circulares. Inspira profundo, agradece a tu piel y repite en las zonas del cuerpo, cabello o uñas que necesiten cuidado. Usa mañana y noche o antes/después de cada tratamiento clínico.', 'understrap' ),
            'image' => 0,
        ),
    );
}
?>

<section class="hero-section hero-section--aceite text-left">
    <div class="hero-background">
        <?php
        if ( $hero_background ) {
            echo $hero_background; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        } else {
            ?>
            <img src="<?php echo esc_url( $hero_fallback ); ?>" alt="<?php esc_attr_e( 'Aceite Kapunka', 'understrap' ); ?>" />
            <?php
        }
        ?>
    </div>
    <div class="hero-content">
        <div class="kapunka-clamp">
        <div class="hero-content__inner">
            <?php if ( ! empty( $hero['eyebrow'] ) ) : ?>
                <p class="text-uppercase letter-spacing"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
            <?php endif; ?>
            <h1><?php echo esc_html( $hero['title'] ); ?></h1>
            <?php if ( ! empty( $hero['description'] ) ) : ?>
                <?php echo wp_kses_post( wpautop( $hero['description'] ) ); ?>
            <?php endif; ?>
        </div>
        </div>
    </div>
</section>

<main id="aceite-page" class="site-main site-main--aceite">
    <?php foreach ( $sections as $section ) :
        $title = $section['title'] ?? '';
        $copy  = $section['copy'] ?? '';
        if ( ! $title && ! $copy ) {
            continue;
        }
        $image_id = $section['image'] ?? 0;
        $image    = $image_id ? wp_get_attachment_image( $image_id, 'large', false, array( 'class' => 'aceite-section__image', 'loading' => 'lazy' ) ) : '';
        ?>
        <section class="aprende-section aceite-section">
            <div class="aprende-section__inner kapunka-clamp">
                <div class="aceite-section__grid<?php echo $image ? ' aceite-section__grid--media' : ''; ?>">
                    <div class="aceite-section__content">
                        <h2><?php echo esc_html( $title ); ?></h2>
                        <?php if ( $copy ) : ?>
                            <?php echo wp_kses_post( wpautop( $copy ) ); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( $image ) : ?>
                        <div class="aceite-section__media">
                            <?php echo $image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endforeach; ?>
</main>

<?php
get_footer();
