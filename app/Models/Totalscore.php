<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Totalscore extends Model
{
    use HasFactory;

    protected $table = 'totalscore';
    protected $primaryKey = 'id';
    protected $fillable = [
        'class_id',
        'student_id',
        'totalscore',
        'desc_belajar',
        'tahunajar_start',
        'tahunajar_end',
        'semester',
    ];

    //Many to One towards Classes
    public function totalscoreToClasses() {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }

    // Many to One towards Students
    public function totalscoreToStudents() {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }


}
