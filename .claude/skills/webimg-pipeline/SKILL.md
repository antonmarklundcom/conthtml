---
name: webimg-pipeline
description: Hands-off website image pipeline for Anton's PY/SE sites — generate with the Higgsfield MCP, then convert, resize, SEO-rename and alt-text every image with the webimg CLI (github.com/antonmarklundcom/webimg) instead of by hand. No API key needed, the Claude session picks the slug and alt text and passes --name/--alt. Use whenever a site build needs new images, whenever the user says "kör bilder", "generate the images", "convert the higgsfield images", "the site has no photos", or whenever a Higgsfield result URL or a local PNG needs to become assets/img files. Pairs with higgsfield-web-imagery (art direction, model choice, credits) — this skill owns everything AFTER the image exists.
---

# webimg pipeline: image → ready-to-commit site files, no manual work, no API key

**Never convert, resize, rename or write alt text by hand, and never write a new
sharp script.** The `webimg` CLI does all of it in one command. **You** (the Claude
session) decide the filename and the alt text and pass them in. No `ANTHROPIC_API_KEY`
is needed or wanted.

## The tool

- Repo: https://github.com/antonmarklundcom/webimg (public, plain Node, no build step, free)
- Run from any repo, local or cloud, nothing to install:
  ```
  npx --yes github:antonmarklundcom/webimg convert <file-or-URL> --name <seo-slug> --alt "<alt text>" --prompt "<short description>" --ar 21:9 --out assets/img
  ```
- Local alternative on Anton's machine: `C:\Claude 1\webimg`, `npm link` once, then `webimg convert ...`.
- Inputs: `.png .jpg .jpeg .webp` files, or any http(s) URL (Higgsfield result URLs work directly).
- Output per image: AVIF + WebP at 640 / 1280 / 1920 named `<slug>-<width>.<ext>`, plus `assets/img/manifest.json`
  with `alt_text` and a ready `html_snippet` (`<picture>` with srcset) per image.

## Naming rules (you write these, every time)

- `--name`: lowercase kebab-case, ASCII only (ñ→n, á→a), 3–8 words, Spanish keyword phrase =
  service or subject + place. `contador-publico-asuncion`, `liquidacion-de-iva-oficina-contable`,
  `calle-residencial-san-lorenzo`. Never `hero`, `image1`, `foto2`, never the source filename.
- `--alt`: one natural Spanish sentence, 8–20 words, what is visible, place included, accents fine,
  no "imagen de"/"foto de" prefix.
- `--prompt` is just a note stored in the manifest; keep it short.
- Both `--name` and `--alt` MUST be passed. If either is missing the tool falls back to slugifying
  the prompt (or calls the Claude API if `ANTHROPIC_API_KEY` happens to be set), which is not what we want.

## Options that matter

| Flag | Use |
|---|---|
| `--ar 21:9` | full-bleed hero band. `4:3` cards, `3:2` general, `1:1` avatars/team. Omit = keep source ratio |
| `--position top` | square people shots being cropped wide (keeps heads). Default `attention` is right for buildings/objects |
| `--widths 640,1280,1920` | default; use `--widths 400,800` for small cards/icons |
| `--out assets/img` | match the project's image folder |
| `--dry-run` | print names/sizes only |

Batch: `npx --yes github:antonmarklundcom/webimg batch . --manifest jobs.csv --out assets/img`
with `jobs.csv` columns `file,prompt,name,alt,ar,position` (file may be a URL). Fill `name` and `alt`
for every row. Missing files are skipped, not fatal.

## Workflow for a page or a whole site

1. **Plan the slots first**: every image slot with its aspect ratio, `name` and `alt`. Write them into
   `jobs.csv` before generating anything, so filenames are decided up front. Show the list to Anton.
2. **Generate** each image with the Higgsfield MCP per the `higgsfield-web-imagery` skill (model, style
   Element, credit budget live there). Put each result URL into the `file` column.
3. **Convert**: run the `batch` command (or one `convert` per image).
4. **Place**: open `assets/img/manifest.json`, paste each `html_snippet` into its slot. Do not rename
   files afterwards; the `<picture>` srcset depends on the names.
5. **Verify**: `grep -o 'assets/img/[a-z0-9-]*' *.html | sort -u` and confirm every referenced base name
   has all six files. Lazy-loaded 404s only show on scroll, so check here, not in the browser.
6. **Commit** the `assets/img/` files and the HTML together. Do not commit source PNGs or `manifest.json`
   unless the project already does.

## Cloud sessions

Cloud Claude Code sessions do not see Anton's local skills. Commit this file into the repo at
`.claude/skills/webimg-pipeline/SKILL.md` and the session picks it up. Images are downloaded and
processed inside the sandbox; nothing is sent to any API.

## Do not

- Do not `curl` the image and write a sharp/ImageMagick one-off. Use webimg.
- Do not set or ask for `ANTHROPIC_API_KEY`. Naming is your job.
- Do not use source filenames or generic slugs. Every file is a keyword phrase.
- If webimg prints `⚠ upscaling`, tell Anton instead of silently accepting a soft image.
