#!/usr/bin/env python3
"""
Extract translatable English strings from PageSeeder.php files and emit
per-page JSON skeletons under translations/_extract/page-contents/{slug}.json.

Each output file is a flat dict: {"English": "English"} (key=value initially)
ready to be translated by translate-page-contents.py.
"""

import json
import os
import re
from pathlib import Path

# Page seeder source files to scan (Main + variants).
PAGE_SEEDERS = [
    "Themes/Main/PageSeeder.php",
    "Themes/Home2/PageSeeder.php",
    "Themes/Home3/PageSeeder.php",
    "Themes/Home4/PageSeeder.php",
    "Themes/Home5/PageSeeder.php",
]

# Whitelist of attribute keys whose values should be translated.
# Pattern-based — supports _N suffixes (e.g. title_1, description_2).
TRANSLATABLE_KEY_PATTERNS = [
    r"^title$", r"^title_\d+$",
    r"^subtitle$", r"^subtitle_\d+$",
    r"^description$", r"^description_\d+$",
    r"^secondary_description$",
    r"^content$", r"^content_\d+$",
    r"^label$", r"^label_\d+$",
    r"^primary_action_label$", r"^secondary_action_label$",
    r"^action_label$",
    r"^form_title$", r"^form_description$",
    r"^address$", r"^address_\d+$",
    r"^name_\d+$",          # tab item names (testimonial/skill name)
    r"^role_\d+$",
    r"^company_\d+$",
    r"^quote_\d+$",
    r"^button_label_\d+_\d+$",
    r"^button_label_\d+$",
    r"^question_\d+$",
    r"^answer_\d+$",
    r"^placeholder$",
    r"^heading$",
    r"^badge$",
    r"^cta$", r"^cta_\d+$",
    r"^action_label_\d+$",
    r"^contact_section_title$",
    r"^contact_section_description$",
    r"^contact_section_subtitle$",
    r"^contact_section_sub_description$",
    r"^coming_soon_subtitle$",
]

TRANSLATABLE_KEY_RE = re.compile("|".join(TRANSLATABLE_KEY_PATTERNS))

# Top-level page entries are introduced by `'name' => 'PageName',` immediately
# inside the createPages array. We use a heuristic: a quoted name that matches
# one of the known page names. Update this list when adding pages.
PAGE_NAMES = [
    "Homepage", "Portfolio", "Services 1", "Services 2", "Services 3",
    "Our Team", "Blog", "Contact 1", "Contact 2",
    "About 1", "About 2", "About 3",
    "Pricing", "FAQ", "Coming Soon", "Privacy Policy",
    # Variant homes may add their own — auto-detected via createPages parser.
]

# Strings to skip even if they appear under a translatable key.
SKIP_VALUES = {
    "#", "/", "", "Orisa", "Orisa Studio",
}

# Regex matching a single quoted PHP string value. Supports both ' and "
# quotes, escaped quotes, and multiline (with DOTALL).
SINGLE_QUOTED = re.compile(r"'((?:\\.|[^'\\])*)'", re.DOTALL)
DOUBLE_QUOTED = re.compile(r'"((?:\\.|[^"\\])*)"', re.DOTALL)


def php_unescape_single(s: str) -> str:
    """Unescape PHP single-quoted string. Process `\\` via sentinel so a literal
    `\\\\'` (escaped backslash followed by end-of-string) isn't mis-parsed."""
    sentinel = "\x00BSLASH\x00"
    return (
        s.replace("\\\\", sentinel)
        .replace("\\'", "'")
        .replace(sentinel, "\\")
    )


def php_unescape_double(s: str) -> str:
    """Unescape PHP double-quoted string. Process `\\` via sentinel FIRST so
    sequences like `\\\\n` (literal backslash + n) aren't mangled into a real
    newline. Order of naive replacements is otherwise unsafe."""
    sentinel = "\x00BSLASH\x00"
    return (
        s.replace("\\\\", sentinel)
        .replace('\\"', '"')
        .replace("\\n", "\n")
        .replace("\\t", "\t")
        .replace(sentinel, "\\")
    )


