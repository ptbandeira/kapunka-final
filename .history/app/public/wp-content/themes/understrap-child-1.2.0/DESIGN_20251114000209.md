# Kapunka UI/UX Foundations

This document captures the non‑negotiable design principles that guide every change to the Kapunka experience. Review it before shipping any UX, layout, or styling updates. Update it whenever we evolve the system.

---

## 1. Brand Fundamentals

- **Tone:** Clinical calm. Everything should feel precise, rigorous, and welcoming. Avoid decorative clutter.
- **Typography:** Mantén el stack sans-serif definido en `kapunka.css` (sistema/Inter) en todos los contextos. No introduzcas serif ni monospace alternativos; la jerarquía se logra con peso, tracking y whitespace, no con cambios de familia.
- **Color Palette:**
  - Primary black `#000000` and white `#FFFFFF` are the base.
  - Supporting neutrals: `--gray-light #f8f8f8`, medium `#666666`, dark `#333333`.
  - Avoid browser defaults (no system blue links). Body links default to black with muted underline; hover shifts to charcoal.
- **Spacing:** “Whitespace is luxury”: los cortes principales entre secciones mantienen ahora 6–10rem en desktop (mínimo 4rem en mobile) y los gutters siguen el clamp del contenedor. No dudes en dejar pantallas con una sola frase cuando el storytelling lo exija.
- **Full-bleed + clamp rule:** Cuando un bloque usa imagen a sangrado (hero, value grid, CTA con foto), el copy siempre se alinea con el clamp del nav: `padding-inline: var(--shell-inline-padding)` + offset micro de `2.4ch` cuando haya titulares uppercase largos para que la primera letra coincida con la “K” del logotipo.

## 2. Layout & Grid

- **Containers:** Standard content stays within `.container` widths; full-bleed sections (hero, CTA with background) use intentional `margin-left/right` calculations.
- **Top Spacing:** Interior pages use an 8rem top padding on the main wrapper so content clears the fixed nav without extra white space (e.g., `.site-main--aprende`). Avoid stacking additional hero offsets unless the design calls for a full-bleed hero.
- **Alignment:** Textual content (headlines, body copy, CTA text) must align with the navbar limits: clamp containers to `max-width: 1320px` with `padding: clamp(1.5rem, 6vw, 4rem)` so cards, FAQs, and CTAs share the same gutters. Full-bleed imagery can extend beyond, but any accompanying copy still follows the clamp.
- **Responsiveness:** Breakpoints are 992px (tablet) and 768px (mobile). Mobile nav is bespoke; don’t reintroduce Bootstrap collapse.
- **Sección narrativa (scroll sticky):** Para “El Origen” o storytelling largo, usa secciones sticky donde la imagen queda fija y el texto avanza en paneles. Limita la duración (máx. 3 paneles consecutivos), evita lag (usa `will-change: transform`) y desactiva en mobile si degrada la experiencia. Cuando no haya imagen de fondo, alterna fondos `#FFFFFF` y `--gray-light` sin padding vertical intermedio para que las secciones parezcan un único lienzo.

## 3. Components

### 3.1 Buttons
- All buttons (global `.btn`, `.kapunka-button`, WooCommerce add-to-cart) have **12px rounded corners**, uppercase copy, letter-spacing ~0.05em.
- Primary buttons are black background with white text; outlines are transparent fill with black border/text.

