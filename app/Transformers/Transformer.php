<?php


namespace App\Transformers;


use Illuminate\Database\Eloquent\Collection;

interface Transformer
{
    public function transformCollection(\Illuminate\Support\Collection $data): array;
    public function transform($item): array;
}
