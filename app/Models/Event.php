<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'start_time', 'end_time', 'description', 'created_by', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function attendees()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function isAttendedBy(User $user)
    {
        return $this->attendees->contains($user);
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
