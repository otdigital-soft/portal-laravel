<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'slug', 'image_path'];

    public function blogPosts()
    {
        return $this->hasMany(BlogPost::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'project_subscriptions');
    }
}
