<?php


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
