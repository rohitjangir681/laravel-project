<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'email',
        'mobile_number',
        'gender',
        'address',
        'city',
        'pin_code',
        'state',
        'country',
        'hobbies',
        'courses'
    ];


    // relation from student_qualification table
    public function StudentQualification() {
        return $this->hasMany(StudentQualification::class);
    }

}
