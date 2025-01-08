<?php

namespace App\Http\Controllers\container;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
class ImageController extends Controller
{
    public function getImageGallery(Request $request)
    {
        $files = File::files(public_path('warehouse/' . $request->name_file));
        $images = [];
        foreach ($files as $file) {
            if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {
                $images[] = $file->getFilename();
            }
        }
        return response()->json($images); 
    }
    public function deleteImageGallery(Request $request)
    {
        $imageName = basename(parse_url($request->image_url, PHP_URL_PATH));
        $filePath = public_path('warehouse/' . $request->name_file . '/' . $imageName);
        if (File::exists($filePath)) {
            File::delete($filePath);
            return response()->json([
                'success' => true,
                'message' => 'La imagen ha sido eliminada correctamente.',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'La imagen no existe en el directorio.',
        ], 404);
    }
    public function uploadImageGallery(Request $request) 
{
    try {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_url' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!filter_var($value, FILTER_VALIDATE_URL) && !str_starts_with($value, '/')) {
                        $fail("El campo $attribute debe ser una URL válida o una ruta relativa.");
                    }
                },
            ],
        ]);

        $image = $request->file('image');
        $currentUrl = $request->input('current_url');
        $currentPath = public_path(parse_url($currentUrl, PHP_URL_PATH));

        // Obtener el formato deseado de la URL (por ejemplo, jpg)
        $urlParts = parse_url($currentUrl);
        $format = pathinfo($urlParts['path'], PATHINFO_EXTENSION);

        // Validar si la extensión solicitada es válida
        $validFormats = ['jpeg', 'jpg', 'png', 'gif', 'svg'];
        if (!in_array(strtolower($format), $validFormats)) {
            throw new Exception("El formato solicitado no es válido.");
        }

        // Eliminar la imagen existente
        if (file_exists($currentPath)) {
            if (!unlink($currentPath)) {
                throw new Exception("No se pudo eliminar la imagen existente en $currentPath.");
            }
        }

        // Obtenemos el nombre de la imagen y la carpeta
        $imageName = basename($currentPath, '.' . pathinfo($currentPath, PATHINFO_EXTENSION));
        $imageDirectory = dirname($currentPath);

        // Crear la carpeta si no existe
        if (!file_exists($imageDirectory)) {
            mkdir($imageDirectory, 0755, true);
        }

        // Convertir y guardar la imagen en el formato adecuado
        $imageInstance = Image::make($image);
        
        // Convertir la imagen al formato solicitado
        switch (strtolower($format)) {
            case 'jpg':
            case 'jpeg':
                $imageInstance->encode('jpg', 90);  // 90 es la calidad de la imagen JPG
                $imageName .= '.jpg';
                break;
            case 'png':
                $imageInstance->encode('png');
                $imageName .= '.png';
                break;
            case 'gif':
                $imageInstance->encode('gif');
                $imageName .= '.gif';
                break;
            case 'svg':
                $imageInstance->encode('svg');
                $imageName .= '.svg';
                break;
            default:
                throw new Exception("Formato no soportado.");
        }

        // Guardar la imagen convertida
        $imageInstance->save($imageDirectory . '/' . $imageName);

        return response()->json([
            'success' => true,
            'message' => 'La imagen ha sido reemplazada y convertida exitosamente.',
            'new_url' => asset(parse_url($currentUrl, PHP_URL_PATH)),
        ]);
    } catch (Exception $ex) {
        return response()->json([
            'success' => false,
            'message' => $ex->getMessage(),
            'url' => $request->current_url,
        ]);
    }
}
}
