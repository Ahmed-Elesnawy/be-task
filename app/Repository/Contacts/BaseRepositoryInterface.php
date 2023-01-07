<?php
namespace App\Repository\Contacts;

use Illuminate\Support\Collection;



interface BaseRepositoryInterface 
{
    public function findAll(array $columns = ["*"]) : Collection;
    public function findAllPaginated(int $perPage = 15,array $columns = ["*"]) : object;
    public function find(int $id) : object;
    public function findOne(array $attributes) : object;
    public function findWhere(array $attributes) : Collection;
    public function deleteWhere(array $attributes) : bool;
    public function deleteById(int $id) : bool;
    public function create(array $attributes) : object;
}