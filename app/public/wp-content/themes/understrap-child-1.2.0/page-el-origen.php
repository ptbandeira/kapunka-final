<?php
/**
 * Template Name: El Origen
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero_title       = kapunka_get_meta( 'crb_origen_hero_title', __( 'De la tierra al tacto.', 'understrap' ) );
$hero_subtitle    = kapunka_get_meta( 'crb_origen_hero_subtitle', __( 'La búsqueda de Mónica Ruiz por el argán más puro del mundo.', 'understrap' ) );
$hero_image_id    = kapunka_get_meta( 'crb_origen_hero_image', 0 );
$hero_fallback    = get_stylesheet_directory_uri() . '/images/hero-bg.jpg';
$hero_background  = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : $hero_fallback;

$story_panels = kapunka_get_meta( 'origen_story_panels', array() );
$story_blocks = kapunka_get_meta( 'origen_story_blocks', array() );
if ( empty( $story_panels ) && empty( $story_blocks ) ) {
    $story_blocks_all = kapunka_get_meta( 'sobre_story', array() );
    $story_panels     = array_slice( $story_blocks_all, 0, min( 3, count( $story_blocks_all ) ) );
    $story_blocks     = array_slice( $story_blocks_all, count( $story_panels ) );
}
$founder      = array(
    'title' => kapunka_get_meta( 'sobre_founder_title', __( 'La fundadora', 'understrap' ) ),
    'bio'   => kapunka_get_meta( 'sobre_founder_bio' ),
    'image' => kapunka_get_meta( 'sobre_founder_image' ),
);
$letter_default = <<<'HTML'
<p>Hola, soy Mónica Ruiz Borrego, fundadora de Kapunka. Quiero contarte cómo nació esta aventura, que en el fondo es una historia de agradecimiento, pasión por el cuidado de los demás y amor por lo natural.</p>
<p>Nací en 1979 en un pueblo de Barcelona, y desde siempre supe que lo mío era ayudar a las personas. Estudié enfermería y me especialicé en quiromasaje terapéutico. Durante años trabajé codo a codo con grandes médicos y atletas de alto rendimiento, aprendiendo cada día sobre el cuerpo humano y sus necesidades. Vi de cerca cómo la piel de quienes pasan por cirugías, lesiones o tratamientos agresivos sufre y necesita un cuidado especial. También noté que en esos momentos delicados (post-operatorios, enfermedades de la piel, incluso cambios de clima o estrés) muchas veces la gente no tenía a mano un producto realmente puro, seguro y efectivo para aliviar su piel.</p>
<p>Con el tiempo, fui recopilando conocimientos, remedios tradicionales y evidencia científica, siempre con una idea en mente: “¿Y si pudiera ofrecer a todos un cuidado natural, tan eficaz como el médico pero sin efectos secundarios?”. Esa semilla se convirtió en mi proyecto de vida.</p>
<p>Mi primer viaje a Marruecos fue revelador. Allí conecté con comunidades locales que llevaban siglos usando el aceite de argán para la salud de la piel. Pude ver cómo extraían manualmente ese “oro líquido” de la naturaleza, con paciencia y cariño. Y comprobé en persona sus beneficios casi milagrosos en pieles secas, con eczemas, cicatrices... ¡Funcionaba! En ese momento sentí una certeza: éste era el regalo que quería llevar al mundo.</p>
<p>Así nació Kapunka, que significa “gracias” en tailandés. Escogí ese nombre porque resume todo en lo que creo. Para mí, la gratitud es la base de la vida: dar gracias por lo que tenemos y devolver un poco de lo que recibimos. Kapunka es mi forma de dar las gracias a la naturaleza, por este aceite único; a mis pacientes, por inspirarme a crear algo mejor para ellos; y a todas las personas que confían en nosotros, ofreciendo a cambio calidad y honestidad.</p>
<p>Comencé formulando el aceite de argán Kapunka con un objetivo innegociable: ofrecer el mejor producto de argán del mundo, con la más alta pureza y calidad porque todos nos merecemos lo mejor para nuestra salud. Sin químicos, sin trucos, sin efectos secundarios. Sólo algo 100% natural que pudiera usar toda la familia, desde un bebé hasta una persona mayor, y que realmente marcara la diferencia en la piel.</p>
<p>Hoy, varios años después, Kapunka es una realidad hermosa. Somos una empresa dedicada en exclusiva al aceite de argán puro, con estudios científicos de más de 35 años que respaldan sus propiedades excepcionales. Hemos construido un equipo de profesionales apasionados que comparten esta visión.</p>
<p>Nuestra misión es llevar Kapunka a cualquier parte del mundo donde alguien necesite cuidar su piel, su cabello o sus uñas con total confianza.</p>
<p>Nuestros valores nos guían en cada paso: valoramos la Confianza por encima de todo la confianza que nos das al ponerte nuestro aceite en la piel la devolvemos con transparencia y calidad absoluta. Creemos en el Esfuerzo y la Disciplina: desde la meticulosa recolección de cada nuez de argán hasta la formación de profesionales en el Método Kapunka, ponemos dedicación y rigor en cada detalle. Practicamos el Compromiso: con tu bienestar, con la comunidad que produce nuestro aceite y con el medio ambiente. Y, por supuesto, Agradecimiento: nunca olvidamos dar gracias - a nuestros clientes, a nuestros colaboradores y a la Madre Tierra que nos brinda este tesoro.</p>
<p>“Quien tiene la oportunidad de cambiar las cosas, tiene la obligación de hacer lo posible.” - Esta frase me ha inspirado siempre. En Kapunka la hacemos realidad poniendo nuestro granito de arena para cambiar la forma en que cuidamos la piel: con respeto, con amor y con gratitud.</p>
<p>Gracias de corazón por leer mi historia y por confiar en Kapunka. Te invito a que formes parte de nuestra familia: cuando uses nuestro aceite, estás abrazando años de tradición, ciencia y cariño embotellados para ti.</p>
<p>Un fuerte abrazo,</p>
<p>Mónica - Fundadora de Kapunka</p>
HTML;
$founder_letter = kapunka_get_meta( 'crb_origen_founder_letter', $letter_default );
$letter_excerpt = $founder_letter ? wp_trim_words( wp_strip_all_tags( wp_kses_post( $founder_letter ) ), 38, '…' ) : '';
$founder_image_id = kapunka_get_meta( 'crb_origen_founder_image', 0 );
$founder_image    = $founder_image_id ? wp_get_attachment_image( $founder_image_id, 'large', false, array( 'loading' => 'lazy', 'class' => 'origen-founder-letter__media-img' ) ) : '';
$rendered_letter = $founder_letter;
$has_closing_line = ( false !== stripos( $founder_letter, 'Un fuerte abrazo' ) );
$has_founder_line = ( false !== stripos( $founder_letter, 'Mónica' ) );
if ( $founder_letter && false === strpos( $founder_letter, '<p' ) ) {
    $rendered_letter = wpautop( $founder_letter );
}

$training_anchor = 'efectivo para aliviar su piel.';
$training_sentence = ' Sigo ampliando mi formación profesional: actualmente soy estudiante de Medicina, profundizando en la teoría clínica y la bioquímica del argán puro que compartimos en el Método Kapunka y en su programa intensivo para profesionales.';
if ( false === stripos( $rendered_letter, 'estudiante de Medicina' ) && false !== strpos( $rendered_letter, $training_anchor ) ) {
    $rendered_letter = str_replace( $training_anchor, $training_anchor . $training_sentence, $rendered_letter );
}

$values_anchor = 'valoramos la Confianza por encima de todo';
$values_replacement = 'valoramos la Confianza por encima de todo; toda la confianza que nos das al ponerte nuestro aceite en la piel la devolvemos con transparencia y calidad absoluta';
if ( false === stripos( $rendered_letter, 'toda la confianza que nos das' ) && false !== stripos( $rendered_letter, $values_anchor ) ) {
    $rendered_letter = preg_replace(
        sprintf( '/%s([^.;]*)/u', preg_quote( $values_anchor, '/' ) ),
        $values_replacement,
        $rendered_letter,
        1
    );
}

$signature_markup   = '<span class="origen-letter-modal__signature" aria-hidden="true">M.</span>';
$closing_paragraph  = '<p>Un fuerte abrazo,</p>';
$founder_paragraph  = '<p>Mónica - Fundadora de Kapunka</p>';

$rendered_letter = str_replace( array( $closing_paragraph, $founder_paragraph ), '', (string) $rendered_letter );
$mission_title    = kapunka_get_meta( 'crb_origen_mission_title', __( 'Misión', 'understrap' ) );
$mission_text     = kapunka_get_meta( 'crb_origen_mission_text' );
$vision_title     = kapunka_get_meta( 'crb_origen_vision_title', __( 'Visión', 'understrap' ) );
$vision_text      = kapunka_get_meta( 'crb_origen_vision_text' );
$impact_headline  = kapunka_get_meta( 'crb_origen_impact_headline', __( 'Belleza que empodera.', 'understrap' ) );
$impact_body      = kapunka_get_meta( 'crb_origen_impact_body' );
$impact_stats     = kapunka_get_meta( 'crb_origen_impact_stats', array() );
$valor_tiles     = kapunka_get_meta( 'crb_origen_valor_tiles', array() );
$valor_defaults  = array(
    array(
        'headline'   => __( 'Confianza', 'understrap' ),
        'body'       => __( 'Honestidad y calidad absoluta en todo lo que hacemos. Nos avalan pruebas científicas y la satisfacción de nuestros clientes. Cada frasco de Kapunka lleva consigo esa garantía.', 'understrap' ),
        'background' => '',
    ),
    array(
        'headline'   => __( 'Esfuerzo & Excelencia', 'understrap' ),
        'body'       => __( 'No escatimamos en esfuerzos para lograr la máxima pureza y eficacia. Desde la cosecha manual hasta las pruebas de laboratorio, perseguimos la excelencia.', 'understrap' ),
        'background' => '',
    ),
    array(
        'headline'   => __( 'Compromiso', 'understrap' ),
        'body'       => __( 'Con tu piel y tu salud, con nuestro equipo y colaboradores, y con el entorno. Cumplimos lo que prometemos y nos regimos por la ética.', 'understrap' ),
        'background' => '',
    ),
    array(
        'headline'   => __( 'Agradecimiento', 'understrap' ),
        'body'       => __( 'El valor que dio origen a todo. Agradecemos la confianza de cada cliente retribuyéndola con calidad. Agradecemos a la naturaleza cuidándola (producción sostenible, envases reciclables).', 'understrap' ),
        'background' => '',
    ),
);
if ( empty( $valor_tiles ) ) {
    $valor_tiles = $valor_defaults;
}
$cooperatives_title = kapunka_get_meta( 'origen_cooperativas_title', __( 'Cooperativas de mujeres', 'understrap' ) );
$cooperatives_description = kapunka_get_meta( 'origen_cooperativas_description' );
$cooperatives_items = kapunka_get_meta( 'origen_cooperativas_items', array() );
if ( empty( $cooperatives_items ) ) {
    $cooperatives_title       = $cooperatives_title ?: kapunka_get_meta( 'sobre_cooperativas_title', __( 'Cooperativas de mujeres', 'understrap' ) );
    $cooperatives_description = $cooperatives_description ?: kapunka_get_meta( 'sobre_cooperativas_description' );
    $cooperatives_items       = kapunka_get_meta( 'sobre_cooperativas_items', array() );
}
$extra_components = kapunka_get_meta( 'sobre_componentes', array() );

$sobre_section_counter    = 0;
$kapunka_sobre_section_class = static function( $base_class ) use ( &$sobre_section_counter ) {
    $sobre_section_counter++;
    $tone_class = ( $sobre_section_counter % 2 === 0 ) ? 'sobre-block--muted' : 'sobre-block--light';
    return trim( $base_class . ' sobre-block ' . $tone_class );
};
?>

<section class="hero-section hero-section--origen hero-section--parallax">
    <div class="hero-parallax" style="background-image: url('<?php echo esc_url( $hero_background ); ?>');"></div>
    <div class="hero-content">
        <div class="kapunka-clamp">
            <div class="hero-content__inner">
                <?php if ( $hero_title ) : ?>
                    <h1><?php echo esc_html( $hero_title ); ?></h1>
                <?php endif; ?>
                <?php if ( $hero_subtitle ) : ?>
                    <p><?php echo esc_html( $hero_subtitle ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<main id="origen-page" class="site-main site-main--sobre">

    <?php if ( ! empty( $story_panels ) && ! empty( $hero_background ) ) : ?>
        <section class="sobre-sticky-panels">
            <div class="sobre-sticky-panels__media" style="background-image: url('<?php echo esc_url( $hero_background ); ?>');"></div>
            <div class="sobre-sticky-panels__copy">
                <?php foreach ( $story_panels as $index => $panel ) : ?>
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

    <?php if ( $founder_letter ) : ?>
         <section class="origen-founder-letter">
            <div class="kapunka-clamp origen-founder-letter__grid">
                <div class="origen-founder-letter__copy">
                    <p class="text-uppercase letter-spacing origen-founder-letter__eyebrow"><?php esc_html_e( 'Carta de la fundadora', 'understrap' ); ?></p>
                    <?php if ( $letter_excerpt ) : ?>
                        <p class="origen-founder-letter__excerpt"><?php echo esc_html( $letter_excerpt ); ?></p>
                    <?php endif; ?>
                    <button type="button" class="kapunka-button origen-founder-letter__trigger" data-letter-open>
                        <?php esc_html_e( 'Leer carta completa', 'understrap' ); ?>
                    </button>
                </div>
                <?php if ( $founder_image ) : ?>
                    <div class="origen-founder-letter__media">
                        <?php echo $founder_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </div>
                <?php endif; ?>
            </div>
         </section>
        <div class="origen-letter-modal" data-letter-modal aria-hidden="true" role="dialog" aria-modal="true">
            <div class="origen-letter-modal__scrim" data-letter-close></div>
            <div class="origen-letter-modal__dialog" role="document" tabindex="-1">
                <button type="button" class="origen-letter-modal__close" aria-label="<?php esc_attr_e( 'Cerrar carta', 'understrap' ); ?>" data-letter-close>
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="origen-letter-modal__content">
                    <p class="text-uppercase letter-spacing origen-letter-modal__eyebrow"><?php esc_html_e( 'Carta de la fundadora', 'understrap' ); ?></p>
                    <div class="origen-letter-modal__body">
                        <?php echo wp_kses_post( $rendered_letter ); ?>
                        <?php
                        if ( $has_closing_line ) {
                            echo wp_kses_post( $closing_paragraph );
                            echo $signature_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        }
                        if ( $has_founder_line ) {
                            echo wp_kses_post( $founder_paragraph );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( $mission_text || $vision_text ) : ?>
        <section class="origen-mission-vision">
            <div class="kapunka-clamp origen-mission-vision__grid">
                <?php if ( $mission_text ) : ?>
                    <article>
                        <h2 class="text-uppercase letter-spacing origen-mission-vision__title"><?php echo esc_html( $mission_title ); ?></h2>
                        <p><?php echo esc_html( $mission_text ); ?></p>
                    </article>
                <?php endif; ?>
                <?php if ( $vision_text ) : ?>
                    <article>
                        <h2 class="text-uppercase letter-spacing origen-mission-vision__title"><?php echo esc_html( $vision_title ); ?></h2>
                        <p><?php echo esc_html( $vision_text ); ?></p>
                    </article>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $impact_headline || $impact_body || ! empty( $impact_stats ) ) : ?>
        <section class="sobre-impacto-dark">
            <div class="kapunka-clamp">
                <?php if ( $impact_headline ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $impact_headline ); ?></p>
                <?php endif; ?>
                <?php if ( $impact_body ) : ?>
                    <h2><?php echo esc_html( $impact_body ); ?></h2>
                <?php endif; ?>
                <?php if ( ! empty( $impact_stats ) ) : ?>
                    <div class="sobre-impacto-dark__stats">
                        <?php foreach ( $impact_stats as $stat ) :
                            $stat_number = $stat['stat_number'] ?? '';
                            $stat_label  = $stat['stat_label'] ?? '';
                            if ( '' === trim( (string) $stat_number ) && '' === trim( (string) $stat_label ) ) {
                                continue;
                            }
                            ?>
                            <article>
                                <?php if ( $stat_number ) : ?>
                                    <h3><?php echo esc_html( $stat_number ); ?></h3>
                                <?php endif; ?>
                                <?php if ( $stat_label ) : ?>
                                    <p><?php echo esc_html( $stat_label ); ?></p>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $story_blocks ) ) : ?>
        <section class="<?php echo esc_attr( $kapunka_sobre_section_class( 'story-section' ) ); ?>">
            <div class="kapunka-clamp">
                <?php foreach ( $story_blocks as $block ) :
                    $block_title = isset( $block['title'] ) ? trim( (string) $block['title'] ) : '';
                    $block_desc  = isset( $block['description'] ) ? trim( (string) $block['description'] ) : '';
                    $block_image = $block['image'] ?? 0;

                    if ( '' === $block_title && '' === $block_desc && ! $block_image ) {
                        continue;
                    }
                    ?>
                    <article class="story-block">
                        <div class="story-text">
                            <?php if ( '' !== $block_title ) : ?>
                                <h2><?php echo esc_html( $block_title ); ?></h2>
                            <?php endif; ?>
                            <?php if ( '' !== $block_desc ) : ?>
                                <p><?php echo esc_html( $block_desc ); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ( $block_image ) : ?>
                            <div class="story-image">
                                <?php echo wp_get_attachment_image( $block_image, 'large', false, array( 'loading' => 'lazy' ) ); ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $valor_tiles ) ) : ?>
        <section class="valor-propuesta-grid valor-propuesta-grid--origen" aria-label="<?php esc_attr_e( 'Valores Kapunka', 'understrap' ); ?>">
            <div class="valor-propuesta-grid__inner">
                <?php
                foreach ( $valor_defaults as $index => $defaults ) {
                    if ( ! isset( $valor_tiles[ $index ] ) ) {
                        $valor_tiles[ $index ] = $defaults;
                    } else {
                        $valor_tiles[ $index ]['headline']   = $valor_tiles[ $index ]['headline'] ?? $defaults['headline'];
                        $valor_tiles[ $index ]['body']       = $valor_tiles[ $index ]['body'] ?? $defaults['body'];
                        $valor_tiles[ $index ]['background'] = $valor_tiles[ $index ]['background'] ?? $defaults['background'];
                    }
                }

                foreach ( array_slice( $valor_tiles, 0, 4 ) as $tile ) :
                    $headline   = trim( (string) ( $tile['headline'] ?? '' ) );
                    $body       = trim( (string) ( $tile['body'] ?? '' ) );
                    $background = trim( (string) ( $tile['background'] ?? '' ) );
                    if ( '' === $headline && '' === $body ) {
                        continue;
                    }
                    ?>
                    <article class="valor-propuesta-grid__item"<?php echo $background ? ' style="background-image: url(' . esc_url( $background ) . ');"' : ''; ?>>
                        <div class="valor-propuesta-grid__overlay"></div>
                        <div class="valor-propuesta-grid__content">
                            <div class="kapunka-clamp valor-propuesta-grid__shell">
                                <div class="valor-propuesta-grid__content-inner">
                                    <?php if ( $headline ) : ?>
                                        <h3><?php echo esc_html( $headline ); ?></h3>
                                    <?php endif; ?>
                                    <?php if ( $body ) : ?>
                                        <p><?php echo esc_html( $body ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
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
