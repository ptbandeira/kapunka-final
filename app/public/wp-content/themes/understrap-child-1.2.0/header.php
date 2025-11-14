<?php
/**
 * Header template for the Kapunka theme
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

 $container = get_theme_mod( 'understrap_container_type' );
 $kapunka_is_home_header = is_front_page() || is_home() || is_page_template( 'page-sobre-nosotros.php' ) || is_page_template( 'page-aceite.php' );

$kapunka_contact_url = home_url( '/contacto' );
$kapunka_account_url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : wp_login_url();
$kapunka_cart_url    = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : wp_login_url();
$kapunka_cart_total  = ( function_exists( 'WC' ) && null !== WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;

$kapunka_mega_panels = array();
$kapunka_mobile_nav   = array();

if ( has_nav_menu( 'primary' ) ) {
    $menu_locations = get_nav_menu_locations();
    $menu_id        = $menu_locations['primary'] ?? 0;

    if ( $menu_id ) {
        $menu_items = wp_get_nav_menu_items(
            $menu_id,
            array(
                'update_post_term_cache' => false,
            )
        );

        if ( $menu_items ) {
            $items_by_parent = array();
            foreach ( $menu_items as $menu_item ) {
                $parent_id = (int) $menu_item->menu_item_parent;
                if ( ! isset( $items_by_parent[ $parent_id ] ) ) {
                    $items_by_parent[ $parent_id ] = array();
                }
                $items_by_parent[ $parent_id ][] = $menu_item;
            }

            $cta_index = kapunka_get_mega_menu_ctas_index();
            $top_items = $items_by_parent[0] ?? array();

            foreach ( $top_items as $top_item ) {
                $slug = kapunka_get_nav_item_identifier( $top_item );

                if ( ! $slug ) {
                    continue;
                }

                $columns  = array();
                $children = $items_by_parent[ $top_item->ID ] ?? array();

                foreach ( $children as $child ) {
                    $columns[] = array(
                        'title' => $child->title,
                        'url'   => $child->url,
                        'links' => $items_by_parent[ $child->ID ] ?? array(),
                    );
                }

                $panel_data = array(
                    'slug'    => $slug,
                    'columns' => $columns,
                    'ctas'    => $cta_index[ $slug ] ?? array(),
                );

                if ( 'profesionales' === $slug ) {
                    if ( empty( $panel_data['columns'] ) ) {
                        $panel_data['columns'] = kapunka_get_profesionales_megamenu_columns();
                    }
                    if ( empty( $panel_data['ctas'] ) ) {
                        $panel_data['ctas'] = kapunka_get_profesionales_megamenu_ctas();
                    }
                }
                if ( in_array( $slug, array( 'el-origen', 'origen' ), true ) ) {
                    if ( empty( $panel_data['columns'] ) ) {
                        $panel_data['columns'] = kapunka_get_origen_megamenu_columns();
                    }
                }

                $has_panel = ! empty( $panel_data['columns'] );

                if ( $has_panel ) {
                    $kapunka_mega_panels[] = $panel_data;
                }

                $kapunka_mobile_nav[] = array(
                    'slug'    => $slug,
                    'title'   => $top_item->title,
                    'url'     => $top_item->url,
                    'columns' => $panel_data['columns'],
                    'ctas'    => $panel_data['ctas'],
                    'has_panel' => $has_panel,
                );
            }
        }
    }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <header id="wrapper-navbar" class="site-header<?php echo $kapunka_is_home_header ? '' : ' site-header--solid'; ?>">

        <nav id="main-nav" class="navbar navbar-expand-lg">

            <div class="container kapunka-nav-container">

                <!-- Text Logo -->
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    Kapunka
                </a>

                <button
                    class="kapunka-nav-toggle"
                    type="button"
                    aria-controls="kapunka-mobile-nav"
                    aria-expanded="false"
                    aria-label="<?php esc_attr_e( 'Alternar navegación', 'understrap' ); ?>"
                >
                    <span class="kapunka-nav-toggle__line"></span>
                    <span class="kapunka-nav-toggle__line"></span>
                    <span class="kapunka-nav-toggle__line"></span>
                </button>

                <!-- Centered Navigation Menu -->
                <div class="main-navigation" id="kapunka-nav-panel">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id'    => 'navbarNavDropdown',
                            'menu_class'      => 'navbar-nav',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-menu',
                            'depth'           => 2,
                            'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                    <div class="kapunka-secondary-nav" aria-label="Accesos rápidos">
                        <a class="kapunka-secondary-nav__account" href="<?php echo esc_url( $kapunka_account_url ); ?>">
                            <span class="sr-only"><?php echo is_user_logged_in() ? esc_html__( 'Mi cuenta', 'understrap' ) : esc_html__( 'Acceder', 'understrap' ); ?></span>
                            <span aria-hidden="true" class="kapunka-secondary-nav__icon">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4Z" stroke="currentColor" stroke-width="1.5"/>
                                    <path d="M5 20c0-3.31 3.13-6 7-6s7 2.69 7 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </span>
                        </a>
                        <a class="kapunka-secondary-nav__cart" href="<?php echo esc_url( $kapunka_cart_url ); ?>">
                            <span class="sr-only"><?php esc_html_e( 'Ver carrito', 'understrap' ); ?></span>
                            <span aria-hidden="true" class="kapunka-secondary-nav__icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 6h16l-2 9H8L6 6Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                                    <path d="M6 6 5 3H2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <circle cx="10" cy="20" r="1.2" fill="currentColor"/>
                                    <circle cx="18" cy="20" r="1.2" fill="currentColor"/>
                                </svg>
                            </span>
                            <span class="kapunka-secondary-nav__cart-count"><?php echo esc_html( number_format_i18n( $kapunka_cart_total ) ); ?></span>
                        </a>
                    </div>
                </div>

            </div><!-- .container-fluid -->

        </nav><!-- .site-navigation -->

        <?php if ( ! empty( $kapunka_mega_panels ) ) : ?>
            <div class="kapunka-mega" id="kapunka-mega">
                <?php foreach ( $kapunka_mega_panels as $panel ) : ?>
                    <div class="kapunka-mega__panel" data-mega-panel="<?php echo esc_attr( $panel['slug'] ); ?>">
                        <?php
                        $has_link_columns = false;
                        foreach ( $panel['columns'] as $column ) {
                            if ( ! empty( $column['links'] ) ) {
                                $has_link_columns = true;
                                break;
                            }
                        }
                        ?>
                        <div class="kapunka-mega__grid<?php echo $has_link_columns ? ' kapunka-mega__grid--links' : ''; ?>">
                            <?php if ( ! empty( $panel['columns'] ) ) : ?>
                                <div class="kapunka-mega__sections">
                                    <?php foreach ( $panel['columns'] as $column ) : ?>
                                        <a class="mega-menu-section" href="<?php echo esc_url( $column['url'] ); ?>">
                                            <?php echo esc_html( $column['title'] ); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>

                                <?php if ( $has_link_columns ) : ?>
                                    <div class="kapunka-mega__links">
                                        <?php foreach ( $panel['columns'] as $column ) : ?>
                                            <?php if ( empty( $column['links'] ) ) {
                                                continue;
                                            } ?>
                                            <div class="mega-menu-column">
                                                <p class="mega-menu-column__heading"><?php echo esc_html( $column['title'] ); ?></p>
                                                <ul>
                                                    <?php foreach ( $column['links'] as $link ) : ?>
                                                        <li><a href="<?php echo esc_url( $link->url ); ?>"><?php echo esc_html( $link->title ); ?></a></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if ( ! empty( $panel['ctas'] ) ) : ?>
                                <div class="kapunka-mega__ctas">
                                    <?php foreach ( $panel['ctas'] as $cta ) : ?>
                                        <?php
                                        $link_text = $cta['label'] ?? $cta['title'] ?? '';
                                        $image_id  = isset( $cta['image'] ) ? (int) $cta['image'] : 0;
                                        $image_url = $cta['image_url'] ?? '';
                                        ?>
                                        <article class="mega-menu-cta">
                                            <?php if ( $image_id ) : ?>
                                                <div class="mega-menu-cta__media">
                                                    <?php echo wp_get_attachment_image( $image_id, 'large', false, array( 'loading' => 'lazy' ) ); ?>
                                                </div>
                                            <?php elseif ( $image_url ) : ?>
                                                <div class="mega-menu-cta__media">
                                                    <img src="<?php echo esc_url( $image_url ); ?>" alt="" loading="lazy" decoding="async" />
                                                </div>
                                            <?php endif; ?>
                                            <?php if ( $link_text && ! empty( $cta['url'] ) ) : ?>
                                                <a class="mega-menu-cta__link" href="<?php echo esc_url( $cta['url'] ); ?>">
                                                    <?php echo esc_html( $link_text ); ?>
                                                </a>
                                            <?php endif; ?>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </header><!-- #wrapper-navbar -->

    <?php if ( ! empty( $kapunka_mobile_nav ) ) : ?>
        <div class="kapunka-mobile-nav" id="kapunka-mobile-nav" aria-hidden="true">
            <div class="kapunka-mobile-nav__scrim" data-mobile-nav-close></div>
            <div class="kapunka-mobile-nav__sheet" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Navegación', 'understrap' ); ?>">
                <div class="kapunka-mobile-nav__stack">
                    <?php foreach ( $kapunka_mobile_nav as $mobile_item ) : ?>
                        <?php if ( ! empty( $mobile_item['has_panel'] ) ) : ?>
                            <button
                                class="kapunka-mobile-nav__item"
                                type="button"
                                data-mobile-target="<?php echo esc_attr( $mobile_item['slug'] ); ?>"
                            >
                                <?php echo esc_html( $mobile_item['title'] ); ?>
                            </button>
                        <?php else : ?>
                            <a class="kapunka-mobile-nav__item" href="<?php echo esc_url( $mobile_item['url'] ); ?>">
                                <?php echo esc_html( $mobile_item['title'] ); ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <a class="kapunka-mobile-nav__item kapunka-mobile-nav__item--login" href="<?php echo esc_url( $kapunka_account_url ); ?>">
                        <?php echo is_user_logged_in() ? esc_html__( 'Cuenta', 'understrap' ) : esc_html__( 'Cuenta / Acceder', 'understrap' ); ?>
                    </a>
                </div>

                <?php foreach ( $kapunka_mobile_nav as $mobile_item ) : ?>
                    <?php if ( empty( $mobile_item['has_panel'] ) ) : ?>
                        <?php continue; ?>
                    <?php endif; ?>
                    <div class="kapunka-mobile-panel" data-mobile-panel="<?php echo esc_attr( $mobile_item['slug'] ); ?>" aria-hidden="true">
                        <div class="kapunka-mobile-panel__header">
                            <button class="kapunka-mobile-panel__back" type="button" data-mobile-panel-back>
                                <?php esc_html_e( 'Volver', 'understrap' ); ?>
                            </button>
                            <a class="kapunka-mobile-panel__title" href="<?php echo esc_url( $mobile_item['url'] ); ?>">
                                <?php echo esc_html( $mobile_item['title'] ); ?>
                            </a>
                        </div>
                        <div class="kapunka-mobile-panel__content">
                            <?php if ( ! empty( $mobile_item['columns'] ) ) : ?>
                                <?php foreach ( $mobile_item['columns'] as $column ) : ?>
                                    <div class="kapunka-mobile-panel__section">
                                        <a class="kapunka-mobile-panel__section-title" href="<?php echo esc_url( $column['url'] ); ?>">
                                            <?php echo esc_html( $column['title'] ); ?>
                                        </a>
                                        <?php if ( ! empty( $column['links'] ) ) : ?>
                                            <ul>
                                                <?php foreach ( $column['links'] as $link ) : ?>
                                                    <li>
                                                        <a href="<?php echo esc_url( $link->url ); ?>">
                                                            <?php echo esc_html( $link->title ); ?>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if ( ! empty( $mobile_item['ctas'] ) ) : ?>
                                <div class="kapunka-mobile-panel__ctas">
                                    <?php foreach ( $mobile_item['ctas'] as $cta ) : ?>
                                        <?php
                                        $link_text = $cta['label'] ?? $cta['title'] ?? '';
                                        $image_id  = isset( $cta['image'] ) ? (int) $cta['image'] : 0;
                                        $image_url = $cta['image_url'] ?? '';
                                        ?>
                                        <a class="kapunka-mobile-panel__cta" href="<?php echo esc_url( $cta['url'] ?? '#' ); ?>">
                                            <?php if ( $image_id ) : ?>
                                                <div class="kapunka-mobile-panel__cta-media">
                                                    <?php echo wp_get_attachment_image( $image_id, 'medium_large', false, array( 'loading' => 'lazy' ) ); ?>
                                                </div>
                                            <?php elseif ( $image_url ) : ?>
                                                <div class="kapunka-mobile-panel__cta-media">
                                                    <img src="<?php echo esc_url( $image_url ); ?>" alt="" loading="lazy" decoding="async" />
                                                </div>
                                            <?php endif; ?>
                                            <?php if ( $link_text ) : ?>
                                                <span><?php echo esc_html( $link_text ); ?></span>
                                            <?php endif; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
