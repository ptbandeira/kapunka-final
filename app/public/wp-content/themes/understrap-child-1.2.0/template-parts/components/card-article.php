<?php
/**
 * Article card component.
 *
 * Args:
 * - post: WP_Post
 * - category_label: string
 * - reading_time: string
 */

$post_object = $args['post'] ?? null;
$variant     = isset( $args['variant'] ) ? sanitize_title( $args['variant'] ) : '';

if ( ! $post_object instanceof WP_Post ) {
    return;
}

$permalink      = get_permalink( $post_object );
$category_label = $args['category_label'] ?? get_the_category_list( ', ', '', $post_object->ID );
$reading_time   = $args['reading_time'] ?? kapunka_get_meta( 'tiempo_de_lectura', '', $post_object->ID );
$excerpt        = has_excerpt( $post_object ) ? $post_object->post_excerpt : wp_trim_words( wp_strip_all_tags( $post_object->post_content ), 20 );
// Use 'large' size for magazine-style grid to ensure high-quality images
$image_size     = ( 'featured-main' === $variant ) ? 'kapunka-article-card' : 'large';
$image          = get_the_post_thumbnail( $post_object, $image_size, array( 'class' => 'kapunka-article-card__media', 'loading' => 'lazy' ) );
?>

<?php $card_classes = 'kapunka-article-card' . ( $variant ? ' kapunka-article-card--' . esc_attr( $variant ) : '' ); ?>
<article class="<?php echo $card_classes; ?>">
    <a href="<?php echo esc_url( $permalink ); ?>">
        <?php echo $image ?: '<div class="kapunka-article-card__media"></div>'; ?>
    </a>

    <div class="kapunka-article-card__meta">
        <span><?php echo wp_kses_post( $category_label ); ?></span>
        <?php if ( $reading_time ) : ?>
            <span><?php echo esc_html( $reading_time ); ?></span>
        <?php endif; ?>
    </div>

    <h3 class="kapunka-article-card__title">
        <a href="<?php echo esc_url( $permalink ); ?>">
            <?php echo esc_html( get_the_title( $post_object ) ); ?>
        </a>
    </h3>

    <?php if ( $excerpt ) : ?>
        <p class="kapunka-article-card__excerpt"><?php echo esc_html( $excerpt ); ?></p>
    <?php endif; ?>

    <a class="kapunka-article-card__link" href="<?php echo esc_url( $permalink ); ?>">
        <?php esc_html_e( 'Leer artículo', 'understrap' ); ?>
    </a>
</article>
