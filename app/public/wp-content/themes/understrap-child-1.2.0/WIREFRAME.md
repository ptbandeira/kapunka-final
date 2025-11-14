# Kapunka Website Wireframe & Copy Inventory

Documento maestro de estructura y copy en español. Refleja el cambio estratégico 2025 hacia “ritual clínico” y prioriza el flujo B2B (Profesionales) sin perder el deseo B2C (Tienda). Actualízalo cada vez que cambie la arquitectura o el mensaje.

> **Notation**
> - Cada bloque lista título + copy visible.
> - “Dinámico” marca contenido gestionado desde WordPress (Carbon Fields, WooCommerce, etc.).
> - Links sirven de contexto para routing actual.

---

## Elementos globales

- **Navegación primaria:** `Logo Kapunka` (home), `Tienda`, `Profesionales`, `El Origen`, `Journal`. Interacción ultra minimalista; fondo blanco, tipografía ligera y espaciada.
  - Solo `Profesionales` despliega mega menú (hover lento). Resto de enlaces van directo sin dropdown.
  - **Mega menú Profesionales:** Columna izquierda con links `Clínicas Estéticas`, `Spas & Hoteles`, `Método Kapunka`, `Área Privada`. Columna derecha con dos CTAs visuales: “Solicitar demo” (ancla a `/profesionales/clinicas#clinicas-form`) y “Descargar dossier” (PDF B2B).
- **Navegación secundaria (alineada a la derecha):** `Contacto`, icono minimal de `Cuenta / Acceder`, icono `Carrito (0)` con contador dinámico. Color del texto invierte (blanco/negro) según scroll para mantener contraste.
- **Hook global en hero y metadata:** “La intersección entre rigor clínico, lujo consciente y origen puro. Herramienta esencial para profesionales estéticos.”
- **Footer (4 columnas):**
  - **Col 1:** Logo mini + tagline “Agradece a tu piel.” + dirección corta.
  - **Col 2 – Explora:** `Tienda`, `Método Kapunka` (ancla dentro de Profesionales), `Journal`.
  - **Col 3 – Empresa:** `Sobre Mónica Ruiz`, `Impacto Social`, `Contacto`.
  - **Col 4 – Legal & Social:** Mini formulario newsletter, iconos `IG`/`LinkedIn`, enlaces `Aviso legal`, `Privacidad`, `Cookies`.
- **Microinteracciones:** botones, enlaces prioritarios y tarjetas comparten `transition: all 0.5s ease-out` para que cada hover se sienta lento y deliberado.

---

## 1. Inicio / Home (`front-page.php`)

### 1.1 Hero — Ritual clínico diario
- **Eyebrow:** “CIENCIA Y NATURALEZA”.
- **Título:** “Agradece a tu piel”.
- **Descripción:** “El argán 100% BIO perfeccionado para la alta exigencia estética.”
- **CTAs:** Botón blanco “Explorar colección” (→ `/tienda`) + enlace subrayado “Acceso Profesionales” (→ `/profesionales`).
- **UI:** Hero full-bleed con overlay negro (15–20%), tipografía ultra ligera y animación de scroll indicador.

### 1.2 Hook editorial
- **Título:** “Más que un aceite. Un método.”
- **Cuerpo:** “Kapunka no es solo un ingrediente; es la fusión de un abastecimiento ético en Marruecos y un protocolo clínico desarrollado durante 35 años. Diseñado para quienes exigen resultados visibles sin comprometer la pureza.”
- **Layout:** Fondo blanco puro, texto centrado u offset con max-width 600px y whitespace radical.

### 1.3 Social Proof
- **Formato:** Slider minimal sin flechas (aparecen solo al hover si se añaden), fondo #f9f9f9.
- **Citas:**
  1. “Imprescindible en nuestros protocolos de recuperación post-láser. La pureza que exigía mi clínica.” — Dra. Martínez, Dermatóloga.
  2. “Nuestros clientes de spa notan la diferencia inmediata en textura y absorción.” — Sarah L., Directora de Wellness, Hotel Arts.

### 1.4 Trinity / Core Pillars
- Grid de 3 columnas (gap 4rem) sin iconos genéricos. Usar macros B/N o líneas finas.
- Copy:
  - **Origen.** Primera prensada en frío de cooperativas femeninas certificadas.
  - **Ciencia.** 100% pureza validada. Rico en Vitamina E y ácidos grasos esenciales.
  - **Método.** Protocolos de aplicación propios que maximizan la absorción.

### 1.5 Esenciales Kapunka (Featured Collection)
- Layout asimétrico: imagen/producto grande izquierda, dos productos apilados derecha.
- Productos WooCommerce destacados (ej. “Aceite Puro 50ml — 45€”); cards sin bordes ni sombras.
- CTA final: “Ver toda la tienda”.

