Add-Type -AssemblyName System.Drawing

$text = @"
Planova/
|
+-- app/
|   |
|   +-- Models/
|   |   +-- Category.php
|   |   +-- Department.php
|   |   +-- Event.php
|   |   +-- Registration.php
|   |   +-- User.php
|   |
|   +-- Http/
|   |   +-- Controllers/
|   |   |   +-- AdminController.php
|   |   |   +-- Controller.php
|   |   |   +-- DashboardController.php
|   |   |   +-- EventController.php
|   |   |   +-- NotificationController.php
|   |   |   +-- PasswordResetController.php
|   |   |   +-- ProfileController.php
|   |   |   +-- RegistrationController.php
|   |   |
|   |   +-- Middleware/
|   |       +-- ...
|
+-- database/
|   +-- migrations/
|   +-- seeders/
|
+-- resources/
|   +-- views/
|   +-- css/
|   +-- js/
|
+-- public/
|   +-- images/
|   +-- css/
|   +-- js/
|
+-- routes/
|   +-- web.php
|
+-- storage/
|
+-- config/
|
+-- bootstrap/
|
+-- .env
+-- composer.json
+-- artisan
"@

$text = $text.Replace("+--", "|--")

$font = New-Object System.Drawing.Font("Consolas", 14)
$brush = [System.Drawing.Brushes]::Black
$format = New-Object System.Drawing.StringFormat

$dummyBmp = New-Object System.Drawing.Bitmap(1,1)
$dummyGraph = [System.Drawing.Graphics]::FromImage($dummyBmp)
$size = $dummyGraph.MeasureString($text, $font, 2000, $format)

$width = [int]([math]::Ceiling($size.Width) + 60)
$height = [int]([math]::Ceiling($size.Height) + 60)

$bmp = New-Object System.Drawing.Bitmap($width, $height)
$graph = [System.Drawing.Graphics]::FromImage($bmp)
$graph.Clear([System.Drawing.Color]::White)
$graph.DrawString($text, $font, $brush, 20, 20, $format)

$output = "c:\xampp\htdocs\planova\college-event-management\FSD_Report__1___1_\deployment_tree.png"
$bmp.Save($output, [System.Drawing.Imaging.ImageFormat]::Png)

$graph.Dispose()
$bmp.Dispose()
$dummyGraph.Dispose()
$dummyBmp.Dispose()
Write-Host "Success! Created width=$width height=$height"