### 3.2 Product Cards (Tienda context)
- Tres columnas máximo en desktop, dos en tablet, una en móvil. Cards borderless, aspect ratio 3:4.
- Tienda ahora admite hasta 4 columnas en desktop (gutter fijo 10px) para el efecto galería clínica. Mobile/tablet mantienen 2 y 1 columnas respectivamente.
- Name and price share the same 0.85rem font; price uses gray (#666).
- “Más información” link aparece debajo. Hover: imagen zoom suave (scale 1.05) y botón “Añadir” fade-in en la parte inferior.

### 3.7 Shop Filters
- Debajo del hero de Tienda, usa links centrados `Todo / Rostro / Cuerpo / Packs` (uppercase, letter-spacing 0.08em). Sin botones/frames.

### 3.8 Product Detail Layout
- `product-main-grid` y acordeones siempre dentro de `.kapunka-clamp` para respetar gutters.
- Galería izquierda y summary derecha son `position: sticky` con `top: 7rem`.
- Precio: font-size ~2.25rem, weight ligero. Botón “Añadir al carrito” negro, full width, 50px alto.
- Sección inferior usa `<details>` con copy “Beneficios Clínicos”, “Ritual de Uso”, “Composición (INCI)”; iconos +/– minimalistas.

### 3.9 Journal (magazine view)
- Hero y cada bloque editorial mantienen `padding-block: clamp(6rem, 12vh, 10rem)` y siempre se envuelven con `.kapunka-clamp` para respetar los límites laterales.
- El primer artículo destacado usa la variante `kapunka-article-card--featured-main`: imagen 21:9, fondo `#f8f8f8`, títulos grandes (1.75–2.75rem) y copy extendido. Jamás divide la fila con otro contenido.
- La parrilla "Últimos artículos" es un grid de **3 columnas en desktop** (2 en tablet, 1 en mobile), matching Tienda page spacing (`column-gap: 10px`, `row-gap: 40px`). Cada card muestra:
  - **Imagen destacada grande** (aspect-ratio 3:4, tamaño 'large' para alta calidad)
  - **Título** (uppercase, 0.78rem, font-weight 300, color #000)
  - **Extracto de 2 líneas** (0.68rem, truncado con `-webkit-line-clamp: 2`)
- Cards minimalistas: sin bordes, sin sombras, sin meta (categoría/tiempo) ni CTA link visible. Hover en imagen con `transform: scale(1.02)` y transición `0.4s ease-out`.
- "Colecciones", "CTA profesional" y "Newsletter Journal" son bloques propios: colecciones con border-bottom delicado, CTA oscuro (#111) con botones blancos/negros invertidos y newsletter con inputs subrayados + botón uppercase de 12px radius.
- Todas las interacciones del Journal siguen el tempo "slow lux": `transition: 0.4–0.5s ease-out` para hover en cards, enlaces y botones.

### 3.10 El Origen (hero + carta)
- La hero usa los campos `crb_origen_hero_title`, `crb_origen_hero_subtitle` y `crb_origen_hero_image`. Tipografía “Radical Minimalism”: título extragrande (`clamp(3.5rem, 9vw, 7.25rem)`, weight 200, tracking negativo), subtítulo max 40ch con weight 300. Siempre bottom-left con overlay oscuro.
- La carta se alimenta desde `crb_origen_founder_letter` (rich text). Se presenta como artículo editorial: ancho máximo 72ch, interlineado 1.9, peso 300. Eyebrow uppercase “Carta de la fundadora”, y `padding-block` amplio (`clamp(6rem, 14vh, 12rem)`) para el “Radical Whitespace”.
- El CTA “Leer carta completa” abre un modal con overlay negro-suave (55%), diálogo blanco con bordes redondeados y animación `transition: 0.4s ease-out`. El cuerpo mantiene la tipografía editorial (1.05–1.4rem, line-height 1.9). Body scroll bloqueado mientras el modal está activo.
- Bloque “Valores” reutiliza el mismo `valor-propuesta-grid` que Profesionales: 2×2 con imágenes de fondo + overlay, texto alineado a clamp `calc(var(--shell-inline-padding) + 2.4ch)` y transiciones slow-lux. CF `crb_origen_valor_tiles` contiene el texto por defecto; el editor solo debe subir las imágenes.
- Carta modal termina con firma “M.” en `Rock Salt` 48px entre “Un fuerte abrazo,” y “Mónica – Fundadora de Kapunka”.
- Mantener el resto de secciones del template (`sobre-sticky-panels`, valores, cooperativas) inalteradas para respetar la narrativa original.

### 3.14 Contacto
- Hero compacto (sin 100vh): padding `clamp(3rem,7vw,4.5rem)` y titular peso 200 (`clamp(3.2rem,8vw,5rem)`), descripción máx. 48ch.
- Grid de bloques sobre tarjetas 1px, CTA profesional como texto `Saber más →`.
- Formulario CF7: campos transparentes con `border-bottom` negro (`focus` oscurece), submit en pastilla negra.
- CTA final reemplaza botones por enlaces texto (`Acceso profesional`, `Rituales para casa`).

### 3.3 Navigation
- Desktop: fixed header, mega menu triggered by hover (data attributes). Scrolled state forces black text.
- Mobile: hamburger left, brand center, cart right. Drawer uses stacked list + sliding subpanels; CTAs adapt to drawer width.
- Solo `Profesionales` puede mostrar mega menú: cuatro enlaces en columna izquierda + dos CTAs visuales a la derecha. No renderizar paneles cuando no existan sublinks/CTAs para evitar flashes blancos.

### 3.10 Profesionales – subpáginas
- `.site-main--profesionales-detail` mantiene 8rem de padding superior y cada bloque usa `padding-block: clamp(6rem, 12vh, 10rem)` con `.kapunka-clamp` para respetar los límites laterales.
- **Clínicas:** hero 50/50 con imagen editorial redondeada; grid de indicaciones minimalistas y slider antes/después controlado por `input[type=range]`. Las imágenes deben compartir proporción y estar optimizadas para lazy-load.
- **Spas:** hero con video HTML5 (`autoplay`, `muted`, `loop`, `playsinline`) y overlay oscuro. Sección de rituales usa grid 2 columnas y la comparativa de rentabilidad se construye con pill-bars que aprovechan la custom property `--value`.
- **Método Kapunka:** timeline vertical (border-left + bullets) y badge centrado (máx. 480px) para la certificación física.
- **Área Privada:** tarjeta blanca (radio 28px) sobre fondo gris claro. Por defecto renderiza `[woocommerce_my_account]`; el fallback HTML hereda tipografía sans, inputs sin sombras y botón negro uppercase.

### 3.4 CTA Blocks
- CTAs can now include optional background images (`background_image` field via Carbon Fields). When set, apply `.kapunka-cta--with-image` to overlay text atop the photo with a dark overlay (55% black).
- Text becomes white automatically when background image is present.
- Buttons contrast against dark background: primary button is white with black text; outline button is transparent with white border/text. Both use `transition: 0.4s ease-out` for slow lux feel.

### 3.5 FAQs
- Use the new two-column layout: title + CTA on the left, collapsible list on the right. Questions render as `<details>` with plus icons.

### 3.6 Testimonials
- Carousel auto-advances every 9s; no manual arrows. Background is #f2f2f2 with 2rem padding.

### 3.11 Value Proposition Grid (Profesionales / Clínicas)
- Bloque 2x2 full-bleed, cada tile con imagen (Carbon Fields) y overlay negro 55%.
- Copy pegado al bottom-left respetando el clamp global (`padding-inline: var(--shell-inline-padding) + 2.4ch`).
- Titulares uppercase, letter-spacing 0.14em; cuerpo 0.95–1.1rem, color blanco.
- Se reutiliza en la landing de Clínicas; si no hay imágenes cargadas se mantiene el layout pero sin fondo.

### 3.12 Curriculum Accordion (Profesionales / Clínicas)
- Título/intro se omiten en UI; solo se muestran los nombres de módulos en un acordeón minimalista.
- Cada `<details>` tiene borde superior/inferior hairline y abre con `+` que rota 45°. Cuerpo (descripción + bullets) solo aparece al expandir.
- Reutilizado en Clínicas: se puede gestionar el copy desde Carbon Fields (`clinicas_curriculum_modules`).

### 3.13 Formulario “Solicitar acceso”
- Se percibe como aplicación exclusiva: labels uppercase con tracking alto, inputs subrayados (sin cajas) y `transition: 0.4s` en el borde inferior al enfocar.
- Fondo `--gray-light` con copy en negro para diferenciarlo como bloque premium, manteniendo contraste con el resto de la página.
- Placeholders discretos (`rgba(0,0,0,0.35)`) y tipografía ligera.
- Reutilizado en Clínicas y Método Kapunka para captación de leads B2B.

### 3.14 Spas Hero
- Usa la misma estructura del hero principal (`hero-section` + `hero-content`) con fondo vídeo; overlay oscuro al 55%, copy alineado al clamp inferior izquierdo y scroll indicator activo.

## 4. Interactions

- Hover states must sentirse deliberados: usa `transition: all 0.4s ease-out` en botones, cards y enlaces principales; sin delays extra ni cambios abruptos. Esto aplica a Tienda (hover zoom + CTA fade) y a todas las acordeones `<details>`.
- Animations (mega menu, mobile panels, CTA overlays) use 0.2–0.3s ease for smoothness.
- Maintain accessibility: keep `aria` labels on mobile nav toggles, ensure color contrast (black on white or vice versa).
- Scroll sticky debe soltar al usuario al final de cada bloque; no lo extiendas por toda la página ni añadas padding que rompa la continuidad visual.

## 5. Content Guidelines

- Headlines sentence case, minimal punctuation. Buttons and links use concise verbs (“Comprar rituales”, “Solicitar fichas técnicas”).
- Avoid lengthy descriptions on cards—Tienda cards now only show name and price.

## 6. Workflow Expectations

1. **Before making UI changes:** Read this file plus any component-specific CSS/JS notes.
2. **When updating styles/components:** Ensure new patterns reuse existing classes or extend them responsibly; do not reintroduce Bootstrap defaults.
3. **After shipping changes:** Update this document if the system evolves (new component variant, color, interaction rule, etc.).

Maintaining this guide keeps the Kapunka experience coherent even as we iterate quickly. When in doubt, default to the Tienda page aesthetic—it’s our current reference point.
