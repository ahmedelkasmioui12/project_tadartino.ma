<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function type(){
        return $this->belongsTo(PropertyType::class,'ptype_id','id');
    }

    public function images()
    {
        return $this->hasMany(multiImage::class);
    }

    // Define relationship with amenities
    public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'property_id', 'amenties_id');
    }

    // Define relationship with agent
    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class,'agent_id','id');
    }
    public function pstate(){
        return $this->belongsTo(State::class,'state','id');
    }

}