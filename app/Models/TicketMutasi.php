<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMutasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'role_id',
        'from_technician_id',
        'created_at',
        'updated_at'
    ];
    protected $table = 'ticket_mutasi';

    public function tickets()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id', 'ticket_id');
    }

    public function getMutasiTiketByRoleId($role_id,$user_id)
    {
    return TicketMutasi::with('tickets')
        ->where('role_id', $role_id)
        ->where('from_technician_id', '<>', $user_id);
    }

}
