<?php
/**
 * FAQ Section component.
 *
 * Args:
 * - title
 * - items: array of arrays with question/answer
 */

$items = $args['items'] ?? array();

if ( empty( $items ) ) {
    return;
}

$title = $args['title'] ?? __( 'Preguntas frecuentes', 'understrap' );
$cta   = $args['cta'] ?? array();
$cta_label = $cta['label'] ?? __( 'Ver todas las FAQs', 'understrap' );
$cta_url   = $cta['url'] ?? home_url( '/faq' );
$show_cta  = ! empty( $cta_url );
?>

<section class="kapunka-faq">
    <div class="kapunka-faq__layout">
        <div class="kapunka-faq__intro">
            <?php if ( $title ) : ?>
                <h2><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>

            <?php if ( $show_cta ) : ?>
                <a class="kapunka-faq__cta" href="<?php echo esc_url( $cta_url ); ?>">
                    <?php echo esc_html( $cta_label ); ?>
                </a>
            <?php endif; ?>
        </div>

        <div class="kapunka-faq__list">
            <?php foreach ( $items as $item ) : ?>
                <details class="kapunka-faq__item">
                    <?php if ( ! empty( $item['question'] ) ) : ?>
                        <summary>
                            <span><?php echo esc_html( $item['question'] ); ?></span>
                            <span class="kapunka-faq__icon" aria-hidden="true"></span>
                        </summary>
                    <?php endif; ?>

                    <?php if ( ! empty( $item['answer'] ) ) : ?>
                        <div class="kapunka-faq__answer"><?php echo wp_kses_post( $item['answer'] ); ?></div>
                    <?php endif; ?>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
