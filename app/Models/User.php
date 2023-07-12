<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'email_verified_at',
        'remember_token'
    ];

    /** 
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the roles belongs to Roles Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\
     */
    public function roles()
    {
        return $this->belongsTo(Roles::class,'role_id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function ticketUpdates(): HasMany
    // {
    //     return $this->hasMany(TicketUpdates::class, 'foreign_key', 'local_key');
    // }
    public static function countAdmin()
    {
        return self::count('role_id');
    }

    public function getAllAdmin($id)
    {
        return User::with('roles')->whereNot('role_id',$id)->get();
    }

    public function getAllAdminWithRoles()
    {
        //Function to return all admin with their roles
        return User::with('roles')->get();
    }

    public function assignedTickets()
    {
        return $this->hasMany(TicketProcess::class, 'ticket_id');
    }
}
