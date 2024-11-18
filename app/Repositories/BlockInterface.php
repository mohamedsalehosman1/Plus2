<?php

namespace App\Repositories;

interface BlockInterface
{
    public function block($model);

    public function unblock($model);
}
