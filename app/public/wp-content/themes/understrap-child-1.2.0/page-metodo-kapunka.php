<?php
/**
 * Template Name: Método Kapunka
 * Template Post Type: page
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$default_training_image = get_theme_file_uri( 'images/story-image.jpg' );
$default_badge_image    = get_theme_file_uri( 'images/mega-dossier.svg' );

$hero_eyebrow     = kapunka_get_meta( 'metodo_hero_eyebrow', __( 'Formación exclusiva', 'understrap' ) );
$hero_title       = kapunka_get_meta( 'metodo_hero_title', __( 'La técnica detrás del producto.', 'understrap' ) );
$hero_description = kapunka_get_meta( 'metodo_hero_description', __( 'Formación exclusiva para su equipo. Asegure la excelencia en cada aplicación con nuestros protocolos registrados.', 'understrap' ) );
$hero_image       = (string) kapunka_get_meta( 'metodo_hero_image', '' );
$hero_image       = $hero_image ?: $default_training_image;

$syllabus_eyebrow = kapunka_get_meta( 'metodo_syllabus_eyebrow', __( 'Syllabus', 'understrap' ) );
$syllabus_title   = kapunka_get_meta( 'metodo_syllabus_title', __( 'Programa intensivo de dos jornadas.', 'understrap' ) );
$default_syllabus = array(
    array(
        'headline'    => __( 'Teoría', 'understrap' ),
        'description' => __( 'Bioquímica del Argán puro. Control sensorial, estabilidad y trazabilidad.', 'understrap' ),
    ),
    array(
        'headline'    => __( 'Práctica', 'understrap' ),
        'description' => __( 'Masaje facial de remonte (lifting natural) y maniobras corporales combinadas.', 'understrap' ),
    ),
    array(
        'headline'    => __( 'Certificación', 'understrap' ),
        'description' => __( 'Examen práctico y diploma oficial Kapunka con sello “Método Kapunka autorizado”.', 'understrap' ),
    ),
);
$syllabus_items = kapunka_get_meta( 'metodo_syllabus_items', array() );
$syllabus_items = ( ! empty( $syllabus_items ) && is_array( $syllabus_items ) ) ? $syllabus_items : $default_syllabus;

$badge_eyebrow     = kapunka_get_meta( 'metodo_badge_eyebrow', __( 'Distintivo físico', 'understrap' ) );
$badge_title       = kapunka_get_meta( 'metodo_badge_title', __( 'Badge para cabina y área de recepción.', 'understrap' ) );
$badge_description = kapunka_get_meta( 'metodo_badge_description', __( 'Al finalizar la auditoría entregamos una placa metálica y recursos digitales para comunicar la certificación.', 'understrap' ) );
$badge_image       = (string) kapunka_get_meta( 'metodo_badge_image', '' );
$badge_image       = $badge_image ?: $default_badge_image;

$lead_eyebrow        = kapunka_get_meta( 'metodo_lead_eyebrow', __( 'Aplicación exclusiva', 'understrap' ) );
$lead_title          = kapunka_get_meta( 'metodo_lead_title', __( 'Solicita el Método Kapunka para tu equipo.', 'understrap' ) );
$lead_description    = kapunka_get_meta( 'metodo_lead_description', __( 'Agenda una sesión de diagnóstico clínico y recibe el plan de formación adaptado a tu cabina.', 'understrap' ) );
$lead_name_label     = kapunka_get_meta( 'metodo_lead_name_label', __( 'Nombre completo', 'understrap' ) );
$lead_clinic_label   = kapunka_get_meta( 'metodo_lead_clinic_label', __( 'Clínica o centro', 'understrap' ) );
$lead_email_label    = kapunka_get_meta( 'metodo_lead_email_label', __( 'Correo profesional', 'understrap' ) );
$lead_phone_label    = kapunka_get_meta( 'metodo_lead_phone_label', __( 'Teléfono / WhatsApp', 'understrap' ) );
$lead_comments_label = kapunka_get_meta( 'metodo_lead_comments_label', __( 'Comentarios', 'understrap' ) );
$lead_button_label   = kapunka_get_meta( 'metodo_lead_button_label', __( 'Solicitar información', 'understrap' ) );
?>

<main id="metodo-page" class="site-main site-main--profesionales-detail pro-detail pro-detail--metodo">
    <section class="metodo-hero">
        <div class="kapunka-clamp metodo-hero__grid">
            <div class="metodo-hero__copy">
                <?php if ( $hero_eyebrow ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $hero_eyebrow ); ?></p>
                <?php endif; ?>
                <?php if ( $hero_title ) : ?>
                    <h1><?php echo esc_html( $hero_title ); ?></h1>
                <?php endif; ?>
                <?php if ( $hero_description ) : ?>
                    <p><?php echo esc_html( $hero_description ); ?></p>
                <?php endif; ?>
            </div>
            <div class="metodo-hero__media">
                <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php esc_attr_e( 'Sesión de formación Kapunka', 'understrap' ); ?>" loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <section class="metodo-syllabus">
        <div class="kapunka-clamp metodo-syllabus__grid">
            <div>
                <?php if ( $syllabus_eyebrow ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $syllabus_eyebrow ); ?></p>
                <?php endif; ?>
                <?php if ( $syllabus_title ) : ?>
                    <h2><?php echo esc_html( $syllabus_title ); ?></h2>
                <?php endif; ?>
            </div>
            <ol class="metodo-syllabus__timeline">
                <?php foreach ( $syllabus_items as $item ) : ?>
                    <?php
                    $item_headline    = isset( $item['headline'] ) ? trim( (string) $item['headline'] ) : '';
                    $item_description = isset( $item['description'] ) ? trim( (string) $item['description'] ) : '';

                    if ( '' === $item_headline && '' === $item_description ) {
                        continue;
                    }
                    ?>
                    <li>
                        <?php if ( $item_headline ) : ?>
                            <span><?php echo esc_html( $item_headline ); ?></span>
                        <?php endif; ?>
                        <?php if ( $item_description ) : ?>
                            <p><?php echo esc_html( $item_description ); ?></p>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

    <section class="metodo-cert">
        <div class="kapunka-clamp metodo-cert__grid">
            <div>
                <?php if ( $badge_eyebrow ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $badge_eyebrow ); ?></p>
                <?php endif; ?>
                <?php if ( $badge_title ) : ?>
                    <h2><?php echo esc_html( $badge_title ); ?></h2>
                <?php endif; ?>
                <?php if ( $badge_description ) : ?>
                    <p><?php echo esc_html( $badge_description ); ?></p>
                <?php endif; ?>
            </div>
            <div class="metodo-cert__badge">
                <img src="<?php echo esc_url( $badge_image ); ?>" alt="<?php esc_attr_e( 'Badge oficial Método Kapunka', 'understrap' ); ?>" loading="lazy" decoding="async">
            </div>
        </div>
    </section>

    <section class="pro-lead metodo-lead" id="metodo-registro">
        <div class="kapunka-clamp pro-lead__grid">
            <div>
                <?php if ( $lead_eyebrow ) : ?>
                    <p class="text-uppercase letter-spacing"><?php echo esc_html( $lead_eyebrow ); ?></p>
                <?php endif; ?>
                <?php if ( $lead_title ) : ?>
                    <h2><?php echo esc_html( $lead_title ); ?></h2>
                <?php endif; ?>
                <?php if ( $lead_description ) : ?>
                    <p><?php echo esc_html( $lead_description ); ?></p>
                <?php endif; ?>
            </div>
            <form class="pro-lead-form">
                <label>
                    <span><?php echo esc_html( $lead_name_label ); ?></span>
                    <input type="text" name="nombre" required>
                </label>
                <label>
                    <span><?php echo esc_html( $lead_clinic_label ); ?></span>
                    <input type="text" name="clinica" required>
                </label>
                <label>
                    <span><?php echo esc_html( $lead_email_label ); ?></span>
                    <input type="email" name="email" required>
                </label>
                <label>
                    <span><?php echo esc_html( $lead_phone_label ); ?></span>
                    <input type="tel" name="telefono">
                </label>
                <label>
                    <span><?php echo esc_html( $lead_comments_label ); ?></span>
                    <textarea name="mensaje" rows="3"></textarea>
                </label>
                <button type="submit" class="btn btn-primary"><?php echo esc_html( $lead_button_label ); ?></button>
            </form>
        </div>
    </section>
</main>

<?php
get_footer();
