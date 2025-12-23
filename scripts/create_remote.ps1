Param(
    [string]$Owner,
    [string]$Repo = 'pixelis'
)
if (-not $Owner) { Write-Host 'Provide $Owner param (your GitHub user/org)'; exit 1 }
if (Get-Command gh -ErrorAction SilentlyContinue) {
    gh repo create "$Owner/$Repo" --public --source . --remote origin --push
} else {
    if (-not $env:GITHUB_TOKEN) { Write-Host 'gh not installed and GITHUB_TOKEN not set; aborting'; exit 1 }
    $payload = @{ name = $Repo; private = $false } | ConvertTo-Json
    Invoke-RestMethod -Uri https://api.github.com/user/repos -Method Post -Headers @{ Authorization = "token $($env:GITHUB_TOKEN)" } -Body $payload
    git remote add origin "git@github.com:$Owner/$Repo.git" -ErrorAction SilentlyContinue
    git push -u origin main
}
Write-Host 'Remote created and pushed (if it did not exist).'
