<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    private int $code;
    private string $message;
    private array $headers;
    private mixed $meta = null;

    public function __construct()
    {
        app()->setLocale(\request()->header('x-language', 'ru'));

        $this->code = 200;
        $this->message = 'ok';
        $this->headers = [];
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function setMeta($meta): void
    {
        $this->meta = $meta;
    }

    public function composeJson($data = null): JsonResponse
    {
        $response = [
            'language' => app()->getLocale(),
            'code' => $this->code,
            'message' => $this->message,
            'data' => $data,
        ];
        if(!is_null($this->meta)){
            $response['meta'] = $this->meta;
        }

        return response()->json(
            $response,
            $this->code,
            $this->headers
        );
    }
}
