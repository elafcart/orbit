# Sixersoft — Botble CMS Basic Theme

**Sixersoft** is a basic starter theme for Botble CMS built with **Tailwind CSS v4**, **GSAP** and **Vite**.

Sixersoft হলো Botble CMS-এর জন্য Tailwind CSS v4, GSAP ও Vite দিয়ে তৈরি একটি বেসিক স্টার্টার থিম।

---

## Features / ফিচার

| | |
| --- | --- |
| 🎨 **Tailwind CSS v4** | Utility-first styling, compiled by the repo's Vite pipeline (`assets/css/theme.css`) |
| ✨ **GSAP** | Scroll-triggered reveals, staggered sections & counters (`assets/js/main.js`) with `prefers-reduced-motion` support |
| ⚡ **Vite** | Bundled as a self-executing IIFE — no jQuery required |
| 🌗 **Dark mode** | Class-based, persisted in `localStorage`, pre-paint script prevents flash |
| 🌐 **Multi-language** | `lang/en.json` + `lang/bn.json`, language switcher in header & footer |
| 📝 **Blog ready** | Post, archive (loop/category/tag/search), pagination views |
| 🛒 **Ecommerce ready** | Product grid/detail, category/tag/brand/search/wishlist, cart with coupon — wired to the plugin's jQuery front-end (`data-bb-*` hooks), `EcommerceHelper::useTailwindCSS()` for the bootstrap-compat layer |
| 💼 **Portfolio ready** | Default **portfolio** plugin fully wired: single project/service/category views, `[sixersoft-portfolio]` project grid, `[sixersoft-services]` with client-side category filter chips, project metrics on single pages |
| 🗣️ **Content blocks** | Orisa-style shortcode set, Tailwind-light: `[sixersoft-testimonials]`, `[sixersoft-team]`, `[sixersoft-faq]`, `[sixersoft-gallery]`, `[sixersoft-blog]`, `[sixersoft-about]`, `[sixersoft-cta]` — each with an admin settings UI |

## Structure / ফোল্ডার স্ট্রাকচার

```
sixersoft/
├── theme.json              # Theme identity (required)
├── config.php              # Asset registration + shortcode composer (required)
├── vite.build.mjs          # Build descriptor: css (Tailwind) + js (GSAP bundle)
├── assets/
│   ├── css/theme.css       # Tailwind v4 entry (@import 'tailwindcss' + @source)
│   └── js/main.js          # GSAP entry (ScrollTrigger reveals, counters, UI)
├── layouts/                # base / default / homepage / full-width
├── partials/               # header / footer / breadcrumb / pagination / language-switcher
├── views/                  # index / page / post / loop / category / tag / search / 404
│   └── ecommerce/          # products / product / cart / wishlist / category / tag / brand / search
├── functions/functions.php # Page templates, ThemeSupport, theme options
├── routes/web.php          # Theme::routes()
└── lang/                   # en + bn translations
```

## Building assets / অ্যাসেট বিল্ড

From the repository root:

```bash
pnpm install
pnpm run dev     # development build  (unminified, with sourcemaps)
pnpm run prod    # production build   (minified, mirrored to themes/sixersoft/public/)
```

Compiled output:

- `public/themes/sixersoft/css/theme.css` (gitignored, served at runtime)
- `public/themes/sixersoft/js/main.js`
- Production builds are also mirrored into `platform/themes/sixersoft/public/` so packaged distributions ship precompiled assets. Publish them on the server with:

```bash
php artisan cms:theme:assets:publish
```

## Performance / পারফরম্যান্স

Sixersoft is deliberately built for fast mobile & desktop loads:

- **Tiny asset footprint** — exactly two runtime files for the theme itself: `theme.css` (~9 KB gzip, Tailwind tree-shaken to only the classes you use) and `main.js` (~35 KB gzip, GSAP bundle). No jQuery, no Bootstrap, no Swiper/Isotope for theme features.
- **Non-blocking webfonts** — Google Fonts load via the `media="print"` + `onload` swap pattern with `preconnect`, so first paint is never blocked by fonts; system-font fallback renders instantly.
- **Lazy & async images** — listing images use the `medium` rendition with `loading="lazy" decoding="async"`; the post hero image gets `fetchpriority="high"` for LCP. `ThemeSupport::registerLazyLoadImages()` exposes an admin toggle to lazy-load CMS content images too.
- **Stable layout (no CLS)** — fixed aspect ratios (`aspect-video` / `aspect-square`) on every image slot.
- **Animations are opt-out** — Theme Options → Sixersoft → *Enable scroll animations* off skips all GSAP work (also automatic under `prefers-reduced-motion`).
- **ScrollTrigger over observers-heavy libs** — one GSAP plugin replaces AOS + counter libs + carousel libs.

Server-side, pair it with Botble's caches (Admin → Settings → Cache: enable cache + CDN-friendly asset versioning) for best Lighthouse scores.

### Why fewer features than Orisa? / orisa-র চেয়ে ফিচার কম কেন?

Orisa is Botble's commercial premium theme: 40+ shortcodes, 5 demo presets, several header/footer styles, typography controls, preloader, magic cursor — and the JS weight to match (Bootstrap bundle, Swiper, Isotope, Magnific Popup, Odometer…). Every one of those costs load time. Sixersoft trades that catalogue for speed; it keeps only what a fast business/blog/shop site needs, and its structure (shortcodes, widgets, theme options) is the same Botble API, so features can be ported over one-by-one without dragging the heavy vendors in.

## Activation / সক্রিয়করণ

1. **Admin → Appearance → Themes** → activate **Sixersoft**.
2. **Admin → Appearance → Menus** → create the main menu (location: *Main Navigation*).
3. **Admin → Pages** → create a page (e.g. "Home"), template: **Homepage**.
4. **Admin → Appearance → Theme Options** → pick the homepage (Page section) and set **Primary Color** (General section — any hex, e.g. `#4f46e5`).

## Customization / কাস্টমাইজেশন

- **Brand color**: Theme Options → *Sixersoft* section → *Primary Color*. The hex overrides the Tailwind token `--color-brand-600` at runtime (utilities like `bg-brand-600` and opacity modifiers such as `bg-brand-600/10` follow it automatically). The fallback homepage hero title/subtitle are editable there too.
- **Animation hooks** in Blade:
  - `data-animate="fade-up|fade-down|fade-left|fade-right|zoom-in"` (optional `data-delay`, `data-duration` in seconds)
  - `data-animate="stagger"` on a container animates its children (optional `data-stagger` gap)
  - `data-counter="100"` counts a number up on scroll (optional `data-counter-suffix`)
- **Tailwind sources** are scoped via `@source` in `assets/css/theme.css` — add new template folders there if you extend the theme.

## Note on the build pipeline

The theme declares a `css` entry in its `vite.build.mjs` descriptor:

```js
export default {
    css: [{ src: 'assets/css/theme.css', out: 'theme.css', tailwind: true }],
    js: [{ src: 'assets/js/main.js', out: 'main.js' }],
}
```

`tailwind: true` routes the stylesheet through `@tailwindcss/postcss` in the
repository's root `vite-build.mjs` runner (the `css` build primitive).
