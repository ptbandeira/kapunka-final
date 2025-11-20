<?php
/**
 * Carbon Fields containers.
 *
 * @package Understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( '\Carbon_Fields\Container' ) ) {
    return;
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'kapunka_register_carbon_fields' );

/**
 * Register all project-specific field groups.
 */
function kapunka_register_carbon_fields() {
    // -------------------------
    // Home page
    // -------------------------
    Container::make( 'post_meta', __( 'Inicio', 'understrap' ) )
        ->where( 'post_template', '=', 'page-home.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'text', 'home_hero_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'home_hero_title', __( 'Título', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'textarea', 'home_hero_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'image', 'home_hero_background', __( 'Imagen de fondo', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'text', 'home_hero_primary_label', __( 'CTA principal - texto', 'understrap' ) ),
                Field::make( 'text', 'home_hero_primary_url', __( 'CTA principal - URL', 'understrap' ) ),
                Field::make( 'text', 'home_hero_secondary_label', __( 'CTA secundaria - texto', 'understrap' ) ),
                Field::make( 'text', 'home_hero_secondary_url', __( 'CTA secundaria - URL', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Mensaje inicial', 'understrap' ),
            array(
                Field::make( 'text', 'crb_home_hook_title', __( 'Título editorial', 'understrap' ) )
                    ->set_default_value( __( 'Más que un aceite. Un método.', 'understrap' ) )
                    ->set_help_text( __( 'Se mostrará como titular H2 en el bloque editorial.', 'understrap' ) ),
                Field::make( 'rich_text', 'crb_home_hook_body', __( 'Cuerpo editorial', 'understrap' ) )
                    ->set_default_value( __( 'Kapunka no es solo un ingrediente; es la fusión de un abastecimiento ético en Marruecos y un protocolo clínico desarrollado durante 35 años. Diseñado para quienes exigen resultados visibles sin comprometer la pureza.', 'understrap' ) )
                    ->set_help_text( __( 'Texto enriquecido para el bloque “Más que un aceite. Un método.”', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Testimonios destacados', 'understrap' ),
            array(
                Field::make( 'complex', 'home_social_slides', __( 'Citas', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'textarea', 'quote', __( 'Cita', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'text', 'author', __( 'Autor', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Trinidad', 'understrap' ),
            array(
                Field::make( 'complex', 'crb_home_trinity', __( 'Bloques Trinity', 'understrap' ) )
                    ->set_max( 3 )
                    ->setup_labels(
                        array(
                            'plural_name'   => __( 'Bloques', 'understrap' ),
                            'singular_name' => __( 'Bloque', 'understrap' ),
                        )
                    )
                    ->add_fields(
                        array(
                            Field::make( 'image', 'crb_home_trinity_image', __( 'Imagen', 'understrap' ) )
                                ->set_value_type( 'id' ),
                            Field::make( 'text', 'crb_home_trinity_title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'crb_home_trinity_body', __( 'Descripción', 'understrap' ) ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'crb_home_trinity_title' => __( 'Origen', 'understrap' ),
                                'crb_home_trinity_body'  => __( 'Primera prensada en frío de cooperativas femeninas certificadas.', 'understrap' ),
                                'crb_home_trinity_image' => 0,
                            ),
                            array(
                                'crb_home_trinity_title' => __( 'Ciencia', 'understrap' ),
                                'crb_home_trinity_body'  => __( '100% pureza validada. Rico en Vitamina E y ácidos grasos esenciales.', 'understrap' ),
                                'crb_home_trinity_image' => 0,
                            ),
                            array(
                                'crb_home_trinity_title' => __( 'Método', 'understrap' ),
                                'crb_home_trinity_body'  => __( 'Protocolos de aplicación propios que maximizan la absorción.', 'understrap' ),
                                'crb_home_trinity_image' => 0,
                            ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Evidencia clínica', 'understrap' ),
            array(
                Field::make( 'text', 'home_evidence_eyebrow', __( 'Etiqueta', 'understrap' ) ),
                Field::make( 'text', 'home_evidence_title', __( 'Título', 'understrap' ) ),
                Field::make( 'complex', 'home_evidence_stats', __( 'Estadísticas', 'understrap' ) )
                    ->set_max( 3 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'stat', __( 'Dato', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
                Field::make( 'text', 'home_evidence_cta_label', __( 'CTA - texto', 'understrap' ) ),
                Field::make( 'text', 'home_evidence_cta_url', __( 'CTA - URL', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Programa profesional', 'understrap' ),
            array(
                Field::make( 'text', 'home_program_eyebrow', __( 'Etiqueta', 'understrap' ) ),
                Field::make( 'text', 'home_program_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'home_program_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'text', 'home_program_cta_label', __( 'CTA - texto', 'understrap' ) ),
                Field::make( 'text', 'home_program_cta_url', __( 'CTA - URL', 'understrap' ) ),
                Field::make( 'text', 'crb_home_b2b_cta_title', __( 'Título CTA B2B', 'understrap' ) )
                    ->set_default_value( __( 'Formaciones presenciales y soporte remoto para integrar Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'crb_home_b2b_cta_button_text', __( 'Texto botón CTA B2B', 'understrap' ) )
                    ->set_default_value( __( 'Ver detalles', 'understrap' ) ),
                Field::make( 'text', 'crb_home_b2b_cta_button_link', __( 'URL botón CTA B2B', 'understrap' ) )
                    ->set_attribute( 'type', 'url' )
                    ->set_default_value( home_url( '/profesionales' ) ),
            )
        )
        ->add_tab(
            __( 'Journal', 'understrap' ),
            array(
                Field::make( 'text', 'home_journal_eyebrow', __( 'Etiqueta', 'understrap' ) ),
                Field::make( 'text', 'home_journal_title', __( 'Título', 'understrap' ) ),
                Field::make( 'text', 'home_journal_cta_label', __( 'CTA - texto', 'understrap' ) ),
                Field::make( 'text', 'home_journal_cta_url', __( 'CTA - URL', 'understrap' ) ),
                Field::make( 'text', 'crb_home_journal_title', __( 'Título magazine', 'understrap' ) )
                    ->set_default_value( __( 'Reflexiones clínicas', 'understrap' ) ),
                Field::make( 'association', 'crb_home_featured_posts', __( 'Artículos destacados', 'understrap' ) )
                    ->set_max( 3 )
                    ->set_types(
                        array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'post',
                            ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Newsletter', 'understrap' ),
            array(
                Field::make( 'text', 'home_newsletter_eyebrow', __( 'Etiqueta', 'understrap' ) ),
                Field::make( 'text', 'home_newsletter_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'home_newsletter_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'text', 'home_newsletter_placeholder', __( 'Placeholder del email', 'understrap' ) ),
                Field::make( 'text', 'home_newsletter_button', __( 'Texto del botón', 'understrap' ) ),
                Field::make( 'text', 'home_newsletter_shortcode', __( 'Shortcode alternativo', 'understrap' ) )
                    ->set_help_text( __( 'Si se completa, se mostrará el shortcode en lugar del formulario estático.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Colección destacada', 'understrap' ),
            array(
                Field::make( 'text', 'crb_home_featured_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Esenciales Kapunka', 'understrap' ) ),
                Field::make( 'association', 'crb_home_featured_products', __( 'Productos destacados', 'understrap' ) )
                    ->set_max( 4 )
                    ->set_types(
                        array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'product',
                            ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Testimonios B2B', 'understrap' ),
            array(
                Field::make( 'complex', 'crb_home_testimonials', __( 'Testimonios', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'textarea', 'crb_home_testimonial_quote', __( 'Cita', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'text', 'crb_home_testimonial_author', __( 'Autor', 'understrap' ) ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'crb_home_testimonial_quote'  => __( '“Kapunka elevó la experiencia post-láser: la piel queda flexible y sin ardor en minutos.”', 'understrap' ),
                                'crb_home_testimonial_author' => __( '— Dra. Martínez, Clínica Regeneris', 'understrap' ),
                            ),
                            array(
                                'crb_home_testimonial_quote'  => __( '“Nuestros rituales corporales ganaron textura y olor firma sin sacrificar resultados clínicos.”', 'understrap' ),
                                'crb_home_testimonial_author' => __( '— Sarah L., Directora Wellness, Hotel Arts', 'understrap' ),
                            ),
                        )
                    ),
            )
        );

    // -------------------------
    // Tienda page
    // -------------------------
    Container::make( 'post_meta', __( 'Tienda Kapunka', 'understrap' ) )
        ->where( 'post_template', '=', 'page-tienda.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'text', 'tienda_hero_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'tienda_hero_title', __( 'Título', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'textarea', 'tienda_hero_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'text', 'tienda_hero_primary_label', __( 'CTA principal - texto', 'understrap' ) ),
                Field::make( 'text', 'tienda_hero_primary_url', __( 'CTA principal - URL', 'understrap' ) ),
                Field::make( 'text', 'tienda_hero_secondary_label', __( 'CTA secundaria - texto', 'understrap' ) ),
                Field::make( 'text', 'tienda_hero_secondary_url', __( 'CTA secundaria - URL', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Componentes', 'understrap' ),
            array(
                Field::make( 'complex', 'tienda_componentes', __( 'Bloques', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields( 'cta', __( 'CTA', 'understrap' ), kapunka_cf_cta_fields() )
                    ->add_fields( 'testimonials', __( 'Testimonios', 'understrap' ), kapunka_cf_testimonials_fields() )
                    ->add_fields( 'newsletter', __( 'Newsletter', 'understrap' ), kapunka_cf_newsletter_fields() )
                    ->add_fields( 'faq', __( 'FAQ', 'understrap' ), kapunka_cf_faq_fields() ),
            )
        )
        ->add_tab(
            __( 'Banner y pilares', 'understrap' ),
            array(
                Field::make( 'image', 'tienda_banner_image', __( 'Imagen del banner', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'image', 'crb_tienda_visual_banner', __( 'Visual full-bleed', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'complex', 'tienda_trinity_items', __( 'Pilares', 'understrap' ) )
                    ->set_max( 3 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
                Field::make( 'complex', 'crb_tienda_trinity', __( 'Pilares (nuevo)', 'understrap' ) )
                    ->set_max( 3 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'crb_tienda_trinity_headline', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'crb_tienda_trinity_body', __( 'Descripción', 'understrap' ) ),
                        )
                    )
                    ->set_default_value(
                        array(
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
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Filtros', 'understrap' ),
            array(
                Field::make( 'checkbox', 'tienda_filters_enabled', __( 'Mostrar bloque de filtros', 'understrap' ) )
                    ->set_option_value( 'yes' )
                    ->set_default_value( 'yes' ),
                Field::make( 'complex', 'tienda_filter_categories', __( 'Categorías del filtro', 'understrap' ) )
                    ->set_max( 4 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'label', __( 'Etiqueta', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'text', 'slug', __( 'Slug de categoría', 'understrap' ) )
                                ->set_help_text( __( 'Usa "todo" para el filtro global o el slug de la categoría de producto.', 'understrap' ) )
                                ->set_required( true ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'label' => __( 'Todo', 'understrap' ),
                                'slug'  => 'todo',
                            ),
                            array(
                                'label' => __( 'Rostro', 'understrap' ),
                                'slug'  => 'rostro',
                            ),
                            array(
                                'label' => __( 'Cuerpo', 'understrap' ),
                                'slug'  => 'cuerpo',
                            ),
                            array(
                                'label' => __( 'Packs', 'understrap' ),
                                'slug'  => 'packs',
                            ),
                        )
                    ),
            )
        );

    // -------------------------
    // Profesionales page
    // -------------------------
    Container::make( 'post_meta', __( 'Profesionales', 'understrap' ) )
        ->where( 'post_template', '=', 'page-profesionales.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'text', 'crb_pro_hero_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'DIVISIÓN PROFESIONAL', 'understrap' ) ),
                Field::make( 'text', 'crb_pro_hero_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Eleve sus protocolos estéticos.', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'text', 'crb_pro_hero_subtitle', __( 'Subtítulo', 'understrap' ) )
                    ->set_default_value( __( 'Línea exclusiva de alto rendimiento para clínicas, spas de lujo y hoteles. Incluye formación técnica de nuestro método.', 'understrap' ) ),
                Field::make( 'image', 'crb_pro_hero_image', __( 'Imagen destacada', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Propuesta de Valor', 'understrap' ),
            array(
                Field::make( 'complex', 'crb_pro_value_grid', __( 'Grid 2x2', 'understrap' ) )
                    ->set_max( 4 )
                    ->add_fields(
                        array(
                            Field::make( 'image', 'crb_pro_value_image', __( 'Imagen', 'understrap' ) )
                                ->set_value_type( 'id' )
                                ->set_required( true ),
                            Field::make( 'text', 'crb_pro_value_headline', __( 'Titular', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'crb_pro_value_body', __( 'Descripción', 'understrap' ) ),
                        )
                    )
                    ->set_default_value(
                        array(
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
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Beneficios', 'understrap' ),
            array(
                Field::make( 'text', 'profesionales_benefits_title', __( 'Título', 'understrap' ) ),
                Field::make( 'complex', 'profesionales_benefits', __( 'Beneficios', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    )
                    ->set_default_value(
                        array(
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
                        )
                    ),
                Field::make( 'image', 'beneficios_background', __( 'Imagen de fondo de beneficios', 'understrap' ) )
                    ->set_value_type( 'url' ),
                Field::make( 'complex', 'valor_propuesta_items', __( 'Valor Propuesta (2x2)', 'understrap' ) )
                    ->set_max( 4 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'headline', __( 'Titular', 'understrap' ) ),
                            Field::make( 'textarea', 'body', __( 'Descripción', 'understrap' ) ),
                            Field::make( 'image', 'background', __( 'Imagen de fondo', 'understrap' ) )
                                ->set_value_type( 'url' ),
                        )
                    )
                    ->set_default_value(
                        array(
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
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Testimonios / FAQ / Formulario', 'understrap' ),
            array(
                Field::make( 'complex', 'profesionales_testimonios', __( 'Testimonios', 'understrap' ) )
                    ->add_fields( kapunka_cf_single_testimonial_fields() ),
                Field::make( 'text', 'profesionales_faq_title', __( 'Título FAQ', 'understrap' ) ),
                Field::make( 'complex', 'profesionales_faq_items', __( 'Preguntas frecuentes', 'understrap' ) )
                    ->add_fields( kapunka_cf_single_faq_fields() ),
                Field::make( 'text', 'crb_pro_form_headline', __( 'Título del formulario', 'understrap' ) )
                    ->set_default_value( __( 'Solicitar acceso', 'understrap' ) ),
                Field::make( 'textarea', 'crb_pro_form_body', __( 'Descripción del formulario', 'understrap' ) )
                    ->set_default_value( __( 'Envíe su solicitud para acceder a nuestra plataforma profesional, fichas técnicas y precios de cabina.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Kit y Onboarding', 'understrap' ),
            array(
                Field::make( 'text', 'crb_pro_kit_eyebrow', __( 'Texto superior del kit', 'understrap' ) )
                    ->set_default_value( __( 'Kit profesional', 'understrap' ) ),
                Field::make( 'text', 'crb_pro_kit_headline', __( 'Título del kit', 'understrap' ) )
                    ->set_default_value( __( 'Maletín con botellas, goteros, manual técnico y fichas impresas.', 'understrap' ) ),
                Field::make( 'textarea', 'crb_pro_kit_body', __( 'Descripción del kit', 'understrap' ) ),
                Field::make( 'complex', 'profesionales_kit_bullets', __( 'Puntos destacados del kit', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'item', __( 'Elemento', 'understrap' ) )
                                ->set_required( true ),
                        )
                    ),
                Field::make( 'image', 'crb_pro_kit_image', __( 'Imagen del kit', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'complex', 'profesionales_onboarding_steps', __( 'Pasos de onboarding', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Componentes extra', 'understrap' ),
            array(
                Field::make( 'complex', 'profesionales_componentes', __( 'Bloques', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields( 'cta', __( 'CTA', 'understrap' ), kapunka_cf_cta_fields() ),
            )
        );

    // -------------------------
    // Sobre nosotros page
    // -------------------------
    Container::make( 'post_meta', __( 'Sobre nosotros', 'understrap' ) )
        ->where( 'post_template', '=', 'page-sobre-nosotros.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_hero_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'sobre_hero_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_hero_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'image', 'sobre_hero_background', __( 'Imagen de fondo', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Editorial', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_editorial_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'sobre_editorial_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_editorial_intro', __( 'Introducción', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_editorial_body', __( 'Texto principal', 'understrap' ) ),
                Field::make( 'image', 'sobre_editorial_image', __( 'Imagen', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Carta', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_carta_titulo', __( 'Título carta', 'understrap' ) ),
                Field::make( 'rich_text', 'sobre_carta_texto', __( 'Texto carta', 'understrap' ) ),
                Field::make( 'image', 'sobre_carta_imagen', __( 'Imagen carta', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Misión y Visión', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_mision_heading', __( 'Título bloque misión', 'understrap' ) )
                    ->set_default_value( __( 'Misión', 'understrap' ) ),
                Field::make( 'text', 'sobre_mision_subheading', __( 'Subtítulo misión', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_mision', __( 'Contenido misión', 'understrap' ) ),
                Field::make( 'text', 'sobre_vision_heading', __( 'Título bloque visión', 'understrap' ) )
                    ->set_default_value( __( 'Visión', 'understrap' ) ),
                Field::make( 'text', 'sobre_vision_subheading', __( 'Subtítulo visión', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_vision', __( 'Contenido visión', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Impacto', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_impacto_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'sobre_impacto_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_impacto', __( 'Descripción', 'understrap' ) ),
                Field::make( 'complex', 'sobre_impact_stats', __( 'Estadísticas', 'understrap' ) )
                    ->set_max( 3 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'value', __( 'Valor', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'text', 'label', __( 'Etiqueta', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Historia', 'understrap' ),
            array(
                Field::make( 'complex', 'sobre_story', __( 'Bloques de historia', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                            Field::make( 'image', 'image', __( 'Imagen', 'understrap' ) )
                                ->set_value_type( 'id' ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Fundadora', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_founder_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_founder_bio', __( 'Biografía', 'understrap' ) ),
                Field::make( 'image', 'sobre_founder_image', __( 'Imagen', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Valores', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_values_title', __( 'Título', 'understrap' ) ),
                Field::make( 'complex', 'sobre_values_items', __( 'Valores', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Cooperativas', 'understrap' ),
            array(
                Field::make( 'text', 'sobre_cooperativas_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'sobre_cooperativas_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'complex', 'sobre_cooperativas_items', __( 'Bloques', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
                Field::make( 'complex', 'sobre_componentes', __( 'Componentes extra', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields( 'cta', __( 'CTA', 'understrap' ), kapunka_cf_cta_fields() )
                    ->add_fields( 'newsletter', __( 'Newsletter', 'understrap' ), kapunka_cf_newsletter_fields() ),
            )
        );

    // -------------------------
    // Contacto page
    // -------------------------
    Container::make( 'post_meta', __( 'Contacto', 'understrap' ) )
        ->where( 'post_template', '=', 'page-contacto.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'text', 'contacto_hero_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'Contacto directo', 'understrap' ) ),
                Field::make( 'text', 'contacto_hero_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Hablemos de tu ritual o de tu cabina.', 'understrap' ) ),
                Field::make( 'textarea', 'contacto_intro', __( 'Descripción', 'understrap' ) )
                    ->set_default_value( __( 'Responderemos en menos de 24h hábiles. Para soporte de pedidos indica tu número de orden.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Datos', 'understrap' ),
            array(
                Field::make( 'complex', 'contacto_details', __( 'Datos de contacto', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'label', __( 'Etiqueta', 'understrap' ) ),
                            Field::make( 'textarea', 'entry_value', __( 'Valor / HTML', 'understrap' ) )
                                ->set_help_text( __( 'Puedes usar HTML para enlaces.', 'understrap' ) ),
                        )
                    ),
                Field::make( 'complex', 'contacto_cta', __( 'CTA lateral', 'understrap' ) )
                    ->set_max( 1 )
                    ->add_fields( kapunka_cf_cta_fields() ),
            )
        )
        ->add_tab(
            __( 'Formulario', 'understrap' ),
            array(
                Field::make( 'text', 'contacto_form_shortcode', __( 'Shortcode de formulario', 'understrap' ) )
                    ->set_help_text( __( 'Ejemplo: [contact-form-7 id="123"]', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'CTA final', 'understrap' ),
            array(
                Field::make( 'text', 'contacto_final_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( '¿Listo para el siguiente paso?', 'understrap' ) ),
                Field::make( 'text', 'contacto_final_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Solicita tu onboarding clínico o descubre los rituales para casa.', 'understrap' ) ),
                Field::make( 'text', 'contacto_final_primary_label', __( 'Enlace primario - texto', 'understrap' ) )
                    ->set_default_value( __( 'Acceso profesional', 'understrap' ) ),
                Field::make( 'text', 'contacto_final_primary_url', __( 'Enlace primario - URL', 'understrap' ) )
                    ->set_default_value( home_url( '/profesionales' ) ),
                Field::make( 'text', 'contacto_final_secondary_label', __( 'Enlace secundario - texto', 'understrap' ) )
                    ->set_default_value( __( 'Rituales para casa', 'understrap' ) ),
                Field::make( 'text', 'contacto_final_secondary_url', __( 'Enlace secundario - URL', 'understrap' ) )
                    ->set_default_value( home_url( '/tienda' ) ),
            )
        );

    // -------------------------
    // El Origen page
    // -------------------------
    $origen_letter_default = <<<'HTML'
<p>Hola, soy Mónica Ruiz Borrego, fundadora de Kapunka. Quiero contarte cómo nació esta aventura, que en el fondo es una historia de agradecimiento, pasión por el cuidado de los demás y amor por lo natural.</p>
<p>Nací en 1979 en un pueblo de Barcelona, y desde siempre supe que lo mío era ayudar a las personas. Estudié enfermería y me especialicé en quiromasaje terapéutico. Durante años trabajé codo a codo con grandes médicos y atletas de alto rendimiento, aprendiendo cada día sobre el cuerpo humano y sus necesidades. Vi de cerca cómo la piel de quienes pasan por cirugías, lesiones o tratamientos agresivos sufre y necesita un cuidado especial. También noté que en esos momentos delicados (post-operatorios, enfermedades de la piel, incluso cambios de clima o estrés) muchas veces la gente no tenía a mano un producto realmente puro, seguro y efectivo para aliviar su piel. Sigo ampliando mi formación profesional: actualmente soy estudiante de Medicina, profundizando en la teoría clínica y la bioquímica del argán puro que compartimos en el Método Kapunka y en su programa intensivo para profesionales.</p>
<p>Con el tiempo, fui recopilando conocimientos, remedios tradicionales y evidencia científica, siempre con una idea en mente: “¿Y si pudiera ofrecer a todos un cuidado natural, tan eficaz como el médico pero sin efectos secundarios?”. Esa semilla se convirtió en mi proyecto de vida.</p>
<p>Mi primer viaje a Marruecos fue revelador. Allí conecté con comunidades locales que llevaban siglos usando el aceite de argán para la salud de la piel. Pude ver cómo extraían manualmente ese “oro líquido” de la naturaleza, con paciencia y cariño. Y comprobé en persona sus beneficios casi milagrosos en pieles secas, con eczemas, cicatrices... ¡Funcionaba! En ese momento sentí una certeza: éste era el regalo que quería llevar al mundo.</p>
<p>Así nació Kapunka, que significa “gracias” en tailandés. Escogí ese nombre porque resume todo en lo que creo. Para mí, la gratitud es la base de la vida: dar gracias por lo que tenemos y devolver un poco de lo que recibimos. Kapunka es mi forma de dar las gracias a la naturaleza, por este aceite único; a mis pacientes, por inspirarme a crear algo mejor para ellos; y a todas las personas que confían en nosotros, ofreciendo a cambio calidad y honestidad.</p>
<p>Comencé formulando el aceite de argán Kapunka con un objetivo innegociable: ofrecer el mejor producto de argán del mundo, con la más alta pureza y calidad porque todos nos merecemos lo mejor para nuestra salud. Sin químicos, sin trucos, sin efectos secundarios. Sólo algo 100% natural que pudiera usar toda la familia, desde un bebé hasta una persona mayor, y que realmente marcara la diferencia en la piel.</p>
<p>Hoy, varios años después, Kapunka es una realidad hermosa. Somos una empresa dedicada en exclusiva al aceite de argán puro, con estudios científicos de más de 35 años que respaldan sus propiedades excepcionales. Hemos construido un equipo de profesionales apasionados que comparten esta visión.</p>
<p>Nuestra misión es llevar Kapunka a cualquier parte del mundo donde alguien necesite cuidar su piel, su cabello o sus uñas con total confianza.</p>
<p>Nuestros valores nos guían en cada paso: valoramos la Confianza por encima de todo; toda la confianza que nos das al ponerte nuestro aceite en la piel la devolvemos con transparencia y calidad absoluta. Creemos en el Esfuerzo y la Disciplina: desde la meticulosa recolección de cada nuez de argán hasta la formación de profesionales en el Método Kapunka, ponemos dedicación y rigor en cada detalle. Practicamos el Compromiso: con tu bienestar, con la comunidad que produce nuestro aceite y con el medio ambiente. Y, por supuesto, Agradecimiento: nunca olvidamos dar gracias - a nuestros clientes, a nuestros colaboradores y a la Madre Tierra que nos brinda este tesoro.</p>
<p>“Quien tiene la oportunidad de cambiar las cosas, tiene la obligación de hacer lo posible.” - Esta frase me ha inspirado siempre. En Kapunka la hacemos realidad poniendo nuestro granito de arena para cambiar la forma en que cuidamos la piel: con respeto, con amor y con gratitud.</p>
<p>Gracias de corazón por leer mi historia y por confiar en Kapunka. Te invito a que formes parte de nuestra familia: cuando uses nuestro aceite, estás abrazando años de tradición, ciencia y cariño embotellados para ti.</p>
<p>Un fuerte abrazo,</p>
<p>Mónica - Fundadora de Kapunka</p>
HTML;

    Container::make( 'post_meta', __( 'El Origen', 'understrap' ) )
        ->where( 'post_template', '=', 'page-el-origen.php' )
        ->or_where( 'post_template', '=', 'page-origen.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'image', 'crb_origen_hero_image', __( 'Imagen de fondo', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'text', 'crb_origen_hero_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'De la tierra al tacto.', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'text', 'crb_origen_hero_subtitle', __( 'Subtítulo', 'understrap' ) )
                    ->set_default_value( __( 'La búsqueda de Mónica Ruiz por el argán más puro del mundo.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Magazine Highlights', 'understrap' ),
            array(
                Field::make( 'image', 'crb_origen_highlights_image', __( 'Imagen principal', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'media_gallery', 'crb_origen_highlights_gallery', __( 'Galería de Mónica', 'understrap' ) )
                    ->set_type( 'image' )
                    ->set_help_text( __( 'Opcional: selecciona varias imágenes para crear un slideshow en el bloque de highlights.', 'understrap' ) ),
                Field::make( 'complex', 'crb_origen_highlights_repeater', __( 'Destacados', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'textarea', 'crb_origen_highlight_text', __( 'Texto destacado', 'understrap' ) )
                                ->set_required( true ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'crb_origen_highlight_text' => __( 'Como enfermera y quiromasajista, entendí que la piel dañada no solo necesita química, necesita nutrición fundamental.', 'understrap' ),
                    ),
                        array(
                                'crb_origen_highlight_text' => __( 'Así nació Kapunka, que significa “gracias” en tailandés. Es mi forma de dar las gracias a la naturaleza, a mis pacientes y a todas las personas que confían en nosotros.', 'understrap' ),
                            ),
                            array(
                                'crb_origen_highlight_text' => __( 'Ofrecer el mejor producto... con la más alta pureza y calidad... sin químicos, sin trucos, sin efectos secundarios. Sólo algo 100% natural.', 'understrap' ),
                            ),
                        )
                    ),
                Field::make( 'text', 'crb_origen_full_letter_link_text', __( 'Texto del enlace', 'understrap' ) )
                    ->set_default_value( __( 'Leer la carta completa de Mónica →', 'understrap' ) ),
                Field::make( 'rich_text', 'crb_origen_full_letter_modal_content', __( 'Contenido modal', 'understrap' ) )
                    ->set_default_value( $origen_letter_default ),
            )
        )
        ->add_tab(
            __( 'Visual Interlude', 'understrap' ),
            array(
                Field::make( 'image', 'crb_origen_interlude_image', __( 'Imagen interludio', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'media_gallery', 'crb_origen_interlude_gallery', __( 'Galería interludio', 'understrap' ) )
                    ->set_type( 'image' )
                    ->set_help_text( __( 'Selecciona varias imágenes para el pase de diapositivas. Se mostrarán en el orden elegido.', 'understrap' ) ),
                Field::make( 'text', 'crb_origen_interlude_caption', __( 'Leyenda', 'understrap' ) )
                    ->set_default_value( __( 'Una historia de confluencia sanitaria.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Valores', 'understrap' ),
            array(
                Field::make( 'complex', 'crb_origen_valores_grid', __( 'Valores', 'understrap' ) )
                    ->set_max( 4 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'crb_origen_valor_title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'crb_origen_valor_text', __( 'Descripción', 'understrap' ) ),
                        )
            )
                    ->set_default_value(
            array(
                        array(
                                'crb_origen_valor_title' => __( 'Confianza', 'understrap' ),
                                'crb_origen_valor_text'  => __( 'Honestidad y calidad absoluta en todo lo que hacemos. Nos avalan pruebas científicas y la satisfacción de nuestros clientes.', 'understrap' ),
                            ),
            array(
                                'crb_origen_valor_title' => __( 'Esfuerzo & Excelencia', 'understrap' ),
                                'crb_origen_valor_text'  => __( 'No escatimamos en esfuerzos para lograr la máxima pureza y eficacia. Desde la cosecha manual hasta las pruebas de laboratorio, perseguimos la excelencia.', 'understrap' ),
                            ),
                        array(
                                'crb_origen_valor_title' => __( 'Compromiso', 'understrap' ),
                                'crb_origen_valor_text'  => __( 'Con tu piel y tu salud, con nuestro equipo y colaboradores, y con el entorno. Cumplimos lo que prometemos y nos regimos por la ética.', 'understrap' ),
                            ),
                            array(
                                'crb_origen_valor_title' => __( 'Agradecimiento', 'understrap' ),
                                'crb_origen_valor_text'  => __( 'El valor que dio origen a todo. Agradecemos la confianza de cada cliente retribuyéndola con calidad. Agradecemos a la naturaleza cuidándola.', 'understrap' ),
                            ),
                        )
                    ),
            )
        );

    // -------------------------
    // Método Kapunka page
    // -------------------------
    Container::make( 'post_meta', __( 'Método Kapunka', 'understrap' ) )
        ->where( 'post_template', '=', 'page-metodo-kapunka.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'file', 'kapunka_metodo_hero_media', __( 'Medio del hero (imagen o video)', 'understrap' ) )
                    ->set_value_type( 'url' )
                    ->set_default_value( 'story-image.jpg' )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_metodo_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'Formación exclusiva', 'understrap' ) )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_metodo_title', __( 'Título principal', 'understrap' ) )
                    ->set_default_value( __( 'Formación Kapunka — Certifícate Kapunka Pro', 'understrap' ) )
                    ->set_required( true )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_metodo_subtitle', __( 'Subtítulo', 'understrap' ) )
                    ->set_default_value( __( 'La técnica detrás del producto. Formación práctica para su equipo y certificación oficial.', 'understrap' ) )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_metodo_alt_text_hero', __( 'Texto alternativo para hero', 'understrap' ) )
                    ->set_default_value( __( 'Sesión de formación Kapunka — terapeuta en práctica.', 'understrap' ) )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                // Keep legacy fields for backward compatibility
                Field::make( 'text', 'metodo_hero_eyebrow', __( 'Eyebrow (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_hero_title', __( 'Título (legacy)', 'understrap' ) ),
                Field::make( 'textarea', 'metodo_hero_description', __( 'Descripción (legacy)', 'understrap' ) ),
                Field::make( 'image', 'metodo_hero_image', __( 'Imagen destacada (legacy)', 'understrap' ) )
                    ->set_value_type( 'url' ),
            )
        )
        ->add_tab(
            __( 'Programa', 'understrap' ),
            array(
                Field::make( 'textarea', 'kapunka_metodo_syllabus', __( 'Syllabus completo', 'understrap' ) )
                    ->set_default_value( __( "Teoría — Bioquímica del Argán puro. Control sensorial, estabilidad y trazabilidad.\n\nPráctica — Masaje facial de remonte (lifting natural) y maniobras corporales combinadas.\n\nCertificación — Examen práctico y diploma oficial Kapunka con sello 'Método Kapunka autorizado'.", 'understrap' ) )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_metodo_duration', __( 'Duración del programa', 'understrap' ) )
                    ->set_default_value( __( 'Programa intensivo de dos jornadas. Online + taller práctico.', 'understrap' ) )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                // Keep legacy fields for backward compatibility
                Field::make( 'text', 'metodo_syllabus_eyebrow', __( 'Eyebrow (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_syllabus_title', __( 'Título (legacy)', 'understrap' ) ),
                Field::make( 'complex', 'metodo_syllabus_items', __( 'Etapas del programa (legacy)', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'headline', __( 'Título corto', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Badge', 'understrap' ),
            array(
                Field::make( 'file', 'kapunka_metodo_badge_image', __( 'Imagen del badge', 'understrap' ) )
                    ->set_value_type( 'url' )
                    ->set_default_value( 'Kapunka-plate-Autorizado.png' )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_metodo_badge_text', __( 'Texto del badge', 'understrap' ) )
                    ->set_default_value( __( "Badge oficial: 'Método Kapunka autorizado'.", 'understrap' ) )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                // Keep legacy fields for backward compatibility
                Field::make( 'text', 'metodo_badge_eyebrow', __( 'Eyebrow (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_badge_title', __( 'Título (legacy)', 'understrap' ) ),
                Field::make( 'textarea', 'metodo_badge_description', __( 'Descripción (legacy)', 'understrap' ) ),
                Field::make( 'image', 'metodo_badge_image', __( 'Imagen del badge (legacy)', 'understrap' ) )
                    ->set_value_type( 'url' ),
            )
        )
        ->add_tab(
            __( 'Formulario', 'understrap' ),
            array(
                Field::make( 'text', 'kapunka_metodo_apply_cta_text', __( 'Texto del botón CTA', 'understrap' ) )
                    ->set_default_value( __( 'Solicitar información', 'understrap' ) )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_metodo_apply_form_fields', __( 'Campos del formulario (JSON)', 'understrap' ) )
                    ->set_default_value( '{"fields":["nombre_completo","clinica_centro","correo_profesional","telefono_whatsapp","comentarios"]}' )
                    ->set_help_text( __( 'Formato JSON. No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_metodo_form_email_recipient', __( 'Email destinatario', 'understrap' ) )
                    ->set_default_value( 'pro@kapunkargan.com' )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_metodo_crm_tag', __( 'Tag CRM', 'understrap' ) )
                    ->set_default_value( 'Training_Request' )
                    ->set_help_text( __( 'No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                Field::make( 'file', 'kapunka_metodo_pdf_link', __( 'PDF (opcional)', 'understrap' ) )
                    ->set_value_type( 'url' )
                    ->set_help_text( __( 'Opcional: subir PDF si está disponible. No duplicar — mantenimiento: Página Método Kapunka.', 'understrap' ) ),
                // Keep legacy fields for backward compatibility
                Field::make( 'text', 'metodo_lead_eyebrow', __( 'Eyebrow (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_lead_title', __( 'Título (legacy)', 'understrap' ) ),
                Field::make( 'textarea', 'metodo_lead_description', __( 'Descripción (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_lead_name_label', __( 'Etiqueta — Nombre completo (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_lead_clinic_label', __( 'Etiqueta — Clínica o centro (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_lead_email_label', __( 'Etiqueta — Correo profesional (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_lead_phone_label', __( 'Etiqueta — Teléfono / WhatsApp (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_lead_comments_label', __( 'Etiqueta — Comentarios (legacy)', 'understrap' ) ),
                Field::make( 'text', 'metodo_lead_button_label', __( 'Texto del botón (legacy)', 'understrap' ) ),
            )
        );

    // -------------------------
    // Aprende page
    // -------------------------
    Container::make( 'post_meta', __( 'Aprende', 'understrap' ) )
        ->where( 'post_template', '=', 'page-aprende.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'checkbox', 'aprende_hero_background_enabled', __( 'Activar imagen de fondo en hero', 'understrap' ) )
                    ->set_option_value( 'yes' )
                    ->set_help_text( __( 'Activa o desactiva la imagen de fondo del hero. Mantenimiento: Página Journal.', 'understrap' ) ),
                Field::make( 'image', 'aprende_hero_background_image', __( 'Imagen de fondo del hero', 'understrap' ) )
                    ->set_value_type( 'id' )
                    ->set_help_text( __( 'Se mostrará solo si la opción anterior está activada. Mantenimiento: Página Journal.', 'understrap' ) ),
                Field::make( 'text', 'aprende_hero_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'aprende_hero_title', __( 'Título', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'textarea', 'aprende_hero_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'text', 'aprende_hero_primary_label', __( 'CTA principal - texto', 'understrap' ) ),
                Field::make( 'text', 'aprende_hero_primary_url', __( 'CTA principal - URL', 'understrap' ) ),
                Field::make( 'text', 'aprende_hero_secondary_label', __( 'CTA secundaria - texto', 'understrap' ) ),
                Field::make( 'text', 'aprende_hero_secondary_url', __( 'CTA secundaria - URL', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Artículos', 'understrap' ),
            array(
                Field::make( 'text', 'aprende_destacados_title', __( 'Título destacados', 'understrap' ) ),
                Field::make( 'text', 'aprende_destacados_description', __( 'Descripción destacados', 'understrap' ) ),
                Field::make( 'association', 'aprende_destacados', __( 'Artículos destacados', 'understrap' ) )
                    ->set_types(
                        array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'post',
                            ),
                        )
                    )
                    ->set_max( 4 ),
                Field::make( 'text', 'aprende_listado_title', __( 'Título listado general', 'understrap' ) ),
                Field::make( 'text', 'aprende_listado_description', __( 'Descripción listado general', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Colecciones', 'understrap' ),
            array(
                Field::make( 'complex', 'aprende_collections', __( 'Colecciones destacadas', 'understrap' ) )
                    ->set_max( 4 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'CTA Profesional', 'understrap' ),
            array(
                Field::make( 'text', 'aprende_cta_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'aprende_cta_title', __( 'Título', 'understrap' ) ),
                Field::make( 'text', 'aprende_cta_button_label', __( 'CTA - texto', 'understrap' ) ),
                Field::make( 'text', 'aprende_cta_button_url', __( 'CTA - URL', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Newsletter', 'understrap' ),
            array(
                Field::make( 'text', 'aprende_newsletter_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'aprende_newsletter_title', __( 'Título', 'understrap' ) ),
                Field::make( 'textarea', 'aprende_newsletter_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'text', 'aprende_newsletter_placeholder', __( 'Placeholder del email', 'understrap' ) ),
                Field::make( 'text', 'aprende_newsletter_button', __( 'Texto del botón', 'understrap' ) ),
                Field::make( 'text', 'aprende_newsletter_shortcode', __( 'Shortcode alternativo', 'understrap' ) )
                    ->set_help_text( __( 'Si se completa, se mostrará el formulario del shortcode en lugar del formulario estático.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Componentes extra', 'understrap' ),
            array(
                Field::make( 'complex', 'aprende_componentes', __( 'Bloques', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields( 'cta', __( 'CTA', 'understrap' ), kapunka_cf_cta_fields() )
                    ->add_fields( 'newsletter', __( 'Newsletter', 'understrap' ), kapunka_cf_newsletter_fields() )
                    ->add_fields( 'faq', __( 'FAQ', 'understrap' ), kapunka_cf_faq_fields() ),
            )
        );

    // -------------------------
    // Nuestro Aceite de Argán
    // -------------------------
    Container::make( 'post_meta', __( 'Nuestro Aceite de Argán', 'understrap' ) )
        ->where( 'post_template', '=', 'page-aceite.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'text', 'aceite_hero_eyebrow', __( 'Eyebrow', 'understrap' ) ),
                Field::make( 'text', 'aceite_hero_title', __( 'Título', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'textarea', 'aceite_hero_description', __( 'Descripción', 'understrap' ) ),
                Field::make( 'image', 'aceite_hero_background', __( 'Imagen de fondo', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Secciones', 'understrap' ),
            array(
                Field::make( 'complex', 'aceite_sections', __( 'Bloques', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'copy', __( 'Contenido', 'understrap' ) ),
                            Field::make( 'image', 'image', __( 'Imagen opcional', 'understrap' ) )
                                ->set_value_type( 'id' ),
                        )
                    ),
            )
        );

    // -------------------------
    // Blog posts
    // -------------------------
    Container::make( 'post_meta', __( 'Artículo Kapunka', 'understrap' ) )
        ->where( 'post_type', '=', 'post' )
        ->add_fields(
            array(
                Field::make( 'text', 'tiempo_de_lectura', __( 'Tiempo de lectura', 'understrap' ) ),
                Field::make( 'text', 'autor_nombre', __( 'Autor', 'understrap' ) ),
                Field::make( 'text', 'autor_rol', __( 'Rol del autor', 'understrap' ) ),
                Field::make( 'textarea', 'autor_notas', __( 'Notas / credenciales', 'understrap' ) ),
                Field::make( 'complex', 'tabla_contenidos', __( 'Tabla de contenidos', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'label', __( 'Etiqueta', 'understrap' ) ),
                            Field::make( 'text', 'anchor', __( 'Ancla (ej. #beneficios)', 'understrap' ) ),
                        )
                    ),
                Field::make( 'complex', 'referencias_cientificas', __( 'Referencias científicas', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) ),
                            Field::make( 'text', 'journal', __( 'Medio / journal', 'understrap' ) ),
                            Field::make( 'text', 'year', __( 'Año', 'understrap' ) ),
                            Field::make( 'text', 'link', __( 'URL', 'understrap' ) ),
                        )
                    ),
                Field::make( 'association', 'productos_relacionados', __( 'Productos relacionados', 'understrap' ) )
                    ->set_types(
                        array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'product',
                            ),
                        )
                    )
                    ->set_max( 6 ),
                Field::make( 'association', 'articulos_relacionados', __( 'Artículos relacionados', 'understrap' ) )
                    ->set_types(
                        array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'post',
                            ),
                        )
                    )
                    ->set_max( 6 ),
            )
        );

    // -------------------------
    // Productos WooCommerce
    // -------------------------
    Container::make( 'post_meta', __( 'Detalle de producto', 'understrap' ) )
        ->where( 'post_type', '=', 'product' )
        ->add_fields(
            array(
                Field::make( 'complex', 'ingredientes', __( 'Ingredientes', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'item', __( 'Ingrediente', 'understrap' ) ),
                        )
                    ),
                Field::make( 'complex', 'beneficios', __( 'Beneficios y usos', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'item', __( 'Elemento', 'understrap' ) ),
                        )
                    ),
                Field::make( 'textarea', 'instrucciones', __( 'Modo de uso', 'understrap' ) ),
                Field::make( 'complex', 'certificaciones', __( 'Certificaciones', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'item', __( 'Etiqueta', 'understrap' ) ),
                        )
                    ),
                Field::make( 'complex', 'producto_faq_items', __( 'Preguntas frecuentes', 'understrap' ) )
                    ->add_fields( kapunka_cf_single_faq_fields() ),
                Field::make( 'text', 'producto_faq_title', __( 'Título FAQ', 'understrap' ) ),
                Field::make( 'complex', 'producto_cta', __( 'CTA relacionada', 'understrap' ) )
                    ->set_max( 1 )
                    ->add_fields( kapunka_cf_cta_fields() ),
                Field::make( 'association', 'producto_articulos_relacionados', __( 'Artículos relacionados', 'understrap' ) )
                    ->set_types(
                        array(
                            array(
                                'type'      => 'post',
                                'post_type' => 'post',
                            ),
                        )
                    )
                    ->set_max( 4 ),
            )
        );

    // -------------------------
    // Clinicas page
    // -------------------------
    Container::make( 'post_meta', __( 'Clinicas', 'understrap' ) )
        ->where( 'post_template', '=', 'page-clinicas.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'text', 'clinicas_hero_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'Clínicas & Dermatología', 'understrap' ) ),
                Field::make( 'text', 'clinicas_hero_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Rigor en la recuperación cutánea.', 'understrap' ) ),
                Field::make( 'textarea', 'clinicas_hero_description', __( 'Descripción', 'understrap' ) )
                    ->set_default_value( __( 'Argán 100% BIO de primera prensada en frío. El coadyuvante natural para sus protocolos dermatológicos más exigentes.', 'understrap' ) ),
                Field::make( 'image', 'clinicas_hero_image', __( 'Imagen', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Valor Propuesta', 'understrap' ),
            array(
                Field::make( 'complex', 'clinicas_valor_propuesta', __( 'Tarjetas de valor', 'understrap' ) )
                    ->set_max( 4 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'headline', __( 'Titular', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'body', __( 'Descripción', 'understrap' ) ),
                            Field::make( 'image', 'background', __( 'Imagen de fondo', 'understrap' ) )
                                ->set_value_type( 'url' ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Antes y Después', 'understrap' ),
            array(
                Field::make( 'text', 'clinicas_beforeafter_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'Validación clínica', 'understrap' ) ),
                Field::make( 'text', 'clinicas_beforeafter_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Resultados visibles desde la primera semana.', 'understrap' ) ),
                Field::make( 'textarea', 'clinicas_beforeafter_description', __( 'Descripción', 'understrap' ) )
                    ->set_default_value( __( 'Documentamos cada protocolo con fotografía estandarizada y reportes para su expediente médico.', 'understrap' ) ),
                Field::make( 'image', 'clinicas_before_image', __( 'Imagen “Antes”', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'image', 'clinicas_after_image', __( 'Imagen “Después”', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'Curriculum', 'understrap' ),
            array(
                Field::make( 'complex', 'clinicas_curriculum_modules', __( 'Curriculum del programa', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título del módulo', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'content', __( 'Contenido', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Formulario', 'understrap' ),
            array(
                Field::make( 'text', 'clinicas_lead_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'Solicitar muestras profesionales', 'understrap' ) ),
                Field::make( 'text', 'clinicas_lead_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Solicite evaluación clínica.', 'understrap' ) ),
                Field::make( 'textarea', 'clinicas_lead_description', __( 'Descripción', 'understrap' ) )
                    ->set_default_value( __( 'Crearemos un set específico para su cabina y coordinaremos una demo presencial u online.', 'understrap' ) ),
                Field::make( 'text', 'clinicas_lead_name_label', __( 'Etiqueta — Nombre completo', 'understrap' ) )
                    ->set_default_value( __( 'Nombre completo', 'understrap' ) ),
                Field::make( 'text', 'clinicas_lead_clinic_label', __( 'Etiqueta — Clínica / Centro', 'understrap' ) )
                    ->set_default_value( __( 'Clínica / Centro', 'understrap' ) ),
                Field::make( 'text', 'clinicas_lead_email_label', __( 'Etiqueta — Correo profesional', 'understrap' ) )
                    ->set_default_value( __( 'Correo profesional', 'understrap' ) ),
                Field::make( 'text', 'clinicas_lead_phone_label', __( 'Etiqueta — Teléfono / WhatsApp', 'understrap' ) )
                    ->set_default_value( __( 'Teléfono / WhatsApp', 'understrap' ) ),
                Field::make( 'text', 'clinicas_lead_comments_label', __( 'Etiqueta — Comentarios', 'understrap' ) )
                    ->set_default_value( __( 'Comentarios', 'understrap' ) ),
                Field::make( 'text', 'clinicas_lead_button_label', __( 'Texto del botón', 'understrap' ) )
                    ->set_default_value( __( 'Solicitar muestras', 'understrap' ) ),
            )
        );

    // -------------------------
    // Spas & Hoteles page
    // -------------------------
    Container::make( 'post_meta', __( 'Spas & Hoteles', 'understrap' ) )
        ->where( 'post_template', '=', 'page-spas.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'file', 'kapunka_spas_hero_media', __( 'Medio del hero (imagen o video)', 'understrap' ) )
                    ->set_value_type( 'url' )
                    ->set_default_value( '/mnt/data/Spas & Hoteles - Kapunka.png' ),
                Field::make( 'text', 'kapunka_spas_hero_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'SPAS & HOTELES', 'understrap' ) ),
                Field::make( 'text', 'kapunka_spas_hero_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Ritual Signature Kapunka. Eleva la experiencia de tus huéspedes y convierte amenities en ventas', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spas_hero_subtitle', __( 'Subtítulo', 'understrap' ) )
                    ->set_default_value( __( 'Un ritual premium y un programa amenity-to-retail diseñado para hoteles 5★ y spas de lujo. Pack piloto, formación de equipo y co-marketing incluidos.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_spas_hero_cta_primary_text', __( 'Texto botón primario', 'understrap' ) )
                    ->set_default_value( __( 'Solicitar Pack Piloto', 'understrap' ) ),
                Field::make( 'text', 'kapunka_spas_hero_cta_primary_url', __( 'URL botón primario', 'understrap' ) )
                    ->set_default_value( '/contacto#profesionales' ),
                Field::make( 'text', 'kapunka_spas_hero_cta_secondary_text', __( 'Texto enlace secundario', 'understrap' ) )
                    ->set_default_value( __( 'Ver Packs Profesionales', 'understrap' ) ),
                Field::make( 'text', 'kapunka_spas_hero_cta_secondary_url', __( 'URL enlace secundario', 'understrap' ) )
                    ->set_default_value( '#packs' ),
                Field::make( 'text', 'kapunka_spas_hero_support_line', __( 'Línea de soporte', 'understrap' ) )
                    ->set_default_value( __( 'Piloto operativo en 6 semanas — incluye formación y material de venta.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Logos y mini casos', 'understrap' ),
            array(
                Field::make( 'media_gallery', 'kapunka_spas_partner_logos', __( 'Logos partners (gris)', 'understrap' ) ),
                Field::make( 'text', 'kapunka_spas_case_1_title', __( 'Caso 1 — Título', 'understrap' ) )
                    ->set_default_value( __( 'Hotel X / Spa Y', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spas_case_1_problem', __( 'Caso 1 — Problema', 'understrap' ) )
                    ->set_default_value( __( 'El spa buscaba una experiencia signature que justificara un precio premium y aumentara la venta retail.', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spas_case_1_solution', __( 'Caso 1 — Solución', 'understrap' ) )
                    ->set_default_value( __( 'Piloto de 6 semanas: Ritual Signature + formación intensiva + amenities en suites VIP.', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spas_case_1_result', __( 'Caso 1 — Resultado', 'understrap' ) )
                    ->set_default_value( __( 'Resultado: +12% ventas retail, conversión amenity→venta 3.8%, ticket medio retail 45 € (ejemplo).', 'understrap' ) ),
                Field::make( 'text', 'kapunka_spas_case_2_title', __( 'Caso 2 — Título', 'understrap' ) )
                    ->set_default_value( __( 'Hotel Z / Spa W', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spas_case_2_problem', __( 'Caso 2 — Problema', 'understrap' ) )
                    ->set_default_value( __( 'El spa necesitaba un programa de retail que sostuviera la experiencia clínica fuera de cabina.', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spas_case_2_solution', __( 'Caso 2 — Solución', 'understrap' ) )
                    ->set_default_value( __( 'Diseñamos protocolos faciales + cápsulas de formación digital para el personal de suites.', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spas_case_2_result', __( 'Caso 2 — Resultado', 'understrap' ) )
                    ->set_default_value( __( 'Resultado: +18% reservas en cabina, upsell de packs profesionales en carta digital.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_spas_case_placeholder_text', __( 'Texto placeholder logo', 'understrap' ) )
                    ->set_default_value( __( 'LOGO_PLACEHOLDER', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Packs', 'understrap' ),
            array(
                Field::make( 'text', 'kapunka_spa_pack_title', __( 'Título Pack Spa', 'understrap' ) )
                    ->set_default_value( __( 'Spa Partnership Pack', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_spa_pack_bullets', __( 'Bullets Pack Spa', 'understrap' ) )
                    ->set_default_value( "- 1 x Frasco profesional 500 ml\n- 10 x Goteros 30 ml para venta retail\n- Formación Kapunka (online + workshop práctico opcional)\n- Kit marketing: tarjetas, POS, imágenes para web\n- Soporte co-marketing y listado en nuestra web" ),
                Field::make( 'text', 'kapunka_spa_pack_ref_price', __( 'Referencia precio Pack Spa', 'understrap' ) )
                    ->set_default_value( __( '500 ml = 120 € ; 30 ml = 27 €', 'understrap' ) ),
                Field::make( 'text', 'kapunka_hotel_pack_title', __( 'Título Pack Hotel', 'understrap' ) )
                    ->set_default_value( __( 'Hotel Amenity Pack', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_hotel_pack_bullets', __( 'Bullets Pack Hotel', 'understrap' ) )
                    ->set_default_value( "- 50 x Amenities 10 ml (mini gotero)\n- 5 x Goteros 30 ml para boutique\n- Tarjetas en habitación con QR + código hotel\n- Guía implantación concierge + spa\n- Oferta piloto (6 semanas) con formación exprés" ),
                Field::make( 'text', 'kapunka_cost_example_title', __( 'Título tabla coste', 'understrap' ) )
                    ->set_default_value( __( 'Ejemplo: coste por tratamiento', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_cost_example_table', __( 'Tabla coste (líneas)', 'understrap' ) )
                    ->set_default_value( "Coste €/ml = 120 € / 500 ml = 0,24 €/ml\nCoste por tratamiento (30 ml) = 30 × 0,24 = 7,20 €\nEjemplo de rentabilidad: Ritual a 90 € → margen ≈ 82,80 €" ),
            )
        )
        ->add_tab(
            __( 'Formación', 'understrap' ),
            array(
                Field::make( 'text', 'kapunka_training_title', __( 'Título formación', 'understrap' ) )
                    ->set_default_value( __( 'Formación Kapunka — Certifícate Kapunka Pro', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_training_modules', __( 'Módulos', 'understrap' ) )
                    ->set_default_value( "1. Teoría (1h): composición, evidencia clínica y seguridad.\n2. Práctica (2h): protocolo facial y corporal.\n3. Integración (1h): post-procedimiento y venta retail.\nEvaluación + certificado Kapunka Pro (sello para sala)." ),
                Field::make( 'text', 'kapunka_training_duration', __( 'Duración', 'understrap' ) )
                    ->set_default_value( __( 'Online + taller presencial 3–4 h (opción in-house).', 'understrap' ) ),
                Field::make( 'text', 'kapunka_training_cta_text', __( 'Texto CTA', 'understrap' ) )
                    ->set_default_value( __( 'Reservar formación / Solicitar fecha', 'understrap' ) ),
                Field::make( 'text', 'kapunka_training_cta_url', __( 'URL CTA', 'understrap' ) )
                    ->set_default_value( '/contacto#formacion' ),
            )
        )
        ->add_tab(
            __( 'Amenity-to-Retail', 'understrap' ),
            array(
                Field::make( 'textarea', 'kapunka_amenity_steps', __( 'Pasos del flujo', 'understrap' ) )
                    ->set_default_value( "1) Amenidad 10 ml en suite + tarjeta informativa.\n2) Tarjeta: QR → landing del hotel con código único.\n3) Tracking: QR → visitas → compras con código único. Reporte mensual." ),
                Field::make( 'textarea', 'kapunka_amenity_kpi_list', __( 'KPI recomendados', 'understrap' ) )
                    ->set_default_value( "- Tasa escaneo QR por huéspedes\n- Conversión visita→compra\n- Ticket medio retail\n- Incremento ingresos spa / mes" ),
                Field::make( 'textarea', 'kapunka_amenity_example', __( 'Ejemplo numérico', 'understrap' ) )
                    ->set_default_value( "Ejemplo: 1000 huéspedes → 5% escanean = 50 visitas → 10% convierten = 5 ventas → ticket medio 45 € → 225 € ventas (ilustrativo)." ),
            )
        )
        ->add_tab(
            __( 'Logística y Certificaciones', 'understrap' ),
            array(
                Field::make( 'textarea', 'kapunka_certifications_bullets', __( 'Certificaciones', 'understrap' ) )
                    ->set_default_value( "- Registro CPNP y expediente PIF disponible.\n- Dermatológicamente testado.\n- Orgánico / Vegano / Cruelty-Free (si aplica)" ),
                Field::make( 'textarea', 'kapunka_logistics_bullets', __( 'Logística', 'understrap' ) )
                    ->set_default_value( "- Lead time estándar: X semanas.\n- Lotes numerados y trazabilidad.\n- Reposición y opciones de refill." ),
                Field::make( 'textarea', 'kapunka_commercial_terms', __( 'Términos comerciales', 'understrap' ) )
                    ->set_default_value( "- Precios mayorista y descuentos por volumen.\n- Política de exclusividad geográfica (negociable).\n- MAP y reglas de co-branding." ),
            )
        )
        ->add_tab(
            __( 'Portal partners', 'understrap' ),
            array(
                Field::make( 'text', 'kapunka_partner_portal_title', __( 'Título portal', 'understrap' ) )
                    ->set_default_value( __( 'Soporte completo para partners', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_partner_portal_text', __( 'Texto soporte', 'understrap' ) )
                    ->set_default_value( __( 'Accede a vídeos de formación, plantillas de email, material para recepción/concierge y recursos para co-marketing.', 'understrap' ) ),
                Field::make( 'text', 'kapunka_partner_portal_cta_text', __( 'Texto CTA portal', 'understrap' ) )
                    ->set_default_value( __( 'Solicitar acceso al Portal Kapunka Pro', 'understrap' ) ),
                Field::make( 'text', 'kapunka_partner_portal_cta_url', __( 'URL formulario portal', 'understrap' ) )
                    ->set_default_value( '/partner-portal-request' ),
            )
        )
        ->add_tab(
            __( 'KPIs piloto', 'understrap' ),
            array(
                Field::make( 'text', 'kapunka_kpis_title', __( 'Título KPIs', 'understrap' ) )
                    ->set_default_value( __( 'KPIs primarios para piloto (6 semanas)', 'understrap' ) ),
                Field::make( 'textarea', 'kapunka_kpis_list', __( 'Lista KPIs', 'understrap' ) )
                    ->set_default_value( "- Conversión amenity→venta (%)\n- Ticket medio retail (€)\n- Incremento de ingresos spa por mes (€)\n- Coste del aceite por tratamiento (€)" ),
                Field::make( 'textarea', 'kapunka_kpis_formula', __( 'Fórmulas', 'understrap' ) )
                    ->set_default_value( "Coste €/ml = Precio 500 ml / 500\nCoste por tratamiento = ml usados × coste €/ml\nEjemplo: 120 € / 500 = 0,24 €/ml → 30 ml × 0,24 = 7,20 €" ),
                Field::make( 'textarea', 'kapunka_kpis_objectives', __( 'Objetivos', 'understrap' ) )
                    ->set_default_value( "- Amenity→retail ≥ 3%\n- Recuperación coste del piloto < 3 meses (meta)" ),
            )
        )
        ->add_tab(
            __( 'Rituales', 'understrap' ),
            array(
                Field::make( 'text', 'spas_rituals_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'Rituales disponibles', 'understrap' ) ),
                Field::make( 'text', 'spas_rituals_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'El Método Kapunka se adapta a su carta en dos semanas.', 'understrap' ) ),
                Field::make( 'complex', 'spas_rituals_items', __( 'Rituales', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Rentabilidad', 'understrap' ),
            array(
                Field::make( 'complex', 'crb_spa_rentabilidad_grid', __( 'Bloques de valor', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'item_title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'item_body', __( 'Descripción', 'understrap' ) ),
                            Field::make( 'image', 'item_image', __( 'Imagen de fondo', 'understrap' ) )
                                ->set_value_type( 'id' ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'item_title' => __( 'Storytelling Único', 'understrap' ),
                                'item_body'  => __( "Diseñamos un 'Signature Ritual Kapunka' para su carta. No es solo un aceite; es una narrativa premium de origen marroquí, artesanía y pureza clínica que justifica un posicionamiento elevado y atrae al cliente de lujo.", 'understrap' ),
                                'item_image' => 0,
                            ),
                            array(
                                'item_title' => __( 'Rentabilidad Premium', 'understrap' ),
                                'item_body'  => __( "Nuestra narrativa de 'Lujo Consciente' le permite posicionar este ritual con un margen de beneficio premium, atrayendo a clientes que valoran la autenticidad, la ética y la calidad por encima del precio.", 'understrap' ),
                                'item_image' => 0,
                            ),
                            array(
                                'item_title' => __( 'Amenity-to-Retail Loop', 'understrap' ),
                                'item_body'  => __( "Implementamos el modelo de 'Amenity-to-Retail'. Una amenity de 10ml en la suite VIP se convierte en una venta de alto valor en la boutique de su spa, creando un nuevo y probado flujo de ingresos.", 'understrap' ),
                                'item_image' => 0,
                            ),
                        )
                    ),
                Field::make( 'complex', 'crb_spa_value_text_grid', __( 'Grid de texto 4 columnas', 'understrap' ) )
                    ->set_max( 4 )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'crb_spa_value_title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'crb_spa_value_text', __( 'Texto', 'understrap' ) ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'crb_spa_value_title' => __( 'Rentabilidad', 'understrap' ),
                                'crb_spa_value_text'   => __( 'Producto con historia y validación que justifica un ticket medio elevado.', 'understrap' ),
                            ),
                            array(
                                'crb_spa_value_title' => __( 'Formación', 'understrap' ),
                                'crb_spa_value_text'   => __( 'Acceso al "Método Kapunka": protocolos de masaje facial y corporal.', 'understrap' ),
                            ),
                            array(
                                'crb_spa_value_title' => __( 'Formatos Cabina', 'understrap' ),
                                'crb_spa_value_text'   => __( 'Tamaños exclusivos (500ml) para uso intensivo.', 'understrap' ),
                            ),
                            array(
                                'crb_spa_value_title' => __( 'Soporte Técnico', 'understrap' ),
                                'crb_spa_value_text'   => __( 'Fichas técnicas completas y material de marketing.', 'understrap' ),
                            ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'CTA final', 'understrap' ),
            array(
                Field::make( 'text', 'crb_spa_cta_eyebrow', __( 'Eyebrow', 'understrap' ) )
                    ->set_default_value( __( 'CO-CREACIÓN KAPUNKA', 'understrap' ) ),
                Field::make( 'text', 'crb_spa_cta_title', __( 'Título', 'understrap' ) )
                    ->set_default_value( __( 'Diseñamos su carta de tratamientos.', 'understrap' ) ),
                Field::make( 'textarea', 'crb_spa_cta_body', __( 'Descripción', 'understrap' ) )
                    ->set_default_value( __( 'Coordinamos workshops con su equipo de cabina para adaptar narrativas, precios y rituales signature.', 'understrap' ) ),
                Field::make( 'text', 'crb_spa_cta_button_text', __( 'Texto del botón', 'understrap' ) )
                    ->set_default_value( __( 'Agendar reunión', 'understrap' ) ),
                Field::make( 'text', 'crb_spa_cta_button_link', __( 'URL del botón', 'understrap' ) )
                    ->set_default_value( home_url( '/contacto#profesionales' ) )
                    ->set_attribute( 'type', 'url' ),
            )
        )
        ->add_tab(
            __( 'FAQ', 'understrap' ),
            array(
                Field::make( 'complex', 'kapunka_faq_items', __( 'Preguntas frecuentes', 'understrap' ) )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'kapunka_faq_q', __( 'Pregunta', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'kapunka_faq_a', __( 'Respuesta', 'understrap' ) )
                                ->set_required( true ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'kapunka_faq_q' => __( '¿Qué volumen por tratamiento?', 'understrap' ),
                                'kapunka_faq_a' => __( 'Masaje corporal 20–40 ml; facial 3–6 gotas (ejemplos).', 'understrap' ),
                            ),
                            array(
                                'kapunka_faq_q' => __( '¿Apto para pieles sensibles/embarazadas?', 'understrap' ),
                                'kapunka_faq_a' => __( 'Sí; 100% argán, sin perfumes. Recomendamos prueba en pequeña zona.', 'understrap' ),
                            ),
                            array(
                                'kapunka_faq_q' => __( '¿Formación incluida?', 'understrap' ),
                                'kapunka_faq_a' => __( 'Sí, incluida en packs profesionales o como servicio.', 'understrap' ),
                            ),
                            array(
                                'kapunka_faq_q' => __( '¿Cómo medimos conversiones?', 'understrap' ),
                                'kapunka_faq_a' => __( 'QR + código único + reportes mensuales.', 'understrap' ),
                            ),
                            array(
                                'kapunka_faq_q' => __( '¿Co-branding disponible?', 'understrap' ),
                                'kapunka_faq_a' => __( 'Sí, bajo condiciones contractuales y MOQ.', 'understrap' ),
                            ),
                        )
                    ),
            )
        );

    // -------------------------
    // Impacto Social page
    // -------------------------
    $impacto_intro_default = <<<'HTML'
<p>Kapunka es más que un aceite; es una historia de impacto positivo. Cada gota proviene de una reserva de la biosfera reconocida por UNESCO. Trabajamos mano a mano con cooperativas de mujeres bereber en Marruecos, apoyando su desarrollo económico y preservando sus técnicas tradicionales y sostenibles. Esta es nuestra forma de gratitud.</p>
HTML;

    Container::make( 'post_meta', __( 'Impacto Social', 'understrap' ) )
        ->where( 'post_template', '=', 'page-impacto-social.php' )
        ->add_tab(
            __( 'Hero', 'understrap' ),
            array(
                Field::make( 'image', 'crb_impacto_hero_image', __( 'Imagen de fondo', 'understrap' ) )
                    ->set_value_type( 'id' ),
                Field::make( 'text', 'crb_impacto_hero_headline', __( 'Titular', 'understrap' ) )
                    ->set_default_value( __( 'Belleza que empodera.', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'text', 'crb_impacto_hero_subheadline', __( 'Subtítulo', 'understrap' ) )
                    ->set_default_value( __( 'El origen ético de cada gota de Kapunka.', 'understrap' ) ),
            )
        )
        ->add_tab(
            __( 'Introducción', 'understrap' ),
            array(
                Field::make( 'rich_text', 'crb_impacto_intro_body', __( 'Cuerpo', 'understrap' ) )
                    ->set_default_value( $impacto_intro_default ),
            )
        )
        ->add_tab(
            __( 'Pilares', 'understrap' ),
            array(
                Field::make( 'complex', 'crb_impacto_pillars', __( 'Pilares', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'pillar_headline', __( 'Titular', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'textarea', 'pillar_body', __( 'Descripción', 'understrap' ) ),
                        )
                    )
                    ->set_default_value(
                        array(
                            array(
                                'pillar_headline' => __( 'Comercio Justo', 'understrap' ),
                                'pillar_body'     => __( "Garantizamos salarios justos y desarrollo comunitario, asegurando que el valor de este 'oro líquido' retorne a las manos que lo cultivan.", 'understrap' ),
                            ),
                            array(
                                'pillar_headline' => __( 'Empoderamiento Femenino', 'understrap' ),
                                'pillar_body'     => __( 'Nuestro modelo apoya directamente a las cooperativas de mujeres, fomentando su independencia económica y preservando su rol como guardianas de una tradición ancestral.', 'understrap' ),
                            ),
                            array(
                                'pillar_headline' => __( 'Sostenibilidad UNESCO', 'understrap' ),
                                'pillar_body'     => __( 'Nuestro proceso artesanal y sostenible protege el ecosistema único de la Reserva de la Biosfera de la UNESCO, asegurando el futuro del árbol de Argán.', 'understrap' ),
                            ),
                        )
                    ),
            )
        )
        ->add_tab(
            __( 'Interludio', 'understrap' ),
            array(
                Field::make( 'image', 'crb_impacto_interlude_image', __( 'Imagen intermedia', 'understrap' ) )
                    ->set_value_type( 'id' ),
            )
        )
        ->add_tab(
            __( 'CTA final', 'understrap' ),
            array(
                Field::make( 'text', 'crb_impacto_cta_headline', __( 'Titular', 'understrap' ) )
                    ->set_default_value( __( 'La confluencia sanitaria.', 'understrap' ) )
                    ->set_required( true ),
                Field::make( 'textarea', 'crb_impacto_cta_body', __( 'Descripción', 'understrap' ) )
                    ->set_default_value( __( 'Nuestra fundadora, Mónica Ruiz, unió su exigencia sanitaria con esta sabiduría ancestral. El resultado es un producto con alma, eficacia clínica y un profundo impacto humano.', 'understrap' ) ),
            )
        );

    // -------------------------
    // Theme options
    // -------------------------
    Container::make( 'theme_options', __( 'Opciones de Kapunka', 'understrap' ) )
        ->add_fields(
            array(
                Field::make( 'text', 'newsletter_shortcode', __( 'Shortcode global de newsletter', 'understrap' ) ),
                Field::make( 'complex', 'mega_menu_ctas', __( 'Mega menú – CTAs', 'understrap' ) )
                    ->set_layout( 'tabbed-vertical' )
                    ->add_fields(
                        array(
                            Field::make( 'text', 'menu_slug', __( 'Identificador del elemento de menú (ej. tienda)', 'understrap' ) )
                                ->set_help_text( __( 'Usa el slug del elemento superior. Si el elemento enlaza a una página, coincide con el slug de esa página.', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'image', 'image', __( 'Imagen', 'understrap' ) )
                                ->set_value_type( 'id' )
                                ->set_required( true ),
                            Field::make( 'text', 'title', __( 'Título', 'understrap' ) )
                                ->set_required( true ),
                            Field::make( 'text', 'label', __( 'Texto del enlace', 'understrap' ) ),
                            Field::make( 'text', 'url', __( 'URL', 'understrap' ) ),
                        )
                    ),
            )
        );
}

/**
 * Shared field definitions.
 */
function kapunka_cf_cta_fields() {
    return array(
        Field::make( 'text', 'eyebrow', __( 'Eyebrow', 'understrap' ) ),
        Field::make( 'text', 'title', __( 'Título', 'understrap' ) )
            ->set_required( true ),
        Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
        Field::make( 'text', 'primary_label', __( 'CTA principal - texto', 'understrap' ) ),
        Field::make( 'text', 'primary_url', __( 'CTA principal - URL', 'understrap' ) ),
        Field::make( 'text', 'secondary_label', __( 'CTA secundaria - texto', 'understrap' ) ),
        Field::make( 'text', 'secondary_url', __( 'CTA secundaria - URL', 'understrap' ) ),
        Field::make( 'image', 'background_image', __( 'Imagen de fondo', 'understrap' ) )
            ->set_value_type( 'id' ),
    );
}

function kapunka_cf_testimonials_fields() {
    return array(
        Field::make( 'complex', 'items', __( 'Testimonios', 'understrap' ) )
            ->add_fields( kapunka_cf_single_testimonial_fields() ),
    );
}

function kapunka_cf_newsletter_fields() {
    return array(
        Field::make( 'text', 'title', __( 'Título', 'understrap' ) ),
        Field::make( 'textarea', 'description', __( 'Descripción', 'understrap' ) ),
        Field::make( 'text', 'form_shortcode', __( 'Shortcode del formulario', 'understrap' ) ),
    );
}

function kapunka_cf_faq_fields() {
    return array(
        Field::make( 'text', 'title', __( 'Título', 'understrap' ) ),
        Field::make( 'complex', 'items', __( 'Preguntas', 'understrap' ) )
            ->add_fields( kapunka_cf_single_faq_fields() ),
    );
}

function kapunka_cf_single_testimonial_fields() {
    return array(
        Field::make( 'textarea', 'quote', __( 'Cita', 'understrap' ) )
            ->set_required( true ),
        Field::make( 'text', 'author', __( 'Autor', 'understrap' ) ),
        Field::make( 'text', 'role', __( 'Rol / Tipo', 'understrap' ) ),
        Field::make( 'image', 'before_image', __( 'Imagen antes', 'understrap' ) )
            ->set_value_type( 'id' ),
        Field::make( 'image', 'after_image', __( 'Imagen después', 'understrap' ) )
            ->set_value_type( 'id' ),
    );
}

function kapunka_cf_single_faq_fields() {
    return array(
        Field::make( 'text', 'question', __( 'Pregunta', 'understrap' ) )
            ->set_required( true ),
        Field::make( 'textarea', 'answer', __( 'Respuesta', 'understrap' ) ),
    );
}
