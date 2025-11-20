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
    'eyebrow'        => kapunka_get_meta( 'kapunka_spas_hero_eyebrow', __( 'SPAS & HOTELES', 'understrap' ) ),
    'title'          => kapunka_get_meta( 'kapunka_spas_hero_title', __( 'Ritual Signature Kapunka. Eleva la experiencia de tus huéspedes y convierte amenities en ventas', 'understrap' ) ),
    'subtitle'       => kapunka_get_meta( 'kapunka_spas_hero_subtitle', __( 'Un ritual premium y un programa amenity-to-retail diseñado para hoteles 5★ y spas de lujo. Pack piloto, formación de equipo y co-marketing incluidos.', 'understrap' ) ),
    'primary_cta'    => array(
        'label' => kapunka_get_meta( 'kapunka_spas_hero_cta_primary_text', __( 'Solicitar Pack Piloto', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'kapunka_spas_hero_cta_primary_url', '/contacto#profesionales' ),
    ),
    'secondary_cta'  => array(
        'label' => kapunka_get_meta( 'kapunka_spas_hero_cta_secondary_text', __( 'Ver Packs Profesionales', 'understrap' ) ),
        'url'   => kapunka_get_meta( 'kapunka_spas_hero_cta_secondary_url', '#packs' ),
    ),
    'support_line'   => kapunka_get_meta( 'kapunka_spas_hero_support_line', __( 'Piloto operativo en 6 semanas — incluye formación y material de venta.', 'understrap' ) ),
    'media_url'      => kapunka_get_meta( 'kapunka_spas_hero_media', '/mnt/data/Spas & Hoteles - Kapunka.png' ),
);

$default_spa_media_placeholder = '/mnt/data/Spas & Hoteles - Kapunka.png';
$hero_media_url      = is_string( $hero['media_url'] ) ? trim( $hero['media_url'] ) : '';

if ( $hero_media_url === $default_spa_media_placeholder ) {
    $hero_media_url = '';
}
$hero_media_is_video = false;
$hero_media_type     = '';

if ( $hero_media_url ) {
    $media_path = wp_parse_url( $hero_media_url, PHP_URL_PATH );
    $extension  = strtolower( pathinfo( $media_path ?: $hero_media_url, PATHINFO_EXTENSION ) );
    $hero_media_is_video = in_array( $extension, array( 'mp4', 'webm', 'ogg', 'mov' ), true );

    if ( $hero_media_is_video ) {
        $filetype         = wp_check_filetype( $hero_media_url );
        $hero_media_type  = $filetype['type'] ? $filetype['type'] : 'video/mp4';
    }
}

if ( '' === $hero_media_url ) {
    $hero_media_url      = get_theme_file_uri( 'media/spa-ritual.mp4' );
    $hero_media_is_video = true;
    $hero_media_type     = 'video/mp4';
}

$partner_logos = kapunka_get_meta( 'kapunka_spas_partner_logos', array() );
if ( ! is_array( $partner_logos ) ) {
    $partner_logos = array();
}
$partner_logos = array_slice( $partner_logos, 0, 6 );
$logo_placeholder_text = kapunka_get_meta( 'kapunka_spas_case_placeholder_text', __( 'LOGO_PLACEHOLDER', 'understrap' ) );

$mini_cases = array(
    array(
        'id'       => 'spa-case-1',
        'title'    => kapunka_get_meta( 'kapunka_spas_case_1_title', '' ),
        'problem'  => kapunka_get_meta( 'kapunka_spas_case_1_problem', '' ),
        'solution' => kapunka_get_meta( 'kapunka_spas_case_1_solution', '' ),
        'result'   => kapunka_get_meta( 'kapunka_spas_case_1_result', '' ),
    ),
    array(
        'id'       => 'spa-case-2',
        'title'    => kapunka_get_meta( 'kapunka_spas_case_2_title', '' ),
        'problem'  => kapunka_get_meta( 'kapunka_spas_case_2_problem', '' ),
        'solution' => kapunka_get_meta( 'kapunka_spas_case_2_solution', '' ),
        'result'   => kapunka_get_meta( 'kapunka_spas_case_2_result', '' ),
    ),
);

$mini_cases = array_values(
    array_filter(
        array_map(
            static function ( $case ) {
                $case['has_content'] = ( '' !== trim( (string) $case['title'] ) ) || ( '' !== trim( (string) $case['problem'] ) ) || ( '' !== trim( (string) $case['solution'] ) ) || ( '' !== trim( (string) $case['result'] ) );

                return $case;
            },
            $mini_cases
        ),
        static function ( $case ) {
            return ! empty( $case['has_content'] );
        }
    )
);

