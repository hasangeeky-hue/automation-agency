# automation-agency

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
