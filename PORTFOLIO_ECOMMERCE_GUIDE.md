# Elafcart Portfolio + E-commerce - Digital & Physical Products

আপনার পোর্টফোলিও সাইটে এখন **ডিজিটাল + ফিজিক্যাল প্রোডাক্ট** দুটোই বিক্রি করতে পারবেন!

## 🎯 কি কি থাকবে?

### Digital Products (Instant Download):
- ✅ Portfolio Templates (React, Vue, HTML)
- ✅ UI Kits (Figma, Code)
- ✅ Laravel Boilerplates, SaaS Kits
- ✅ Icon Packs, Illustrations
- ✅ Notion Templates, Courses
- ✅ E-books, Guides

**Features:**
- Instant download after payment
- Lifetime updates
- Commercial license
- No shipping needed
- Auto-complete orders
- License codes (optional)

### Physical Products (Shipping):
- ✅ Branded T-Shirts, Hoodies
- ✅ Desk Mats, Mousepads
- ✅ Stickers, Posters
- ✅ Mugs, Accessories
- ✅ Books (printed)

**Features:**
- Inventory management
- Shipping calculation
- 30 days returns
- Weight, dimensions

---

## 🛠️ Setup - Digital Products Enable

### Step 1: Ecommerce Settings

Admin → Ecommerce → Settings → General:

```
✅ Enable support for digital products = YES
✅ Allow guest checkout for digital products = YES
✅ Auto-complete digital orders after payment = YES
✅ Enable license codes for digital products = YES (if you want)
✅ Disable physical product = NO (keep both)
```

Admin → Ecommerce → Settings → Checkout:
- Enable guest checkout

### Step 2: Theme Already Updated

আমি আপনার `elafcart` থিমে সব করে দিয়েছি:

**Updated Files:**
- `theme.json` → added ecommerce to required_plugins
- `config.php` → ecommerce assets
- `assets/css/ecommerce.css` → Product cards, digital/physical badges
- `assets/js/ecommerce.js` → Quantity, wishlist, thumbnails
- `views/ecommerce/product.blade.php` → Single product with digital/physical info
- `views/ecommerce/includes/product-item.blade.php` → Product card with type badges
- `views/ecommerce/products.blade.php` → Listing with filter tabs (All/Digital/Physical)
- `views/ecommerce/cart.blade.php` → Cart with digital notice
- `partials/shortcodes/products/index.blade.php` → Shortcode for products

**3 New Shortcodes:**
```
[products title="My Products" subtitle="Shop" product_type="all" limit="8"][/products]
[digital-products title="Digital Products" subtitle="Instant Download" limit="8"][/digital-products]
[physical-products title="Physical Products" subtitle="Merch & Accessories" limit="8"][/physical-products]
```

---

## 📦 How to Create Products

### Digital Product Create:

Admin → Ecommerce → Products → Create:

1. **General:**
   - Name: `Portfolio Template - React + Tailwind`
   - Product Type: **Digital** (important!)
   - Price: $49, Sale Price: $39
   - SKU: `DIG-REACT-001`
   - Categories: `Templates`
   - Image: Upload preview image
   - Images: More screenshots

2. **Digital Attachments:**
   - Upload files: ZIP with source code
   - Or add external link (Google Drive, etc)
   - Example: `portfolio-template-react.zip` (15 MB)

3. **Description:**
   - Short description: `Modern portfolio template built with React and Tailwind CSS`
   - Content: Full features, what includes, changelog, etc.

4. **License Codes (optional):**
   - Enable "Generate license code"
   - Add license codes if selling software

5. **Save & Publish**

### Physical Product Create:

Admin → Ecommerce → Products → Create:

1. **General:**
   - Name: `Branded T-Shirt - Black`
   - Product Type: **Physical**
   - Price: $29
   - Quantity: 100
   - With storehouse management: YES
   - Weight: 200g
   - SKU: `PHY-TSHIRT-BLK-M`

2. **Variations (if needed):**
   - Create attribute: Size (S, M, L, XL), Color (Black, White)
   - Add variations with different price/quantity

3. **Images:** Upload product photos

4. **Shipping:**
   - Length, Wide, Height
   - Weight for shipping calculation

5. **Save & Publish**

---

## 🏠 Homepage Setup with Products

Admin → Pages → Home → Content:

```
[hero title="Hi, I'm Rakib" subtitle="Creator & Developer" description="I build digital products and share my knowledge through templates, courses, and merch."][/hero]
[about title="About Me" subtitle="Who I Am"][/about]
[services title="What I Do" subtitle="Services" limit="6"][/services]
[projects title="Selected Works" subtitle="Portfolio" limit="6"][/projects]

[digital-products title="Digital Products" subtitle="Instant Download" description="Templates, UI kits, boilerplates - instant download after purchase" limit="8"][/digital-products]

[physical-products title="Physical Products" subtitle="Merch & Accessories" description="T-shirts, hoodies, desk mats - shipped worldwide" limit="4"][/physical-products]

[products title="All Products" subtitle="Shop Everything" product_type="all" limit="8"][/products]

[skills title="My Skills" subtitle="Expertise"][/skills]
[testimonials title="What Clients Say" subtitle="Testimonials" limit="3"][/testimonials]
[contact title="Let's Work Together" subtitle="Contact"][/contact]
```

