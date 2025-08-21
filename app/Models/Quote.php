<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_name',
        'description',
        'project_type',
        'budget_min',
        'budget_max',
        'deadline',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
        'deadline' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBudgetRangeAttribute()
    {
        if ($this->budget_min && $this->budget_max) {
            return '$' . number_format($this->budget_min) . ' - $' . number_format($this->budget_max);
        } elseif ($this->budget_min) {
            return 'Desde $' . number_format($this->budget_min);
        } elseif ($this->budget_max) {
            return 'Hasta $' . number_format($this->budget_max);
        }
        return 'No especificado';
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'reviewed' => 'blue',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'gray'
        };
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'pending' => 'Pendiente',
            'reviewed' => 'Revisado',
            'approved' => 'Aprobado',
            'rejected' => 'Rechazado',
            default => 'Desconocido'
        };
    }
}
