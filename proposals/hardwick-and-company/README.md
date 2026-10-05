# Hardwick and Company — Client Proposals

Two standalone proposals for **hardwickandcompany.com** (WordPress + WooCommerce menswear store, Cleveland TN, est. 1926).

## Files

| File | Purpose |
|---|---|
| `Proposal-A-Technical-500.md` | **$500** — technical audit & remediation only |
| `Proposal-B-UIUX-Technical-1400.md` | **$1,400** — full UI/UX redesign + all technical work |
| `site-audit-findings.md` | Full audit evidence — 16 verified issues, with locations and impact |
| `Hardwick-and-Company-Proposals.html` | Print-ready combined doc (open in browser → Print → Save as PDF) |
| `build-html.py` | Regenerates the HTML from the Markdown: `python3 build-html.py` |

## How to send

The `.md` files each contain an **"EMAIL — COPY FROM HERE"** marker. Everything from there down is the email body — copy it into your mail client, fill in the `[bracketed placeholders]`, and send.

Optionally attach the PDF exported from `Hardwick-and-Company-Proposals.html`.

**Before sending, replace:**
- `[Your Name]`, `[Your Email]`, `[Your Phone]`, `[Your Website]`
- `[Date]`
- `[Client Name]`
- In Proposal B: the ongoing maintenance price (`from $X/month`)

**Also ask the client for** (needed to deliver the work): store phone number, opening hours, current street address, and the real email addresses to replace the `@crafty.shop` placeholders.

## Headline findings driving both proposals

1. **Contact page still shows the theme's demo content** — fake New York / Los Angeles addresses and `howdy@crafty.shop` placeholder emails. No way for a customer to reach the store.
2. **`/contact/` returns HTTP 500** — the real page is at `/contact-2/`.
3. **Homepage hero video is broken** — *"Media error: Format(s) not supported or source(s) not found)"*.
4. **Refund & Returns page is a verbatim copy of the Privacy Policy.**
5. **Admin username `hw-admin` exposed** via the WordPress user sitemap.
6. **60+ product categories**, nearly all showing placeholder images, with heavy duplication (9 overlapping jacket categories, 7 trouser categories, etc.).
7. **Sizes built as separate products** — 11 listings for what are really 2 swim trunks.
8. **`robots.txt` sets `crawl-delay: 60`** and never points to the sitemap.

Full detail and evidence in `site-audit-findings.md`.
