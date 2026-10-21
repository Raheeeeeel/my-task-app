<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'completed', 'due_date'];

    // ✅ Use $casts instead of $dates (works in all Laravel versions)
    protected $casts = [
        'due_date' => 'date',
        'completed' => 'boolean',
    ];

    public function isOverdue()
    {
        return !$this->completed && $this->due_date && $this->due_date->isPast();
    }
}