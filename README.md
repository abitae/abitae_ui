# Abitae UI

Componentes UI para Laravel + Livewire basados en Tailwind CSS y Alpine.js.

## Requisitos

- PHP 8.1+
- Laravel 10+
- Livewire 3.7+
- Tailwind CSS 4.1+
- Heroicons (Blade) para props `icon`

## Instalación

1) Instalar el paquete:

```
composer require abitae/abitae_ui
```

Esto incluye `blade-ui-kit/blade-heroicons` para renderizar íconos con props `icon`.

2) Publicar assets/config/vistas (opcional):

```
php artisan abitae-ui:install
```

3) Agregar assets al layout:

```html
<link rel="stylesheet" href="{{ config('abitae-ui.assets.css') }}">
<script src="{{ config('abitae-ui.assets.js') }}" defer></script>
```

4) Configurar Tailwind (agregar en `resources/css/app.css`):

```
@import 'tailwindcss';
@import '../../vendor/abitae/abitae_ui/resources/css/abitae-ui.css';
```

5) Alpine.js y collapse (recomendado para Accordion):

```
npm install alpinejs @alpinejs/collapse
```

En `resources/js/app.js`:

```
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
```

## Uso

## Documentación de componentes

Los componentes se registran como Blade y se usan con:
`<abitae:{componente}>`

Componentes disponibles:
- `abitae:button`, `abitae:button.group`
- `abitae:accordion`, `abitae:accordion.item`, `abitae:accordion.heading`, `abitae:accordion.content`
- `abitae:autocomplete`, `abitae:autocomplete.item`
- `abitae:avatar`, `abitae:avatar.group`
- `abitae:table`, `abitae:table.columns`, `abitae:table.column`, `abitae:table.rows`, `abitae:table.row`, `abitae:table.cell`

### Button

Botón con variantes, íconos y tooltips.

Props:
- `as` (string) `button | a | div`.
- `href` (string) URL cuando `as="a"`.
- `type` (string) `button | submit`.
- `variant` (string) `outline | primary | filled | danger | ghost | subtle`.
- `size` (string) `base | sm | xs`.
- `icon` (string) ícono inicial.
- `icon:variant` (string) `outline | solid | mini | micro`.
- `icon:trailing` (string) ícono final.
- `square` (bool) botón cuadrado.
- `align` (string) `start | center | end`.
- `inset` (string) `top bottom left right` combinable.
- `loading` (bool) muestra spinner si hay `wire:click` o `type="submit"`.
- `tooltip` (string) texto tooltip.
- `tooltip:position` (string) `top | bottom | left | right`.
- `tooltip:kbd` (string) hint de teclado.
- `kbd` (string) hint de teclado.
- `class` (string) clases extra.

```
<abitae:button variant="primary">Guardar</abitae:button>
```

Íconos usan Heroicons por nombre (ej. `user`, `chevron-down`).

Ejemplo link:

```
<abitae:button as="a" href="/docs" variant="outline">Docs</abitae:button>
```

Grupo:

```
<abitae:button.group>
    <abitae:button variant="outline">Left</abitae:button>
    <abitae:button variant="outline">Right</abitae:button>
</abitae:button.group>
```

### Accordion

Lista de secciones expandibles con sintaxis tipo Flux. Requiere `@alpinejs/collapse`.

Props:
- `variant` (string) `reverse` muestra el ícono antes del heading.
- `transition` (bool) habilita transición al expandir. Default: false.
- `exclusive` (bool) solo un item abierto a la vez. Default: false.

```
<abitae:accordion>
    <abitae:accordion.item>
        <abitae:accordion.heading>What's your refund policy?</abitae:accordion.heading>

        <abitae:accordion.content>
            If you are not satisfied with your purchase, we offer a 30-day money-back guarantee.
        </abitae:accordion.content>
    </abitae:accordion.item>

    <abitae:accordion.item>
        <abitae:accordion.heading>Do you offer discounts?</abitae:accordion.heading>

        <abitae:accordion.content>
            Yes, we offer special discounts for bulk orders.
        </abitae:accordion.content>
    </abitae:accordion.item>
</abitae:accordion>
```

Con múltiples abiertos:

```
<abitae:accordion :exclusive="true" :transition="true">
    <abitae:accordion.item>
        <abitae:accordion.heading>Título</abitae:accordion.heading>
        <abitae:accordion.content>Contenido</abitae:accordion.content>
    </abitae:accordion.item>
</abitae:accordion>

Props de item:
- `heading` (string) atajo para el heading.
- `expanded` (bool) abre el item por defecto.
- `disabled` (bool) deshabilita el item.

```
<abitae:accordion :exclusive="true">
    <abitae:accordion.item heading="Pregunta 1" :expanded="true">
        <abitae:accordion.content>Contenido 1</abitae:accordion.content>
    </abitae:accordion.item>
    <abitae:accordion.item heading="Pregunta 2" :disabled="true">
        <abitae:accordion.content>Contenido 2</abitae:accordion.content>
    </abitae:accordion.item>
</abitae:accordion>
```
```

### Autocomplete

Campo de búsqueda con sugerencias.

Props:
- `wire:model` (string) binding Livewire para el valor seleccionado.
- `type` (string) tipo de input. Default: text.
- `label` (string) etiqueta opcional.
- `description` (string) texto debajo del label.
- `placeholder` (string) placeholder del input.
- `size` (string) `sm | xs`.
- `variant` (string) `filled` o `outline` (default).
- `disabled` (bool) deshabilita interacción.
- `readonly` (bool) solo lectura.
- `invalid` (bool) aplica estilo de error.
- `multiple` (bool) para input type file.
- `mask` (string) patrón de máscara (requiere `@alpinejs/mask`).
- `icon` (string) texto/icono al inicio.
- `icon:trailing` (string) texto/icono al final.
- `kbd` (string) hint de teclado.
- `clearable` (bool) botón limpiar.
- `copyable` (bool) botón copiar.
- `viewable` (bool) mostrar/ocultar password.
- `as` (string) render como `button` o `input`.
- `container:class` (string) clases extra en contenedor.
- `class:input` (string) clases extra en el input.
- `minChars` (int) mínimo de caracteres para filtrar (default 2).