$has_partner_logos = ! empty( $partner_logos );
$has_case_section  = $has_partner_logos || ( '' !== trim( (string) $logo_placeholder_text ) ) || ! empty( $mini_cases );

$spa_pack = array(
    'title'   => kapunka_get_meta( 'kapunka_spa_pack_title', __( 'Spa Partnership Pack', 'understrap' ) ),
    'bullets' => kapunka_get_meta( 'kapunka_spa_pack_bullets', '' ),
    'ref'     => kapunka_get_meta( 'kapunka_spa_pack_ref_price', __( '500 ml = 120 € ; 30 ml = 27 €', 'understrap' ) ),
);
$hotel_pack = array(
    'title'   => kapunka_get_meta( 'kapunka_hotel_pack_title', __( 'Hotel Amenity Pack', 'understrap' ) ),
    'bullets' => kapunka_get_meta( 'kapunka_hotel_pack_bullets', '' ),
);
$cost_example = array(
    'title' => kapunka_get_meta( 'kapunka_cost_example_title', __( 'Ejemplo: coste por tratamiento', 'understrap' ) ),
    'table' => kapunka_get_meta( 'kapunka_cost_example_table', '' ),
);

$training = array(
    'title'    => kapunka_get_meta( 'kapunka_training_title', __( 'Formación Kapunka — Certifícate Kapunka Pro', 'understrap' ) ),
    'modules'  => kapunka_get_meta( 'kapunka_training_modules', '' ),
    'duration' => kapunka_get_meta( 'kapunka_training_duration', __( 'Online + taller presencial 3–4 h (opción in-house).', 'understrap' ) ),
    'cta_text' => kapunka_get_meta( 'kapunka_training_cta_text', __( 'Reservar formación / Solicitar fecha', 'understrap' ) ),
    'cta_url'  => kapunka_get_meta( 'kapunka_training_cta_url', '/contacto#formacion' ),
);

$parse_lines = static function ( $text ) {
    return array_filter(
        array_map(
            static function ( $line ) {
                $clean = trim( preg_replace( '/^[-–—\s]+/', '', $line ) );

                return $clean;
            },
            preg_split( '/\r\n|\r|\n/', (string) $text )
        )
    );
};

$spa_pack['bullets_list']   = $parse_lines( $spa_pack['bullets'] );
$hotel_pack['bullets_list'] = $parse_lines( $hotel_pack['bullets'] );
$cost_example['lines']      = $parse_lines( $cost_example['table'] );
$training['modules_list']   = $parse_lines( $training['modules'] );
$has_packs_section          = ! empty( $spa_pack['bullets_list'] ) || ! empty( $hotel_pack['bullets_list'] ) || ! empty( $cost_example['lines'] );
$has_training_section       = ! empty( $training['modules_list'] ) || '' !== trim( (string) $training['duration'] ) || '' !== trim( (string) $training['title'] );

$training_seal_path = get_stylesheet_directory() . '/images/kapunka-pro-seal.svg';
$training_seal_url  = file_exists( $training_seal_path ) ? get_stylesheet_directory_uri() . '/images/kapunka-pro-seal.svg' : '';
$download_resources_map = kapunka_get_partner_resource_map();
$download_resources     = array();
$download_gate_message  = kapunka_get_meta( 'kapunka_download_gate_message', __( 'Rellene su nombre y email para descargar.', 'understrap' ) );

foreach ( $download_resources_map as $resource_key => $config ) {
    $attachment_id = kapunka_get_meta( $config['field'], 0, get_the_ID() );
    $download_resources[] = array(
        'key'      => $resource_key,
        'label'    => $config['label'],
        'filename' => $config['filename'],
        'type'     => $config['type'],
        'file_url' => $attachment_id ? wp_get_attachment_url( $attachment_id ) : '',
    );
}

