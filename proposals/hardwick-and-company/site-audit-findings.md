# Site Audit — hardwickandcompany.com

**Client:** Hardwick & Company — Fine Men's Clothing, 70 2nd St NE, Cleveland, TN 37311
**Platform:** WordPress + WooCommerce
**Audited:** [Date]
**Method:** Manual page-by-page review — homepage, shop, category, product, cart, checkout, about, contact, and policy pages; plus sitemaps, robots.txt, media delivery, and product data structure.

---

## Executive summary

Hardwick & Company is a genuine Cleveland institution — a mercantile store founded in 1926 by C.L. Hardwick that grew into a woolen mill and is still trading a century later, known regionally for tux and suit fitting and for brands like Pendleton, The Normal Brand, Scully, Southern Casanova, Fish Hippie, Bald Headed Blues, Trask, Over Under, Genteal and Martin Dingman.

The website does not reflect any of that. Three issues are urgent because they actively cost the business money today:

1. **The contact page still contains the WordPress theme's demo content** — fake New York and Los Angeles addresses and `@crafty.shop` placeholder emails. There is no working way for a customer to reach the store.
2. **The homepage hero video is broken** — an error message occupies the most valuable space on the site.
3. **The obvious `/contact/` URL returns HTTP 500**, while the real page lives at `/contact-2/`.

Beyond those, the catalogue architecture is working against the business: 60+ duplicated categories with placeholder imagery, and product sizes created as separate products rather than variations.

---

## 🔴 CRITICAL

### 1. Contact page contains theme demo / placeholder content

**Location:** https://hardwickandcompany.com/contact-2/ (titled "Contact")

The page renders the stock content shipped with the theme:

> **New York** — 456 189th Street, Lower East West Village
> **Los Angeles** — 12 Buenas Tardes Blvd., Griffith Hills
> General: howdy@crafty.shop · Press: press@crafty.shop · Returns: returns@crafty.shop · Wholesale: sales@crafty.shop

**Impact:** No Cleveland address, no phone number, no store hours, no working email. A customer wanting to call the store, ask about stock, or book a tux fitting cannot. All four email addresses belong to the theme vendor, not the business — any message sent goes nowhere.

**Also relevant:** the business is at 70 2nd St NE, Cleveland, TN 37311. Older public listings reference 120 N. Ocoee St. and 92 Oak St. SW, so the site should carry the current address explicitly to avoid confusing existing customers.

---

### 2. Homepage hero video does not play

**Location:** Homepage hero

The player renders:

> **Video Player**
> Media error: Format(s) not supported or source(s) not found
> Download File: https://hardwickandcompany.com/wp-content/uploads/2024/09/hardwickvideobanner.mp4

**Diagnosis:** The file *is* being served and returns `Content-Type: video/mp4`, so this is not a missing-file or permissions problem. The file is not in a web-deliverable state — most commonly an MP4 encoded with a codec browsers won't decode (e.g. HEVC/H.265), or one lacking the fast-start / progressive-download flag so playback never initialises. Either way the browser refuses it.

**Impact:** The single most valuable area of the homepage — the element that sets the emotional tone for a heritage menswear brand — is a black error box. For a store selling on craft and quality, this is the worst possible first impression.

**Fix:** Re-encode to H.264 MP4 (with a WebM alternative), enable fast-start, add a poster frame, and verify across Chrome, Safari, Firefox, iOS and Android.

---

### 3. `/contact/` returns HTTP 500

**Location:** https://hardwickandcompany.com/contact/

Returns a server error. The live contact page instead lives at the WordPress auto-generated slug `/contact-2/` — created when a page named "Contact" was duplicated.

**Impact:** Anyone typing the obvious URL, following an old link, or reaching it from a search result hits a broken page. `/contact-2/` is also an unprofessional URL to put on a business card, storefront sign, or Instagram bio.

**Fix:** Repair the 500 error, move the content to `/contact/`, and 301-redirect `/contact-2/` → `/contact/`.

---

## 🟠 HIGH

### 4. Refund & Returns policy is a duplicate of the Privacy Policy

**Locations:** `/refund_returns/` and `/privacy-policy/`

Both pages contain **identical text** — Shipping, Refunds, Privacy, Payments & Shipping Options, and Copyright sections are byte-for-byte the same on both URLs.

**Impact:**
- **Legal/compliance exposure** — a returns policy that is actually a privacy policy may not satisfy consumer-protection disclosure requirements, and payment processors and Google Shopping expect a distinct, clearly-labelled returns policy.
- **SEO** — duplicate content; Google will likely index one and ignore the other.
- **Trust** — a customer checking return terms before buying a $300 blazer finds a privacy notice instead.

