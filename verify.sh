#!/usr/bin/env bash
#
# The build gate. Runs on every PR (.github/workflows/verify.yml) and should be
# run locally before pushing:
#
#     ./verify.sh                 # check the repository
#     ./verify.sh --root dist/x   # check an unzipped deploy artifact
#
# It checks, in order:
#   1. php -l on every PHP file
#   2. the PHP-level helpers (RUC check digit, guaraní formatting)
#   3. every URL in the route contract answers with the status plan §5.1.6 says
#      — that list is derived from the content arrays plus the frozen legacy
#      URLs from the live-site scan, so later phases extend it by adding content
#   4. no page renders a PHP warning
#   5. every page has a title and a description, both unique site-wide, with the
#      title under 60 characters
#   6. enviar.php answers {"ok":true,"degraded":true} with no CRM key
#
set -uo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
SITE_ROOT="$ROOT"
PORT="${VERIFY_PORT:-8730}"

while [ $# -gt 0 ]; do
  case "$1" in
    --root) SITE_ROOT="$(cd "$2" && pwd)"; shift 2 ;;
    --port) PORT="$2"; shift 2 ;;
    *) echo "unknown argument: $1" >&2; exit 2 ;;
  esac
done

BASE="http://127.0.0.1:${PORT}"
LOG="$(mktemp)"
FAILURES=0

red()   { printf '\033[31m%s\033[0m\n' "$*"; }
green() { printf '\033[32m%s\033[0m\n' "$*"; }
step()  { printf '\n\033[1m== %s\033[0m\n' "$*"; }
fail()  { red "  FAIL  $*"; FAILURES=$((FAILURES + 1)); }
ok()    { printf '  ok    %s\n' "$*"; }

cleanup() {
  [ -n "${SERVER_PID:-}" ] && kill "$SERVER_PID" 2>/dev/null
  rm -f "$LOG"
}
trap cleanup EXIT

# ---------------------------------------------------------------- 1. php -l --
step "php -l"
LINT_FAILED=0
while IFS= read -r file; do
  if ! out=$(php -l "$file" 2>&1); then
    fail "$file"; echo "$out" | sed 's/^/        /'
    LINT_FAILED=1
  fi
done < <(find "$SITE_ROOT" -name '*.php' -not -path '*/tests/node_modules/*' -not -path '*/dist/*' | sort)
[ "$LINT_FAILED" -eq 0 ] && ok "all PHP files parse"

