#!/usr/bin/env bash
# Create a GitHub repository and push the current repo to it.
# Usage: OWNER=your-github-username REPO=pixelis ./scripts/create_remote.sh
# Requires: either 'gh' CLI installed and logged in, or GITHUB_TOKEN env var set (with repo scope)
set -euo pipefail
OWNER=${OWNER:-}
REPO=${REPO:-pixelis}
VISIBILITY=${VISIBILITY:-public}

if [ -z "$OWNER" ]; then
  echo "Set OWNER env var to your GitHub username or org, e.g.: OWNER=alice"
  exit 1
fi

if command -v gh >/dev/null 2>&1; then
  echo "Using gh CLI to create repository $OWNER/$REPO"
  gh repo create "$OWNER/$REPO" --${VISIBILITY} --source . --remote origin --push || true
else
  if [ -z "${GITHUB_TOKEN:-}" ]; then
    echo "gh CLI not found and GITHUB_TOKEN is not set. Please either install gh or set GITHUB_TOKEN and re-run."
    exit 1
  fi
  echo "Creating repo via GitHub API"
  curl -s -H "Authorization: token ${GITHUB_TOKEN}" https://api.github.com/user | jq -r '.login' >/dev/null
  payload=$(jq -n --arg name "$REPO" --arg vis "$VISIBILITY" '{name: $name, private: ($vis=="private")}')
  curl -s -H "Authorization: token ${GITHUB_TOKEN}" -d "$payload" https://api.github.com/user/repos | jq -r '.ssh_url'
  git remote add origin "git@github.com:${OWNER}/${REPO}.git" || true
  git push -u origin main
fi

echo "Remote repository created and pushed (if it didn't exist)."
