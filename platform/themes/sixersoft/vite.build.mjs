// @botble/theme-sixersoft — basic starter theme.
// Tailwind CSS v4 stylesheet (postcss pipeline) + GSAP main script (Vite IIFE bundle).

export default {
    css: [{ src: 'assets/css/theme.css', out: 'theme.css', tailwind: true }],
    js: [{ src: 'assets/js/main.js', out: 'main.js' }],
    vendor: [{ from: 'jquery/dist/jquery.min.js', to: 'js/vendors/jquery.min.js' }],
}
