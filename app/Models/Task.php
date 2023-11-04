<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //this is for mass assigment 
    protected $fillable = ['title', 'description', 'long_description'];
}
