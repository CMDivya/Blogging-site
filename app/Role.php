<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use App\Traits\SearchTrait;
class Role extends LaratrustRole
{
    use SearchTrait;
}
