<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Employees extends Authenticatable
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'employee_id',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
