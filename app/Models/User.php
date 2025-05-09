<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'password' => 'hashed',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function attendings(): HasMany
    {
        return $this->hasMany(Attending::class);
    }

    public function eventsCreated()
    {
        return $this->hasMany(Event::class, 'created_by');
    }

    public function invitations()
    {
        return $this->belongsToMany(Event::class, 'event_user')
            ->withPivot('status') // pending, accepted, rejected
            ->withTimestamps();
    }

    // public function invitedEvents(): BelongsToMany
    // {
    //     return $this->belongsToMany(Event::class, 'event_user')
    //         ->withPivot('status')
    //         ->withTimestamps();
    // }
   
public function invitedEvents()
{
    return $this->belongsToMany(Event::class, 'event_user')  
                ->withPivot('status')  
                ->withTimestamps();
}

public function acceptedEvents()
{
    return $this->belongsToMany(Event::class)->withPivot('status');
}



}
