<?php
require_once '../classes/Carte.php';

$images = [
  'C:/laragon/www/Memory/assets/image_24/image1.jpg',
  'C:/laragon/www/Memory/assets/image_24/image2.jpg',
  'C:/laragon/www/Memory/assets/image_24/image3.jpg',
  'C:/laragon/www/Memory/assets/image_24/image4.jpg',
  'C:/laragon/www/Memory/assets/image_24/image5.jpg',
  'C:/laragon/www/Memory/assets/image_24/image6.jpg',
  'C:/laragon/www/Memory/assets/image_24/image7.jpg',
  'C:/laragon/www/Memory/assets/image_24/image8.jpg',
  'C:/laragon/www/Memory/assets/image_24/image9.jpg',
  'C:/laragon/www/Memory/assets/image_24/image10.jpg',
  'C:/laragon/www/Memory/assets/image_24/image11.jpg',
  'C:/laragon/www/Memory/assets/image_24/image12.jpg',
  'C:/laragon/www/Memory/assets/image_24/image13.jpg',
  'C:/laragon/www/Memory/assets/image_24/image14.jpg',
  'C:/laragon/www/Memory/assets/image_24/image15.jpg',
  'C:/laragon/www/Memory/assets/image_24/image16.jpg',
  'C:/laragon/www/Memory/assets/image_24/image17.jpg',
  'C:/laragon/www/Memory/assets/image_24/image18.jpg',
  'C:/laragon/www/Memory/assets/image_24/image19.jpg',
  'C:/laragon/www/Memory/assets/image_24/image20.jpg',
  'C:/laragon/www/Memory/assets/image_24/image21.jpg',
  'C:/laragon/www/Memory/assets/image_24/image22.jpg',
  'C:/laragon/www/Memory/assets/image_24/image23.jpg',
  'C:/laragon/www/Memory/assets/image_24/image24.jpg',
    

];
$game = new Carte();

foreach ($images as $image) {
  if (file_exists($image)) {
    echo "File exists: $image\n";
  }else{
    echo "File does not exist: $image\n";
  }
}

$game->insertCarte($images);
?>