### Evidencia clínica
- **Título:** “Resultados que se sienten y se miden.”
- **Contenido:** Stats alineados a B2B: “+32% retención de hidratación en 72h”, “90% de profesionales reportan mejor deslizamiento en masaje manual”, etc.
- **CTA secundaria:** “Descargar fichas clínicas” (→ gated PDF).

### Programa Profesional (teaser)
- Bloque full-bleed con foto de cabina.
- Copy: “Formaciones presenciales y soporte remoto para integrar Kapunka en tu menú de servicios.”
- CTA: “Ver módulos”.

### Journal destacado
- 2 artículos: título, categoría (Journal), resumen corto.
- CTA: “Entrar al Journal”.

### Newsletter minimalista
- Título: “Notas clínicas y rituales nuevos, una vez al mes.”
- Input + botón “Suscribirme”.

---

## 2. Tienda (`page-tienda.php` + WooCommerce)

### Hero comercial
- **Título:** “La Colección Kapunka”.
- **Descripción:** “Una selección curada que fusiona nuestro aceite 100% BIO con el rigor clínico y un origen consciente. Encuentre su ritual esencial.”
- **Filtros:** Links centrados `Todo / Rostro / Cuerpo / Packs` (uppercase, texto negro). Ahora se controlan con query (`?categoria=`) manteniendo la página Tienda.

### Grid de productos (dinámico)
- 4 columnas en desktop (gap 10px), 2 en tablet, 1 en mobile. Cards sin borde (imagen 3:4), título + precio en una línea, link “Más información” y botón hover “Añadir al carrito” slow-lux.

### Visual banner + Trinity
- Banner full-bleed configurable (`assets/images/shop-banner.jpg`).
- Sección “Trinity” (texto en 3 columnas):
  1. **PURAMENTE ÉTICO** — “Primera prensada en frío de cooperativas femeninas certificadas.”
  2. **CLÍNICAMENTE EFICAZ** — “100% pureza validada. Rico en Vitamina E y ácidos grasos esenciales.”
  3. **EL RITUAL EXPERTO** — “Protocolos de aplicación propios que maximizan la absorción.”

---

## 3. Profesionales (`page-profesionales.php`)

### Hero B2B
- **Eyebrow:** “DIVISIÓN PROFESIONAL”.
- **Título:** “Eleve sus protocolos estéticos.”
- **Descripción:** “Línea exclusiva de alto rendimiento para clínicas, spas de lujo y hoteles. Incluye formación técnica de nuestro método.”
- **CTA:** “Solicitar Partnership”.
- **Layout:** Split screen (texto izquierda / foto spa derecha).

### Propuesta de valor (nuevo bloque)
- Grid 2x2 full-bleed con imágenes editables (Carbon Fields).
- Copy por tile:
  1. **Rentabilidad.** “Producto con historia y validación que justifica un ticket medio elevado.”
  2. **Formación.** “Acceso al ‘Método Kapunka’: protocolos de masaje facial y corporal.”
  3. **Formatos Cabina.** “Tamaños exclusivos (500ml / 1L) para uso intensivo.”
  4. **Soporte Técnico.** “Fichas técnicas completas y material de marketing.”
- Texto se pega al bottom-left siguiendo el clamp + offset (regla no negociable).

### Programa de formación
- Módulos listados vía acordeón (Carbon Fields). Solo los títulos son visibles; al expandir se muestran descripción y bullets.

### Kit profesional
- Sección visual que detalla contenido del maletín: botellas, goteros, manual técnico, fichas impresas.

### Casos y testimonios profesionales
- Carousel con citas de spas y clínicas. Cada testimonio enlaza al Journal (caso largo).

### Onboarding & soporte
- Pasos numerados: 1) Aplicar → 2) Formación → 3) Suministro recurrente → 4) Marketing compartido.
- CTA final “Reservar sesión con el equipo clínico”.

### Formulario
- CF7 con campos: `Nombre de clínica`, `Ciudad`, `Tipo de servicio`, `Mensaje`. Botón “Solicitar acceso”.
- Estilo: etiquetas uppercase delicadas + inputs subrayados (sin cajas) para sensación de aplicación exclusiva. Fondo gris claro (`--gray-light`) con texto negro.

---

### 3.1 Clínicas & Dermatología (`page-clinicas.php`)

- **Hero:** Split screen (texto blanco sobre fondo blanco, imagen macro de aceite). Copy fijo:
  - Eyebrow “Clínicas & Dermatología”
  - Título “Rigor en la recuperación cutánea.”
  - Descripción “Argán 100% BIO de primera prensada en frío…”.
