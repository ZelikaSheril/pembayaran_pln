<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;

class User extends AuthUser
{
    use Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'saldo', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function user()
{
    return $this->belongsTo(User::class, 'email', 'email'); // Hubungkan berdasarkan email
}
}
