<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'percentage',
        'icon',
        'color',
        'order'
    ];

    protected $casts = [
        'percentage' => 'integer',
        'order' => 'integer'
    ];

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('percentage', 'desc');
    }

    public function getColorClassAttribute()
    {
        $colors = [
            'blue' => 'bg-blue-600',
            'green' => 'bg-green-600',
            'red' => 'bg-red-600',
            'yellow' => 'bg-yellow-600',
            'purple' => 'bg-purple-600',
            'orange' => 'bg-orange-600',
        ];

        return $colors[$this->color] ?? 'bg-blue-600';
    }
}
