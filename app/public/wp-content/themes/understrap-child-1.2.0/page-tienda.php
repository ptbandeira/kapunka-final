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

$tienda_trinity_items = kapunka_get_meta( 'tienda_trinity_items', array() );
if ( empty( $tienda_trinity_items ) || ! is_array( $tienda_trinity_items ) ) {
    $tienda_trinity_items = array(
        array(
            'title'       => __( 'Puramente ético', 'understrap' ),
            'description' => __( 'Primera prensada en frío de cooperativas femeninas certificadas.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Clínicamente eficaz', 'understrap' ),
            'description' => __( '100% pureza validada. Rico en Vitamina E y ácidos grasos esenciales.', 'understrap' ),
        ),
        array(
            'title'       => __( 'El ritual experto', 'understrap' ),
            'description' => __( 'Protocolos de aplicación propios que maximizan la absorción.', 'understrap' ),
        ),
    );
}

$tienda_banner_id  = (int) kapunka_get_meta( 'tienda_banner_image', 0 );
$tienda_banner_url = $tienda_banner_id ? wp_get_attachment_image_url( $tienda_banner_id, 'full' ) : '';

$available_filters = array( 'todo', 'rostro', 'cuerpo', 'packs' );
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
    <section class="kapunka-section tienda-hero">
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
                <div class="tienda-hero__filters" hidden aria-hidden="true">
                    <?php
                    $filter_links = array(
                        'todo'   => array(
                            'label' => __( 'Todo', 'understrap' ),
                            'url'   => $tienda_url,
                        ),
                        'rostro' => array(
                            'label' => __( 'Rostro', 'understrap' ),
                            'url'   => add_query_arg( 'categoria', 'rostro', $tienda_url ),
                        ),
                        'cuerpo' => array(
                            'label' => __( 'Cuerpo', 'understrap' ),
                            'url'   => add_query_arg( 'categoria', 'cuerpo', $tienda_url ),
                        ),
                        'packs'  => array(
                            'label' => __( 'Packs', 'understrap' ),
                            'url'   => add_query_arg( 'categoria', 'packs', $tienda_url ),
                        ),
                    );

                    foreach ( $filter_links as $slug => $data ) {
                        $is_active = ( $slug === $current_filter );
                        printf(
                            '<a href="%1$s" class="%3$s">%2$s</a>',
                            esc_url( $data['url'] ),
                            esc_html( $data['label'] ),
                            $is_active ? 'is-active' : ''
                        );
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

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

    <section class="tienda-banner" aria-hidden="true">
        <div class="tienda-banner__image" role="presentation"<?php echo $tienda_banner_url ? ' style="background-image: url(' . esc_url( $tienda_banner_url ) . ');"' : ''; ?>></div>
    </section>

    <section class="tienda-trinity" aria-label="<?php esc_attr_e( 'Pilares Kapunka', 'understrap' ); ?>">
        <div class="kapunka-clamp">
            <div class="tienda-trinity__grid">
                <?php foreach ( $tienda_trinity_items as $item ) :
                    $title = isset( $item['title'] ) ? trim( (string) $item['title'] ) : '';
                    $desc  = isset( $item['description'] ) ? trim( (string) $item['description'] ) : '';

                    if ( '' === $title && '' === $desc ) {
                        continue;
                    }
                    ?>
                    <article class="tienda-trinity__item">
                        <?php if ( '' !== $title ) : ?>
                            <h2><?php echo esc_html( $title ); ?></h2>
                        <?php endif; ?>
                        <?php if ( '' !== $desc ) : ?>
                            <p><?php echo esc_html( $desc ); ?></p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
