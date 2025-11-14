<?php
/**
 * Import structured content into Carbon Fields.
 *
 * Usage:
 *   php scripts/import-carbon-fields.php
 *
 * Adjust the PHP binary path if needed (for Local, use the bundled php).
 */

declare(strict_types=1);

$theme_dir = dirname(__DIR__); // theme directory
$root = dirname(__DIR__, 4); // /app/public

if ( ! defined( 'ABSPATH' ) ) {
    require_once $root . '/wp-load.php';
}

$GLOBALS['kapunka_import_messages'] = $GLOBALS['kapunka_import_messages'] ?? array();

if ( ! function_exists( 'kapunka_import_log' ) ) {
    function kapunka_import_log( string $message ): void {
        $GLOBALS['kapunka_import_messages'][] = $message;

        if ( defined( 'STDERR' ) ) {
            fwrite( STDERR, $message . PHP_EOL );
        } else {
            error_log( $message );
        }
    }
}

if ( ! class_exists( '\Carbon_Fields\Carbon_Fields' ) ) {
    throw new RuntimeException( 'Carbon Fields is not available. Did you run composer install?' );
}

\Carbon_Fields\Carbon_Fields::boot();

require_once ABSPATH . 'wp-admin/includes/post.php';
require_once ABSPATH . 'wp-admin/includes/taxonomy.php';

$json_file = $theme_dir . '/content/carbon-fields-skeleton.json';

if ( ! file_exists( $json_file ) ) {
    throw new RuntimeException( "JSON file not found at {$json_file}" );
}

$payload = json_decode( file_get_contents( $json_file ), true );

if ( ! $payload ) {
    throw new RuntimeException( 'Invalid JSON structure.' );
}

/**
 * Ensure a page exists and return its ID.
 *
 * @param string $slug
 * @param string $title
 * @param string|null $template
 * @return int
 */
function kapunka_ensure_page( string $slug, string $title, ?string $template = null ): int {
    $existing = get_page_by_path( $slug, OBJECT, 'page' );

    if ( $existing ) {
        $page_id = (int) $existing->ID;
    } else {
        $page_id = wp_insert_post(
            array(
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_type'    => 'page',
                'post_status'  => 'publish',
                'post_content' => '',
            )
        );
    }

    if ( ! $page_id || is_wp_error( $page_id ) ) {
        throw new RuntimeException( "Unable to ensure page {$slug}" );
    }

    if ( $template ) {
        update_post_meta( $page_id, '_wp_page_template', $template );
    }

    return $page_id;
}

/**
 * Ensure a standard post exists and return its ID.
 *
 * @param string $slug
 * @param string $title
 * @return int
 */
function kapunka_ensure_post( string $slug, string $title ): int {
    $existing = get_page_by_path( $slug, OBJECT, 'post' );

    if ( $existing ) {
        $post_id = (int) $existing->ID;
    } else {
        $post_id = wp_insert_post(
            array(
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_type'    => 'post',
                'post_status'  => 'publish',
                'post_content' => '',
            )
        );
    }

    if ( ! $post_id || is_wp_error( $post_id ) ) {
        throw new RuntimeException( "Unable to ensure post {$slug}" );
    }

    return $post_id;
}

/**
 * Ensure a WooCommerce product exists and return its ID.
 *
 * @param string $slug
 * @param string $title
 * @return int
 */
function kapunka_ensure_product( string $slug, string $title ): int {
    $existing = get_page_by_path( $slug, OBJECT, 'product' );

    if ( $existing ) {
        $product_id = (int) $existing->ID;
    } else {
        $product_id = wp_insert_post(
            array(
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_type'    => 'product',
                'post_status'  => 'publish',
                'post_content' => '',
            )
        );

        if ( ! is_wp_error( $product_id ) ) {
            wp_set_object_terms( $product_id, 'simple', 'product_type' );
            update_post_meta( $product_id, '_price', '' );
            update_post_meta( $product_id, '_regular_price', '' );
        }
    }

    if ( ! $product_id || is_wp_error( $product_id ) ) {
        throw new RuntimeException( "Unable to ensure product {$slug}" );
    }

    return $product_id;
}

// Theme options.
if ( isset( $payload['theme_options'] ) ) {
    foreach ( $payload['theme_options'] as $key => $value ) {
        carbon_set_theme_option( $key, $value );
        kapunka_import_log( "Theme option '{$key}' updated." );
    }
}

// Pages.
$page_templates = array(
    'tienda'         => 'page-tienda.php',
    'profesionales'  => 'page-profesionales.php',
    'sobre-nosotros' => 'page-sobre-nosotros.php',
    'contacto'       => 'page-contacto.php',
);

if ( isset( $payload['pages'] ) && is_array( $payload['pages'] ) ) {
    foreach ( $payload['pages'] as $slug => $config ) {
        $title = $config['title'] ?? ucfirst( $slug );
        $meta  = $config['meta'] ?? array();

        $template = $page_templates[ $slug ] ?? null;
        $page_id  = kapunka_ensure_page( $slug, $title, $template );

        foreach ( $meta as $meta_key => $meta_value ) {
            carbon_set_post_meta( $page_id, $meta_key, $meta_value );
        }

        kapunka_import_log( "Page '{$title}' (#{$page_id}) updated." );
    }
}

// Posts.
if ( isset( $payload['posts'] ) && is_array( $payload['posts'] ) ) {
    foreach ( $payload['posts'] as $post_config ) {
        $title = $post_config['post_title'] ?? '';
        $slug  = $post_config['post_slug'] ?? '';

        if ( empty( $title ) || empty( $slug ) ) {
            continue;
        }

        $post_id = kapunka_ensure_post( $slug, $title );

        if ( ! empty( $post_config['meta'] ) ) {
            foreach ( $post_config['meta'] as $meta_key => $meta_value ) {
                carbon_set_post_meta( $post_id, $meta_key, $meta_value );
            }
        }

        kapunka_import_log( "Post '{$title}' (#{$post_id}) updated." );
    }
}

// Products.
if ( isset( $payload['products'] ) && is_array( $payload['products'] ) ) {
    foreach ( $payload['products'] as $product_config ) {
        $title = $product_config['post_title'] ?? '';
        $slug  = $product_config['post_slug'] ?? '';

        if ( empty( $title ) || empty( $slug ) ) {
            continue;
        }

        $product_id = kapunka_ensure_product( $slug, $title );

        if ( ! empty( $product_config['meta'] ) ) {
            foreach ( $product_config['meta'] as $meta_key => $meta_value ) {
                carbon_set_post_meta( $product_id, $meta_key, $meta_value );
            }
        }

        kapunka_import_log( "Product '{$title}' (#{$product_id}) updated." );
    }
}

kapunka_import_log( 'Import completed successfully.' );

return $GLOBALS['kapunka_import_messages'];
