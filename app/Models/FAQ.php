<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'answer',
        'technician_id',
        'created_date',
        'created_at',
        'updated_at',
    ];

    protected $table = 'faq';


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','category_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'technician_id','id');
    }

    public function getAllFaq()
    {
        return FAQ::with('category','users');
    }

    public function getFaqById($id)
    {
        return FAQ::with('category','users')->where('faq_id',$id);
    }
}
