<?php

namespace App;

use Laratrust\Models\LaratrustPermission;
use App\Traits\SearchTrait;

class Permission extends LaratrustPermission
{
    use SearchTrait;
}