**Also in this text:**
- Typo: *"Your use of **Hardwickandcompany,com** is subject to…"* (comma instead of a period)
- Typo: *"Shipping and Handling charge **will added** per the purchased product"*
- Incomplete sentence: *"…on purchases made directly through as long as the returned product is not custom, visibly worn or damaged."* — the object of "through" is missing.

---

### 5. Admin username publicly exposed

**Location:** https://hardwickandcompany.com/wp-sitemap-users-1.xml

The WordPress core user sitemap exposes `https://hardwickandcompany.com/author/hw-admin/`, revealing that the administrator account is **`hw-admin`**.

**Impact:** Username enumeration hands an attacker half of a login credential and makes brute-force and credential-stuffing attacks dramatically easier. Combined with the absence of visible login rate-limiting, this is a real risk.

**Fix:** Disable the user sitemap, block `/?author=` scanning, add login rate-limiting, and ideally rename the admin account.

---

### 6. Catalogue architecture: sizes created as separate products

**Location:** e.g. https://hardwickandcompany.com/product-category/swim-shorts/

"Water Activated Swim Trunks" exists as **eleven separate products** — five sizes (S, M, L, XL, 2XL) across two colourways, each its own product record and its own URL.

**Impact:**
- **Shop pages flood with near-identical rows** — eleven listings for what a customer perceives as two products. It reads as clutter, not curation.
- **SEO** — eleven pages of near-duplicate content competing for the same query (keyword cannibalisation), diluting ranking potential across the whole catalogue.
- **Inventory** — stock, pricing, and edits must be repeated across every size record. Genuinely unmanageable at scale.
- **UX** — the customer must leave the grid and open a product page to discover that other sizes exist.

**Fix:** Convert to true WooCommerce variable products — one product, size and colour as attributes with a single dropdown. Apply 301 redirects from the retired URLs.

---

### 7. 60+ product categories, almost entirely placeholder imagery and heavy duplication

**Location:** https://hardwickandcompany.com/shop/

The shop page lists **over 60 product categories, essentially every one showing the default grey WooCommerce placeholder image** rather than real product photography.

Duplication is extensive:

| Cluster | Duplicated categories |
|---|---|
| Jackets | Jacket · Jackets · Jacket Coat Vest · Blazer · Blazers and Sport Coats · Sport Coat · Leather Jacket · Rain Jacket · Sweater Jacket |
| Trousers | Pants & Chino · Dress Pants · Straight Pants · Khakis · Bottoms · Jeans · Jeans & Denim |
| Knitwear | Sweater · Sweaters · Sweaters/Pullovers/Hoodies · Pullover · Quarter Zips · Sweatshirts |
| Shirts | Casual Shirts · Dress Shirts · Long Sleeve · Short Sleeve · Polos · Polos & Henley · Flannels · Tees · T-Shirt & Tanks · Top |
| Nightwear | Sleepwear · Sleepwear & Underwear · Pajama · Lounge Pant · Lounge Shirt · Boxer · Underwear |
| Tailoring | Suits · Suits & Tuxedos · Vest · Vests · Suit Vest |

Additionally:
- **"Uncategorized" is publicly visible** — pure noise on a customer-facing page.
- **Near-empty categories** — "Suits & Tuxedos", the category representing a signature high-value service, contains exactly **one** product.
- **Slug inconsistency** — "Scarves" resolves to the slug `scarfs`.
- **There are no filters at all** — no way to shop by size, colour, brand, or price.

**Impact:** With no imagery and no filters, the shop page gives a customer no visual reason to click and no way to narrow down. For a store with this much inventory, this is the single largest conversion barrier on the site.

---

## 🟡 MEDIUM

### 8. Broken heading hierarchy — six H1 tags on the homepage

The homepage renders six separate level-one headings:

`Fine Men's Clothing` · `Old Style - New Name` · `Stunning` · `Comfy` · `Sustainable` · `Stylish`

**Impact:** Search engines use the H1 to determine what a page is about. Six competing H1s dilute topical focus and signal an unedited page. It also breaks screen-reader navigation for visually impaired users.

### 9. Homepage feature labels don't match their content

The four feature blocks are mislabelled relative to the copy inside them:

| Label | Actual content |
|---|---|
| Stunning | Brand names — Scully, Normal Brand, Southern Casanova |
| **Comfy** | "Hardwick & Company started as a mercantile store in 1926" |
| **Sustainable** | "C.L. Hardwick would end up starting a woolen mill…" |
| **Stylish** | "Today, Hardwick & Company has continued that same mission…" |

The 1926 founding and the woolen mill history are sitting under "Comfy" and "Sustainable" — labels that were clearly never updated from the template. **The brand's most valuable story is misfiled under headings that make no sense.**

### 10. Visible theme placeholder text site-wide

Every page on the site renders the literal string:

> **Type and Press "enter" to Search**

This is search-field placeholder copy leaking into visible page content, appearing on the homepage, shop, product, cart, about, contact, and policy pages. It signals an unfinished site.

