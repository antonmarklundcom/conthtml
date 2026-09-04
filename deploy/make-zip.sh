#!/usr/bin/env bash
#
# Builds the archive that goes to Hostinger's public_html/.
#
#     ./deploy/make-zip.sh
#     → dist/contador-YYYY-MM-DD.zip
#
# The zip contains exactly what the site needs to run and nothing else: no docs,
# no prompts, no tests, no deploy scripts, no git metadata, no config.php (that
# is created on the server from config.example.php) and no logs.
#
# Upload it in hPanel → File Manager, extract inside public_html/ (the archive is
# flat, so files land directly there), then create config.php. See README.md, "Deploy to Hostinger".
#
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
STAMP="$(date +%Y-%m-%d)"
NAME="contador-${STAMP}"
DIST="$ROOT/dist"
STAGE="$DIST/$NAME"

command -v zip >/dev/null || { echo "zip is not installed" >&2; exit 2; }

rm -rf "$STAGE" "$DIST/$NAME.zip"
mkdir -p "$STAGE"

# Everything that ships. Add a new top-level directory here when a phase creates
# one, or it will silently be missing from the deploy.
SHIP=(
  index.php
  404.php
  enviar.php
  sitemap.php
  robots.txt
  router.php
  .htaccess
  config.example.php
  assets
  content
  lib
  partials
  templates
)

for item in "${SHIP[@]}"; do
  [ -e "$ROOT/$item" ] || { echo "missing: $item" >&2; exit 1; }
  cp -R "$ROOT/$item" "$STAGE/"
done

# Page directories: every top-level directory holding an index.php.
while IFS= read -r dir; do
  name="$(basename "$dir")"
  cp -R "$dir" "$STAGE/$name"
done < <(find "$ROOT" -mindepth 2 -maxdepth 2 -name index.php \
           -not -path "$ROOT/dist/*" -not -path "$ROOT/tests/*" \
           -printf '%h\n' | sort)

# logs/ must exist and be writable for the lead handler's degraded mode, and it
# must never be readable over HTTP.
mkdir -p "$STAGE/logs"
cat > "$STAGE/logs/.htaccess" <<'HTACCESS'
Require all denied
HTACCESS
touch "$STAGE/logs/.gitkeep"

# Belt and braces: nothing that should have been excluded may be in the stage.
for forbidden in docs prompts tests deploy .git config.php dist plan.md README.md KNOWN-ISSUES.md; do
  if [ -e "$STAGE/$forbidden" ]; then
    echo "refusing to ship: $forbidden" >&2
    exit 1
  fi
done

# Flat archive: extracting it inside public_html/ puts index.php, .htaccess and
# every page directory directly in place — no wrapper folder to move out of.
( cd "$STAGE" && zip -qr "$DIST/$NAME.zip" . )

echo "dist/$NAME.zip  ($(du -h "$DIST/$NAME.zip" | cut -f1), $(find "$STAGE" -type f | wc -l) files)"
echo "staged at dist/$NAME/ — verify it with:  ./verify.sh --root dist/$NAME"
