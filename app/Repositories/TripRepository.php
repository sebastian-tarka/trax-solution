<?php


namespace App\Repositories;


use App\Trip;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class TripRepository implements Repository
{
    /**
     * @var Trip
     */
    private $tripModel;

    /**
     * TripRepository constructor.
     * @param Trip $tripModel
     */
    public function __construct(Trip $tripModel)
    {
        $this->tripModel = $tripModel;
    }

    /**
     * @param $id
     * @return Collection
     */
    public function getAllByUserId($id): Collection
    {
        $data = $this->tripModel->with(['car'])->where('user_id', $id)->get();

        foreach ($data as $trip) {
            $tripYear = Carbon::createFromTimeString($trip->date);
            $trip->total = $trip->where('date', '<=', $tripYear)
                ->where('car_id', $trip->car_id)
                ->sum('distance');
        }

        return $data;
    }

    /**
     * @param $payload
     */
    public function store($payload): void
    {
        $this->tripModel->create($payload);
    }

    public function deleteById($id): void
    {
        // TODO: Implement deleteById() method.
    }

    public function getById($id): array
    {
        // TODO: Implement getById() method.
    }

}
