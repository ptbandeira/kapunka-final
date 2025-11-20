<?php
/**
 * Template Name: Kapunka Profesionales
 *
 * @package Understrap
 */

defined( 'ABSPATH' ) || exit;

get_header();

$hero = array(
    'eyebrow'  => kapunka_get_meta( 'crb_pro_hero_eyebrow', __( 'DIVISIÓN PROFESIONAL', 'understrap' ) ),
    'title'    => kapunka_get_meta( 'crb_pro_hero_title', __( 'Eleve sus protocolos estéticos.', 'understrap' ) ),
    'subtitle' => kapunka_get_meta( 'crb_pro_hero_subtitle', __( 'Línea exclusiva de alto rendimiento para clínicas, spas de lujo y hoteles. Incluye formación técnica de nuestro método.', 'understrap' ) ),
    'image_id' => (int) kapunka_get_meta( 'crb_pro_hero_image', 0 ),
);

$value_grid = kapunka_get_meta( 'crb_pro_value_grid', array() );
if ( empty( $value_grid ) || ! is_array( $value_grid ) ) {
    $value_grid = array(
        array(
            'crb_pro_value_headline' => __( 'Rentabilidad', 'understrap' ),
            'crb_pro_value_body'     => __( 'Producto con historia y validación que justifica un ticket medio elevado.', 'understrap' ),
        ),
        array(
            'crb_pro_value_headline' => __( 'Formación', 'understrap' ),
            'crb_pro_value_body'     => __( 'Acceso al "Método Kapunka": protocolos de masaje facial y corporal.', 'understrap' ),
        ),
        array(
            'crb_pro_value_headline' => __( 'Formatos Cabina', 'understrap' ),
            'crb_pro_value_body'     => __( 'Tamaños exclusivos (500ml) para uso intensivo.', 'understrap' ),
        ),
        array(
            'crb_pro_value_headline' => __( 'Soporte Técnico', 'understrap' ),
            'crb_pro_value_body'     => __( 'Fichas técnicas completas y material de marketing.', 'understrap' ),
        ),
    );
}


$raw_testimonials = kapunka_get_meta( 'profesionales_testimonios', array() );
$faq_title          = kapunka_get_meta( 'profesionales_faq_title', __( 'Preguntas frecuentes', 'understrap' ) );
$faq_items          = kapunka_get_meta( 'profesionales_faq_items', array() );
$form_headline      = kapunka_get_meta( 'crb_pro_form_headline', __( 'Solicitar acceso', 'understrap' ) );
$form_body          = kapunka_get_meta( 'crb_pro_form_body', __( 'Envíe su solicitud para acceder a nuestra plataforma profesional, fichas técnicas y precios de cabina.', 'understrap' ) );

$extra_components = kapunka_get_meta( 'profesionales_componentes', array() );
$kit_data = array(
    'eyebrow'    => kapunka_get_meta( 'crb_pro_kit_eyebrow', __( 'Kit profesional', 'understrap' ) ),
    'headline'   => kapunka_get_meta( 'crb_pro_kit_headline', __( 'Maletín con botellas, goteros, manual técnico y fichas impresas.', 'understrap' ) ),
    'body'       => kapunka_get_meta( 'crb_pro_kit_body', '' ),
    'bullets'    => kapunka_get_meta( 'profesionales_kit_bullets', array() ),
    'image_id'   => (int) kapunka_get_meta( 'crb_pro_kit_image', 0 ),
);
$onboarding_steps = kapunka_get_meta( 'profesionales_onboarding_steps', array() );

$testimonials = array();
if ( is_array( $raw_testimonials ) ) {
    foreach ( $raw_testimonials as $testimonial ) {
        $quote  = isset( $testimonial['quote'] ) ? trim( (string) $testimonial['quote'] ) : '';
        $author = isset( $testimonial['author'] ) ? trim( (string) $testimonial['author'] ) : '';
        $role   = isset( $testimonial['role'] ) ? trim( (string) $testimonial['role'] ) : '';

        if ( '' === $quote ) {
            continue;
        }

        $testimonials[] = array(
            'quote'  => $quote,
            'author' => $author,
            'role'   => $role,
        );
    }
}