def find_page_blocks(php: str):
    """
    Yield (page_name, body_text) for each page block in PageSeeder.

    Two patterns supported:
    1) Main PageSeeder: top-level array entries with `'name' => 'PageName',`
    2) Variant PageSeeders (Home2-Home5): use
       `Page::query()->where('name', 'X')->firstOrFail()` followed by
       `->update([...])`.
    """
    page_starts = []
    p1 = re.compile(r"'name'\s*=>\s*'([^']+)'\s*,")
    for m in p1.finditer(php):
        name = m.group(1)
        if name in PAGE_NAMES:
            page_starts.append((name, m.start()))

    if page_starts:
        for i, (name, start) in enumerate(page_starts):
            end = page_starts[i + 1][1] if i + 1 < len(page_starts) else len(php)
            yield name, php[start:end]
        return

    # Fallback: variant override via where('name', 'X')
    p2 = re.compile(r"where\s*\(\s*'name'\s*,\s*'([^']+)'\s*\)")
    matches = [(m.group(1), m.start()) for m in p2.finditer(php) if m.group(1) in PAGE_NAMES]
    for i, (name, start) in enumerate(matches):
        end = matches[i + 1][1] if i + 1 < len(matches) else len(php)
        yield name, php[start:end]


def extract_translatable_strings(body: str) -> set:
    """
    Find all 'key' => 'value' (or "value") pairs where key matches the
    translatable whitelist, return unique values.
    """
    out = set()

    # Match: 'key' => 'value' OR 'key' => "value"
    # Allow whitespace and newlines between key and value.
    kv_pattern = re.compile(
        r"'([a-z_]+(?:_\d+)*(?:_\d+_\d+)?)'\s*=>\s*"
        r"(?:'((?:\\.|[^'\\])*)'|\"((?:\\.|[^\"\\])*)\")",
        re.DOTALL,
    )

    for m in kv_pattern.finditer(body):
        key = m.group(1)
        if not TRANSLATABLE_KEY_RE.match(key):
            continue
        raw_single = m.group(2)
        raw_double = m.group(3)
        if raw_single is not None:
            value = php_unescape_single(raw_single)
        else:
            value = php_unescape_double(raw_double)

        value = value.strip()
        if not value or value in SKIP_VALUES:
            continue
        # Skip pure URLs, file paths, icon classnames
        if re.match(r"^(https?://|/|ti ti-|\$|#[0-9a-fA-F])", value):
            continue
        # Skip pure numeric / units like "10K+"
        if re.match(r"^[\d\s\.,+\-%KkMm]+$", value):
            continue
        # Must contain at least one ASCII letter
        if not re.search(r"[A-Za-z]", value):
            continue
        # Skip strings that are nothing but HTML tags / entities
        if re.fullmatch(r"(?:\s|<[^>]+>|&\w+;)+", value):
            continue
        # Skip standalone email addresses
        if re.fullmatch(r"[\w.+-]+@[\w.-]+", value):
            continue
        out.add(value)

    return out


def slugify(name: str) -> str:
    """Convert 'Services 1' → 'services-1'."""
    s = name.lower().strip()
    s = re.sub(r"[^\w\s-]", "", s)
    s = re.sub(r"[\s_]+", "-", s)
    return s


def main():
    base = Path(__file__).resolve().parents[1]  # database/seeders
    out_dir = base / "translations" / "_extract" / "page-contents"
    out_dir.mkdir(parents=True, exist_ok=True)

    page_strings = {}  # page_name → set of strings (merged across seeders)

    for rel in PAGE_SEEDERS:
        path = base / rel
        if not path.exists():
            print(f"  ⏭ {rel} (not found)")
            continue
        php = path.read_text(encoding="utf-8")
        for page_name, body in find_page_blocks(php):
            strings = extract_translatable_strings(body)
            page_strings.setdefault(page_name, set()).update(strings)
            print(f"  📄 {rel} → {page_name}: +{len(strings)} strings")

    print(f"\n{'=' * 60}\nWriting skeletons to {out_dir}\n{'=' * 60}")
    for page_name, strings in sorted(page_strings.items()):
        slug = slugify(page_name)
        # English-keyed dict, value initially equals key.
        skeleton = {s: s for s in sorted(strings)}
        out_file = out_dir / f"{slug}.json"
        with out_file.open("w", encoding="utf-8") as f:
            json.dump(skeleton, f, ensure_ascii=False, indent=2)
        print(f"  ✓ {slug}.json ({len(skeleton)} strings)")

    total = sum(len(s) for s in page_strings.values())
    print(f"\nTotal: {len(page_strings)} pages, {total} unique strings extracted")


if __name__ == "__main__":
    main()
