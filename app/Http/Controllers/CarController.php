<?php

namespace App\Http\Controllers;

use App\Repositories\Repository;
use App\Transformers\Transformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends ApiController
{

    /**
     * @var Repository
     */
    private $repository;

    /**
     * @var Transformer
     */
    private $transformer;

    public function __construct(Repository $repository, Transformer $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function index()
    {
        $data = $this->repository->getAllByUserId(auth()->user()->id);

        return $this->respond([
            'data' => $this->transformer->transformCollection($data)
        ]);
    }

    public function show($id)
    {
        $data = $this->repository->getById($id, auth()->user()->id);

        return $this->respond([
            'data' => $this->transformer->transform($data)
        ]);
    }

    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return $this->setStatusCode(204)->respond(['status' => 'success']);
    }

    public function store(Request $request)
    {

        $params = $request->all();
        $params['user_id'] = auth()->user()->id;

        $validator = Validator::make($request->all(), [
            'year' => 'required|integer',
            'make' => 'required|string',
            'model' => 'required|string'
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
            'year' => $payload['year'],
            'user_id' => $payload['user_id'],
            'brand' => $payload['make'],
            'model' => $payload['model']
        ];
    }
}
