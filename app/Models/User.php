<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;


    /** @var string  */
    protected $table = 'users';

    /** @var string  */
    protected $connection = "laravel_test_admin_website";


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** @var array  */
    protected $dates = [
        'created_at', 'update_at', 'deleted_at'
    ];


    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getCreatedAttribute()
    {
        return "{$this->created_at->format('Y-m-d H:i:s')} ";
    }


    /**
     * Test, ci je prihlaseny uzivatel Administrator
     *
     */
    public function isAdministrator() {
        if ($this->role === 'admin') {
            return true;
        } else {
            return false;
        }
    }

}
