<?php

declare(strict_types=1);

namespace App;

use Illuminate;

class MeuBlueprint extends Illuminate\Database\Schema\Blueprint
{
    public function index($columns, $name = null, $algorithm = null)
    {
        dd(compact('columns', 'name', 'algorithm'));

    }
}
