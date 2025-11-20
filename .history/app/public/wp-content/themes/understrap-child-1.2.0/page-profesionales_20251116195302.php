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

$valor_propuesta_defaults = array(
    array(
        'headline'   => __( 'Rentabilidad', 'understrap' ),
        'body'       => __( 'Producto con historia y validación que justifica un ticket medio elevado.', 'understrap' ),
        'background' => '',
    ),
    array(
        'headline'   => __( 'Formación', 'understrap' ),
        'body'       => __( 'Acceso al “Método Kapunka”: protocolos de masaje facial y corporal.', 'understrap' ),
        'background' => '',
    ),
    array(
        'headline'   => __( 'Formatos Cabina', 'understrap' ),
        'body'       => __( 'Tamaños exclusivos (500ml / 1L) para uso intensivo.', 'understrap' ),
        'background' => '',
    ),
    array(
        'headline'   => __( 'Soporte Técnico', 'understrap' ),
        'body'       => __( 'Fichas técnicas completas y material de marketing.', 'understrap' ),
        'background' => '',
    ),
);
$valor_propuesta_items = kapunka_get_meta( 'valor_propuesta_items', array() );
if ( empty( $valor_propuesta_items ) ) {
    $valor_propuesta_items = $valor_propuesta_defaults;
}
$curriculum_title       = kapunka_get_meta( 'profesionales_curriculum_title', __( 'Currículum del programa', 'understrap' ) );
$curriculum_description = kapunka_get_meta( 'profesionales_curriculum_description', __( 'Cuatro módulos intensivos y tutorías en vivo.', 'understrap' ) );
$curriculum_modules     = kapunka_get_meta( 'profesionales_curriculum_modules', array() );
$curriculum_defaults    = array(
    array(
        'title'       => __( 'Bioquímica del argán aplicado a la piel sensible', 'understrap' ),
        'description' => __( 'Perfil lipídico, tocoferoles y fracciones insaponificables para entender la regeneración de la barrera cutánea.', 'understrap' ),
        'bullets'     => array(
            array( 'item' => __( 'Lectura de certificados COSMOS', 'understrap' ) ),
            array( 'item' => __( 'Interpretación de análisis de lote', 'understrap' ) ),
        ),
    ),
    array(
        'title'       => __( 'Diseño de ritual clínico', 'understrap' ),
        'description' => __( 'Cómo adaptar el Método Kapunka a cirugías, dermatología y medicina estética.', 'understrap' ),
        'bullets'     => array(
            array( 'item' => __( 'Mapas de recuperación tisular', 'understrap' ) ),
            array( 'item' => __( 'Protocolos para cicatrices y quemaduras leves', 'understrap' ) ),
        ),
    ),
    array(
        'title'       => __( 'Implementación en cabina y retail', 'understrap' ),
        'description' => __( 'Educación del paciente, plan de venta ética y seguimiento digital.', 'understrap' ),
        'bullets'     => array(
            array( 'item' => __( 'Plantillas de seguimiento post tratamiento', 'understrap' ) ),
            array( 'item' => __( 'Kit minorista para pacientes', 'understrap' ) ),
        ),
    ),
);
if ( empty( $curriculum_modules ) ) {
    $curriculum_modules = $curriculum_defaults;
}

$benefits_title       = kapunka_get_meta( 'profesionales_benefits_title', __( 'Beneficios para tu clínica', 'understrap' ) );
$benefits_items       = kapunka_get_meta( 'profesionales_benefits', array() );
$benefits_defaults    = array(
    array(
        'title'       => __( 'Mejora la experiencia del paciente', 'understrap' ),
        'description' => __( 'El aceite puro reduce efectos secundarios tras láser o peeling y eleva la satisfacción post-tratamiento.', 'understrap' ),
    ),
    array(
        'title'       => __( 'Innovación y diferenciación', 'understrap' ),
        'description' => __( 'Ofrece rituales Kapunka exclusivos, aportando lujo sensorial y resultados visibles.', 'understrap' ),
    ),
    array(
        'title'       => __( 'Calidad asegurada', 'understrap' ),
        'description' => __( 'Producto con trazabilidad, registros sanitarios y respaldo clínico para trabajar con confianza.', 'understrap' ),
    ),
    array(
        'title'       => __( 'Soporte Kapunka', 'understrap' ),
        'description' => __( 'Material educativo, guías y acompañamiento continuo. Co-creamos casos de éxito con tu centro.', 'understrap' ),
    ),
);
if ( empty( $benefits_items ) ) {
    $benefits_items = $benefits_defaults;
}
$benefits_background  = kapunka_get_meta( 'beneficios_background', '' );

$raw_testimonials = kapunka_get_meta( 'profesionales_testimonios', array() );
$faq_title          = kapunka_get_meta( 'profesionales_faq_title', __( 'Preguntas frecuentes', 'understrap' ) );
$faq_items          = kapunka_get_meta( 'profesionales_faq_items', array() );

