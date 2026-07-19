# Anthropos Automation — WordPress Import Package

Get the whole site structure into **anthropos-automation.com** in ~15 minutes, no connector needed.

## What's inside

| File | What it is |
|------|-----------|
| `anthropos-import.xml` | WordPress import file (WXR): 42 items — all pages, 7 hub pages, 16 profession pages, 9 story posts, 7 color-coded categories |
| `additional-css.css` | Brand CSS: night/dawn palette, 7 group colors, pain cards, results chips, boundary boxes, the 4-color reader guide, AEO quick-answer box |
| `SETUP.md` | This guide |

## Step 1 — Import the content (5 min)

1. WP Admin → **Tools → Import → WordPress** → *Install Now* (if not installed) → *Run Importer*
2. Upload `anthropos-import.xml`
3. Assign posts to your admin user · check **Download and import file attachments** (harmless, no attachments included)
4. Run. You now have:
   - Pages: Home, What We Do (+3 children), How It Works, Results, Free Website Audit, Stories, Guide Library
   - 7 group hub pages, each with its profession pages as children (16 total)
   - 9 published story posts in 7 audience categories

## Step 2 — Paste the CSS (2 min)

**Appearance → Customize → Additional CSS** → paste the whole of `additional-css.css` → Publish.
(Bricks: Settings → Custom Code → Custom CSS. Elementor: Site Settings → Custom CSS.)

## Step 3 — Reading & permalink settings (2 min)

- **Settings → Reading**: Homepage = "Home", Posts page = "Stories"
- **Settings → Permalinks**: Post name (`/%postname%/`)

## Step 4 — Build the menu (5 min)

**Appearance → Menus** (or your builder's header). Structure, organized in headings:

```
Stories                    → Stories page (dropdown: the 7 categories)
Guide Library              → Guide Library page (mega: 4 series + 7 group columns)
What We Do                 → What We Do (children: Website Layer, Automation Layer, Lead Tracking, How It Works)
Results                    → Results
[Button] Get Free Website Audit → Free Website Audit   ← style with class aa-btn
```

Footer columns: Stories (7 categories) · Guide series A–D (link Guide Library) · What We Do · Company (About, Audit, Contact, Impressum, Privacy) + NAP text block.

## Step 5 — Next content

- Stories link to their profession page; write guides as posts (or a `guide` custom post type) using the reader-guide classes:
  - `<div class="aa-hl aa-do">…</div>` — green "Do this"
  - `<div class="aa-hl aa-stat">…</div>` — amber "Key stat"
  - `<div class="aa-hl aa-research">…</div>` — blue "Research note"
  - `<div class="aa-hl aa-warn">…</div>` — red "Boundary"
  - `<div class="aa-quick">…</div>` — AEO quick-answer box
- Guide curriculum per profession (20 each): Series A Get Found · B Earn Trust · C Never Lose a Lead · D Grow Calmly — five guides per series. Interlink every guide 4 ways: next-in-series, profession hub, same guide in 2 sibling professions, back to its story.

## Design reference

Open `../index.html` (or the GitHub repo) in a browser — it is the full visual spec: header mega menus, story cards, guide page template, interlink map, footer.
