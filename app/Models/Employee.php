<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees';
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'contactNum',
        'bdate',
        'gender_id',
    ];

    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles');
    }
    public function sexes(): MorphToMany
    {
        return $this->morphToMany(Sex::class, 'model', 'model_has_sexes');
    }
    // Removed polymorphic gender relationship for normalization
}
