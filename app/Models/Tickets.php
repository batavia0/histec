<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'ticket_no',
        'name',
        'user_id',
        'category_id',
        'description',
        'ticket_status_id',
        'ticket_location_id',
        'description',
        'image',
        'created_at'
    ];
        /**
         * Get the user that owns the Tickets
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function category()
        {
            return $this->belongsTo(Category::class,'category_id','category_id');
        }

        /**
         * Get all of the comments for the Tickets
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function ticketUpdates(): HasMany
        {
            return $this->hasMany(TicketUpdates::class, 'ticket_id');
        }

        /**
         * Get the locations that owns the Tickets
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function locations()
        {
            return $this->belongsTo(Locations::class,'ticket_location_id','location_id');
        }

        public function ticket_status()
        {
            return $this->belongsTo(TicketStatus::class,'ticket_status_id','status_id');
        }

        public function getQueryByIdTiket($ticket_no)
        {
            return Tickets::with('category','locations','ticket_status')->where('ticket_no',$ticket_no)->get();
        }
}
