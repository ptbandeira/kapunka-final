<?php
/**
 * Testimonial slider component.
 *
 * Args:
 * - testimonials: array of testimonial data (quote, author, role, before_image, after_image)
 * - slider_id: string unique ID
 */

$testimonials = $args['testimonials'] ?? array();

if ( empty( $testimonials ) ) {
    return;
}

$slider_id = $args['slider_id'] ?? wp_unique_id( 'kapunka-testimonials-' );
?>

<div class="kapunka-testimonial-slider" id="<?php echo esc_attr( $slider_id ); ?>" data-slider>
    <div class="kapunka-testimonial-slider__track" data-slider-track>
        <?php foreach ( $testimonials as $testimonial ) : ?>
            <div class="kapunka-testimonial">
                <?php if ( ! empty( $testimonial['quote'] ) ) : ?>
                    <p class="kapunka-testimonial__quote">“<?php echo esc_html( $testimonial['quote'] ); ?>”</p>
                <?php endif; ?>

                <?php if ( ! empty( $testimonial['author'] ) ) : ?>
                    <p class="kapunka-testimonial__author">
                        <?php echo esc_html( $testimonial['author'] ); ?>
                        <?php if ( ! empty( $testimonial['role'] ) ) : ?>
                            <span> · <?php echo esc_html( $testimonial['role'] ); ?></span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>

                <?php if ( ! empty( $testimonial['before_image'] ) || ! empty( $testimonial['after_image'] ) ) : ?>
                    <div class="kapunka-testimonial__media">
                        <?php if ( ! empty( $testimonial['before_image'] ) ) : ?>
                            <figure>
                                <?php echo wp_get_attachment_image( $testimonial['before_image'], 'medium', false, array( 'loading' => 'lazy' ) ); ?>
                                <figcaption><?php esc_html_e( 'Antes', 'understrap' ); ?></figcaption>
                            </figure>
                        <?php endif; ?>
                        <?php if ( ! empty( $testimonial['after_image'] ) ) : ?>
                            <figure>
                                <?php echo wp_get_attachment_image( $testimonial['after_image'], 'medium', false, array( 'loading' => 'lazy' ) ); ?>
                                <figcaption><?php esc_html_e( 'Después', 'understrap' ); ?></figcaption>
                            </figure>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

</div>
