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
        'ticket_process_status_id',
        'technician_id',
        'description',
        'created_at',
        'updated_at'
    ];
    protected $table = 'ticket_process';
    protected $primaryKey = 'ticket_process_id';

    public function tickets()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id', 'ticket_id');
    }
    public function technician() //alias user
    {
        return $this->belongsTo(User::class, 'technician_id', 'id');
    }

    public function ticketProcessStatus()
    {
        return $this->belongsTo(TicketStatus::class, 'ticket_process_status_id','status_id');
    }
    public function getHistoryTicketById($id)
    {
        return TicketProcess::with('tickets')->where('ticket_id',$id)->get();
    }
}
