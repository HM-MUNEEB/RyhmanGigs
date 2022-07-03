<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = ['title', 'location', 'tags', 'company', 'email', 'description', 'website', 'user_id'];
    use HasFactory;
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . "%")
                ->orWhere('description', 'like', '%' . request('search') . "%")
                ->orWhere('tags', 'like', '%' . request('search') . "%")
                ->orWhere('location', 'like', '%' . request('search') . "%");
        }
    }
    //Realtionship to User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
