<?php

namespace Theme\Orisa\Support;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\MetaBox;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Media\Models\MediaFile;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Theme\Facades\Theme;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ThemeHelper
{
    /** Per-request memo of MediaFile->alt lookups keyed by url, to avoid repeat queries when a partial renders the same image twice. */
    private static array $mediaAltCache = [];

    public static function getBlogPosts(int $limit = 5): Collection
    {
        if (! is_plugin_active('blog')) {
            return collect();
        }

        return app(PostInterface::class)
            ->getModel()
            ->query()
            ->wherePublished()
            ->with(['slugable', 'categories'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    public static function isShowPostMeta(string $key): bool
    {
        return (bool) theme_option("blog_post_meta_show_{$key}", true);
    }

    /**
     * Whether the page-header block (page title + breadcrumb) should render.
     *
     * Only Pages opt in, via the `breadcrumb_enabled` page meta. It is additionally
     * gated by the global Theme Options → Breadcrumb → "Breadcrumb enabled" switch,
     * so turning that off hides the block everywhere even on pages that were saved
     * with the meta set. Never shown on the homepage or on views that opt out with
     * `Theme::set('hideBreadcrumb', true)`.
     *
     * Consumed by both partials/breadcrumb.blade.php (to render the block) and
     * views/page.blade.php (to skip its own header-clearance spacer when the block
     * already provides that clearance) — keep the two in sync through this method.
     */
    public static function isBreadcrumbEnabled(): bool
    {
        if (Theme::get('breadcrumbEnabled') !== '1') {
            return false;
        }

        if (! Theme::breadcrumb()->enabled()) {
            return false;
        }

        if (Theme::get('hideBreadcrumb')) {
            return false;
        }

        return ! (BaseHelper::isHomepage() || request()->is('/'));
    }

    /**
     * Whitelist a user-supplied heading-level value (e.g. from a shortcode admin field)
     * down to one of the allowed semantic tags. Returns $default when the value is missing,
     * non-string, or outside the allowed set — so a corrupted/legacy value can never inject
     * arbitrary tag names into rendered Blade markup.
     *
     * "div" is allowed as the non-semantic option some section-title selectors expose, so a
     * block reused on a page that already has its heading outline can render the title as
     * plain text instead of adding a duplicate/out-of-order heading.
     */
    public static function safeHeadingTag(mixed $value, string $default = 'h1'): string
    {
        $allowed = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div'];
        $tag = is_string($value) ? strtolower(trim($value)) : '';

        return in_array($tag, $allowed, true) ? $tag : $default;
    }

    /**
     * Resolve the H1 for a blog archive (category / tag) page.
     *
     * A site that needs an archive H1 different from the term name can store one on the term
     * itself under the "archive_h1" meta key, from a small custom plugin, without editing this
     * theme. When that meta is absent the term name is used, so an archive always renders
     * exactly one H1 and never an empty one.
     */
    public static function archiveHeading(mixed $object): string
    {
        if (! $object instanceof Model) {
            return '';
        }

        $custom = MetaBox::getMetaData($object, 'archive_h1', true);

        if (is_string($custom) && trim($custom) !== '') {
            return trim($custom);
        }

        return trim((string) ($object->name ?? ''));
    }

    /**
     * Map a UI-block "Title font size" value to its modifier class.
     *
     * Preset steps rather than a free px value, so a block title always lands on the
     * theme's type scale and keeps its responsive clamp - a raw px would freeze the
     * title at one size across every breakpoint. Returns '' for the default (and for
     * any missing/unknown value), leaving the block's own title classes untouched.
     */
    public static function titleFontSizeClass(mixed $value): string
    {
        $allowed = ['sm', 'md', 'lg', 'xl'];
        $size = is_string($value) ? strtolower(trim($value)) : '';

        return in_array($size, $allowed, true) ? "orisa-title-size-{$size}" : '';
    }

    /**
     * Percentage saved when a product is on sale, rounded to a whole number.
     *
     * Returns 0 whenever there is nothing to advertise - no sale, a zero/negative list
     * price, or a rounding result that lands on 0% - so callers can use the return value
     * directly as the "should I render a badge?" test instead of repeating the checks.
     */
    public static function saleDiscountPercent(mixed $product): int
    {
        $price = (float) ($product->price ?? 0);
        $salePrice = (float) ($product->front_sale_price ?? 0);

        if ($price <= 0 || $salePrice >= $price) {
            return 0;
        }

        return (int) round((($price - $salePrice) / $price) * 100);
    }

    /**
     * Recover from comma-concatenated image paths that occasionally end up saved
     * by the shortcode admin form when duplicate inputs collide on a single name
     * (e.g. "a.webp,b.webp,c.webp"). Returns the last non-empty path, which is
     * the most-recently picked image. No-op for clean single-path values and
     * for legitimate comma-separated lists that don't look like image paths.
     */
    public static function sanitizeCommaCorruptedImage(mixed $value): string
    {
        if (! is_string($value)) {
            return '';
        }

        if ($value === '' || ! str_contains($value, ',')) {
            return $value;
        }

        $parts = array_values(array_filter(array_map('trim', explode(',', $value))));
        if (! $parts) {
            return '';
        }

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'avif', 'bmp', 'ico'];
        foreach ($parts as $part) {
            $ext = strtolower(pathinfo(parse_url($part, PHP_URL_PATH) ?: $part, PATHINFO_EXTENSION));
            if (in_array($ext, $imageExtensions, true)) {
                return (string) end($parts);
            }
        }

        return $value;
    }

    /**
     * Apply image-value sanitization across the named keys of every entry in a
     * tabs-data array (the result of Shortcode::fields()->getTabsData(...)).
     */
    public static function sanitizeTabImages(array $tabs, string|array $keys = 'image'): array
    {
        $keyList = is_array($keys) ? $keys : [$keys];

        foreach ($tabs as &$tab) {
            if (! is_array($tab)) {
                continue;
            }

            foreach ($keyList as $key) {
                if (array_key_exists($key, $tab)) {
                    $tab[$key] = self::sanitizeCommaCorruptedImage($tab[$key]);
                }
            }
        }
        unset($tab);

        return $tabs;
    }

    /**
     * Pre-clean shortcode admin attributes so the form preview loads with a
     * single image path instead of the comma-concatenated string. Walks every
     * string attribute and sanitizes the ones that look like image paths.
     */
    public static function sanitizeShortcodeImageAttributes(array $attributes): array
    {
        foreach ($attributes as $key => $value) {
            if (is_string($value)) {
                $attributes[$key] = self::sanitizeCommaCorruptedImage($value);
            }
        }

        return $attributes;
    }

    /**
     * Mutate the Shortcode compiler's attributes in place so render-time reads
     * (e.g. $shortcode->card_image, $shortcode->style_image_1) get the cleaned
     * single path even when the DB still holds a comma-corrupted value. Run at
     * the top of every render callback before the partial is invoked.
     */
    /**
     * Resolve an <img alt=""> string for a given media URL by reading the
     * alt text stored in the media library, falling back to the caller-supplied
     * string, then to an empty string. Looks up MediaFile by url with a
     * per-request static cache so multiple renders of the same image hit the
     * DB once.
     */
    public static function resolveImageAlt(?string $url, ?string $fallback = null): string
    {
        $fallback = is_string($fallback) ? trim($fallback) : '';

        if (! is_string($url) || $url === '') {
            return $fallback;
        }

        if (! array_key_exists($url, self::$mediaAltCache)) {
            try {
                $alt = MediaFile::query()->where('url', $url)->value('alt');
            } catch (\Throwable) {
                $alt = null;
            }
            self::$mediaAltCache[$url] = is_string($alt) ? trim($alt) : '';
        }

        $mediaAlt = self::$mediaAltCache[$url];

        return $mediaAlt !== '' ? $mediaAlt : $fallback;
    }

    public static function sanitizeShortcodeAllImages(Shortcode $shortcode): void
    {
        foreach ($shortcode->toArray() as $key => $value) {
            if (! is_string($value) || $value === '' || ! str_contains($value, ',')) {
                continue;
            }

            $cleaned = self::sanitizeCommaCorruptedImage($value);

            if ($cleaned !== $value) {
                $shortcode->{$key} = $cleaned;
            }
        }
    }
}
