<?php


namespace App\Transformers;


class CarTransformer extends AbstractTransformer implements Transformer
{
    public function transform($item): array
    {
        return [
            'id' => $item['id'],
            'make' => $item['brand'],
            'model' => $item['model'],
            'year' => $item['year'],
            'trip_count' => isset($item['trip_count']) ? $item['trip_count'] : null,
            'trip_miles' => isset($item['trip_count']) ? number_format($item['trip_miles'], 2) : null,
        ];
    }
}
