<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    protected $table = 'category';


    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasOne(Tickets::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class,'category_id');
    }
    
    public function locations()
    {
        return $this->hasOne(Tickets::class);
    }

    public function getAllCategory()
    {
        return Category::all();
    }

    public function faq()
    {
        return $this->hasMany(FAQ::class, 'category_id');
    }
}
