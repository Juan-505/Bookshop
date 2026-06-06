$content = Get-Content 'd:\Webbook\bookshop\public\build\assets\app-ChAdZdjz.js' -Raw
$idx = $content.IndexOf('data-cart-dec')
Write-Host "data-cart-dec at: $idx"
if ($idx -ge 0) {
    $start = [Math]::Max(0, $idx - 30)
    $len = [Math]::Min(300, $content.Length - $start)
    Write-Host $content.Substring($start, $len)
}
