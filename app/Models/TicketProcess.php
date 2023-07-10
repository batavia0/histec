<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ticket_id',
        'ticket_status_id',
        'technician_id',
        'description',
        'created_at',
        'updated_at'
    ];
    protected $table = 'ticket_process';

}