$has_download_section = ! empty( $download_resources );
$amenity_steps   = $parse_lines( kapunka_get_meta( 'kapunka_amenity_steps', '' ) );
$amenity_kpis    = $parse_lines( kapunka_get_meta( 'kapunka_amenity_kpi_list', '' ) );
$amenity_example = kapunka_get_meta( 'kapunka_amenity_example', '' );
$has_amenity_section = ! empty( $amenity_steps ) || ! empty( $amenity_kpis ) || '' !== trim( (string) $amenity_example );
$cert_bullets   = $parse_lines( kapunka_get_meta( 'kapunka_certifications_bullets', '' ) );
$logistics_list = $parse_lines( kapunka_get_meta( 'kapunka_logistics_bullets', '' ) );
$commercial_list = $parse_lines( kapunka_get_meta( 'kapunka_commercial_terms', '' ) );
$has_cert_section = ! empty( $cert_bullets ) || ! empty( $logistics_list ) || ! empty( $commercial_list );
$portal_block = array(
    'title' => kapunka_get_meta( 'kapunka_partner_portal_title', __( 'Soporte completo para partners', 'understrap' ) ),
    'text'  => kapunka_get_meta( 'kapunka_partner_portal_text', __( 'Accede a vídeos de formación, plantillas de email, material para recepción/concierge y recursos para co-marketing.', 'understrap' ) ),
    'cta'   => kapunka_get_meta( 'kapunka_partner_portal_cta_text', __( 'Solicitar acceso al Portal Kapunka Pro', 'understrap' ) ),
    'url'   => kapunka_get_meta( 'kapunka_partner_portal_cta_url', '/partner-portal-request' ),
);
$has_portal_block = '' !== trim( (string) $portal_block['title'] ) || '' !== trim( (string) $portal_block['text'] );
$kpi_block = array(
    'title'      => kapunka_get_meta( 'kapunka_kpis_title', __( 'KPIs primarios para piloto (6 semanas)', 'understrap' ) ),
    'list'       => $parse_lines( kapunka_get_meta( 'kapunka_kpis_list', '' ) ),
    'formula'    => $parse_lines( kapunka_get_meta( 'kapunka_kpis_formula', '' ) ),
    'objectives' => $parse_lines( kapunka_get_meta( 'kapunka_kpis_objectives', '' ) ),
);
$has_kpi_block = ! empty( $kpi_block['list'] ) || ! empty( $kpi_block['formula'] ) || ! empty( $kpi_block['objectives'] );
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

