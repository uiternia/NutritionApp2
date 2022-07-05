<?php
namespace App\Services;
Use InterventionImage;
Use Illuminate\Support\Facades\Storage;

Class ImageService
{
 public static function upload($imageFile)
 {
  $file = $imageFile;
  $fileName = uniqid(rand().'_');
  $extension = $file->extension();
  $fileNameToPut = $fileName. '.' . $extension;
  $fileNameToStore = '/storage/' . $fileName. '.' . $extension;
  $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
  Storage::put('public/' . $fileNameToPut,$resizedImage );

  return $fileNameToStore;
 }
}