### 11. Image delivery is unoptimised

- Product pages load full-resolution `-scaled.jpeg` files (e.g. `original-14-scaled.jpeg`) rather than appropriately sized derivatives.
- Decorative images are full-size macOS screenshots — `Screenshot-2024-09-07-at-11.50.46 PM.png` — typically multi-megabyte retina PNGs.
- No WebP or AVIF anywhere; no responsive `srcset`; no lazy loading.

**Impact:** Direct hit to mobile load time, Core Web Vitals, and bounce rate — on a site whose customers increasingly browse on phones.

### 12. No SEO plugin, schema, or meta control

- `/sitemap_index.xml` returns a 404 — no Yoast, Rank Math, or equivalent is installed. Only the bare WordPress core sitemap (`/wp-sitemap.xml`) exists.
- No **LocalBusiness schema** — so Google has no structured address, phone, hours, or geo data for a business whose trade depends on local footfall.
- No **Product schema** — prices and availability won't surface in search results or Google Shopping.
- No per-page meta titles or descriptions under the site's control.

### 13. robots.txt throttles crawlers

```
user-agent: *
disallow:
crawl-delay: 60
```

- **`crawl-delay: 60`** caps crawlers at one page per minute. With a catalogue this large, full indexing becomes impractical.
- **No `Sitemap:` directive** — crawlers must guess where the sitemap lives.

### 14. Product data quality

- **`SKU: N/A`** on products — nothing to key inventory against.
- **Inconsistent title casing** — *"Pendleton Flannel – Tan & Rust plaid"* (lowercase "plaid") alongside *"the normal brand gerard washed twill shirt - xl"* (all lowercase brand name).
- **Sizes embedded in titles** — *"stephen indigo gingham from normal brand medium"*, *"water activated swim trunks clearwater pacific blue 2xl"*. This is the visible symptom of issue #6 and makes titles unreadable in search results.

### 15. Cart and checkout lack trust signals

The cart renders correctly and `/checkout/` routes properly when empty, but the flow carries none of the reassurance a first-time buyer looks for: no shipping cost visibility before checkout, no security or payment trust badges, no progress indicator, and no returns reassurance at the point of purchase.

### 16. Missing conversion and retention elements

- **No email capture anywhere** — no newsletter signup, despite the Privacy Policy referencing a marketing list sent 2–3 times monthly. The list is referenced but never built on-site.
- **No customer reviews or testimonials** — for a business built on a century of personal relationships, this is the most persuasive content available and none of it is on the site.
- **No size or fit guide** — critical for a menswear retailer specifically known for tux and suit fitting.
- **No fitting appointment mechanism** — the signature high-value service is invisible.

---

## 🔵 LOW / COPY

| Issue | Location |
|---|---|
| *"When only the finest will **due**"* — should be "do" | Homepage hero |
| *"Hardwickandcompany**,**com"* — comma for period | Privacy / Refund policy |
| *"Shipping and Handling charge **will added**"* | Privacy / Refund policy |
| Incomplete sentence: *"…made directly through as long as…"* | Privacy / Refund policy |
| *"Hardwick and Company offers some of the top-of-the-line **brand** such as"* — should be "brands" | Homepage |

---

## Priority order

| Priority | Items |
|---|---|
| **Do immediately** | 1 (demo contact content) · 2 (hero video) · 3 (`/contact/` 500) |
| **Do this month** | 4 (refund policy) · 5 (username exposure) · 7 (categories) · 13 (robots.txt) |
| **Do this quarter** | 6 (variations) · 8 (headings) · 11 (images) · 12 (SEO/schema) · 16 (conversion) |
| **Polish** | 9 · 10 · 14 · 15 · copy fixes |

---

## What's genuinely working

Worth saying plainly, because it shapes the recommendation:

- **The brand is exceptional.** A 1926 founding, a woolen mill, a century of continuous trade, and regional fame for tux and suit fitting. Very few retailers have this story.
- **2026 is the centennial year.** A once-in-a-lifetime marketing moment that the site currently mentions only as "nearly 100 years".
- **The About page is structurally sound** — the "find your style" section (Commitment to quality, Comfort meets everyday cool, The perfect fit, Brilliant Minds) is well-conceived and close to good. It needs real photography and the fitting service made actionable.
- **WooCommerce is functioning.** Cart, account, and checkout routing all work; the platform is a solid base to build on rather than something to replace.
- **Product descriptions are well written** — the Pendleton flannel copy is genuinely good retail writing.
- **The catalogue is deep** — brands most independents can't get hold of. The inventory is an asset currently hidden behind placeholder images.

**Bottom line:** this is not a rebuild-from-scratch situation. It's a strong business with a website that was launched unfinished and never finished. The fixes are well-understood and bounded.
