<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'bio',
        'photo',
        'phone',
        'location',
        'website',
        'linkedin',
        'github',
        'hourly_rate',
        'skills',
        'services',
        'is_available',
        'experience_years'
    ];

    protected $casts = [
        'skills' => 'array',
        'services' => 'array',
        'is_available' => 'boolean',
        'hourly_rate' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return asset('images/default-avatar.png');
    }

    public function getSkillsArrayAttribute()
    {
        return $this->skills ?? [];
    }

    public function getServicesArrayAttribute()
    {
        return $this->services ?? [];
    }
}
