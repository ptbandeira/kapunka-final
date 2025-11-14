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
