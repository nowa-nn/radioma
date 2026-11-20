Add-Type -AssemblyName System.Drawing

$targetDir = "public\images\pome"
if (-not (Test-Path $targetDir)) {
    New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
}

$thumbDir = "tools\pome_thumbs"
if (-not (Test-Path $thumbDir)) {
    New-Item -ItemType Directory -Path $thumbDir -Force | Out-Null
}

function Save-ResizedImage {
    param(
        [string]$sourcePath,
        [string]$destPath,
        [int]$maxWidth,
        [int]$maxHeight,
        [long]$quality = 85
    )

    $src = [System.Drawing.Image]::FromFile($sourcePath)
    
    $ratioX = $maxWidth / $src.Width
    $ratioY = $maxHeight / $src.Height
    $ratio = [Math]::Min($ratioX, $ratioY)
    if ($ratio -gt 1) { $ratio = 1 }

    $newWidth = [int]($src.Width * $ratio)
    $newHeight = [int]($src.Height * $ratio)

    $destBmp = New-Object System.Drawing.Bitmap($newWidth, $newHeight)
    $graphics = [System.Drawing.Graphics]::FromImage($destBmp)
    $graphics.InterpolationMode = [System.Drawing.Drawing2D.InterpolationMode]::HighQualityBicubic
    $graphics.SmoothingMode = [System.Drawing.Drawing2D.SmoothingMode]::HighQuality
    $graphics.PixelOffsetMode = [System.Drawing.Drawing2D.PixelOffsetMode]::HighQuality
    $graphics.CompositingQuality = [System.Drawing.Drawing2D.CompositingQuality]::HighQuality

    $graphics.DrawImage($src, 0, 0, $newWidth, $newHeight)

    $encoder = [System.Drawing.Imaging.ImageCodecInfo]::GetImageEncoders() | Where-Object { $_.MimeType -eq "image/jpeg" }
    $encoderParams = New-Object System.Drawing.Imaging.EncoderParameters(1)
    $encoderParams.Param[0] = New-Object System.Drawing.Imaging.EncoderParameter([System.Drawing.Imaging.Encoder]::Quality, $quality)

    $destBmp.Save($destPath, $encoder, $encoderParams)

    $graphics.Dispose()
    $destBmp.Dispose()
    $src.Dispose()
}

$files = Get-ChildItem -Path "РОМЕ" -Filter "*.JPG"
foreach ($f in $files) {
    $webPath = Join-Path $targetDir $f.Name.ToLower()
    $thumbPath = Join-Path $thumbDir $f.Name.ToLower()

    # Web version (max 2048x1365 for hero and big views, ~300-500KB)
    Save-ResizedImage -sourcePath $f.FullName -destPath $webPath -maxWidth 2048 -maxHeight 1365 -quality 85

    # Small thumbnail for quick multimodal viewing (max 800x533, ~50-80KB)
    Save-ResizedImage -sourcePath $f.FullName -destPath $thumbPath -maxWidth 800 -maxHeight 533 -quality 75

    Write-Host "Processed $($f.Name): web and thumb"
}
