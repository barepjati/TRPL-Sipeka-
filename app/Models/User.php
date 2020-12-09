<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'role_id',
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

    public function karyawan()
    {
        return $this->hasOne('App\Models\Karyawan');
    }

    public function manajer()
    {
        return $this->hasOne('App\Models\Manajer');
    }

    public function pelanggan()
    {
        return $this->hasOne('App\Models\Pelanggan');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function transaksi()
    {
        return $this->hasOne('App\Models\Pemesanan');
    }
}