- **Propuesta de valor 2x2:** Bloque full-bleed (mismas reglas que Profesionales) editable via Carbon Fields.
  1. Mejora la experiencia del paciente — “Calma la piel tras un peeling o láser, elevando la satisfacción del paciente.”
  2. Innovación y diferenciación — “Ofrecer un ‘ritual Kapunka’ o un protocolo exclusivo añade un factor diferenciador en la carta de servicios.”
  3. Calidad asegurada — “Producto con trazabilidad, registro sanitario y respaldo científico, lo que da confianza al profesional y al paciente.”
  4. Soporte de Kapunka — “Acceso a material educativo, guías de uso y acompañamiento por parte del equipo Kapunka.”
- **Validación clínica:** Slider “Antes / Después” con input range (default 54%). Copy “Resultados visibles desde la primera semana.” + nota sobre documentación.
- **Curriculum del programa:** Acordeón minimalista (mismas reglas que Profesionales). Items por defecto: “Módulo Teórico” y “Módulo Práctico”.
- **Formulario muestras:** Bloque oscuro con `Solicitar muestras profesionales`. Campos: Nombre, Clínica, Email, Teléfono/WhatsApp, Comentarios. CTA “Solicitar muestras”.

### 3.2 Spas & Hoteles (`page-spas.php`)

- **Hero video:** Full-width `hero-section` (misma estructura que Home). Fondo vídeo (loop, muted) con overlay oscuro y copy bottom-left (clamp). Copy fijo “El nuevo estándar en lujo consciente.” + descripción sensorial.
- **Rituales:** Grid 2 columnas con fichas:
  - Ritual Facial “Oro Líquido” (60 min)
  - Masaje Corporal Bereber (80 min)
  - Experiencia Express en cabina
  - Amenity nocturno
- **Rentabilidad sensorial:** Comparativa coste (32€) vs PVP (78€) mediante barras horizontales y nota de qué incluye.
- **CTA final:** Bloque oscuro “Diseñamos su carta de tratamientos.” Botón “Agendar reunión con Mónica” → `/contacto#profesionales`.

### 3.3 Método Kapunka (`page-metodo-kapunka.php`)

- **Hero humano:** Imagen de formación en curso + copy “La técnica detrás del producto.”
- **Syllabus (timeline vertical):**
  1. Teoría — bioquímica del argán, trazabilidad.
  2. Práctica — masaje facial de remonte, maniobras corporales.
  3. Certificación — examen práctico + diploma.
- **Badge:** Bloque con texto “Distintivo físico” + imagen del certificado para recepción/cabina.
- **Formulario B2B:** Sección final con formulario exclusivo (campos: Nombre, Clínica, Email, Teléfono/WhatsApp, Comentarios). Estilo underlined `pro-lead`.

### 3.4 Área Privada (`page-area-privada.php`)

- **Layout:** Tarjeta blanca centrada sobre fondo gris claro.
- **Copy:** “Bienvenido de nuevo. Acceda a sus tarifas exclusivas y pedidos rápidos.”
- **Funcionalidad:** Renderiza `[woocommerce_my_account]`. Si Woo no está activo, se muestra formulario mínimo (email + password) + enlace “¿Olvidaste tu contraseña?”.

---

## 4. El Origen (`page-el-origen.php`)

### Hero narrativo (parallax moody)
- Controlado por Carbon Fields:
  - `crb_origen_hero_title` (texto principal, peso ligero).
  - `crb_origen_hero_subtitle` (aparece como bajada).
  - `crb_origen_hero_image` (fondo de la hero en parallax).
- Estilo “Radical Minimalism”: título extragrande (≈ clamp 3.5–7rem), uppercase opcional, kerning negativo suave, copy ligero ≤40ch. Overlay oscuro + texto alineado bottom-left.

### Carta de la fundadora
- Sustituye el bloque “La confluencia sanitaria”.
- Teaser en página (eyebrow + extracto corto + botón) abre un modal full-screen-ish con la carta completa. El modal usa overlay oscuro, diagonal slow-lux y ahora cierra con firma manuscrita "M." (Google Font Rock Salt, 48px) entre “Un fuerte abrazo,” y “Mónica – Fundadora de Kapunka”.
- `crb_origen_founder_letter` (rich text) renderizado como artículo magazine en una única columna, con `Radical Whitespace` alrededor.
- Eyebrow fijo “Carta de la fundadora”. Tipografía ligera, interlineado amplio (≈1.8–1.9), ancho máximo 72ch. Sin imágenes laterales para mantener foco en el texto.

### Misión & Visión
- Dos columnas minimalistas (`crb_origen_mission_*`, `crb_origen_vision_*`). Copy fijo (editable en CF) y formato editorial ligero.

