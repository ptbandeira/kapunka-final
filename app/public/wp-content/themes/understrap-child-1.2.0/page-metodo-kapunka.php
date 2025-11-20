<?php
/**
 * Template Name: Método Kapunka
 * Template Post Type: page
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Get new Carbon Fields (fallback to legacy if not set)
$hero_media      = kapunka_get_meta( 'kapunka_metodo_hero_media', '' );
$hero_eyebrow    = kapunka_get_meta( 'kapunka_metodo_eyebrow', kapunka_get_meta( 'metodo_hero_eyebrow', __( 'Formación exclusiva', 'understrap' ) ) );
$hero_title      = kapunka_get_meta( 'kapunka_metodo_title', kapunka_get_meta( 'metodo_hero_title', __( 'Formación Kapunka — Certifícate Kapunka Pro', 'understrap' ) ) );
$hero_subtitle   = kapunka_get_meta( 'kapunka_metodo_subtitle', kapunka_get_meta( 'metodo_hero_description', __( 'La técnica detrás del producto. Formación práctica para su equipo y certificación oficial.', 'understrap' ) ) );
$hero_alt_text   = kapunka_get_meta( 'kapunka_metodo_alt_text_hero', __( 'Sesión de formación Kapunka — terapeuta en práctica.', 'understrap' ) );

// Handle hero media (file or image)
if ( empty( $hero_media ) ) {
    $hero_image_url = kapunka_get_meta( 'metodo_hero_image', '' );
    $hero_media     = $hero_image_url ?: get_theme_file_uri( 'images/story-image.jpg' );
}

$hero_media_is_video = false;
$hero_media_type     = '';
if ( $hero_media ) {
    $media_path = wp_parse_url( $hero_media, PHP_URL_PATH );
    $extension  = strtolower( pathinfo( $media_path ?: $hero_media, PATHINFO_EXTENSION ) );
    $hero_media_is_video = in_array( $extension, array( 'mp4', 'webm', 'ogg', 'mov' ), true );
    if ( $hero_media_is_video ) {
        $filetype         = wp_check_filetype( $hero_media );
        $hero_media_type  = $filetype['type'] ? $filetype['type'] : 'video/mp4';
    }
}

// Syllabus - Parse from textarea or use legacy complex
$syllabus_text = kapunka_get_meta( 'kapunka_metodo_syllabus', '' );
$syllabus_duration = kapunka_get_meta( 'kapunka_metodo_duration', __( 'Programa intensivo de dos jornadas. Online + taller práctico.', 'understrap' ) );

// Parse syllabus text into 3 sections
$syllabus_sections = array();
if ( ! empty( $syllabus_text ) ) {
    $lines = preg_split( '/\n+/', trim( $syllabus_text ) );
    $current_section = null;
    foreach ( $lines as $line ) {
        $line = trim( $line );
        if ( empty( $line ) ) {
            continue;
        }
        if ( preg_match( '/^(Teoría|Práctica|Certificación)\s*—\s*(.+)$/i', $line, $matches ) ) {
            if ( $current_section ) {
                $syllabus_sections[] = $current_section;
            }
            $current_section = array(
                'headline' => trim( $matches[1] ),
                'description' => trim( $matches[2] ),
            );
        } elseif ( $current_section && ! empty( $line ) ) {
            $current_section['description'] .= ' ' . $line;
        }
    }
    if ( $current_section ) {
        $syllabus_sections[] = $current_section;
    }
}

// Fallback to legacy complex field
if ( empty( $syllabus_sections ) ) {
    $syllabus_items = kapunka_get_meta( 'metodo_syllabus_items', array() );
    if ( ! empty( $syllabus_items ) && is_array( $syllabus_items ) ) {
        foreach ( $syllabus_items as $item ) {
            $headline = isset( $item['headline'] ) ? trim( (string) $item['headline'] ) : '';
            $description = isset( $item['description'] ) ? trim( (string) $item['description'] ) : '';
            if ( ! empty( $headline ) ) {
                $syllabus_sections[] = array(
                    'headline' => $headline,
                    'description' => $description,
                );
            }
        }
    }
}

// Default syllabus if nothing found
if ( empty( $syllabus_sections ) ) {
    $syllabus_sections = array(
        array(
            'headline' => __( 'Teoría', 'understrap' ),
            'description' => __( 'Bioquímica del Argán puro. Control sensorial, estabilidad y trazabilidad.', 'understrap' ),
        ),
        array(
            'headline' => __( 'Práctica', 'understrap' ),
            'description' => __( 'Masaje facial de remonte (lifting natural) y maniobras corporales combinadas.', 'understrap' ),
        ),
        array(
            'headline' => __( 'Certificación', 'understrap' ),
            'description' => __( 'Examen práctico y diploma oficial Kapunka con sello "Método Kapunka autorizado".', 'understrap' ),
        ),
    );
}

// Badge
$badge_image = kapunka_get_meta( 'kapunka_metodo_badge_image', '' );
if ( empty( $badge_image ) ) {
    $badge_image = kapunka_get_meta( 'metodo_badge_image', '' );
    if ( empty( $badge_image ) ) {
        $badge_image = get_theme_file_uri( 'images/mega-dossier.svg' );
    }
}
$badge_text = kapunka_get_meta( 'kapunka_metodo_badge_text', __( "Badge oficial: 'Método Kapunka autorizado'.", 'understrap' ) );

// Form fields
$form_fields_json = kapunka_get_meta( 'kapunka_metodo_apply_form_fields', '{"fields":["nombre_completo","clinica_centro","correo_profesional","telefono_whatsapp","comentarios"]}' );
$form_fields = json_decode( $form_fields_json, true );
if ( ! is_array( $form_fields ) || ! isset( $form_fields['fields'] ) ) {
    $form_fields = array( 'fields' => array( 'nombre_completo', 'clinica_centro', 'correo_profesional', 'telefono_whatsapp', 'comentarios' ) );
}
$cta_text = kapunka_get_meta( 'kapunka_metodo_apply_cta_text', __( 'Solicitar información', 'understrap' ) );

// Legacy form labels (fallback)
$lead_name_label     = kapunka_get_meta( 'metodo_lead_name_label', __( 'Nombre completo', 'understrap' ) );
$lead_clinic_label   = kapunka_get_meta( 'metodo_lead_clinic_label', __( 'Clínica o centro', 'understrap' ) );
$lead_email_label    = kapunka_get_meta( 'metodo_lead_email_label', __( 'Correo profesional', 'understrap' ) );
$lead_phone_label    = kapunka_get_meta( 'metodo_lead_phone_label', __( 'Teléfono / WhatsApp', 'understrap' ) );
$lead_comments_label = kapunka_get_meta( 'metodo_lead_comments_label', __( 'Comentarios', 'understrap' ) );

// Field labels mapping
$field_labels = array(
    'nombre_completo' => $lead_name_label,
    'clinica_centro' => $lead_clinic_label,
    'correo_profesional' => $lead_email_label,
    'telefono_whatsapp' => $lead_phone_label,
    'comentarios' => $lead_comments_label,
);
?>

<main id="metodo-page" class="site-main site-main--profesionales-detail pro-detail pro-detail--metodo metodo-page-quiet-luxury">
    <section class="metodo-hero metodo-hero--quiet">
        <div class="metodo-hero__media-wrapper">
            <?php if ( $hero_media_is_video ) : ?>
                <video autoplay muted loop playsinline class="metodo-hero__media">
                    <source src="<?php echo esc_url( $hero_media ); ?>" type="<?php echo esc_attr( $hero_media_type ); ?>">
                </video>
            <?php else : ?>
                <img src="<?php echo esc_url( $hero_media ); ?>" alt="<?php echo esc_attr( $hero_alt_text ); ?>" class="metodo-hero__media" loading="lazy" decoding="async">
            <?php endif; ?>
            <div class="metodo-hero__overlay"></div>
        </div>
        <div class="kapunka-clamp metodo-hero__content">
            <div class="metodo-hero__copy">
                <?php if ( $hero_eyebrow ) : ?>
                    <p class="metodo-hero__eyebrow text-uppercase letter-spacing"><?php echo esc_html( $hero_eyebrow ); ?></p>
                <?php endif; ?>
                <?php if ( $hero_title ) : ?>
                    <h1 class="metodo-hero__title"><?php echo esc_html( $hero_title ); ?></h1>
                <?php endif; ?>
                <?php if ( $hero_subtitle ) : ?>
                    <p class="metodo-hero__subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
                <?php endif; ?>
                <a href="#metodo-registro" class="kapunka-button metodo-hero__cta js-scroll-to"><?php echo esc_html( $cta_text ); ?></a>
            </div>
        </div>
    </section>

    <section class="metodo-syllabus metodo-syllabus--quiet">
        <div class="kapunka-clamp">
            <?php if ( $hero_title ) : ?>
                <h2 class="metodo-syllabus__main-title"><?php echo esc_html( $hero_title ); ?></h2>
            <?php endif; ?>
            <div class="metodo-syllabus__grid">
                <?php foreach ( $syllabus_sections as $index => $section ) :
                    $is_certification = ( stripos( $section['headline'], 'certificación' ) !== false );
                    ?>
                    <article class="metodo-syllabus__card<?php echo $is_certification ? ' metodo-syllabus__card--certification' : ''; ?>">
                        <div class="metodo-syllabus__card-inner">
                            <p class="metodo-syllabus__card-eyebrow text-uppercase letter-spacing"><?php echo esc_html( $section['headline'] ); ?></p>
                            <p class="metodo-syllabus__card-description"><?php echo esc_html( $section['description'] ); ?></p>
                            <?php if ( $is_certification && ! empty( $badge_image ) ) : ?>
                                <div class="metodo-syllabus__badge-wrapper">
                                    <img src="<?php echo esc_url( $badge_image ); ?>" alt="<?php echo esc_attr( $badge_text ); ?>" class="metodo-syllabus__badge-image" loading="lazy" decoding="async">
                                    <?php if ( $badge_text ) : ?>
                                        <p class="metodo-syllabus__badge-caption"><?php echo esc_html( $badge_text ); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <?php if ( $syllabus_duration ) : ?>
                <p class="metodo-syllabus__duration"><?php echo esc_html( $syllabus_duration ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="pro-lead metodo-lead metodo-lead--quiet" id="metodo-registro">
        <div class="kapunka-clamp">
            <form class="pro-lead-form metodo-form" id="metodo-training-form" novalidate data-submit-text="<?php echo esc_attr( $cta_text ); ?>">
                <?php wp_nonce_field( 'kapunka_metodo_training_request', 'kapunka_metodo_nonce' ); ?>
                <input type="hidden" name="action" value="kapunka_metodo_training_request">
                <input type="hidden" name="page_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                <?php if ( isset( $kapunkaAjax['metodoNonce'] ) ) : ?>
                    <input type="hidden" name="kapunka_metodo_nonce" value="<?php echo esc_attr( $kapunkaAjax['metodoNonce'] ?? wp_create_nonce( 'kapunka_metodo_training_request' ) ); ?>">
                <?php endif; ?>
                
                <?php foreach ( $form_fields['fields'] as $field_key ) :
                    $is_required = in_array( $field_key, array( 'nombre_completo', 'clinica_centro', 'correo_profesional' ), true );
                    $field_type = ( $field_key === 'correo_profesional' ) ? 'email' : ( ( $field_key === 'comentarios' ) ? 'textarea' : 'text' );
                    $field_label = $field_labels[ $field_key ] ?? ucfirst( str_replace( '_', ' ', $field_key ) );
                    $field_name_map = array(
                        'nombre_completo' => 'nombre_completo',
                        'clinica_centro' => 'clinica_centro',
                        'correo_profesional' => 'correo_profesional',
                        'telefono_whatsapp' => 'telefono_whatsapp',
                        'comentarios' => 'comentarios',
                    );
                    $field_name = $field_name_map[ $field_key ] ?? $field_key;
                    ?>
                    <div class="metodo-form__field">
                        <?php if ( 'textarea' === $field_type ) : ?>
                            <label for="metodo-<?php echo esc_attr( $field_name ); ?>" class="metodo-form__label">
                                <span><?php echo esc_html( $field_label ); ?><?php echo $is_required ? ' <span class="required">*</span>' : ''; ?></span>
                            </label>
                            <textarea
                                id="metodo-<?php echo esc_attr( $field_name ); ?>"
                                name="<?php echo esc_attr( $field_name ); ?>"
                                class="metodo-form__input metodo-form__textarea"
                                <?php echo $is_required ? 'required' : ''; ?>
                                aria-label="<?php echo esc_attr( $field_label ); ?>"
                                rows="4"
                            ></textarea>
                            <span class="metodo-form__error" role="alert" aria-live="polite"></span>
                        <?php else : ?>
                            <label for="metodo-<?php echo esc_attr( $field_name ); ?>" class="metodo-form__label">
                                <span><?php echo esc_html( $field_label ); ?><?php echo $is_required ? ' <span class="required">*</span>' : ''; ?></span>
                            </label>
                            <input
                                type="<?php echo esc_attr( $field_type ); ?>"
                                id="metodo-<?php echo esc_attr( $field_name ); ?>"
                                name="<?php echo esc_attr( $field_name ); ?>"
                                class="metodo-form__input"
                                <?php echo $is_required ? 'required' : ''; ?>
                                aria-label="<?php echo esc_attr( $field_label ); ?>"
                                autocomplete="<?php echo ( $field_key === 'correo_profesional' ) ? 'email' : ( ( $field_key === 'nombre_completo' ) ? 'name' : 'off' ); ?>"
                            >
                            <span class="metodo-form__error" role="alert" aria-live="polite"></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                
                <!-- Honeypot field -->
                <div class="metodo-form__honeypot" aria-hidden="true" tabindex="-1">
                    <label for="metodo-website"><?php esc_html_e( 'Website', 'understrap' ); ?></label>
                    <input type="text" id="metodo-website" name="website" tabindex="-1" autocomplete="off">
                </div>
                
                <div class="metodo-form__actions">
                    <button type="submit" class="kapunka-button metodo-form__submit">
                        <?php echo esc_html( $cta_text ); ?>
                    </button>
                    <div class="metodo-form__status" role="alert" aria-live="polite"></div>
                </div>
            </form>
        </div>
    </section>
</main>

<?php
get_footer();