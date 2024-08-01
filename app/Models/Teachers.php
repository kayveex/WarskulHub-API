<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Teachers extends Model
{
    use HasFactory;


    protected $table = 'teachers';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'nuptk',
        'user_id'
    ];

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // One to One towards User
    public function teacherToUser() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
