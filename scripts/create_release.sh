#!/usr/bin/env bash
# Create a Git tag and GitHub release v0.1.0
# Usage: OWNER=alice REPO=pixelis ./scripts/create_release.sh
set -euo pipefail
OWNER=${OWNER:-}
REPO=${REPO:-pixelis}
TAG=${TAG:-v0.1.0}
BODY=${BODY:-"Initial release"}

if [ -z "$OWNER" ]; then
  echo "Set OWNER env var to your GitHub username or org"
  exit 1
fi

git tag -a "$TAG" -m "$BODY" || true
git push origin "$TAG" || true

if command -v gh >/dev/null 2>&1; then
  gh release create "$TAG" --title "$TAG" --notes "$BODY" "$TAG"
else
  if [ -z "${GITHUB_TOKEN:-}" ]; then
    echo "gh CLI not found and GITHUB_TOKEN is not set. Cannot create GitHub release via API."
    exit 1
  fi
  payload=$(jq -n --arg tag "$TAG" --arg name "$TAG" --arg body "$BODY" '{tag_name: $tag, name: $name, body: $body, draft: false, prerelease: false}')
  curl -s -H "Authorization: token ${GITHUB_TOKEN}" -d "$payload" "https://api.github.com/repos/${OWNER}/${REPO}/releases" | jq -r '.html_url'
fi

echo "Release creation attempted."
