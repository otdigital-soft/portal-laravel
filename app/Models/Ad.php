<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'user_id', 'subcategory_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images()
    {
        return $this->hasMany(AdImage::class);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function scopeFilterByCategoryAndLocation($query, $categoryId, $locationId)
    {
        return $query->when($categoryId, function ($query, $categoryId) {
            return $query->where('subcategory_id', $categoryId);
        })->when($locationId, function ($query, $locationId) {
            return $query->whereHas('locations', function ($query) use ($locationId) {
                $query->where('location_id', $locationId);
            });
        });
    }

    public function scopeFilterByTitleCategorySubcategoryAndLocation($query, $title, $categoryId, $locationId, $subcategoryId)
    {
        return $query->when($title, function ($query, $title) {
            return $query->where('title', 'like', '%' . $title . '%');
        })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->whereHas('subcategory.category', function ($query) use ($categoryId) {
                    $query->where('id', $categoryId);
                });
            })
            ->when($subcategoryId, function ($query, $subcategoryId) {
                return $query->where('subcategory_id', $subcategoryId);
            })
            ->when($locationId, function ($query, $locationId) {
                return $query->whereHas('locations', function ($query) use ($locationId) {
                    $query->where('location_id', $locationId);
                });
            });
    }


    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }
}