# ------------------------------------------------------------- 2. unit checks --
step "helpers"
helper_out=$(php -r '
require "'"$SITE_ROOT"'/lib/bootstrap.php";
$fail = 0;
// 44444401-7 is the consumidor-final RUC fixed by convention — a real number,
// so it is the right fixture for the DNIT modulo-11 check digit.
if (!validate_ruc("44444401-7"))  { echo "validate_ruc rejected 44444401-7\n"; $fail = 1; }
if (validate_ruc("44444401-8"))   { echo "validate_ruc accepted a bad check digit\n"; $fail = 1; }
if (ruc_check_digit("44444401") !== 7) { echo "ruc_check_digit wrong\n"; $fail = 1; }
if (fmt_gs(1500000) !== "\u{20b2} 1.500.000") { echo "fmt_gs wrong: " . fmt_gs(1500000) . "\n"; $fail = 1; }
exit($fail);
' 2>&1)
if [ $? -eq 0 ]; then ok "RUC check digit and guaraní formatting"; else fail "helpers"; echo "$helper_out" | sed 's/^/        /'; fi

# ------------------------------------------------------------- 3. boot server --
step "server"
if ! command -v php >/dev/null; then red "php not found"; exit 2; fi
php -S "127.0.0.1:${PORT}" -t "$SITE_ROOT" "$SITE_ROOT/router.php" >"$LOG" 2>&1 &
SERVER_PID=$!

for _ in $(seq 1 40); do
  curl -s -o /dev/null "$BASE/" && break
  sleep 0.25
done
if ! curl -s -o /dev/null "$BASE/"; then
  red "server failed to start"; cat "$LOG"; exit 2
fi
ok "php -S on port $PORT (root: $SITE_ROOT)"

# --------------------------------------------------------------- 4. routes ----
step "routes"
ROUTE_LIST=$(php "$ROOT/deploy/routes.php" "$SITE_ROOT")
ROUTE_COUNT=0

while IFS=$'\t' read -r path expected; do
  [ -z "$path" ] && continue
  actual=$(curl -s -o /dev/null -w '%{http_code}' "${BASE}${path}")
  ROUTE_COUNT=$((ROUTE_COUNT + 1))
  if [ "$actual" != "$expected" ]; then
    fail "$path — expected $expected, got $actual"
  fi
done <<< "$ROUTE_LIST"
ok "$ROUTE_COUNT URLs answered as specified"

# --------------------------------------------------- 5. no PHP warnings -------
step "php warnings"
if grep -qE 'PHP (Warning|Notice|Fatal error|Parse error|Deprecated)' "$LOG"; then
  fail "pages emitted PHP diagnostics"
  grep -E 'PHP (Warning|Notice|Fatal error|Parse error|Deprecated)' "$LOG" | sort -u | head -20 | sed 's/^/        /'
else
  ok "no warnings, notices or deprecations while rendering"
fi

# --------------------------------------------- 6. unique title + description --
step "metadata"
META=$(mktemp)
while IFS=$'\t' read -r path expected; do
  [ "$expected" = "200" ] || continue
  case "$path" in /robots.txt|/sitemap.xml) continue ;; esac

  html=$(curl -s "${BASE}${path}")
  title=$(printf '%s' "$html" | grep -oP '(?<=<title>).*?(?=</title>)' | head -1)
  desc=$(printf '%s' "$html" | grep -oP '<meta name="description" content="\K[^"]*' | head -1)

  [ -z "$title" ] && fail "$path — empty <title>"
  [ -z "$desc" ]  && fail "$path — empty meta description"

  len=${#title}
  if [ "$len" -gt 60 ]; then
    fail "$path — <title> is $len chars, over the 60-char budget: $title"
  fi

  printf 'T\t%s\t%s\n' "$title" "$path" >> "$META"
  printf 'D\t%s\t%s\n' "$desc" "$path" >> "$META"
done <<< "$ROUTE_LIST"

dupes=$(cut -f1,2 "$META" | sort | uniq -d)
if [ -n "$dupes" ]; then
  while IFS=$'\t' read -r kind value; do
    [ -z "$value" ] && continue
    where=$(awk -F'\t' -v k="$kind" -v v="$value" '$1==k && $2==v {printf "%s ", $3}' "$META")
    fail "duplicate $([ "$kind" = T ] && echo title || echo description): \"$value\" on: $where"
  done <<< "$dupes"
else
  ok "$(grep -c '^T' "$META") pages, every title and description unique and non-empty"
fi
rm -f "$META"

# ------------------------------------------------------------ 7. lead form ----
step "enviar.php"
response=$(curl -s -X POST "$BASE/enviar.php" \
  -H 'Accept: application/json' -H "Origin: $BASE" \
  -d 'name=Verify&phone=0981000999&need=contabilidad&source_page=/contacto/&idempotency_key=verify-sh-fixture')

if [ "$response" = '{"ok":true,"degraded":true}' ]; then
  ok 'degraded mode returns {"ok":true,"degraded":true} with no CRM key'
else
  fail "degraded mode returned: $response"
fi

nojs=$(curl -s -o /dev/null -w '%{http_code} %{redirect_url}' -X POST "$BASE/enviar.php" \
  -H "Origin: $BASE" -d 'name=Verify&phone=0981000998')
case "$nojs" in
  "303 ${BASE}/contacto/?enviado=1") ok "no-JS POST redirects to /contacto/?enviado=1" ;;
  *) fail "no-JS POST returned: $nojs" ;;
esac

spam=$(curl -s -X POST "$BASE/enviar.php" -H 'Accept: application/json' -H "Origin: $BASE" \
  -d 'phone=0981000997&website=bot')
[ "$spam" = '{"ok":true,"degraded":true}' ] && ok "honeypot accepted silently" || fail "honeypot returned: $spam"

rm -rf "$SITE_ROOT/logs/rate" "$SITE_ROOT/logs/leads.log"

# ------------------------------------------------------------------ result ----
echo
if [ "$FAILURES" -eq 0 ]; then
  green "verify.sh: PASS"
  exit 0
fi
red "verify.sh: $FAILURES failure(s)"
exit 1