if ( empty( $testimonials ) ) {
    $testimonials = array(
        array(
            'quote'  => __( 'Tras incorporar Kapunka en protocolos post-láser, observamos una recuperación más homogénea y cómoda para los pacientes.', 'understrap' ),
            'author' => 'Dr. López',
            'role'   => __( 'dermatólogo', 'understrap' ),
        ),
        array(
            'quote'  => __( 'El Método Kapunka ha enriquecido nuestros rituales spa, aportando autenticidad y resultados tangibles.', 'understrap' ),
            'author' => __( 'Directora de Spa 5★', 'understrap' ),
            'role'   => '',
        ),
    );
}

if ( empty( $kit_data['bullets'] ) || ! is_array( $kit_data['bullets'] ) ) {
    $kit_data['bullets'] = array(
        array( 'item' => __( 'Botellas de 500 ml + goteros dosificadores.', 'understrap' ) ),
        array( 'item' => __( 'Manual técnico y guías de diagnóstico táctil.', 'understrap' ) ),
        array( 'item' => __( 'Fichas clínicas en formato físico y digital.', 'understrap' ) ),
    );
}

if ( empty( $onboarding_steps ) || ! is_array( $onboarding_steps ) ) {
    $onboarding_steps = array(
        array(
            'title'       => __( 'Aplicar', 'understrap' ),
            'description' => __( 'Completa el formulario clínico y agenda la llamada de diagnóstico.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Formación', 'understrap' ),
            'description' => __( 'Sesión presencial u online con protocolos y demostraciones.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Suministro', 'understrap' ),
            'description' => __( 'Entregas recurrentes y trazadas para tu cabina y retail.', 'understrap' ),
        ),
        array(
            'title'       => __( 'Marketing compartido', 'understrap' ),
            'description' => __( 'Materiales premium y presencia en nuestro Journal.', 'understrap' ),
        ),
    );
}
?>

