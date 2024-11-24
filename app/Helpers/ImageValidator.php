<?php
namespace App\Helpers;

use Illuminate\Support\Facades\File;

class ImageValidator
{
    protected static $allowedExtensions = ['jpeg', 'png', 'jpg', 'gif', 'svg'];
    protected static $maxSize = 2048;

    public static function validateBase64Image($image)
    {
        $position = strpos($image, ';');
        $sub = substr($image, 0, $position);
        $ext = explode('/', $sub)[1];

        if (!in_array($ext, self::$allowedExtensions)) {
            return [
                'status' => false,
                'message' => 'Invalid image type. Allowed types are jpeg, png, jpg, gif, svg.',
            ];
        }

        $imageData = str_replace('data:image/' . $ext . ';base64,', '', $image);
        $imageData = str_replace(' ', '+', $imageData);
        $imageSize = strlen(base64_decode($imageData)) / 1024;

        if ($imageSize > self::$maxSize) {
            return [
                'status' => false,
                'message' => 'Image size must be less than ' . self::$maxSize . 'KB.',
            ];
        }

        return ['status' => true, 'extension' => $ext];
    }

    public static function saveBase64Image($image, $path)
    {
        $validation = self::validateBase64Image($image);

        if (!$validation['status']) {
            return $validation;
        }

        $ext = $validation['extension'];
        $imageName = rand(1, 1000) . '_' . time() . '.' . $ext;
        $imagePath = public_path($path);

        if (!File::isDirectory($imagePath)) {
            File::makeDirectory($imagePath, 0755, true, true);
        }

        $imageData = str_replace('data:image/' . $ext . ';base64,', '', $image);
        $imageData = str_replace(' ', '+', $imageData);

        if (!File::put($imagePath . $imageName, base64_decode($imageData))) {
            return [
                'status' => false,
                'message' => 'Failed to save the image.',
            ];
        }

        return [
            'status' => true,
            'image_name' => $imageName,
            'image_path' => $path . $imageName,
        ];
    }
    public static function deleteImage($imagePath)
    {
        $fullPath = public_path($imagePath);
        if (File::exists($fullPath)) {
            return File::delete($fullPath);
        }
        return false;
    }
}


// if ($request->has('academy_logo') && $request->academy_logo) {
//     if ($academy->academy_logo) {
//         ImageValidator::deleteImage($academy->academy_logo);
//     }
//     $saveImage = ImageValidator::saveBase64Image($request->academy_logo, 'backend/images/academy/');

//     if (!$saveImage['status']) {
//         return ResponseHelper::unprocessableEntity($saveImage['message']);
//     }
//     $academy->academy_logo = $saveImage['image_path'];
// }
// $academy->save();