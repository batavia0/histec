<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'type',
        'content',
        'read_at',
        'created_at',
        'updated_at'
    ];
    protected $table = 'notifikasi';


    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function getUserNotification()
    {
        return Notifikasi::where('category_id',Auth()->user()->role_id); 
    }
}
