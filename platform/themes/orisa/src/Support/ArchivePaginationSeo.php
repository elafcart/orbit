<?php

namespace Theme\Orisa\Support;

use Botble\Base\Facades\BaseHelper;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

/**
 * Keeps the metadata of a paginated blog archive unique per page.
 *
 * Every page of an archive (/blog, /blog?page=2, a category, a tag) is otherwise served with the
 * exact SEO title and description configured on page 1, which SEO audits report as duplicate
 * titles and duplicate meta descriptions across the whole pagination series. From page 2 onward
 * the active page number is appended to both. Page 1, canonical URLs, pagination links, headings,
 * archive content and indexing directives are left untouched.
 */
class ArchivePaginationSeo
{
    /**
     * Body of a regex character class listing the single characters a site owner may have typed
     * between the page title and the brand in a manually configured SEO title ("Blog | Web Fly",
     * "Blog - Web Fly", ...). \p{Pd} covers -, – and —. Because this is a character class and not
     * an alternation, only single characters belong here.
     */
    protected const BRAND_SEPARATORS = '\p{Pd}|·•:';

    /**
     * SeoHelper::setDescription() truncates at 250 through Str::limit(), so the page suffix has to
     * be made to fit inside that budget or it would be the part that gets cut off.
     */
    protected const DESCRIPTION_MAX = 250;

    /**
     * The archive page currently being rendered.
     *
     * Read through Laravel's paginator resolver rather than straight off the query string, so it
     * is the same validated integer the paginator itself renders links for. A missing or
     * malformed "page" value resolves to 1.
     */
    public static function currentPage(): int
    {
        return max(1, Paginator::resolveCurrentPage());
    }

    /**
     * Apply the page suffix to the title and description SeoHelper currently holds. Going through
     * SeoHelper covers <title>, meta description, og:title, og:description, twitter:title and
     * twitter:description in a single call, so all six stay consistent.
     */
    public static function apply(int $page): void
    {
        if ($page < 2) {
            return;
        }

        if ($title = SeoHelper::getTitleOnly()) {
            SeoHelper::setTitle(static::appendToTitle($title, $page));
        }

        if ($description = SeoHelper::getDescription()) {
            SeoHelper::setDescription(static::appendToDescription($description, $page));
        }
    }

    /**
     * "Blog | Web Fly" on page 2 becomes "Blog - Page 2 | Web Fly": the brand stays last so the
     * page number never lands after it. A title that already carries the suffix is returned
     * unchanged, so the suffix can never be doubled.
     */
    public static function appendToTitle(string $title, int $page): string
    {
        $suffix = ' - ' . __('Page :page', ['page' => $page]);

        if (Str::contains($title, trim($suffix))) {
            return $title;
        }

        [$base, $brand] = static::splitBrandSuffix(trim($title));

        return $base . $suffix . $brand;
    }

    /**
     * Appends "Page N." to the configured description, which stays the base text. The base is
     * shortened first when the result would otherwise run past the 250-character limit.
     */
    public static function appendToDescription(string $description, int $page): string
    {
        $suffix = ' ' . __('Page :page.', ['page' => $page]);

        if (Str::contains($description, trim($suffix))) {
            return $description;
        }

        $base = trim(strip_tags((string) BaseHelper::cleanShortcodes($description)));

        // Measured in display width, not characters, because that is what Str::limit() counts:
        // a character-based budget lets a CJK description slip through here and then lose the
        // suffix to the truncation SeoHelper applies afterwards.
        $room = static::DESCRIPTION_MAX - mb_strwidth($suffix);

        if (mb_strwidth($base) > $room) {
            // Str::limit() appends an ellipsis, so leave three characters of room for it.
            $base = Str::limit($base, max(0, $room - 3));
        }

        return $base . $suffix;
    }

    /**
     * Splits a manually typed brand suffix off a title: "Blog | Web Fly" -> ["Blog", " | Web Fly"].
     * A title that leaves the brand to Botble's "show site name" option carries none and comes
     * back unchanged with an empty suffix, because that brand is appended at render time and
     * already ends up after whatever this class adds.
     *
     * @return array{0: string, 1: string}
     */
    protected static function splitBrandSuffix(string $title): array
    {
        // The brand lives in the theme's "Site title" option, but a site that only filled in the
        // general setting should be recognised just as well, so both are tried.
        $candidates = array_filter(array_unique([
            trim((string) Theme::getSiteTitle()),
            trim((string) setting('site_title')),
        ]));

        foreach ($candidates as $siteName) {
            $pattern = '/\s*[' . static::BRAND_SEPARATORS . ']\s*' . preg_quote($siteName, '/') . '\s*$/iu';

            if (preg_match($pattern, $title, $matches)) {
                return [rtrim(mb_substr($title, 0, -mb_strlen($matches[0]))), $matches[0]];
            }
        }

        return [$title, ''];
    }
}