Slots:
- `icon` contenido custom al inicio.
- `icon:leading` contenido custom al inicio.
- `icon:trailing` contenido custom al final.

Los props `icon` y `icon:trailing` usan Heroicons por nombre.

```
<abitae:autocomplete wire:model="state" label="State of residence">
    <abitae:autocomplete.item>Alabama</abitae:autocomplete.item>
    <abitae:autocomplete.item>Arkansas</abitae:autocomplete.item>
    <abitae:autocomplete.item>California</abitae:autocomplete.item>
</abitae:autocomplete>
```

Ejemplo con slots:

```
<abitae:autocomplete wire:model="state" label="State">
    <x-slot:icon>🌎</x-slot:icon>
    <x-slot:icon:trailing>⌘K</x-slot:icon:trailing>
    <abitae:autocomplete.item>Alabama</abitae:autocomplete.item>
</abitae:autocomplete>
```

Con mínimo de caracteres:

```
<abitae:autocomplete wire:model="city" :minChars="3">
    @foreach ($cities as $city)
        <abitae:autocomplete.item :value="$city">{{ $city }}</abitae:autocomplete.item>
    @endforeach
</abitae:autocomplete>
```

Item props:
- `disabled` (bool) deshabilita la selección.

```
<abitae:autocomplete wire:model="state">
    <abitae:autocomplete.item disabled>Alabama</abitae:autocomplete.item>
    <abitae:autocomplete.item>Arkansas</abitae:autocomplete.item>
</abitae:autocomplete>
```

### Avatar

Avatar con imagen, iniciales o ícono.

Props:
- `name` (string) nombre del usuario para iniciales.
- `src` (string) URL de imagen.
- `initials` (string) iniciales custom.
- `alt` (string) texto alternativo (default: name).
- `size` (string) `xs | sm | md | lg`.
- `color` (string) color de fondo cuando no hay imagen. `auto` para asignación determinística.
- `color:seed` (string) semilla para `color="auto"`.
- `circle` (bool) circular.
- `icon` (string) texto/icono.
- `icon:variant` (string) `outline | solid`.
- `tooltip` (string|bool) texto tooltip o `true` usa name.
- `tooltip:position` (string) `top | right | bottom | left`.
- `badge` (string|bool) contenido o punto.
- `badge:color` (string) color del badge.
- `badge:circle` (bool) circular.
- `badge:position` (string) `top left | top right | bottom left | bottom right`.
- `badge:variant` (string) `solid | outline`.
- `as` (string) `button | div`.
- `href` (string) convierte en link.

Slots:
- `default` contenido custom del avatar.
- `badge` contenido custom del badge.

```
<abitae:avatar name="Jane Doe" size="sm" tooltip />
<abitae:avatar src="https://example.com/avatar.jpg" circle />
<abitae:avatar name="Alejandra" color="auto" color:seed="user-14" badge="3" />
```

Íconos usan Heroicons por nombre (ej. `user-circle`).

Avatar group:

```
<abitae:avatar.group class="*-ring-white">
    <abitae:avatar name="Ana" />
    <abitae:avatar name="Luis" />
</abitae:avatar.group>
```

### Table

Tabla con slots para columnas, filas y celdas.

Props:
- `paginate` (Paginator) instancia de paginator para links.
- `container:class` (string) clases extra en el contenedor.

Subcomponentes:
- `abitae:table.columns` `sticky` (bool)
- `abitae:table.column` `align` `sortable` `sorted` `direction` `sticky`
- `abitae:table.rows`
- `abitae:table.row` `key` `sticky`
- `abitae:table.cell` `align` `variant` `sticky`

Ejemplo:

```
<abitae:table :paginate="$this->orders">
    <abitae:table.columns>
        <abitae:table.column>Customer</abitae:table.column>
        <abitae:table.column sortable :sorted="$sortBy === 'date'" :direction="$sortDirection" wire:click="sort('date')">Date</abitae:table.column>
        <abitae:table.column sortable :sorted="$sortBy === 'status'" :direction="$sortDirection" wire:click="sort('status')">Status</abitae:table.column>
        <abitae:table.column sortable :sorted="$sortBy === 'amount'" :direction="$sortDirection" wire:click="sort('amount')">Amount</abitae:table.column>
    </abitae:table.columns>

    <abitae:table.rows>
        @foreach ($this->orders as $order)
            <abitae:table.row :key="$order->id">
                <abitae:table.cell class="flex items-center gap-3">
                    <abitae:avatar size="xs" src="{{ $order->customer_avatar }}" />
                    {{ $order->customer }}
                </abitae:table.cell>

                <abitae:table.cell class="whitespace-nowrap">{{ $order->date }}</abitae:table.cell>

                <abitae:table.cell variant="strong">{{ $order->amount }}</abitae:table.cell>

                <abitae:table.cell>
                    <abitae:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></abitae:button>
                </abitae:table.cell>
            </abitae:table.row>
        @endforeach
    </abitae:table.rows>
</abitae:table>
```

## Publicación manual

```
php artisan abitae-ui:publish --tag=abitae-ui-assets
php artisan abitae-ui:publish --tag=abitae-ui-config
php artisan abitae-ui:publish --tag=abitae-ui-views
```

## Inspiración

Guía de instalación similar a FluxUI. Referencia: https://fluxui.dev/docs/installation
