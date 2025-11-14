<?php
/**
 * Template Name: Clínicas & Dermatología
 * Template Post Type: page
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero_eyebrow = kapunka_get_meta( 'clinicas_hero_eyebrow', __( 'Clínicas & Dermatología', 'understrap' ) );
$hero_title   = kapunka_get_meta( 'clinicas_hero_title', __( 'Rigor en la recuperación cutánea.', 'understrap' ) );
$hero_desc    = kapunka_get_meta( 'clinicas_hero_description', __( 'Argán 100% BIO de primera prensada en frío. El coadyuvante natural para sus protocolos dermatológicos más exigentes.', 'understrap' ) );
$hero_image_id = kapunka_get_meta( 'clinicas_hero_image', 0 );
$macro_image  = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'large' ) : get_theme_file_uri( 'images/story-image.jpg' );

$before_image_id = kapunka_get_meta( 'clinicas_before_image', 0 );
$after_image_id  = kapunka_get_meta( 'clinicas_after_image', 0 );
$before_image    = $before_image_id ? wp_get_attachment_image_url( $before_image_id, 'large' ) : get_theme_file_uri( 'images/story-image.jpg' );
$after_image     = $after_image_id ? wp_get_attachment_image_url( $after_image_id, 'large' ) : get_theme_file_uri( 'images/hero-bg.jpg' );
$beforeafter = array(
    'eyebrow'     => kapunka_get_meta( 'clinicas_beforeafter_eyebrow', __( 'Validación clínica', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'clinicas_beforeafter_title', __( 'Resultados visibles desde la primera semana.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'clinicas_beforeafter_description', __( 'Documentamos cada protocolo con fotografía estandarizada y reportes para su expediente médico.', 'understrap' ) ),
);

$lead = array(
    'eyebrow'     => kapunka_get_meta( 'clinicas_lead_eyebrow', __( 'Solicitar muestras profesionales', 'understrap' ) ),
    'title'       => kapunka_get_meta( 'clinicas_lead_title', __( 'Solicite evaluación clínica.', 'understrap' ) ),
    'description' => kapunka_get_meta( 'clinicas_lead_description', __( 'Crearemos un set específico para su cabina y coordinaremos una demo presencial u online.', 'understrap' ) ),
    'labels'      => array(
        'name'     => kapunka_get_meta( 'clinicas_lead_name_label', __( 'Nombre completo', 'understrap' ) ),
        'clinic'   => kapunka_get_meta( 'clinicas_lead_clinic_label', __( 'Clínica / Centro', 'understrap' ) ),
        'email'    => kapunka_get_meta( 'clinicas_lead_email_label', __( 'Correo profesional', 'understrap' ) ),
        'phone'    => kapunka_get_meta( 'clinicas_lead_phone_label', __( 'Teléfono / WhatsApp', 'understrap' ) ),
        'comments' => kapunka_get_meta( 'clinicas_lead_comments_label', __( 'Comentarios', 'understrap' ) ),
    ),
    'button'      => kapunka_get_meta( 'clinicas_lead_button_label', __( 'Solicitar muestras', 'understrap' ) ),
);

$clinicas_valor_items = kapunka_get_meta( 'clinicas_valor_propuesta', array() );
if ( empty( $clinicas_valor_items ) ) {
    $clinicas_valor_items = array(
        array(
            'headline'  => __( 'Mejora la experiencia del paciente.', 'understrap' ),
            'body'      => __( 'Calma la piel tras un peeling o láser, elevando la satisfacción del paciente.', 'understrap' ),
            'background'=> '',
        ),
        array(
            'headline'  => __( 'Innovación y diferenciación.', 'understrap' ),
            'body'      => __( "Ofrecer un 'ritual Kapunka' o un protocolo exclusivo añade un factor diferenciador en la carta de servicios del centro.", 'understrap' ),
            'background'=> '',
        ),
        array(
            'headline'  => __( 'Calidad asegurada.', 'understrap' ),
            'body'      => __( 'Producto con trazabilidad, registro sanitario y respaldo científico, lo que da confianza al profesional y al paciente.', 'understrap' ),
            'background'=> '',
        ),
        array(
            'headline'  => __( 'Soporte de Kapunka.', 'understrap' ),
            'body'      => __( 'Acceso a material educativo, guías de uso y acompañamiento por parte del equipo Kapunka.', 'understrap' ),
            'background'=> '',
        ),
    );
}

$clinicas_curriculum_modules = kapunka_get_meta( 'clinicas_curriculum_modules', array() );
if ( empty( $clinicas_curriculum_modules ) ) {
    $clinicas_curriculum_modules = array(
        array(
            'title'   => __( 'Módulo Teórico', 'understrap' ),
            'content' => __( 'Propiedades científico-médicas del aceite de argán, fundamentos de dermatología aplicados (ej. fases de cicatrización).', 'understrap' ),
        ),
        array(
            'title'   => __( 'Módulo Práctico', 'understrap' ),
            'content' => __( 'Taller de técnicas de masaje Kapunka y protocolos para: Post-operatorio dermatológico (láser fraccionado, peeling, cirugía menor), Dermatitis/eczema, y Ritual facial anti-edad.', 'understrap' ),
        ),
    );
}
?>

<main id="clinicas-page" class="site-main site-main--profesionales-detail pro-detail pro-detail--clinicas">
    <section class="pro-detail-hero">
        <div class="kapunka-clamp pro-detail-hero__grid">
            <div class="pro-detail-hero__content">
                <?php if ( $hero_eyebrow ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $hero_eyebrow ); ?></p>
                <?php endif; ?>
                <?php if ( $hero_title ) : ?>
                    <h1><?php echo esc_html( $hero_title ); ?></h1>
                <?php endif; ?>
                <?php if ( $hero_desc ) : ?>
                    <p><?php echo esc_html( $hero_desc ); ?></p>
                <?php endif; ?>
            </div>
            <div class="pro-detail-hero__media">
                <img src="<?php echo esc_url( $macro_image ); ?>" alt="<?php esc_attr_e( 'Aplicación macro de aceite en piel', 'understrap' ); ?>" loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <?php if ( ! empty( $clinicas_valor_items ) ) : ?>
        <section class="valor-propuesta-grid valor-propuesta-grid--clinicas" aria-label="<?php esc_attr_e( 'Propuesta de valor Kapunka para clínicas', 'understrap' ); ?>">
            <div class="valor-propuesta-grid__inner">
                <?php
                $vp_index = 0;
                foreach ( $clinicas_valor_items as $item ) :
                    if ( $vp_index >= 4 ) {
                        break;
                    }
                    $headline  = isset( $item['headline'] ) ? trim( (string) $item['headline'] ) : '';
                    $body      = isset( $item['body'] ) ? trim( (string) $item['body'] ) : '';
                    $background = isset( $item['background'] ) ? trim( (string) $item['background'] ) : '';

                    if ( '' === $headline ) {
                        $vp_index++;
                        continue;
                    }
                    ?>
                    <article class="valor-propuesta-grid__item"<?php echo $background ? ' style="background-image: url(' . esc_url( $background ) . ');"' : ''; ?>>
                        <div class="valor-propuesta-grid__overlay"></div>
                        <div class="valor-propuesta-grid__content">
                            <div class="kapunka-clamp valor-propuesta-grid__shell">
                                <div class="valor-propuesta-grid__content-inner">
                                    <h3><?php echo esc_html( $headline ); ?></h3>
                                    <?php if ( '' !== $body ) : ?>
                                        <p><?php echo esc_html( $body ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php
                    $vp_index++;
                endforeach;
                ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="pro-before-after">
        <div class="kapunka-clamp">
            <div class="pro-before-after__layout" data-before-after>
                <div class="pro-before-after__copy">
                    <?php if ( $beforeafter['eyebrow'] ) : ?>
                        <p class="text-uppercase letter-spacing"><?php echo esc_html( $beforeafter['eyebrow'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( $beforeafter['title'] ) : ?>
                        <h2><?php echo esc_html( $beforeafter['title'] ); ?></h2>
                    <?php endif; ?>
                    <?php if ( $beforeafter['description'] ) : ?>
                        <p><?php echo esc_html( $beforeafter['description'] ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="pro-before-after__visual">
                    <figure class="pro-before-after__viewport">
                        <img class="pro-before-after__image pro-before-after__image--after" src="<?php echo esc_url( $after_image ); ?>" alt="<?php esc_attr_e( 'Resultado después del tratamiento', 'understrap' ); ?>" loading="lazy" decoding="async">
                        <img class="pro-before-after__image pro-before-after__image--before" src="<?php echo esc_url( $before_image ); ?>" alt="<?php esc_attr_e( 'Piel antes del tratamiento', 'understrap' ); ?>" loading="lazy" decoding="async">
                        <div class="pro-before-after__label pro-before-after__label--before"><?php esc_html_e( 'Antes', 'understrap' ); ?></div>
                        <div class="pro-before-after__label pro-before-after__label--after"><?php esc_html_e( 'Después', 'understrap' ); ?></div>
                    </figure>
                    <div class="pro-before-after__control">
                        <input type="range" min="8" max="92" value="54" aria-label="<?php esc_attr_e( 'Comparar antes y después', 'understrap' ); ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $clinicas_curriculum_modules ) ) : ?>
        <section class="kapunka-section clinics-curriculum">
            <div class="kapunka-clamp">
                <div class="curriculum-accordion">
                    <?php foreach ( $clinicas_curriculum_modules as $module ) :
                        $module_title   = isset( $module['title'] ) ? trim( (string) $module['title'] ) : '';
                        $module_content = isset( $module['content'] ) ? trim( (string) $module['content'] ) : '';
                        if ( '' === $module_title ) {
                            continue;
                        }
                        ?>
                        <details class="curriculum-accordion__item">
                            <summary>
                                <span><?php echo esc_html( $module_title ); ?></span>
                            </summary>
                            <?php if ( '' !== $module_content ) : ?>
                                <div class="curriculum-accordion__body">
                                    <?php echo wp_kses_post( wpautop( $module_content ) ); ?>
                                </div>
                            <?php endif; ?>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="pro-lead" id="clinicas-form">
        <div class="kapunka-clamp pro-lead__grid">
            <div>
                <?php if ( $lead['eyebrow'] ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $lead['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( $lead['title'] ) : ?>
                    <h2><?php echo esc_html( $lead['title'] ); ?></h2>
                <?php endif; ?>
                <?php if ( $lead['description'] ) : ?>
                    <p><?php echo esc_html( $lead['description'] ); ?></p>
                <?php endif; ?>
            </div>
            <form class="pro-lead-form">
                <label>
                    <span><?php echo esc_html( $lead['labels']['name'] ); ?></span>
                    <input type="text" name="nombre" required>
                </label>
                <label>
                    <span><?php echo esc_html( $lead['labels']['clinic'] ); ?></span>
                    <input type="text" name="clinica" required>
                </label>
                <label>
                    <span><?php echo esc_html( $lead['labels']['email'] ); ?></span>
                    <input type="email" name="email" required>
                </label>
                <label>
                    <span><?php echo esc_html( $lead['labels']['phone'] ); ?></span>
                    <input type="tel" name="telefono">
                </label>
                <label>
                    <span><?php echo esc_html( $lead['labels']['comments'] ); ?></span>
                    <textarea name="mensaje" rows="3"></textarea>
                </label>
                <button type="submit" class="btn btn-primary">
                    <?php echo esc_html( $lead['button'] ); ?>
                </button>
            </form>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-before-after]').forEach(function (component) {
        var range = component.querySelector('input[type="range"]');
        if (!range) {
            return;
        }
        var viewport = component.querySelector('.pro-before-after__viewport');
        var updateSlider = function (value) {
            viewport.style.setProperty('--slider', value + '%');
        };
        updateSlider(range.value);
        range.addEventListener('input', function (event) {
            updateSlider(event.target.value);
        });
    });
});
</script>

<?php
get_footer();
