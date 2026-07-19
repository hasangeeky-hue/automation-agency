# automation-agency — Anthropos Automation OS (v3)

**The repository root is an installable WordPress theme** ("Anthropos Automation OS", v3.0.0).
The v3 design prototype and the content-import package live in [`/docs`](docs).

**v3 = AI Automation OS:** dark glass "automation canvas", node-graph / agent-network 3D
(Three.js + Canvas-2D) on every card, restructured menu (About Us · Services micro-combo ·
Guides · Blog · Team + "Book a Free Consultation" CTA), service-page template with 4 micro-offer
blocks + 10 guides, neuro-navigation and internal-linking. Update the live theme via Git Updater
(it detects the 3.0.0 version bump). Set a static homepage in Settings → Reading to show the
front page.

```
/                     ← THEME ROOT (deploy target is wp-content/themes/anthropos)
├── style.css         theme header + all brand styles
├── functions.php     setup, asset enqueue, menu + group helpers
├── header.php        dark header, 3D knot logo, menu
├── footer.php        CTA band + heading-organized footer + NAP
├── front-page.php    Three.js lead-river hero, journey, latest stories
├── index.php         story hub with 7 color-coded category filters
├── single.php        reading progress + series prev/next
├── page.php          profession pages, hubs, static pages
├── assets/js/main.js 3D logo knots, particle river, progress bar
└── docs/             NOT part of the theme output
    ├── index.html            self-contained interactive design spec
    └── wordpress-import/      anthropos-import.xml + additional-css.css + SETUP.md
```

## Install the theme (safe method — never touches WordPress core)

> ⚠️ Do **not** point Hostinger/hPanel Git at `public_html`. That overwrites WordPress
> and breaks the site. Use a plugin (below), or set the deploy directory to
> `public_html/wp-content/themes/anthropos`.

### Recommended: Git Updater plugin
1. Fully disconnect any existing Hostinger Git deployment; confirm the site loads.
2. Install **Git Updater** (`git-updater.com`) → Plugins → Add New → Upload.
3. Git Updater → **Install Theme** → URI `https://github.com/hasangeeky-hue/automation-agency` → branch `main` → Install.
4. Appearance → Themes → activate **Anthropos Automation**.
5. Enable automatic updates so future pushes flow into the theme folder only.

### Then load the content
- Tools → Import → WordPress → upload `docs/wordpress-import/anthropos-import.xml`
- Settings → Reading → Homepage: **Home** · Posts page: **Stories**
- Settings → Permalinks → **Post name**

## The design system

- **Story → Identify → Convert**: 7 color-coded customer stories, each linking to its guides.
- **Guide Library**: 4 series (Get Found · Earn Trust · Never Lose a Lead · Grow Calmly) × 5 guides × 16 professions = 320 interlinked guides.
- **4-color reader guide**: `aa-do` (green), `aa-stat` (amber), `aa-research` (blue), `aa-warn` (red), plus `aa-quick` (AEO answer box).
- **Palette**: night indigo → dawn gold → warm paper, with 7 fixed audience hues.
- **Fonts**: Bricolage Grotesque · Fraunces · Instrument Sans · JetBrains Mono.

## Stack targets

WordPress + Bricks Builder/Elementor + Three.js + Blender/Spline (glb/embeds) + WebP.
