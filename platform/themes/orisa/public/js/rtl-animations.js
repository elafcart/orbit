/**
 * RTL: neutralise the theme's character-split text animations.
 *
 * Splitting text into one box per character breaks the cursive letter-joining
 * of Arabic (and other connected scripts) - the letters render detached. The
 * theme has FOUR independent splitters and they must all be disabled in RTL:
 *
 *   1. `.reveal-text`        - GSAP SplitText (via `new SplitText(...)`)
 *   2. `.at-char-animation`  - GSAP SplitText (via `new SplitText(...)`)
 *   3. `.text-scale-anim(-2)`- manual per-letter <span> wrapping in main.js
 *   4. `.at-title-text`      - manual per-letter <span> wrapping in main.js
 *
 * (1) and (2): SplitText's constructor ends with `this.split(u)`, so replacing
 * the `split` method with a no-op leaves `chars/words/lines` empty and the DOM
 * untouched. main.js then hits its `chars.length` guards and skips both
 * animations while the element (and its CSS classes) is preserved. We keep the
 * real SplitText class so `SplitText.create` / `.version` and gsap plugin
 * registration stay intact.
 *
 * (3) and (4) never use SplitText - main.js rebuilds innerHTML into per-letter
 * spans. We cannot stop that inlined code (it was the real gap in the earlier
 * patch), so we cache the original text early and rejoin it after main.js runs,
 * keeping the classes so all CSS is preserved.
 *
 * Loaded only when RTL is enabled, after vendors/plugin.js (which defines
 * SplitText) and before main.js (which consumes it).
 */
(function () {
    'use strict';

    // --- Part 1: neutralise GSAP SplitText (reveal-text, at-char-animation) ---
    if (window.SplitText && window.SplitText.prototype) {
        window.SplitText.prototype.split = function () {
            this.chars = [];
            this.words = [];
            this.lines = [];

            return this;
        };
    }

    // --- Part 2: undo the manual per-letter splitters (text-scale-anim, at-title-text) ---
    var MANUAL_SELECTOR = '.text-scale-anim, .text-scale-anim-2, .at-title-text';
    var SPLIT_MARKER = '.at-letter-span, .at-word-span, span.char';
    var originals = new WeakMap();

    function cleanText(value) {
        return (value || '').replace(/\u00a0/g, ' ').replace(/\s+/g, ' ').trim();
    }

    function cacheOriginals() {
        document.querySelectorAll(MANUAL_SELECTOR).forEach(function (element) {
            if (originals.has(element) || element.querySelector(SPLIT_MARKER)) {
                return;
            }

            originals.set(
                element,
                cleanText(element.getAttribute('aria-label') || element.textContent)
            );
        });
    }

    function originalText(element) {
        if (originals.has(element)) {
            return originals.get(element);
        }

        // Fallback for nodes not seen at cache time (e.g. slider clones):
        // aria-label holds the original for .at-title-text; otherwise rebuild
        // from the per-word spans so inter-word spaces survive (main.js's word
        // split drops them, so plain textContent would merge the words).
        var aria = element.getAttribute('aria-label');
        if (aria) {
            return cleanText(aria);
        }

        var words = element.querySelectorAll('.at-word-span');
        if (words.length) {
            return cleanText(
                Array.prototype.map.call(words, function (word) {
                    return word.textContent;
                }).join(' ')
            );
        }

        return cleanText(element.textContent);
    }

    function restoreSplitters() {
        document.querySelectorAll(MANUAL_SELECTOR).forEach(function (element) {
            // Only act once the theme has split this element into child spans.
            if (!element.querySelector(SPLIT_MARKER)) {
                return;
            }

            var text = originalText(element);

            if (text) {
                element.replaceChildren(document.createTextNode(text));
            }
        });
    }

    // Capture pristine text before main.js can split it, then rejoin across a
    // few frames (main.js splits on DOMContentLoaded / window load) plus a short
    // MutationObserver to catch any late-rendered (e.g. slider-cloned) nodes.
    function boot() {
        cacheOriginals();

        [0, 60, 200, 500, 1000, 2000, 3500].forEach(function (delay) {
            window.setTimeout(restoreSplitters, delay);
        });

        var observer = new MutationObserver(restoreSplitters);
        observer.observe(document.body, { childList: true, subtree: true });
        window.setTimeout(function () {
            observer.disconnect();
            restoreSplitters();
        }, 6000);
    }

    cacheOriginals();

    if (document.body) {
        boot();
    } else {
        document.addEventListener('DOMContentLoaded', boot);
    }

    window.addEventListener('load', restoreSplitters);
})();
