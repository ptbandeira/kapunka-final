<?php
/**
 * Template Name: Kapunka Tienda
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$components = kapunka_get_meta( 'tienda_componentes', array() );
$tienda_url  = get_permalink();

$hero = array(
    'eyebrow'     => kapunka_get_meta( 'tienda_hero_eyebrow', '' ),
    'title'       => kapunka_get_meta( 'tienda_hero_title', __( 'La Colección Kapunka', 'understrap' ) ),
    'description' => kapunka_get_meta( 'tienda_hero_description', __( 'Una selección curada que fusiona nuestro aceite 100% BIO con el rigor clínico y un origen consciente. Encuentre su ritual esencial.', 'understrap' ) ),
    'primary'     => array(
        'label' => kapunka_get_meta( 'tienda_hero_primary_label', '' ),
        'url'   => kapunka_get_meta( 'tienda_hero_primary_url', '' ),
    ),
    'secondary'   => array(
        'label' => kapunka_get_meta( 'tienda_hero_secondary_label', '' ),
        'url'   => kapunka_get_meta( 'tienda_hero_secondary_url', '' ),
    ),
);

$tienda_trinity_items = kapunka_get_meta( 'crb_tienda_trinity', array() );
if ( empty( $tienda_trinity_items ) || ! is_array( $tienda_trinity_items ) ) {
    $tienda_trinity_items = array(
        array(
            'crb_tienda_trinity_headline' => __( 'PURAMENTE ÉTICO', 'understrap' ),
            'crb_tienda_trinity_body'     => __( 'Primera prensada en frío de cooperativas femeninas certificadas.', 'understrap' ),
        ),
        array(
            'crb_tienda_trinity_headline' => __( 'CLÍNICAMENTE EFICAZ', 'understrap' ),
            'crb_tienda_trinity_body'     => __( '100% pureza validada. Rico en Vitamina E y ácidos grasos esenciales.', 'understrap' ),
        ),
        array(
            'crb_tienda_trinity_headline' => __( 'EL RITUAL EXPERTO', 'understrap' ),
            'crb_tienda_trinity_body'     => __( 'Protocolos de aplicación propios que maximizan la absorción.', 'understrap' ),
        ),
    );
}

$tienda_banner_id        = (int) kapunka_get_meta( 'tienda_banner_image', 0 );
$tienda_banner_url       = $tienda_banner_id ? wp_get_attachment_image_url( $tienda_banner_id, 'full' ) : '';
$tienda_visual_banner_id = (int) kapunka_get_meta( 'crb_tienda_visual_banner', 0 );

$tienda_filters_enabled = kapunka_get_meta( 'tienda_filters_enabled', 'yes' );
$tienda_filters         = kapunka_get_meta( 'tienda_filter_categories', array() );
if ( empty( $tienda_filters ) || ! is_array( $tienda_filters ) ) {
    $tienda_filters = array(
        array( 'label' => __( 'Todo', 'understrap' ), 'slug' => 'todo' ),
        array( 'label' => __( 'Rostro', 'understrap' ), 'slug' => 'rostro' ),
        array( 'label' => __( 'Cuerpo', 'understrap' ), 'slug' => 'cuerpo' ),
        array( 'label' => __( 'Packs', 'understrap' ), 'slug' => 'packs' ),
    );
}

$filter_links = array();
foreach ( $tienda_filters as $filter ) {
    $label = isset( $filter['label'] ) ? trim( (string) $filter['label'] ) : '';
    $slug  = isset( $filter['slug'] ) ? sanitize_title( $filter['slug'] ) : '';

    if ( '' === $label ) {
        continue;
    }

    if ( '' === $slug ) {
        $slug = 'todo';
    }

    $filter_links[ $slug ] = array(
        'label' => $label,
        'slug'  => $slug,
    );
}

if ( empty( $filter_links ) ) {
    $filter_links['todo'] = array(
        'label' => __( 'Todo', 'understrap' ),
        'slug'  => 'todo',
    );
}

$available_filters = array_keys( $filter_links );
$current_filter    = isset( $_GET['categoria'] ) ? sanitize_key( wp_unslash( $_GET['categoria'] ) ) : 'todo';

if ( ! in_array( $current_filter, $available_filters, true ) ) {
    $current_filter = 'todo';
}

$products_args = array(
    'limit'    => -1,
    'orderby'  => 'menu_order',
    'order'    => 'ASC',
    'status'   => 'publish',
    'paginate' => false,
);

if ( 'todo' !== $current_filter ) {
    $products_args['category'] = array( $current_filter );
}

$products = array();
if ( function_exists( 'wc_get_products' ) ) {
    $products = wc_get_products( $products_args );
}
?>

<main id="tienda-page" class="site-main site-main--tienda">
    <section class="tienda-hero">
        <div class="kapunka-clamp">
            <div class="tienda-hero__header">
                <div>
                    <?php if ( '' !== trim( (string) $hero['eyebrow'] ) ) : ?>
                        <p class="kapunka-tech"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                    <?php endif; ?>
                    <h1><?php echo esc_html( $hero['title'] ); ?></h1>
                    <?php if ( '' !== trim( (string) $hero['description'] ) ) : ?>
                        <p class="copy-intro"><?php echo esc_html( $hero['description'] ); ?></p>
                    <?php endif; ?>
                    <?php
                    if ( ( ! empty( $hero['primary']['label'] ) && ! empty( $hero['primary']['url'] ) )
                        || ( ! empty( $hero['secondary']['label'] ) && ! empty( $hero['secondary']['url'] ) ) ) :
                        ?>
                        <div class="tienda-hero__ctas">
                            <?php if ( ! empty( $hero['primary']['label'] ) && ! empty( $hero['primary']['url'] ) ) : ?>
                                <a class="btn btn-primary" href="<?php echo esc_url( $hero['primary']['url'] ); ?>"><?php echo esc_html( $hero['primary']['label'] ); ?></a>
                            <?php endif; ?>
                            <?php if ( ! empty( $hero['secondary']['label'] ) && ! empty( $hero['secondary']['url'] ) ) : ?>
                                <a class="btn btn-outline" href="<?php echo esc_url( $hero['secondary']['url'] ); ?>"><?php echo esc_html( $hero['secondary']['label'] ); ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if ( 'yes' === $tienda_filters_enabled ) : ?>
        <section class="tienda-filters" aria-label="<?php esc_attr_e( 'Filtrar productos por categoría', 'understrap' ); ?>">
            <div class="kapunka-clamp">
                <nav class="tienda-filters__nav" aria-label="<?php esc_attr_e( 'Filtros de productos', 'understrap' ); ?>">
                    <?php foreach ( $filter_links as $slug => $data ) :
                        $is_active = ( $slug === $current_filter );
                        $url       = 'todo' === $slug ? $tienda_url : add_query_arg( 'categoria', $slug, $tienda_url );
                        ?>
                        <a
                            href="<?php echo esc_url( $url ); ?>"
                            class="tienda-filters__link<?php echo $is_active ? ' is-active' : ''; ?>"
                            aria-current="<?php echo $is_active ? 'true' : 'false'; ?>"
                        >
                            <?php echo esc_html( $data['label'] ); ?>
                        </a>
                    <?php endforeach; ?>
                </nav>
            </div>
        </section>
    <?php endif; ?>

    <section class="product-grid product-grid--tienda">
        <div class="kapunka-clamp">
            <div class="kapunka-grid kapunka-grid--tienda">
                <?php
                if ( $products ) :
                    foreach ( $products as $product ) :
                        kapunka_component(
                            'card-product',
                            array(
                                'product' => $product,
                                'context' => 'tienda',
                            )
                        );
                    endforeach;
                else :
                    ?>
                    <p><?php esc_html_e( 'No hay productos disponibles todavía.', 'understrap' ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if ( $tienda_visual_banner_id ) : ?>
        <section class="tienda-visual-banner" aria-hidden="true">
            <?php echo wp_get_attachment_image( $tienda_visual_banner_id, 'full', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
        </section>
    <?php endif; ?>

    <section class="tienda-banner" aria-hidden="true">
        <div class="tienda-banner__image" role="presentation"<?php echo $tienda_banner_url ? ' style="background-image: url(' . esc_url( $tienda_banner_url ) . ');"' : ''; ?>></div>
    </section>

    <section class="tienda-trinity" aria-label="<?php esc_attr_e( 'Pilares Kapunka', 'understrap' ); ?>">
        <div class="kapunka-clamp">
            <div class="tienda-trinity__grid">
                <?php foreach ( $tienda_trinity_items as $item ) :
                    $title = isset( $item['crb_tienda_trinity_headline'] ) ? trim( (string) $item['crb_tienda_trinity_headline'] ) : '';
                    $desc  = isset( $item['crb_tienda_trinity_body'] ) ? trim( (string) $item['crb_tienda_trinity_body'] ) : '';

                    if ( '' === $title && '' === $desc ) {
                        continue;
                    }
                    ?>
                    <article class="tienda-trinity__item">
                        <?php if ( '' !== $title ) : ?>
                            <h3 class="tienda-trinity__title"><?php echo esc_html( $title ); ?></h3>
                        <?php endif; ?>
                        <?php if ( '' !== $desc ) : ?>
                            <p class="tienda-trinity__body"><?php echo esc_html( $desc ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
