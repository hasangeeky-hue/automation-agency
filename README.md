# automation-agency — Anthropos Automation OS (v5.7)

**The repository root is an installable WordPress theme** ("Anthropos Automation OS", currently v5.7.0).
An early static prototype and a legacy content-import package live in [`/docs`](docs) — kept for
reference only, not part of the live theme.

**What it is:** an AI + n8n business-automation agency site. Dark glass "automation canvas" design,
node-graph / agent-network 3D (Three.js hero + 18 Canvas-2D card effects), 9 automation service
pages (7 customer segments + standalone Marketing Automation and Social Media Automation pages),
each with 5 offer blocks, a ~1200-word AEO article, and 10 guides. A 90-guide + 9-post real content
library ships seeded via PHP (not placeholder copy). FAQ, Organization and Article structured data
(JSON-LD) are server-rendered for AEO/GEO visibility. Update the live theme via Git Updater (it
detects the version bump in both `style.css` and `functions.php`).

```
/                          ← THEME ROOT (deploy target: wp-content/themes/automation-agency)
├── style.css              theme header + all brand styles
├── functions.php          setup, asset enqueue, FAQ data/schema, meta tags, page + content seeding
├── header.php             dark header, 3D knot logo, menu
├── footer.php             CTA band + footer
├── front-page.php         homepage: hero, six services, 9 service pages, real team, blog teaser, FAQ
├── index.php              blog archive — real posts (ao_type=blog), filterable by segment + service
├── single.php             article template — reading progress, Article JSON-LD, reader-guide styles
├── page.php               generic static pages
├── template-service.php   the 9 automation service pages + the /services/ overview
├── template-guides.php    guide library — real posts (ao_type=guide), filterable
├── template-about.php     Company / Vision / Team (real 5-person team + how-we-work)
├── template-faq.php       master FAQ, 4 topic groups, server-rendered + FAQPage schema
├── inc/segments.php       7 segments + 2 service pages: articles, offers, guide titles
├── inc/content-seed*.php  99 real WordPress posts (90 guides + 9 blog posts), seeded via functions.php
├── assets/js/main.js      Canvas-2D effect library, Three.js hero/knots, UI interactions
└── docs/                  NOT part of the theme output — legacy static prototype + WXR import,
                           superseded by the live PHP theme; kept only for historical reference
```

## Install the theme (safe method — never touches WordPress core)

> ⚠️ Do **not** point Hostinger/hPanel Git at `public_html`. That overwrites WordPress
> and breaks the site. Use a plugin (below), or set the deploy directory to
> `public_html/wp-content/themes/automation-agency`.

### Recommended: Git Updater plugin
1. Fully disconnect any existing Hostinger Git deployment; confirm the site loads.
2. Install **Git Updater** (`git-updater.com`) → Plugins → Add New → Upload.
3. Git Updater → **Install Theme** → URI `https://github.com/hasangeeky-hue/automation-agency` → branch `main` → Install.
4. Appearance → Themes → activate **Anthropos Automation OS**.
5. Enable automatic updates so future pushes flow into the theme folder only.

### First admin login after install/update
Pages (Services, Guides, FAQ, About, Blog, Home) and all 99 real posts are created automatically
the first time an administrator loads `wp-admin` after the theme activates or updates — no manual
import step needed. Content seeding is idempotent and guarded by versioned option flags, so
re-running it never creates duplicates.

- Settings → Reading → confirm Homepage: **Home** · Posts page: **Blog**
- Settings → Permalinks → **Post name**

## The design system

- **9 automation service pages**: 7 customer segments + standalone Marketing Automation and Social
  Media Automation pages, each with 5 offer blocks, a full AEO article, and 10 guides.
- **90 guides + 9 blog posts**: real WordPress posts, categorised by customer segment and tagged by
  service, with a custom `ao_type` taxonomy (guide/blog) driving the two-dimension filters.
- **Reader-guide CSS classes**: `.qa` (quick-answer box), `.hl.hl-do` / `.hl-stat` / `.hl-res` /
  `.hl-warn` (callouts), `.faqwrap` (FAQ accordion, server-rendered `<details>`).
- **AEO/GEO**: server-rendered FAQPage, Organization and Article JSON-LD; meta description/canonical/
  Open Graph/Twitter Card tags generated per page type.
- **Palette**: dark "automation canvas" — `--void` #080B14, `--flow` #2FE3D2, `--ai` #8B7CFF, `--cta`
  #FF5C8A, plus 7 segment hues `--g1`–`--g7`.
- **Fonts**: Sora (display) · Instrument Sans (body) · JetBrains Mono (mono).

## Stack

WordPress (custom PHP theme, no page builder) + vanilla JS + Three.js (CDN) + Canvas-2D.
