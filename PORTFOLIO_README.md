# Elafcart Portfolio - Personal Portfolio Website

আপনার জন্য একটি সম্পূর্ণ **Personal Portfolio Website** তৈরি করে দিয়েছি Botble CMS এ।

## 🎨 Theme: `platform/themes/elafcart`

Modern, minimal, professional portfolio theme যা developer, designer, freelancer সবার জন্য perfect।

### Features:
- ✅ Responsive & Modern Design (Space Grotesk + Inter fonts)
- ✅ Dark/Light ready, Bootstrap 5
- ✅ AOS Animation, Typed.js effect
- ✅ Sections: Hero, About, Services, Projects, Skills, Experience, Testimonials, Blog, Contact
- ✅ Portfolio Project Single Page (with gallery, metrics, related projects)
- ✅ Service Single Page
- ✅ Blog Single & Listing
- ✅ SEO Optimized, Fast Loading

### Shortcodes (8 টা):
```
[hero title="Hi, I'm Rakib" subtitle="Full Stack Developer" description="..." image="..."][/hero]
[about title="About Me" subtitle="Passionate developer" description="..." image="..." name="Rakib" email="hello@example.com" location="Dhaka, Bangladesh"][/about]
[services title="What I Do" subtitle="Services" limit="6"][/services]
[projects title="Selected Works" subtitle="Portfolio" limit="6"][/projects]
[skills title="My Skills" subtitle="Expertise"][/skills]
[experience title="Experience" subtitle="Work History"][/experience]
[testimonials title="What Clients Say" subtitle="Testimonials" limit="3"][/testimonials]
[blog-posts title="Latest Articles" subtitle="Blog" limit="3"][/blog-posts]
[contact title="Let's Work Together" subtitle="Contact" description="Have a project in mind?"][/contact]
```

---

## 🚀 Setup Instructions (5 মিনিটে Portfolio Live)

### Step 1: Theme Activate
```bash
php artisan cms:theme:activate elafcart
php artisan cms:theme:assets:publish elafcart
```
অথবা Admin → Appearance → Themes → Elafcart Portfolio → Activate

### Step 2: Plugins Activate
Admin → Plugins → সব Activate করুন:
- Portfolio (Projects, Services)
- Blog
- Testimonial
- Team (optional)
- Contact
- Gallery (optional)

### Step 3: Theme Options Setup
Admin → Appearance → Theme Options → General:
- Site Title: `folio.` বা আপনার নাম
- Logo, Favicon
- Hero Name, Hero Typed Text
- Social Links: GitHub, LinkedIn, Twitter, Dribbble
- Email, Phone, Address
- Footer CTA

### Step 4: Menu Create
Admin → Appearance → Menus:
- Create New Menu: `main-menu`
- Add items: Home (#home), About (#about), Services (#services), Projects (#projects), Blog (/blog), Contact (#contact)
- Location: Main Menu

### Step 5: Homepage Create
Admin → Pages → Create New Page:
- **Name:** Home
- **Template:** Homepage
- **Content:** নিচের shortcode copy-paste করুন:

```
[hero title="Hi, I'm Rakib Hasan" subtitle="Full Stack Developer" description="I craft exceptional digital experiences with clean code and thoughtful design. Specializing in Laravel, React & modern web technologies." button_text_1="View My Work" button_link_1="#projects" button_text_2="Download CV" button_link_2="#"][/hero]
[about title="About Me" subtitle="Passionate developer from Dhaka" description="I'm a full-stack developer with 5+ years of experience building digital products. I love solving complex problems with elegant solutions. Based in Dhaka, Bangladesh, I work with clients worldwide to bring their ideas to life." name="Rakib Hasan" email="hello@elafcart.com" location="Dhaka, Bangladesh"][/about]
[services title="What I Do" subtitle="Services" description="I offer a range of services to help bring your digital vision to life" limit="6"][/services]
[projects title="Selected Works" subtitle="Portfolio" limit="6"][/projects]
[skills title="My Skills" subtitle="Expertise"][/skills]
[experience title="Experience" subtitle="Work History"][/experience]
[testimonials title="What Clients Say" subtitle="Testimonials" limit="3"][/testimonials]
[blog-posts title="Latest Articles" subtitle="Blog" limit="3"][/blog-posts]
[contact title="Let's Work Together" subtitle="Contact" description="Have a project in mind? Let's discuss how we can work together to bring your ideas to life."][/contact]
```

- Save & Publish
- তারপর Admin → Appearance → Theme Options → Page → Homepage = Home সিলেক্ট করুন

### Step 6: Add Demo Data (Optional)

**Portfolio Projects:**
Admin → Portfolios → Projects → Create:
- E-commerce Platform (image, description, client, place, link, content)
- SaaS Dashboard
- Real Estate App
- etc.

**Services:**
Admin → Portfolios → Services → Create:
- Web Development
- UI/UX Design
- etc.

**Testimonials:**
Admin → Testimonials → Create

**Blog Posts:**
Admin → Blog → Posts → Create

---

## 📁 File Structure

```
platform/themes/elafcart/
├── theme.json
├── config.php
├── assets/css/theme.css (main CSS - 800+ lines modern design)
├── assets/js/main.js (AOS, Typed.js, scroll effects)
├── public/css/theme.css (compiled)
├── public/js/main.js
├── layouts/base.blade.php (master)
├── layouts/default.blade.php
├── layouts/homepage.blade.php
├── partials/header.blade.php
├── partials/footer.blade.php
├── partials/shortcodes/
│   ├── hero/index.blade.php
│   ├── about/index.blade.php
│   ├── services/index.blade.php
│   ├── projects/index.blade.php
│   ├── skills/index.blade.php
│   ├── experience/index.blade.php
│   ├── testimonials/index.blade.php
│   ├── contact/index.blade.php
│   └── blog/index.blade.php
├── views/index.blade.php (setup guide)
├── views/page.blade.php
├── views/portfolio/project.blade.php (single project)
├── views/portfolio/service.blade.php
├── views/post.blade.php
├── views/loop.blade.php (blog listing)
├── functions/functions.php
├── functions/shortcodes.php (8 shortcodes registered)
└── src/Forms/ShortcodeForm.php
```

---

## 🎯 Live Demo Content Ideas

**Hero:**
- Title: Hi, I'm [Your Name]
- Subtitle: Full Stack Developer / UI/UX Designer
- Description: Short intro 2 lines
- Image: Your professional photo (400x500 recommended)
- Buttons: View Work + Download CV

**About:**
- Your story, experience, location, availability

**Projects (6 featured):**
1. E-commerce Platform - Laravel + React
2. SaaS Dashboard - Analytics
3. Real Estate App - Property management
4. Learning Platform - LMS
5. Restaurant Booking - Food ordering
6. Portfolio CMS - For agencies

**Services (6):**
- Web Development
- UI/UX Design
- E-commerce
- API Development
- Consulting
- Maintenance

---

## 🔧 Customization

**Colors:** Appearance → Theme Options → General → Primary Color (default #6366f1)
**Fonts:** Google Fonts already included (Space Grotesk + Inter)
**CSS:** Edit `assets/css/theme.css` then copy to `public/css/theme.css`
**JS:** Edit `assets/js/main.js`

---

## 📱 Responsive

- Mobile first design
- Tablet & Desktop optimized
- Tested on all devices

---

## 🚀 Next Steps

1. Theme activate করুন
2. Homepage shortcode দিয়ে page বানান
3. Portfolio projects add করুন
4. Social links & contact info update করুন
5. Blog posts লিখুন

কোনো section customize করতে চাইলে বলুন, আমি করে দেব!
