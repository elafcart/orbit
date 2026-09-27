#!/usr/bin/env python3
"""Translate seeder JSON files from Vietnamese source to other locales using deep-translator."""

import json
import os
import re
import sys
import time
from pathlib import Path

from deep_translator import GoogleTranslator

# Source locale and target locales
SOURCE_LOCALE = "vi"
TARGET_LOCALES = ["fr", "ar", "tr", "id"]

# Map locale codes to deep-translator language codes
LANG_MAP = {
    "vi": "vi",
    "fr": "fr",
    "ar": "ar",
    "tr": "tr",
    "id": "id",
}

# We translate from English since vi translations were done from English content.
# Better to translate en->target rather than vi->target for quality.
# We'll use the JSON keys (which are English) as source for name/title translations,
# and translate the vi values for other fields.

# Patterns to protect from translation
PLACEHOLDER_RE = re.compile(r"(:[a-zA-Z_]+|%[A-Z]|<[^>]+>|&\w+;|https?://\S+)")
BRAND_NAMES = {
    "Orisa", "KOMONO", "BRAVEN", "HALSTON & CO.", "LORCAN STUDIO",
    "ETIQUE", "MIRETTI", "SOLENE", "RIDGEWAY", "Lumina", "Nomad",
    "Verde", "Pulse", "Bloom", "Helio", "Craft Coffee", "Zora",
    "WhatsApp", "Slack", "Figma", "Notion", "PayPal", "Google",
    "SEO", "UI/UX", "CMS", "SaaS", "NFT", "Web3", "CRM",
    "Blog", "FAQ", "PDF", "ZIP",
}


def protect_text(text):
    """Replace placeholders with tokens before translation."""
    if not isinstance(text, str):
        return text, {}
    tokens = {}
    counter = [0]

    def replace(match):
        token = f"__TK{counter[0]}__"
        tokens[token] = match.group(0)
        counter[0] += 1
        return token

    protected = PLACEHOLDER_RE.sub(replace, text)
    return protected, tokens


def restore_text(text, tokens):
    """Restore protected tokens after translation."""
    if not isinstance(text, str):
        return text
    for token, original in tokens.items():
        text = text.replace(token, original)
    return text


def translate_text(text, target_lang, source_lang="en"):
    """Translate a single text string."""
    if not text or not isinstance(text, str) or len(text.strip()) < 2:
        return text

    # Skip brand names that shouldn't be translated
    if text.strip() in BRAND_NAMES:
        return text

    protected, tokens = protect_text(text)

    try:
        translator = GoogleTranslator(source=source_lang, target=LANG_MAP[target_lang])
        result = translator.translate(protected)
        if result:
            return restore_text(result, tokens)
        return text
    except Exception as e:
        print(f"  ⚠ Translation failed for '{text[:50]}...': {e}", file=sys.stderr)
        return text


def translate_json_value(value, target_lang, key_hint=None, english_key=None):
    """Translate a JSON value (string, dict, or nested)."""
    if isinstance(value, str):
        return translate_text(value, target_lang)
    elif isinstance(value, dict):
        result = {}
        for k, v in value.items():
            result[k] = translate_json_value(v, target_lang, key_hint=k)
        return result
    elif isinstance(value, list):
        return [translate_json_value(item, target_lang) for item in value]
    return value


def translate_file(source_path, target_locale, target_dir):
    """Translate a single JSON file to target locale."""
    filename = os.path.basename(source_path)
    target_path = os.path.join(target_dir, filename)

    with open(source_path, "r", encoding="utf-8") as f:
        data = json.load(f)

    translated = {}

    for english_key, value in data.items():
        if isinstance(value, dict):
            translated_entry = {}
            for field, field_value in value.items():
                if not isinstance(field_value, str) or len(field_value.strip()) < 2:
                    translated_entry[field] = field_value
                    continue

                # For 'name' field, translate from English key if it looks like a title
                if field == "name" and english_key and len(english_key) > 2:
                    translated_entry[field] = translate_text(english_key, target_locale, source_lang="en")
                elif field == "question" and english_key:
                    translated_entry[field] = translate_text(english_key, target_locale, source_lang="en")
                else:
                    # Translate from Vietnamese for descriptions/content
                    translated_entry[field] = translate_text(field_value, target_locale, source_lang="vi")

                time.sleep(0.05)  # Rate limiting

            translated[english_key] = translated_entry
        elif isinstance(value, str):
            # Flat key-value (widget.json, theme-option.json style)
            translated[english_key] = translate_text(value, target_locale, source_lang="vi")
            time.sleep(0.05)
        else:
            translated[english_key] = value

    with open(target_path, "w", encoding="utf-8") as f:
        json.dump(translated, f, ensure_ascii=False, indent=4)

    return target_path


def main():
    base_dir = Path(__file__).parent
    source_dir = base_dir / SOURCE_LOCALE

    if not source_dir.exists():
        print(f"Source directory not found: {source_dir}")
        sys.exit(1)

    json_files = sorted(source_dir.glob("*.json"))
    print(f"Found {len(json_files)} JSON files in {SOURCE_LOCALE}/")

    for target_locale in TARGET_LOCALES:
        target_dir = base_dir / target_locale
        target_dir.mkdir(exist_ok=True)

        print(f"\n{'='*60}")
        print(f"Translating to {target_locale}...")
        print(f"{'='*60}")

        for json_file in json_files:
            filename = json_file.name
            target_path = target_dir / filename

            # Skip if already exists and has content
            if target_path.exists() and target_path.stat().st_size > 10:
                print(f"  ⏭ {filename} (already exists)")
                continue

            print(f"  📝 {filename}...", end=" ", flush=True)
            try:
                result = translate_file(str(json_file), target_locale, str(target_dir))
                print("✓")
            except Exception as e:
                print(f"✗ Error: {e}")

    # Validate all JSON files
    print(f"\n{'='*60}")
    print("Validating all JSON files...")
    print(f"{'='*60}")

    errors = 0
    for locale_dir in [SOURCE_LOCALE] + TARGET_LOCALES:
        locale_path = base_dir / locale_dir
        for json_file in sorted(locale_path.glob("*.json")):
            try:
                with open(json_file, "r", encoding="utf-8") as f:
                    json.load(f)
            except json.JSONDecodeError as e:
                print(f"  ✗ {locale_dir}/{json_file.name}: {e}")
                errors += 1

    if errors == 0:
        print("  ✓ All JSON files are valid!")
    else:
        print(f"  ✗ {errors} file(s) have JSON errors!")

    print("\nDone!")


if __name__ == "__main__":
    main()
