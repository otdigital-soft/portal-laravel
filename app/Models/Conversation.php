<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['ad_id'];

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function markMessagesAsRead(User $user)
    {
        $this->messages()
            ->where('user_id', '<>', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
    }
}
