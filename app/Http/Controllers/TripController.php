<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\Transformers\Transformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends ApiController
{

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var Transformer
     */
    private $transformer;

    /**
     * TripController constructor.
     * @param Repository $repository
     * @param Transformer $transformer
     */
    public function __construct(Repository $repository, Transformer $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->repository->getAllByUserId(auth()->user()->id);

        return $this->respond([
            'data' => $this->transformer->transformCollection($data)
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {

        $params = $request->all();
        $params['user_id'] = auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'date' => 'required|date', // ISO 8601 string
            'car_id' => 'required|integer',
            'miles' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(400)->respondWithErrors($validator->errors());
        }

        $this->repository->store($this->makePayload($params));

        return $this->setStatusCode(201)->respond(['status' => 'success']);
    }

    private function makePayload(array $payload): array
    {
        return [
            'car_id' => $payload['car_id'],
            'user_id' => $payload['user_id'],
            'distance' => $payload['miles'] ?? $payload['distance'],
            'date' => $payload['date']
        ];
    }
}
