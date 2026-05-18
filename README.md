# Twig Card Component Demo

The Twig Card Component Demo is based off of the designs from Ivan Adamov's Food Cards 2025 - UI Kit https://tinyurl.com/ythbatp5.

I made some small adjustments to make the card accessible from the original designs. The star rating and category tags were transparent causing readability issues with the background image. 

A standalone PHP/Twig environment for prototyping Drupal components without a full Drupal install. Templates, component structure, and Sass conventions mirror Drupal's patterns so work translates directly.

## Requirements

- PHP 8.3+
- Node.js 18+
- Composer

## Setup

```bash
composer install
npm install
```

## Development

**Compile CSS (watch mode)**

```bash
npm run watch
```

**Compile CSS (one-shot)**

```bash
npm run build
```

**Start the local server**

```bash
php -S localhost:8000 router.php
```

Then open [http://localhost:8000](http://localhost:8000).

> `router.php` is required. Without it, PHP's built-in server routes all requests — including CSS, JS, and images — through `index.php`.

## Project Structure

```
├── components/
│   ├── base/
│   │   ├── color.scss          # CSS custom properties: colors
│   │   ├── typography.scss     # CSS custom properties: type scale, weights, font family
│   │   └── global.scss         # Entry point → compiles to css/global.css
│   ├── components/
│   │   └── teaser/
│   │       ├── src/
│   │       │   ├── teaser.scss # Component styles → compiles to teaser/teaser.css
│   │       │   └── teaser.js   # Component JS (IIFE, no build step needed)
│   │       ├── teaser.twig     # Component template
│   │       └── teaser.yml      # Component definition
│   └── elements/
│       └── button/
│           ├── src/
│           │   └── button.scss # Element styles → compiles to button/button.css
│           ├── button.twig     # Element template
│           └── button.yml      # Element definition
├── css/
│   └── global.css              # Compiled base styles (generated, do not edit)
├── images/                     # Static assets
├── partials/                   # Sass partials: breakpoints, typography mixins, etc.
├── src/
│   └── Attribute.php           # Drupal-compatible Attribute class shim
├── templates/
│   └── node/
│       └── node--recipe--teaser.html.twig  # Page template (Drupal naming convention)
├── index.php                   # Twig environment bootstrap + mock $data
├── router.php                  # PHP built-in server router for static file serving
├── composer.json               # PHP dependencies (Twig 3.x)
└── package.json                # Node dependencies + build scripts
```

## Adding Content

Mock data lives in `index.php` in the `$recipes` array. Each recipe supports:

| Key | Type | Example |
|---|---|---|
| `title` | string | `'Mediterranean Olive Pasta'` |
| `field_tags` | array | `['Vegetarian', 'Vegan']` |
| `field_link` | array | `['uri' => '#', 'title' => 'Add To Cart', 'options' => [...]]` |
| `field_price` | array | `['number' => '15.49', 'currency_code' => 'USD']` |
| `field_star_rating` | string | `'4.6'` |
| `field_image` | array | `['url' => 'images/photo.png', 'alt' => '...']` |
| `field_description` | string | Body text |
| `field_orientation` | string | `'horizontal'` (optional, default is vertical card) |

## Twig Namespaces

| Namespace | Path |
|---|---|
| `@components` | `components/components/` |
| `@elements` | `components/elements/` |
| _(default)_ | `templates/`, `images/` |

## Drupal Compatibility

| Feature | How it works here |
|---|---|
| `attributes.addClass()` | `src/Attribute.php` shim registered via `create_attribute()` Twig function |
| Template names | Follow Drupal convention: `node--[type]--[view-mode].html.twig` |
| Component CSS/JS | Linked directly in component `.twig` files (Drupal uses `*.libraries.yml`) |
| Sass partials | `@use 'partials' as *` resolves via `--load-path=partials` |
