<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\Transformers\Transformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TripController extends ApiController
{

    /**
     * @var Repository
     */
    private $repository;

    private $transformer;

    public function __construct(Repository $repository, Transformer $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $data = $this->repository->getAllByUserId(auth()->user()->id);

        return $this->respond([
            'data' => $this->transformer->transformCollection($data)
        ]);
    }

    public function store(Request $request)
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
