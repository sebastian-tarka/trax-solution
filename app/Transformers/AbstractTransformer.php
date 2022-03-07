<?php


namespace App\Transformers;


use Illuminate\Support\Collection;

abstract class AbstractTransformer implements Transformer
{
    public function transformCollection(Collection $data): array
    {
        return array_map([$this,'transform'], $data->toArray());
    }

    abstract public function transform($item): array;

}
