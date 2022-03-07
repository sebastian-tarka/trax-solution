<?php


namespace App\Transformers;


use Illuminate\Support\Carbon;

class TripTransformer extends AbstractTransformer implements Transformer
{
    /**
     * @var Transformer
     */
    private $carTransformer;

    /**
     * TripTransformer constructor.
     * @param Transformer $carTransformer
     */
    public function __construct(Transformer $carTransformer)
    {
        $this->carTransformer = $carTransformer;
    }

    /**
     * @param $item
     * @return array
     */
    public function transform($item): array
    {
        $car = $item['car'];
        return [
            'id' => 1,
            'date' => Carbon::createFromTimeString($item['date'])->format('m/d/Y'),
            'miles' => $item['distance'],
            'total' => $item['total'],
            'car' => $this->carTransformer->transform($car)];
    }
}
