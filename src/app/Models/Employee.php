<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'designation',
    ];

    // Relationship: employee has many tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getTasks()
    {
        return $this->tasks()->get();
    }
    
    // Relationship: employee belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