### Valores sensoriales 2x2
- Reutiliza el mismo bloque de imágenes que Profesionales (`valor-propuesta-grid`).
- Carbon Fields: `crb_origen_valor_tiles` con Headline, Body y Background. Ya dejamos el texto cargado; en admin solo suben las imágenes.
- Mantener reglas del grid original: overlay oscuro, copy en clamp con desplazamiento +2.4ch, tempo 0.4s en hover.

### Impacto & Ética (bloque oscuro)
- Fondo #222, texto blanco.
- **Título:** “Belleza que empodera.”
- **Copy:** “Cada gota proviene de cooperativas de mujeres bereberes...”
- **Stats:** `100% Trazabilidad`, `35+ Años de investigación`, `0% Aditivos sintéticos`.

### Valores y manifiesto
- Grid de 4 valores: `Humanidad`, `Precisión`, `Pureza`, `Responsabilidad`. Párrafos cortos.

### Equipo ampliado
- Fotos monocromas + rol (I+D, Operaciones, Formación). Texto breve.

---

## 5. Journal (`page-aprende.php` + archivos de post)

### Hero editorial
- **Eyebrow:** “Ciencia y naturaleza”.
- **Título:** “Journal Kapunka”.
- **Descripción:** “Análisis clínicos, rituales guiados y casos de cabina.”
- **CTA primario:** “Suscribirme al Journal” (ancor a la newsletter del final). Mantener todo dentro de `.kapunka-clamp` y con un bloque de whitespace generoso (6–10rem).

### Artículo destacado (magazine hero)
- Fuente manual desde el campo `aprende_destacados`.
- El primer post usa el layout `featured-main`: imagen 21:9, fondo gris claro y copy amplio para cubrir todo el ancho antes de pasar al grid.
- El resto de seleccionados (si los hay) viven en una grilla de dos columnas con mucho gutter.

### Últimos artículos (magazine grid)
- Eyebrow fijo "Dermatología Natural · Casos de Éxito · Lifestyle Consciente".
- Grid de 3 columnas (2 en tablet, 1 en mobile) con los 6 posts más recientes excluyendo los destacados. Cada card muestra:
  - **Imagen destacada grande** (aspect-ratio 3:4, alta calidad)
  - **Título** (uppercase, light-weight, 0.78rem)
  - **Extracto de 2 líneas** (0.68rem, truncado con ellipsis)
- Diseño minimalista sin bordes ni sombras, matching Tienda page aesthetic.

### Colecciones editoriales
- Grid de 4 bloques: `Guías de aplicación`, `Ciencia del argán`, `Casos clínicos`, `Noticias de cooperativa`. Cards sin íconos, solo copy y borde inferior.

### CTA cruzada profesionales
- Bloque oscuro “¿Eres profesional?” + título “Recibe fichas técnicas exclusivas y acceso prioritario al programa.” Botón “Unirme al programa” hacia `/profesionales`.

### Newsletter Journal
- Copy: “Envío mensual con protocolos y playlists para cabina.”
- Formulario mínimo: input con solo subrayado + botón uppercase. ID `#journal-newsletter` para conectar el CTA del hero.

---

## 6. Contacto (`page-contacto.php`)

### Hero minimal
- Eyebrow `Contacto directo`.
- Título: “Hablemos de tu ritual o de tu cabina”. Tipografía “imagen” (peso 200, tamaño 3.2–5rem) con padding reducido para eliminar el vacío superior.
- Descripción: “Responderemos en <24h hábiles. Para soporte de pedidos indica tu número de orden.”

### Bloques de contacto
- `Atención profesional` → correo `pro@kapunka.com`, WhatsApp, horario. CTA ligero “Saber más →”.
- `Clientes particulares` → formulario + dirección logística.
- `Prensa & colaboraciones` → contacto PR.

### Formulario CF7
- Campos con inputs subrayados (border-bottom). Placeholder discreto, submit en pastilla negra.

### CTA final
- Dos enlaces tipo texto: `Acceso profesional` y `Rituales para casa`.

---

## 7. Cuenta / Portal (`/mi-cuenta` WooCommerce)

- Mantener flujo estándar WooCommerce pero añadir copy contextual:
  - Login: “Si eres profesional, usa el acceso enviado tras tu onboarding.”
  - Registro: “Los perfiles profesionales se activan manualmente.”
- Bloque lateral con enlaces a `Pedidos`, `Descargas de fichas`, `Direcciones`.

---

## Notas finales

- Todo el contenido debe permanecer en español neutro con tono “ritual clínico”.
- `DESIGN.md` es la referencia para tipografías, espacios y comportamiento responsive.
- Documentar aquí cualquier nuevo bloque o campo de Carbon Fields antes de llevarlo a desarrollo.
