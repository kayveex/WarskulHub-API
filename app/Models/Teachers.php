<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;


    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'nuptk',
        'user_id'
    ];

    // One to One towards User
    public function teacherToUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
