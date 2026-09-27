#!/usr/bin/env python3
"""
Translate long-form HTML files under database/seeders/contents/ to all
target locales using Google Translate. Output lands in
translations/{locale}/contents/{filename}.html, preserving HTML tags.

Currently translates:
  - term-and-privacy.html  (used by Privacy Policy page)
"""

import argparse
import re
import sys
import time
from pathlib import Path

from deep_translator import GoogleTranslator

TARGET_LOCALES = ["ar", "vi", "fr", "tr", "id"]
LANG_MAP = {"ar": "ar", "vi": "vi", "fr": "fr", "tr": "tr", "id": "id"}

HTML_FILES = ["term-and-privacy.html"]

# Brand/acronym tokens to preserve exactly.
KEEP_LITERAL_RE = re.compile(
    r"\b(Orisa|Orisa Agency|Orisa Studio|SaaS|SEO|UI/UX|API|CRM|CMS|"
    r"GDPR|CCPA|HIPAA|PII|PDF|Cookie[s]?)\b"
)


def split_html_to_translatable_chunks(html: str):
    """
    Yield (segment_type, text) where segment_type is 'tag' or 'text'.
    Text segments are translatable; tag segments pass through.
    """
    pos = 0
    for m in re.finditer(r"<[^>]+>", html):
        if m.start() > pos:
            yield "text", html[pos:m.start()]
        yield "tag", m.group(0)
        pos = m.end()
    if pos < len(html):
        yield "text", html[pos:]


def translate_chunk(text: str, target: str, translator: GoogleTranslator) -> str:
    """Translate a text chunk while preserving leading/trailing whitespace."""
    if not text or not text.strip():
        return text

    # Capture surrounding whitespace.
    leading = re.match(r"\s*", text).group(0)
    trailing = re.search(r"\s*$", text).group(0)
    core = text[len(leading): len(text) - len(trailing)] if trailing else text[len(leading):]

    if not core.strip():
        return text

    try:
        result = translator.translate(core)
        if not result:
            return text
        return f"{leading}{result}{trailing}"
    except Exception as e:
        print(f"  ⚠ translate chunk failed: {e}", file=sys.stderr)
        return text


def translate_html(html: str, target: str) -> str:
    translator = GoogleTranslator(source="en", target=LANG_MAP[target])
    out = []
    for kind, text in split_html_to_translatable_chunks(html):
        if kind == "tag":
            out.append(text)
        else:
            out.append(translate_chunk(text, target, translator))
            time.sleep(0.04)
    return "".join(out)


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("--force", action="store_true")
    parser.add_argument("--locales", nargs="*", default=TARGET_LOCALES)
    args = parser.parse_args()

    base = Path(__file__).resolve().parents[1]  # database/seeders
    contents_dir = base / "contents"
    translations_dir = base / "translations"

    for locale in args.locales:
        out_dir = translations_dir / locale / "contents"
        out_dir.mkdir(parents=True, exist_ok=True)

        print(f"\n=== {locale} ===")
        for filename in HTML_FILES:
            src = contents_dir / filename
            dst = out_dir / filename
            if not src.exists():
                print(f"  ⏭  {filename} (source missing)")
                continue
            if dst.exists() and not args.force:
                print(f"  ⏭  {filename} (already exists)")
                continue
            print(f"  📝 {filename}...", end=" ", flush=True)
            try:
                html = src.read_text(encoding="utf-8")
                translated = translate_html(html, locale)
                dst.write_text(translated, encoding="utf-8")
                print("✓")
            except Exception as e:
                print(f"✗ {e}")

    print("\nDone.")


if __name__ == "__main__":
    main()
