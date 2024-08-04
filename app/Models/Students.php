<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Students extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'nis',
        'gender',
        'kelas',
    ];

    // One to Many towards Totalscore
    public function studentsToTotalscore() {
        return $this->hasMany(Totalscore::class, 'student_id', 'id');
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
