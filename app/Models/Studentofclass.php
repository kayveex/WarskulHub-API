<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentofclass extends Model
{
    use HasFactory;

    protected $table = 'studentofclass';
    protected $primaryKey = 'id';
    protected $fillable = [
        'class_id',
        'student_id'
    ];

    // Many to One towards Students
    public function studentofclassToStudents() {
        return $this->belongsTo(Students::class, 'student_id', 'id');
    }

    // Many to One towards Classes
    public function studentofclassToClasses() {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
}
