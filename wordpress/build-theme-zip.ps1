param(
	[string]$Version = "1.2.2"
)

$ErrorActionPreference = "Stop"

$themeDir = Join-Path $PSScriptRoot "neuroaprender"
$versionedZip = Join-Path $PSScriptRoot "neuroaprender-tema-$Version.zip"
$latestZip = Join-Path $PSScriptRoot "neuroaprender-tema.zip"

Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

function New-ThemeZip {
	param(
		[string]$Destination
	)

	if (Test-Path -LiteralPath $Destination) {
		Remove-Item -LiteralPath $Destination -Force
	}

	$zip = [System.IO.Compression.ZipFile]::Open($Destination, [System.IO.Compression.ZipArchiveMode]::Create)

	try {
		Get-ChildItem -LiteralPath $themeDir -Recurse -File | ForEach-Object {
			$relative = $_.FullName.Substring($themeDir.Length).TrimStart("\", "/")
			$entryName = $relative -replace "\\", "/"
			[System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile($zip, $_.FullName, $entryName, [System.IO.Compression.CompressionLevel]::Optimal) | Out-Null
		}
	}
	finally {
		$zip.Dispose()
	}
}

New-ThemeZip -Destination $versionedZip
Copy-Item -LiteralPath $versionedZip -Destination $latestZip -Force

Write-Host "Created $versionedZip"
Write-Host "Updated $latestZip"
