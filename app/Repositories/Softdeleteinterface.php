<?php

namespace App\Repositories;

interface Softdeleteinterface
{

    public function trash();
    public function forceDelete($data);
    public function restore($model);
}
