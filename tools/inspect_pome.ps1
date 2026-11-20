Add-Type -AssemblyName System.Drawing
Get-ChildItem -Path "РОМЕ" -Filter "*.JPG" | ForEach-Object {
    $img = [System.Drawing.Image]::FromFile($_.FullName)
    [PSCustomObject]@{
        Name = $_.Name
        Width = $img.Width
        Height = $img.Height
        SizeMB = [math]::Round($_.Length / 1MB, 2)
    }
    $img.Dispose()
} | Format-Table -AutoSize
