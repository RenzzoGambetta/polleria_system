<?php

namespace App\Http\Controllers\container;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
class ImageController extends Controller
{
    public function getImageGallery(Request $request)
    {
        $files = File::files(public_path('warehouse/' . $request->name_file));
        $images = [];
        foreach ($files as $file) {
            if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

            if (file_exists($currentPath)) {
                if (!unlink($currentPath)) {
                    throw new Exception("No se pudo eliminar la imagen existente en $currentPath.");
                }
            }

            $imageName = basename($currentPath); 
            $imageDirectory = dirname($currentPath);

            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory, 0755, true);
            }

            $image->move($imageDirectory, $imageName);

            return response()->json([
                'success' => true,
                'message' => 'La imagen ha sido reemplazada exitosamente.',
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

    public function newImageGalery(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'folder_name' => 'required', 
                'image_name' => 'required', 
            ]);
        
            // Obtener el archivo subido
            $archivo = $request->file('image');
        
            // Obtener el nombre de la imagen desde el request
            $imageName = $request->image_name;
        
            // Obtener la extensión del archivo (jpg, png, etc.)
            $extension = $archivo->getClientOriginalExtension();
        
            // Reemplazar espacios por guiones bajos en el nombre de la imagen
            $nombreArchivo = time() . '_' . str_replace(' ', '_', $imageName) . '.' . $extension;
        
            // Mover el archivo a la carpeta de destino con el nombre procesado
            $archivo->move(public_path(FunctionGlobal::routerGallery($request->folder_name)), $nombreArchivo);
        
            // Establecer la URL de la imagen
            $request['ImageUrl'] = FunctionGlobal::routerGallery($request->folder_name) . "/$nombreArchivo";                
        
            // Verificar si el archivo fue subido correctamente
            if ($request->hasFile('image')) {
                // Devolver la URL de la imagen subida
                return response()->json([
                    'success' => true,
                    'message' => 'La imagen ha sido subida exitosamente.',
                    'new_url' => '/'.FunctionGlobal::routerGallery($request->folder_name).'/'.$nombreArchivo, // Usar el nombre procesado con extensión
                ]);
            } else {
                // Si no se recibe el archivo, retornar un error
                return response()->json([
                    'success' => false,
                    'message' => 'No se ha recibido una imagen.',
                ]);
            }
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => $ex->getMessage(),
            ]);
        }
        
    }
}
