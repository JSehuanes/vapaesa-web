#!/bin/bash
set -e
cd /c/xampp/htdocs/vapaesa-web
git add -A
git status
git commit -m "$(cat <<'EOF'
Sitio inicial de vapaesa: páginas, WhatsApp y formulario comercial.

EOF
)"
git branch -M main
git status
git log -1 --format='%h %s'
