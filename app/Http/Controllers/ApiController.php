<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    /**
     * @var int
     */
    private $statusCode = 200;

    /**
     * @param $code
     * @return ApiController
     */
    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        return $this;
    }


    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param $data
     * @param $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, array $headers = []): JsonResponse
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    public function respondWithErrors($errors): JsonResponse {
        return $this->respond([
            'errors' => $errors,
            'statusCode' => $this->getStatusCode()
        ]);
    }
}
