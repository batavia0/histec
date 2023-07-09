<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    protected $table = 'ticket_status';

    public function tickets()
    {
        return $this->hasOne(Tickets::class);
    }

    public function getAllTicketStatus()
    {
        return TicketStatus::all();
    }
}
