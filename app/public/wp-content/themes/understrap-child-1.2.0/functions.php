<?php
/**
 * Understrap child theme functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$kapunka_theme_dir = get_stylesheet_directory();
if ( file_exists( $kapunka_theme_dir . '/vendor/autoload.php' ) ) {
    require_once $kapunka_theme_dir . '/vendor/autoload.php';

    add_action(
        'after_setup_theme',
        static function() {
            if ( class_exists( '\Carbon_Fields\Carbon_Fields' ) ) {
                \Carbon_Fields\Carbon_Fields::boot();
            }
        },
        20
    );

    require_once $kapunka_theme_dir . '/inc/carbon-fields.php';
}

/**
 * Enqueue our styles and scripts
 */
function kapunka_enqueue_styles() {
    // Get the theme data
    $the_theme = wp_get_theme();
    $theme_version = $the_theme->get( 'Version' );

    // Styles
    wp_enqueue_style( 'understrap-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $theme_version );
    wp_enqueue_style( 'kapunka-base', get_stylesheet_directory_uri() . '/css/kapunka.css', array( 'understrap-styles' ), '1.1.0' );
    wp_enqueue_style( 'kapunka-components', get_stylesheet_directory_uri() . '/css/components.css', array( 'kapunka-base' ), '1.0.0' );
    wp_enqueue_style( 'kapunka-woocommerce', get_stylesheet_directory_uri() . '/css/woocommerce.css', array( 'kapunka-components' ), '1.0.0' );

    // Scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'kapunka-scripts', get_stylesheet_directory_uri() . '/js/kapunka.js', array( 'jquery' ), '1.1.0', true );
    wp_localize_script(
        'kapunka-scripts',
        'kapunkaAjax',
        array(
            'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
            'nonce'         => wp_create_nonce( 'kapunka_download_resource' ),
            'metodoNonce'   => wp_create_nonce( 'kapunka_metodo_training_request' ),
            'genericError'  => __( 'No se pudo enviar. Intente nuevamente.', 'understrap' ),
            'successCommon' => __( 'Gracias. Recibirás el enlace en tu correo.', 'understrap' ),
        )
    );
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'kapunka_enqueue_styles' );

/**
 * Setup theme
 */
function kapunka_setup_theme() {
    // Add support for WooCommerce
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

    add_image_size( 'kapunka-product-card', 700, 900, true );
    add_image_size( 'kapunka-article-card', 1200, 675, true );
}
add_action( 'after_setup_theme', 'kapunka_setup_theme' );

/**
 * Remove WooCommerce styles
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add custom walker for mega menu - Fixed to only add class to items with children
 */
function kapunka_nav_menu_css_class( $classes, $item, $args, $depth ) {
    if ( 'primary' === ( $args->theme_location ?? '' ) && 0 === $depth ) {
        // Keep Bootstrap helper class when item has children.
        if ( in_array( 'menu-item-has-children', $item->classes, true ) && ! in_array( 'menu-item-has-children', $classes, true ) ) {
            $classes[] = 'menu-item-has-children';
        }

        $identifier = kapunka_get_nav_item_identifier( $item );
        if ( $identifier ) {
            $classes[] = 'menu-item-slug-' . esc_attr( $identifier );
        }
    }

    return $classes;
}
add_filter( 'nav_menu_css_class', 'kapunka_nav_menu_css_class', 10, 4 );

/**
 * Add custom walker for mega menu - Improved submenu toggle removal
 */
function kapunka_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {
    if ( $args->theme_location == 'primary' && $depth == 0 ) {
        // Remove the default submenu toggle more reliably
        $item_output = preg_replace( '/<span class="submenu-toggle">.*?<\/span>/i', '', $item_output );
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'kapunka_walker_nav_menu_start_el', 10, 4 );

/**
 * Add data attribute to top-level links for mega menu targeting.
 */
function kapunka_nav_menu_link_attributes( $atts, $item, $args, $depth ) {
    if ( 'primary' === ( $args->theme_location ?? '' ) && 0 === $depth ) {
        if ( isset( $item->object, $item->object_id ) && 'page' === $item->object ) {
            $permalink = get_permalink( (int) $item->object_id );
            if ( $permalink ) {
                $atts['href'] = $permalink;
            }
        }

        $identifier = kapunka_get_nav_item_identifier( $item );
        if ( $identifier ) {
            $atts['data-mega-target'] = $identifier;
        }

        unset( $atts['data-toggle'], $atts['data-bs-toggle'], $atts['aria-haspopup'], $atts['aria-expanded'], $atts['id'] );
        if ( isset( $atts['class'] ) ) {
            $atts['class'] = trim( str_replace( 'dropdown-toggle', '', $atts['class'] ) );
        }
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'kapunka_nav_menu_link_attributes', 10, 4 );

/**
 * Ensure WooCommerce is loaded before using its functions
 */
function kapunka_woocommerce_functions() {
    // Only run if WooCommerce is active
    if ( ! class_exists( 'WooCommerce' ) ) {
        return;
    }
    
    // Add cart icon to menu
    function kapunka_add_cart_icon_to_menu() {
        // This is handled in the header template
    }
}
add_action( 'wp', 'kapunka_woocommerce_functions' );

/**
 * Add custom body class to help with styling
 */
function kapunka_body_classes( $classes ) {
    // Add a class to help identify the home page
    if ( is_front_page() || is_home() ) {
        $classes[] = 'kapunka-home';
    }
    return $classes;
}
add_filter( 'body_class', 'kapunka_body_classes' );

/**
 * Remove default margin from the html element to prevent gaps
 */
function kapunka_remove_html_margin() {
    echo '<style>html, body { margin-top: 0 !important; } </style>';
}
add_action( 'wp_head', 'kapunka_remove_html_margin' );

/**
 * Helper to render component template parts with arguments.
 *
 * @param string $slug
 * @param array  $args
 */
function kapunka_component( $slug, $args = array() ) {
    if ( empty( $slug ) ) {
        return;
    }

    get_template_part( 'template-parts/components/' . $slug, null, $args );
}

/**
 * Helper wrappers for Carbon Fields meta/options.
 */
function kapunka_get_meta( $key, $default = null, $post_id = 0 ) {
    if ( function_exists( 'carbon_get_post_meta' ) ) {
        $id    = $post_id ? $post_id : get_the_ID();
        $value = carbon_get_post_meta( $id, $key );
        return ( null === $value || '' === $value ) ? $default : $value;
    }

    return $default;
}

function kapunka_get_option( $key, $default = null ) {
    if ( function_exists( 'carbon_get_theme_option' ) ) {
        $value = carbon_get_theme_option( $key );
        return ( null === $value || '' === $value ) ? $default : $value;
    }

    return $default;
}

function kapunka_parse_association_ids( $items ) {
    $ids = array();

    if ( is_array( $items ) ) {
        foreach ( $items as $item ) {
            if ( isset( $item['id'] ) ) {
                $ids[] = (int) $item['id'];
            }
        }
    }

    return array_filter( $ids );
}

/**
 * Render a shortcode with graceful fallback when integration is missing.
 *
 * @param string          $shortcode Shortcode string.
 * @param callable|string $fallback  Callable returning markup or raw HTML string.
 *
 * @return string
 */
function kapunka_render_form_shortcode( $shortcode, $fallback ) {
    if ( empty( $shortcode ) ) {
        return is_callable( $fallback ) ? call_user_func( $fallback ) : (string) $fallback;
    }

    $rendered = do_shortcode( $shortcode );

    if ( false !== strpos( $rendered, 'wpcf7-contact-form-not-found' ) || '' === trim( wp_strip_all_tags( $rendered ) ) ) {
        return is_callable( $fallback ) ? call_user_func( $fallback ) : (string) $fallback;
    }

    return $rendered;
}

/**
 * Resolve a stable slug for a nav menu item (page slug when possible).
 *
 * @param WP_Post $item
 * @return string
 */
function kapunka_get_nav_item_identifier( $item ) {
    if ( isset( $item->object, $item->object_id ) && 'page' === $item->object ) {
        $slug = get_post_field( 'post_name', (int) $item->object_id );
        if ( $slug ) {
            return $slug;
        }
    }

    return sanitize_title( $item->title );
}

/**
 * Returns CTA entries keyed by menu slug.
 *
 * @return array
 */
function kapunka_get_mega_menu_ctas_index() {
    static $cache = null;

    if ( null !== $cache ) {
        return $cache;
    }

    $cache = array();
    $entries = function_exists( 'carbon_get_theme_option' ) ? carbon_get_theme_option( 'mega_menu_ctas' ) : array();

    if ( is_array( $entries ) ) {
        foreach ( $entries as $entry ) {
            $slug = isset( $entry['menu_slug'] ) ? sanitize_title( $entry['menu_slug'] ) : '';
            if ( ! $slug ) {
                continue;
            }

            if ( ! isset( $cache[ $slug ] ) ) {
                $cache[ $slug ] = array();
            }
            $cache[ $slug ][] = $entry;
        }
    }

    return $cache;
}

/**
 * Default Profesionales mega menu links (used when menu has no children).
 *
 * @return array
 */
function kapunka_get_profesionales_megamenu_columns() {
    $base = home_url( '/profesionales' );

    return array(
        array(
            'title' => __( 'Clínicas Estéticas', 'understrap' ),
            'url'   => trailingslashit( $base ) . 'clinicas',
            'links' => array(),
        ),
        array(
            'title' => __( 'Spas & Hoteles', 'understrap' ),
            'url'   => trailingslashit( $base ) . 'spas',
            'links' => array(),
        ),
        array(
            'title' => __( 'Método Kapunka', 'understrap' ),
            'url'   => trailingslashit( $base ) . 'metodo-kapunka',
            'links' => array(),
        ),
        array(
            'title' => __( 'Área Privada', 'understrap' ),
            'url'   => trailingslashit( $base ) . 'area-privada',
            'links' => array(),
        ),
    );
}

/**
 * Default Origen mega menu links (used when menu has no children).
 *
 * @return array
 */
function kapunka_get_origen_megamenu_columns() {
    return array(
        array(
            'title' => __( 'Origen', 'understrap' ),
            'url'   => home_url( '/el-origen/' ),
            'links' => array(),
        ),
        array(
            'title' => __( 'Impacto Social', 'understrap' ),
            'url'   => home_url( '/impacto-social/' ),
            'links' => array(),
        ),
    );
}

/**
 * Default CTA cards for Profesionales mega menu when theme options are empty.
 *
 * @return array
 */
function kapunka_get_profesionales_megamenu_ctas() {
    $base = home_url( '/profesionales' );

    return array(
        array(
            'title'     => __( 'Solicitar Demo', 'understrap' ),
            'label'     => __( 'Solicitar Demo', 'understrap' ),
            'url'       => trailingslashit( $base ) . 'clinicas#clinicas-form',
            'image_url' => get_theme_file_uri( 'images/mega-clinicas.svg' ),
        ),
        array(
            'title'     => __( 'Descargar dossier', 'understrap' ),
            'label'     => __( 'Descargar dossier', 'understrap' ),
            'url'       => get_theme_file_uri( 'content/kapunka-b2b-dossier.pdf' ),
            'image_url' => get_theme_file_uri( 'images/mega-dossier.svg' ),
        ),
    );
}

function kapunka_get_partner_resource_map() {
    return array(
        'brochure_spa' => array(
            'field'    => 'kapunka_brochure_spa',
            'label'    => __( 'Kapunka Spa Partnership Brochure', 'understrap' ),
            'filename' => __( 'Kapunka_Spa_Partnership_Brochure.pdf', 'understrap' ),
            'type'     => 'pdf',
        ),
        'playbook_hotel' => array(
            'field'    => 'kapunka_playbook_hotel',
            'label'    => __( 'Kapunka Hotel Amenity Playbook', 'understrap' ),
            'filename' => __( 'Kapunka_Hotel_Amenity_Playbook.pdf', 'understrap' ),
            'type'     => 'pdf',
        ),
        'ficha_pif' => array(
            'field'    => 'kapunka_ficha_pif',
            'label'    => __( 'Kapunka Ficha Técnica PIF / MSDS', 'understrap' ),
            'filename' => __( 'Kapunka_Ficha_Tecnica_PIF_MSDS.pdf', 'understrap' ),
            'type'     => 'pdf',
        ),
        'marketing_kit' => array(
            'field'    => 'kapunka_marketing_kit',
            'label'    => __( 'Kapunka Marketing Kit', 'understrap' ),
            'filename' => __( 'Kapunka_Marketing_Kit.zip', 'understrap' ),
            'type'     => 'zip',
        ),
    );
}

function kapunka_log_partner_asset_lead( $entry ) {
    $log = get_option( 'kapunka_partner_asset_downloads', array() );

    $log[] = array_merge(
        array(
            'timestamp' => current_time( 'mysql' ),
        ),
        $entry
    );

    update_option( 'kapunka_partner_asset_downloads', $log, false );
}

function kapunka_handle_download_resource() {
    check_ajax_referer( 'kapunka_download_resource', 'nonce' );

    $resource_key = sanitize_text_field( wp_unslash( $_POST['resource_key'] ?? '' ) );
    $page_id      = isset( $_POST['page_id'] ) ? absint( $_POST['page_id'] ) : 0;

    if ( ! $resource_key || ! $page_id ) {
        wp_send_json_error(
            array( 'message' => __( 'Solicitud inválida.', 'understrap' ) ),
            400
        );
    }

    $resources_map = kapunka_get_partner_resource_map();

    if ( ! isset( $resources_map[ $resource_key ] ) ) {
        wp_send_json_error(
            array( 'message' => __( 'Recurso no disponible.', 'understrap' ) ),
            404
        );
    }

    $resource_config = $resources_map[ $resource_key ];
    $attachment_id   = kapunka_get_meta( $resource_config['field'], 0, $page_id );
    $download_url    = $attachment_id ? wp_get_attachment_url( $attachment_id ) : '';

    if ( ! $download_url ) {
        wp_send_json_error(
            array( 'message' => __( 'Archivo no encontrado.', 'understrap' ) ),
            404
        );
    }

    $nombre   = sanitize_text_field( wp_unslash( $_POST['nombre_completo'] ?? '' ) );
    $email    = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $hotel    = sanitize_text_field( wp_unslash( $_POST['hotel'] ?? '' ) );

    if ( '' === $nombre || '' === $email ) {
        wp_send_json_error(
            array( 'message' => __( 'Complete los campos obligatorios.', 'understrap' ) ),
            400
        );
    }

    if ( ! is_email( $email ) ) {
        wp_send_json_error(
            array( 'message' => __( 'Email no válido.', 'understrap' ) ),
            400
        );
    }

    $download_url = add_query_arg(
        array(
            'utm_source'   => 'site',
            'utm_medium'   => 'partner_page',
            'utm_campaign' => 'spa_pilot',
        ),
        $download_url
    );

    kapunka_log_partner_asset_lead(
        array(
            'name'           => $nombre,
            'email'          => $email,
            'hotel'          => $hotel,
            'resource_key'   => $resource_key,
            'resource_label' => $resource_config['label'],
            'tag'            => 'Partner_Asset_Download',
        )
    );

    $recipient = kapunka_get_meta( 'kapunka_pilot_form_email_recipient', 'pro@kapunkargan.com', $page_id );
    $headers   = array( 'Content-Type: text/html; charset=UTF-8' );

    $admin_subject = sprintf(
        /* translators: %s resource label */
        __( '[Kapunka] Nueva descarga de recurso: %s', 'understrap' ),
        $resource_config['label']
    );

    $admin_message  = '<p>' . esc_html__( 'Nuevo lead de recurso:', 'understrap' ) . '</p>';
    $admin_message .= '<ul>';
    $admin_message .= '<li><strong>' . esc_html__( 'Nombre', 'understrap' ) . ':</strong> ' . esc_html( $nombre ) . '</li>';
    $admin_message .= '<li><strong>' . esc_html__( 'Email', 'understrap' ) . ':</strong> ' . esc_html( $email ) . '</li>';
    if ( $hotel ) {
        $admin_message .= '<li><strong>' . esc_html__( 'Hotel/Spa', 'understrap' ) . ':</strong> ' . esc_html( $hotel ) . '</li>';
    }
    $admin_message .= '<li><strong>' . esc_html__( 'Recurso', 'understrap' ) . ':</strong> ' . esc_html( $resource_config['label'] ) . '</li>';
    $admin_message .= '<li><strong>' . esc_html__( 'Tag', 'understrap' ) . ':</strong> Partner_Asset_Download</li>';
    $admin_message .= '</ul>';

    if ( $recipient ) {
        wp_mail( $recipient, $admin_subject, $admin_message, $headers );
    }

    $user_subject = __( 'Tu enlace de descarga Kapunka', 'understrap' );
    $user_message = '<p>' . esc_html__( 'Gracias por su interés en Kapunka. Aquí tiene su recurso:', 'understrap' ) . '</p>';
    $user_message .= '<p><a href="' . esc_url( $download_url ) . '">' . esc_html( $resource_config['label'] ) . '</a></p>';
    $user_message .= '<p>' . esc_html__( 'Si necesita apoyo adicional, responda a este correo.', 'understrap' ) . '</p>';

    wp_mail( $email, $user_subject, $user_message, $headers );

    wp_send_json_success(
        array(
            'message' => __( 'Gracias. Revise su email con el enlace de descarga.', 'understrap' ),
        )
    );
}

add_action( 'wp_ajax_kapunka_download_resource', 'kapunka_handle_download_resource' );
add_action( 'wp_ajax_nopriv_kapunka_download_resource', 'kapunka_handle_download_resource' );

/**
 * Handle Método Kapunka training request form submission.
 */
function kapunka_handle_metodo_training_request() {
    check_ajax_referer( 'kapunka_metodo_training_request', 'kapunka_metodo_nonce' );

    $page_id = isset( $_POST['page_id'] ) ? absint( $_POST['page_id'] ) : 0;

    if ( ! $page_id ) {
        wp_send_json_error(
            array( 'message' => __( 'Solicitud inválida.', 'understrap' ) ),
            400
        );
    }

    // Honeypot check
    $honeypot = sanitize_text_field( wp_unslash( $_POST['website'] ?? '' ) );
    if ( ! empty( $honeypot ) ) {
        wp_send_json_error(
            array( 'message' => __( 'Solicitud inválida.', 'understrap' ) ),
            400
        );
    }

    // Get and sanitize form fields
    $nombre_completo = sanitize_text_field( wp_unslash( $_POST['nombre_completo'] ?? '' ) );
    $clinica_centro = sanitize_text_field( wp_unslash( $_POST['clinica_centro'] ?? '' ) );
    $correo_profesional = sanitize_email( wp_unslash( $_POST['correo_profesional'] ?? '' ) );
    $telefono_whatsapp = sanitize_text_field( wp_unslash( $_POST['telefono_whatsapp'] ?? '' ) );
    $comentarios = sanitize_textarea_field( wp_unslash( $_POST['comentarios'] ?? '' ) );

    // Validation
    if ( empty( $nombre_completo ) ) {
        wp_send_json_error(
            array(
                'message' => __( 'El nombre completo es obligatorio.', 'understrap' ),
                'field'   => 'nombre_completo',
            ),
            400
        );
    }

    if ( empty( $clinica_centro ) ) {
        wp_send_json_error(
            array(
                'message' => __( 'La clínica o centro es obligatorio.', 'understrap' ),
                'field'   => 'clinica_centro',
            ),
            400
        );
    }

    if ( empty( $correo_profesional ) || ! is_email( $correo_profesional ) ) {
        wp_send_json_error(
            array(
                'message' => __( 'El correo profesional es obligatorio y debe ser válido.', 'understrap' ),
                'field'   => 'correo_profesional',
            ),
            400
        );
    }

    // Get form settings from Carbon Fields
    $email_recipient = kapunka_get_meta( 'kapunka_metodo_form_email_recipient', 'pro@kapunkargan.com', $page_id );
    $crm_tag        = kapunka_get_meta( 'kapunka_metodo_crm_tag', 'Training_Request', $page_id );

    // Log lead
    kapunka_log_partner_asset_lead(
        array(
            'name'           => $nombre_completo,
            'email'          => $correo_profesional,
            'clinic'         => $clinica_centro,
            'phone'          => $telefono_whatsapp,
            'comments'       => $comentarios,
            'tag'            => $crm_tag,
            'source'         => 'site',
            'page'           => 'metodo_kapunka',
            'page_url'       => get_permalink( $page_id ),
            'utm_source'     => sanitize_text_field( wp_unslash( $_GET['utm_source'] ?? '' ) ),
            'utm_medium'     => sanitize_text_field( wp_unslash( $_GET['utm_medium'] ?? '' ) ),
            'utm_campaign'   => sanitize_text_field( wp_unslash( $_GET['utm_campaign'] ?? '' ) ),
        )
    );

    // Send email to admin
    $headers   = array( 'Content-Type: text/html; charset=UTF-8' );
    $admin_subject = sprintf(
        __( 'Solicitud Método Kapunka — %s', 'understrap' ),
        $nombre_completo
    );

    $admin_message  = '<p>' . esc_html__( 'Nueva solicitud de formación:', 'understrap' ) . '</p>';
    $admin_message .= '<ul>';
    $admin_message .= '<li><strong>' . esc_html__( 'Nombre completo', 'understrap' ) . ':</strong> ' . esc_html( $nombre_completo ) . '</li>';
    $admin_message .= '<li><strong>' . esc_html__( 'Clínica / Centro', 'understrap' ) . ':</strong> ' . esc_html( $clinica_centro ) . '</li>';
    $admin_message .= '<li><strong>' . esc_html__( 'Correo profesional', 'understrap' ) . ':</strong> ' . esc_html( $correo_profesional ) . '</li>';
    if ( $telefono_whatsapp ) {
        $admin_message .= '<li><strong>' . esc_html__( 'Teléfono / WhatsApp', 'understrap' ) . ':</strong> ' . esc_html( $telefono_whatsapp ) . '</li>';
    }
    if ( $comentarios ) {
        $admin_message .= '<li><strong>' . esc_html__( 'Comentarios', 'understrap' ) . ':</strong> ' . esc_html( $comentarios ) . '</li>';
    }
    $admin_message .= '<li><strong>' . esc_html__( 'Tag CRM', 'understrap' ) . ':</strong> ' . esc_html( $crm_tag ) . '</li>';
    $admin_message .= '</ul>';

    if ( $email_recipient ) {
        wp_mail( $email_recipient, $admin_subject, $admin_message, $headers );
    }

    // Send confirmation email to user
    $user_subject = __( 'Solicitud recibida — Método Kapunka', 'understrap' );
    $user_message = '<p>' . esc_html__( 'Gracias por su interés en el Método Kapunka.', 'understrap' ) . '</p>';
    $user_message .= '<p>' . esc_html__( 'Hemos recibido su solicitud de información. Le contactaremos en 48 h hábiles.', 'understrap' ) . '</p>';
    $user_message .= '<p>' . esc_html__( 'Resumen de su solicitud:', 'understrap' ) . '</p>';
    $user_message .= '<ul>';
    $user_message .= '<li><strong>' . esc_html__( 'Nombre', 'understrap' ) . ':</strong> ' . esc_html( $nombre_completo ) . '</li>';
    $user_message .= '<li><strong>' . esc_html__( 'Clínica / Centro', 'understrap' ) . ':</strong> ' . esc_html( $clinica_centro ) . '</li>';
    $user_message .= '<li><strong>' . esc_html__( 'Correo', 'understrap' ) . ':</strong> ' . esc_html( $correo_profesional ) . '</li>';
    if ( $telefono_whatsapp ) {
        $user_message .= '<li><strong>' . esc_html__( 'Teléfono', 'understrap' ) . ':</strong> ' . esc_html( $telefono_whatsapp ) . '</li>';
    }
    if ( $comentarios ) {
        $user_message .= '<li><strong>' . esc_html__( 'Comentarios', 'understrap' ) . ':</strong> ' . esc_html( $comentarios ) . '</li>';
    }
    $user_message .= '</ul>';
    $user_message .= '<p>' . esc_html__( 'Atentamente,', 'understrap' ) . '<br>' . esc_html__( 'Equipo Kapunka', 'understrap' ) . '</p>';

    wp_mail( $correo_profesional, $user_subject, $user_message, $headers );

    wp_send_json_success(
        array(
            'message' => __( 'Gracias. Recibimos su solicitud. Le contactaremos en 48 h hábiles.', 'understrap' ),
        )
    );
}

add_action( 'wp_ajax_kapunka_metodo_training_request', 'kapunka_handle_metodo_training_request' );
add_action( 'wp_ajax_nopriv_kapunka_metodo_training_request', 'kapunka_handle_metodo_training_request' );

/**
 * Seed El Origen hero + carta content when the Carbon Fields are empty.
 */
function kapunka_seed_origen_fields() {
    if ( ! function_exists( 'carbon_get_post_meta' ) || ! function_exists( 'carbon_set_post_meta' ) ) {
        return;
    }

    $origen_page = get_page_by_path( 'el-origen' );

    if ( ! $origen_page instanceof WP_Post ) {
        $origen_page = get_page_by_path( 'origen' );
    }

    if ( ! $origen_page instanceof WP_Post ) {
        return;
    }

    $page_id = (int) $origen_page->ID;

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_hero_title' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_hero_title', 'De la tierra al tacto.' );
    }

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_hero_subtitle' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_hero_subtitle', 'La búsqueda de Mónica Ruiz por el argán más puro del mundo.' );
    }

    $letter_key      = 'crb_origen_founder_letter';
    $existing_letter = carbon_get_post_meta( $page_id, $letter_key );

    if ( empty( $existing_letter ) ) {
        $letter_content = <<<HTML
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

        carbon_set_post_meta( $page_id, $letter_key, $letter_content );
    }

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_mission_title' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_mission_title', 'Misión' );
    }

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_mission_text' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_mission_text', 'Proporcionar a cada persona el mejor cuidado para su piel, cabello y uñas a través de un producto totalmente natural, puro y seguro, que aporte salud, belleza y bienestar. Queremos que más gente descubra el poder auténtico del aceite de argán.' );
    }

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_vision_title' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_vision_title', 'Visión' );
    }

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_vision_text' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_vision_text', 'Hacer llegar Kapunka a cualquier lugar del mundo donde se valore un cuidado de la piel eficaz, sustentable y humano. Crecer manteniendo nuestra esencia artesanal y de confianza, y seguir innovando en cómo aplicamos las bondades del argán en la salud de las personas.' );
    }

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_impact_headline' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_impact_headline', 'Belleza que empodera.' );
    }

    if ( '' === (string) carbon_get_post_meta( $page_id, 'crb_origen_impact_body' ) ) {
        carbon_set_post_meta( $page_id, 'crb_origen_impact_body', 'Cada gota proviene de cooperativas de mujeres bereberes. Garantizamos salarios justos y desarrollo comunitario.' );
    }

    $impact_stats = carbon_get_post_meta( $page_id, 'crb_origen_impact_stats' );
    if ( empty( $impact_stats ) || ! is_array( $impact_stats ) ) {
        carbon_set_post_meta(
            $page_id,
            'crb_origen_impact_stats',
            array(
                array(
                    'stat_number' => '100%',
                    'stat_label'  => 'Trazabilidad',
                ),
                array(
                    'stat_number' => '35+',
                    'stat_label'  => 'Años de investigación',
                ),
                array(
                    'stat_number' => '0%',
                    'stat_label'  => 'Aditivos sintéticos',
                ),
            )
        );
    }

    $valores = carbon_get_post_meta( $page_id, 'crb_origen_valor_tiles' );
    if ( empty( $valores ) || ! is_array( $valores ) ) {
        carbon_set_post_meta(
            $page_id,
            'crb_origen_valor_tiles',
            array(
                array(
                    'headline'   => 'Confianza',
                    'body'       => 'Honestidad y calidad absoluta en todo lo que hacemos. Nos avalan pruebas científicas y la satisfacción de nuestros clientes. Cada frasco de Kapunka lleva consigo esa garantía.',
                    'background' => '',
                ),
                array(
                    'headline'   => 'Esfuerzo & Excelencia',
                    'body'       => 'No escatimamos en esfuerzos para lograr la máxima pureza y eficacia. Desde la cosecha manual hasta las pruebas de laboratorio, perseguimos la excelencia.',
                    'background' => '',
                ),
                array(
                    'headline'   => 'Compromiso',
                    'body'       => 'Con tu piel y tu salud, con nuestro equipo y colaboradores, y con el entorno. Cumplimos lo que prometemos y nos regimos por la ética.',
                    'background' => '',
                ),
                array(
                    'headline'   => 'Agradecimiento',
                    'body'       => 'El valor que dio origen a todo. Agradecemos la confianza de cada cliente retribuyéndola con calidad. Agradecemos a la naturaleza cuidándola (producción sostenible, envases reciclables).',
                    'background' => '',
                ),
            )
        );
    }
}
add_action( 'init', 'kapunka_seed_origen_fields', 25 );

/**
 * Register Contact Form 7 scripts only when shortcode detected.
 */
function kapunka_optimize_cf7_assets() {
    if ( ! function_exists( 'wpcf7_enqueue_scripts' ) ) {
        return;
    }

    if ( is_page_template( array( 'page-contacto.php', 'page-profesionales.php' ) ) ) {
        wpcf7_enqueue_scripts();
        wpcf7_enqueue_styles();
    }
}
add_action( 'wp', 'kapunka_optimize_cf7_assets' );
