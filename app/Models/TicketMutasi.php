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
        'created_at',
        'updated_at'
    ];
    protected $table = 'ticket_mutasi';

    public function tickets()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id', 'ticket_id');
    }

    public function getMutasiTiketByRoleId($id)
    {
        return TicketMutasi::where('technician_id',$id);
    }
}
