<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'user_name',
        'birthdate',
        'phone',
        'address',
        'email',
        'password',
        'user_image',
    ];

    protected $hidden = [
        'password',
    ];
}
