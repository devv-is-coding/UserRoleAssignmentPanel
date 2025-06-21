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
        'gender_id',
        'sex',
        'contactNum',
        'bdate',
    ];

    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'model', 'model_has_roles');
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
}