$form_shortcode   = kapunka_get_meta( 'profesionales_form_shortcode', '' );
$extra_components = kapunka_get_meta( 'profesionales_componentes', array() );
$kit_data = array(
    'eyebrow'    => kapunka_get_meta( 'profesionales_kit_eyebrow', __( 'Kit profesional', 'understrap' ) ),
    'title'      => kapunka_get_meta( 'profesionales_kit_title', __( 'Maletín con botellas, goteros, manual técnico y fichas impresas.', 'understrap' ) ),
    'bullets'    => kapunka_get_meta( 'profesionales_kit_bullets', array() ),
    'image_id'   => (int) kapunka_get_meta( 'profesionales_kit_image', 0 ),
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

    <?php if ( ! empty( $valor_propuesta_items ) ) : ?>
        <section class="valor-propuesta-grid" aria-label="<?php esc_attr_e( 'Propuesta de valor Kapunka', 'understrap' ); ?>">
            <div class="valor-propuesta-grid__inner">
                <?php
                $index = 0;
                foreach ( $valor_propuesta_items as $item ) :
                    if ( $index >= 4 ) {
                        break;
                    }
                    $vp_title = $item['headline'] ?? '';
                    $vp_desc  = $item['body'] ?? '';
                    $vp_bg    = $item['background'] ?? '';

                    if ( '' === trim( (string) $vp_title ) ) {
                        $index++;
                        continue;
                    }
                    ?>
                    <article class="valor-propuesta-grid__item"<?php echo $vp_bg ? ' style="background-image: url(' . esc_url( $vp_bg ) . ');"' : ''; ?>>
                        <div class="valor-propuesta-grid__overlay"></div>
                        <div class="valor-propuesta-grid__content">
                            <div class="kapunka-clamp valor-propuesta-grid__shell">
                                <div class="valor-propuesta-grid__content-inner">
                                    <h3><?php echo esc_html( $vp_title ); ?></h3>
                                    <?php if ( '' !== trim( (string) $vp_desc ) ) : ?>
                                        <p><?php echo esc_html( $vp_desc ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php
                    $index++;
                endforeach;
                ?>
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

    <?php if ( ! empty( $curriculum_modules ) ) : ?>
        <section class="aprende-section curriculum-section">
            <div class="aprende-section__inner kapunka-clamp">
                <div class="section-heading">
                    <h2><?php echo esc_html( $curriculum_title ); ?></h2>
                    <?php if ( ! empty( $curriculum_description ) ) : ?>
                        <p><?php echo esc_html( $curriculum_description ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="curriculum-accordion">
                    <?php foreach ( $curriculum_modules as $module ) :
                        $module_title       = $module['title'] ?? '';
                        $module_description = $module['description'] ?? '';
                        $module_bullets     = isset( $module['bullets'] ) && is_array( $module['bullets'] ) ? $module['bullets'] : array();
                        if ( '' === trim( (string) $module_title ) ) {
                            continue;
                        }
                        ?>
                        <details class="curriculum-accordion__item">
                            <summary>
                                <span><?php echo esc_html( $module_title ); ?></span>
                            </summary>
                            <div class="curriculum-accordion__body">
                                <?php if ( '' !== trim( (string) $module_description ) ) : ?>
                                    <p><?php echo esc_html( $module_description ); ?></p>
                                <?php endif; ?>
                                <?php if ( ! empty( $module_bullets ) ) : ?>
                                    <ul>
                                        <?php foreach ( $module_bullets as $bullet ) :
                                            $bullet_text = $bullet['item'] ?? '';
                                            if ( '' === trim( (string) $bullet_text ) ) {
                                                continue;
                                            }
                                            ?>
                                            <li><?php echo esc_html( $bullet_text ); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="kapunka-section pro-kit" id="kit">
        <div class="kapunka-clamp pro-kit__grid">
            <div>
                <?php if ( '' !== trim( (string) $kit_data['eyebrow'] ) ) : ?>
                    <p class="kapunka-tech"><?php echo esc_html( $kit_data['eyebrow'] ); ?></p>
                <?php endif; ?>
                <?php if ( '' !== trim( (string) $kit_data['title'] ) ) : ?>
                    <h2><?php echo esc_html( $kit_data['title'] ); ?></h2>
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

    <section class="kapunka-section pro-lead" id="registro">
        <div class="kapunka-clamp pro-lead__inner">
            <h2><?php esc_html_e( 'Solicitar acceso', 'understrap' ); ?></h2>
            <?php
            $pro_form_markup = kapunka_render_form_shortcode(
                $form_shortcode,
                static function() {
                    ob_start();
                    ?>
                    <form class="pro-lead__form" method="post" action="<?php echo esc_url( home_url( '/contacto#profesionales' ) ); ?>">
                        <label>
                            <span><?php esc_html_e( 'Nombre', 'understrap' ); ?></span>
                            <input type="text" name="nombre" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Clínica o Negocio', 'understrap' ); ?></span>
                            <input type="text" name="clinica" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Volumen estimado mensual', 'understrap' ); ?></span>
                            <input type="text" name="volumen" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Email', 'understrap' ); ?></span>
                            <input type="email" name="email" required>
                        </label>
                        <label>
                            <span><?php esc_html_e( 'Mensaje (opcional)', 'understrap' ); ?></span>
                            <textarea name="mensaje" rows="4" placeholder="<?php esc_attr_e( 'Cuéntanos sobre tu centro o necesidades específicas (opcional)', 'understrap' ); ?>"></textarea>
                        </label>
                        <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Enviar solicitud', 'understrap' ); ?></button>
                    </form>
                    <?php
                    return ob_get_clean();
                }
            );
            ?>
            <div class="pro-lead__form pro-lead__form--shortcode">
                <?php echo $pro_form_markup; ?>
            </div>
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
