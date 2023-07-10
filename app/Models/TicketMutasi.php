<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMutasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'technician_id',
        'description',
        'created_at',
        'updated_at'
    ];
    protected $table = 'ticket_mutasi';

}
