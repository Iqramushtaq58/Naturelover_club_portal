<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'father_name',
        'student_id',
        'department',
        'cnic',
        'phone',
        'gender',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function events()
{
    return $this->belongsToMany(Event::class);
}
public function joinedEvents()
{
    return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id');
    return $this->belongsToMany(Event::class)->withTimestamps();
}



}
