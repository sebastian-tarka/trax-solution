<?php


namespace App\Repositories;


use App\Car;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class CarRepository implements Repository
{

    private $carModel;

    public function __construct(Car $carModel)
    {
        $this->carModel = $carModel;
    }

    public function getAllByUserId($id): Collection
    {
        $data = $this->carModel->with(['trips'])->where('user_id', $id)->get();

        foreach ($data as $cars) {
            foreach ($cars->trips as $trip){
                $tripYear = Carbon::createFromTimeString($trip->date);
                $trip->total = $trip->where('date', '<=', $tripYear)
                    ->where('car_id', $trip->car_id)
                    ->sum('distance');
            }

        }


//        dd($data->toArray());
        return $data;
    }

    public function store($payload): void
    {
        $this->carModel->create($payload);
    }

    public function getById($id): array
    {
        $data = $this->carModel->with(['trips'])->find($id);

        $data->trip_count = $data->trips->count();
        $data->trip_miles = $data->trips->sum('distance');

        return $data->toArray();
    }

    public function deleteById($id):void
    {
        $this->carModel->find($id)->delete();
    }

}
