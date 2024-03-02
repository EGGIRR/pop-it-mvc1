<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'fname',
        'lname',
        'patronymic',
        'gender',
        'birthdate',
        'address',
        'avatar',
        'post_id',
        'department_id',
        'structure_id'
    ];
}