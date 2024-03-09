<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_name',
        'city_status',
        'state_id',
        'country_id'
    ];

    
    // belong from country
    public function country() {
        return $this->belongsTo(Country::class);
    }

    // belong from state
    public function state() {
        return $this->belongsTo(State::class);
    }
    // public function state() {
    //     return $this->belongsTo(State::class, 'state_id', 'id');
    // }

}
