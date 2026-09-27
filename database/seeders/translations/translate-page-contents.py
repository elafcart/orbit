#!/usr/bin/env python3
"""
Translate page-content English skeletons to all target locales using
Google Translate (deep-translator). Reads from translations/_extract/page-contents/
and writes to translations/{locale}/page-contents/{slug}.json.

Existing per-locale files are NOT overwritten unless --force is passed.
"""

import argparse
import json
import os
import re
import sys
import time
from pathlib import Path

from deep_translator import GoogleTranslator

TARGET_LOCALES = ["ar", "vi", "fr", "tr", "id"]

LANG_MAP = {"ar": "ar", "vi": "vi", "fr": "fr", "tr": "tr", "id": "id"}

# Words/phrases to leave untranslated (brand names, acronyms, proper nouns).
# Matched case-insensitively as whole tokens.
KEEP_LITERAL = {
    "Orisa", "Orisa Studio", "Orisa Agency", "Orisa™",
    "B2B", "B2C", "B2B & B2C", "SaaS", "SEO", "UI/UX", "UX/UI",
    "CRM", "CMS", "API", "NFT", "Web3", "web3", "AI", "ML", "MLOps",
    "CTO", "CEO", "CFO", "WhatsApp", "Viber", "Messenger",
    "Lemon Squeezy", "Slack", "Figma", "Notion", "PayPal", "Google",
    "Framer", "Reddit", "Netflix", "Microsoft", "Discover", "Mailchimp",
    "Shopify", "FAQ", "PDF", "ZIP",
}

# Regex pieces to mask before sending to translator.
PLACEHOLDER_RE = re.compile(
    r"(<[^>]+>"           # HTML tags
    r"|&\w+;"             # HTML entities
    r"|https?://\S+"      # URLs
    r"|\{[a-zA-Z_]+\}"    # {placeholders}
    r"|:[a-zA-Z_]+"       # :placeholders
    r")"
)


def protect(text: str):
    """Replace tags/urls/placeholders with stable tokens before translation."""
    if not isinstance(text, str):
        return text, {}
    tokens = {}

    def repl(m):
        token = f"X{len(tokens):03d}X"
        tokens[token] = m.group(0)
        return token

    masked = PLACEHOLDER_RE.sub(repl, text)
    return masked, tokens


def restore(text: str, tokens: dict) -> str:
    if not isinstance(text, str):
        return text
    for token, original in tokens.items():
        text = text.replace(token, original)
    return text


def is_literal(text: str) -> bool:
    """True if text is a brand/acronym we should not translate."""
    return text.strip() in KEEP_LITERAL


def translate_value(text: str, target: str) -> str:
    if not text or not isinstance(text, str):
        return text
    if is_literal(text):
        return text
    masked, tokens = protect(text)
    if not masked.strip():
        return text
    try:
        translator = GoogleTranslator(source="en", target=LANG_MAP[target])
        result = translator.translate(masked)
        if not result:
            return text
        return restore(result, tokens)
    except Exception as e:
        print(f"    ⚠ translate failed [{target}] {text[:50]!r}: {e}", file=sys.stderr)
        return text


def translate_file(skeleton_path: Path, target: str, out_path: Path) -> int:
    """Translate one skeleton file → one locale file. Returns count translated."""
    data = json.loads(skeleton_path.read_text(encoding="utf-8"))
    out = {}
    count = 0
    for english_key, english_value in data.items():
        # english_key == english_value initially in skeletons.
        translated = translate_value(english_value, target)
        out[english_key] = translated
        count += 1
        time.sleep(0.04)  # gentle rate limit

    out_path.parent.mkdir(parents=True, exist_ok=True)
    out_path.write_text(
        json.dumps(out, ensure_ascii=False, indent=2),
        encoding="utf-8",
    )
    return count


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--force",
        action="store_true",
        help="Overwrite existing per-locale page-content files",
    )
    parser.add_argument(
        "--locales",
        nargs="*",
        default=TARGET_LOCALES,
        help="Subset of locales to process",
    )
    parser.add_argument(
        "--pages",
        nargs="*",
        default=None,
        help="Subset of page slugs to process (e.g. homepage portfolio)",
    )
    args = parser.parse_args()

    base = Path(__file__).resolve().parent
    skeleton_dir = base / "_extract" / "page-contents"
    if not skeleton_dir.exists():
        print(f"Skeleton dir not found: {skeleton_dir}", file=sys.stderr)
        sys.exit(1)

    skeletons = sorted(skeleton_dir.glob("*.json"))
    if args.pages:
        wanted = set(args.pages)
        skeletons = [s for s in skeletons if s.stem in wanted]

    print(f"Skeletons: {len(skeletons)} | Locales: {args.locales}")

    grand_total = 0
    for locale in args.locales:
        out_dir = base / locale / "page-contents"
        print(f"\n=== {locale} ===")
        for skel in skeletons:
            out_path = out_dir / skel.name
            if out_path.exists() and not args.force:
                print(f"  ⏭  {skel.stem} (exists)")
                continue
            print(f"  📝 {skel.stem}...", end=" ", flush=True)
            try:
                n = translate_file(skel, locale, out_path)
                print(f"✓ {n} strings")
                grand_total += n
            except Exception as e:
                print(f"✗ {e}")

    print(f"\nDone. {grand_total} strings translated.")


if __name__ == "__main__":
    main()
