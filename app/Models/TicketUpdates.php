<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUpdates extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'ticket_id',
        'technician_id',
        'comment'
    ];

    /**
     * Get the user that owns the TicketUpdates
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tickets that owns the TicketUpdates
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tickets(): BelongsTo
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }
}
