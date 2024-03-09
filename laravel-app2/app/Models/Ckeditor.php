<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ckeditor extends Model
{
    use HasFactory;

    protected $table = 'ckeditor';

    protected $fillable = [
        'name',
        'description'
    ];
}
