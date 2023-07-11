<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_no',
        'name',
        'user_id',
        'category_id',
        'description',
        'ticket_status_id',
        'ticket_location_id',
        'description',
        'image',
        'created_at',
        'ticket_finished_at'
    ];    
    protected $primaryKey = 'ticket_id';

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

        public function ticket_process()
        {
            return $this->hasMany(TicketProcess::class, 'ticket_id', 'ticket_id');
        }

        public function ticket_mutasi()
        {
            return $this->hasMany(TicketMutasi::class, 'ticket_id', 'ticket_id');
        }

        public function getQueryByIdTiket($ticket_no)
        {
            return Tickets::with('category','locations','ticket_status')->where('ticket_no',$ticket_no);
        }

        public function getAllTickets()
        {
            return Tickets::with('category','locations','ticket_status')->orderBy('created_at','desc');
        }
        
        public function getAllFinishedTicketPerDay()
        {
            $dayLabels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $ticketCounts = [];

            // Inisialisasi array ticketCounts dengan nilai awal 0 untuk setiap hari
            foreach ($dayLabels as $dayLabel) {
            $ticketCounts[] = 0;
            }

            // Mengambil tiket dengan relasi yang diinginkan
            $tickets = Tickets::with('category', 'locations', 'ticket_status')->where('ticket_status_id',2)->get();

            // Menghitung jumlah tiket selesai per hari
            foreach ($tickets as $ticket) {
            $finishedDate = Carbon::parse($ticket->ticket_finished_at)->subDay(1); // Kurangi 1 hari dari tanggal ticket_finished_at
                if ($finishedDate) {
                $dayOfWeek = $finishedDate->locale('id')->dayOfWeek; // Mengambil indeks hari dalam seminggu (0-6)
                    if (isset($ticketCounts[$dayOfWeek])) {
                    $ticketCounts[$dayOfWeek]++;
                    }
                }
            }

        return $ticketCounts;

        }

        public function getAllOpenTicketPerDay()
        {
            $dayLabels = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $ticketCounts = [];

            // Inisialisasi array ticketCounts dengan nilai awal 0 untuk setiap hari
            foreach ($dayLabels as $dayLabel) {
            $ticketCounts[] = 0;
             }

            // Mengambil tiket dengan relasi yang diinginkan
            $tickets = Tickets::with('ticket_status')->get();

            // Menghitung jumlah tiket selesai per hari
            foreach ($tickets as $ticket) {
                $createdDate = $ticket->created_at;
                if ($createdDate && $createdDate->isToday()) {
                    $dayOfWeek = $createdDate->locale('id')->dayOfWeek; // Mengambil indeks hari dalam seminggu (0-6)
                    if (isset($ticketCounts[$dayOfWeek])) {
                        $ticketCounts[$dayOfWeek]++;
                    }
                }
            }
            return $ticketCounts;
        }

        public function getDetailByticket_id($ticket_id)
        {
            return Tickets::with('category','locations','ticket_status')->where('ticket_id',$ticket_id)->first();
        }

        public function getTicketById($id)
        {
            return Tickets::with('category','locations','ticket_status')->where('ticket_id',$id)->first();
        }

        public function getClosedTicketById($id)
        {
            return Tickets::with('category','locations','ticket_status')->where('ticket_id',$id)->first();
        }

        public function getHistoryTicketById($id)
        {
            return Tickets::with('ticket_process')->where('ticket_id',$id)->get();
        }

        public function getAllTicketsByRoleIdNotFinished($auth_id)
        {
            return Tickets::with('category','locations','ticket_status')->where('category_id',$auth_id)->whereNot('ticket_status_id','2')->orderBy('created_at','desc');
        }

        public function getAllTicketsFinishedByRoleId($auth_id)
        {
            return Tickets::with('category','locations','ticket_status')->where(['category_id' => $auth_id,'ticket_status_id' => '2',
            ])->orderBy('created_at','desc');
        }

        public static function countTickets()
        {
        return self::count('ticket_id');
        }

        public static function countNewTicket($auth_id)
        {
        return self::where('ticket_status_id',1)->where('category_id',$auth_id)->count('ticket_id');
        }

        public static function countFinishedTickets($auth_id)
        {
            return self::where([ 
            'ticket_status_id' => '2',
            'category_id' => $auth_id,
            ])->count('ticket_id');
        }
}