---

## 🎨 Product Card Design

**Digital Product Card Shows:**
- Purple badge: "Digital" with download icon
- Sale badge if on sale
- Instant Download + Files count
- Gradient placeholder (purple)

**Physical Product Card Shows:**
- Black badge: "Physical" with box icon
- Free Shipping + In Stock
- Gradient placeholder (orange/red)

**Single Product Page:**
- If Digital: Shows "Digital Product Includes" box with checklist, Files tab, FAQ about download
- If Physical: Shows shipping info, 30 days returns, specifications
- Both: Quantity, Add to Cart, Buy Now, Wishlist, Share

---

## 🛒 Cart & Checkout Flow

**Cart Page:**
- Shows product type badges
- Digital note: "Instant Download" 
- Physical: normal
- Summary with digital notice: "Digital products will be available for instant download after payment"

**Checkout:**
- For digital only orders: No shipping address needed (if enabled)
- For mixed: Shipping address required
- Payment: Stripe, PayPal, SSLCommerz, etc.
- After payment:
  - Digital: Email with download links + auto-complete order
  - Physical: Normal order flow with shipping

**Customer Dashboard:**
- My Orders
- Digital Products → Download files
- License Codes (if enabled)

---

## 💡 Product Ideas for Portfolio Site

**Digital (High Margin, No Inventory):**
1. Portfolio Templates - $29-$79
2. Admin Dashboard Templates - $49-$99
3. UI Kits (Figma + Code) - $39-$79
4. Laravel Starter Kits - $99-$199
5. Icon Packs - $19-$39
6. Notion Templates - $9-$29
7. E-books / Guides - $15-$49
8. Video Courses - $49-$199
9. Resume Templates - $12-$25
10. Brand Guidelines Templates - $29-$59

**Physical (Branding + Extra Income):**
1. T-Shirts with logo - $25-$35
2. Hoodies - $45-$65
3. Desk Mats - $25-$40
4. Stickers Pack - $10-$15
5. Mugs - $15-$20
6. Notebooks - $12-$18
7. Caps - $20-$25
8. Tote Bags - $18-$25

---

## 🔧 Advanced Settings

**Digital Product Settings (config):**
```php
// platform/plugins/ecommerce/config/general.php
'digital_products' => [
    'allowed_mime_types' => ['application/zip', 'application/pdf', ...],
]
```

**Auto-complete digital orders:**
- Admin → Settings → Ecommerce → Digital Products → Auto-complete = YES
- Means: When customer pays for digital-only order, order status becomes Completed automatically, no manual processing

**Guest Checkout for Digital:**
- Enable: Customers can buy digital without creating account, download link sent via email

---

## 📊 Pricing Strategy

**Digital:**
- Cost: One-time creation, infinite sales
- Price: $19-$199 depending on value
- Offer bundle: 3 templates for $99 (instead of $147)
- Subscription: Monthly access to all templates for $19/month (need subscription plugin)

**Physical:**
- Cost: Product + shipping + inventory
- Price: Product cost x 2.5-3
- Free shipping over $50 to increase AOV

---

## 🚀 Next Steps

1. **Enable digital products** in Ecommerce settings
2. **Create 2-3 digital products** as test (upload ZIP)
3. **Create 1-2 physical products** with variations
4. **Update homepage** with [digital-products] and [physical-products] shortcodes
5. **Test checkout** with both types
6. **Setup payment gateway** (Stripe/PayPal/SSLCommerz for BD)
7. **Setup email** for digital download links

---

## 📝 Example Product Descriptions

**Digital:**
```
🚀 Modern Portfolio Template - React + Tailwind

What you get:
- 10+ pages (Home, About, Projects, Blog, etc)
- Fully responsive
- Dark/Light mode
- AOS animations
- Contact form
- Documentation
- Figma file included
- Lifetime updates
- Commercial license

Tech Stack: React 18, Tailwind CSS, Framer Motion
Files: ZIP (25 MB) + Figma link

Instant download after purchase!
```

**Physical:**
```
👕 Developer T-Shirt - Premium Cotton

- 100% premium cotton
- Unisex fit
- Available in S, M, L, XL
- Black & White colors
- Screen printed logo
- Pre-shrunk

Shipping: 3-5 business days
Returns: 30 days easy returns
```

---

কোনো specific product type setup করতে help লাগলে বলুন, আমি করে দেব!
