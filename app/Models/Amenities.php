<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function properties()
{
    return $this->belongsToMany(Property::class, 'amenities_property');
}

public function User()
{
    return $this->belongsToMany(User::class, 'amenities_property');
}

}