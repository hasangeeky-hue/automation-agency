# automation-agency

**This repo is now an installable WordPress theme** ("Anthropos Automation") *and* contains the design prototype + content import package.

## Install the theme via Git (no FTP, no hPanel)

1. In WP Admin install the free **WP Pusher** plugin (wppusher.com) — or **Git Updater**
2. WP Pusher → **Install Theme** → GitHub → repository: `hasangeeky-hue/automation-agency` → branch `main` → Install
3. Appearance → Themes → activate **Anthropos Automation**
4. Optional: enable WP Pusher "Push-to-Deploy" so every push to this repo updates the theme automatically
5. Then import `wordpress-import/anthropos-import.xml` (Tools → Import → WordPress) for all pages/stories, and set Settings → Reading (Homepage: "Home", Posts page: "Stories")

Theme files: `style.css`, `functions.php`, `header.php`, `footer.php`, `front-page.php` (Three.js lead-river hero + journey + latest stories), `index.php` (story hub with color filters), `single.php` (reading progress + series prev/next), `page.php`, `assets/js/main.js` (3D logo knots, particle river, progress bar).

Design prototype for **anthropos-automation.com** — website redesign + customer lead marketing automation for solo operators and small teams.

## What's in here

- `index.html` — self-contained interactive design spec (open in any browser):
  - **Header** with heading-organized mega menus (Stories · Guide Library · What We Do) and a live Three.js logo mark
  - **Story → Identify → Convert** blog architecture: 7 color-coded customer-story cards with cost-of-leak callouts
  - **Guide Library**: the 4×5 curriculum (Get Found · Earn Trust · Never Lose a Lead · Grow Calmly) — 20 research-grade guides per profession, 16 professions, 320 guides total
  - **Guide page template**: reading progress, chapter rail, AEO quick-answer box, 4-color reader guide (Do this / Key stat / Research note / Boundary), interlink block
  - **Interlinking system**: Chain · Ladder · Bridge · Return rules (zero orphan pages)
  - **SEO / AEO / GEO** strategy strip and a heading-organized footer with NAP
  - Three.js "Lead River" particle hero (chaos → flow)

## Stack targets

WordPress + Bricks Builder/Elementor + Three.js + Blender/Spline (glb/embeds) + WebP optimization.

## WordPress mapping

- Post types: `story`, `guide` · Taxonomies: `profession` (16), `series` (A–D), audience group colors via term meta
- URL silo: `/guides/{profession}/{series-number}-{slug}/`, stories under `/stories/`
- Fonts: Bricolage Grotesque · Fraunces · Instrument Sans · JetBrains Mono
