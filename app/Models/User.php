<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'first_name',
        'last_name',
        'username',
        'email',
        'type',
        'password',
        'referrer',
        'status',
        'image_path'
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

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function referral()
    {
        return $this->belongsTo(User::class, 'referrer');
    }

    public function codes()
    {
        return $this->hasMany(ReferralCode::class, 'user_id');
    }

    public function codeRedeemed()
    {
        return $this->hasOne(ReferralCode::class, 'redeemer');
    }

    public function totalGeneratedCode()
    {
        return $this->codes()->count();
    }

    public function children()
    {
        return $this->hasMany(User::class, 'referrer');
    }

    public function whoIsthis($user_id)
    {
        return $this->where('id', $user_id)->first();
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Ad::class, 'favorites')->withTimestamps();
    }

    // public function beliefs()
    // {
    //     return $this->belongsToMany(Belief::class, 'user_beliefs')->withTimestamps();
    // }

    public function beliefs()
    {
        return $this->belongsToMany(Belief::class, 'user_beliefs', 'user_id', 'belief_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function events()
    {
        return $this->belongsToMany(Event::class)->withTimestamps();
    }

    public function subscribedProjects()
    {
        return $this->belongsToMany(Project::class, 'project_subscriptions');
    }
}
