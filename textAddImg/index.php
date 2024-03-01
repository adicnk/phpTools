<?php
// Create image resource
$image = imagecreatefromjpeg("template-01.jpg");
$logo = imagecreatefrompng('logo.png');

//logo resample
$height=510;
$width=560;
$logo_p = imagecreatetruecolor($height,$width);
imagecopyresampled($logo_p, $logo, 0, 0, 0, 0, 
        $height, $width, 310, 340); 
// Allocate colors
$white = imagecolorallocate($image, 255, 255, 255);
$black = imagecolorallocate($image, 0, 0, 0);

// Set Path to Font File
$font_path = 'font/ChunkFive-Regular.TTF';
// Set Text to Be Printed On Image
$text = "Sekolah Tinggi Ilmu Keperawatan";
$x_length=strlen($text);
imagettftext($image, 30, 0, 360-$x_length, 130, $black, $font_path, $text);

$font_path = 'font/KaushanScript-Regular.TTF';
$text = "PPNI JABAR";
$x_length=strlen($text);
imagettftext($image, 50, 0, 460-$x_length, 200, $black, $font_path, $text);

$font_path = 'font/Oswald-Regular.TTF';
$text = "Dengan ini menyatakan :";
$x_length=strlen($text);
imagettftext($image, 15, 0, 560-$x_length, 260, $black, $font_path, $text);

$font_path = 'font/AlexBrush-Regular.TTF';
$text = "SANDY AULIA, A.Md.Kep";
$x_length=strlen($text);
imagettftext($image, 35, 0, 310-$x_length, 340, $black, $font_path, $text);

$font_path = 'font/Aller_Rg.TTF';
$text = "telah menyelesatkan dengan baik dan memenuhi syarat pendidikan pada ";
$x_length=strlen($text);
imagettftext($image, 16, 0, 310-$x_length, 410, $black, $font_path, $text);

$text = "program studi";
$x_length=strlen($text);
imagettftext($image, 16, 0, 290-$x_length, 440, $black, $font_path, $text);

$text = "D3 (diploma tiga) Keperawatan Fakultas Keperawatan";
$x_length=strlen($text);
imagettftext($image, 16, 0, 460-$x_length, 440, $black, $font_path, $text);

$text = "lulus pada tanggal 21 Agustus 2024, oleh karena itu kepadanya diberikan gelar :";
$x_length=strlen($text);
imagettftext($image, 16, 0, 290-$x_length, 470, $black, $font_path, $text);

$font_path = 'font/AlexBrush-Regular.TTF';
$text = "Ahli Madya Keperawatan";
$x_length=strlen($text);
imagettftext($image, 35, 0, 410-$x_length, 530, $black, $font_path, $text);

$font_path = 'font/Aller_Rg.TTF';
$text = "beserta segala hak dan kewajiban yang melekat kepadanya";
$x_length=strlen($text);
imagettftext($image, 16, 0, 380-$x_length, 580, $black, $font_path, $text);

$text = "diberikan di Bandung, 4 Maret 2024 (dua puluh ribu dua puluh empat)";
$x_length=strlen($text);
imagettftext($image, 16, 0, 310-$x_length, 620, $black, $font_path, $text);

$font_path = 'font/Oswald-Light.TTF';
$text = "Dekan Fakultas Keperawatan,";
$x_length=strlen($text);
imagettftext($image, 16, 0, 120-$x_length, 700, $black, $font_path, $text);

imagerectangle($image, 580, 700, 670, 810, $black);

$text = "4 x 6";
$x_length=strlen($text);
imagettftext($image, 16, 0, 615-$x_length, 770, $black, $font_path, $text);

$text = "Rektor STIKEP PPNI JABAR,";
$x_length=strlen($text);
imagettftext($image, 16, 0, 950-$x_length, 700, $black, $font_path, $text);

// Add text to image
//imagestring($image, 5, 10, 10, "Hello World!", $black);

//Add Logo
imagecopymerge($image, $logo_p, 430, 300, 0, 0, 360, 370, 10);

# Save the image to a file
//imagepng($image, '/path/to/save/image.png');

// Output image
header("Content-type: image/jpeg");
imagejpeg($image);

// Free up memory
imagedestroy($image);
?>
