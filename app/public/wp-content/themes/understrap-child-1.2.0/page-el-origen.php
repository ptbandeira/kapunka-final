<?php
/**
 * Template Name: El Origen
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero_title    = kapunka_get_meta( 'crb_origen_hero_title', __( 'De la tierra al tacto.', 'understrap' ) );
$hero_subtitle = kapunka_get_meta( 'crb_origen_hero_subtitle', __( 'La búsqueda de Mónica Ruiz por el argán más puro del mundo.', 'understrap' ) );
$hero_image_id = kapunka_get_meta( 'crb_origen_hero_image', 0 );
$hero_fallback = get_stylesheet_directory_uri() . '/images/hero-bg.jpg';
$hero_background = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : $hero_fallback;

$letter_default = <<<'HTML'
<p>Hola, soy Mónica Ruiz Borrego, fundadora de Kapunka. Quiero contarte cómo nació esta aventura, que en el fondo es una historia de agradecimiento, pasión por el cuidado de los demás y amor por lo natural.</p>
<p>Nací en 1979 en un pueblo de Barcelona, y desde siempre supe que lo mío era ayudar a las personas. Estudié enfermería y me especialicé en quiromasaje terapéutico. Durante años trabajé codo a codo con grandes médicos y atletas de alto rendimiento, aprendiendo cada día sobre el cuerpo humano y sus necesidades. Vi de cerca cómo la piel de quienes pasan por cirugías, lesiones o tratamientos agresivos sufre y necesita un cuidado especial. También noté que en esos momentos delicados (post-operatorios, enfermedades de la piel, incluso cambios de clima o estrés) muchas veces la gente no tenía a mano un producto realmente puro, seguro y efectivo para aliviar su piel. Sigo ampliando mi formación profesional: actualmente soy estudiante de Medicina, profundizando en la teoría clínica y la bioquímica del argán puro que compartimos en el Método Kapunka y en su programa intensivo para profesionales.</p>
<p>Con el tiempo, fui recopilando conocimientos, remedios tradicionales y evidencia científica, siempre con una idea en mente: “¿Y si pudiera ofrecer a todos un cuidado natural, tan eficaz como el médico pero sin efectos secundarios?”. Esa semilla se convirtió en mi proyecto de vida.</p>
<p>Mi primer viaje a Marruecos fue revelador. Allí conecté con comunidades locales que llevaban siglos usando el aceite de argán para la salud de la piel. Pude ver cómo extraían manualmente ese “oro líquido” de la naturaleza, con paciencia y cariño. Y comprobé en persona sus beneficios casi milagrosos en pieles secas, con eczemas, cicatrices... ¡Funcionaba! En ese momento sentí una certeza: éste era el regalo que quería llevar al mundo.</p>
<p>Así nació Kapunka, que significa “gracias” en tailandés. Escogí ese nombre porque resume todo en lo que creo. Para mí, la gratitud es la base de la vida: dar gracias por lo que tenemos y devolver un poco de lo que recibimos. Kapunka es mi forma de dar las gracias a la naturaleza, por este aceite único; a mis pacientes, por inspirarme a crear algo mejor para ellos; y a todas las personas que confían en nosotros, ofreciendo a cambio calidad y honestidad.</p>
<p>Comencé formulando el aceite de argán Kapunka con un objetivo innegociable: ofrecer el mejor producto de argán del mundo, con la más alta pureza y calidad porque todos nos merecemos lo mejor para nuestra salud. Sin químicos, sin trucos, sin efectos secundarios. Sólo algo 100% natural que pudiera usar toda la familia, desde un bebé hasta una persona mayor, y que realmente marcara la diferencia en la piel.</p>
<p>Hoy, varios años después, Kapunka es una realidad hermosa. Somos una empresa dedicada en exclusiva al aceite de argán puro, con estudios científicos de más de 35 años que respaldan sus propiedades excepcionales. Hemos construido un equipo de profesionales apasionados que comparten esta visión.</p>
<p>Nuestra misión es llevar Kapunka a cualquier parte del mundo donde alguien necesite cuidar su piel, su cabello o sus uñas con total confianza.</p>
<p>Nuestros valores nos guían en cada paso: valoramos la Confianza por encima de todo; toda la confianza que nos das al ponerte nuestro aceite en la piel la devolvemos con transparencia y calidad absoluta. Creemos en el Esfuerzo y la Disciplina: desde la meticulosa recolección de cada nuez de argán hasta la formación de profesionales en el Método Kapunka, ponemos dedicación y rigor en cada detalle. Practicamos el Compromiso: con tu bienestar, con la comunidad que produce nuestro aceite y con el medio ambiente. Y, por supuesto, Agradecimiento: nunca olvidamos dar gracias - a nuestros clientes, a nuestros colaboradores y a la Madre Tierra que nos brinda este tesoro.</p>
<p>“Quien tiene la oportunidad de cambiar las cosas, tiene la obligación de hacer lo posible.” - Esta frase me ha inspirado siempre. En Kapunka la hacemos realidad poniendo nuestro granito de arena para cambiar la forma en que cuidamos la piel: con respeto, con amor y con gratitud.</p>
<p>Gracias de corazón por leer mi historia y por confiar en Kapunka. Te invito a que formes parte de nuestra familia: cuando uses nuestro aceite, estás abrazando años de tradición, ciencia y cariño embotellados para ti.</p>
<p>Un fuerte abrazo,</p>
<p>Mónica - Fundadora de Kapunka</p>
HTML;

$highlights_image_id = (int) kapunka_get_meta( 'crb_origen_highlights_image', 0 );
$highlights_entries  = kapunka_get_meta( 'crb_origen_highlights_repeater', array() );
if ( empty( $highlights_entries ) || ! is_array( $highlights_entries ) ) {
    $highlights_entries = array(
        array( 'crb_origen_highlight_text' => __( 'Como enfermera y quiromasajista, entendí que la piel dañada no solo necesita química, necesita nutrición fundamental.', 'understrap' ) ),
        array( 'crb_origen_highlight_text' => __( 'Así nació Kapunka, que significa “gracias” en tailandés. Es mi forma de dar las gracias a la naturaleza, a mis pacientes y a todas las personas que confían en nosotros.', 'understrap' ) ),
        array( 'crb_origen_highlight_text' => __( 'Ofrecer el mejor producto... con la más alta pureza y calidad... sin químicos, sin trucos, sin efectos secundarios. Sólo algo 100% natural.', 'understrap' ) ),
    );
}
$full_letter_link_text = kapunka_get_meta( 'crb_origen_full_letter_link_text', __( 'Leer la carta completa de Mónica →', 'understrap' ) );
$modal_letter_content  = kapunka_get_meta( 'crb_origen_full_letter_modal_content', $letter_default );
$interlude_image_id    = (int) kapunka_get_meta( 'crb_origen_interlude_image', 0 );
$interlude_caption     = kapunka_get_meta( 'crb_origen_interlude_caption', __( 'Una historia de confluencia sanitaria.', 'understrap' ) );
?>
<section class="origen-hero" style="background-image: url('<?php echo esc_url( $hero_background ); ?>');">
    <div class="origen-hero__overlay"></div>
    <div class="kapunka-clamp origen-hero__content">
        <?php if ( $hero_title ) : ?>
            <h1 class="origen-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
        <?php endif; ?>
        <?php if ( $hero_subtitle ) : ?>
            <p class="origen-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php if ( $highlights_image_id || ! empty( $highlights_entries ) ) : ?>
    <section class="origen-highlights">
        <div class="kapunka-clamp origen-highlights__grid">
            <div class="origen-highlights__media">
                <?php
                if ( $highlights_image_id ) {
                    echo wp_get_attachment_image( $highlights_image_id, 'large', false, array( 'loading' => 'lazy' ) );
                }
                ?>
            </div>
            <div class="origen-highlights__list">
                <?php foreach ( $highlights_entries as $highlight ) :
                    $text = isset( $highlight['crb_origen_highlight_text'] ) ? trim( (string) $highlight['crb_origen_highlight_text'] ) : '';

                    if ( '' === $text ) {
                        continue;
                    }
                    ?>
                    <article class="origen-highlight">
                        <h2><?php echo esc_html( $text ); ?></h2>
                    </article>
                <?php endforeach; ?>

                <?php if ( $modal_letter_content && '' !== trim( (string) $full_letter_link_text ) ) : ?>
                    <button type="button" class="origen-highlights__link" data-letter-open>
                        <?php echo esc_html( $full_letter_link_text ); ?>
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if ( $modal_letter_content ) : ?>
    <div class="origen-letter-modal" data-letter-modal aria-hidden="true" role="dialog" aria-modal="true">
        <div class="origen-letter-modal__scrim" data-letter-close></div>
        <div class="origen-letter-modal__dialog" role="document" tabindex="-1">
            <button type="button" class="origen-letter-modal__close" aria-label="<?php esc_attr_e( 'Cerrar carta', 'understrap' ); ?>" data-letter-close>
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="origen-letter-modal__content">
                <p class="text-uppercase letter-spacing origen-letter-modal__eyebrow"><?php esc_html_e( 'Carta de la fundadora', 'understrap' ); ?></p>
                <div class="origen-letter-modal__body">
                    <?php echo wp_kses_post( $modal_letter_content ); ?>
                </div>
                <div class="origen-letter-modal__signature-block">
                    <p><?php esc_html_e( 'Un fuerte abrazo,', 'understrap' ); ?></p>
                    <span class="origen-letter-modal__signature" aria-hidden="true">M.</span>
                    <p><?php esc_html_e( 'Mónica — Fundadora de Kapunka', 'understrap' ); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ( $interlude_image_id ) : ?>
    <section class="origen-interlude">
        <figure class="origen-interlude__figure">
            <?php echo wp_get_attachment_image( $interlude_image_id, 'full', false, array( 'loading' => 'lazy' ) ); ?>
            <?php if ( '' !== trim( (string) $interlude_caption ) ) : ?>
                <figcaption class="origen-interlude__caption"><?php echo esc_html( $interlude_caption ); ?></figcaption>
            <?php endif; ?>
        </figure>
    </section>
<?php endif; ?>

<?php
get_footer();
