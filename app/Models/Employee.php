<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Employee extends Model
{
    protected $table = 'employees';

    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'sex',
        'contactNum',
        'bdate',
    ];
    public function roles(): MorphToMany{
        return $this->morphToMany(Role::class, 'model', 'model_has_roles');
    }
}
