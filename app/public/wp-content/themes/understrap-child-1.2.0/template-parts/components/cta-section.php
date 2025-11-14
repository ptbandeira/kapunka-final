<?php
/**
 * CTA section component.
 *
 * Args:
 * - eyebrow
 * - title
 * - description
 * - primary (array: url, label)
 * - secondary (array: url, label)
 */

$title = $args['title'] ?? '';
if ( ! $title ) {
    return;
}

$primary   = $args['primary'] ?? array();
$secondary = $args['secondary'] ?? array();
$background_image = $args['background_image'] ?? 0;
$section_classes  = 'kapunka-cta';
$style_attribute  = '';

if ( $background_image ) {
    $background_url = wp_get_attachment_image_url( $background_image, 'full' );
    if ( $background_url ) {
        $section_classes .= ' kapunka-cta--with-image';
        $style_attribute   = sprintf( ' style="background-image: url(%s);"', esc_url( $background_url ) );
    }
}
?>

<section class="<?php echo esc_attr( $section_classes ); ?>"<?php echo $style_attribute; ?>>
    <?php if ( ! empty( $args['eyebrow'] ) ) : ?>
        <p class="text-uppercase letter-spacing"><?php echo esc_html( $args['eyebrow'] ); ?></p>
    <?php endif; ?>
    <h2><?php echo esc_html( $title ); ?></h2>
    <?php if ( ! empty( $args['description'] ) ) : ?>
        <p><?php echo esc_html( $args['description'] ); ?></p>
    <?php endif; ?>

    <div class="kapunka-product-card__actions">
        <?php if ( ! empty( $primary['url'] ) && ! empty( $primary['label'] ) ) : ?>
            <a class="kapunka-button" href="<?php echo esc_url( $primary['url'] ); ?>"><?php echo esc_html( $primary['label'] ); ?></a>
        <?php endif; ?>

        <?php if ( ! empty( $secondary['url'] ) && ! empty( $secondary['label'] ) ) : ?>
            <a class="kapunka-button is-outline" href="<?php echo esc_url( $secondary['url'] ); ?>"><?php echo esc_html( $secondary['label'] ); ?></a>
        <?php endif; ?>
    </div>
</section>
