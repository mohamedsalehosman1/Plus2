<?php

namespace App\Repositories;

interface CrudsInterface
{

    public function index();
    public function store($data);
    public function update($data, $model);
    public function destroy($model);
    public function find($id, $withTrashed);
}
