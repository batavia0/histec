<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get all of the comments for the Roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function users()
    {
        return $this->hasOne(User::class);
    }

    public function getRoleName()
    {
        return Roles::all();
    }

    public function getUserRoleById($id)
    {
        return Roles::where('id',$id);
    }

    public function getRoleIsNotCurrent($role_id)
    {
        return Roles::where('id', '<>', $role_id)->where('id', '<>', 4);
    }
}
