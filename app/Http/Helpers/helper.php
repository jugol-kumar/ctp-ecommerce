<?php


use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use JetBrains\PhpStorm\ArrayShape;

if (!function_exists("jsonResponse")){
    #[ArrayShape(["type" => "mixed|string", "status" => "int|mixed", "message" => "mixed|null", "data" => "array|mixed"])]
    function jsonResponse($type="success", $status=200, $data=[], $message=null): array
    {
        return [
          "type" => $type,
          "status" => $status,
          "message" => $message,
          "data" => $data
        ];
    }
}

if (!function_exists("fileResize")){
    function fileResize($file, $storagePath, $width = null, $height = null){
        try {
            $img = Image::make($file->getRealPath())->encode();
            if ($width != null || $height != null){
                $img->resize($width, $height);
            }
            $img->save('storage/'.$storagePath);
            clearstatcache();
        } catch (\Exception $e) {
            Log::error("errors" ,[
                "error message"  => $e
            ]);
        }
    }
}
