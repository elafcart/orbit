# Proposal A — Technical Audit & Remediation
### Hardwick and Company (hardwickandcompany.com)

**Prepared for:** Hardwick & Company, 70 2nd St NE, Cleveland, TN
**Prepared by:** [Your Name]
**Date:** [Date]
**Investment:** **$500 USD (fixed)**
**Valid for:** 30 days

---

## 📧 EMAIL — COPY FROM HERE

**Subject:** 12 technical issues I found on hardwickandcompany.com — I can fix them for $500

Hi [Client Name],

I went through hardwickandcompany.com properly this week — homepage, shop, product pages, cart, checkout, about, contact, and the policy pages — plus the technical layer underneath that most people never look at: sitemaps, robots.txt, media encoding, and the product database.

First, the good news: the site is live, WooCommerce is running, and the brand story is genuinely great. A store that's been dressing Cleveland since 1926 deserves a site that reflects that.

The honest news: there are **twelve technical problems** quietly costing you traffic, trust, and sales. Three of them are urgent.

### The three urgent ones

**1. Your contact page is still showing the theme's demo content.**
hardwickandcompany.com/contact-2/ currently displays:
- "New York — 456 189th Street, Lower East West Village"
- "Los Angeles — 12 Buenas Tardes Blvd., Griffith Hills"
- Emails: howdy@crafty.shop, press@crafty.shop, returns@crafty.shop, sales@crafty.shop

Those are placeholder addresses shipped with the WordPress theme. There is no Cleveland address, no phone number, no store hours, and no working email. **A customer who wants to call the store or ask about a tux fitting currently cannot.**

**2. The obvious URL — hardwickandcompany.com/contact/ — returns a server error (HTTP 500).** Anyone who types it, or finds an old link to it, hits a broken page.

**3. Your hero video is broken.** The homepage's most valuable space shows a black box reading: *"Media error: Format(s) not supported or source(s) not found."* The video file is being served, but it isn't encoded in a web-playable format, so browsers refuse to play it. Your first impression is a broken media player.

### The other nine

4. **Refund & Returns policy is a word-for-word copy of your Privacy Policy.** Both pages contain identical text. WooCommerce, card processors, and Google Shopping all expect a distinct, clearly-labelled returns policy. This is also a real legal and compliance exposure.
5. **Your admin username is public.** Your sitemap exposes /author/hw-admin/, handing attackers half of a login.
6. **robots.txt throttles Google to one page per minute** (`crawl-delay: 60`) and never points to your sitemap.
7. **Homepage has six separate H1 headings** instead of one — confusing search engines about what the page is about.
8. **60+ product categories, almost all showing the grey WooCommerce placeholder image**, with heavy duplication (Blazer / Blazers and Sport Coats / Sport Coat, Jeans / Jeans & Denim, Polos / Polos & Henley, and so on). "Uncategorized" is publicly visible.
9. **Sizes are separate products instead of variations.** "Water Activated Swim Trunks" exists as 11 different listings (S, M, L, XL, 2XL across two colours). It's duplicate content, it floods your shop pages, and it makes inventory unmanageable.
10. **Unoptimised images** — full-size `-scaled.jpeg` product photos and multi-megabyte `Screenshot-2024-09-07…png` files, with no WebP and no lazy loading.
11. **Theme placeholder text is visible on every page** — "Type and Press 'enter' to Search" renders as real page content site-wide.
12. **No SEO plugin, no schema markup, no meta descriptions.** Your store has no LocalBusiness or Product structured data, so Google can't show your address, hours, or prices in results.

There are also copy errors a customer notices: *"When only the finest will **due**"* (should be "do"), *"Hardwickandcompany**,**com"*, and an incomplete sentence in your refund section.

### What I'll do — Scope of Work

**1. Broken media & the homepage hero**
- Re-encode the banner video to web-standard H.264 MP4 + WebM, fast-start enabled
- Add a poster image so the space looks right even before playback
- Verify playback across Chrome, Safari, Firefox, and mobile

**2. Contact & store information (urgent)**
- Build a proper contact page with your real Cleveland address, phone, hours, and a working enquiry form
- Add an embedded Google Map so locals can find the store
- Replace all four placeholder `@crafty.shop` emails with real, working addresses
- Fix the HTTP 500 on `/contact/` and 301-redirect `/contact-2/` → `/contact/`

**3. Legal & policy pages**
- Write a genuine, standalone Refund & Returns policy (separate from Privacy Policy)
- Correct the typos and the incomplete sentence in the existing Privacy Policy
- Ensure Shipping, Refunds, and Privacy are clearly separated and linked from the footer and checkout

**4. Security hardening**
- Remove the user/author sitemap and stop admin username enumeration
- Disable XML-RPC, block author-scanning, and disable theme/plugin file editing
- Add login rate-limiting and standard security headers
- Confirm SSL is enforced site-wide with no mixed content

