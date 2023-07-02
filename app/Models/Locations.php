<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    /**
     * Get the Tickets associated with the Locations
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tickets()
    {
        return $this->hasOne(Tickets::class);
    }

    public function getAllLocations()
    {
        return Locations::orderBy('name','desc')->get();
    }

    

}
