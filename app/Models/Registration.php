<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'user_registration';
    protected $fillable = [
        'firstname',
        'lastname',
        'contact',
        'email',
        'password',
        'fb_link',
        'usertype',
    ];
}