<main id="profesionales-page" class="site-main site-main--profesionales">
    <section class="pro-hero">
        <div class="kapunka-clamp pro-hero__grid">
            <div class="pro-hero__content">
                <?php if ( '' !== trim( (string) $hero['eyebrow'] ) ) : ?>
                    <p class="pro-hero__eyebrow text-uppercase letter-spacing"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $hero['title'] ) ) : ?>
                    <h1 class="pro-hero__title"><?php echo esc_html( $hero['title'] ); ?></h1>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $hero['subtitle'] ) ) : ?>
                    <p class="pro-hero__subtitle"><?php echo esc_html( $hero['subtitle'] ); ?></p>
                <?php endif; ?>
            </div>
            <div class="pro-hero__media">
                <?php
                if ( $hero['image_id'] ) {
                    echo wp_get_attachment_image( $hero['image_id'], 'large', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) );
                } else {
                    ?>
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/hero-bg.jpg' ); ?>" alt="Spa Kapunka" loading="lazy" />
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $value_grid ) ) : ?>
        <section class="valor-propuesta-grid" aria-label="<?php esc_attr_e( 'Propuesta de valor Kapunka', 'understrap' ); ?>">
            <div class="valor-propuesta-grid__inner">
                <?php
                foreach ( $value_grid as $item ) :
                    $image_id = isset( $item['crb_pro_value_image'] ) ? (int) $item['crb_pro_value_image'] : 0;
                    $headline = isset( $item['crb_pro_value_headline'] ) ? trim( (string) $item['crb_pro_value_headline'] ) : '';
                    $body     = isset( $item['crb_pro_value_body'] ) ? trim( (string) $item['crb_pro_value_body'] ) : '';

                    if ( ! $image_id || '' === $headline ) {
                        continue;
                    }

                    $image_url = wp_get_attachment_image_url( $image_id, 'full' );
                    ?>
                    <article class="valor-propuesta-grid__item"<?php echo $image_url ? ' style="background-image: url(' . esc_url( $image_url ) . ');"' : ''; ?>>
                        <div class="valor-propuesta-grid__overlay"></div>
                        <div class="valor-propuesta-grid__content">
                            <div class="kapunka-clamp valor-propuesta-grid__shell">
                                <div class="valor-propuesta-grid__content-inner">
                                    <h3><?php echo esc_html( $headline ); ?></h3>
                                    <?php if ( '' !== $body ) : ?>
                                        <p><?php echo esc_html( $body ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ( ! empty( $benefits_items ) ) :
        $benefits_aria = '';
        if ( '' !== trim( (string) $benefits_title ) ) {
            $benefits_aria = ' aria-label="' . esc_attr( $benefits_title ) . '"';
        }
        ?>
        <section class="kapunka-section"<?php echo $benefits_aria; ?>>
            <div class="kapunka-clamp">
                <?php if ( '' !== trim( (string) $benefits_title ) ) : ?>
                    <div class="section-heading">
                        <h2><?php echo esc_html( $benefits_title ); ?></h2>
                    </div>
                <?php endif; ?>

                <?php if ( $benefits_background ) : ?>
                    <figure>
                        <img src="<?php echo esc_url( $benefits_background ); ?>" alt="<?php echo esc_attr( $benefits_title ); ?>" loading="lazy" decoding="async">
                    </figure>
                <?php endif; ?>

                <div class="kapunka-grid">
                    <?php foreach ( $benefits_items as $benefit ) :
                        $benefit_title = isset( $benefit['title'] ) ? trim( (string) $benefit['title'] ) : '';
                        $benefit_description = isset( $benefit['description'] ) ? trim( (string) $benefit['description'] ) : '';

                        if ( '' === $benefit_title && '' === $benefit_description ) {
                            continue;
                        }
                        ?>
                        <article>
                            <?php if ( '' !== $benefit_title ) : ?>
                                <h3><?php echo esc_html( $benefit_title ); ?></h3>
                            <?php endif; ?>
                            <?php if ( '' !== $benefit_description ) : ?>
                                <p><?php echo esc_html( $benefit_description ); ?></p>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <section class="kapunka-section pro-kit" id="kit">
        <div class="kapunka-clamp pro-kit__grid">
            <div class="pro-kit__content">
                <?php if ( '' !== trim( (string) $kit_data['eyebrow'] ) ) : ?>
                    <p class="kapunka-tech"><?php echo esc_html( $kit_data['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $kit_data['headline'] ) ) : ?>
                    <h2 class="pro-kit__headline"><?php echo esc_html( $kit_data['headline'] ); ?></h2>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $kit_data['body'] ) ) : ?>
                    <p class="pro-kit__body"><?php echo esc_html( $kit_data['body'] ); ?></p>
                <?php endif; ?>
                <ul>
                    <?php foreach ( $kit_data['bullets'] as $bullet ) :
                        $bullet_text = isset( $bullet['item'] ) ? trim( (string) $bullet['item'] ) : '';
                        if ( '' === $bullet_text ) {
                            continue;
                        }
                        ?>
                        <li><?php echo esc_html( $bullet_text ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="pro-kit__media">
                <?php
                if ( $kit_data['image_id'] ) {
                    echo wp_get_attachment_image( $kit_data['image_id'], 'large', false, array( 'loading' => 'lazy', 'decoding' => 'async' ) );
                } else {
                    ?>
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/hero-bg.jpg' ); ?>" alt="<?php esc_attr_e( 'Kit profesional Kapunka', 'understrap' ); ?>" loading="lazy">
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <section class="kapunka-section pro-form" id="registro">
        <div class="kapunka-clamp pro-form__inner">
            <?php if ( '' !== trim( (string) $form_headline ) ) : ?>
                <h2 class="pro-form__headline"><?php echo esc_html( $form_headline ); ?></h2>
            <?php endif; ?>
            <?php if ( '' !== trim( (string) $form_body ) ) : ?>
                <p class="pro-form__body"><?php echo esc_html( $form_body ); ?></p>
            <?php endif; ?>
            <form class="pro-form__form" method="post" action="<?php echo esc_url( home_url( '/contacto#profesionales' ) ); ?>">
                <div class="pro-form__field">
                    <label for="pro-form-clinica">
                        <span class="screen-reader-text"><?php esc_html_e( 'Nombre de la clínica', 'understrap' ); ?></span>
                        <input 
                            id="pro-form-clinica" 
                            type="text" 
                            name="clinica" 
                            placeholder="<?php esc_attr_e( 'Nombre de la clínica', 'understrap' ); ?>" 
                            required
                        >
                    </label>
                </div>
                <div class="pro-form__field">
                    <label for="pro-form-email">
                        <span class="screen-reader-text"><?php esc_html_e( 'Email', 'understrap' ); ?></span>
                        <input 
                            id="pro-form-email" 
                            type="email" 
                            name="email" 
                            placeholder="<?php esc_attr_e( 'Email', 'understrap' ); ?>" 
                            required
                        >
                    </label>
                </div>
                <div class="pro-form__field">
                    <label for="pro-form-mensaje">
                        <span class="screen-reader-text"><?php esc_html_e( 'Mensaje', 'understrap' ); ?></span>
                        <textarea 
                            id="pro-form-mensaje" 
                            name="mensaje" 
                            rows="4" 
                            placeholder="<?php esc_attr_e( 'Mensaje', 'understrap' ); ?>"
                        ></textarea>
                    </label>
                </div>
                <button type="submit" class="pro-form__submit"><?php esc_html_e( 'Enviar', 'understrap' ); ?></button>
            </form>
        </div>
    </section>

    <?php if ( ! empty( $testimonials ) ) : ?>
        <section class="aprende-section testimonios-profesionales">
            <div class="aprende-section__inner kapunka-clamp">
                <div class="testimonial-slider">
                    <?php foreach ( $testimonials as $testimonial ) :
                        $quote  = $testimonial['quote'];
                        $author = $testimonial['author'];
                        $role   = $testimonial['role'];

                        $author_line_parts = array();
                        if ( '' !== $author ) {
                            $author_line_parts[] = $author;
                        }
                        if ( '' !== $role ) {
                            $author_line_parts[] = $role;
                        }
                        $author_line = implode( ', ', array_filter( $author_line_parts ) );
                        ?>
                        <div class="testimonial">
                            <p class="testimonial-text">"<?php echo esc_html( $quote ); ?>"</p>
                            <?php if ( '' !== $author_line ) : ?>
                                <p class="testimonial-author">- <?php echo esc_html( $author_line ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="kapunka-section pro-onboarding">
        <div class="kapunka-clamp pro-onboarding__grid">
            <?php
            $step_index = 1;
            foreach ( $onboarding_steps as $step ) :
                $step_title = isset( $step['title'] ) ? trim( (string) $step['title'] ) : '';
                $step_description = isset( $step['description'] ) ? trim( (string) $step['description'] ) : '';

                if ( '' === $step_title ) {
                    $step_index++;
                    continue;
                }
                ?>
                <article>
                    <span class="kapunka-tech"><?php echo esc_html( sprintf( '%02d', $step_index ) ); ?></span>
                    <h3><?php echo esc_html( $step_title ); ?></h3>
                    <?php if ( '' !== $step_description ) : ?>
                        <p><?php echo esc_html( $step_description ); ?></p>
                    <?php endif; ?>
                </article>
                <?php $step_index++; ?>
            <?php endforeach; ?>
        </div>
    </section>


    <?php
    if ( ! empty( $faq_items ) ) {
        kapunka_component(
            'faq-section',
            array(
                'title' => $faq_title,
                'items' => $faq_items,
            )
        );
    }
    ?>

    <?php if ( ! empty( $extra_components ) ) : ?>
        <?php foreach ( $extra_components as $component ) : ?>
            <?php
            if ( ( $component['_type'] ?? '' ) !== 'cta' ) {
                continue;
            }

            kapunka_component(
                'cta-section',
                array(
                    'eyebrow'    => $component['eyebrow'] ?? '',
                    'title'      => $component['title'] ?? '',
                    'description'=> $component['description'] ?? '',
                    'primary'    => array(
                        'label' => $component['primary_label'] ?? '',
                        'url'   => $component['primary_url'] ?? '',
                    ),
                    'secondary'  => array(
                        'label' => $component['secondary_label'] ?? '',
                        'url'   => $component['secondary_url'] ?? '',
                    ),
                    'background_image' => $component['background_image'] ?? 0,
                )
            );
            ?>
        <?php endforeach; ?>
    <?php endif; ?>
</main>

<?php
get_footer();
