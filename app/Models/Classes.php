<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'desc',
        'user_teacher_id'
    ];

    // One to Many towards User
    public function classesToUser() {
        return $this->belongsTo(User::class, 'user_teacher_id', 'id');
    }

    // One to Many towards Proker
    public function classesToProker() {
        return $this->hasMany(Proker::class, 'class_id', 'id');
    }
}
