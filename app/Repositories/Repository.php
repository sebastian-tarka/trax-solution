<?php


namespace App\Repositories;


use Illuminate\Support\Collection;

interface Repository
{
    public function getAllByUserId($id): Collection;

    public function store($payload): void;

    public function getById($id):array ;

    public function deleteById($id):void ;
}