$spa_value_text_grid = kapunka_get_meta( 'crb_spa_value_text_grid', array() );
if ( empty( $spa_value_text_grid ) ) {
    $spa_value_text_grid = array(
        array(
            'crb_spa_value_title' => __( 'Rentabilidad', 'understrap' ),
            'crb_spa_value_text'   => __( 'Producto con historia y validación que justifica un ticket medio elevado.', 'understrap' ),
        ),
        array(
            'crb_spa_value_title' => __( 'Formación', 'understrap' ),
            'crb_spa_value_text'   => __( 'Acceso al "Método Kapunka": protocolos de masaje facial y corporal.', 'understrap' ),
        ),
        array(
            'crb_spa_value_title' => __( 'Formatos Cabina', 'understrap' ),
            'crb_spa_value_text'   => __( 'Tamaños exclusivos (500ml) para uso intensivo.', 'understrap' ),
        ),
        array(
            'crb_spa_value_title' => __( 'Soporte Técnico', 'understrap' ),
            'crb_spa_value_text'   => __( 'Fichas técnicas completas y material de marketing.', 'understrap' ),
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

$faq_items = kapunka_get_meta( 'kapunka_faq_items', array() );
if ( ! is_array( $faq_items ) ) {
    $faq_items = array();
}
$has_faq_section = ! empty( $faq_items );
?>

<?php $hero_media_poster = get_theme_file_uri( 'images/story-image.jpg' ); ?>

<main id="spas-page" class="site-main site-main--profesionales-detail pro-detail pro-detail--spas">
    <section class="hero-section spa-hero">
        <div class="hero-background" aria-hidden="true">
            <?php if ( $hero_media_is_video ) : ?>
                <video autoplay muted loop playsinline poster="<?php echo esc_url( $hero_media_poster ); ?>">
                    <source src="<?php echo esc_url( $hero_media_url ); ?>" type="<?php echo esc_attr( $hero_media_type ); ?>">
                </video>
            <?php else : ?>
                <img src="<?php echo esc_url( $hero_media_url ); ?>" alt="" loading="lazy" decoding="async" />
            <?php endif; ?>
        </div>
        <div class="hero-overlay hero-overlay--spa"></div>
        <div class="hero-content">
            <div class="kapunka-clamp">
                <div class="hero-content__inner">
                    <?php if ( $hero['eyebrow'] ) : ?>
                        <p class="text-uppercase letter-spacing"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( $hero['title'] ) : ?>
                        <h1><?php echo esc_html( $hero['title'] ); ?></h1>
                    <?php endif; ?>
                    <?php if ( $hero['subtitle'] ) : ?>
                        <p><?php echo esc_html( $hero['subtitle'] ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $hero['primary_cta']['label'] ) && ! empty( $hero['primary_cta']['url'] ) ) : ?>
                        <div class="spa-hero__ctas">
                            <a class="kapunka-button spa-hero__cta-primary" href="<?php echo esc_url( $hero['primary_cta']['url'] ); ?>">
                                <?php echo esc_html( $hero['primary_cta']['label'] ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="hero-scroll-indicator" aria-hidden="true">
            <span></span>
        </div>
    </section>

    <?php if ( $has_case_section ) : ?>
        <section class="spa-showcase" aria-label="<?php esc_attr_e( 'Logos partners y mini casos', 'understrap' ); ?>">
            <div class="kapunka-clamp">
                <div class="spa-partner-logos">
                    <div class="spa-partner-logos__label">
                        <span><?php esc_html_e( 'Partners & clinics', 'understrap' ); ?></span>
                    </div>
                    <ul class="spa-partner-logos__list">
                        <?php if ( $has_partner_logos ) : ?>
                            <?php foreach ( $partner_logos as $logo_id ) :
                                $logo_src = wp_get_attachment_image_url( $logo_id, 'medium' );

                                if ( ! $logo_src ) {
                                    continue;
                                }

                                $logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
                                ?>
                                <li class="spa-partner-logo">
                                    <img src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( $logo_alt ? $logo_alt : __( 'Logo partner Kapunka', 'understrap' ) ); ?>" loading="lazy" decoding="async" />
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <?php for ( $i = 0; $i < 4; $i++ ) : ?>
                                <li class="spa-partner-logo spa-partner-logo--placeholder">
                                    <?php echo esc_html( $logo_placeholder_text ); ?>
                                </li>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <?php if ( ! empty( $mini_cases ) ) : ?>
                    <div class="spa-mini-cases">
                        <?php foreach ( $mini_cases as $case ) : ?>
                            <article class="spa-mini-case">
                                <?php if ( '' !== trim( (string) $case['title'] ) ) : ?>
                                    <p class="spa-mini-case__eyebrow text-uppercase letter-spacing"><?php esc_html_e( 'Mini caso', 'understrap' ); ?></p>
                                    <h3><?php echo esc_html( $case['title'] ); ?></h3>
                                <?php endif; ?>
                                <dl class="spa-mini-case__details">
                                    <?php if ( '' !== trim( (string) $case['problem'] ) ) : ?>
                                        <dt><?php esc_html_e( 'Problema', 'understrap' ); ?></dt>
                                        <dd><?php echo esc_html( $case['problem'] ); ?></dd>
                                    <?php endif; ?>
                                    <?php if ( '' !== trim( (string) $case['solution'] ) ) : ?>
                                        <dt><?php esc_html_e( 'Solución', 'understrap' ); ?></dt>
                                        <dd><?php echo esc_html( $case['solution'] ); ?></dd>
                                    <?php endif; ?>
                                    <?php if ( '' !== trim( (string) $case['result'] ) ) : ?>
                                        <dt><?php esc_html_e( 'Resultado', 'understrap' ); ?></dt>
                                        <dd><?php echo esc_html( $case['result'] ); ?></dd>
                                    <?php endif; ?>
                                </dl>
                                <button type="button" class="spa-mini-case__cta" data-case-open="<?php echo esc_attr( $case['id'] ); ?>">
                                    <?php esc_html_e( 'Ver caso completo', 'understrap' ); ?>
                                </button>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_packs_section ) : ?>
        <section class="spa-packs" id="packs" aria-labelledby="spa-packs-heading">
            <div class="kapunka-clamp">
                <div class="spa-packs__header">
                    <p class="text-uppercase letter-spacing"><?php esc_html_e( 'Packs para Spas & Hoteles', 'understrap' ); ?></p>
                    <h2 id="spa-packs-heading"><?php esc_html_e( 'Elija el formato que activa ventas inmediatas.', 'understrap' ); ?></h2>
                </div>
                <div class="spa-packs__grid">
                    <article class="spa-pack-card">
                        <?php if ( $spa_pack['title'] ) : ?>
                            <h3><?php echo esc_html( $spa_pack['title'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( ! empty( $spa_pack['ref'] ) ) : ?>
                            <p class="spa-pack-card__meta"><?php echo esc_html( $spa_pack['ref'] ); ?></p>
                        <?php endif; ?>
                        <?php if ( ! empty( $spa_pack['bullets_list'] ) ) : ?>
                            <ul class="spa-pack-card__bullets">
                                <?php foreach ( $spa_pack['bullets_list'] as $item ) : ?>
                                    <li><?php echo esc_html( $item ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <a class="kapunka-button spa-pack-card__cta js-scroll-to" href="#spa-pack-form">
                            <?php esc_html_e( 'Solicitar cotización', 'understrap' ); ?>
                        </a>
                    </article>

                    <article class="spa-pack-card">
                        <?php if ( $hotel_pack['title'] ) : ?>
                            <h3><?php echo esc_html( $hotel_pack['title'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( ! empty( $hotel_pack['bullets_list'] ) ) : ?>
                            <ul class="spa-pack-card__bullets">
                                <?php foreach ( $hotel_pack['bullets_list'] as $item ) : ?>
                                    <li><?php echo esc_html( $item ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <a class="kapunka-button spa-pack-card__cta js-scroll-to" href="#spa-pack-form">
                            <?php esc_html_e( 'Solicitar cotización', 'understrap' ); ?>
                        </a>
                    </article>
                </div>

                <?php if ( ! empty( $cost_example['lines'] ) ) : ?>
                    <div class="spa-cost-table">
                        <?php if ( $cost_example['title'] ) : ?>
                            <p class="spa-cost-table__eyebrow text-uppercase letter-spacing"><?php echo esc_html( $cost_example['title'] ); ?></p>
                        <?php endif; ?>
                        <div class="spa-cost-table__body">
                            <?php foreach ( $cost_example['lines'] as $line ) : ?>
                                <div class="spa-cost-table__row">
                                    <span><?php echo esc_html( $line ); ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
    
    <?php if ( $has_training_section ) : ?>
        <section class="spa-training" id="kapunka-training">
            <div class="kapunka-clamp">
                <div class="spa-training__inner">
                    <div class="spa-training__body">
                        <?php if ( '' !== trim( (string) $training['title'] ) ) : ?>
                            <h2 class="spa-training__title"><?php echo esc_html( $training['title'] ); ?></h2>
                        <?php endif; ?>
                        <?php if ( ! empty( $training['modules_list'] ) ) : ?>
                            <ul class="spa-training__modules">
                                <?php foreach ( $training['modules_list'] as $module_line ) : ?>
                                    <li>
                                        <span class="spa-training__icon" aria-hidden="true"></span>
                                        <span><?php echo esc_html( $module_line ); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if ( '' !== trim( (string) $training['duration'] ) ) : ?>
                            <p class="spa-training__duration"><?php echo esc_html( $training['duration'] ); ?></p>
                        <?php endif; ?>
                        <p class="spa-training__note"><?php esc_html_e( "Al completar la evaluación, el centro obtiene el sello 'Centro Kapunka Pro'.", 'understrap' ); ?></p>
                        <?php if ( '' !== trim( (string) $training['cta_text'] ) && '' !== trim( (string) $training['cta_url'] ) ) : ?>
                            <a class="kapunka-button spa-training__cta" href="<?php echo esc_url( $training['cta_url'] ); ?>">
                                <?php echo esc_html( $training['cta_text'] ); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="spa-training__seal">
                        <?php if ( $training_seal_url ) : ?>
                            <img src="<?php echo esc_url( $training_seal_url ); ?>" alt="<?php esc_attr_e( 'Sello Kapunka Pro', 'understrap' ); ?>" loading="lazy" decoding="async" />
                        <?php else : ?>
                            <div class="spa-training__seal-placeholder">
                                <span><?php esc_html_e( 'Kapunka Pro', 'understrap' ); ?></span>
                            </div>
                        <?php endif; ?>
                        <span class="spa-training__seal-caption"><?php esc_html_e( 'Sello Kapunka Pro', 'understrap' ); ?></span>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_amenity_section ) : ?>
        <section class="spa-amenity" id="amenity-to-retail">
            <div class="kapunka-clamp">
                <div class="spa-amenity__header">
                    <p class="text-uppercase letter-spacing"><?php esc_html_e( 'Amenity-to-Retail', 'understrap' ); ?></p>
                    <h2><?php esc_html_e( 'Del detalle en la suite a la venta en boutique.', 'understrap' ); ?></h2>
                    <p><?php esc_html_e( 'Flujo con QR y códigos únicos para trackear cada huésped.', 'understrap' ); ?></p>
                </div>
                <div class="spa-amenity__grid">
                    <?php if ( ! empty( $amenity_steps ) ) : ?>
                        <div class="spa-amenity__steps">
                            <h3><?php esc_html_e( 'Flujo operativo', 'understrap' ); ?></h3>
                            <ol>
                                <?php foreach ( $amenity_steps as $step ) : ?>
                                    <li><?php echo esc_html( $step ); ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $amenity_kpis ) ) : ?>
                        <div class="spa-amenity__kpis">
                            <h3><?php esc_html_e( 'KPIs recomendados', 'understrap' ); ?></h3>
                            <ul>
                                <?php foreach ( $amenity_kpis as $kpi ) : ?>
                                    <li><?php echo esc_html( $kpi ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ( '' !== trim( (string) $amenity_example ) ) : ?>
                    <div class="spa-amenity__example">
                        <p><?php echo esc_html( $amenity_example ); ?></p>
                    </div>
                <?php endif; ?>
                <a class="kapunka-button spa-amenity__cta js-scroll-to" href="#spa-pack-form">
                    <?php esc_html_e( 'Solicitar landing y seguimiento', 'understrap' ); ?>
                </a>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_cert_section ) : ?>
        <section class="spa-certifications" id="logistica-certificaciones">
            <div class="kapunka-clamp">
                <div class="spa-certifications__header">
                    <p class="text-uppercase letter-spacing"><?php esc_html_e( 'Logística y Certificaciones', 'understrap' ); ?></p>
                    <h2><?php esc_html_e( 'Listos para auditorías clínicas y aperturas express.', 'understrap' ); ?></h2>
                </div>
                <div class="spa-certifications__grid">
                    <?php if ( ! empty( $cert_bullets ) ) : ?>
                        <article class="spa-cert-card">
                            <div class="spa-cert-card__icon" aria-hidden="true">✓</div>
                            <h3><?php esc_html_e( 'Certificaciones', 'understrap' ); ?></h3>
                            <ul>
                                <?php foreach ( $cert_bullets as $bullet ) : ?>
                                    <li><?php echo esc_html( $bullet ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endif; ?>
                    <?php if ( ! empty( $logistics_list ) ) : ?>
                        <article class="spa-cert-card">
                            <div class="spa-cert-card__icon" aria-hidden="true">↺</div>
                            <h3><?php esc_html_e( 'Logística', 'understrap' ); ?></h3>
                            <ul>
                                <?php foreach ( $logistics_list as $bullet ) : ?>
                                    <li><?php echo esc_html( $bullet ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endif; ?>
                    <?php if ( ! empty( $commercial_list ) ) : ?>
                        <article class="spa-cert-card">
                            <div class="spa-cert-card__icon" aria-hidden="true">€</div>
                            <h3><?php esc_html_e( 'Condiciones comerciales', 'understrap' ); ?></h3>
                            <ul>
                                <?php foreach ( $commercial_list as $bullet ) : ?>
                                    <li><?php echo esc_html( $bullet ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </article>
                    <?php endif; ?>
                </div>
                <a class="kapunka-button spa-certifications__cta js-scroll-to" href="#spa-pack-form">
                    <?php esc_html_e( 'Solicitar ficha técnica y condiciones', 'understrap' ); ?>
                </a>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_portal_block ) : ?>
        <section class="spa-portal-block" id="kapunka-portal">
            <div class="kapunka-clamp">
                <div class="spa-portal-block__inner">
                    <div class="spa-portal-block__icon" aria-hidden="true">🔐</div>
                    <div class="spa-portal-block__content">
                        <?php if ( $portal_block['title'] ) : ?>
                            <h2><?php echo esc_html( $portal_block['title'] ); ?></h2>
                        <?php endif; ?>
                        <?php if ( $portal_block['text'] ) : ?>
                            <p><?php echo esc_html( $portal_block['text'] ); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php if ( $portal_block['cta'] && $portal_block['url'] ) : ?>
                        <a class="kapunka-button spa-portal-block__cta" href="<?php echo esc_url( $portal_block['url'] ); ?>">
                            <?php echo esc_html( $portal_block['cta'] ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_kpi_block ) : ?>
        <section class="spa-kpis" id="kpis-piloto">
            <div class="kapunka-clamp">
                <?php if ( $kpi_block['title'] ) : ?>
                    <h2 class="spa-kpis__title"><?php echo esc_html( $kpi_block['title'] ); ?></h2>
                <?php endif; ?>
                <div class="spa-kpis__grid">
                    <?php if ( ! empty( $kpi_block['list'] ) ) : ?>
                        <div class="spa-kpis__card">
                            <h3><?php esc_html_e( 'Indicadores clave', 'understrap' ); ?></h3>
                            <ul>
                                <?php foreach ( $kpi_block['list'] as $item ) : ?>
                                    <li><?php echo esc_html( $item ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $kpi_block['objectives'] ) ) : ?>
                        <div class="spa-kpis__card">
                            <h3><?php esc_html_e( 'Objetivos sugeridos', 'understrap' ); ?></h3>
                            <ul>
                                <?php foreach ( $kpi_block['objectives'] as $item ) : ?>
                                    <li><?php echo esc_html( $item ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ( ! empty( $kpi_block['formula'] ) ) : ?>
                    <div class="spa-kpis__formula">
                        <h4><?php esc_html_e( 'Fórmulas / ejemplo', 'understrap' ); ?></h4>
                        <pre>
<?php echo esc_html( implode( PHP_EOL, $kpi_block['formula'] ) ); ?>
                        </pre>
                        <p class="spa-kpis__note"><?php esc_html_e( 'Valores de ejemplo; ajustar según su política de precios.', 'understrap' ); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_download_section ) : ?>
        <section class="spa-downloads" id="kapunka-recursos">
            <div class="kapunka-clamp">
                <div class="spa-downloads__header">
                    <p class="text-uppercase letter-spacing"><?php esc_html_e( 'Recursos descargables', 'understrap' ); ?></p>
                    <h2><?php esc_html_e( 'Brochures, fichas y kits para sus equipos.', 'understrap' ); ?></h2>
                    <p class="spa-downloads__message"><?php echo esc_html( $download_gate_message ); ?></p>
                </div>
                <div class="spa-downloads__grid">
                    <?php foreach ( $download_resources as $resource ) : ?>
                        <article class="spa-download-card<?php echo $resource['file_url'] ? '' : ' is-disabled'; ?>">
                            <div class="spa-download-card__icon" aria-hidden="true">
                                <span><?php echo esc_html( strtoupper( $resource['type'] ) ); ?></span>
                            </div>
                            <div class="spa-download-card__body">
                                <h3><?php echo esc_html( $resource['label'] ); ?></h3>
                                <p><?php echo esc_html( $resource['filename'] ); ?></p>
                            </div>
                            <?php if ( $resource['file_url'] ) : ?>
                                <button
                                    type="button"
                                    class="spa-download-card__cta"
                                    data-download-open
                                    data-resource="<?php echo esc_attr( $resource['key'] ); ?>"
                                    data-resource-label="<?php echo esc_attr( $resource['label'] ); ?>"
                                >
                                    <?php esc_html_e( 'Descargar', 'understrap' ); ?>
                                </button>
                            <?php else : ?>
                                <span class="spa-download-card__cta is-disabled"><?php esc_html_e( 'Próximamente', 'understrap' ); ?></span>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_download_section ) : ?>
        <div class="spa-download-modal" data-download-modal aria-hidden="true" role="dialog" aria-modal="true">
            <div class="spa-download-modal__scrim" data-download-close></div>
            <div class="spa-download-modal__dialog" role="document" tabindex="-1">
                <button type="button" class="spa-download-modal__close" aria-label="<?php esc_attr_e( 'Cerrar formulario', 'understrap' ); ?>" data-download-close>&times;</button>
                <div class="spa-download-modal__body">
                    <p class="spa-download-modal__eyebrow text-uppercase letter-spacing"><?php esc_html_e( 'Descarga protegida', 'understrap' ); ?></p>
                    <h3 class="spa-download-modal__title" data-download-resource-label><?php esc_html_e( 'Recurso Kapunka', 'understrap' ); ?></h3>
                    <p class="spa-download-modal__message"><?php echo esc_html( $download_gate_message ); ?></p>
                    <form class="spa-download-form" data-download-form novalidate>
                        <input type="hidden" name="resource_key" value="">
                        <input type="hidden" name="page_id" value="<?php echo esc_attr( get_the_ID() ); ?>">
                        <div class="spa-download-form__field">
                            <label for="download-nombre"><?php esc_html_e( 'Nombre completo', 'understrap' ); ?></label>
                            <input type="text" id="download-nombre" name="nombre_completo" required placeholder="<?php esc_attr_e( 'Nombre completo*', 'understrap' ); ?>">
                        </div>
                        <div class="spa-download-form__field">
                            <label for="download-email"><?php esc_html_e( 'Email', 'understrap' ); ?></label>
                            <input type="email" id="download-email" name="email" required placeholder="<?php esc_attr_e( 'Email*', 'understrap' ); ?>">
                        </div>
                        <div class="spa-download-form__field">
                            <label for="download-hotel"><?php esc_html_e( 'Hotel / Spa', 'understrap' ); ?></label>
                            <input type="text" id="download-hotel" name="hotel" placeholder="<?php esc_attr_e( 'Hotel / Spa', 'understrap' ); ?>">
                        </div>
                        <div class="spa-download-form__actions">
                            <button type="submit" class="kapunka-button spa-download-form__submit"><?php esc_html_e( 'Enviar y recibir', 'understrap' ); ?></button>
                            <p class="spa-download-form__status" data-download-status aria-live="polite"></p>
                            <p class="spa-download-form__success" data-download-success aria-live="polite"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ( ! empty( $mini_cases ) ) : ?>
        <?php foreach ( $mini_cases as $case ) : ?>
            <div class="spa-case-modal" data-case-modal="<?php echo esc_attr( $case['id'] ); ?>" aria-hidden="true" role="dialog" aria-modal="true">
                <div class="spa-case-modal__scrim" data-case-close></div>
                <div class="spa-case-modal__dialog" role="document" tabindex="-1">
                    <button type="button" class="spa-case-modal__close" aria-label="<?php esc_attr_e( 'Cerrar mini caso', 'understrap' ); ?>" data-case-close>&times;</button>
                    <div class="spa-case-modal__body">
                        <?php if ( '' !== trim( (string) $case['title'] ) ) : ?>
                            <p class="spa-mini-case__eyebrow text-uppercase letter-spacing"><?php esc_html_e( 'Mini caso', 'understrap' ); ?></p>
                            <h3><?php echo esc_html( $case['title'] ); ?></h3>
                        <?php endif; ?>
                        <dl class="spa-mini-case__details">
                            <?php if ( '' !== trim( (string) $case['problem'] ) ) : ?>
                                <dt><?php esc_html_e( 'Problema', 'understrap' ); ?></dt>
                                <dd><?php echo esc_html( $case['problem'] ); ?></dd>
                            <?php endif; ?>
                            <?php if ( '' !== trim( (string) $case['solution'] ) ) : ?>
                                <dt><?php esc_html_e( 'Solución', 'understrap' ); ?></dt>
                                <dd><?php echo esc_html( $case['solution'] ); ?></dd>
                            <?php endif; ?>
                            <?php if ( '' !== trim( (string) $case['result'] ) ) : ?>
                                <dt><?php esc_html_e( 'Resultado', 'understrap' ); ?></dt>
                                <dd><?php echo esc_html( $case['result'] ); ?></dd>
                            <?php endif; ?>
                        </dl>
                        <p class="spa-case-modal__placeholder"><?php esc_html_e( 'Contenido extendido próximamente.', 'understrap' ); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>


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

    <?php if ( ! empty( $spa_value_text_grid ) ) : ?>
        <section class="spa-value-text-grid">
            <div class="kapunka-clamp">
                <div class="spa-value-text-grid__inner">
                    <?php foreach ( $spa_value_text_grid as $item ) :
                        $value_title = isset( $item['crb_spa_value_title'] ) ? trim( (string) $item['crb_spa_value_title'] ) : '';
                        $value_text  = isset( $item['crb_spa_value_text'] ) ? trim( (string) $item['crb_spa_value_text'] ) : '';

                        if ( '' === $value_title && '' === $value_text ) {
                            continue;
                        }
                        ?>
                        <article class="spa-value-text-grid__item">
                            <?php if ( '' !== $value_title ) : ?>
                                <h3><?php echo esc_html( $value_title ); ?></h3>
                            <?php endif; ?>
                            <?php if ( '' !== $value_text ) : ?>
                                <p><?php echo esc_html( $value_text ); ?></p>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( $has_faq_section ) : ?>
        <section class="kapunka-faq kapunka-faq--spas" id="spas-faq">
            <div class="kapunka-faq__layout">
                <div class="kapunka-faq__intro">
                    <h2><?php esc_html_e( 'Preguntas frecuentes', 'understrap' ); ?></h2>
                </div>
                <div class="kapunka-faq__list">
                    <?php foreach ( $faq_items as $item ) :
                        $question = isset( $item['kapunka_faq_q'] ) ? trim( (string) $item['kapunka_faq_q'] ) : '';
                        $answer   = isset( $item['kapunka_faq_a'] ) ? trim( (string) $item['kapunka_faq_a'] ) : '';

                        if ( '' === $question || '' === $answer ) {
                            continue;
                        }
                        ?>
                        <details class="kapunka-faq__item">
                            <summary>
                                <span><?php echo esc_html( $question ); ?></span>
                                <span class="kapunka-faq__icon" aria-hidden="true"></span>
                            </summary>
                            <div class="kapunka-faq__answer"><?php echo wp_kses_post( nl2br( esc_html( $answer ) ) ); ?></div>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="spa-cta" id="spa-pack-form">
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
                <a class="kapunka-button spa-cta__button" href="<?php echo esc_url( $cta['button']['url'] ); ?>">
                    <?php echo esc_html( $cta['button']['label'] ); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