**5. SEO foundation**
- Install and configure an SEO plugin (Yoast or Rank Math)
- Write meta titles and descriptions for homepage, shop, about, contact, and policies
- Add LocalBusiness schema (address, phone, hours, geo) and Product schema
- Fix robots.txt: remove `crawl-delay: 60`, add a proper `Sitemap:` directive
- Submit and verify the site in Google Search Console and set up GA4 analytics

**6. Site structure & code quality**
- Correct heading hierarchy — one H1 per page, logical H2/H3 below
- Remove the visible "Type and Press 'enter' to Search" placeholder text
- Merge or delete duplicate product categories; hide "Uncategorised" and empty categories
- Add canonical tags and 301 redirects for duplicate variant product URLs
- **Product data hygiene:** populate missing SKUs and normalise title casing (e.g. *"the normal brand gerard washed twill shirt - xl"* → *"The Normal Brand — Gerard Washed Twill Shirt"*), and strip sizes out of product titles

**7. Performance**
- Convert images to WebP with compression; compress the oversized screenshot PNGs
- Enable lazy loading and responsive `srcset` sizing
- Set up page caching, minification, and deferred JavaScript
- Clean the WordPress database (revisions, transients, orphaned meta)

**8. Stability & safety**
- Full backup before any work begins; work on a staging copy, never your live site
- Update WordPress core, theme, and plugins to current versions
- Configure automated scheduled backups going forward

### Deliverables

- ✅ Fully repaired, secured, and optimised live site
- ✅ Working hero video with poster fallback
- ✅ Real, working contact page with map and store details
- ✅ Standalone Refund & Returns policy
- ✅ SEO plugin configured + Search Console & GA4 connected
- ✅ Cleaned category structure and product data
- ✅ Automated backups configured
- ✅ **Written before/after report** documenting every change

### Timeline

**7–10 business days** from project start and receipt of store details (address, phone, hours, real email addresses).

### Investment

> ## $500 USD — fixed price
> No hourly billing. No surprise add-ons.

**Payment terms:** 50% ($250) to begin · 50% ($250) on completion and your approval.
**Includes:** 2 rounds of revisions · 14-day post-launch warranty on all work delivered.

### Not included

So there are no surprises — this proposal covers **technical repair and optimisation only**. It does **not** include visual redesign, new page layouts, custom features, Figma mockups, product photography or category imagery, or bulk product data entry. Those are covered in my separate full UI/UX proposal, which I'm happy to share.

### Next steps

Reply to this email with your store's phone number, hours, and the email addresses you'd like used, and I can start within 48 hours. If you'd rather talk it through first, I'm happy to do a 15-minute call and screen-share the issues live.

Either way, the contact page is worth fixing this week — right now it's telling customers you're in New York and Los Angeles.

Warm regards,
**[Your Name]**
[Your Email] · [Your Phone] · [Your Website]

---

## Appendix — Verified Findings (technical evidence)

| # | Issue | Location | Severity |
|---|---|---|---|
| 1 | Hero video fails: "Media error: Format(s) not supported or source(s) not found" | `/` | Critical |
| 2 | Theme demo content: fake NY/LA addresses, `@crafty.shop` emails | `/contact-2/` | Critical |
| 3 | HTTP 500 server error | `/contact/` | Critical |
| 4 | Refund & Returns page is byte-identical to Privacy Policy | `/refund_returns/` | High |
| 5 | Admin username `hw-admin` exposed via author sitemap | `/wp-sitemap-users-1.xml` | High |
| 6 | `crawl-delay: 60`; no `Sitemap:` directive | `/robots.txt` | High |
| 7 | Six H1 tags on one page | `/` | Medium |
| 8 | 60+ categories, near-universal placeholder images, heavy duplication | `/shop/` | High |
| 9 | Variants created as separate products (11 listings for 2 items) | `/product-category/swim-shorts/` | High |
| 10 | Full-size `-scaled.jpeg` + multi-MB `Screenshot-…png`; no WebP/lazy load | site-wide | Medium |
| 11 | Placeholder text "Type and Press 'enter' to Search" visible on every page | site-wide | Medium |
| 12 | No SEO plugin, no LocalBusiness/Product schema | site-wide | Medium |
| 13 | `SKU: N/A`; inconsistent title casing; sizes embedded in titles | product pages | Medium |
| 14 | Copy errors: "finest will due", "Hardwickandcompany,com", incomplete sentence | `/`, policies | Low |
| 15 | Homepage feature labels don't match their copy ("Comfy" shows 1926 history) | `/` | Medium |
| 16 | `/sitemap_index.xml` 404s — no SEO plugin present | site-wide | Low |

Full detail in: `site-audit-findings.md`
